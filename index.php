<?php 

    require_once("bootstrap.php");
    
   

    if( isset($_SESSION['User']) ){

    }
    else{

        header('Location: login.php');
    }

    $posts = Post::getAll();
  

   

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>includeFood - Home</title>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>
    <div class="feed">
    <div class="addContent"><a href="newPost.php">Add some fresh content here</a></div>
    <?php $counter = 0; ?>
    
    <?php foreach($posts as $post): ?>
   
    <div class="post" id="<?php echo $counter; ?>">
    <img src="<?php echo $post->post_img_dir ?>" alt="">
    <p class="description"><?php echo $post->post_description?></p>
    <p><strong><?php echo $post->username ?></strong></p>
    <div><a href="#" data-id="<?php echo $post->id ?>" class="like">Like</a> <span class='likes'><?php echo $post->getLikes(); ?></span> people like this </div>
    </div>

    <div class="fullView" id="full-<?= $counter; ?>">
        <span class="x">X</span>
        <img src="<?php echo $r['post_img_dir'] ?>" alt="">
    </div>
    
    <?php $counter++; ?>
    <?php endforeach;?>

    </div>
    <script>
       

       $('.post').on('click', function(){
            const bigImg = $(this).attr('id');
            $('#full-' + bigImg).fadeIn();
       });

       $('.x').on('click', function(){
           $('.fullView').fadeOut();
       });


    </script>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

	<script>
		$("a.like").on("click", function(e){
			var postId = $(this).data("id");

			var link = $(this);

			$.ajax({
				method: "POST",
			  url: "ajax/like.php",
			  data: { postId: postId },
				dataType: 'json'
			})
		  .done(function(res) {
		    
			if(res.status == "succes"){
				var likes = link.next().html();
				likes++;
				link.next().html(likes);
				console.log(likes);
			}

		  });

			e.preventDefault();
		});
	</script>

</body>
</html>