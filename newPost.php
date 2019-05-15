<?php
    require_once 'bootstrap/bootstrap.php';

    if (isset($_SESSION['user'])) {
        //logged in user
        //echo "😁";
    } else {
        //no logged in user
        //echo "😒";
        header('Location: login.php');
    }
    $userName = $_SESSION['user']['id'];
    if (isset($_POST['uploadPost'])) {
        //echo $_SERVER['REQUEST_METHOD'] . " ";
        if (!empty($_POST['description'])) {
            $post = new Upload();
            $post->setFileName($_FILES['imageFile']['name']);
            $post->setFileType($_FILES['imageFile']['type']);
            $post->setFileTempName($_FILES['imageFile']['tmp_name']);
            $post->setFileSize($_FILES['imageFile']['size']);
            $post->setTargetDir('images/posts/');
            $post->setDescription($_POST['description']);
            $post->setUserId($_SESSION['user']['id']);
            date_default_timezone_set('Europe/Brussels'); //set timezone for correct date
            $post->setDateTime(date('Y-m-d H:i:s'));

            $result = $post->uploadPost($userName);
            header('Location: index.php');
        } else {
            $newPostError = true;
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/addpost.css">
    <title>IncludeFood - New Post</title>
</head>
<body>
    <section class="newPost">
        <h1>Food up the Feed!</h1>
        <h2>Add some new content here</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <p>
                <input class="addcontent" type="file" name="imageFile" id="file" data-multiple-caption="{count} files selected" multiple >
                <label for="file">Choose a file</label>
                <script>var inputs = document.querySelectorAll( '.inputfile' );
 
 Array.prototype.forEach.call( inputs, function( input ) {
   var label = input.nextElementSibling,
               labelVal = label.innerHTML;
  
   input.addEventListener( 'change', function( e ) {
     var fileName = '';
      
     if ( this.files &amp;&amp; this.files.length > 1 ) {
       fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
     } else {
       fileName = e.target.value.split( '\\' ).pop();
     }
  
     if ( fileName ) {
       label.querySelector( 'span' ).innerHTML = fileName;
     } else {
       label.innerHTML = labelVal;
     }
   });
 });</script>
            </p>
            <?php if (isset($newPostError)): ?>
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
</section>
</body>
</html>