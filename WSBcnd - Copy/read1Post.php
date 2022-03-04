<?php

//headers
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 
 
include 'dbPDO.php';
include 'Post.php'; 

$database = new Database(); 
$db = $database->connect();  
$post = new Post($db); 

//--------------------------
$post->id = isset($_GET['id']) ? $_GET['id'] : die(); 

//get the single post 
$post->read_post(); 

//make array for the single post object 
$post_singleArr = array(
    'id' => $post->id, 
    'title' => $post->title, 
    'url' => $post->url,
    'body' => $post->body, 
    'timestamp' => $post->timestamp
);

//make json
echo json_encode($post_singleArr); 



?> 