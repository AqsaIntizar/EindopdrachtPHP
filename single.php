<?php
    require_once 'bootstrap/bootstrap.php';
    require 'vendor/autoload.php';

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
        echo ':(';
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>IncludeFood - Details</title>
</head>
<body>
    <header>
        <?php require_once 'nav.inc.php'; ?>
    </header>

    <div class="report">
        <a href="#" class="reportText" data-postid="<?php echo $r['id']; ?>">Report</a>  
    </div>   
    
    <div class="singlePost" id="<?php echo $r['id']; ?>" data-id="<?php echo $r['id']; ?>">
        <div class="detail">
            <figure class="imgFilter <?php echo $r['filter']; ?>" >
                <img src="images/posts/<?php echo $r['post_img_dir']; ?>" alt="">
            </figure>
            <div class="colors-wrapper">
                <a class="colors" href="colorsearch.php?color=<?php echo $r['color1']; ?>" style="background-color:<?php echo $r['color1']; ?>"></a>
                <a class="colors" href="colorsearch.php?color=<?php echo $r['color2']; ?>" style="background-color:<?php echo $r['color2']; ?>"></a>
                <a class="colors" href="colorsearch.php?color=<?php echo $r['color3']; ?>" style="background-color:<?php echo $r['color3']; ?>"></a>
                <a class="colors" href="colorsearch.php?color=<?php echo $r['color4']; ?>" style="background-color:<?php echo $r['color4']; ?>"></a>
            </div>
            <p class="description"><?php  $hashtag = $r['post_description'];
                $linked_string = preg_replace("/#([^\s]+)/", '<a href="search.php?searchResult=$1">#$1</a>', $hashtag);
                echo $linked_string; ?></p>
            <p><strong><?php echo Post::timeAgo($r['date_created']); ?></strong></p>
            <a href="profileDetails.php?id=<?php echo $r['user_id']; ?>" class="post__item"><span class="infoBlock"><strong><?php echo $r['username']; ?></strong></span></a>
            <!--<p><strong><a href="#"><?php //echo $r['username'];?></a> </strong></p>-->
                    <!-- start Likes -->
                    <div class="likes">

                        <input type="button" value="Like" id="like_<?php echo $r['id']; ?>" class="like" />
                        <input type="button" value="Unlike" id="unlike_<?php echo $r['id']; ?>" class="unlike" style="display: none;"/> 

                        <?php
                            $likes = Like::getLikes($r['id']);
                            $likeChecker = Like::checkIfLiked($_SESSION['user']['id'], $r['id']);
                        ?>
                        <span class="likesCnt" id="likes_<?php echo $r['id']; ?>" data-type="<?php echo $likeChecker; ?>"><?php echo $likes->cntLikes; ?></span> <span>mensen hebben dit geliked</span>
                    </div>
                    <!-- end Likes -->
                    <div class="report">
                        <a href="#" class="reportText" data-postid="<?php echo $r['id']; ?>">
                        <?php
                            if (Report::textReport($_SESSION['user']['id'], $r['id'])) {
                                echo 'Undo';
                            } else {
                                echo 'Report';
                            }
                        ?>

                        </a>  
                    </div> 

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
        </div>    
    </div>

   
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  
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
                          $('#likes_<?php echo $r['id']; ?>').data('type', 0);
                      }else{
                          likeAmount--;
                          currentLikeCnt.html(likeAmount);
                          $('#likes_<?php echo $r['id']; ?>').data('type', 1);
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
      $(document).ready(function(){
        $(".reportText").on("click", function(e){
            
            var postId = $(this).data('postid');
            var reportText = $(this);
            console.log(postId);
            
            $.ajax({
                method: "POST",
                url: "ajax/report_post.php",
                dataType: "json",
                data: {
                    postId: postId
                }
            }).done(function(res){
                console.log(res);
                if(res.status === "success"){
                    reportText.text("Undo");
                } 
                
            });
            
            e.preventDefault();
        });
        
      });
      
    </script>


</body>
</html>