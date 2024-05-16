<?php
namespace App\controllers;
use Framework\Database;
use Framework\Validation;
use Framework\Session;
use Framework\Authorisation;
use Framework\MiddleWare\Authorise;
class ListingController{
    protected $db;
    public function __construct(){
        $config = require  basePath('config/db.php');
        $this->db = new Database($config);
    }
    public function index(){
        $listing = $this->db->query('SELECT * FROM listing ORDER BY created_at DESC')->fetchAll();
        loadView('listings/index', ['listings' => $listings]);
    }
    public function create()
    {
        loadView('listings/create');
    }
    public function show($params)
    {
        $id = $params ['id']??'';
        $params = ['id' => $id];
        $listing = $this->db->query('SELECT * FROM listing WHERE id = '.$id)->fetch();
        if (!$listing){
            ErrorController::notFound('该岗位不存在');
            return;
        }
        loadView('listings/show', ['listing' => $listing]);
    }
    public function store()
    {
        $alloweFields = ['title','description','salary','tags','company'
        ,'address','city','province','phone','email','requirements','benefits'];
        $newListingData = array_intersect_key($_POST,array_fill($alloweFields,null));
        $newListingData['user_id'] = Session::get('user')['id'];
        $newListingData = array_map('sanitize',$newListingData);
        $requiredFields = ['title','description','email','city','province'];
        $errors = [];
        foreach ($requiredFields as $field ){
            if(empty($newListingData[$field]) || !Validation::string($newListingData[$field])){
               $errors[$field] = ucfirst($field).'为必须项';
            }
        }
        if(empty($errors)){
            loadView('listings/create',[
                'errors' => $errors,
                'listing' => $newListingData
            ]);
        }else{
            $fields = [];
            foreach ($newListingData as $field => $value){
                $fields[]= $field;
            }
            $fields = implode(',',$fields);
            $value = [];
            foreach ($newListingData as $field => $value){
                if ($value ===''){
                    $newListingData[$field] = null;
                }
                $values[]=':'.$field;
            }
            $values = implode(',',$values);
            $query = "INSERT INTO listing({$fields}) VALUES ({$values})";
            $this->db->query($query,$newListingData);
            Session::setFlashMessage('success_message','已成功创建职位！');
            redirect('/listings');
        }
    }
    public function destroy($params)
    {
        $id = $params ['id'];
        $params = ['id' => $id];
        $listing = $this->db->query('SELECT * FROM listing WHERE id = :id',$params)->fetch();
        if (!$listing){
            ErrorController::notFound('职位不存在');
            return;
        }
        if (!Authorisation::isOwner($listing['user_id'])) {
            Session::setFlashMessage('error_message', '你没有权限删除职位!');
            return redirect('/public/listings/' . $listing['id']);
        }

        $this->db->query('DELETE FROM listing WHERE id = :id',$params);
        $_SESSION['success_message'] = "删除职位成功";
        redirect('/listings');
    }
    public function edit($params) {
        $id = isset($params['id']) ? $params['id'] : '';
        $params = [

            'id' => $id
        ];
        $listing = $this->db->query('SELECT * FROM listing WHERE id = :id', $params)->fetch();
        if (!$listing) {
            ErrorController::notFound("岗位不存在!");
            return;
        }
        loadView('listings/edit', [
            'listing' => $listing
        ]);

    }

    public function update($params) {
        $id = isset($params['id']) ? $params['id'] : '';
        $params = [
            'id' => $id
        ];
        $listing = $this->db->query('SELECT * FROM listing WHERE id = :id', $params)->fetch();
        if (!$listing) {
            ErrorController::notFound("The occupation does not exist!");
            return;
        }
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];
        $updateValues = array_intersect_key($_POST, array_flip($allowedFields));
        $updateValues = array_map('sanitize', $updateValues);
        $requiredFields = ['title', 'description', 'email', 'city', 'state'];
        $error = [];
        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
                $errors[$field] = ucfirst($field) . ' is required.';
            }
        }

        if (!empty($errors)) {
            loadView('listings/edit', [
                'errors' => $errors,
                'listing' => $updateValues
            ]);
            exit;
        } else {
            $updateFields = [];
            foreach (array_keys($updateValues) as $array_key) {
                $updateFields[] = $array_key . ' = :' . $array_key;
            }
            $updateFields = implode(', ', $updateFields);
            $updateQuery = "UPDATE listing SET {$updateFields} WHERE id = :id";
            $updateValues['id'] = $id;
            $this->db->query($updateQuery, $updateValues);
            $_SESSION['success_message'] = "职位信息已经更新!";
            redirect('/public/listings/'.$id);
        }
    }

    public function search()
    {
        $keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';
        $location = isset($_GET['location']) ? $_GET['location'] : '';

        $query = "SELECT * FROM listing WHERE  
                          (title LIKE :$keywords OR description LIKE :$keywords OR
                           tags LIKE :$keywords OR company LIKE :$keywords) AND 
                          (city LIKE :$keywords OR province LIKE :location)";

        $params = [
          'keywords' => "%{$keywords}%",
          'location' => "%{$location}%",
        ];

        $listings = $this->db->query($query,$params)->fetchAll();

        loadView('listings/index', [
            'listings' => $listings,
            'keywords' => $keywords,
            'location' => $location
        ]);
    }

}