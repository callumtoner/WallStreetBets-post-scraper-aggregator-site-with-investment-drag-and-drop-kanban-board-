<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
$host = "ctoner28.lampt.eeecs.qub.ac.uk";
 $user = "ctoner28";
 $pw = "rMdwfTm1mY6ZQHSR";
 $db = "ctoner28";
 
 $mysqli = new mysqli($host, $user, $pw, $db);
 
 if ($mysqli->connect_error) {
 
      $check = "not connected ".$mysqli->connect_error;
 
        }
 
// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash ) " 
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        // $_SESSION['message'] =
                
        //          "Confirmation link has been sent to $email, please verify
        //          your account by clicking on the link in the message! thanks!";

        

        
        require 'PHPMailer/PHPMailerAutoload.php'; 
        require 'PHPMailer/class.smtp.php';
        require 'PHPMailer/class.phpmailer.php';
        $mail = new PHPMailer(); 
        try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP(); 
        $mail->SMTPAuth = true; 
        //$mail->SMTPSecure = 'tls'; 
        $mail->Host = 'smtp.qub.ac.uk';
        $mail->Port = 587;
        $mail->Username = '40138687@ads.qub.ac.uk';
        $mail->Password = 'EptjYBreL2';
        $mail->Subject = 'authenticate'; 
        $mail->setFrom('40138687@ads.qub.ac.uk');
        $mail->AddAddress($email);
        $mail->AddAddress('callumtoner222@outlook.com');
        $mail->body = '
        Hello '.$first_name.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://ctoner28.lampt.eeecs.qub.ac.uk/Accounts/verify.php?email='.$email.'&hash='.$hash;


        $mail->Send(); 
        } catch (Exception $e) {
            echo 'mail error:' . $mail->ErrorInfo; 
        }


         header("location: http://ctoner28.lampt.eeecs.qub.ac.uk/WSBcnd/home.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}