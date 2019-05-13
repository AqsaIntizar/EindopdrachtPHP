<?php
    require_once '../bootstrap/bootstrap.php';

    if (isset($_POST['showitems'])) {
        // $showitems = $_POST['showitems'];
    //    echo $_POST['showitems'];
        
        // echo $_POST['test'];
        try {
            if (Post::getAllFollows($_SESSION['user']['id'])) {
                $posts = Post::getAllFollows($_SESSION['user']['id']);
                // $result += Post::getAll();
            } else {
                $posts = Post::getAll();
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