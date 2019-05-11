<?php
    require_once '../bootstrap/bootstrap.php';
    if (!empty($_POST)) {
        $followsId = $_POST['followsId'];
        $followerId = $_SESSION['user']['id'];
        $type = $_POST['type'];
        try {
            $l = new Follow();
            $l->setFollowsId($followsId);
            $l->setFollowerId($followerId);
            $l->setType($type);
            $l->saveFollower();
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
