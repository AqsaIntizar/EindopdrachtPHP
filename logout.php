<?php
    require_once 'bootstrap/bootstrap.php';
    session_destroy();
    header('Location: login.php');
