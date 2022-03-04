<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With'); //stop XSS attacks

 include 'dbPDO.php'; 
 include 'Post.php'; 

 $database = new Database();
 $db = $database->connect();

//make reddit-esque post object
$post = new Post($db);

//this gets the raw input data for the post 
$data = json_decode(file_get_contents("php://input")); 


$post->title = $data->title;
$post->url = $data->url;
$post->body = $data->body;
$post->timestamp = $data->timestamp;




//set the data now make the post and comfirmation message 
if ($post->create()) {
    echo json_encode(array('message' => 'Post Created')); 
} else {
    echo json_encode(array('message' => 'Post Not Created'));
}

?> 