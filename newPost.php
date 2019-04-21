<?php
    //require_once("classes/Db.class.php");
    //require_once("classes/Post.class.php");

    //session_start();
    require_once("bootstrap.php");
    if( isset($_SESSION['User']) ){
        //logged in user
        echo "😁";
    }else{
        //no logged in user
        echo "😒";
    }

    if( isset($_POST['uploadImage']) ){
        //echo "test ";
        //echo $_SERVER['REQUEST_METHOD'] . " ";
        $post = new Post;
        $post->setFileName($_FILES['imageFile']['name']);
        $post->setFileType($_FILES['imageFile']['type']);
        $post->setFileTempName($_FILES['imageFile']['tmp_name']);
        $post->setFileSize($_FILES['imageFile']['size']);
        $post->setTargetDir("images/posts/");

        $post->setDescription($_POST['description']);

        $result = $post->uploadPost();

    }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>incFood</title>
</head>
<body>
    <div class="newPost">
        <h1>Food up the Feed!</h1>
        <h2>Add some new content here</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <p>
                File: <input type="file" name="imageFile">
            </p>
            <label for="description">Add a description</label>
            <input type="text" id="description" name="description">
        <input type="submit" name="uploadImage" value="Upload image">
        </form>
    </div>
</body>
</html>