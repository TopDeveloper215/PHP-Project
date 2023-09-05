
<?php
session_start();
// Checking first page values for empty,If it finds any blank field then redirected to first page.
if (isset($_POST['name'])){
 if (empty($_POST['name'])
 || empty($_POST['email'])
 || empty($_POST['contact'])
 || empty($_POST['password'])
 || empty($_POST['confirm'])){ 
 // Setting error message
 $_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
 header("location: page1_form.php"); // Redirecting to first page 
 } else {
 // Sanitizing email field to remove unwanted characters.
 $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
 // After sanitization Validation is performed.
 if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
 // Validating Contact Field using regex.
 if (!preg_match("/^[0-9]{10}$/", $_POST['contact'])){ 
 $_SESSION['error'] = "10 digit contact number is required.";
 header("location: page1_form.php");
 } else {
 if (($_POST['password']) === ($_POST['confirm'])) {
 foreach ($_POST as $key => $value) {
 $_SESSION['post'][$key] = $value;
 }
 } else {
 $_SESSION['error'] = "Password does not match with Confirm Password.";
 header("location: page1_form.php"); //redirecting to first page
 }
 }
 } else {
 $_SESSION['error'] = "Invalid Email Address";
 header("location: page1_form.php");//redirecting to first page
 }
 }
} else {
 if (empty($_SESSION['error_page2'])) {
 header("location: page1_form.php");//redirecting to first page
 }
}
?>
<!DOCTYPE HTML>
<html>
 <head>
 <title>PHP Multi Page Form</title>
 <link rel="stylesheet" href="style.css" />
 </head>
 <body>
 <div class="container">
 <div class="main">
 <h2>PHP Multi Page Form</h2><hr/>
 <span id="error">
<?php
// To show error of page 2.
if (!empty($_SESSION['error_page2'])) {
 echo $_SESSION['error_page2'];
 unset($_SESSION['error_page2']);
}
?>
 </span>
 <form action="page3_form.php" method="post">
 <label>Religion :<span>*</span></label>
 <input name="religion" id="religion" type="text" value="" >
 <label>Nationality :<span>*</span></label><br />
 <input name="nationality" id="nationality" type="text" value="" >
 <label>Gender :<span>*</span></label>
 <input type="radio" name="gender" value="male" required>Male
 <input type="radio" name="gender" value="female">Female
 <label>Educational Qualification :<span>*</span></label>
 <select name="qualification">
 <option value="">----Select----</options>
 <option value="graduation" value="">Graduation </options>
 <option value="postgraduation" value="">Post Graduation </options>
 <option value="other" value="">Other </options>
 </select>
 <label>Job Experience :<span>*</span></label>
 <select name="experience">
 <option value="">----Select----</options>
 <option value="fresher" value="">Fresher </options>
 <option value="less" value="">Less Than 2 year </options>
 <option value="more" value="">More Than 2 year</options>
 </select>
 <input type="reset" value="Reset" />
 <input type="submit" value="Next" />
 </form>
 </div>
 </div>
 </body>
</html>

