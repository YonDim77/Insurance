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
<!--<link rel="stylesheet" href="Insurance/startCss.css">-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="adminCss.css">

<script> 

    $(function(){
      $("#nav").load("nav.php"); 
    });
    
</script>

<style>
body {
    

}

table, th, td {
    text-align: center;
}

</style>
</head>
<body>  

<div id = "nav"></div> 
<br> 

<div align = "center">
    
    <form name="input"  method="post" accept-charset="UTF-8" style = "color: black; margin-top: 7.0vw;">
        <h3>Избери проверка за:</h3><br>    
	    <select id = "checkValue" name="CheckUp"  onchange = "showCheck()" required="required" style = "height: 27px;">
	    <option value="">Избери проверка за</option>
        <option value="mps">Проверка за физически лица без МПС</option>												
        <option value="ins">Проверка за физически лица без данни за застраховки, винетка и данък МПС</option>
        <option value="serv">Проверка за физически лица без данни за сервиз на МПС</option>
        <option value="rep">Проверка за физически лица без данни за ремонт на МПС</option>
        <option value="tyr">Проверка за физически лица без данни за гуми на МПС</option>
        </select>
    </form>
    
    
<script>
    
    function showCheck()
    {
        var choice = document.getElementById("checkValue").value;
        
        
        switch(choice)
	    {
		case "mps":   document.getElementById("mps").style.display = "block";
                      if(document.getElementById("mpsData") != null) document.getElementById("mpsData").style.display = "none";
                      document.getElementById("ins").style.display = "none";
                      document.getElementById("serv").style.display = "none";
                      document.getElementById("rep").style.display = "none";
                      document.getElementById("tyr").style.display = "none";
					  break;
					  
		case "ins":   document.getElementById("mps").style.display = "none";
                      document.getElementById("ins").style.display = "block";
                      if(document.getElementById("insData") != null) document.getElementById("insData").style.display = "none";
                      document.getElementById("serv").style.display = "none";
                      document.getElementById("rep").style.display = "none";
                      document.getElementById("tyr").style.display = "none"; 
					  break;
					  
		case "serv":  document.getElementById("mps").style.display = "none";
		              document.getElementById("ins").style.display = "none";
		              document.getElementById("serv").style.display = "block";
		              if(document.getElementById("servData") != null) document.getElementById("servData").style.display = "none";
		              document.getElementById("rep").style.display = "none";
		              document.getElementById("tyr").style.display = "none";
					  break;
					  
		case "rep":   document.getElementById("mps").style.display = "none";
		              document.getElementById("ins").style.display = "none";
		              document.getElementById("serv").style.display = "none";
		              document.getElementById("rep").style.display = "block";
		              if(document.getElementById("repData") != null)  document.getElementById("repData").style.display = "none";
		              document.getElementById("tyr").style.display = "none";
		          
					  break;
					  
		case "tyr":   document.getElementById("mps").style.display = "none";
		              document.getElementById("ins").style.display = "none";
		              document.getElementById("serv").style.display = "none";
		              document.getElementById("rep").style.display = "none";
		              document.getElementById("tyr").style.display = "block";
		              if(document.getElementById("tyrData") != null)  document.getElementById("tyrData").style.display = "none";
		              
					  break;			  
		//default:  alert(choice);			  
	    } 
    }
 

    
</script>

</div>

<div id = "mps" align = "center" style = "display: none;">
  <form  name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
    <h3 style = "margin-top: 4.0vw;">Проверка за физически лица без МПС</h3>
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    
    <br><br>
    <input type="submit" name="btnCheckAuto" value="Провери" style = "border-radius: 2px; color: red;">  
  </form>
 
<?php

include 'functions.php';


$btnCheckAuto = false;
$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnCheckAuto"])) {
	$btnCheckAuto = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnCheckAuto == true) {

echo '<script>document.getElementById("mps").style.display = "block";</script>';    
    
$con = connectServer();
  
$checkForAuto = mysqli_query($con, "SELECT individual.*
							FROM individual
							LEFT JOIN autos ON (individual.Individual_ID = autos.Individual_ID)
							WHERE autos.Individual_ID IS NULL ");
							
if (mysqli_num_rows($checkForAuto) < 1) {
		
		$message = "Няма физическо лице без МПС в базата данни!";
		echo "<script>alert('$message');</script>";
		
	
	}
	echo "<br><br>";
	if (mysqli_num_rows($checkForAuto) > 0) {
	
	echo"<div id = 'mpsData' align = 'center'>";
    echo '<span style="font-size: 20px; color:black;">Данни за физически лица без МПС</span>'; // . "  " .
	//'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	
    echo"<br><br>";
	
	echo "<table border='2'>
	
	
	<tr>
	<th bgcolor='$color1'>$h2 №</th>
	<th bgcolor='$color1'>$h2 Подаминистратор Потреб. име</th>
	<th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	<th bgcolor='$color1'>$h2 Име и Фамилия</th>
	<th bgcolor='$color1'>$h2 ЕГН</th>
	<th bgcolor='$color1'>$h2 Адрес</th>
	<th bgcolor='$color1'>$h2 Адрес на МПС</th>
	<th bgcolor='$color1'>$h2 Телефон</th>
	<th bgcolor='$color1'>$h2 Имейл</th>
	<th bgcolor='$color1'>$h2 Лице за контакти</th>
	<th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	<th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	<th bgcolor='$color1'>$h2 Потребителско име</th>
	<th bgcolor='$color1'>$h2 Парола</th>
	</tr>";
	
	while($row = mysqli_fetch_array($checkForAuto))
	{
	echo "<tr>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";	
	echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>";	
	echo "<td style = 'border: 1px solid black;'>" . $row['Names'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['EGN'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Address'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Address_MPS'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Email'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Contact_Person'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone_Contact_Person'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Contact_Person'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Username'] . "</td>";
	echo "<td style = 'border: 1px solid black;'>" . $row['Password'] . "</td>"; 
	echo "</tr>";
	}
	echo "</table>";
	echo"</div>";
	
	}
	mysqli_close($con);
	
}

?> 

</div>

<div id = "ins" align = "center" style = "display: none;">
<br>

  <form  name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
    
    <h3 style = "">Проверка за физически лица без данни за застраховки, винетка и данък МПС</h3>
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    
    <br><br>
    <input type="submit" name="btnCheckAutoTax" value="Провери" style = "border-radius: 2px; color: red;">  
  </form>
 
<?php

$btnCheckAutoTax = false;
$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnCheckAutoTax"])) {
	$btnCheckAutoTax = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnCheckAutoTax == true) {

echo '<script>document.getElementById("ins").style.display = "block";</script>';

  $con = connectServer();
  
$checkForAuto = mysqli_query($con, "SELECT individual.*
							FROM individual
							LEFT JOIN insurance ON (individual.Individual_ID = insurance.Individual_ID)
							WHERE insurance.Individual_ID IS NULL ");
							
if (mysqli_num_rows($checkForAuto) < 1) {
		
		$message = "Няма физическо лице без данни за застраховки, винетка и данък МПС в базата данни!";
		echo "<script>alert('$message');</script>";
		
		//echo"<br><br>";
		//echo"<div align = 'center'>";
		//echo '<span style="font-size: 20px; color:black;">Грешка! Няма</span>' . " " .
		//
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Names . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		//
		//echo"</div>";
	
	}
	echo "<br><br>";
	if (mysqli_num_rows($checkForAuto) > 0) {
	
	echo"<div id = 'insData' align = 'center'>";
    echo '<span style="font-size: 20px; color:black;">Физически лица без данни за застраховки, винетка и данък МПС</span>'; // . "  " .
	//'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	
    echo"<br><br>";
	
	echo "<table border='2'>
	
	<tr>
	<th bgcolor='$color1'>$h2 №</th>
	<th bgcolor='$color1'>$h2 Подаминистратор Потреб. име</th>
	<th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	<th bgcolor='$color1'>$h2 Име и Фамилия</th>
	<th bgcolor='$color1'>$h2 ЕГН</th>
	<th bgcolor='$color1'>$h2 Адрес</th>
	<th bgcolor='$color1'>$h2 Адрес на МПС</th>
	<th bgcolor='$color1'>$h2 Телефон</th>
	<th bgcolor='$color1'>$h2 Имейл</th>
	<th bgcolor='$color1'>$h2 Лице за контакти</th>
	<th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	<th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	<th bgcolor='$color1'>$h2 Потребителско име</th>
	<th bgcolor='$color1'>$h2 Парола</th>
	</tr>";
	
	while($row = mysqli_fetch_array($checkForAuto))
	{
	    echo "<tr>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";	
	    echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>";	
	    echo "<td style = 'border: 1px solid black;'>" . $row['Names'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['EGN'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Address'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Address_MPS'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Telephone'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Email'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Contact_Person'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Telephone_Contact_Person'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Email_Contact_Person'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Email_Username'] . "</td>";
	    echo "<td style = 'border: 1px solid black;'>" . $row['Password'] . "</td>"; 
	    echo "</tr>";
	}
	echo "</table>";
	echo"</div>";
	
	}
	mysqli_close($con);
	
}

?> 

</div>

<br>

<div id = "serv" align = "center" style = "display: none;">
    
  <form  name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
    
    <h3 style = "">Проверка за физически лица без данни за сервиз на МПС</h3>
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    
    <br><br>
    <input type="submit" name="btnCheckAutoService" value="Провери" style = "border-radius: 2px; color: red;">  
  </form>
 
<?php

$btnCheckAutoService = false;
$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnCheckAutoService"])) {
	$btnCheckAutoService = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnCheckAutoService == true) {
    
    echo '<script>document.getElementById("serv").style.display = "block";</script>';
    
    $con = connectServer();
  
    $checkForAuto = mysqli_query($con, "SELECT individual.*
    							FROM individual
    							LEFT JOIN service ON (individual.Individual_ID = service.Individual_ID)
    							WHERE service.Individual_ID IS NULL ");
    							
    if (mysqli_num_rows($checkForAuto) < 1) {
    		
    		$message = "Няма физическо лице без данни за сервиз на МПС в базата данни!";
    		echo "<script>alert('$message');</script>";
    	
    }
    echo "<br><br>";
    if (mysqli_num_rows($checkForAuto) > 0) {
    	
    	echo"<div id = 'servData' align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Физически лица без данни сервиз на МПС</span>'; // . "  " .
    	//'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
    	
        echo"<br><br>";
    	
    	echo "<table border='2'>
    	
    	
        <tr>
    	<th bgcolor='$color1'>$h2 №</th>
    	<th bgcolor='$color1'>$h2 Подаминистратор Потреб. име</th>
    	<th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
    	<th bgcolor='$color1'>$h2 Име и Фамилия</th>
    	<th bgcolor='$color1'>$h2 ЕГН</th>
    	<th bgcolor='$color1'>$h2 Адрес</th>
    	<th bgcolor='$color1'>$h2 Адрес на МПС</th>
    	<th bgcolor='$color1'>$h2 Телефон</th>
    	<th bgcolor='$color1'>$h2 Имейл</th>
    	<th bgcolor='$color1'>$h2 Лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Потребителско име</th>
    	<th bgcolor='$color1'>$h2 Парола</th>
    	</tr>";
      	
    	while($row = mysqli_fetch_array($checkForAuto))
    	{
    	    echo "<tr>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";	
    	echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>";	
    	echo "<td style = 'border: 1px solid black;'>" . $row['Names'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['EGN'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Address'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Address_MPS'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone_Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Username'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Password'] . "</td>"; 
    	echo "</tr>";
    	}
    	echo "</table>";
    	echo"</div>";
    }
	mysqli_close($con);
	
}

?>

</div>

<div id = "rep" align = "center" style = "display: none;">

<br>

  <form  name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
    
    <h3 style = "">Проверка за физически лица без данни за ремонт на МПС</h3>
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    
    <br><br>
    <input type="submit" name="btnCheckAutoRepair" value="Провери" style = "border-radius: 2px; color: red;">  
  </form>
 
<?php

$btnCheckAutoRepair = false;
$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnCheckAutoRepair"])) {
	$btnCheckAutoRepair = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnCheckAutoRepair == true) {
    
    echo '<script>document.getElementById("rep").style.display = "block";</script>';
    
    $con = connectServer();
  
    $checkForAuto = mysqli_query($con, "SELECT individual.*
    							FROM individual
    							LEFT JOIN repair ON (individual.Individual_ID = repair.Individual_ID)
    							WHERE repair.Individual_ID IS NULL ");
    							
    if (mysqli_num_rows($checkForAuto) < 1) {
    		
    		$message = "Няма физическо лице без данни за ремонт на МПС в базата данни!";
    		echo "<script>alert('$message');</script>";
    	
    }
    echo "<br><br>";
    if (mysqli_num_rows($checkForAuto) > 0) {
    	
    	echo"<div id = 'repData' align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Физически лица без данни ремонт на МПС</span>'; // . "  " .
    	//'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
    	
        echo"<br><br>";
    	
    	echo "<table border='2'>
    	
    	
        <tr>
    	<th bgcolor='$color1'>$h2 №</th>
    	<th bgcolor='$color1'>$h2 Подаминистратор Потреб. име</th>
    	<th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
    	<th bgcolor='$color1'>$h2 Име и Фамилия</th>
    	<th bgcolor='$color1'>$h2 ЕГН</th>
    	<th bgcolor='$color1'>$h2 Адрес</th>
    	<th bgcolor='$color1'>$h2 Адрес на МПС</th>
    	<th bgcolor='$color1'>$h2 Телефон</th>
    	<th bgcolor='$color1'>$h2 Имейл</th>
    	<th bgcolor='$color1'>$h2 Лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Потребителско име</th>
    	<th bgcolor='$color1'>$h2 Парола</th>
    	</tr>";
      	
    	while($row = mysqli_fetch_array($checkForAuto))
    	{
    	    echo "<tr>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";	
    	echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>";	
    	echo "<td style = 'border: 1px solid black;'>" . $row['Names'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['EGN'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Address'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Address_MPS'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone_Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Username'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Password'] . "</td>"; 
    	echo "</tr>";
    	}
    	echo "</table>";
    	echo"</div>";
    }
	mysqli_close($con);
	
}

?>

</div>

<div id = "tyr" align = "center" style = "display: none;">

<br>

  <form  name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
    
    <h3 style = "">Проверка за физически лица без данни за гуми на МПС</h3>
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    
    <br><br>
    <input type="submit" name="btnCheckAutoTyres" value="Провери" style = "border-radius: 2px; color: red;">  
  </form>
<br> 
<?php

$btnCheckAutoTyres = false;
$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnCheckAutoTyres"])) {
	$btnCheckAutoTyres = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnCheckAutoTyres == true) {
    
    echo '<script>document.getElementById("tyr").style.display = "block";</script>';
    
    $con = connectServer();
  
    $checkForAuto = mysqli_query($con, "SELECT individual.*
    							FROM individual
    							LEFT JOIN tyres ON (individual.Individual_ID = tyres.Individual_ID)
    							WHERE tyres.Individual_ID IS NULL ");
    							
    if (mysqli_num_rows($checkForAuto) < 1) {
    		
    		$message = "Няма физическо лице без данни за гуми на МПС в базата данни!";
    		echo "<script>alert('$message');</script>";
    	
    }
    echo "<br><br>";
    if (mysqli_num_rows($checkForAuto) > 0) {
    	
    	echo"<div id = 'tyrData' align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Физически лица без данни гуми на МПС</span>'; // . "  " .
    	//'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
    	
        echo"<br><br>";
    	
    	echo "<table border='2'>
    	
    	
        <tr>
    	<th bgcolor='$color1'>$h2 №</th>
    	<th bgcolor='$color1'>$h2 Подаминистратор Потреб. име</th>
    	<th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
    	<th bgcolor='$color1'>$h2 Име и Фамилия</th>
    	<th bgcolor='$color1'>$h2 ЕГН</th>
    	<th bgcolor='$color1'>$h2 Адрес</th>
    	<th bgcolor='$color1'>$h2 Адрес на МПС</th>
    	<th bgcolor='$color1'>$h2 Телефон</th>
    	<th bgcolor='$color1'>$h2 Имейл</th>
    	<th bgcolor='$color1'>$h2 Лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
    	<th bgcolor='$color1'>$h2 Потребителско име</th>
    	<th bgcolor='$color1'>$h2 Парола</th>
    	</tr>";
      	
    	while($row = mysqli_fetch_array($checkForAuto))
    	{
    	    echo "<tr>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";	
    	echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>";	
    	echo "<td style = 'border: 1px solid black;'>" . $row['Names'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['EGN'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Address'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Address_MPS'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Telephone_Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Contact_Person'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Email_Username'] . "</td>";
    	echo "<td style = 'border: 1px solid black;'>" . $row['Password'] . "</td>"; 
    	echo "</tr>";
    	}
    	echo "</table>";
    	echo"</div>";
    }
	mysqli_close($con);
	
}

?>

</div>

<br><br>

  
</body>
</html>