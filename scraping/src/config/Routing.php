<?php

class Routing {

    /**
     * @var array 
     */
    private $routes = [];

    /**
     * @var boolean 
     */
    private $error404 = false;

    /**
     * 
     * @param string $routeName
     * @param string $url
     * @param string $controller
     * @param string $method
     */
    public function initRoute($path, $controller, $method) {

        $this->routes[$path] = ["controller" => $controller, "method" => $method];
    }


    /**
     * 
     * @param string $url
     * @return array|bool
     */
    public function getControlleur($uri) {
        foreach ($this->routes as $path => $info) {
            if(preg_match('/^'.(str_replace('/', '\/', trim($path, '/'))).'$/', $uri, $matches)){
                if(isset($matches[1])){
                    $params = $matches[1];
                } else {
                    $params = '';
                }
                return [
                    $this->routes[$path]["controller"], 
                    $this->routes[$path]["method"], 
                    $params
                ];
            }
        }

        if(empty($matches)){
            return $this->error404 = true;
        }
    }

    /**
     * Retourne true s'il y a une erreur 404
     * @return boolean
     */
    public function isError404() {
        if ($this->error404 == true) {
            return true;
        }
        return false;
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
}