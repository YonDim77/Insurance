<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="adminCss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script> 

    $(function(){
      $("#nav").load("nav.php"); 
    });
    
</script>

<style>

body {
    
}

table {
    width: 100%;
}

th, td {
    
    text-align: center;
}


</style>
</head>
<body>  

<div id = "nav"></div>
<br>

<div align = "center">
  <h3 style = "margin-top: 7.0vw;">Запис на данни на потребител</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">
    <table class = "iDataInput"> 
        <tr>
            <td>Подадминистратор<br> 
	        потребителско име<br><input type="email" name="Admin_Username"></td>
            
	        <td><br>Име*<br><input type="text" name="Ime" required="required" placeholder = "Задължително попълване"/></td>
            
            <td><br>Фамилия*<br><input type="text" name="Familia" required="required" placeholder = "Задължително попълване"/></td>
        </tr>
        <tr>
            <td><br>Имейл*<br><input type="email" name="Email" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Имейл като<br>потребителско име*<br><input type="email" name="Username" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Парола*<br><input type="password" name="Password" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td></td>
            <td>Парола<br>повторно въвеждане*<br><input type="password" name="checkPassword" required="required" placeholder = "Задължително попълване"></td>
            <td></td>
        </tr>
     
    </table><br><br><br>
    <input type="submit" name="btnSave" value="Запис" style = "border-radius: 2px; color: red; width: 174px;">
  </form>
  <br><br>
 
<?php

include 'functions.php';

$btnSave = false;

if(isset($_POST["btnSave"])) {
	$btnSave = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSave == true) {
  $con = connectServer();
   
   $password = $_POST['Password'];
   $checkPassword = $_POST['checkPassword'];
//   $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

  if(strcmp($password, $checkPassword) != 0) {
      $message = "Паролите не съвпадат! Опитайте отново!";
  	  echo "<script>alert('$message');</script>";
  }
  else {

    $sqlUsernameCheck = "INSERT INTO usernames (username)
    VALUES
    ('$_POST[Username]')";
  
    $sql="INSERT INTO subadmin (Admin_Username, fName, lName, Email, username, password)
    VALUES
    ('$_POST[Admin_Username]', '$_POST[Ime]', '$_POST[Familia]', '$_POST[Email]', '$_POST[Username]','$password')";
    //('$_POST[Admin_Username]', '$_POST[Ime]', '$_POST[Familia]', '$_POST[Email]', '$_POST[Username]','$hashed_password')";
    
    
    mysqli_autocommit($con, FALSE);
  
     if (mysqli_query($con, $sqlUsernameCheck) && mysqli_query($con, $sql)) {
      mysqli_commit($con);
  	$message = "Данните са записани успешно!";
  	echo "<script>alert('$message');</script>";
     }  
     else {  
      mysqli_rollback($con);
  	$message = "Възникна грешка, опитайте отново! Дублиране на потребителско име!";
      echo "<script>alert('$message');</script>";
     }
     mysqli_query($con, "SET AUTOCOMMIT=TRUE");
  
     
  }

mysqli_close($con);
	
	
}
 
?>


  
</div>  
</body>
</html>