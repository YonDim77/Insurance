<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['subAdminUsername'])) {
header('Location: index.php');
}

$_SESSION['Names'] = $_POST['Names'];
$_SESSION['Egn'] = $_POST['EGN'];
$_SESSION['Reg_Number_Global'] = "";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="adminCss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script> 

    $(function(){
      $("#subAdminNav").load("subAdminNav.php"); 
    });
    
</script>

<style>
body {
    
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
	
	width: 130%;
}

th {
    background-color: white;
}

</style>
</head>
<body> 

<div id = "subAdminNav"></div>
<br>

<div align = "center">;
    <h3 style = "margin-top: 7.0vw;">Данни за физически лица:</h3>
    
      <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8">  
        <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
        Име:<br><input style = "" type="text" name="Names" value = "<?php echo $_SESSION['Names']; ?>" placeholder = "Попълнете едното "/>
        <br><br>
        ЕГН:<br><input style = "" type="text" name="EGN" value = "<?php echo $_SESSION['Egn']; ?>" placeholder = "от двете полета"/>
        <br><br>
    	<input type="submit" name="btnShowData" value="Покажи данни" style = "border-radius: 2px; color: red;">
      
      <br><br>
      
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

if (($_SERVER["REQUEST_METHOD"] == "POST" || $btnShowData == true) && $btnShowDataAuto == false) {
	$con = connectServer();

	
	$subAdminUsername = $_SESSION['subAdminUsername']; 
	
	$_SESSION['Names'] = $_POST['Names'];
	$Names = $_SESSION['Names'];
	$_SESSION['Egn'] = $_POST['EGN'];
	
	$result = mysqli_query($con, "SELECT * FROM individual WHERE Names LIKE '$Names%' AND Sub_Admin_Username = '".$subAdminUsername."'"); 
	$resultEgn = mysqli_query($con, "SELECT * FROM individual WHERE EGN = '$_POST[EGN]' AND Sub_Admin_Username = '".$subAdminUsername."'");
	
	$Color = "red";
	
	if(strlen($_POST['Names']) > 0 && strlen($_POST['EGN']) > 0 || strlen($_POST['Names']) == 0 && strlen($_POST['EGN']) == 0) {
	    $message = "Моля попълнете едно от двете полета!";
	    echo "<script>alert('$message');</script>";
	}
	
	else if(strlen($_POST['Names']) > 0)
	{				  
	    if (mysqli_num_rows($result) < 1) {
	    	
	    	$message = "Няма " . $Names . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($result) > 0) {
	    
	        echo"<div align = 'center'>";
            echo '<span id = "text" style="font-size: 20px; color:black;">Данни за име или име започващо с: </span>' . "  " .
	        '<span id = "name" style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	        echo"</div>";
            echo"<br><br>";
	        
	        echo "<table border='2' id = 't1'>
	        
	        
	        <tr>
	        <th bgcolor='$color1'>$h2 </th>
	        <th bgcolor='$color1'>$h2 №</th>
	        <th bgcolor='$color1'>$h2 Подадминистратор потреб. име</th>
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
	        <th bgcolor='$color1'>$h2 Шофьорска книжка срок</th>
	        <th bgcolor='$color1'>$h2 Потребителско име</th>
	        <th bgcolor='$color1'>$h2 Парола</th>
	        <th bgcolor='$color1'>$h2 Дата</th>
	        </tr>";
	        
	        while($row = mysqli_fetch_array($result))
	        {
	            echo "<tr>";
	            echo "<td>"; echo'<input type = "submit" value="Покажи" style = "width: 70px;" name = "button' . $index . '" >';
	            //echo "<td>" . $row['Individual_ID'] . "</td>";
	            echo "<td>"; echo'<input style = "width: 50px; border: 0px; text-align: center;" type = "text" value="'. $row['Individual_ID']. '" name = "Individual_ID' . $index . '" readonly>'; echo"</td>";
	            echo "<td>" . $row['Admin_Username'] . "</td>";
	            echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	            echo "<td>" . $row['Names'] . "</td>";
	            echo "<td>" . $row['EGN'] . "</td>";
	            echo "<td>" . $row['Address'] . "</td>";
	            echo "<td>" . $row['Address_MPS'] . "</td>";
	            echo "<td>" . $row['Telephone'] . "</td>";
	            echo "<td>" . $row['Email'] . "</td>";
	            echo "<td>" . $row['Contact_Person'] . "</td>";
	            echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	            echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	            echo "<td>" . $row['Driving_Licence_Date'] . "</td>";
	            echo "<td>" . $row['Email_Username'] . "</td>";
	            echo "<td>" . $row['Password'] . "</td>";
	            echo "<td>" . $row['Date'] . "</td>";
	            echo "</tr>";
	            
	            if(isset($_POST['button' . $index . '']))
    	        {
    	             $Individual_ID = $_POST['Individual_ID' . $index . ''];
    	             $btnShowDataForm = true;
	    	         echo "<script>document.getElementById('t1').style.display = 'none';</script>";
	    	         echo "<script>document.getElementById('text').style.display = 'none';</script>";
	    	         echo "<script>document.getElementById('name').style.display = 'none';</script>";
    	        }
	            
	            $index++;
	        }
	        echo "</table>";
	    
	    }
	}
	else if(strlen($_POST['EGN']) > 0) {
	    
	    if (mysqli_num_rows($resultEgn) < 1) {
	    	
	    	$message = "Няма лице с ЕГН: " . $_SESSION['Egn'] . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($resultEgn) > 0) {
	    
	    echo"<div align = 'center'>";
        echo '<span id = "iFace" style="font-size: 20px; color:black;">Данни за лице с ЕГН: </span>' . "  " .
	    '<span id = "egn" style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Egn'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2' id = 't2'>
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор потреб. име</th>
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
	    <th bgcolor='$color1'>$h2 Шофьорска книжка срок</th>
	    <th bgcolor='$color1'>$h2 Потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultEgn))
	    {
	    echo "<tr>";
	    echo "<td>"; echo'<input type = "submit" value="Покажи" style = "width: 70px;" name = "button' . $index . '" >'; echo"</td>";
	    //echo "<td>" . $row['Individual_ID'] . "</td>";
	    echo "<td>"; echo'<input style = "width: 50px; border: 0px; text-align: center;" type = "text" value="'. $row['Individual_ID']. '" name = "Individual_ID' . $index . '" readonly>'; echo"</td>";
	    echo "<td>" . $row['Admin_Username'] . "</td>";
	    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	    echo "<td>" . $row['Names'] . "</td>";
	    echo "<td>" . $row['EGN'] . "</td>";
	    echo "<td>" . $row['Address'] . "</td>";
	    echo "<td>" . $row['Address_MPS'] . "</td>";
	    echo "<td>" . $row['Telephone'] . "</td>";
	    echo "<td>" . $row['Email'] . "</td>";
	    echo "<td>" . $row['Contact_Person'] . "</td>";
	    echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Driving_Licence_Date'] . "</td>";
	    echo "<td>" . $row['Email_Username'] . "</td>";
	    echo "<td>" . $row['Password'] . "</td>";
	    echo "<td>" . $row['Date'] . "</td>";
	    echo "</tr>";
	    }
	    
	    if(isset($_POST['button' . $index . '']))
    	{
    	     $Individual_ID = $_POST['Individual_ID' . $index . ''];
    	     $btnShowDataForm = true;
	         echo "<script>document.getElementById('t2').style.display = 'none';</script>";
    	}
	 
	    $index++;
	    
	    echo "</table>";
	    
	    }
	    
	}
	
	
	mysqli_close($con);

}


?>

</form>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataForm == true) {
    
    $con = connectServer();

	
	$subAdminUsername = $_SESSION['subAdminUsername'];
	//$Individual_ID = $_POST['Individual_ID'];
	
	$resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$Individual_ID' AND Sub_Admin_Username = '".$subAdminUsername."'");
	$resultPersonName = mysqli_query($con, "SELECT Names FROM individual WHERE Individual_ID = '$Individual_ID' AND Sub_Admin_Username = '".$subAdminUsername."'");
	
	$Color = "red";
	$_SESSION['NumberID'] = true;
	$_SESSION['Person'] = true;
	
	if (!filter_var($Individual_ID, FILTER_VALIDATE_INT)) {
    
	echo "<br>";
    echo"<br><br>";
	echo"<div align = 'center'>";
	echo'<span style="font-size: 20px; color:white; ">Въведете цяло число в полето "ID"!</span>';
    echo"</div>";
	$_SESSION['NumberID'] =	false;
	
    } 
	
	if (mysqli_num_rows($resultPerson) < 1 && $_SESSION['NumberID']) {
		
		//echo"<br><br>";
		//echo"<div align = 'center'>";
		//echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за физическо лице!</span>'; //. " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		//echo"</div>";
		$message = "Грешка! Няма данни за физическо лице!";
		echo "<script>alert('$message');</script>";
	    $_SESSION['Person'] = false;
	}
	
	if (mysqli_num_rows($resultPerson) > 0 && mysqli_num_rows($resultPersonName) > 0 && $_SESSION['NumberID']) {
	    
	    if($rowName = mysqli_fetch_array($resultPersonName)) {
	        echo"<div align = 'center'>";
	        echo "<script>document.getElementById('iFace').style.display = 'none';</script>";
	    	echo "<script>document.getElementById('egn').style.display = 'none';</script>";
            echo '<span style="font-size: 20px; color:black;">Данни на </span>'  . "  " .
	        '<span style="font-size: 20px; color:' . $Color . '">' . $rowName['Names'] . '</span>';
	        echo"</div>";
            echo"<br><br>";
	    }
	    
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 ID/№ на ф. лице</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор Потреб. име</th>
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
	    <th bgcolor='$color1'>$h2 Шофьорска книжка срок</th>
	    <th bgcolor='$color1'>$h2 Потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultPerson))
	    {
	    echo "<tr>";
	    echo "<td>" . $row['Individual_ID'] . "</td>";
	    echo "<td>" . $row['Admin_Username'] . "</td>";	
	    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	    echo "<td>" . $row['Names'] . "</td>";
	    echo "<td>" . $row['EGN'] . "</td>";
	    echo "<td>" . $row['Address'] . "</td>";
	    echo "<td>" . $row['Address_MPS'] . "</td>";
	    echo "<td>" . $row['Telephone'] . "</td>";
	    echo "<td>" . $row['Email'] . "</td>";
	    echo "<td>" . $row['Contact_Person'] . "</td>";
	    echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Driving_Licence_Date'] . "</td>";
	    echo "<td>" . $row['Email_Username'] . "</td>";
	    echo "<td>" . $row['Password'] . "</td>"; 
	    echo "<td>" . $row['Date'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	
	
?>


<br>
<div align = "center">
    <h3 style = "">Данни на МПС</h3>
      <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
        <br>
    	<select style = "width: 220px; height: 27px;" name="Reg_Number"  required="required">
            <option value="">Изберете регистрационен №</option>
                    <?php
                        //$con = connectServer();
                        //$query = "SELECT * FROM autos WHERE Legalentity_ID = '$_SESSION[legalentityID]'";
                        $query = "SELECT  Reg_Number FROM autos WHERE Individual_ID = '$Individual_ID'";
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
</div>

<?php
	
	}
	
	mysqli_close($con);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataAuto == true) {
    
   $con = connectServer();
   
   $subAdminUsername = $_SESSION['subAdminUsername'];
   $autoId = 0;
   $result = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]' AND Sub_Admin_Username = '".$subAdminUsername."'");
					  
	if (mysqli_num_rows($result) < 1 && $_SESSION['NumberID'] && $_SESSION['Person']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни на МПС за това физическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}

	
	echo "<br><br>";
	if (mysqli_num_rows($result) > 0 && $_SESSION['NumberID'] && $_SESSION['Person']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни на МПС на физическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	   
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
	    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
	    <th bgcolor='$color1'>$h2 ID/№ на ф. лице</th>
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
?>	        
	        <td style = "width: 80px;"><button onclick = "location.assign('subAdminUpdateGeneralDataAuto.php')">Редакция</button></td>
	        
<?php	        
	        echo "<td>" . $row['AutosID'] . "</td>";
	        echo "<td>" . $row['Individual_ID'] . "</td>";
	        echo "<td>" . $row['Type'] . "</td>";	
	        echo "<td>" . $row['Brand'] . "</td>";
	        echo "<td>" . $row['Model'] . "</td>";
	        echo "<td>" . $row['Reg_Number'] . "</td>";
	        $_SESSION['Reg_Number_Global'] = $row['Reg_Number'];
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
	
	if (mysqli_num_rows($resultInsurance) < 1 && $_SESSION['Person']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за застраховки на МПС за това физическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	
	echo "<br><br>";
	if (mysqli_num_rows($resultInsurance) > 0 && $_SESSION['Person']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за застраховки на МПС на физическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
        <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
        <th bgcolor='$color1'>$h2 ID/№ на ф. лице</th>
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
?>	        
	        <td style = "width: 80px;"><button onclick = "location.assign('subAdminUpdateInsuranceDataAuto.php')">Редакция</button></td>
	        
<?php
            echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
            echo "<td style='color:black;'>" . $row['Individual_ID'] . "</td>";
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
	
	if (mysqli_num_rows($resultService) < 1 && $_SESSION['Person']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за сервиз на МПС за това физическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultService) > 0 && $_SESSION['Person']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за сервиз на МПС на физическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
        <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
        <th bgcolor='$color1'>$h2 ID/№ на ф. лице</th>
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
?>	        
	        <td style = "width: 80px;"><button onclick = "location.assign('subAdminUpdateServiceDataAuto.php')">Редакция</button></td>
	        
<?php	        
            echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
            echo "<td style='color:black;'>" . $row['Individual_ID'] . "</td>";
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
	
	if (mysqli_num_rows($resultRepair) < 1 && $_SESSION['Person']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за ремонт на МПС за това физическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultRepair) > 0 && $_SESSION['Person']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за ремонт на МПС на физическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    <tr>
	    <th></th>
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
?>	        
	        <td style = "width: 80px;"><button onclick = "location.assign('subAdminUpdateRepairDataAuto.php')">Редакция</button></td>
	        
<?php	        
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
	
	if (mysqli_num_rows($resultTyres) < 1 && $_SESSION['Person']) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за гуми на МПС за това физическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultTyres) > 0 && $_SESSION['Person']) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за гуми на МПС на физическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    <tr>
	    <th></th>
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
?>	        
	        <td style = "width: 80px;"><button onclick = "location.assign('subAdminUpdateTyresDataAuto.php')">Редакция</button></td>
	        
<?php	         
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

<br><br>

</div>
</body>
</html>