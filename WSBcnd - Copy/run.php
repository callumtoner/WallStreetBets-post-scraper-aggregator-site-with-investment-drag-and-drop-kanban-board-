<?php

include("db.php"); 
//copies and prints the db file here 


$file = "reddit_wsb.csv"; 

if (file_exists($file)) {

    $filepath = fopen($file, "r"); 

    while (($line = fgetcsv($filepath)) !== FALSE) {

        $insert = "INSERT INTO WSB (title, url, body, timestamp) 
        VALUES ('{$line[0]}', '{$line[3]}', '{$line[6]}', '{$line[7]}')"; 
        //check quote marks if doesnt work

        $result = $conn->query($insert); 
        //pushges to phpmyadmin

        if (!$result) {
            echo $conn->error; 
            die(); 
        }
    }//ends while
}//ends if error checking


//-----------------------------was playing with second entry method, accepts but does not load data 
// $file = "reddit_wsb.csv";
// $filepath = fopen($file, "r");
// $line = fgetcsv($filepath);

// $query = <<<eof
//     LOAD DATA INFILE 'reddit_wsb.csv'
//      INTO TABLE WSB (title, url, body, timestamp)
//      VALUES ('{$line[0]}', '{$line[3]}', '{$line[6]}', '{$line[7]}')"
//      FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
//      LINES TERMINATED BY '\n'
     
// eof;

// $conn->query($query);