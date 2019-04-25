<?php 
    //require_once("classes/Db.class.php");
    //require_once("classes/Post.class.php");
    require_once("bootstrap.php");
   
    //$userName = $_SESSION['UserName'];
    if( isset($_SESSION['User']) ){
        //logged in user
        //echo "😎";
    }else{
        //no logged in user
        header('Location: login.php');
    }

    if( !empty($_POST) ){
        //echo $_POST['comment'];
        try{
            $comment = new Comment();
            $comment->setText($_POST['comment']);
            var_dump($comment->saveComment());
        }catch(Throwable $t){
            throw $t;
        }
    }
    

    $conn = Db::getInstance();
    $stmnt = $conn->prepare('select user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id');
    $stmnt->execute();
    $result= $stmnt->fetchAll(PDO::FETCH_ASSOC);

    $comments = Comment::getAll();

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
    <?php $counter = 0; ?>
    <!-- start lus -->
    <?php foreach($result as $r): ?>
   
    <div class="post" id="<?php echo $counter; ?>">
        <img class="postImg" src="<?php echo $r['post_img_dir'] ?>" alt="">
        <p class="description"><?php echo $r['post_description']?></p>
        <p><strong><?php echo $r['username'] ?></strong></p>
        
        <form method="post" action="">
            <input type="text" placeholder="Comment Here" id="comment" name="comment"/>
            <input type="submit" value="Post comment" id="btnSub" />

            <ul class="comments">
                <?php 
                    foreach($comments as $c){
                        echo "<li>".$c->getText()."</li>";
                    }
                ?>
            </ul>
        </form>
    </div>

    <div class="fullView" id="full-<?= $counter; ?>">
        <span class="x">X</span>
        <img src="<?php echo $r['post_img_dir'] ?>" alt="">
    </div>
    
    <?php $counter++; ?>
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
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script>
        // document.getElementById("1").addEventListener("click", displayFull);
        // document.getElementById("close").addEventListener("click", close);

       $('.postImg').on('click', function(){
            const bigImg = $(this).parent().attr('id');
            $('#full-' + bigImg).fadeIn();
       });

       $('.x').on('click', function(){
           $('.fullView').fadeOut();
       });
    </script>
    <script>
        $("#btnSub").on("click", function(e){
            let text = $("#comment").val();
            $.ajax({
                method: "POST",
                url: "ajax/save_comment.php",
                data: { text: text },
                dataType: 'json'
            })
            .done( function( res ){
                if(res.status == "succes"){
                    let li = `<li>${text}</li>`;
                    $(".comments").append(li);
                    $("#comment").val("").focus();
                    $(".comments li").last().slideDown(100);
                }
            });
            e.preventDefault();
        })
    </script>
</body>
</html>