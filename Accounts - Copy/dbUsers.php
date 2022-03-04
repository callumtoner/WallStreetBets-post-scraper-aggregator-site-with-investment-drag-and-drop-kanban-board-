<?php
 
 $host = "ctoner28.lampt.eeecs.qub.ac.uk";
 $user = "ctoner28";
 $pw = "rMdwfTm1mY6ZQHSR";
 $db = "ctoner28";
 
 $mysqli = new mysqli($host, $user, $pw, $db);
 
 if ($mysqli->connect_error) {
 
      $check = "not connected ".$mysqli->connect_error;
 
        }


//create users table with all the fields
$mysqli->query('
CREATE TABLE `ctoner28`.`users` 
(
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
   `last_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `hash` VARCHAR(32) NOT NULL,
  `active` BOOL NOT NULL DEFAULT 0,
PRIMARY KEY (`id`) 
);') or die($mysqli->error);


 
?>
