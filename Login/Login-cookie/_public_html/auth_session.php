<?php
    session_start();
    if(!isset($_SESSION["gmail"])) {
        header("Location: login.php");
        exit();
    }
?>
