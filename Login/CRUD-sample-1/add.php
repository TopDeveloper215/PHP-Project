<?php 
    $con = mysqli_connect('localhost','root','','login');
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $country = $_POST['country'];
    $birthday = $_POST['birthday'];
    $password = $_POST['password'];

    $query_order = "INSERT INTO login(userid, username, nationality, password, Birthday) VALUES('$userid','$username','$country', '$password', '$birthday');";

    $result = mysqli_query($con,$query_order);

    if($result == false)
    {
        echo "<script>alert('INSERT IS NOT SUCCESS');</script>";
    }
    else
    {
        echo "<script>alert('INSERT SUCCESS');</script>";
    }
?>