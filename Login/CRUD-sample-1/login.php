<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="" href="css/style_login.css">
    <link rel="stylesheet" type="" href="css/style_register.css">
    <title>log</title>
    <link rel="icon" type="" href="imgdata/key.ico">
    <style>
        li {
            list-style-type: none;
        }
    </style>
</head>

<body style="background-color: rgb(194, 198, 244);">
  <table>
        <tr>
            <td>userid</td>
            <td>username</td>
            <td>password</td>
        </tr>
        <?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "login";
            $flag = 0;
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT userid, username, password FROM login";
            $result = $conn->query($sql);
            
            $_userid = $_POST['userid'];
            $_name = $_POST['name'];
            $_password = $_POST['password'];

            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                ?>
            <tr>
                <td><?php $row["userid"] ?></td>
                <td><?php $row["username"] ?></td>
                <td><?php $row["password"] ?></td>
            </tr>
                <?php
              }
              if($flag == 1){
                header("location: index.php");
              } else{
              }
            } else {
              header("location: index.php");
            }
            $conn->close();
        ?>
    </table>
</body>

</html>

