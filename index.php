<?php 
    require_once("classes/Db.class.php");
    require_once("classes/Post.class.php");

    $conn = Db::getInstance();
    $stmnt = $conn->prepare('select description, img_dir FROM `posts`');
    $stmnt->execute();
    $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>includeFood - Home</title>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>
    <div class="feed">
    <div class="addContent"><a href="newPost.php">Add some fresh content here</a></div>
    <!-- start lus -->
    <?php foreach($result as $r): ?>
    <div class="post">
    <img src="<?php echo $r['img_dir'] ?>" alt="">
    <p class="description"><?php echo $r['description']?></p>
    </div>
    <?php endforeach;?>
    <!-- einde lus -->
    <!-- for testing grid -->
    <!-- <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div>
    <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div>
    <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div>
    <div class="post">
    <img src="https://fakeimg.pl/400x400/?text=MyPic" alt="">
    <p class="description"></p>
    </div> -->
    </div>
</body>
</html>