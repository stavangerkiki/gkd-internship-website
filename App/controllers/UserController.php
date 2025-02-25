<?php

namespace App\controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class UserController {
    protected $db;

    /**
     * @return mixed
     */
    public function __construct() {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function login() {
        loadView('users/login');
    }

    public function register() {
        loadView('users/register');
    }

    public function store($userId) {
        // Retrieve users data from POST request
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];

        // Initialize an array to store possible error messages
        $errors = [];

        // Validate if email is valid
        if (!Validation::email($email)) {
            $errors['email'] = '输入合法的email!';
        }

        // Validate if name is between 2 to 50 characters
        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = '名字2-50!';
        }

        // Validate if password length is at least 6 characters
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = '密码最少6位!';
        }

        // Validate if password and confirmation password match
        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = '这两个密码不一样!';
        }

        // Check if there are validation errors
        if (!empty($errors)) {
            // If there are errors, reload the registration page and display the error messages
            loadView('users/register', [
                'errors' => $errors,
                'users' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'province' => $province,
                ]
            ]);
            // Terminate further execution
            exit;
        } else {
            // Check if the email already exists
            $params = [
                'email' => $email, // Use email as a query parameter
            ];

            // Execute query to see if the same email already exists in the database
            $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

            if ($user) {
                $errors['email'] = '该电子邮件已经注册过了!'; // Add error message

                // Reload the registration page and display the error message
                loadView('users/create', [
                    'errors' => $errors
                ]);

                // Terminate further execution
                exit;
            }

            // Create user account
            $params = [
                'name' => $name,
                'email' => $email,
                'city' => $city,
                'province' => $province,
                'password' => password_hash($password, PASSWORD_DEFAULT) // Hash the password
            ];

            // Execute SQL insert operation to store new user data into the database
            $this->db->query('INSERT INTO users (name, email, city, province, password) VALUES (:name, :email, :city, :province, :password)', $params);

            Session::set('user', [
                'id' => $userId,
                'name' => $name,
                'email' => $email,
                'city' => $city,
                'province' => $province,
            ]);

            // Redirect to the homepage upon successful user creation
            redirect('/public');
        }
    }

    public function logout() {
        // Call the clearAll method of the Session class to clear all session data
        Session::clearAll();

        // Retrieve the parameters of the session cookie
        $params = session_get_cookie_params();
        // Delete the session cookie by setting its expiration time to one day in the past, ensuring the browser removes the cookie
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        // Redirect to the website homepage
        redirect('/public');
    }

    public function authenticate() {
        // Retrieve email and password from POST request
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Initialize error messages array
        $errors = [];

        // Validate email format
        if (!Validation::email($email)) {
            $errors['email'] = '请输入一个有效的电子邮件地址!';
        }

        // Validate password length (at least 6 characters, maximum 50 characters)
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = '密码长度必须至少为6个字符!';
        }



        // If there are validation errors, reload the login page and display the errors
        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }



        // Prepare query parameters to search for email
        $params = [
            'email' => $email
        ];

        // Query the database for the user
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();


        // If no user is found, indicate that the email or password is incorrect
        if (!$user) {
            $errors['email'] = '用户不存在或密码不正确!';
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Validate if the password is correct
        if (is_array($user)) {  // Ensure $user is an array
            if ($password!=$user['password']) {
                $errors['email'] = '用户不存在或密码不正确!';
                loadView('users/login', [
                    'errors' => $errors
                ]);
                exit;
            }
            // Password is correct, proceed with login
        }

        // If validation passes, set the user session information
        if ($user) {
            Session::set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'city' => $user['city'],
                'province' => $user['province']
            ]);

            redirect('/public');
        } else {
            // Handle the case where no user was found
            inspectAndDie("NOTING!!!");
        }
    }


}
