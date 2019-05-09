<?php
    require_once '../bootstrap/bootstrap.php';
    if (!empty($_POST)) {
        $followsId = $_POST['followsId'];
        $userId = $_SESSION['user']['id'];
        $type = $_POST['type'];
        try {
            $l = new Follow();
            $l->setPostId($postId);
            $l->setUserId($userId);
            $l->setType($type);
            $l->saveLike();
            $result = [
                'status' => 'success',
                'message' => 'Like was saved',
                'data' => [
                    'like' => $type,
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
