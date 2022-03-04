<?php
session_start(); 
if(!isset($_SESSION['userloggedin'])) {
    header("location:http://ctoner28.lampt.eeecs.qub.ac.uk/Accounts/index.php"); 
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSB posts watcher</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="WSB.png">
</head>
<body>
    
    <!-- Loader -->
    <div class="loader hidden">
        <img src="rocket.svg" alt="Rocket Loading Animation">
    </div>
    <!-- Container -->
    <div class="container">
        <!-- Navigation -->
        <div class="navigation-container">
            <span class="background"></span>
            <!-- Results Nav -->
            <span class="navigation-items" id="resultsNav">
                <h2 class="homeTitle">WallStreetBets Recent Posts</h2>
                <a class="clickable" href="http://ctoner28.lampt.eeecs.qub.ac.uk/Accounts/logout.php" target="_self"><h5>logout</h5></a>
                <h5>&nbsp;&nbsp;&nbsp;</h5>
                <a class="clickable" href="http://ctoner28.lampt.eeecs.qub.ac.uk/login/index.php" target="_blank"><h5>Admin</h5></a>
                <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                <h3 class="clickable" onclick="updateDOM('favourites')">Favourites</h3>
                <h3>&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;</h3>
                <h3 class="clickable" onclick="getwsbPosts()">More Posts</h3>
                <h3>&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;</h3>
                <a class="clickable" href="WSBKanban.php" target="_blank"><h3>WSB Kanban Board</h3></a>
            </span>
            <!-- Favourites Nav -->
            <span class="navigation-items hidden" id="favouritesNav">
                <h3 class="clickable" onclick="getwsbPosts()">Load More posts</h3>
            </span>
        </div>
        <!-- Posts Container -->
        <div class="images-container"></div>
    </div>
    <!-- background theme toggle -->
    <div class="background-toggles" title="change background">
        <div class="background-1" onclick="changeBackground('1')"></div>
        <div class="background-2" onclick="changeBackground('2')"></div>
        <div class="background-3" onclick="changeBackground('3')"></div>
    </div>
        <!-- Save Confirmation -->
    <div class="save-confirmed" hidden>
        <h1>ADDED!</h1>
    </div>
    
   
        
    
    <script src="script.js"></script>
</body>
</html>
