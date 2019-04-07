<?php
    require_once("classes/Db.class.php");
    //kijken of er een request is
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        //request aanwezig, kijken of er files zijn om up te loaden
        if( isset($_FILES['upload']) ){
            $fileName = $_FILES['upload']['name'];
            $fileName = preg_replace('/\s+/', '_', $fileName);
            $fileType = $_FILES['upload']['type'];
            $fileTempName = $_FILES['upload']['tmp_name'];
            $fileSize = $_FILES['upload']['size'];

            //directory waar images komen
            $targetDir = "images/profilePics/";

            //uploaden
            if( move_uploaded_file($fileTempName, $targetDir.$fileName) ){
                $fullPath =  $targetDir.$fileName;
                //connect db
                $conn = Db::getInstance();
                $stmnt = $conn->prepare('update users set img_dir = :dir where email = "wesleywijsen@hotmail.com"');
                $stmnt->bindParam(":dir", $fullPath);
                $result = $stmnt->execute();
                return $result;
            }else{
                echo "file could not be uploaded";
            }
        }
        
    }
?>