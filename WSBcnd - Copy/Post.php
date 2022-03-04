<?php

class Post {


private $conn;
private $table = 'WSB';

public $id; 
public $title; 
public $url; 
public $body;
public $timestamp; 

//constructor should link to the included db file and work
public function __construct($db) {
    $this->conn = $db; 
}

//-------------------------- read in a single post by get request 
public function read_post() {
    // Create query
    $query = 'SELECT id, title, url, body, timestamp
                              FROM ' . $this->table .'
                              WHERE id = ? LIMIT 0,1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC); 

    // Set properties
    $this->title = $row['title'];
    $this->body = $row['body'];
    $this->url = $row['url'];
    $this->id = $row['id'];
    $this->timestamp = $row['timestamp'];
}
//----------------------------------------

public function create() {

    $query = ' INSERT INTO ' . $this->table . ' SET title = :title, url = :url, body = :body, timestamp = :timestamp'; 


    $stmt = $this->conn->prepare($query); 

    //add security to data
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->url = htmlspecialchars(strip_tags($this->url)); 
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->timestamp = htmlspecialchars(strip_tags($this->timestamp)); 

    //bind the data onto the attributes 
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':url', $this->url);
    $stmt->bindParam(':body', $this->body);
    $stmt->bindParam(':timestamp', $this->timestamp);

    //run it 
    if ($stmt->execute()) {
        return true; 
    }

    //error handle 
    printf("Error - %s.\n", $stmt->error);

    //defualt 
    return false; 
}
//-----------------------ends create mew post method 


//UPDATE THE POST 
public function update() {

    $query = ' UPDATE ' . $this->table . ' SET title = :title, url = :url, body = :body, timestamp = :timestamp WHERE id = :id'; 


    $stmt = $this->conn->prepare($query); 

    //add security to data
    $this->id = htmlspecialchars(strip_tags($this->id)); 
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->url = htmlspecialchars(strip_tags($this->url)); 
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->timestamp = htmlspecialchars(strip_tags($this->timestamp)); 


    //bind the data onto the attributes 
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':url', $this->url);
    $stmt->bindParam(':body', $this->body);
    $stmt->bindParam(':timestamp', $this->timestamp);

    //run it 
    if ($stmt->execute()) {
        return true; 
    }

    //error handle 
    printf("Error - %s.\n", $stmt->error);

    //defualt 
    return false; 
}
//---------------------------ends update 


//delete a post from db 
public function delete() {
    //create the sql 
    $query = ' DELETE FROM ' . $this->table . ' WHERE id = :id'; 

    //arrage id data for ability to delete 
    $stmt = $this->conn->prepare($query);
    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id', $this->id);

    //run it 
    if ($stmt->execute()) {
        return true; 
    }

    //error handle 
    printf("Error - %s.\n", $stmt->error);

    //defualt 
    return false; 
}


}




?> 