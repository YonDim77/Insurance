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
  <h3 style = "margin-top: 7.0vw;">Запис на данни на консултант</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <table class = "iDataInput">
        <tr>
	        <td>Име*<br><input type="text" name="First_Name" required="required" placeholder = "Задължително попълване"/></td>
            
            <td>Фамилия*<br><input type="text" name="Last_Name" required="required" placeholder = "Задължително попълване"/></td>
            
            <td>Телефон*<br><input type="text" name="Phone" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td><br>Адрес*<br><input type="text" name="Address" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Имейл като<br>потребителско име*<br><input type="email" name="Username" required="required" placeholder = "Задължително попълване"></td>
            
	        <td><br>Парола*<br><input type="password" name="Password" required="required" placeholder = "Задължително попълване"></td>
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
  
//  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
  
  if(strcmp($password, $checkPassword) != 0) {
      $message = "Паролите не съвпадат! Опитайте отново!";
  	  echo "<script>alert('$message');</script>";
  }
  else {
      
    $sqlUsernameCheck = "INSERT INTO usernames (username)
    VALUES
    ('$_POST[Username]')";
    
    $sql="INSERT INTO consultant (First_Name, Last_Name, Phone, Address, Username, Password)
    VALUES
    ('$_POST[First_Name]', '$_POST[Last_Name]', '$_POST[Phone]', '$_POST[Address]', '$_POST[Username]','$password')";
            
    mysqli_autocommit($con, FALSE);
  
     if (mysqli_query($con, $sqlUsernameCheck) && mysqli_query($con, $sql)) {
      $last_id = mysqli_insert_id($con);
      mysqli_commit($con);
  	  $message = "Данните са записани успешно!";
  	  echo "<script>alert('$message');</script>";
     }  
     else {  
      mysqli_rollback($con);
  	  $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име!";
      echo "<script>alert('$message');</script>";
     }
  }
  
  $result = mysqli_query($con, "SELECT * FROM consultant WHERE Consultant_ID = $last_id");

  $h1 = " ";
  $h2 = " ";
  if ($h1 == " "){$color="#d8f0f3";}
  if ($h2 == " "){$color1="white";}

  echo "<br><br>";

echo "<div align = 'center'>";

if($last_id > 0) {
    
    echo "<table border='2'>
    <tr>
    <th bgcolor='$color1'>$h2 ID/№</th>
    <th bgcolor='$color1'>$h2 Име</th>
    <th bgcolor='$color1'>$h2 Фамилия</th>
    <th bgcolor='$color1'>$h2 Телефон</th>
    <th bgcolor='$color1'>$h2 Адрес</th>
    <th bgcolor='$color1'>$h2 Потребителско име</th>
    <th bgcolor='$color1'>$h2 Парола</th>
    <th bgcolor='$color1'>$h2 Дата</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['Consultant_ID'] . "</td>";
        echo "<td>" . $row['First_Name'] . "</td>";
        echo "<td>" . $row['Last_Name'] . "</td>";  
        echo "<td>" . $row['Phone'] . "</td>";
        echo "<td>" . $row['Address'] . "</td>";
        echo "<td>" . $row['Username'] . "</td>";
        echo "<td>" . $row['Password'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    
}

mysqli_close($con);
	
	
}
 
?>

  
</div>  
</body>
</html>