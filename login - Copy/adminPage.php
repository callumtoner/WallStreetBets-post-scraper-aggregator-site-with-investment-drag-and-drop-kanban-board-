<?php
session_start(); 
if(!isset($_SESSION['loggedin'])) {
    header("location:index.php"); 
}

?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Document</title>
</head>

<body>
    <!-- ADD NEW POST TO DATABASE -->
    <section class="addPost">
    <div class="addPostcontainer">
    
    <h2>Add New Post </h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="addPostform">
            <input type="submit" name="addPost" id="" value="Submit / Reset Section">           
        </form>



    <?php
        if(isset($_POST['addPost'])){ //STEP 1 - ENTER NEW POST DETAILS
            echo "
            <form method=\"POST\" name=\"editform\">            
            <input type=\"text\" name=\"title\" id=\"title\" placeholder=\"Enter post title\">
            <input type=\"text\" name=\"url\" id=\"url\" placeholder=\"Enter Post URL\">
            <input type=\"text\" name=\"body\" id=\"body\" placeholder=\"Enter Body Text\">
            <input type=\"text\" name=\"timestamp\" id=\"timestamp\" placeholder=\"Enter timestamp\">   
            <br><br>    
            <input type=\"submit\" name=\"submitPost\"  value=\"Add to Database\">
            <input type=\"reset\" name=\"resetaddform\">
            </form>
            ";
        }

        if(isset($_POST['submitPost'])){//STEP 2 - PROCESS NEW DETAILS TO API
            echo "working "; 
            $title = $_POST['title'];
            $url = $_POST['url'];
            $body = $_POST['body'];
            $timestamp = $_POST['timestamp'];
            
             
            
        // API URL
        $url1 = 'http://ctoner28.lampt.eeecs.qub.ac.uk/WSBcnd/createPost.php';

        // Create a new cURL resource
        $ch = curl_init($url1);

        // Setup request to send json via POST
        $data = array(
                    'title'=>$title,
                    'url'=>$url,
                    'body'=>$body,
                    'timestamp'=>$timestamp
                );
        $payload = json_encode($data);
        

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);



          }
    
    ?>
    </div>   
    </section>



    <!-- ADD NEW POST TO DATABASE -->
    <section class="addPost">
    <div class="addPostcontainer">
    
    <h2> Update Post </h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="updatePostform">
            <input type="submit" name="updatePost" id="" value="Submit / Reset Section">           
        </form>



    <?php
        if(isset($_POST['updatePost'])){ //STEP 1 - UPDATE POST DETAILS
            echo "
            <form method=\"POST\" name=\"editform\">  
            <input type=\"text\" name=\"id\" id=\"id\" placeholder=\"Enter post ID\">          
            <input type=\"text\" name=\"title\" id=\"title\" placeholder=\"Enter post title\">
            <input type=\"text\" name=\"url\" id=\"url\" placeholder=\"Enter Post URL\">
            <input type=\"text\" name=\"body\" id=\"body\" placeholder=\"Enter Body Text\">
            <input type=\"text\" name=\"timestamp\" id=\"timestamp\" placeholder=\"Enter timestamp\">   
            <br><br>    
            <input type=\"submit\" name=\"submitUpdatePost\"  value=\"Add to Database\">
            <input type=\"reset\" name=\"resetaddform\">
            </form>
            ";
        }

        if(isset($_POST['submitUpdatePost'])){//STEP 2 - PROCESS NEW DETAILS TO API
            echo "working "; 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $url = $_POST['url'];
            $body = $_POST['body'];
            $timestamp = $_POST['timestamp'];
            
             
            
        // API URL
        $url1 = 'http://ctoner28.lampt.eeecs.qub.ac.uk/WSBcnd/updatePost.php';

        // Create a new cURL resource
        $ch = curl_init($url1);

        // Setup request to send json via POST
        $data = array(
                    'id'=>$id,
                    'title'=>$title,
                    'url'=>$url,
                    'body'=>$body,
                    'timestamp'=>$timestamp
                );
        $payload = json_encode($data);
        

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);



          }

    ?>
    
    </div>   
    </section>

    <!-- DELETE POST IN DATABASE -->
    <section class="addPost">
    <div class="addPostcontainer">
    
    <h2> Delete Post </h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="deletePostform">
            <input type="submit" name="deletePost" id="" value="Submit / Reset Section">           
        </form>



    <?php
        if(isset($_POST['deletePost'])){ //STEP 1 - DELETE POST DETAILS
            echo "
            <form method=\"POST\" name=\"editform\">  
            <input type=\"text\" name=\"id\" id=\"id\" placeholder=\"Enter post ID\">             
            <br><br>    
            <input type=\"submit\" name=\"submitDeletePost\"  value=\"Add to Database\">
            <input type=\"reset\" name=\"resetaddform\">
            </form>
            ";
        }

        if(isset($_POST['submitDeletePost'])){//STEP 2 - PROCESS NEW DETAILS TO API
            echo "working "; 
            $id = $_POST['id'];
            
             
        // API URL
        $url1 = 'http://ctoner28.lampt.eeecs.qub.ac.uk/WSBcnd/deletePost.php';

        // Create a new cURL resource
        $ch = curl_init($url1);

        // Setup request to send json via POST
        $data = array(
                    'id'=>$id
                );
        $payload = json_encode($data);
        

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);



          }

    ?>
    
    </div>   
    </section>


<script src="../js/admin.js"></script>
</body>

</html>