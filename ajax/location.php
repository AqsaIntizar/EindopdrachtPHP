<?php
require_once '../bootstrap/bootstrap.php';
if(isset($_POST)){
    
    $_SESSION['lat'] = $_POST['lat'];
    $_SESSION['long'] = $_POST['long'];
    echo $_SESSION['lat'];
}