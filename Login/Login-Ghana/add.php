<?php 
    $con = mysqli_connect('localhost','root','','log_in');
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = $_POST['password confirm'];

    $query_order = "INSERT INTO login(userid, username, password, password confirm) VALUES('$userid','$username','$password', '$password_confirm');";

    $result = mysqli_query($con,$query_order);

    if($result == false)
    {
        echo "<script>alert('INSERT IS NOT SUCCESS');</script>";

    }
    else
    {
        echo "<script>alert('INSERT SUCCESS');</script>";
        header("location: admin.html");
    }
?>