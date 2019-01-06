<?php
    /*
    *PDO Databese Class
    *Se conecteaza la db
    *Returneazaq randuri si rezultate
    */
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;
 
        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            // SET DSN
            $dsn = 'mysql:host='. $this->host. ';dbname='. $this->dbname;
            // PDO optiuni
            // ATTR_PERSISTENT creste performata vericand daca s-a stabilit inainte o conexiune
            // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION pentru erori
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Instantiere PDO
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options); 
            }catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }


        // Pepare statement cu query
        public function query($sql) {
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Bind values uneste prametrii cu valorile
        public function bind($parms, $value, $type = null) {
            // Verifica tipul
            if(is_null($type)) {
                switch(true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindValue($parms, $value, $type);
        }

        // Executare prepare statement
        public function execute() {
            return $this->stmt->execute();
        }

        // Rezultat ca array de obiecte
        public function resultSet() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Rezultat ca un obiect pt un singur rand
        public function single() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Count randuri
        public function rowCount() {
            return $this->stmt->rowCount(); 
        }
    }