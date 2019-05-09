<?php
    require_once '../bootstrap/bootstrap.php';

    if (!empty($_POST)) {
        $postId = $_POST['postId'];
        $text = $_POST['text'];
        $userId = $_SESSION['user']['id'];
        try {
            $c = new Comment();
            $c->setPostId($postId);
            $c->setText($text);
            $c->setUserId($userId);
            $c->saveComment();

            $result = [
                'status' => 'success',
                'message' => 'Comment was saved',
                'data' => [
                    'comment' => htmlspecialchars($text, ENT_QUOTES),
                ],
            ];
        } catch (Throwable $t) {
            echo 'iets';
            //error
            $result = [
                'status' => 'error',
                'message' => $t->getMessage(),
            ];
        }
        echo json_encode($result);
    }
