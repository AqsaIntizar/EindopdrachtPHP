<?php
    require_once 'bootstrap/bootstrap.php';

    if (isset($_SESSION['user'])) {
        //logged in user
        //echo "😎";
    } else {
        //no logged in user
        header('Location: login.php');
    }
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

    <!-- start lus posts-->
    <?php foreach ($result as $r):
        $postId = $r['id'];
        ?>
        
    <div class="post" id="<?php echo $postId; ?>" data-id="<?php echo $postId; ?>">

        <img class="postImg" src="images/posts/<?php echo $r['post_img_dir']; ?>" alt="">
        <p class="description"><?php  $hashtag = $r['post_description'];
            $linked_string = preg_replace("/#([^\s]+)/", '<a href="search.php?searchResult=$1">#$1</a>', $hashtag);
            echo $linked_string; ?></p>
        <p><strong><?php echo Post::timeAgo($r['date_created']); ?></strong></p>
        <a href="profileDetails.php?id=<?php echo $r['user_id']; ?>" class="post__item"><span class="infoBlock"><strong><?php echo $r['username']; ?></strong></span></a>
        <!--<p><strong><a href="#"><?php //echo $r['username'];?></a> </strong></p>-->

        <!-- start Likes -->

        <div class="likes">

            <input type="button" value="Like" id="like_<?php echo $postId; ?>" class="like" />
            <input type="button" value="Unlike" id="unlike_<?php echo $postId; ?>" class="unlike" style="display: none;"/> 

            <?php
                $likes = Like::getLikes($postId);
                $likeChecker = Like::checkIfLiked($_SESSION['user']['id'], $postId);
            ?>
            <span class="likesCnt" id="likes_<?php echo $postId; ?>" data-type="<?php echo $likeChecker; ?>"><?php echo $likes->cntLikes; ?></span> <span>mensen hebben dit geliked</span>
        </div>
        <!-- end Likes -->

        <form method="post" action="">
            <input type="text" placeholder="Comment Here" class="comment" name="comment"/>
            <input type="submit" value="Post comment" class="btnSub" />

            <ul class="comments">
                <?php
                    //echo $r['id'];
                    $comments = Comment::getAll($postId);
                    if (is_array($comments) || is_object($comments)) {
                        foreach ($comments as $c) {
                            echo '<li>'.htmlspecialchars($c['text'], ENT_QUOTES).'</li>';
                        }
                    }
                ?>
            </ul>
        </form>
    </div>

    <div class="fullView" id="full-<?php echo $postId; ?>" data-full-id="full-<?php echo $postId; ?>">
        <span class="x">X</span>
        <img src="<?php echo $r['post_img_dir']; ?>" alt="">
    </div>
    <?php ++$counter; ?>
    <?php endforeach; ?>
    <!-- einde lus -->

    <a href="index.php?showitems=<?php echo $counter + 3; ?>" class="load">Load More</a>
    
    
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
        $(document).ready(()=>{
            
            let likesCntArray = $('.likesCnt').each(function() {
                let currentLikeType = $(this).data('type');
                // console.log(currentLikeType )
                let id = this.id
                let split_id = id.split("_");               // split id on _
                let text = split_id[0];                     // first part of splitted id = text
                let likeId = split_id[1];
                if(currentLikeType == 1){
                    $('#like_' + likeId).css("display", "none");
                    $('#unlike_' + likeId).css("display", "inline-block");
                }else{
                    $('#unlike_' + likeId).css("display", "none");
                    $('#like_' + likeId).css("display", "inline-block");
                }
            });

            $(".like, .unlike").click(function(e){
            let id = this.id;                           // Getting Button id
            let split_id = id.split("_");               // split id on _
            let text = split_id[0];                     // first part of splitted id = text
            let postId = split_id[1];                   // second part = postid
            let currentLikeCnt = $("#likes_" + postId); 
            let likeAmount = currentLikeCnt.html();     // amount of current likes
            // Setting type
            var type = 0;
            if(text == "like"){
                type = 1;
                console.log(type)
            }else{
                type = 0;
                console.log(type)
            }
            // AJAX Request
            $.ajax({
                method: "POST",
                url: "ajax/save_like.php",
                data: {
                    postId: postId,
                    type: type
                },
                dataType: 'json'
                
            })
            .done( function ( res ){
                if (res.status == "success"){
                    //change the buttons
                    $("#" + id).siblings().css("display", "inline-block");
                    $("#" + id).css("display", "none");
                    //if the button was like, likeAmount +1 else -1
                    if( text == "like"){
                        likeAmount++;
                        currentLikeCnt.html(likeAmount);
                        $('#likes_<?php echo $postId; ?>').data('type', 0);
                    }else{
                        likeAmount--;
                        currentLikeCnt.html(likeAmount);
                        $('#likes_<?php echo $postId; ?>').data('type', 1);
                    }
                }
            });
            e.preventDefault();
        })

        })
       
    </script>
    <script>
        $(".btnSub").on("click", function(e){
            let that = $(this);
            let text = $(this).siblings(".comment").val();
            let currentForm = $(this).parent();
            let postId = currentForm.parent().data("id");
            $.ajax({
                method: "POST",
                url: "ajax/save_comment.php",
                data: { 
                    postId: postId,
                    text: text 
                },
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
        });
    </script>
    <script>
        //ajax for load more
        // $(".load").on("click", function(e){
        //     let counter = $(this).data('counter');
        //     $.ajax({
        //         method: "POST",
        //         url: "ajax/save_comment.php",
        //         data: { 
        //             counter: counter },
        //         dataType: 'json'
        //     })
        //     .done( function( res ){
        //         if(res.status == "success"){
        //             //console.log("hier");
        //             let posts = res.data.posts;
        //             console.log('something');
        //         }
        //     });
        //     e.preventDefault();
        // });
     


    </script>

    
</body>
</html>