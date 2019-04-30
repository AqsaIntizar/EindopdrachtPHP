<?php
    require_once('../bootstrap.php');
    
    if( !empty($_POST) ){
        $text = $_POST['text'];
        try{
            $c = new Comment();
            $c->setText($text);
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