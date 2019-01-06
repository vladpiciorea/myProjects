<?php 
    class Users extends Controller{

        public function __construct() {
            // Verifica folderul models daca fisierul user exista si il incarca
            $this->userModel = $this->model('User');
        }

        public function register() {
            // Verifica daca este post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // PROCESS form

                // Sanitize Post data
                $_POST =  filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])) {
                    $data['email_err'] = 'Te rog introduce un email';
                } 

                 // Validate Name
                 if(empty($data['name'])) {
                    $data['name_err'] = 'Te rog introduce un nume';
                }else {
                    // Verifica email
                    if($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'Adresa de email introdusa exista';
                    }
                }

                
                 // Validate Password
                 if(empty($data['password'])) {
                    $data['password_err'] = 'Te rog introduce o parola';
                } elseif(strlen($data['password']) < 6) {
                    $data['password_err'] = 'Te rog introduce o parola mai mare de 6 caractere';
                }

                 // Validate Confirm password
                 if(empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Te rog confirma parola';
                } else {
                    if($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Parolele nu se potrivesc';
                    }
                }
            
              
                // verifica daca erorile sunt goale
                if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    // Validate
                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    
                    // Register User
                    if($this->userModel->register($data)){
                            flash('register_success','Esti inregistrat');
                        	redirect('users/login');
                    }else {
                        die('Ceva nu este in regula');
                    }
                } else {
                    // load view cu errori
                    $this->view('users/register', $data);
                }


            } else {
                // Load form
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // Load view
                $this->view('users/register', $data);
            }
        }

        public function login() {
            // Verifica daca este post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // PROCESS form
                // Sanitize Post data
                $_POST =  filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [  
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),            
                    'email_err' => '',
                    'password_err' => '',
                    
                ];

                // Validate Email
                if(empty($data['email'])) {
                    $data['email_err'] = 'Te rog introduce un email';
                }elseif($this->userModel->findUserByEmail($data['email'])) {
                    // User found
                }else {
                    // User not found
                    $data['email_err'] = 'Adresa de Email este gresita';
                }

                // Validate Password
                if(empty($data['password'])) {
                    $data['password_err'] = 'Te rog introduce o parola';
              }

                // verifica daca erorile sunt goale
                    if(empty($data['email_err'])  && empty($data['password_err'] )) {
                        // Validate
                        // Verifica si seteaza loggedin user
                        $loggedInUser = $this->userModel->login($data['email'],$data['password']);

                        if($loggedInUser) {
                            // Create Session
                            $this->createUserSession($loggedInUser);
                        }else {
                            $data['password_err'] = 'Parola incorecta';
                            $this->view('users/login', $data);
                        }
                    } else {

                        // load view cu errori
                        $this->view('users/login', $data);
                    }
                
            } else {
                // Load form
                // Init data
                $data = [  
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                // Load view
                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }

    }