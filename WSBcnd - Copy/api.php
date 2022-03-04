<?php

//headers
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 

include 'db.php'; 

//dynamically gets the offset set in the url api request and assigns it to the offset, this is then used dynamically in javascript!
$flag = $_GET["offset"]; 


//post object 
$sqlread = "SELECT * FROM WSB LIMIT 10 OFFSET $flag";
    
 $result = $conn->query($sqlread); 
    
 if(!$result) {
    echo $conn->error; 
    }

$posts_arr = array(); 
$posts_arr1 = array(); 
//['data']

// connecting to database to get table information 
 while($row = $result->fetch_assoc()) {
     extract($row); 
        $post_item = array(
            'id' => $id,
            'title' => $title, 
            'url' => $url, 
            'body' => html_entity_decode($body), 
            'timestamp' => $timestamp
        );
        //going to push the array object into the posts array
        array_push($posts_arr1, $post_item); 
        //['data']
     }


     //turn it to JSON 
     echo json_encode($posts_arr1); 
     
?>