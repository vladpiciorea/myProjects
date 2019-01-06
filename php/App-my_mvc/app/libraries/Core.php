<?php
    /*
    *App Core Class
    *Creaza URL & incarca controllerul principal
    *URL FORMAT - /controller/method/params
    *se face despartirea dupa / si astfel $url[0] = controller $url[1]=methoda restu parametrii
    */
    class Core {
        // Controllerul pe care il va incarca default
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $parmas = []; 

        public function __construct() {

            // print_r($this->getUrl());
            $url = $this->getUrl();

            // Cauta controllerul de la primnul index
            if(file_exists('../app/controllers/'. ucwords($url[0]) . '.php')) {

                // Daca exista seteaza ca si controller
                $this->currentController = ucwords($url[0]);
                // Unset Index 0
                unset($url[0]);
            }

            // Require controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            // Instantiaza controllerul
            $this->currentController = new $this->currentController;

            // Verifica daca exista o metoda
            if(isset($url[1])) {
                // Verifica daca metoda exista in controller 
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset Index 1
                    unset($url[1]);
                }
            }
           
            //Adauga parametrii daca exista
            $this->parmas = $url ? array_values($url) : [];
            // Foremeasa un arra de tipul [[controller, metoda], [parametrii]]
            call_user_func_array([$this->currentController, $this->currentMethod], $this->parmas);

        }

        public function getUrl() {

            if(isset($_GET['url'])) {

                // sterge ultimul /
                $url= rtrim($_GET['url'], '/');
                // Il senitizez ca un url
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }