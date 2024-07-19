<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	width: 100%;
}
tr:nth-child(even) {background-color: #d8f0f3;}
tr:hover  td {background-color:red; color: white;}

</style>
</head>
<body> 

<div id = "nav"></div>

<br>


<br><br><br>
<h3 style = "text-align: center;">Прехвърляне на собственост на МПС:</h3>
<br>
<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 11.0vw;">  
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    Рег. № на МПС:<br><input id = "regNum" type="text" name="Reg_Number" placeholder = "Попълнете едното"/>
    <br><br>
    Шаси № на МПС:<br><input id = "shasi" type="text" name="Vin_Number"  placeholder = "от двете полета"/>
    <br><br>
    ЕИК на нов собсвеник:<br><input id = "eik" type="text" name="EIK" placeholder = "Попълнете едното "/>
    <br><br>
    ЕГН на нов собсвеник:<br><input id = "egn" type="text" name="EGN" placeholder = "от двете полета"/>
    <br><br>
	<input id = "btnTA" type="submit" name="btnTransferAuto" value="Прехвърляне на МПС" style = "border-radius: 2px; color: red;">
</form>
<br><br>

<script>

    document.getElementById('btnTA').onclick = function() {
    
    if(((document.getElementById('regNum').value != "" && document.getElementById('shasi').value == "") || 
       (document.getElementById('regNum').value == "" && document.getElementById('shasi').value != "")) && 
       ((document.getElementById('eik').value != "" && document.getElementById('egn').value == "") ||
       (document.getElementById('eik').value == "" && document.getElementById('egn').value != "")))
        return confirm('Сигурни ли сте,че искате да извършите прехвърляне на собственост на МПС?');
};    
    
</script>

<br>
<h3 style = "text-align: center;">Проверка за собственост на МПС:</h3>
<br>
<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 11.0vw;">  
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    Рег. № на МПС:<br><input type="text" name="Reg_Number"  placeholder = "Попълнете едното"/>
    <br><br>
    Шаси № на МПС:<br><input type="text" name="Vin_Number"  placeholder = "от двете полета"/>
    <br><br>
	<input type="submit" name="btnShowOwner" value="Собственост на" style = "border-radius: 2px; color: red;">
  </form>

  
<?php

include 'functions.php';

$btnShowOwner = false;
$btnTransferAuto = false;
$btnGiveUpAuto = false;
$btnRegisterAuto = false;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}


if(isset($_POST["btnShowOwner"])) {
	$btnShowOwner = true;
}
if(isset($_POST["btnTransferAuto"])) {
	$btnTransferAuto = true;
}
if(isset($_POST["btnGiveUpAuto"])) {
	$btnGiveUpAuto = true;
}
if(isset($_POST["btnRegisterAuto"])) {
	$btnRegisterAuto = true;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowOwner == true) {
	$con = connectServer();
	
	if(strlen($_POST['Reg_Number']) > 0 && strlen($_POST['Vin_Number']) == 0) {
	
	    $resultRegNum = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	    if (mysqli_num_rows($resultRegNum) > 0) {
	
	        $ownerPerson = mysqli_query($con, "SELECT Individual_ID FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	        $ownerFirm = mysqli_query($con, "SELECT Legalentity_ID FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	        $personID = 0;
	        $firmID = 0;
	        
	        while($rowPerson = mysqli_fetch_array($ownerPerson))
	        		$personID = $rowPerson['Individual_ID'];
	        while($rowFirm = mysqli_fetch_array($ownerFirm))
	        		$firmID = $rowFirm['Legalentity_ID'];
	    
	        if ($personID > 0) {
	        	
	        	$ownerData = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = $personID");
                
                if (mysqli_num_rows($ownerData) > 0) {
                    
                    echo"<div align = 'center'>";
	        	    echo"<br><br>";
                    echo '<span style="font-size: 20px;">Данни на собственик на МПС с рег. №</span>'  . " " . 
                    '<span style="font-size: 20px; color: red;">' . $_POST['Reg_Number'] . '</span>' . " " ; 
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
	        	    while($row = mysqli_fetch_array($ownerData)) {
	        	        echo "<tr>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Individual_ID'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Admin_Username'] . "</td>";	
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Sub_Admin_Username'] . "</td>";	
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Names'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['EGN'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address_MPS'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Contact_Person'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone_Contact_Person'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Contact_Person'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Username'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Password'] . "</td>"; 
	                    echo "</tr>";
	        	    }
                    echo "</table>"; 
                }
        
	            echo"</div>";
	        }
	        else if ($firmID > 0) {
	        	
	        	$ownerData = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = $firmID");
	        	
	        	echo"<div align = 'center'>";
                    
                    if (mysqli_num_rows($ownerData) > 0) {
                        
                        echo "<br>";
	        	        echo '<span style="font-size: 20px; color:white;">Данни на собственик на МПС с рег. №</span>'  . " " . 
                             '<span style="font-size: 20px; color: white;">' . $_POST['Reg_Number'] . '</span>';
                        echo "<br><br>";
                        echo "<table border='2'>
	    
	                    <tr>
	                    <th bgcolor='$color1'>$h2 №</th>
	                    <th bgcolor='$color1'>$h2 Подаминистратор Потреб. име</th>
	                    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	                    <th bgcolor='$color1'>$h2 Име</th>
	                    <th bgcolor='$color1'>$h2 ЕИК</th>
	                    <th bgcolor='$color1'>$h2 ДДС номер</th>
	                    <th bgcolor='$color1'>$h2 Адрес</th>
	                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	                    <th bgcolor='$color1'>$h2 МОЛ</th>
	                    <th bgcolor='$color1'>$h2 Телефон</th>
	                    <th bgcolor='$color1'>$h2 Имейл</th>
	                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
	                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	                    <th bgcolor='$color1'>$h2 Потребителско име</th>
	                    <th bgcolor='$color1'>$h2 Парола</th>
	                    </tr>";
	                    
	                    while($row = mysqli_fetch_array($ownerData))
	                    {
	                        echo "<tr>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Legalentity_ID'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Admin_Username'] . "</td>";	
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Sub_Admin_Username'] . "</td>";	
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Name'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['EIK'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['DDS_Nomer'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address_MPS'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['MOL_Names'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Contact_Person'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone_Contact_Person'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Contact_Person'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Username'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Password'] . "</td>"; 
	                        echo "</tr>";
	                    }
	                    echo "</table>";
                    }
	            echo"</div>";
	        }
	        else {
                    $message = "Няма данни за собственост на МПС!";
	                echo "<script>alert('$message');</script>";
            }
	    }
	
	    else {
		    $message = "Няма рег. №" . $_POST['Reg_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else if (strlen($_POST['Reg_Number']) == 0 && strlen($_POST['Vin_Number']) > 0) {
	    $resultVinNum = mysqli_query($con, "SELECT * FROM autos WHERE Shasi = '$_POST[Vin_Number]'");
	    if (mysqli_num_rows($resultVinNum) > 0) {
	
	        $ownerPerson = mysqli_query($con, "SELECT Individual_ID FROM autos WHERE Shasi = '$_POST[Vin_Number]'");
	        $ownerFirm = mysqli_query($con, "SELECT Legalentity_ID FROM autos WHERE Shasi = '$_POST[Vin_Number]'");
	        $personID = 0;
	        $firmID = 0;
	        
	        while($rowPerson = mysqli_fetch_array($ownerPerson))
	        		$personID = $rowPerson['Individual_ID'];
	        while($rowFirm = mysqli_fetch_array($ownerFirm))
	        		$firmID = $rowFirm['Legalentity_ID'];
	    
	        if ($personID > 0) {
	        	
	        	$ownerData = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = $personID");
	        	
	        	echo"<div align = 'center'>";
	        	
                if (mysqli_num_rows($ownerData) > 0) {
                    
                    echo"<br><br>";
                    echo '<span style="font-size: 20px;">Данни на собственик на МПС с шаси №</span>'  . " " . 
                    '<span style="font-size: 20px; color: red;">' . $_POST['Vin_Number'] . '</span>' . " " ; 
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
	        	    while($row = mysqli_fetch_array($ownerData)) {
	        	        echo "<tr>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Individual_ID'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Admin_Username'] . "</td>";	
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Sub_Admin_Username'] . "</td>";	
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Names'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['EGN'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address_MPS'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Contact_Person'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone_Contact_Person'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Contact_Person'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Username'] . "</td>";
	                    echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Password'] . "</td>"; 
	                    echo "</tr>";
	        	    }
                    echo "</table>"; 
                }    
	            echo"</div>";
	        }
	        else if($firmID > 0) {
	        	
	        	$ownerData = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = $firmID");
	        		
	        	echo"<div align = 'center'>";
	        	    
                    if (mysqli_num_rows($ownerData) > 0) {
                        
                        echo "<br>";
	        	        echo '<span style="font-size: 20px;">Данни на собственик на МПС с шаси №</span>'  . " " . 
                             '<span style="font-size: 20px; color: red;">' . $_POST['Vin_Number'] . '</span>';
                        echo "<br><br>";
                        echo "<table border='2'>
	    
	                    <tr>
	                    <th bgcolor='$color1'>$h2 №</th>
	                    <th bgcolor='$color1'>$h2 Подаминистратор Потреб. име</th>
	                    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	                    <th bgcolor='$color1'>$h2 Име</th>
	                    <th bgcolor='$color1'>$h2 ЕИК</th>
	                    <th bgcolor='$color1'>$h2 ДДС номер</th>
	                    <th bgcolor='$color1'>$h2 Адрес</th>
	                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	                    <th bgcolor='$color1'>$h2 МОЛ</th>
	                    <th bgcolor='$color1'>$h2 Телефон</th>
	                    <th bgcolor='$color1'>$h2 Имейл</th>
	                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
	                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	                    <th bgcolor='$color1'>$h2 Потребителско име</th>
	                    <th bgcolor='$color1'>$h2 Парола</th>
	                    </tr>";
	                    
	                    while($row = mysqli_fetch_array($ownerData))
	                    {
	                        echo "<tr>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Legalentity_ID'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Admin_Username'] . "</td>";	
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Sub_Admin_Username'] . "</td>";	
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Name'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['EIK'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['DDS_Nomer'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Address_MPS'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['MOL_Names'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Contact_Person'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone_Contact_Person'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Contact_Person'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Email_Username'] . "</td>";
	                        echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Password'] . "</td>"; 
	                        echo "</tr>";
	                    }
	                    echo "</table>";
                    }
	            echo"</div>";
	        }
	        else {
                    $message = "Няма данни за собственост на МПС!";
	                echo "<script>alert('$message');</script>";
            }
	    }   
	
	    else {
		    $message = "Няма шаси №" . $_POST['Vin_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else {
	    $message = "Моля попълнете едното от двете полета!";
	    echo "<script>alert('$message');</script>";
	}
	
	
	mysqli_close($con);
}

?>




<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnTransferAuto == true) {
	$con = connectServer();
	
	//$resultRegNum = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	$autoId = 0;
	$personId = 0;
	$firmId = 0;
	$zeroAutos = false; $oneAutos = false; $zeroInsurance = false; $oneInsurance = false; $zeroService = false; $oneService = false; 
	$zeroRepair = false; $oneRepair = false; $zeroTyres = false; $oneTyres = false;
	
	if((strlen($_POST['EIK']) > 0 && strlen($_POST['EGN']) > 0 || strlen($_POST['EIK']) == 0 && strlen($_POST['EGN']) == 0) ||
	   (strlen($_POST['Reg_Number']) > 0 && strlen($_POST['Vin_Number']) > 0 || strlen($_POST['Reg_Number']) == 0 && strlen($_POST['Vin_Number']) == 0)) {
	       
	    $message = "Моля попълнете рег. № или шаси № на МПС и ЕИК или ЕГН на нов собственик!";
	    echo "<script>alert('$message');</script>";
	}
	
	else if(strlen($_POST['Reg_Number']) > 0) {
	    $resultRegNum = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	    if (mysqli_num_rows($resultRegNum) > 0) {
	        while($row = mysqli_fetch_array($resultRegNum)) {
	        	$autoId = $row['AutosID'];
	        	$personId = $row['Individual_ID'];
	        	$firmId = $row['Legalentity_ID'];
	        }
	        if($personId == 0 && $firmId == 0) {
	            $message = "Моля въведете рег. № на неотписано МПС!";
	            echo "<script>alert('$message');</script>";    
	        }
	    }
	    else {
		    $message = "Няма рег. №" . $_POST['Reg_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else if(strlen($_POST['Vin_Number']) > 0) {
	    $resultVinNum = mysqli_query($con, "SELECT * FROM autos WHERE Shasi = '$_POST[Vin_Number]'");
	    if (mysqli_num_rows($resultVinNum) > 0) {
	        while($row = mysqli_fetch_array($resultVinNum)) {
	        	$autoId = $row['AutosID'];
	        	$personId = $row['Individual_ID'];
	        	$firmId = $row['Legalentity_ID'];
	        }
	        if($personId == 0 && $firmId == 0) {
	            $message = "Моля въведете шаси № на неотписано МПС!";
	            echo "<script>alert('$message');</script>";    
	        }
	    }
	    else {
		    $message = "Няма шаси №" . $_POST['Vin_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else {
		$message = "Възникна грешка, опитайте отново!";
	    echo "<script>alert('$message');</script>";
	}
	
	if(strlen($_POST['EIK']) > 0)
	{
	    $resultEik = mysqli_query($con, "SELECT * FROM legalentity WHERE EIK = '$_POST[EIK]'");
	    if (mysqli_num_rows($resultEik) < 1) {
	    	
	    	$message = "Няма юридическо лице с ЕИК №" . $_POST['EIK'] . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($resultEik) > 0 && $firmId > 0) {
	        
	        while($row = mysqli_fetch_array($resultEik)) 
	    	    $legalentityId = $row['Legalentity_ID'];
	    	    
	        $transferAuto = "UPDATE autos SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferInsurance = "UPDATE insurance SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferService = "UPDATE service SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferRepair = "UPDATE repair SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferTyres = "UPDATE tyres SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            
            $updateAutos = mysqli_query($con, $transferAuto);
            if(mysqli_affected_rows($con) == 0) {
                $zeroAutos = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneAutos = true;
            }
            
		    $updateInsurance = mysqli_query($con, $transferInsurance);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroInsurance = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneInsurance = true;
            }
            
            $updateService = mysqli_query($con, $transferService);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroService = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneService = true;
            }
            
            $updateRepair = mysqli_query($con, $transferRepair);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroRepair = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneRepair = true;
            }
            
            $updateTyres = mysqli_query($con, $transferTyres);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroTyres = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneTyres = true;
            }
            
            if($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true && $zeroTyres == true) {
                mysqli_commit($con);
                $message = "Няма промяна на собственост на МПС!";
   	            echo "<script>alert('$message');</script>";
            }
            else if($oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Прехвърлянето на собственост на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	         
            }
            else if($oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) && $oneTyres == true) {
               mysqli_commit($con);
               $message = "Прехвърлянето на собственост на МПС е успешно!";
   	           echo "<script>alert('$message');</script>";
   	        
           } 
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка! Опитайте отново!";
             echo "<script>alert('$message');</script>";
            }
            
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
	    }
	    
	    if (mysqli_num_rows($resultEik) > 0 && $personId > 0) {
	        
	        while($row = mysqli_fetch_array($resultEik)) 
	    	    $legalentityId = $row['Legalentity_ID'];
	    	    
	        $transferAuto = "UPDATE autos SET Individual_ID = 0, Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferInsurance = "UPDATE insurance SET Individual_ID = 0, Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferService = "UPDATE service SET Individual_ID = 0, Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferRepair = "UPDATE repair SET Individual_ID = 0, Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $transferTyres = "UPDATE tyres SET Individual_ID = 0, Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            
            $updateAutos = mysqli_query($con, $transferAuto);
            if(mysqli_affected_rows($con) == 0) {
                $zeroAutos = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneAutos = true;
            }
            
		    $updateInsurance = mysqli_query($con, $transferInsurance);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroInsurance = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneInsurance = true;
            }
            
            $updateService = mysqli_query($con, $transferService);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroService = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneService = true;
            }
            
            $updateRepair = mysqli_query($con, $transferRepair);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroRepair = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneRepair = true;
            }
            
            $updateTyres = mysqli_query($con, $transferTyres);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroTyres = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneTyres = true;
            }
            
            if($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true && $zeroTyres == true) {
                mysqli_commit($con);
                $message = "Няма промяна на собственост на МПС!";
   	            echo "<script>alert('$message');</script>";
            }
            else if($oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Прехвърлянето на собственост на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	         
            }
            else if($oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) && $oneTyres == true) {
               mysqli_commit($con);
               $message = "Прехвърлянето на собственост на МПС е успешно!";
   	           echo "<script>alert('$message');</script>";
   	        
           }
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка! Опитайте отново!";
             echo "<script>alert('$message');</script>";
            }
            
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
	    }
	}
	
	if(strlen($_POST['EGN']) > 0)
	{
	    $resultEgn = mysqli_query($con, "SELECT * FROM individual WHERE EGN = '$_POST[EGN]'");
	    if (mysqli_num_rows($resultEgn) < 1) {
	    	
	    	$message = "Няма физическо лице с ЕГН №" . $_POST['EGN'] . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($resultEgn) > 0 && $personId > 0) {
	        
	        while($row = mysqli_fetch_array($resultEgn)) 
	    	    $individualId = $row['Individual_ID'];
	    	    
	        $transferAuto = "UPDATE autos SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferInsurance = "UPDATE insurance SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferService = "UPDATE service SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferRepair = "UPDATE repair SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferTyres = "UPDATE tyres SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            
            $updateAutos = mysqli_query($con, $transferAuto);
            if(mysqli_affected_rows($con) == 0) {
                $zeroAutos = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneAutos = true;
            }
            
		    $updateInsurance = mysqli_query($con, $transferInsurance);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroInsurance = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneInsurance = true;
            }
            
            $updateService = mysqli_query($con, $transferService);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroService = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneService = true;
            }
            
            $updateRepair = mysqli_query($con, $transferRepair);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroRepair = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneRepair = true;
            }
            
            $updateTyres = mysqli_query($con, $transferTyres);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroTyres = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneTyres = true;
            }
            
            if($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true && $zeroTyres == true) {
                mysqli_commit($con);
                $message = "Няма промяна на собственост на МПС!";
   	            echo "<script>alert('$message');</script>";
            }
            else if($oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Прехвърлянето на собственост на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	         
            }
            else if($oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) && $oneTyres == true) {
               mysqli_commit($con);
               $message = "Прехвърлянето на собственост на МПС е успешно!";
   	           echo "<script>alert('$message');</script>";
   	        
           }
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка! Опитайте отново!";
             echo "<script>alert('$message');</script>";
            }
            
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
	    }
	    
	    if (mysqli_num_rows($resultEgn) > 0 && $firmId > 0) {
	        
	        while($row = mysqli_fetch_array($resultEgn)) 
	    	    $individualId = $row['Individual_ID'];
	    	    
	        $transferAuto = "UPDATE autos SET Legalentity_ID = 0, Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferInsurance = "UPDATE insurance SET Legalentity_ID = 0, Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferService = "UPDATE service SET Legalentity_ID = 0, Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferRepair = "UPDATE repair SET Legalentity_ID = 0, Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $transferTyres = "UPDATE tyres SET Legalentity_ID = 0, Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            
            $updateAutos = mysqli_query($con, $transferAuto);
            if(mysqli_affected_rows($con) == 0) {
                $zeroAutos = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneAutos = true;
            }
            
		    $updateInsurance = mysqli_query($con, $transferInsurance);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroInsurance = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneInsurance = true;
            }
            
            $updateService = mysqli_query($con, $transferService);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroService = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneService = true;
            }
            
            $updateRepair = mysqli_query($con, $transferRepair);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroRepair = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneRepair = true;
            }
            
            $updateTyres = mysqli_query($con, $transferTyres);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroTyres = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneTyres = true;
            }
            
            if($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true && $zeroTyres == true) {
                mysqli_commit($con);
                $message = "Няма промяна на собственост на МПС!";
   	            echo "<script>alert('$message');</script>";
            }
            else if($oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Прехвърлянето на собственост на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	         
            } 
            else if($oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) && $oneTyres == true) {
               mysqli_commit($con);
               $message = "Прехвърлянето на собственост на МПС е успешно!";
   	           echo "<script>alert('$message');</script>";
   	        
           }
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка! Опитайте отново!";
             echo "<script>alert('$message');</script>";
            }
            
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
	    }
	}
	
	mysqli_close($con);

}

	
?>

<br>
    <h3 style = "text-align: center;">Отписване на МПС</h3><br>
      <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "margin-left: 11.0vw; color: black;">  
        Рег. № на МПС:<br><input id = "rNum" type="text" name="Reg_Number"  placeholder = "Попълнете едното"/>
        <br><br>
        Шаси № на МПС:<br><input id = "vNum" type="text" name="Vin_Number"  placeholder = "от двете полета"/>
        <br><br>
            
        <input id = "btnGUA" type="submit" name="btnGiveUpAuto" value="Отписване" style = "border-radius: 2px; color: red;">
      </form>    
<br><br>


<script>

    document.getElementById('btnGUA').onclick = function() {
    
    if((document.getElementById('rNum').value != "" && document.getElementById('vNum').value == "") || 
       (document.getElementById('rNum').value == "" && document.getElementById('vNum').value != "")) 
        return confirm('Сигурни ли сте,че искате да извършите отписване на МПС?');
};    
    
</script>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnGiveUpAuto == true) {
	$con = connectServer();
	
	//$resultRegNum = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	$statusData = false;
	$autoId = 0;
	$zeroAutos = false; $oneAutos = false; $zeroInsurance = false; $oneInsurance = false; $zeroService = false; $oneService = false; 
	$zeroRepair = false; $oneRepair = false; $zeroTyres = false; $oneTyres = false;
	
	if((strlen($_POST['Reg_Number']) > 0 && strlen($_POST['Vin_Number']) > 0 || strlen($_POST['Reg_Number']) == 0 && strlen($_POST['Vin_Number']) == 0)) {
	       
	    $message = "Моля попълнете едното от двете полета!";
	    echo "<script>alert('$message');</script>";
	}
	
	else if(strlen($_POST['Reg_Number']) > 0) {
	    $resultRegNum = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	    if (mysqli_num_rows($resultRegNum) > 0) {
	        while($row = mysqli_fetch_array($resultRegNum)) {
	        	$autoId = $row['AutosID'];
	        }
	        $statusData = true;
	    }
	    else {
		    $message = "Няма рег. №" . $_POST['Reg_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else if(strlen($_POST['Vin_Number']) > 0) {
	    $resultVinNum = mysqli_query($con, "SELECT * FROM autos WHERE Shasi = '$_POST[Vin_Number]'");
	    if (mysqli_num_rows($resultVinNum) > 0) {
	        while($row = mysqli_fetch_array($resultVinNum)) {
	        	$autoId = $row['AutosID'];
	        }
	        $statusData = true;
	    }
	    else {
		    $message = "Няма шаси №" . $_POST['Vin_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else {
		$message = "Възникна грешка, опитайте отново!";
	    echo "<script>alert('$message');</script>";
	}
	if($statusData) {
	    
	    $giveUpAuto = "UPDATE autos SET Individual_ID = 0, Legalentity_ID = 0 
	    Where AutosID = '$autoId'";
	    
	    $giveUpInsurance = "UPDATE insurance SET Individual_ID = 0, Legalentity_ID = 0
	    Where AutosID = '$autoId'";
	    
	    $giveUpService = "UPDATE service SET Individual_ID = 0, Legalentity_ID = 0 
	    Where AutosID = '$autoId'";
	    
	    $giveUpRepair = "UPDATE repair SET Individual_ID = 0, Legalentity_ID = 0 
	    Where AutosID = '$autoId'";
	    
	    $giveUpTyres = "UPDATE tyres SET Individual_ID = 0, Legalentity_ID = 0 
	    Where AutosID = '$autoId'";
	    
	    mysqli_autocommit($con, FALSE);
        mysqli_query($con,"START TRANSACTION");
        
        $updateAutos = mysqli_query($con, $giveUpAuto);
        if(mysqli_affected_rows($con) == 0) {
            $zeroAutos = true;
        }
        if(mysqli_affected_rows($con) >= 1) {
            $oneAutos = true;
        }
        
	    $updateInsurance = mysqli_query($con, $giveUpInsurance);
	    if(mysqli_affected_rows($con) == 0) {
            $zeroInsurance = true;
        }
        if(mysqli_affected_rows($con) >= 1) {
            $oneInsurance = true;
        }
        
        $updateService = mysqli_query($con, $giveUpService);
	    	  if(mysqli_affected_rows($con) == 0) {
            $zeroService = true;
        }
        if(mysqli_affected_rows($con) >= 1) {
            $oneService = true;
        }
        
        $updateRepair = mysqli_query($con, $giveUpRepair);
	    	  if(mysqli_affected_rows($con) == 0) {
            $zeroRepair = true;
        }
        if(mysqli_affected_rows($con) >= 1) {
            $oneRepair = true;
        }
        
        $updateTyres = mysqli_query($con, $giveUpTyres);
	    	  if(mysqli_affected_rows($con) == 0) {
            $zeroTyres = true;
        }
        if(mysqli_affected_rows($con) >= 1) {
            $oneTyres = true;
        }
        
        if($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true && $zeroTyres == true) {
            mysqli_commit($con);
            $message = "Няма промяна на собственост на МПС!";
   	        echo "<script>alert('$message');</script>";
        }
        else if($oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true && $oneTyres == true) {
            mysqli_commit($con);
            $message = "Отписването на МПС е успешно!";
   	        echo "<script>alert('$message');</script>";
   	     
        }
        else if($oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) && $oneTyres == true) {
            mysqli_commit($con);
            $message = "Отписването на МПС е успешно!";
   	        echo "<script>alert('$message');</script>";
   	            
        }
        else {  
         mysqli_rollback($con);
   	     $message = "Възникна грешка! Опитайте отново!";
         echo "<script>alert('$message');</script>";
        }
	}    
    mysqli_query($con, "SET AUTOCOMMIT=TRUE");
            
    mysqli_close($con);
	
}

?>

<br><br>
<h3 style = "text-align: center;">Записване на МПС:</h3>
<br>
<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 11.0vw;">  
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    Рег. № на МПС:<br><input type="text" name="Reg_Number" placeholder = "Попълнете едното"/>
    <br><br>
    Шаси № на МПС:<br><input type="text" name="Vin_Number"  placeholder = "от двете полета"/>
    <br><br>
    ЕИК на нов собсвеник:<br><input type="text" name="EIK" placeholder = "Попълнете едното "/>
    <br><br>
    ЕГН на нов собсвеник:<br><input type="text" name="EGN" placeholder = "от двете полета"/>
    <br><br>
	<input type="submit" name="btnRegisterAuto" value="Записване на МПС" style = "border-radius: 2px; color: red;">
</form>
<br><br>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnRegisterAuto == true) {
    
	$con = connectServer();
	$autoId = 0;
	$autoPersonID = 0;
	$autoFirmID = 0;
	$autoOwner = false;
	$zeroAutos = false; $oneAutos = false; $zeroInsurance = false; $oneInsurance = false; $zeroService = false; $oneService = false; 
	$zeroRepair = false; $oneRepair = false; $zeroTyres = false; $oneTyres = false;
	
	if((strlen($_POST['EIK']) > 0 && strlen($_POST['EGN']) > 0 || strlen($_POST['EIK']) == 0 && strlen($_POST['EGN']) == 0) ||
	   (strlen($_POST['Reg_Number']) > 0 && strlen($_POST['Vin_Number']) > 0 || strlen($_POST['Reg_Number']) == 0 && strlen($_POST['Vin_Number']) == 0)) {
	       
	    $message = "Моля попълнете рег. № или шаси № на МПС и ЕИК или ЕГН на нов собственик!";
	    echo "<script>alert('$message');</script>";
	}
	else if(strlen($_POST['Reg_Number']) > 0) {
	    $resultRegNum = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
	    if (mysqli_num_rows($resultRegNum) > 0) {
	        while($row = mysqli_fetch_array($resultRegNum)) {
	        	$autoId = $row['AutosID'];
	        	$autoPersonID = $row['Individual_ID'];
	            $autoFirmID = $row['Legalentity_ID'];
	        }
	        if($autoPersonID > 0 || $autoFirmID > 0) {
	            $autoOwner = true;
	            $message = "Моля въведете рег. № на отписано МПС!";
	            echo "<script>alert('$message');</script>";
	        }
	    }
	    else {
		    $message = "Няма рег. №" . $_POST['Reg_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else if(strlen($_POST['Vin_Number']) > 0) {
	    $resultVinNum = mysqli_query($con, "SELECT * FROM autos WHERE Shasi = '$_POST[Vin_Number]'");
	    if (mysqli_num_rows($resultVinNum) > 0) {
	        while($row = mysqli_fetch_array($resultVinNum)) {
	        	$autoId = $row['AutosID'];
	        	$autoPersonID = $row['Individual_ID'];
	            $autoFirmID = $row['Legalentity_ID'];
	        }
	        if($autoPersonID > 0 || $autoFirmID > 0) {
	            $autoOwner = true;
	            $message = "Моля въведете шаси № на отписано МПС!";
	            echo "<script>alert('$message');</script>";
	        }
	    }
	    else {
		    $message = "Няма шаси №" . $_POST['Vin_Number'] . " в базата данни!";
	        echo "<script>alert('$message');</script>";
	    }
	}
	else {
		$message = "Възникна грешка, опитайте отново!";
	    echo "<script>alert('$message');</script>";
	}
	
	if(strlen($_POST['EIK']) > 0 && !$autoOwner)
	{
	    $resultEik = mysqli_query($con, "SELECT * FROM legalentity WHERE EIK = '$_POST[EIK]'");
	    if (mysqli_num_rows($resultEik) < 1) {
	    	
	    	$message = "Няма юридическо лице с ЕИК №" . $_POST['EIK'] . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($resultEik) > 0) {
	        
	        while($row = mysqli_fetch_array($resultEik)) 
	    	    $legalentityId = $row['Legalentity_ID'];
	    	    
	        $reisterAuto = "UPDATE autos SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $reisterInsurance = "UPDATE insurance SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $reisterService = "UPDATE service SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $reisterRepair = "UPDATE repair SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    $reisterTyres = "UPDATE tyres SET Legalentity_ID = '$legalentityId' 
		    Where AutosID = '$autoId'";
		    
		    mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            
            $updateAutos = mysqli_query($con, $reisterAuto);
            if(mysqli_affected_rows($con) == 0) {
                $zeroAutos = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneAutos = true;
            }
            
		    $updateInsurance = mysqli_query($con, $reisterInsurance);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroInsurance = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneInsurance = true;
            }
            
            $updateService = mysqli_query($con, $reisterService);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroService = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneService = true;
            }
            
            $updateRepair = mysqli_query($con, $reisterRepair);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroRepair = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneRepair = true;
            }
            
            $updateTyres = mysqli_query($con, $reisterTyres);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroTyres = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneTyres = true;
            }
            
            if($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true && $zeroTyres == true) {
                mysqli_commit($con);
                $message = "Няма промяна на собственост на МПС!";
   	            echo "<script>alert('$message');</script>";
            }
            else if($oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Записването на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	         
            }
            else if($oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Записването на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	        
            }
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка! Опитайте отново!";
             echo "<script>alert('$message');</script>";
            }
            
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
	    }
	}
	
	if(strlen($_POST['EGN']) > 0 && !$autoOwner)
	{
	    $resultEgn = mysqli_query($con, "SELECT * FROM individual WHERE EGN = '$_POST[EGN]'");
	    if (mysqli_num_rows($resultEgn) < 1) {
	    	
	    	$message = "Няма физическо лице с ЕГН №" . $_POST['EGN'] . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    echo "<br><br>";
	    if (mysqli_num_rows($resultEgn) > 0) {
	        
	        while($row = mysqli_fetch_array($resultEgn)) 
	    	    $individualId = $row['Individual_ID'];
	    	    
	        $registerAuto = "UPDATE autos SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $registerInsurance = "UPDATE insurance SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $registerService = "UPDATE service SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $registerRepair = "UPDATE repair SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    $registerTyres = "UPDATE tyres SET Individual_ID = '$individualId' 
		    Where AutosID = '$autoId'";
		    
		    mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            
            $updateAutos = mysqli_query($con, $registerAuto);
            if(mysqli_affected_rows($con) == 0) {
                $zeroAutos = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneAutos = true;
            }
            
		    $updateInsurance = mysqli_query($con, $registerInsurance);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroInsurance = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneInsurance = true;
            }
            
            $updateService = mysqli_query($con, $registerService);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroService = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneService = true;
            }
            
            $updateRepair = mysqli_query($con, $registerRepair);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroRepair = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneRepair = true;
            }
            
            $updateTyres = mysqli_query($con, $registerTyres);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroTyres = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneTyres = true;
            }
            
            if($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true && $zeroTyres == true) {
                mysqli_commit($con);
                $message = "Няма промяна на собственост на МПС!";
   	            echo "<script>alert('$message');</script>";
            }
            else if($oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Записването на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	         
            }
            else if($oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) && $oneTyres == true) {
                mysqli_commit($con);
                $message = "Записването на МПС е успешно!";
   	            echo "<script>alert('$message');</script>";
   	        
            }
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка! Опитайте отново!";
             echo "<script>alert('$message');</script>";
            }
            
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
	    }
	}
	    
	mysqli_close($con);
}

?>


</body>
</html>