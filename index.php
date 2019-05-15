<?php
    require_once 'bootstrap/bootstrap.php';
    if (isset($_SESSION['user'])) {
        //logged in user
        //echo "😎";
    } else {
        //no logged in user
        header('Location: login.php');
    }
    if (Post::getAllFollows($_SESSION['user']['id'])) {
        $result = Post::getAllFollows($_SESSION['user']['id']);
        // $result += Post::getAll();
    } else {
        $result = Post::getAll();
        
    }
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
    <div class="homepage">
        <a href="newPost.php" class="btn">Add some fresh content here</a>
        <div class="feed">
        

        <!-- start lus posts-->
        <?php foreach ($result as $r): ?>
            
            <div class="post post--home" id="<?php echo $r['id']; ?>">
                <a href="single.php?post=<?php echo $r['id']; ?>"><img class="postImg" src="images/posts/mini-<?php echo $r['post_img_dir']; ?>" alt=""></a>
                <div class="post_info">
                    <a href="profileDetails.php?id=<?php echo $r['user_id']; ?>" class="post__item"><span class="infoBlock"><strong><?php echo $r['username']; ?></strong></span></a>
                    <p class="description"><?php echo $r['post_description']; ?></p>
                </div>
            </div>

    
    
        <?php endforeach; ?>
        <!-- einde lus -->
        </div>

        <a href="#" class="load btn">Load More</a>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  
    
  
    <script>
        $(".load").on("click", function(e){
            e.preventDefault();
            
            let counter = $(".post").length + 5;
            
            $.ajax({
                method: "POST",
                url: "ajax/load_more.php",
                data: { 
                    showitems: counter
                },
                dataType: 'json'
            })
            .done( function( res ){
                console.log(res);
                if(res.status == "success"){
                    const posts = res.data.posts;
                    let newImages = [];
                    $('.feed').empty();
                    posts.map(post => {
                        //regex hashtag
                        //timing
                        newImages.push(`<div class="post post--home" id="${post.id}">
                                <a href="single.php?post=${post.id}"><img class="postImg" src="images/posts/mini-${post.post_img_dir}" alt=""></a>
                                <div class="post_info">
                                    <a href="profileDetails.php?id=${post.user_id}" class="post__item"><span class="infoBlock"><strong>${post.username}</strong></span></a>
                                    <p class="description">${post.post_description}</p>
                                </div>
                                
                                
                            </div>`);
                    });
                    $('.feed').append(newImages);               
                }
            });
            
        });
    </script>
</body>
</html>