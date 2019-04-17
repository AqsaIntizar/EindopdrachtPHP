<?php 
require_once("classes/Db.class.php");
?><div class="logo"></div>
<nav>
    <ul class="navFlex">
        <li><a href="#" class="navLink">Link 1</a></li>
        <li><a href="#" class="navLink">Link 2</a></li>
        <li><a href="#" class="navLink">Link 3</a></li>
        <li><a href="#" class="navLink">Link 4</a></li>
        <li>
            <div class="dropdown">
                <img src="https://fakeimg.pl/50x50/?text=MyPic" class="dropbtn">
                <div class="dropdown-content">
                    <a href="settings.php">Instellingen</a>
                    <a href="logout.php">Hi <?php echo $_SESSION['UserName']; ?>, log out?</a>
                </div>
            </div>
        </li>
    </ul>
</nav>