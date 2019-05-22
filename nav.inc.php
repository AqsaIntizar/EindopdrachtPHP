<div class="logo"></div>
<nav>
    <ul class="navFlex">
        <li><a href="index.php" class="navLink">Home</a></li>
        <li><a href="follows.php" class="navLink">Follows</a></li>
        <li><a href="mostLiked.php" class="navLink">Most liked</a></li>
        <li><a href="hashtagFollow.php" class="navLink">Hashtags</a></li>
        <form class="search" action="search.php" method="get">
            <input type="text" name="searchResult" placeholder="Search..." class="search">
        </form>
        <li>
            <div class="dropdown">
                <img src="images/profilePics/<?php echo $_SESSION['user']['img_dir']; ?>" class="dropbtn">
                <div class="dropdown-content">
                    <a id="drop-black" href="settings.php">Instellingen</a>
                    <a id="drop-black" href="logout.php">Hi <?php echo $_SESSION['user']['username']; ?>, log out?</a>
                </div>
            </div>
        </li>
    </ul>
</nav>