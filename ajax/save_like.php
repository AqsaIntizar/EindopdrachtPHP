<?php
    require_once '../bootstrap.php';
    if (!empty($_POST)) {
        $postId = $_POST['postId'];
        $userId = $_SESSION['Id'];
        $type = $_POST['type'];
        try {
            $l = new Like();
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