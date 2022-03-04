<?php

class Database {

    //start with the db params for entry 
    private $host = "ctoner28.lampt.eeecs.qub.ac.uk";
    private $user = "ctoner28";
    private $pw = "rMdwfTm1mY6ZQHSR";
    private $db = "ctoner28";
    private $conn;

   //now need to connect it 
   public function connect() {
       $this->conn = null; 

       try {
           $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pw);
           $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
              }
        
              return $this->conn;
   }
}

?> 
<!-- references -->
<!-- https://www.w3schools.com/php/php_mysql_connect.asp  -->
<!-- https://www.php.net/manual/en/book.pdo.php -->
