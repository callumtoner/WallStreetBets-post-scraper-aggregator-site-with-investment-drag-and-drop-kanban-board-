<?php
 
 $host = "ctoner28.lampt.eeecs.qub.ac.uk";
 $user = "ctoner28";
 $pw = "rMdwfTm1mY6ZQHSR";
 $db = "ctoner28";
 
 $conn = new mysqli($host, $user, $pw, $db);
 
 if ($conn->connect_error) {
 
      $check = "not connected ".$conn->connect_error;
 
        }
 
?>
