<?php
    require_once 'bootstrap/bootstrap.php';
    if (isset($_SESSION['user'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }

    if (isset($_GET['post'])) {
        $idSinglePost = $_GET['post'];
        $r = Post::getSinglePost($idSinglePost);
        $r = array_shift($r);
    } else {
        echo ":("; 
    }

     //Start save derscription
     if (isset($_POST['descrSave']) && !empty($_POST['myDescr'])) {
        // $result = User::saveDiscription($userName);
        Post::changeDescription($idSinglePost);
        header('Location: single.php?post='.$idSinglePost);
    }
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>IncludeFood</title>
</head>
<body>
    <header>
        <?php require_once 'nav.inc.php'; ?>
    </header>
    <div class="homepage">
        <div class="feed">
            <div class="post post--home" id="<?php echo $r['id']; ?>">
                    <a href="single.php?post=<?php echo $r['id']; ?>"><img class="postImg" src="images/posts/mini-<?php echo $r['post_img_dir']; ?>" alt=""></a>
                    <div class="post_info">
                        <a href="profileDetails.php?id=<?php echo $r['user_id']; ?>" class="post__item"><span class="infoBlock"><strong><?php echo $r['username']; ?></strong></span></a>
                        <p class="description"><?php echo $r['post_description']; ?></p>
                    </div>
            </div>
        </div>
        <div class="setDescr">
            <div class="editDes">
                <h2>Change your description</h2>
                <form action="" method="post">
                    <textarea name="myDescr" id="myDescr" cols="55" rows="10" ></textarea>
                    <br><br>
                    <input type="submit" name="descrSave" value="Save description" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>