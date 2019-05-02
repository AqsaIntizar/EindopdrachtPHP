<?php
    require_once 'bootstrap.php';

    //$userName = $_SESSION['UserName'];
    if (isset($_SESSION['User'])) {
        //logged in user
        //echo "😎";
    } else {
        //no logged in user
        header('Location: login.php');
    }

    // if( !empty($_POST) ){
    //     //echo $_POST['comment'];
    //     try{
    //         $comment = new Comment();
    //         $comment->setText($_POST['comment']);
    //         var_dump($comment->saveComment());
    //     }catch(Throwable $t){
    //         throw $t;
    //     }
    // }

    // $conn = Db::getInstance();
    // $stmnt = $conn->prepare('select posts.id ,user_id, post_img_dir,post_description, username from posts, users where posts.user_id = users.id');
    // $stmnt->execute();
    // $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);

    // $comments = Comment::getAll($r['id']);

    if (!isset($_GET['showitems'])) {
        $itemCount = 3;
    } else {
        $itemCount = $_GET['showitems'];
    }

    $conn = Db::getInstance();
    $stmnt = $conn->prepare('select posts.id, user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id ORDER BY id DESC LIMIT :itemCount');
    $stmnt->bindValue(':itemCount', $itemCount, PDO::PARAM_INT);
    $stmnt->execute();
    $result = $stmnt->fetchAll(PDO::FETCH_ASSOC);

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
        <?php require_once 'nav.inc.php'; ?>
    </header>
    <div class="feed">
    <div class="addContent"><a href="newPost.php">Add some fresh content here</a></div>
    <?php $counter = 0; ?>
    <!-- start lus -->
    <?php foreach ($result as $r): ?>
   
    <div class="post" id="<?php echo $r['id']; ?>" data-id="<?php echo $r['id']; ?>">
    
        <img class="postImg" src="<?php echo $r['post_img_dir']; ?>" alt="">
        <p class="description"><?php echo $r['post_description']; ?></p>
        <p><strong><?php echo $r['username']; ?></strong></p>
        
        <form method="post" action="">
            <input type="text" placeholder="Comment Here" class="comment" name="comment"/>
            <input type="submit" value="Post comment" class="btnSub" />

            <ul class="comments">
                <?php
                    //echo $r['id'];
                    $comments = Comment::getAll($r['id']);
                    if (is_array($comments) || is_object($comments)) {
                        foreach ($comments as $c) {
                            echo '<li>'.htmlspecialchars($c['text'], ENT_QUOTES).'</li>';
                        }
                    }

                ?>
            </ul>
        </form>
    </div>

    <div class="fullView" id="full-<?php echo $r['id']; ?>" data-full-id="full-<?php echo $r['id']; ?>">
        <span class="x">X</span>
        <img src="<?php echo $r['post_img_dir']; ?>" alt="">
    </div>
    <?php ++$counter; ?>
    <?php endforeach; ?>


    <a href="index.php?showitems=<?php echo $counter + 3; ?>' class="load">Load More</a>
    
    
    <!-- einde lus -->

    
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script>
        // document.getElementById("1").addEventListener("click", displayFull);
        // document.getElementById("close").addEventListener("click", close);

            $('.postImg').on('click', function(){
                    const bigImg = $(this).parent().attr('id');
                //full view
                $('.post').on('click', function(){
                    const bigImg = $(this).attr('id');
                    $('#full-' + bigImg).fadeIn();
            });

            $('.x').on('click', function(){
                $('.fullView').fadeOut();
            });
        })
    </script>
    <script>
        $(".btnSub").on("click", function(e){
            let that = $(this);
            let text = $(this).siblings(".comment").val();
            let currentForm = $(this).parent();
            let postId = currentForm.parent().data("id");
            console.log(postId);
            $.ajax({
                method: "POST",
                url: "ajax/save_comment.php",
                data: { 
                    postId: postId,
                    text: text },
                dataType: 'json'
            })
            .done( function( res ){
                if(res.status == "success"){
                    //console.log("hier");
                    let comment = res.data.comment;
                    let li = `<li style="display: hidden;">${comment}</li>`;
                    that.siblings(".comments").append(li);
                    that.siblings(".comment").val("").focus();
                    //that.siblings(".comments").find("li").last().slideDown(100);
                }
            });
            e.preventDefault();
        })

       

    </script>
</body>
</html>