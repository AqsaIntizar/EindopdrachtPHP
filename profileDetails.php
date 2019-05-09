<?php
    require_once 'bootstrap/bootstrap.php';

    //$userName = $_SESSION['UserName'];
    if (isset($_SESSION['user'])) {
        //logged in user
        //echo "😎";
    } else {
        //no logged in user
        header('Location: login.php');
    }
    $id = $_GET['id'];
    $result = Post::getAllById($id);
    $posFollow = User::getProfile($id);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>includeFood - Profile Details</title>
    
</head>
<body>
    <header>
        <?php require_once 'nav.inc.php'; ?>
    </header>
    <div class="container details">
        <div class="sideNav">
            <div class="upperSide">
                <img src="images/profilePics/<?php echo $posFollow['img_dir']; ?>" class="userPic" alt="Profile Picture">
                <h3 class="info info--name"><?php echo $posFollow['username']; ?></h3>

                <!-- start Likes -->

                <div class="likes">

                    <input type="button" value="Follow" id="follow_<?php echo $posFollow['id']; ?>" class="follow" />
                    <input type="button" value="Unfollow" id="unfollow_<?php echo $posFollow['id']; ?>" class="unfollow" style="display: none;"/> 

                    <?php // $likes = Like::getLikes($r['id']);?>
                    <br>
                    <span id="likes_<?php //echo $r['id'];?>"><?php // echo $likes->cntLikes;?></span> <span>mensen volgen deze persoon.</span>
                </div>
<!-- end Likes -->
            </div>
            <hr>
            <div class="underSide">
                <!-- <a href="#">Posts</a>
                <a href="#">Info</a> -->
                <p><strong>Beschrijving: </strong></p>
                <h5 class="description"><?php echo $posFollow['description']; ?></h5>
            </div>
            
        </div>
        <div class="content--details">

            <?php $counter = 0; ?>
                <!-- start lus -->
                <?php foreach ($result as $r): ?>
   
                <div class="post" id="<?php echo $r['id']; ?>" data-id="<?php echo $r['id']; ?>">
   
                <img class="postImg" src="images/posts/<?php echo $r['post_img_dir']; ?>" alt="">
                <p class="description">
                    <?php
                        $hashtag = $r['post_description'];
                        $linked_string = preg_replace("/#([^\s]+)/", '<a href="search.php?searchResult=$1">#$1</a>', $hashtag);
                        echo $linked_string;
                    ?>
                </p>
                <p><strong><?php echo Post::timeAgo($r['date_created']); ?></strong></p>
                <a href="profileDetails.php?id=<?php echo $r['user_id']; ?>" class="post__item"><span class="infoBlock"><strong><?php echo $r['username']; ?></strong></span></a>
                <!--<p><strong><a href="#"><?php //echo $r['username'];?></a> </strong></p>-->
                
                
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
            <?php ++$counter; ?>
            <?php endforeach; ?>


            <a href="index.php?showitems=<?php echo $counter + 3; ?>" class="load">Load More</a>
        </div>
    </div>
    <script>
        $(".follow, .unfollow").click(function(e){
            let id = this.id;                           // Getting Button id
            let split_id = id.split("_");               // split id on _
            let text = split_id[0];                     // first part of splitted id = text
            let followsId = split_id[1];                   // second part = postid
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
                url: "ajax/save_follow.php",
                data: {
                    followsId: followsId,
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
                    }else{
                        likeAmount--;
                        currentLikeCnt.html(likeAmount);
                    }
                }
            });
            e.preventDefault();
        })
    </script>
</body>
</html>