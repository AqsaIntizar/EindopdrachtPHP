<div class="logo"></div>
<nav>
    <ul class="navFlex">
        <li><a href="index.php" class="navLink">Home</a></li>
        <li><a href="#" class="navLink">Link 2</a></li>
        <li><a href="#" class="navLink">Link 3</a></li>
        <li><a href="#" class="navLink">Link 4</a></li>
        <form action="search.php" method="get">
            <input type="text" name="searchResult" placeholder="Search...">
        </form>
        <li>
            <div class="dropdown">
                <img src="images/profilePics/<?php echo $_SESSION['user']['img_dir']; ?>" class="dropbtn">
                <div class="dropdown-content">
                    <a href="settings.php">Instellingen</a>
                    <a href="logout.php">Hi <?php echo $_SESSION['user']['username']; ?>, log out?</a>
                </div>
            </div>
        </li>
    </ul>
</nav>