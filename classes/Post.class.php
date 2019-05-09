<?php

class Post
{
	public static function getAll(){

        if(!isset($_GET['showitems'])){
            $itemCount = 5;
        } else {
            $itemCount = (int)$_GET['showitems'];
            //echo $itemCount;
        }
        
        $conn = Db::getInstance();
        $stmnt = $conn->prepare('select posts.id, user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id ORDER BY id DESC LIMIT :itemCount');
        $stmnt->bindValue(':itemCount', $itemCount, PDO::PARAM_INT);
        $stmnt->execute();
        return $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMore() {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare('select posts.id, user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id ORDER BY id DESC LIMIT :itemCount');
        $stmnt->bindValue(':itemCount', $itemCount, PDO::PARAM_INT);
        $stmnt->execute();
        return $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);
    }
}