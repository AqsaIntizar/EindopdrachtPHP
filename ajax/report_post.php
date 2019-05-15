<?php
    require_once '../bootstrap/bootstrap.php';
    if (!empty($_POST)) {
        $postId = $_POST['postId'];
        $userId = $_SESSION['user']['id'];
        var_dump($postId);
        try {
            $l = new Report();
            $l->setPostId($postId);
            $l->setUserId($userId);
            $l->saveReport();
            $result = [
                'status' => 'success',
                'message' => 'Post reported'
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