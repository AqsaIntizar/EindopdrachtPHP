<?php
    require_once('../bootstrap.php');
    
    if( !empty($_POST) ){
        $postId = $_POST['postId'];
        $text = htmlspecialchars($_POST['text'], ENT_QUOTES);
        $userId = $_SESSION['Id'];
        try{
            $c = new Comment();
            $c->setPostId($postId);
            $c->setText($text);
            $c->setUserId($userId);
            $c->saveComment();

            $result = [ 
                "status" => "success",
                "message" => "Comment was saved"
            ];
        }catch(Throwable $t){
            echo "iets";
            //error
            $result = [ 
                "status" => "error",
                "message" => $t->getMessage()
            ];
        }
        echo json_encode($result);
    }