<?php
    //require_once("classes/Db.class.php");
    //require_once("classes/Post.class.php");

    //session_start();
    require_once("bootstrap.php");
    if( isset($_SESSION['User']) ){
        //logged in user
        //echo "😁";
    }else{
        //no logged in user
        //echo "😒";
        header('Location: login.php');
    }
    $userName = $_SESSION['UserName'];
    if( isset($_POST['uploadPost']) ){
        //echo "test ";
        //echo $_SERVER['REQUEST_METHOD'] . " ";
        if( !empty($_POST['description']) ){
            $post = new Upload;
            $post->setFileName($_FILES['imageFile']['name']);
            $post->setFileType($_FILES['imageFile']['type']);
            $post->setFileTempName($_FILES['imageFile']['tmp_name']);
            $post->setFileSize($_FILES['imageFile']['size']);
            $post->setTargetDir("images/posts/");

            $post->setDescription($_POST['description']);
            $post->setUserId($_SESSION['Id']);

            $result = $post->uploadPost($userName);
            header('Location: index.php');
        }else{
            $newPostError = true;
        }
        
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
            <?php if( isset($newPostError ) ): ?>
                <div class="form__error">
                    <p>
                        Sorry, you need to fill in the description.
                    </p>
                </div>
            <?php endif; ?>
            <label for="description">Add a description</label>
            <input type="text" id="description" name="description">
        <input type="submit" name="uploadPost" value="Upload post">
        </form>
    </div>
</body>
</html>