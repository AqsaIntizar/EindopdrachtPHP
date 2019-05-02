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
   
    $con = mysqli_connect('localhost', 'root', 'root', 'includefood');

    if (isset($_POST['liked'])) {
        $postid = $_POST['postid'];
        $result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
        $row = mysqli_fetch_array($result);
        $n = $row['likes'];

        mysqli_query($con, "INSERT INTO likes (userid, postid) VALUES (1, $postid)");
        mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE id=$postid");

        echo $n+1;
        exit();
    }
    if (isset($_POST['unliked'])) {
        $postid = $_POST['postid'];
        $result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
        $row = mysqli_fetch_array($result);
        $n = $row['likes'];

        mysqli_query($con, "DELETE FROM likes WHERE postid=$postid AND userid=1");
        mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE id=$postid");
        
        echo $n-1;
        exit();
    }

    // Retrieve posts from the database
    $posts = mysqli_query($con, "select posts.id, user_id, post_img_dir,post_description,username, likes from posts, users where posts.user_id = users.id");


    $conn = Db::getInstance();
    $stmnt = $conn->prepare('select posts.id, user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id ORDER BY id DESC LIMIT :itemCount');
    $stmnt->bindValue(':itemCount', $itemCount, PDO::PARAM_INT);
    $stmnt->execute();
    $result = $stmnt->fetchAll(PDO::FETCH_ASSOC);
    $result = Post::getAll();

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
    <?php while ($row = mysqli_fetch_array($posts)) { ?>

<div class="post"id="<?php echo $r['id']; ?>" data-id="<?php echo $r['id']; ?>">
        <img class="postImg" src="<?php echo $row['post_img_dir'] ?>" alt="">
        <p class="description"><?php echo $row['post_description']?></p>
        <p><strong><?php echo $row['username'] ?></strong></p>

    <div style="padding: 2px; margin-top: 5px;">
    <?php 
        // determine if user has already liked this post
        $results = mysqli_query($con, "SELECT * FROM likes WHERE userid=1 AND postid=".$row['id']."");

        if (mysqli_num_rows($results) == 1 ): ?>
            <!-- user already likes post -->
            <span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>">unlike</span> 
            <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>">like</span> 
        <?php else: ?>
            <!-- user has not yet liked post -->
            <span class="like fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>">like</span> 
            <span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>">unlike</span> 
        <?php endif ?>

        <span class="likes_count"><?php echo $row['likes']; ?> likes</span>
    </div>
    <form method="post" action="">
    <?php foreach ($result as $r): ?>
   
    <div class="post" id="<?php echo $r['id']; ?>" data-id="<?php echo $r['id']; ?>">
    
        <img class="postImg" src="<?php echo $r['post_img_dir']; ?>" alt="">
        <p class="description"><?php  $hashtag = $r['post_description'];
    $linked_string = preg_replace("/#([^\s]+)/", "<a href=\"search.php?q=$1\">#$1</a>", $hashtag);
    echo $linked_string ?></p>
        <p><strong><?php echo $r['username']; ?></strong></p>
        
        <form method="post" action="">
            <input type="text" placeholder="Comment Here" class="comment" name="comment"/>
            <input type="submit" value="Post comment" class="btnSub" />

            <ul class="comments">
                <?php
                    //echo $r['id'];
                    $comments = Comment::getAll($row['id']);
                    if( is_array($comments) || is_object($comments) ){
                        foreach($comments as $c){
                            echo "<li>".htmlspecialchars($c['text'], ENT_QUOTES)."</li>";
                        }
                    }

                ?>
            </ul>
        </form>

</div>

<?php } ?>




    <a href='index.php?showitems=<?php echo $counter + 3; ?>' class="load">Load More</a>
    
    
    <!-- einde lus -->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=
    " crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        // when the user clicks on like
        $('.like').on('click', function(){
            var postid = $(this).data('id');
                $post = $(this);

            $.ajax({
                url: 'index.php',
                type: 'post',
                data: {
                    'liked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });
        // when the user clicks on unlike
        $('.unlike').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'index.php',
                type: 'post',
                data: {
                    'unliked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });
    });
</script>


    
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