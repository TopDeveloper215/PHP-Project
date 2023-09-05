<html lang="de">
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="style.css"/>

</head>
<body style="padding : 20px;"> 
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['gmail'])) {
        // removes backslashes
        $gmail = stripslashes($_REQUEST['gmail']);
        //escapes special characters in a string
        $gmail = mysqli_real_escape_string($con, $gmail);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "INSERT into `users` ( gmail, password)
                     VALUES ('$gmail', '$password')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Sie sind erfolgreich registriert.</h3><br/>
                  <p class='link'>Hier klicken, um <a href='login.php'>Anmeldung</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Erforderliche Felder fehlen.</h3><br/>
                  <p class='link'>Hier klicken, um <a href='registration.php'>Anmeldung</a> nochmal.</p>
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
        <div class="col-md-8" style="border-radius: 10px;padding: 20px; border: 1px solid black;border-color: #d8d8d8;height: auto; background: #fbfbfb;margin-left:8px;">
            <div class="row" style="padding: 4px;">      
                <div class="col-md-6" style="border:none;border-right: 1px solid black;">
                    <h2 class="title-secondary">Anmelden</h2>
                    <p>Ich habe bereits ein Benutzerkonto.</p>
                    <form action="" method="post">
                        <p style="margin: 0;font-weight: bold;">E-Mail oder Member-ID</p>
                        <input type="email" name="gmail" placeholder="" required />
                        <p style="margin: 0;font-weight: bold;">Passwort</p>
                        <input type="password" name="password" placeholder="">
                        <p style="float: left;"><a href="#">Passwort vergessen?</a></p>
                        <input style="float: right; width: 20%;background-color: #f5f200;" type="submit" name="submit" value="Anmelden">
                    </form>
                </div>
                <div class="col-md-6">
                    <h2 class="title-secondary">Neu registrieren</h2>
                    <p>Ich bin neu bei AutoScout24.</p>
                    <h3 class="title-secondary" style="font-size: 14px;">Schnell und einfach registrieren</h3>
                    <ul style="padding: 0% 10%;">
                        <li>Ihr Fahrzeug bei der Nr. 1 auf dem Schweizer Automarkt einfach inserieren</li>
                        <li>Suchaufträge speichern</li>
                        <li>Merkliste immer verfügbar</li>
                    </ul>
                    <button><a href="login.php" style="text-decoration:none;color: black;">Zur Registrierung</a></button>
                </div>
            </div>
        </div>   
    </div>
<?php
    }
?>
</body>
</html>
