<?php
    require_once 'bootstrap/bootstrap.php';

    if (isset($_SESSION['user'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
    $userName = $_SESSION['user']['username'];
    //Start uploading Profile pic
    if (isset($_POST['uploadImage'])) {
        $upload = new Upload();
        $upload->setFileName($_FILES['imageFile']['name']);
        $upload->setFileType($_FILES['imageFile']['type']);
        $upload->setFileTempName($_FILES['imageFile']['tmp_name']);
        $upload->setFileSize($_FILES['imageFile']['size']);
        $upload->setTargetDir('images/profilePics/');

        $upload->setUserId($_SESSION['user']['id']);

        $result = $upload->uploadProfPic($userName);
    }
    //End uploading Profile pic

    //Start save derscription
    if (isset($_POST['descrSave']) && !empty($_POST['myDiscr'])) {
        $result = User::saveDiscription($userName);
    }
    //End save derscription

    //Start Change Email
    if (isset($_POST['changeEmail']) && !empty($_POST['password']) && !empty($_POST['newEmail'])) {
        $password = $_POST['password'];
        $newEmail = htmlspecialchars($_POST['newEmail'], ENT_QUOTES);

        $result = User::changeEmail($password, $newEmail, $userName);
    }
    //End Change Email

    //Start password change
    if (isset($_POST['changePassword']) && !empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['new_password_confirmation'])) {
        $oldPass = $_POST['oldPassword'];
        $newPass = $_POST['newPassword'];
        $newPassComf = $_POST['new_password_confirmation'];

        $result = User::changePass($oldPass, $newPass, $newPassComf, $userName);
    }
    //End password change

    //Start view current profile pic
    $conn = Db::getInstance();
    $stmnt = $conn->prepare('select img_dir, description, email  FROM `users` WHERE username = :username');
    $stmnt->bindParam(':username', $userName);
    $stmnt->execute();
    $result = $stmnt->fetch(PDO::FETCH_OBJ);
    //echo $result->img_dir;
    //End view current profile pic

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>IncludeFood - Settings</title>
</head>
<body>
    <header>
        <?php require_once 'nav.inc.php'; ?>
    </header>
    <div class="settings">
        <h1>Accountinstellingen</h1>

        <!--Start ProfPic-->
        <div class="setProfPic">
            <div class="edit">
                <h2>Change profile picture</h2>
                <img class="currentPic" src="images/profilePics/<?php echo $result->img_dir; ?>">
                <br><br>
                <form action="" method="post" enctype="multipart/form-data">
                <input class="addcontent" type="file" name="imageFile" id="file" data-multiple-caption="{count} files selected" multiple onchange="readURL(this);" >
                <label for="file">Choose a file</label>
                    <br>
                    <input type="submit" name="uploadImage" value="Upload image" id="btn">
                </form>
                <hr>
            </div>
        </div>
        <!--End ProfPic-->

        <!--Start Description-->
        <div class="setDescr">
            <div class="edit">
                <h2>Change your description</h2>
                <p><?php echo $result->description; ?></p>
                <form action="" method="post">
                    <textarea name="myDiscr" id="myDiscr" cols="55" rows="10" ></textarea>
                    <br><br>
                    <input type="submit" name="descrSave" value="Save description">
                </form>
                <hr>
            </div>
        </div>
        <!--End Description-->

        <!--Start Email-->
        <div class="setEmail">
            <div class="edit">
                <h2>Change your email-address</h2>
                <p class="resultEmail">Your current email is: <?php echo $result->email; ?></p>
                <form action="" method="post">
                    <div class="signup">
                    <input type="password" id="password" name="password" placeholder="password">
                    <br><br>
                    <input type="text" id="newEmail" name="newEmail">
                    </div>
                    <input type="submit" name="changeEmail" value="Change Email" placeholder="new mail">
                
                </form>
                <hr>
            </div>
        </div>
        <!--End Email-->
        
        <!--Start Password-->
        <div class="setPassword">
            <div class="edit">
                <h2>Change your password</h2>
                <form action="" method="post">
                    <div class="signup">
                    <input type="password" id="oldPassword" name="oldPassword" placeholder="Old password">
                    <br><br>
                    <input type="password" id="newPassword" name="newPassword" placeholder="New password">
                    <br><br>
		            <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Password confirmation">
</div>
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