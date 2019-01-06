<?php 

    class Pages extends Controller {
        public function __construct() {
            
        }

        // pentru a evita call_user_func_array() expects parameter 1 to be a valid callback, class 'Pages' does not have a method 'index' 
        public function index() {

            if(isLogin()) {
                redirect('posts');
            }
            
            // Deoarece extinde class Controller avem acces la metodele din aceasta view si model
            // Exemplu de transmitere de date
            $data = [
                'title' => 'Welcome',
                'description' => 'Simplu blog facut cu my mvc'
            ];
            $this->view('pages/index',$data);
        }

        public function about() {
            $data = [
                'title' => 'About',
                'description' => 'Informatii despre noi'
            ];
            $this->view('pages/about', $data);
        }
    }