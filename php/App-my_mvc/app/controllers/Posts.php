<?php
    class Posts extends Controller {

        public function __construct() {
            if(!isLogin()) {
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }
        public function index() {
            // Get posts
            $posts = $this->postModel->getPosts();

            $data = [
                'posts' => $posts
            ];
            $this->view('posts/index', $data);
        }

        public function add() {
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                // Validate data
                if(empty($data['title'])) {
                    $data['title_err'] = 'Introduce titlul';
                }

                if(empty($data['body'])) {
                    $data['body_err'] = 'Introduce continutul';
                }

                // Verifica erori
                if(empty($data['title_err']) && empty($data['body_err'])) {
                    // Validat
                    if($this->postModel->addPost($data)){
                        flash('post_message', 'Postare Adaugata');
                        redirect('posts');
                    }else {
                        die('Ceva este in neregula');
                    }
                }else {
                    // Load fara erori
                    $this->view('posts/add', $data);
                }

            }else {

                $data = [
                    'title' => '',
                    'body' => ''
                ];
                $this->view('posts/add', $data);
            }
        }

        public function show($id) {

            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
            $data = [
                'post' => $post,
                'user' => $user
            ];
            $this->view('posts/show', $data);
        }

        public function edit($id) {
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                // Validate data
                if(empty($data['title'])) {
                    $data['title_err'] = 'Introduce titlul';
                }

                if(empty($data['body'])) {
                    $data['body_err'] = 'Introduce continutul';
                }

                // Verifica erori
                if(empty($data['title_err']) && empty($data['body_err'])) {
                    // Validat
                    if($this->postModel->updatePost($data)){
                        flash('post_message', 'Postare Editata');
                        redirect('posts');
                    }else {
                        die('Ceva este in neregula');
                    }
                }else {
                    // Load fara erori
                    $this->view('posts/edit', $data);
                }

            }else {
                // Get post de la models
                $post = $this->postModel->getPostById($id);
                // Verifica autor
                if($post->user_id != $_SESSION['user_id']) {
                    redirect('posts');
                }
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                ];
                $this->view('posts/edit', $data);
            }
        }
        
        public function delete($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

               // Get post de la models
               $post = $this->postModel->getPostById($id);
               // Verifica autor
               if($post->user_id != $_SESSION['user_id']) {
                   redirect('posts');
               }
            
                if($this->postModel->deletePost($id)){
                    flash('post_message', 'Postare Stearasa');
                    redirect('posts');
                } else{
                    die('Ceva este inneregula');
                }
            }else {
                
                redirect('posts');
            }
        }
    }