<?php

    /*
    *Controller de baza
    *incarca medels si views
    */
    class Controller {
        
        // Load model
        public function model($model) {
            // Require model file
            require_once '../app/models/'. $model . '.php';

            // Instantierea model
            return new $model();
        }

        // Load view
        public function view($view, $data = []) {
            // Verifica fisierul daca exista
            if(file_exists('../app/views/'. $view . '.php')) {   
               require_once '../app/views/'. $view . '.php';
            }else {
                die('View nu exista');
            }
        }
    }