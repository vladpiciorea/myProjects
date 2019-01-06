<?php 

    class ProductsController {

        private $input;
        private $filtred_input;
        private $products;
        private $api;

        public function __construct() {
            
            $this->input = empty($_REQUEST)? false : $_REQUEST;
            $this->api = isset($_REQUEST)? true : false;

        }
        
        public function process_page() {
    
            if (!$this->api) {
                if ($this->input !== false) {
                    $check_token = Utils::check_token($this->input);
                    if (!$check_token) {
                        die();
                    };
                    $this->process_request();
                    // acesam model
                    $this->products = ProductsModel::getFilteredProducts($this->filtred_input);

                } else {

                    // doar pt functii statice pt cele var se face cu new
                    $this->products = ProductsModel::getALLProducts();

                }
                $token = TokenModel::generateToken();
                FilterView::generateOutput($this->input, $token);
                ProductsView::generateOutput($this->products);
            }else {

                $this->process_request();
                $this->products = ProductsModel::getALLProducts();
                ApiView::generateOutput($this->products);
            }
        
        }

        private function process_request() {

            $string_keys = array('search', 'culoare');
            $numeric_key = array('pret_max');

            foreach($this->input as $key => $value) {

                if(in_array($key, $string_keys)) {

                    $value = trim(strip_tags($value));
                  
                } elseif(in_array($key, $numeric_key)) {

                    $value = str_replace(array(' ', ','), array('','.'), $value);
                    $value = (float) $value;
                   
                }
                $this->filtred_input[$key] = $value;
            }

          
        }
    }