<?php
    require_once("classes/Db.class.php");
    require_once("classes/Upload.class.php");
    require_once("classes/User.class.php");

    session_start();
    $userEmail = $_SESSION['email'];
    if( isset($_SESSION['User']) ){
        //logged in user
        echo "😁";
    }else{
        //no logged in user
        echo "😒";
    }
    if( isset($_POST['uploadImage']) ){
        $upload = new Upload;
        $upload->setFileName($_FILES['imageFile']['name']);
        $upload->setFileType($_FILES['imageFile']['type']);
        $upload->setFileTempName($_FILES['imageFile']['tmp_name']);
        $upload->setFileSize($_FILES['imageFile']['size']);
        $upload->setTargetDir("images/profilePics/");

        $result = $upload->uploadImage();
    }

    if( isset($_POST['descrSave']) && !empty($_POST['myDiscr']) ){
        $result = User::saveDiscription($userEmail);
    }

    if( isset($_POST['changePassword']) && !empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['new_password_confirmation']) ){
        $oldPass = $_POST['oldPassword'];
        $newPass = $_POST['newPassword'];
        $newPassComf = $_POST['new_password_confirmation'];
        
        $result = User::changePass($oldPass,$newPass,$newPassComf, $userEmail);

    }

    $conn = Db::getInstance();
    $stmnt = $conn->prepare('select img_dir, description FROM `users` WHERE email = :userEmail');
    $stmnt->bindParam(":userEmail", $userEmail);
    $stmnt->execute();
    $result = $stmnt->fetch(PDO::FETCH_OBJ);
    //echo $result->img_dir;

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

        <!--Start ProfPic-->
        <div class="setProfPic">
            <div class="edit">
                <h2>Chance profile picture</h2>
                <img class="currentPic" src="<?php echo $result->img_dir; ?>">
                <br><br>
                <form action="" method="post" enctype="multipart/form-data">
                    <p>
                        File: <input type="file" name="imageFile">
                    </p>
                    <br>
                    <input type="submit" name="uploadImage" value="Upload image">
                </form>
                <hr>
            </div>
        </div>
        <!--End ProfPic-->

        <!--Start Description-->
        <div class="setDescr">
            <div class="edit">
                <h2>Chance your description</h2>
                <form action="" method="post">
                    <p><?php echo $result->description; ?></p>
                    <textarea name="myDiscr" id="myDiscr" cols="55" rows="10" ></textarea>
                    <br><br>
                    <input type="submit" name="descrSave" value="Save description">
                </form>
                <hr>
            </div>
        </div>
        <!--End Description-->

        <!--Start Password-->
        <div class="setDescr">
            <div class="edit">
                <h2>Chance your password</h2>
                <form action="" method="post">

                    <label for="oldPassword">Old Password</label>
                    <input type="password" id="oldPassword" name="oldPassword">
                    <br><br>
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="newPassword">
                    <br><br>
                    <label for="new_password_confirmation">Confirm your new password</label>
		            <input type="password" id="new_password_confirmation" name="new_password_confirmation">

                    <br><br>
                    <input type="submit" name="changePassword" value="Change Password">
                </form>
                <hr>
            </div>
        </div>
        <!--End Password-->
    </div>

</body>
</html>