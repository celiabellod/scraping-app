<?php

class Routing {

    /**
     * @var array 
     */
    private $routes = [];

    /**
     * 
     * @param string $routeName
     * @param string $url
     * @param string $controller
     * @param string $method
     */
    public function initRoute($path, $controller, $method, $autorization = null) {

        $this->routes[$path] = ["controller" => $controller, "method" => $method, "autorization" => $autorization];
    }


    /**
     * @param string $url
     * @return array|bool
     */
    public function getControlleur($uri) {
        $params = [];
        foreach ($this->routes as $path => $info) {
            if(preg_match('/^'.(str_replace('/', '\/', trim($path, '/'))).'$/', $uri, $matches)){
                unset($matches[0]); 
                if($matches){
                    if($matches[1]){
                        $params['extractionId'] = $matches[1];
                    }
                    if(isset($matches[2]) && !empty($matches[2])){
                        $params['historicId'] = $matches[2];
                    }
                }
                if($this->routes[$path]["autorization"] == "admin"){
                    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                        return [
                            $this->routes[$path]["controller"], 
                            $this->routes[$path]["method"], 
                            $params
                        ];
                    } else {
                        header('Location:/login');
                    }
                } else {
                    return [
                        $this->routes[$path]["controller"], 
                        $this->routes[$path]["method"], 
                        $params
                    ];
                }
               
            }
        }

        header('Location:/404');
    
    }

    /**
     * Get the value of routes
     *
     * @return  array
     */ 
    public function getRoutes()
    {
        return $this->routes;
    }

    public function get404() {

    }
}