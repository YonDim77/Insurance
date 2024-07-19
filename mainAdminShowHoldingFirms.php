<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

$_SESSION['Holding_Name'] = $_POST['Holding_Name'];
$_SESSION['Reg_Number'] = "";

include 'functions.php';

?>

<!DOCTYPE html>
<html>
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">-->
<meta charset="UTF-8">
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

th {
    text-align: center;
}

td {
    text-align: center;
    color: black;
}

</style>
</head>
<body> 

<div id = "nav"></div>

<script>

function showSubAdmin(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("subAdminValue").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("subAdminValue").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getSubAdmin.php?q="+str, true);
  xhttp.send();
}

</script>

<br><br>
<div align = "center">
	<h3 style = "text-align: center; margin-top: 6.0vw;">Визуализиране на фирми към холдинг <span style = "color: red;"><?php  echo $_SESSION['Holding_Name']; ?></span></h3>
    <br><br>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">
    <select style = "height: 27px;" name="Holding_Name" required = "required">
        <option value="<?php echo $_SESSION['Holding_Name']; ?>"><?php if(isset($_SESSION['Holding_Name'])) echo $_SESSION['Holding_Name']; else echo "Изберете холдинг"; ?></option>
              <?php
                  $con = connectServer();
                  $query = "SELECT * FROM holding";
                  $results=mysqli_query($con, $query);
                  //loop
                  foreach ($results as $holdings){
              ?>
        <option value="<?php echo $holdings['Name'];?>"><?php echo $holdings['Name'];?></option>
              <?php
                  }
                  mysqli_close($con);
                  
              ?>
                  
    </select>
    <br><br>
    <input type="submit" style = "" name="btnFilter" value="Покажи данни" style = "border-radius: 2px; color: red;">
    <br><br>
    <br><br>
    
<?php

$btnFilter = false;
$btnShowDataForm = false;
$btnShowDataAuto = false;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnFilter"])) {
	$btnFilter = true;
}

if(isset($_POST["btnShowDataAuto"])) {
	$btnShowDataAuto = true;
}


$index = 0;


if (($_SERVER["REQUEST_METHOD"] == "POST" || $btnFilter) && $btnShowDataAuto == false) {
    $con = connectServer();
    
    if((strlen($_POST['Holding_Name']) > 0))
    {
        $_SESSION['Holding_Name'] = $_POST['Holding_Name'];
    }
    
    if(strlen($_SESSION['Holding_Name']) > 0)
    {
        $showLegalentityData = mysqli_query($con, "SELECT * FROM legalentity WHERE Holding_Name = '$_SESSION[Holding_Name]'"); 
                                                   
    }
	
	if (mysqli_num_rows($showLegalentityData) > 0) {
	    
	        //echo"<div align = 'center'>";
            //echo '<span id = "text" style="font-size: 20px; color:black;">Данни за юридическо лице с име или име започващо с: </span>' . "  " .
	        //'<span id = "name" style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Name'] . '</span>';
	        //echo"</div>";
            //echo"<br><br>";
	        
	    echo "<table border='2' id = 't1'>
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
	    <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор Потреб. име</th>
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
	    <th bgcolor='$color1'>$h2 Холдинг</th>
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($showLegalentityData))
	    {
	        echo "<tr>";
	        echo "<td>"; echo'<input type = "submit" value="Покажи" style = "width: 70px;" name = "button' . $index . '" >';
	        echo "<td>"; echo'<input style = "background-color: #f2e6ff; width: 50px; border: 0px; text-align: center;" type = "number" value="'. $row['Legalentity_ID']. '" name = "Legalentity_ID' . $index . '" readonly>'; echo"</td>";
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
	    	    //echo "<script>document.getElementById('text').style.display = 'none';</script>";
	    	    //echo "<script>document.getElementById('name').style.display = 'none';</script>";
    	    }
	            
	        $index++;
	    }
	    echo "</table>";
	    
	}
	
	mysqli_close($con);
}   
 ?>
 
 
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataForm == true) {
    
    
    $con = connectServer();

	
	$adminUsername = $_SESSION['username'];        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11
	//$Individual_ID = $_POST['Individual_ID'];
	
	$resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$Legalentity_ID'");
	$resultFirmName = mysqli_query($con, "SELECT Name FROM legalentity WHERE Legalentity_ID = '$Legalentity_ID'");
	
	$Color = "red";
	
	if (!filter_var($Legalentity_ID, FILTER_VALIDATE_INT)) {
    
	echo "<br>";
    echo"<br><br>";
	echo"<div align = 'center'>";
	echo'<span style="font-size: 20px; color:black; ">Въведете цяло число в полето "ID"!</span>';
    echo"</div>";
	
    } 
	
	if (mysqli_num_rows($resultFirm) < 1) {
		
		//echo"<br><br>";
		//echo"<div align = 'center'>";
		//echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за физическо лице!</span>'; //. " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		//echo"</div>";
		$message = "Грешка! Няма данни за юридическо лице!";
		echo "<script>alert('$message');</script>";
	  
	}
	
	if (mysqli_num_rows($resultFirm) > 0 && mysqli_num_rows($resultFirmName) > 0) {
	
	    if($rowName = mysqli_fetch_array($resultFirmName)) {
	        
	        echo"<div align = 'center'>";
	        //echo "<script>document.getElementById('lFace').style.display = 'none';</script>";
	    	//echo "<script>document.getElementById('eik').style.display = 'none';</script>";
            echo '<span style="font-size: 20px; color:black;">Данни на </span>'  . "  " .
	        '<span style="font-size: 20px; color:' . $Color . '">' . $rowName['Name'] . '</span>';
	        $_SESSION['Holding_Firm_Name'] = $rowName['Name'];
	        
	        echo"</div>";
            echo"<br><br>";
	    }
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор Потреб. име</th>
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
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultFirm))
	    {
	        echo "<tr>";
	        echo "<td>" . $row['Legalentity_ID'] . "</td>";
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
</div>

<?php
	
	}
	
	mysqli_close($con);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataAuto == true) {
    
   $con = connectServer();
   $autoId = 0;
   $result = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
					  
	if (mysqli_num_rows($result) < 1) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}

	$Color = "red";
	
	//echo "<br><br>";
	if (mysqli_num_rows($result) > 0) {
	
	    echo"<div align = 'center'>";
	    
	    echo '<span style="font-size: 20px; color:black;">Данни на </span>'  . "  " .
	         '<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Holding_Firm_Name'] . '</span>';
	    echo '<br><br>';     
        echo '<span style="font-size: 20px; color:black;">Данни на МПС на юридическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2' style = 'width: 120%;'>
	   
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
	    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
	    <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
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
	    <th bgcolor='$color1'>$h2 Текущи км</th>
        <th bgcolor='$color1'>$h2 Дата текущи км</th>
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
	        <td style = "width: 80px;"><button onclick = "location.assign('mainAdminUpdateGeneralDataAuto.php')">Редакция</button></td>
	        
<?php	        
	        echo "<td>" . $row['AutosID'] . "</td>";
	        echo "<td>" . $row['Legalentity_ID'] . "</td>";
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
	
	if (mysqli_num_rows($resultInsurance) < 1) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за застраховки на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	
	echo "<br><br>";
	if (mysqli_num_rows($resultInsurance) > 0) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за застраховки на МПС на юридическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
        <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
        <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
        <th bgcolor='$color1'>$h2 ГТП дата</th>
        <th bgcolor='$color1'>$h2 ГТП уведомление</th>
        <th bgcolor='$color1'>$h2 ГТП сума</th>
        <th bgcolor='$color1'>$h2 ГО дата</th>
        <th bgcolor='$color1'>$h2 ГО уведомление</th>
        <th bgcolor='$color1'>$h2 ГО сума</th>
        <th bgcolor='$color1'>$h2 ГО плащане</th>
        <th bgcolor='$color1'>$h2 Каско дата</th>
        <th bgcolor='$color1'>$h2 Каско уведомление</th>
        <th bgcolor='$color1'>$h2 Каско сума</th>
        <th bgcolor='$color1'>$h2 Каско плащане</th>
        <th bgcolor='$color1'>$h2 Винетка дата</th>
        <th bgcolor='$color1'>$h2 Винетка уведомление</th>
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
	        <td style = "width: 80px;"><button onclick = "location.assign('mainAdminUpdateInsuranceDataAuto.php')">Редакция</button></td>
	        
<?php
            echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
            echo "<td style='color:black;'>" . $row['Legalentity_ID'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP_Email'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Email'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['GO_Payment'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Email'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Kasko_Payment'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka_Email'] . "</td>";
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
	
	if (mysqli_num_rows($resultService) < 1) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за сервиз на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultService) > 0) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за сервиз на МПС на юридическо лице </span>'; // . "  " .
	    //'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
        <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
        <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
        <th bgcolor='$color1'>$h2 Сервиз</th>
	    <th bgcolor='$color1'>$h2 Обслужване на</th>
        <th bgcolor='$color1'>$h2 Дата на обслужване</th>
        <th bgcolor='$color1'>$h2 Километри</th>
        <th bgcolor='$color1'>$h2 След километри</th>
        <th bgcolor='$color1'>$h2 След дата</th>
        <th bgcolor='$color1'>$h2 Сума лв</th>
        <th bgcolor='$color1'>$h2 Фактура №</th>
        <th bgcolor='$color1'>$h2 Масла и филтри уведомление</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultService))
	    {
	        echo "<tr>";
?>	        
	        <td style = "width: 80px;"><button onclick = "location.assign('mainAdminUpdateServiceDataAuto.php')">Редакция</button></td>
	        
<?php	        
            echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
            echo "<td style='color:black;'>" . $row['Legalentity_ID'] . "</td>";
            echo "<td style='color:black;'>" . $row['Service'] . "</td>"; 
	        echo "<td style='color:black;'>" . $row['Type'] . "</td>";
            echo "<td style='color:black;'>" . $row['Date_Of_Service'] . "</td>";
            echo "<td style='color:black;'>" . $row['Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['After_Km'] . "</td>";
            echo "<td style='color:black;'>" . $row['After_Date'] . "</td>";
            echo "<td style='color:black;'>" . $row['Sum'] . "</td>";
            echo "<td style='color:black;'>" . $row['Invoice'] . "</td>";
            echo "<td style='color:black;'>" . $row['Oils_Filters_Email'] . "</td>";
            echo "</tr>";
	    }
	    echo "</table>";
	
	}
	
	if (mysqli_num_rows($resultRepair) < 1) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за ремонт на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultRepair) > 0) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за ремонт на МПС на юридическо лице </span>'; // . "  " .
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
	        <td style = "width: 80px;"><button onclick = "location.assign('mainAdminUpdateRepairDataAuto.php')">Редакция</button></td>
	        
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
	
	if (mysqli_num_rows($resultTyres) < 1) {
		
		echo"<br><br>";
		echo"<div align = 'center'>";
		echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за гуми на МПС за това юридическо лице!</span>';// . " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		echo"</div>";
	
	}
	
	echo "<br><br>";
	if (mysqli_num_rows($resultTyres) > 0) {
	
	    echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Данни за гуми на МПС на юридическо лице </span>'; // . "  " .
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
	        <td style = "width: 80px;"><button onclick = "location.assign('mainAdminUpdateTyresDataAuto.php')">Редакция</button></td>
	        
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
 
<script>

document.getElementById('bUpdate').onclick = function() {
    var id = document.getElementById('pageN').value;
    var checkBox = false;
    if(id < 1)
        id = 1;
    id = (id*10) - 9;
    while (id) {
        if(document.getElementById(id).checked == true) {
            checkBox = true; 
            break;
        }
    id++;
    }
    
    if(document.getElementById('admin').value != "" && document.getElementById('subAdminValue1').value != "" && checkBox == true)
        return confirm('Сигурни ли сте,че искате да извършите прехвърляне на холдинг от един подадминистратор/потребител към друг?');
};

var checkedAll = false;

function checkAll() {
    if(!checkedAll) {
        $("form input:checkbox").prop('checked', true);
        checkedAll = true;
    }
    else {
        $("form input:checkbox").prop('checked', false);
        checkedAll = false;
    }
}

function checkInput(){
    var x, text;

    
    x = document.getElementById("numRec").value;

    if (isNaN(x)) {
        text = "Номер на данни е невалиден!";
		document.getElementById("demo").style.color = "white";
        document.getElementById("demo").innerHTML = text;
    } else {
        text = "ID:";
		document.getElementById("demo").style.color = "black";
		document.getElementById("demo").innerHTML = text;
    }
	
}

</script>


</div>		  
</body>		  
</html>