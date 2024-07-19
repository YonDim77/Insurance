<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['usernameHolding'])) {
header('Location: index.php');
}

//$_SESSION['Name'] = $_POST['Name'];
//$_SESSION['Eik'] = $_POST['EIK'];
$_SESSION['Reg_Number'] = "";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="adminCss.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script> 

    //$(function(){
    //  $("#nav").load("nav.php"); 
    //});
    
</script>

<style>
body {
    background: #f2e6ff;
    background-size: 130%;
}
table, th, td {
    border: 2px solid black;
    border-collapse: collapse;
    text-align: center;	
}
table, th {
	font-size: 16px;
	color: red;
}
table, td {
	font-size: 14px;
	color: black;
}
table {
	background-color: white;
	width: 130%;
}
tr:nth-child(even) {background-color: #d8f0f3;}
tr:hover  td {background-color:red;}

.navbar {
     
      border-radius: 0;
	  z-index:99;
	  
}

.navbar .navbar-nav a {
    padding: 22px 15px 27px 15px;
    font-size: 18px;
}
.navbar .dropdown-menu a {
    padding: 5px 10px 5px 10px;
    font-size: 14px;
}

.navbar-header img{
    margin-top: 10px;
}

@media screen and (min-width: 768px) {
    .navbar-inverse {
        margin-top:0px; height: 70px; position: fixed; width: 100%;
    }
    ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;    
    }
}

</style>
</head>
<body> 

<nav class="navbar navbar-inverse" style = "margin-top:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
<!--      <a id = "brandMenu" class="navbar-brand" href="#" style = "color:red;">Буболечкоубийци</a>-->
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="BugK.png" alt="Insurance" width="150" height="20"></a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeHolding.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
<!--  <li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="services.html" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Администрация<span class="caret"></span></a>
	  <ul class="dropdown-menu">
	      <li id = "sprayer" style = "background-color: white; color: white; margin-top:0px;">AAAA<img src="Sprayer.jpg" alt="BugKillers" width="60" height="50" style = "border-radius: 5px;"></li>
          <li><a href="subAdminShowDataAllPersons.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на холдинг</a></li>
          <li><a href="subAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на МПС</a></li>

	  </ul>
      </li>-->
      <li class="dropdown"><a style = "color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-user-o">&nbsp;<?php echo  $_SESSION['userHoldingfName']. " " . $_SESSION['userHoldinglName']; ?></i><span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <!--<li><a href="adminProfile.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Профил</a></li>
	        <li><a href="help.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Помощ</a></li>
	        <li><a href="history.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Смяна на парола</a></li>-->
	        <li><a href="logout.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Изход</a></li>
	    </ul>
	  </li>
	  	
	</ul>	
  </div>
</nav>
<!--<div id = "nav"></div>-->
<br>

<div align = "center">;
    <h3 style = "margin-top: 7.0vw;">Данни за юридически лица към <span style = "color: red;"><?php echo $_SESSION['holdingName']; ?></span></h3>
    
      <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8">  
        <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">
        Име, част от име, буква:<br><input style = "" type="text" name="Name" value = "<?php echo $_SESSION['Name']; ?>" placeholder = "Попълнете едното "/>
        <br><br>
        ЕИК:<br><input style = "" type="text" name="EIK" value = "<?php echo $_SESSION['Eik']; ?>" placeholder = "от двете полета"/>
        <br><br>
    	<input type="submit" name="btnShowData" value="Покажи данни" style = "border-radius: 2px; color: red;">-->
      
      
      <!--<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8">  
        <input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">
        ID:<br><input type="number" name="Individual_ID" required="required" placeholder = "Задължително попълване"/>*
        <br><br>
    	<input type="submit" name="btnShowDataForm" value="Покажи данни" style = "border-radius: 2px; color: red;">-->
  

<?php

include 'functions.php';

$btnShowData = false;
$btnShowDataForm = false;
$btnShowDataAuto = false;
$index = 0;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}


if(isset($_POST["btnShowData"])) {
	$btnShowData = true;
}
//if(isset($_POST["btnShowDataForm"])) {
//	$btnShowDataForm = true;
//}
if(isset($_POST["btnShowDataAuto"])) {
	$btnShowDataAuto = true;
}

//if (($_SERVER["REQUEST_METHOD"] == "POST" || $btnShowData == true) && $btnShowDataAuto == false) {
	$con = connectServer();

	
	/*$adminUsername = $_SESSION['username']; //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
	$_SESSION['Name'] = $_POST['Name'];
	$Name = $_SESSION['Name'];
	$_SESSION['Eik'] = $_POST['EIK'];
	*/
	$result = mysqli_query($con, "SELECT * FROM legalentity WHERE Holding_Name = '$_SESSION[holdingName]'"); 
	//$resultEik = mysqli_query($con, "SELECT * FROM legalentity WHERE EIK = '$_POST[EIK]'");
	
	$Color = "red";
	
	//if(strlen($_POST['Name']) > 0 && strlen($_POST['EIK']) > 0 || strlen($_POST['Name']) == 0 && strlen($_POST['EIK']) == 0) {
	//    $message = "Моля попълнете едно от двете полета!";
	//    echo "<script>alert('$message');</script>";
	//}
	
	//else if(strlen($_POST['Name']) > 0)
	//{				  
	//    if (mysqli_num_rows($result) < 1) {
	//    	
	//    	$message = "Няма " . $Name . " в базата данни!";
	//    	echo "<script>alert('$message');</script>";
	//    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($result) > 0) {
	    
	        //echo"<div align = 'center'>";
            //echo '<span id = "text" style="font-size: 20px; color:black;">Данни за юридическо лице с име или име започващо с: </span>' . "  " .
	        //'<span id = "name" style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Name'] . '</span>';
	        //echo"</div>";
            //echo"<br><br>";
	        
	        echo "<table border='2' id = 't1'>
	        
	        
	        <tr>
	        <th bgcolor='$color1'>$h2 </th>
	        <th bgcolor='$color1'>$h2 №</th>
	        <th bgcolor='$color1'>$h2 Име</th>
	        <th bgcolor='$color1'>$h2 ЕИК</th>
	        <th bgcolor='$color1'>$h2 ДДС номер</th>
	        <th bgcolor='$color1'>$h2 Адрес</th>
	        <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	        <th bgcolor='$color1'>$h2 МОЛ три имена</th>
	        <th bgcolor='$color1'>$h2 Телефон</th>
	        <th bgcolor='$color1'>$h2 Имейл</th>
	        <th bgcolor='$color1'>$h2 Лице за контакти</th>
	        <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	        <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	        <th bgcolor='$color1'>$h2 Холдинг</th>
	        <th bgcolor='$color1'>$h2 Дата</th>
	        </tr>";
	        
	        while($row = mysqli_fetch_array($result))
	        {
	            echo "<tr>";
	            echo "<td>"; echo'<input type = "submit" value="Покажи" style = "width: 70px;" name = "button' . $index . '" >';
	            //echo "<td>" . $row['Individual_ID'] . "</td>";
	            echo "<td>"; echo'<input style = "width: 50px; border: 0px; text-align: center;" type = "number" value="'. $row['Legalentity_ID']. '" name = "Legalentity_ID' . $index . '" readonly>'; echo"</td>";
	            echo "<td>" . $row['Name'] . "</td>";
	            echo "<td>" . $row['EIK'] . "</td>";
	            echo "<td>" . $row['DDS_Nomer'] . "</td>";
	            echo "<td>" . $row['Address'] . "</td>";
	            echo "<td>" . $row['Address_MPS'] . "</td>";
	            echo "<td>" . $row['MOL_Names'] . "</td>";
	            echo "<td>" . $row['Telephone'] . "</td>";
	            echo "<td>" . $row['Email'] . "</td>";
	            echo "<td>" . $row['Contact_Person'] . "</td>";
	            echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	            echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	            //echo "<td>" . $row['Email_Username'] . "</td>";
	            //echo "<td>" . $row['Password'] . "</td>";
	            echo "<td>" . $row['Holding_Name'] . "</td>";
	            echo "<td>" . $row['Date'] . "</td>";
	            echo "</tr>";
	            
	            if(isset($_POST['button' . $index . '']))
    	        {
    	             $Legalentity_ID = $_POST['Legalentity_ID' . $index . ''];
    	             $btnShowDataForm = true;
	    	         echo "<script>document.getElementById('t1').style.display = 'none';</script>";
	    	         echo "<script>document.getElementById('text').style.display = 'none';</script>";
	    	         echo "<script>document.getElementById('name').style.display = 'none';</script>";
    	        }
	            
	            $index++;
	        }
	        echo "</table>";
	    
	    }
	//}
	/*else if(strlen($_POST['EIK']) > 0) {
	    
	    if (mysqli_num_rows($resultEik) < 1) {
	    	
	    	$message = "Няма юридическо лице с ЕИК: " . $_SESSION['Eik'] . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($resultEik) > 0) {
	    
	    echo"<div align = 'center'>";
        echo '<span id = "lFace" style="font-size: 20px; color:black;">Данни за юридическо лице с ЕИК: </span>' . "  " .
	    '<span id = "eik" style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Eik'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2' id = 't2'>
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор потреб. име</th>
	    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	    <th bgcolor='$color1'>$h2 Име</th>
	    <th bgcolor='$color1'>$h2 ЕИК</th>
	    <th bgcolor='$color1'>$h2 ДДС номер</th>
	    <th bgcolor='$color1'>$h2 Адрес</th>
	    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
	    <th bgcolor='$color1'>$h2 Телефон</th>
	    <th bgcolor='$color1'>$h2 Имейл</th>
	    <th bgcolor='$color1'>$h2 Лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultEik))
	    {
	    echo "<tr>";
	    echo "<td>"; echo'<input type = "submit" value="Покажи" style = "width: 70px;" name = "button' . $index . '" >'; echo"</td>";
	    //echo "<td>" . $row['Individual_ID'] . "</td>";
	    echo "<td>"; echo'<input style = "width: 50px; border: 0px; text-align: center;" type = "number" value="'. $row['Legalentity_ID']. '" name = "Legalentity_ID' . $index . '" readonly>'; echo"</td>";
	    echo "<td>" . $row['Admin_Username'] . "</td>";
	    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	    echo "<td>" . $row['Name'] . "</td>";
	    echo "<td>" . $row['EIK'] . "</td>";
	    echo "<td>" . $row['DDS_Nomer'] . "</td>";
	    echo "<td>" . $row['Address'] . "</td>";
	    echo "<td>" . $row['Address_MPS'] . "</td>";
	    echo "<td>" . $row['MOL_Names'] . "</td>";
	    echo "<td>" . $row['Telephone'] . "</td>";
	    echo "<td>" . $row['Email'] . "</td>";
	    echo "<td>" . $row['Contact_Person'] . "</td>";
	    echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Email_Username'] . "</td>";
	    echo "<td>" . $row['Password'] . "</td>";
	    echo "<td>" . $row['Date'] . "</td>";
	    echo "</tr>";
	    }
	    
	    if(isset($_POST['button' . $index . '']))
    	{
    	     $Legalentity_ID = $_POST['Legalentity_ID' . $index . ''];
    	     $btnShowDataForm = true;
	         echo "<script>document.getElementById('t2').style.display = 'none';</script>";
    	}
	 
	    $index++;
	    
	    echo "</table>";
	    
	    }
	    
	}
	*/
	
	mysqli_close($con);

//}


?>

</form>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataForm == true) {
    
    $con = connectServer();

	//$adminUsername = $_SESSION['username'];  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	//$Individual_ID = $_POST['Individual_ID'];
	
	$resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$Legalentity_ID'");
	$resultFirmName = mysqli_query($con, "SELECT Name FROM legalentity WHERE Legalentity_ID = '$Legalentity_ID'");
	
	$Color = "red";
	$_SESSION['NumberID'] = true;  //!!!!!!!!!!!!!!!!!!!!! NO NEED?
	$_SESSION['Firm'] = true;
	
	if (!filter_var($Legalentity_ID, FILTER_VALIDATE_INT)) {
    
	echo "<br>";
    echo"<br><br>";
	echo"<div align = 'center'>";
	echo'<span style="font-size: 20px; color:black; ">Въведете цяло число в полето "ID"!</span>';
    echo"</div>";
	$_SESSION['NumberID'] =	false;
	
    } 
	
	if (mysqli_num_rows($resultFirm) < 1 && $_SESSION['NumberID']) {
		
		//echo"<br><br>";
		//echo"<div align = 'center'>";
		//echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за физическо лице!</span>'; //. " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		//echo"</div>";
		$message = "Грешка! Няма данни за юридическо лице!";
		echo "<script>alert('$message');</script>";
	    $_SESSION['Person'] = false;
	}
	
	if (mysqli_num_rows($resultFirm) > 0 && mysqli_num_rows($resultFirmName) > 0 && $_SESSION['NumberID']) {
	
	    if($rowName = mysqli_fetch_array($resultFirmName)) {
	        
	        $_SESSION['firmName'] = $rowName['Name'];
	        echo"<div align = 'center'>";
	        echo "<script>document.getElementById('lFace').style.display = 'none';</script>";
	    	echo "<script>document.getElementById('eik').style.display = 'none';</script>";
            echo '<span style="font-size: 20px; color:black;">Данни на </span>'  . "  " .
	        '<span style="font-size: 20px; color:' . $Color . '">' . $rowName['Name'] . '</span>';
	        echo"</div>";
            echo"<br><br>";
	    }
	    echo "<table border='2'>
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
	    <th bgcolor='$color1'>$h2 Име</th>
	    <th bgcolor='$color1'>$h2 ЕИК</th>
	    <th bgcolor='$color1'>$h2 ДДС номер</th>
	    <th bgcolor='$color1'>$h2 Адрес</th>
	    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
	    <th bgcolor='$color1'>$h2 Телефон</th>
	    <th bgcolor='$color1'>$h2 Имейл</th>
	    <th bgcolor='$color1'>$h2 Лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Холдинг</th>
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultFirm))
	    {
	    echo "<tr>";
	    echo "<td>" . $row['Legalentity_ID'] . "</td>";
	    $firmID = $row['Legalentity_ID'];
	    echo "<td>" . $row['Name'] . "</td>";
	    echo "<td>" . $row['EIK'] . "</td>";
	    echo "<td>" . $row['DDS_Nomer'] . "</td>";
	    echo "<td>" . $row['Address'] . "</td>";
	    echo "<td>" . $row['Address_MPS'] . "</td>";
	    echo "<td>" . $row['MOL_Names'] . "</td>";
	    echo "<td>" . $row['Telephone'] . "</td>";
	    echo "<td>" . $row['Email'] . "</td>";
	    echo "<td>" . $row['Contact_Person'] . "</td>";
	    echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Holding_Name'] . "</td>";
	    echo "<td>" . $row['Date'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	
	$resultFirmAutos = mysqli_query($con, "SELECT * FROM autos WHERE Legalentity_ID = '$firmID'");
	
    if (mysqli_num_rows($resultFirmAutos) > 0) {

	    echo "<table border='2' id = 'autos' style = 'display: none;'>
	    <tr>
	    <th>Вид МПС</th>
	    <th>Марка</th>
	    <th>Модел</th>
	    <th>Рег. №</th>
	    <th>Купе</th>
	    <th>Шаси</th>
	    <th>Първа Рег.</th>
	    <th>Тегло</th>
	    <th>Цвят</th>
	    <th>Брой Места</th>
	    <th>Кубатура</th>
        <th>Мощност в к.с.</th>
	    <th>Двигател</th>
	    <th>Скоростна кутия</th>
	    <th>Гаранция</th>
	    <th>Гаранция до:</th>
	    <th>Цена</th>
	    <th>Адрес на МПС</th>
	    <th>Текущи км</th>
        <th>Дата текущи км</th>
        <th>Шофьор име</th>
        <th>Шофьор фамилия</th>
        <th>Шофьор тел. №</th>
        <th>ТП</th>
        <th>ГО</th>
        <th>ГТП</th>
        <th>Каско</th>
        <th>Винетка</th>
        <th>Друго</th>
        <th>МАТ</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultFirmAutos))
	    {
	        $autoId = $row['AutosID'];
	        echo "<tr>";
	        echo "<td>" . $row['Type'] . "</td>";	
	        echo "<td>" . $row['Brand'] . "</td>";
	        echo "<td>" . $row['Model'] . "</td>";
	        echo "<td>" . $row['Reg_Number'] . "</td>";
	        $_SESSION['Reg_Number'] = $row['Reg_Number'];
	        echo "<td>" . $row['Kupe'] . "</td>";	
	        echo "<td>" . $row['Shasi'] . "</td>";
	        echo "<td>" . $row['First_Reg'] . "</td>";
	        echo "<td>" . $row['Weight'] . "</td>";
	        echo "<td>" . $row['Color'] . "</td>";	
	        echo "<td>" . $row['Seats'] . "</td>";
	        echo "<td>" . $row['Cubature'] . "</td>";
	        echo "<td>" . $row['Power'] . "</td>";
	        echo "<td>" . $row['Engine'] . "</td>";
	        echo "<td>" . $row['Transmission'] . "</td>";
	        echo "<td>" . $row['Guarantee'] . "</td>";	
	        echo "<td>" . $row['GuaranteeDate'] . "</td>";
	        echo "<td>" . $row['Price'] . "</td>";
	        echo "<td>" . $row['Address_MPS'] . "</td>";
	        echo "<td>" . $row['Current_Km'] . "</td>";
            echo "<td>" . $row['Date_Current_Km'] . "</td>";
            echo "<td>" . $row['Driver_First_Name'] . "</td>";
            echo "<td>" . $row['Driver_Last_Name'] . "</td>";
            echo "<td>" . $row['Driver_Phone_Number'] . "</td>";
            echo "<td style='color:black;'>" . $row['TP'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka'] . "</td>";
            echo "<td style='color:black;'>" . $row['Others'] . "</td>";
            echo "<td style='color:black;'>" . $row['MAT'] . "</td>";
	        echo "</tr>";
	    }
	    echo "</table>";
    }
	    
    $resultFirmInsurance = mysqli_query($con, "SELECT * FROM insurance WHERE Legalentity_ID = '$firmID'");
    
    if (mysqli_num_rows($resultFirmInsurance) > 0) {
    
        echo "<table border='2' id = 'insurance' style = 'display: none;'>
        
	    <tr>
	    <th>Рег. №</th>
        <th>ГТП дата</th>
        <th>ГТП сума</th>
        <th>ГО дата</th>
        <th>ГО сума</th>
        <th>ГО плащане</th>
        <th>Каско дата</th>
        <th>Каско сума</th>
        <th>Каско плащане</th>
        <th>Винетка дата</th>
        <th>Винетка сума</th>
        <th>Винетка тип</th>
        <th>Данък</th>
        <th>Данък сума</th>
        <th>Данък платен до</th>
        <th>Ефективност</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultFirmInsurance))
	    {
	        echo "<tr>";

            echo "<td style='color:black;'>" . $_SESSION['Reg_Number'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Payment'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Payment'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Type'] . "</td>";
            echo "<td style='color:black;'>" . $row['Tax'] . "</td>";
            echo "<td style='color:black;'>" . $row['Tax_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Tax_Paid_Till'] . "</td>";
            echo "<td style='color:black;'>" . $row['Efficiency'] . "</td>";
            echo "</tr>";
	    }
	    echo "</table>";
    }    
    
    $resultFirmService = mysqli_query($con, "SELECT * FROM service WHERE Legalentity_ID = '$firmID'");
    
    if (mysqli_num_rows($resultFirmService) > 0) {
    
        echo "<table border='2' id = 'service' style = 'display: none;'>
	    
	    <tr>
	    <th>Рег. №</th>
        <th>Сервиз</th>
	    <th>Обслужване на</th>
        <th>Дата на обслужване</th>
        <th>Километри</th>
        <th>След километри</th>
        <th>След дата</th>
        <th>Сума лв</th>
        <th>Фактура №</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultFirmService))
	    {
	        echo "<tr>";
            echo "<td style='color:black;'>" . $_SESSION['Reg_Number'] . "</td>";
            echo "<td style='color:black;'>" . $row['Service'] . "</td>"; 
	        echo "<td style='color:black;'>" . $row['Type'] . "</td>";
            echo "<td style='color:black;'>" . $row['Date_Of_Service'] . "</td>";
            echo "<td style='color:black;'>" . $row['Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['After_Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['After_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Invoice'] . "</td>";
            echo "</tr>";
	    }
	    echo "</table>";
    }
    
    $resultFirmRepair = mysqli_query($con, "SELECT * FROM repair WHERE Legalentity_ID = '$firmID'");
    
    if (mysqli_num_rows($resultFirmRepair) > 0) {
        
        echo "<table border='2' id = 'repair' style = 'display: none;'>
	    
	    <tr>
	    <th>Рег. №</th>
        <th>Ремонт вид</th>
        <th>Ремонт на</th>
        <th>Километри</th>
        <th>Смяна на</th>
        <th>Сума лв</th>
        <th>Фактура №</th>
        <th>Дата</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultFirmRepair))
	    {
	        echo "<tr>";
	        echo "<td style='color:black;'>" . $_SESSION['Reg_Number'] . "</td>";
            echo "<td style='color:black;'>" . $row['Repair_Type'] . "</td>";
            echo "<td style='color:black;'>" . $row['Repair_Of'] . "</td>";
            echo "<td style='color:black;'>" . $row['Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['Change_Of'] . "</td>";
            echo "<td style='color:black;'>" . $row['Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Invoice'] . "</td>";
            echo "<td style='color:black;'>" . $row['Date'] . "</td>";
            echo "</tr>";
	    }
	    echo "</table>";
    }
    
    $resultFirmTyres = mysqli_query($con, "SELECT * FROM tyres WHERE Legalentity_ID = '$firmID'");
    
    if (mysqli_num_rows($resultFirmTyres) > 0) {
        
        echo "<table border='2' id = 'tyres' style = 'display: none;'>
	    
	    <tr>
	    <th>Рег. №</th>
		<th>Вид гуми</th>
		<th>Дата на закупуване</th>
		<th>Размер</th>
		<th>Цена лв</th>
		<th>Съхранявани в</th>
		<th>Използваемост</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultFirmTyres))
	    {
	         echo "<tr>";
	         echo "<td style='color:black;'>" . $_SESSION['Reg_Number'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Type'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Date'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Size'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Price'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Saved_In'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Usability'] . "</td>";	    
	         echo "</tr>";
	    }
	    echo "</table>";
    }
    
    
?>


<script>
    function fnExcelReport(str)
    {
        
        var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange; var j=0;
        tab = document.getElementById(str); // id of table
        
        if(tab == null)
            alert('Няма  данни за експорт');
        
        for(j = 0 ; j < tab.rows.length ; j++) 
        {     
            tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
            //tab_text=tab_text+"</tr>";
        }
    
        tab_text=tab_text+"</table>";
        tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
        tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
    
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE "); 
    
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus(); 
            sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
        }  
        else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  
    
        return (sa);
    }
    
    function loadSaveAutoDocs()
    {
        if(document.getElementById("regNum").value != '')
        {
            location.assign('holdingFirmUploadAutoDocs.php');
        }
        else
        {
            alert("Моля изберете регистрационен номер!");
        }
    }
    
    function loadEditAutoDocs()
    {
        if(document.getElementById("regNum").value != '')
        {
            location.assign('holdingFirmUpdateAutoDocs.php');
        }
        else
        {
            alert("Моля изберете регистрационен номер!");
        }
    }
    
    

function getRegNumber(str) {
  var xhttp; 
  //if (str == "") {
  //  document.getElementById("regNum").innerHTML = "";
  //  return;
  //}
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    //document.getElementById("regNum").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "holdingSaveRegNumber.php?q="+str, true);
  xhttp.send();
}


    
</script>

<br>
<div align = "center">
    <h3 style = "">Данни на МПС</h3>
      <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
        <br>
    	<select id = "regNum" style = "width: 220px; height: 27px;" name="Reg_Number"  onchange = "getRegNumber(this.value)" required="required">
            <option value="">Изберете регистрационен №</option>
                    <?php
                        //$con = connectServer();
                        //$query = "SELECT * FROM autos WHERE Legalentity_ID = '$_SESSION[legalentityID]'";
                        $query = "SELECT  Reg_Number FROM autos WHERE Legalentity_ID = '$Legalentity_ID'";
                        $results=mysqli_query($con, $query);
                        //loop
                        foreach ($results as $regNums){
                    ?>
                            <option value="<?php echo $regNums['Reg_Number'];?>"><?php echo $regNums['Reg_Number'];?></option>
                    <?php
                        }
                        //mysqli_close($con);
                        
                    ?>
            
        </select>&nbsp; &nbsp;
        <input type="submit" name="btnShowDataAuto" value="Покажи данни" style = "border-radius: 2px; color: red;">
      </form>    
    <br><br>
    <button style = "color: red; width: 342px;" onclick = "loadSaveAutoDocs()">Запис на документи на МПС</button>
    <br><br>
    <button style = "color: red; width: 342px;" onclick = "loadEditAutoDocs()">Редакция на документи на МПС</button>
    <br><br>
    <button style = "color: red; width: 342px;" onclick = "fnExcelReport('autos')">Експорт общи данни на всички МПС</button>
    <br><br>
    <button style = "color: red; width: 342px;" onclick = "fnExcelReport('insurance')">Експорт данни за застраховки на всички МПС</button>
    <br><br>
    <button style = "color: red; width: 342px;" onclick = "fnExcelReport('service')">Експорт данни за сервиз на всички МПС</button>
    <br><br>
    <button style = "color: red; width: 342px;" onclick = "fnExcelReport('repair')">Експорт данни за ремонт на всички МПС</button>
    <br><br>
    <button style = "color: red; width: 342px;" onclick = "fnExcelReport('tyres')">Експорт данни за гуми на всички МПС</button>
    <br><br>
</div>

<?php
	
	}
	
	mysqli_close($con);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataAuto == true) {

   echo "<script>document.getElementById('t1').style.display = 'none';</script>"; 
   
   $con = connectServer();
   $autoId = 0;
   $result = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
					  
	if (mysqli_num_rows($result) < 1 && $_SESSION['NumberID'] && $_SESSION['Firm']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}

	
	echo "<br><br>";
	if (mysqli_num_rows($result) > 0 && $_SESSION['NumberID'] && $_SESSION['Firm']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни на МПС на  </span>'  . "  " .
	    '<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['firmName'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	   
	    <tr>
	    
	    <th bgcolor='$color1'>$h2 Вид МПС</th>
	    <th bgcolor='$color1'>$h2 Марка</th>
	    <th bgcolor='$color1'>$h2 Модел</th>
	    <th bgcolor='$color1'>$h2 Рег. №</th>
	    <th bgcolor='$color1'>$h2 Купе</th>
	    <th bgcolor='$color1'>$h2 Шаси</th>
	    <th bgcolor='$color1'>$h2 Първа Рег.</th>
	    <th bgcolor='$color1'>$h2 Тегло</th>
	    <th bgcolor='$color1'>$h2 Цвят</th>
	    <th bgcolor='$color1'>$h2 Брой Места</th>
	    <th bgcolor='$color1'>$h2 Кубатура</th>
        <th bgcolor='$color1'>$h2 Мощност в к.с.</th>
	    <th bgcolor='$color1'>$h2 Двигател</th>
	    <th bgcolor='$color1'>$h2 Скоростна кутия</th>
	    <th bgcolor='$color1'>$h2 Гаранция</th>
	    <th bgcolor='$color1'>$h2 Гаранция до:</th>
	    <th bgcolor='$color1'>$h2 Цена</th>
	    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	    <th>Текущи км</th>
        <th>Дата текущи км</th>
        <th>Шофьор име</th>
        <th>Шофьор фамилия</th>
        <th>Шофьор тел. №</th>
        <th bgcolor='$color1'>$h2 ТП</th>
        <th bgcolor='$color1'>$h2 ГО</th>
        <th bgcolor='$color1'>$h2 ГТП</th>
        <th bgcolor='$color1'>$h2 Каско</th>
        <th bgcolor='$color1'>$h2 Винетка</th>
        <th bgcolor='$color1'>$h2 Друго</th>
        <th bgcolor='$color1'>$h2 МАТ</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($result))
	    {
	        $autoId = $row['AutosID'];
	        echo "<tr>";
	        
	        //echo "<td>" . $row['AutosID'] . "</td>";
	        //echo "<td>" . $row['Individual_ID'] . "</td>";
	        echo "<td>" . $row['Type'] . "</td>";	
	        echo "<td>" . $row['Brand'] . "</td>";
	        echo "<td>" . $row['Model'] . "</td>";
	        echo "<td>" . $row['Reg_Number'] . "</td>";
	        $_SESSION['Reg_Number'] = $row['Reg_Number'];
	        echo "<td>" . $row['Kupe'] . "</td>";	
	        echo "<td>" . $row['Shasi'] . "</td>";
	        echo "<td>" . $row['First_Reg'] . "</td>";
	        echo "<td>" . $row['Weight'] . "</td>";
	        echo "<td>" . $row['Color'] . "</td>";	
	        echo "<td>" . $row['Seats'] . "</td>";
	        echo "<td>" . $row['Cubature'] . "</td>";
	        echo "<td>" . $row['Power'] . "</td>";
	        echo "<td>" . $row['Engine'] . "</td>";
	        echo "<td>" . $row['Transmission'] . "</td>";
	        echo "<td>" . $row['Guarantee'] . "</td>";	
	        echo "<td>" . $row['GuaranteeDate'] . "</td>";
	        echo "<td>" . $row['Price'] . "</td>";
	        echo "<td>" . $row['Address_MPS'] . "</td>";
	        echo "<td>" . $row['Current_Km'] . "</td>";
            echo "<td>" . $row['Date_Current_Km'] . "</td>";
            echo "<td>" . $row['Driver_First_Name'] . "</td>";
            echo "<td>" . $row['Driver_Last_Name'] . "</td>";
            echo "<td>" . $row['Driver_Phone_Number'] . "</td>";
            echo "<td style='color:black;'>" . $row['TP'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka'] . "</td>";
            echo "<td style='color:black;'>" . $row['Others'] . "</td>";
            echo "<td style='color:black;'>" . $row['MAT'] . "</td>";
	        echo "</tr>";
	    }
	    echo "</table>";
	
	}
	
   $resultInsurance = mysqli_query($con, "SELECT * FROM insurance WHERE AutosID = '$autoId'");
   $resultService = mysqli_query($con, "SELECT * FROM service WHERE AutosID = '$autoId'");
   $resultRepair = mysqli_query($con, "SELECT * FROM repair WHERE AutosID = '$autoId'");
   $resultTyres = mysqli_query($con, "SELECT * FROM tyres WHERE AutosID = '$autoId'");
	
	// Table data insurance
	
	if (mysqli_num_rows($resultInsurance) < 1 && $_SESSION['Firm']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за застраховки на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	
	echo "<br><br>";
	if (mysqli_num_rows($resultInsurance) > 0 && $_SESSION['Firm']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за застраховки на МПС на</span>' . "  " .
	    '<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['firmName'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    
	    <tr>
	    
        <th bgcolor='$color1'>$h2 ГТП дата</th>
        <th bgcolor='$color1'>$h2 ГТП сума</th>
        <th bgcolor='$color1'>$h2 ГО дата</th>
        <th bgcolor='$color1'>$h2 ГО сума</th>
        <th bgcolor='$color1'>$h2 ГО плащане</th>
        <th bgcolor='$color1'>$h2 Каско дата</th>
        <th bgcolor='$color1'>$h2 Каско сума</th>
        <th bgcolor='$color1'>$h2 Каско плащане</th>
        <th bgcolor='$color1'>$h2 Винетка дата</th>
        <th bgcolor='$color1'>$h2 Винетка сума</th>
        <th bgcolor='$color1'>$h2 Винетка тип</th>
        <th bgcolor='$color1'>$h2 Данък</th>
        <th bgcolor='$color1'>$h2 Данък сума</th>
        <th bgcolor='$color1'>$h2 Данък платен до</th>
        <th bgcolor='$color1'>$h2 Ефективност</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultInsurance))
	    {
	        echo "<tr>";

            //echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
            //echo "<td style='color:black;'>" . $row['Individual_ID'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Payment'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Payment'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Type'] . "</td>";
            echo "<td style='color:black;'>" . $row['Tax'] . "</td>";
            echo "<td style='color:black;'>" . $row['Tax_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Tax_Paid_Till'] . "</td>";
            echo "<td style='color:black;'>" . $row['Efficiency'] . "</td>";
            echo "</tr>";
	    }
	    echo "</table>";
	
	}
	
	//  TABLE DATA SERVICE
	
	if (mysqli_num_rows($resultService) < 1 && $_SESSION['Firm']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за сервиз на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultService) > 0 && $_SESSION['Firm']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за сервиз на МПС на</span>' . "  " .
	    '<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['firmName'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    <tr>
	    
        <th bgcolor='$color1'>$h2 Сервиз</th>
	    <th bgcolor='$color1'>$h2 Обслужване на</th>
        <th bgcolor='$color1'>$h2 Дата на обслужване</th>
        <th bgcolor='$color1'>$h2 Километри</th>
        <th bgcolor='$color1'>$h2 След километри</th>
        <th bgcolor='$color1'>$h2 След дата</th>
        <th bgcolor='$color1'>$h2 Сума лв</th>
        <th bgcolor='$color1'>$h2 Фактура №</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultService))
	    {
	        echo "<tr>";
	        
            //echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
            //echo "<td style='color:black;'>" . $row['Individual_ID'] . "</td>";
            echo "<td style='color:black;'>" . $row['Service'] . "</td>"; 
	        echo "<td style='color:black;'>" . $row['Type'] . "</td>";
            echo "<td style='color:black;'>" . $row['Date_Of_Service'] . "</td>";
            echo "<td style='color:black;'>" . $row['Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['After_Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['After_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Invoice'] . "</td>";
            echo "</tr>";
	    }
	    echo "</table>";
	
	}
	
	if (mysqli_num_rows($resultRepair) < 1 && $_SESSION['Firm']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за ремонт на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultRepair) > 0 && $_SESSION['Firm']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за ремонт на МПС на </span>' . "  " .
	    '<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['firmName'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    <tr>
        <th>Ремонт вид</th>
        <th>Ремонт на</th>
        <th>Километри</th>
        <th>Смяна на</th>
        <th>Сума лв</th>
        <th>Фактура №</th>
        <th>Дата</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultRepair))
	    {
	        echo "<tr>";
	        
            echo "<td style='color:black;'>" . $row['Repair_Type'] . "</td>";
            echo "<td style='color:black;'>" . $row['Repair_Of'] . "</td>";
            echo "<td style='color:black;'>" . $row['Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['Change_Of'] . "</td>";
            echo "<td style='color:black;'>" . $row['Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Invoice'] . "</td>";
            echo "<td style='color:black;'>" . $row['Date'] . "</td>";
            echo "</tr>";
	    }
	    echo "</table>";
	
	}
	
	if (mysqli_num_rows($resultTyres) < 1 && $_SESSION['Firm']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за гуми на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultTyres) > 0 && $_SESSION['Firm']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за гуми на МПС на </span>' . "  " .
	    '<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['firmName'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    <tr>
	    
		<th>Вид гуми</th>
		<th>Дата на закупуване</th>
		<th>Размер</th>
		<th>Цена лв</th>
		<th>Съхранявани в</th>
		<th>Използваемост</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultTyres))
	    {
	         echo "<tr>";
	         
		     echo "<td style='color:black;'>" . $row['Type'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Date'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Size'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Price'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Saved_In'] . "</td>";
		     echo "<td style='color:black;'>" . $row['Usability'] . "</td>";	    
	         echo "</tr>";
	    }
	    echo "</table>";
	
	}
	
	
	mysqli_close($con);

}

?>

</div>
</body>
</html>