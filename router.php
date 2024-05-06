<?php
class Router{
    protected $routes = [];

    private function registerRoute($method,$uri,$controller)
    {
        $this->routes[]=[
            'method'=>$method,
            'uri'=>$uri,
            'controllers'=>$controller];
    }

    public function error($httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }

    //    添加get路由
public function addGet($uri,$controller){
       $this->registerRoute('GET',$uri,$controller);
}

//添加post路由
    public function addPost($uri,$controller)
    {
        $this->registerRoute('POST',$uri,$controller);
    }

    //添加DELETEL路由
    public function addDelete($uri,$controller){
        $this->registerRoute('DELETE',$uri,$controller);
    }

    public function route($uri,$method){
        foreach ($this->routes as $route){
            if ($route['uri']===$uri && $route['method']===$method){
                require basePath($route['controllers']);
                return;
            }
        }
    $this->error();
    }
}

