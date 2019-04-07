<?php
    session_start();
    if( isset($_SESSION['User']) ){
        //logged in user
        echo "😁";
    }else{
        //no logged in user
        echo "😒";
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>includeFood - Settings</title>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>
    <div class="settings">
        <h1>Accountinstellingen</h1>

        <div class="setProfPic">
            <div class="edit currentPic">
                <h2>Chance profile picture</h2>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <p>
                        File: <input type="file" name="upload">
                    </p>
                    <input type="submit" value="Upload image">
                </form>


            <!--
                <img src="https://fakeimg.pl/340x240/?text=MyPic">
                <a href="#" class="modalTrggr">Bewerk</a>
            -->
                <hr>
            </div>
        </div>
        
        <div class="setProfPic">
            <div class="edit currentPic">
                <img src="https://fakeimg.pl/340x240/?text=MyPic">
                <a href="#" class="modalTrggr">Bewerk</a>
                <hr>
            </div>
        </div>
    </div>

</body>
</html>