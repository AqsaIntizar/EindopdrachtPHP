<?php
    require_once '../bootstrap/bootstrap.php';

    if (isset($_POST['showitems'])) {
        $page = $_POST['page'];
        try {
            // if (Post::getAllFollows($_SESSION['user']['id'])) {
            //     $posts = Post::getAllFollows($_SESSION['user']['id']);
            //     // $result += Post::getAll();
            // } else {
            //     $posts = Post::getAll();
            // }
           if($page == "index") {
                $posts = Post::getAll();
           } else {
                $posts = Post::getAllFollows($_SESSION['user']['id']);
           }
            
            $result = [
                'status' => 'success',
                'message' => 'Posts loaded',
                'data' => [
                    'posts' => $posts
                ],
            ];
        } catch (Throwable $t) {
            
            //error
            $result = [
                'status' => 'error',
                'message' => $t->getMessage(),
            ];
        }
        echo json_encode($result);
    }