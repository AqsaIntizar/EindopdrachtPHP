<?php 

    if (isset($_COOKIE['loggedin'])){
        
    } else{
        header('Location: login.php');
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>includeFood - Home</title>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>
    <div class="feed">
    <div class="addContent"><a href="newPost.php">Add some fresh content here</a></div>
    <!-- start lus -->
    <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, consequatur. Debitis odio atque fuga quas animi repellat non. Debitis consequatur exercitationem expedita placeat qui corporis eaque dolores odit animi nemo?</p>
    </div>
    <!-- einde lus -->
    <!-- for testing grid -->
    <!-- <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div>
    <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div>
    <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div>
    <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div> -->
    </div>
</body>
</html>