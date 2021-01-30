<?php

class Routes {

    /**
     * @var array 
     */
    private $routes = [];

     /**
     * @var array 
     */
    private $routesUrl = [];


     /**
     * @var array 
     */
    private $routesName = [];

    /**
     * @var integer 
     */
    private $idRoutes = 0;

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
    public function initRoute($routeName, $url, $controller, $method) {

        $this->idRoutes++;
        $this->routesName[$routeName] = $this->idRoutes;
        // $newUrl = preg_replace('#/:([\w]+)#', '', $url);
        // $params = preg_replace('#^(.*)/:#', '', $url);
        $this->routesUrl[$url] = $this->idRoutes;
        $this->routes[$this->idRoutes] = ["name" => $routeName, "url" => $url, "controller" => $controller, "method" => $method];
    }


    /**
     * 
     * @param string $url
     * @return array|bool
     */
    public function getControlleur($url) {
        $url = preg_replace('#/:([\w]+)#', '', $url);
        if (array_key_exists($url, $this->routesUrl)) {
            return [
                    $this->routes[$this->routesUrl[$url]]["controller"], 
                    $this->routes[$this->routesUrl[$url]]["method"], 
                    $this->routes[$this->routesUrl[$url]]["url"],
                ];
        } else {
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