<?php
/* User login process, checks if user exists and password is correct */
$host = "ctoner28.lampt.eeecs.qub.ac.uk";
 $user = "ctoner28";
 $pw = "rMdwfTm1mY6ZQHSR";
 $db = "ctoner28";
 
 $mysqli = new mysqli($host, $user, $pw, $db);
 
 if ($mysqli->connect_error) {
 
      $check = "not connected ".$mysqli->connect_error;
 
        }
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['userloggedin'] = true;

        header("location: http://ctoner28.lampt.eeecs.qub.ac.uk/WSBcnd/home.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}
//references to guide my build:
//https://www.youtube.com/watch?v=WYufSGgaCZ8
//https://www.youtube.com/watch?v=LC9GaXkdxF8
//https://www.youtube.com/watch?v=Pz5CbLqdGwM&t=7s
//https://www.youtube.com/watch?v=Fu9ugKmxrzo&t=281s
//https://www.youtube.com/watch?v=-8q3GLkr9Ts
//https://www.youtube.com/watch?v=UAu7cMuu0BI
