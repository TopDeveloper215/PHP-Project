<html lang="de">
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="style.css"/>
</head>
<body style="padding: 20px;">
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['gmail'])) {
        $gmail = stripslashes($_REQUEST['gmail']);    // removes backslashes
        $gmail = mysqli_real_escape_string($con, $gmail);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE gmail = '$gmail'
                     AND password='$password'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['gmail'] = $gmail;
            // Redirect to user dashboard page
            if (isset($_POST['submit'])) {
                setcookie("gmail", $_POST["gmail"], time() + 3600, "/", "", 0);
                setcookie("password", $_POST["password"], time() + 3600, "/", "", 0);
                echo "Cookies erstellt !!";
            }
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Falscher Benutzername / Passwort.</h3><br/>
                  <p class='link'>Hier klicken, um <a href='login.php'>Anmeldung</a> nochmal.</p>
                  </div>";
        }
    } else {
?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
        <h1 class="title-main">Anmelden / Registration</h1><br>
            <div class="paragraph">
                <div class="markdown">
                <!--<font color="#FF0000">Aus technischen Gründen sind Teile unserer Plattform aktuell nicht erreichbar.</font><br /><br />-->
                <p>Für die Seite, welche Sie aufrufen möchten, benötigen Sie ein Benutzerkonto. <br>
                Registrieren Sie sich jetzt neu oder melden Sie sich mit Ihren Zugangsdaten an.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-1"></div>
        <div class="col-md-8" style="border-radius: 10px;padding: 20px 0px 20px 20px; border: 1px solid black;border-color: #d8d8d8;height: auto; background: #fbfbfb;margin-left:8px;">
            <div class="row" style="padding: 4px;">      
                <div class="col-md-6" style="border:none;border-right: 1px solid black;">
                    <h2 class="title-secondary">Anmelden</h2>
                    <p>Ich habe bereits ein Benutzerkonto.</p>
                    <button><a href="registration.php" style="text-decoration:none;color: black;">Anmelden</a></button>
                    
                </div>
                <div class="col-md-6">
                    <h2 class="title-secondary">Neu registrieren</h2>
                    <p>Ich bin neu bei AutoScout24.</p>
                    <form action="" method="post">
                        <p style="margin: 0;font-weight: bold;">E-Mail oder Member-ID</p>
                        <input type="email" name="gmail" placeholder="" required />
                        <p style="margin: 0;font-weight: bold;">Passwort</p>
                        <input type="password" name="password" placeholder="">
                        <input type="checkbox" style="width: 14px;height: 14px;" >AutoScout24-Newsletter abonnieren
                        <br>
                        <p style="margin: 6px 0px; font-size: 14px;line-height: 18px;">Ich anerkenne die <a href="https://scout24.ch/de/datenschutz/datenschutzbestimmungen/">Datenschutzbestimmungen</a> von SMG Swiss Marketplace Group AG</p>
                        <input style="float: right; width: 30%; background-color: #f5f200;" type="submit" name="submit" value="Neu registrieren">
                    </form><br>
                </div>
            </div>
        </div>
        
    </div>
<?php
    }
?>
</body>
</html>
