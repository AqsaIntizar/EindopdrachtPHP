<?php

class Post
{
	public static function getAll(){

        if(!isset($_GET['showitems'])){
            $itemCount = 20;
        } else {
            $itemCount = (int)$_GET['showitems'];
            //echo $itemCount;
        }
        
        $conn = Db::getInstance();
        $stmnt = $conn->prepare('select posts.id, user_id, post_img_dir,post_description,username,date_created from posts, users where posts.user_id = users.id ORDER BY id DESC LIMIT :itemCount');
        $stmnt->bindValue(':itemCount', $itemCount, PDO::PARAM_INT);
        $stmnt->execute();
        return $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);
    }
<<<<<<< HEAD

    public static function getMore() {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare('select posts.id, user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id ORDER BY id DESC LIMIT :itemCount');
        $stmnt->bindValue(':itemCount', $itemCount, PDO::PARAM_INT);
        $stmnt->execute();
        return $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);
    }
||||||| merged common ancestors
=======

    public static function getSearchResults(){
        
        if(!isset($_GET['showitems'])){
            $itemCount = 20;
        } else {
            $itemCount = (int)$_GET['showitems'];
            //echo $itemCount;
        }
       
        $search = '%' . $_GET["searchResult"] . '%';

        $conn = Db::getInstance();
        $stmnt = $conn->prepare('select posts.id, user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id AND post_description LIKE :hashtag ORDER BY id DESC LIMIT :itemCount ');
        $stmnt->bindValue(':itemCount', $itemCount, PDO::PARAM_INT);
        $stmnt->bindParam(":hashtag", $search);
        $stmnt->execute();
        return $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function timeAgo($timestamp){
        date_default_timezone_set("Europe/Brussels");         
        $time_ago        = strtotime($timestamp);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;
        
        $minutes = round($seconds / 60); // value 60 is seconds  
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
        $weeks   = round($seconds / 604800); // 7*24*60*60;  
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                        
        if ($seconds <= 60){

            return "Zonet";

        } else if ($minutes <= 60){

            if ($minutes == 1){

            return "1 minuut geleden";

            } else {

            return "$minutes minuten geleden";

            }

        } else if ($hours <= 24){

            if ($hours == 1){

            return "Een uur geleden";

            } else {

            return "$hours uur geleden";

            }

        } else if ($days <= 7){

            if ($days == 1){

            return "Gisteren";

            } else {

            return "$days dagen geleden";

            }

        } else if ($weeks <= 4.3){

            if ($weeks == 1){

            return "Een week geleden";

            } else {

            return "$weeks weken geleden";

            }

        } else if ($months <= 12){

            if ($months == 1){

            return "Een maand geleden";

            } else {

            return "$months maanden geleden";

            }

        } else {
            
            if ($years == 1){

            return "Een jaar geleden";

            } else {

            return "$years jaren geleden";

            }
        }
    }
>>>>>>> 35a5f066df2f1b3f302b92bde9e0e88374cfd9d6
}