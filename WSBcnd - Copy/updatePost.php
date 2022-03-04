<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With'); //stop XSS attacks

 include 'dbPDO.php'; 
 include 'Post.php'; 

 $database = new Database();
 $db = $database->connect();

//make reddit-esque post object
$post = new Post($db);

//this gets the raw input data for the post 
$data = json_decode(file_get_contents("php://input")); 

//get the id to update that post, therefore -
$post->id = $data->id; 

$post->title = $data->title;
$post->url = $data->url;
$post->body = $data->body;
$post->timestamp = $data->timestamp;

//set the data now update the post and comfirmation message 
if ($post->update()) {
    echo json_encode(array('message' => 'Post Updated')); 
} else {
    echo json_encode(array('message' => 'Post Not Updated'));
}

?> 