<?php
    require_once 'bootstrap/bootstrap.php';

    if (isset($_SESSION['user'])) {
        //logged in user
        //echo "😁";
    } else {
        //no logged in user
        //echo "😒";
        header('Location: login.php');
    }
    $userName = $_SESSION['user']['id'];
    if (isset($_POST['uploadPost'])) {
        //echo $_SERVER['REQUEST_METHOD'] . " ";
        if (!empty($_POST['description'])) {
            $post = new Upload();
            $post->setFileName($_FILES['imageFile']['name']);
            $post->setFileType($_FILES['imageFile']['type']);
            $post->setFileTempName($_FILES['imageFile']['tmp_name']);
            $post->setFileSize($_FILES['imageFile']['size']);
            $post->setTargetDir('images/posts/');
            $post->setDescription($_POST['description']);
            $post->setUserId($_SESSION['user']['id']);
            $post->setFilter($_POST['filterClass']);
            date_default_timezone_set('Europe/Brussels'); //set timezone for correct date
            $post->setDateTime(date('Y-m-d H:i:s'));
            $location = new Location();
            $loc = $location->getcity();

            echo $_SESSION['long'];

            $result = $post->uploadPost($userName, $_SESSION['lat'], $_SESSION['long'], $loc);

            header('Location: index.php');
        } else {
            $newPostError = true;
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/addpost.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <title>incFood</title>
</head>
<body>
    <section class="newPost">
        <h1>Food up the Feed!</h1>
        <h2>Add some new content here</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <figure class="hidden filterPre">
                <img class="preview" src="#" alt="Your image" />
            </figure>
            <figure class="hidden slide">
                <a class="applyFilter" href="#"><img class="filters none" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters _1977" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters brannan" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters clarendon" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters earlybird" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters gingham" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters inkwell" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters kelvin" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters maven" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters nashville" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters perpetua" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters toaster" src="#" alt="Filters"></a>
                <a class="applyFilter" href="#"><img class="filters valencia" src="#" alt="Filters"></a>
            </figure>
            <input class="filterClass" type="hidden" name="filterClass" value="123">
            <p>
                <input class="addcontent" type="file" name="imageFile" id="file" data-multiple-caption="{count} files selected" multiple onchange="readURL(this);" >
                <label for="file">Choose a file</label>
                <!-- <script>var inputs = document.querySelectorAll( '.inputfile' );
 
                    Array.prototype.forEach.call( inputs, function( input ) {
                    var label = input.nextElementSibling,
                                labelVal = label.innerHTML;
                    
                    input.addEventListener( 'change', function( e ) {
                        var fileName = '';
                        
                        if ( this.files && this.files.length > 1 ) {
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                        } else {
                        fileName = e.target.value.split( '\\' ).pop();
                        }
                    
                        if ( fileName ) {
                        label.querySelector( 'span' ).innerHTML = fileName;
                        } else {
                        label.innerHTML = labelVal;
                        }
                    });
                    });</script> -->
            </p>
            <?php if (isset($newPostError)): ?>
                <div class="form__error">
                    <p class="error">
                        Sorry, you need to fill in the description.
                    </p>
                </div>
            <?php endif; ?>
            <p>Add some description down below.</p>
            <input type="text" id="description" name="description"><br>
        <input type="submit" name="uploadPost" value="Upload post">
        </form>
</section>
<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

<script>

        $( document ).ready(function() {

            navigator.geolocation.getCurrentPosition(showPosition);
            function showPosition(position) {
                var lat = position.coords.latitude
                var long = position.coords.longitude; 
                    $.ajax({
                    method: "POST",
                    url: "ajax/location.php",
                    data: { 
                        lat: lat,
                        long: long
                    },
                    dataType: 'json'
                })
                .done( function( res ){
                    console.log(res);
                    
                });
            }
            
        })
    </script>
    <script type="text/javascript">
    // hide figures by default
    $('.hidden').css('display','none');
    // show figure and filters on image selection
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.preview').attr('src', e.target.result);
                    $('.filters').attr('src', e.target.result);
                    $('.preview').css('display','block');
                    $('.hidden').css('display','block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    // on filter click apply filter on preview image
    $('.applyFilter').on("click", (e)=>{
        // get classname of the filter
        // classname of filter will be in elementClasses[1]
        let elementClasses = e.target.className.split(" ");
        
        // set filter class to preview element
        $(".filterPre").attr("class", `hidden filterPre ${elementClasses[1]}`);
        $(".filterClass").val(`${elementClasses[1]}`);
        
        e.preventDefault();
    })
    </script>
</body>
</html>