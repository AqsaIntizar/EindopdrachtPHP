<?php
    require_once '../bootstrap.php';

    if (!empty($_POST)) {
        $postId = $_POST['postId'];
        $userId = $_SESSION['Id'];
        try {
            $result = [
                'status' => 'success',
                'message' => 'Post is reported',
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
