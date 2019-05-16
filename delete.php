<?php
    require_once 'bootstrap/bootstrap.php';

    if (isset($_GET['post'])) {
        $idSinglePost = $_GET['post'];
        Post::deletePost($idSinglePost);
        header('Location: index.php');
    } else {
        echo ":("; 
    }