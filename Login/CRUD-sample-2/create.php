<?php
include_once('./config/Config.php');
include_once('./lib/Database.php');
include_once('./inc/header.php');
?>


<div class="container">
<h3 class="well text-center">How To Create User Manager in PHP MySQL</h3>
<?php 
    $db = new Database();
    // check the form
    if(isset($_POST['submit']))
    {
        $firstname= mysqli_real_escape_string($db->link, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db->link, $_POST['lastname']);
        $phone =    mysqli_real_escape_string($db->link, $_POST['phone']);
        if($firstname == '' || $lastname == '' || $phone == ''){
            $errors = "<div class='alert alert-danger'> the fields can not be empty"."</div>";
            echo  $errors;
        }else{
            // insert into the database table
            $sql = "INSERT INTO tasks(firstname, lastname, phone) VALUES('$firstname', '$lastname', '$phone')";
            $createAll = $db->Insert($sql);
        }
    }

?>
<hr>
<span><a href="index.php" class="btn btn-success">Go Back</a></span>
<div style="max-width:500px; margin: 0 auto;">
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="Firstname">Firstname</label>
            <input type="text" name="firstname" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="Firstname">Lastname</label>
            <input type="text" name="lastname" class="form-control">
        </div>
        <div class="form-group">
            <label for="Firstname">Telephone</label>
            <input type="number" name="phone" placeholder="numbers only" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Add">
            <input type="reset" name="reset" class="btn btn-success" value="Cancel">
        </div>
    </form>
   
</div>
</div>