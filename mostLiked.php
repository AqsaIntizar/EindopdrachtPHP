<?php
    require_once 'bootstrap/bootstrap.php';
    if (isset($_SESSION['user'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }

    $post = Like::checkMostLiked();
    $postId = $post['post_id'];
    $r = Post::getSinglePost($postId);
    $r = array_shift($r);

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
        <h2>This is the most liked post</h2>
        <div class="feed">
            <div class="post post--home" id="<?php echo $r['id']; ?>">
                <a class="postImgLink" href="single.php?post=<?php echo $r['id']; ?>">
                    <figure class="imgFilter <?php echo $r['filter']; ?>" >
                        <img src="images/posts/mini-<?php echo $r['post_img_dir']; ?>" alt="">
                    </figure>
                </a>
                    <div class="post_info">
                        <a href="profileDetails.php?id=<?php echo $r['user_id']; ?>" class="post__item"><span class="infoBlock"><strong><?php echo $r['username']; ?></strong></span></a>
                        <p class="description"><?php echo $r['post_description']; ?></p>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>