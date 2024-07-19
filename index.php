<?php

session_start();

if (isset($_SESSION['mainAdminUsername']) && isset($_SESSION['mainAdminfName']) && isset($_SESSION['mainAdminlName'])) {
header('Location: homeMainAdmin.php');
}

if (isset($_SESSION['adminUsername']) && isset($_SESSION['adminfName']) && isset($_SESSION['adminlName'])) {
header('Location: homeAdmin.php');
}

if (isset($_SESSION['subAdminUsername']) && isset($_SESSION['subAdminfName']) && isset($_SESSION['subAdminlName'])) {
header('Location: homeSubAdmin.php');
}

if (isset($_SESSION['individualNames'])) {
header('Location: homeIndividual.php');
}

if (isset($_SESSION['legalentityName'])) {
header('Location: homeLegalentity.php');
}

if (isset($_SESSION['userNameHolding'])) {
header('Location: homeHolding.php');
}

if (isset($_SESSION['consultantUserName']) && isset($_SESSION['consultantfName']) && isset($_SESSION['consultantlName'])) {
header('Location: homeConsultant.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Застраховки</title>
<link rel="shortcut icon" href="TitlePic1.jpg" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="css/startCss.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>


@media screen and (max-width: 767px) {
    .box {
        width: 100%;
        position: relative;
        
    }
}


body{
margin: 0;
padding: 0;
font-family: sans-serif;
background: #34495e;
}
.box{
	width: 500px;
	padding: 40px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
	background: #191919;
	text-align: center;
	border-radius: 5px;
}
.box h3{
	color: white;
	text-transform: uppercase;
	font-weight: 500;
}
.box input[type = "text"],.box input[type = "password"]{
	border: 0;
	background: none;
	display: block;
	margin: 20px auto;
	text-align: center;
	border: 2px solid #3498db;
	padding: 14px 10px;
	width: 200px;
	outline: none;
	color: white;
	border-radius: 24px;
	transition: 0.25s;
}
.box input[type = "text"]:focus,.box input[type = "password"]:focus{
	width: 280px;
	border-color: #2ecc71;
}
.box input[type = "submit"]{
	border: 0;
	background: none;
	display: block;
	margin: 20px auto;
	text-align: center;
	border: 2px solid #2ecc71;
	padding: 14px 40px;
	outline: none;
	color: white;
	border-radius: 24px;
	transition: 0.25s;
	cursor: pointer;
}
.box input[type = "submit"]:hover{
	background: #2ecc71;
}


</style>
</head>
<body>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script>
$(function(){
  $('a').each(function() {
    if ($(this).prop('href') == window.location.href) {
      $(this).addClass('current');
    }
  });
});
</script>

</body>

<div align="center">
<br><br>

<?php

//$passwordTest = 'тест123';
//$hash = password_hash($passwordTest, PASSWORD_DEFAULT);
//
//if (password_verify($passwordTest, $hash)) {
//    echo 'Password is valid!';
//} else {
//     echo 'Invalid password.';
//}


$btnSubmit = false;

if(isset($_POST["btnSubmit"])) {
	$btnSubmit = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSubmit && 
   (!isset($_SESSION['mainAdminUsername']) && !isset($_SESSION['mainAdminfName']) && !isset($_SESSION['mainAdminlName']) &&
    !isset($_SESSION['adminUsername']) && !isset($_SESSION['adminfName']) && !isset($_SESSION['adminlName']) &&
    !isset($_SESSION['subAdminUsername']) && !isset($_SESSION['subAdminfName']) && !isset($_SESSION['subAdminlName']) &&
    !isset($_SESSION['individualNames']) && !isset($_SESSION['legalentityName']) && !isset($_SESSION['userNameHolding']) &&
    !isset($_SESSION['consultantUserName']) && !isset($_SESSION['consultantfName']) && !isset($_SESSION['consultantlName']))) {
    
   $con = mysqli_connect("localhost","stepsoft_admin","desibug82", "stepsoft_insurance");
   if(!$con)
     {
     die('Could not connect: ' . mysqli_error());
     }
   
   mysqli_select_db($con, "stepsoft_insurance");
   
   
   mysqli_query($con, "SET CHARACTER SET utf8");
//mysql_query("SET CHARACTER SET utf8");
//mysqli_set_charset($con, "utf8");
  
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    $resultMainAdmin = mysqli_query($con, "SELECT * FROM mainadmin
                         WHERE BINARY username = '$username'
                         AND BINARY password = '$password'");
                         
    $resultAdmin = mysqli_query($con, "SELECT * FROM admin
                         WHERE BINARY username = '$username'
                         AND BINARY password = '$password'");
 						
    $resultSubAdmin = mysqli_query($con, "SELECT * FROM subadmin
                         WHERE BINARY username = '$username'
                         AND BINARY password = '$password'");
                         
    $resultIndividual = mysqli_query($con, "SELECT * FROM individual
                         WHERE BINARY Email_Username = '$username'
                         AND BINARY Password = '$password'");
                         
    $resultLegalentity = mysqli_query($con, "SELECT * FROM legalentity
                        WHERE BINARY Email_Username = '$username'
                        AND BINARY Password = '$password'");
    
    $resultHolding = mysqli_query($con, "SELECT * FROM holdingusers
                        WHERE BINARY Username = '$username'
                        AND BINARY Password = '$password'");                    
                        
    $resultConsultant = mysqli_query($con, "SELECT * FROM consultant
                        WHERE BINARY Username = '$username'
                        AND BINARY Password = '$password'");                   
                        
   if($row = mysqli_fetch_assoc($resultMainAdmin)) 
   {
       //if (password_verify($password, $row['password']))
       //{    
          $_SESSION['mainAdminfName'] = $row['fName'];
	      $_SESSION['mainAdminlName'] = $row['lName'];
	      $_SESSION['mainAdminUsername'] = $_POST["username"];
	      $_SESSION['mainAdminPassword'] = $_POST["password"];
	      $_SESSION['saveEmailUsername'] = "";
	      $_SESSION['savePageNumber'] = 1;
      
//        Jump to secured page
          //header('Location: homeMainAdmin.php');
          echo "<script> location.replace('homeMainAdmin.php'); </script>";
          
          echo"<div align = 'center'>";           
	      echo "</div>";
	      mysqli_close($con);
       //}
   }
   else if($row = mysqli_fetch_assoc($resultAdmin))  
   {
       //if(password_verify($password, $row['password']))
       
         $_SESSION['adminfName'] = $row['fName'];
	     $_SESSION['adminlName'] = $row['lName'];
	     $_SESSION['adminUsername'] = $_POST["username"];
	     $_SESSION['adminPassword'] = $_POST["password"];
        
//    Jump to secured page
//    header('Location: homeAdmin.php');
         echo "<script> location.replace('homeAdmin.php'); </script>";
       
         echo"<div align = 'center'>";           
	     echo "</div>";
         mysqli_close($con);
       
  }
  
  else if($row = mysqli_fetch_array($resultSubAdmin)) 
  {

	  $_SESSION['adminUserName'] = $row['Admin_Username'];
      $_SESSION['subAdminfName'] = $row['fName'];
	  $_SESSION['subAdminlName'] = $row['lName'];
	  $_SESSION['subAdminUsername'] = $_POST["username"];
	  $_SESSION['subAdminPassword'] = $_POST["password"];
      
//    Jump to secured page
//    header('Location: homeSubAdmin.php');
      echo "<script> location.replace('homeSubAdmin.php'); </script>";
      
      echo"<div align = 'center'>";           
	  echo "</div>";
	  mysqli_close($con);
  }
  
  else if($row = mysqli_fetch_array($resultIndividual)) 
  {

	  $_SESSION['individualNames'] = $row['Names'];
	  $_SESSION['individualID'] = $row['Individual_ID'];
      
      
//    Jump to secured page
//    header('Location: homeSubAdmin.php');
      echo "<script> location.replace('homeIndividual.php'); </script>";
      
	  mysqli_close($con);
  }
  
  else if($row = mysqli_fetch_array($resultLegalentity)) 
  {

	  $_SESSION['legalentityName'] = $row['Name'];
      $_SESSION['legalentityID'] = $row['Legalentity_ID'];
      
//    Jump to secured page
//    header('Location: homeSubAdmin.php');
      echo "<script> location.replace('homeLegalentity.php'); </script>";
      
	  mysqli_close($con);
  }
  
  else if($row = mysqli_fetch_array($resultHolding)) 
  {

	  $_SESSION['holdingName'] = $row['Holding_Name'];
	  $_SESSION['userHoldingfName'] = $row['First_Name'];
	  $_SESSION['userHoldinglName'] = $row['Last_Name'];
      $_SESSION['usernameHolding'] = $row['Username'];
      
//    Jump to secured page
//    header('Location: homeSubAdmin.php');
      echo "<script> location.replace('homeHolding.php'); </script>";
      
	  mysqli_close($con);
  }
  
  else if($row = mysqli_fetch_assoc($resultConsultant))  
  {
       //if(password_verify($password, $row['password']))
       
         $_SESSION['consultantUserName'] = $row['Username'];
         $_SESSION['consultantfName'] = $row['First_Name'];
	     $_SESSION['consultantlName'] = $row['Last_Name'];
        
//    Jump to secured page
//    header('Location: homeAdmin.php');
         echo "<script> location.replace('homeConsultant.php'); </script>";
       
         echo"<div align = 'center'>";           
	     echo "</div>";
         mysqli_close($con);
       
  }
  
  else
  {
	  echo"<div align = 'center'>";
      echo"<br><br>";   
      $message = "Грешен E-mail или парола.Моля опитайте отново.";
      echo "<script>alert('$message');</script>";
      //echo"<span style='color:white; font-size: 20px;'>Грешен E-mail или парола.Моля опитайте отново.</span>";
	  echo "</div>";

      mysqli_close($con);
  }

}  	

?>
<br><br>
<form class="box" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8">
<h3>Вход в профил:</h3><br>
<span style = "color: #2ecc71;">Потребител:</span><br><input type="text" value = "<?php echo 'MoniBos@abv.bg'; ?>" name="username" required="required"/><br>
<span style = "color: #2ecc71;">Парола:</span><br><input type="password" value = "<?php echo '123';?>" name="password" required="required" /><br>
<input type="submit" name = "btnSubmit" value="Вход"/>
</form>
</div>

</html>
