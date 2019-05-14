<?php

    require_once '../bootstrap.php';

    $postId = $_POST['postId'];
    $userId = $_SESSION['Id'];
    try {
        $reported = new Report();
        $reported->setPostId($postId);
        $reported->setUserId($userId);
        $reported->reportStatus();
        $res = [
            'status' => 'success',
            'message' => 'Post is reported',
        ];
    } catch (Throwable $t){
            //error
        $res = [
            'status' => 'error',
            'message' => $t->getMessage(),
        ];
    }
    echo json_encode($res);
