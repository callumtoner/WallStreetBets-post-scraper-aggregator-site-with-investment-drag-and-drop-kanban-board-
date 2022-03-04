<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: DELETE');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With'); //stop XSS attacks

 include 'dbPDO.php'; 
 include 'Post.php'; 

 $database = new Database();
 $db = $database->connect();

//make reddit-esque post object
$post = new Post($db);

//this gets the raw input data for the post - in this case just the id for deletion 
$data = json_decode(file_get_contents("php://input")); 

//get the id to update that post, therefore -
$post->id = $data->id; 



//delete the post and run the method 
if ($post->delete()) {
    echo json_encode(array('message' => 'Deleting...')); 
} else {
    echo json_encode(array('message' => 'Could not delete'));
}

?> 