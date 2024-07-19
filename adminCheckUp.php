<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
header('Location: index.php');
}
include 'functions.php';
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
      $("#adminNav").load("adminNav.php"); 
    });
    
</script>

<style>
body {
    
}
table {
    width: 140%;
}

th, td {
    border: 1px solid black;
    text-align: center;
}

</style>
</head>
<body>  

<div id = "adminNav"></div>

<br>

<?php

$gtpDate = "GTP_Date";
$goDate = "GO_Date";
$kaskoDate = "Kasko_Date";
$vinetkaDate = "Vinetka_Date";
$oilsFiltersToDate = "After_Date";

?>

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

<div align = "left">

<h3 style = "margin-top: 7.0vw; margin-left: 4.0vw;">Справки:</h3>

<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 150px;">
Избери справка за:<br>    
	<select name="CheckUp"  required="required" style = "height: 27px;">*
    <option value="<?php echo $gtpDate; ?>">ГТП – изтичащи в следващия, зададен от вас, период</option>												
    <option value="<?php echo $goDate; ?>">ГО – изтичащи в следващия, зададен от вас, период</option>
    <option value="<?php echo $kaskoDate; ?>">Каско – изтичащи в следващия, зададен от вас, период</option>
    <option value="<?php echo $vinetkaDate; ?>">Винетки – изтичащи в следващия, зададен от вас, период</option>
    <option value="<?php echo $oilsFiltersToDate; ?>">Масла и филтри – за смяна в следващия, зададен от вас, период</option>
    </select>
    <br><br>
    От дата:<br><input type="Date" name="fromDate" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване">*
    <br><br>
    До дата:<br><input type="Date" name="toDate" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване">*
    <br><br>
	<input type="text" name="Admin_Username" value = "<?php echo $_SESSION['adminUsername']; ?>" style = "display: none;">
	Потребител<br>потребителско име:<br>
	<select style = "width: 174px; height: 27px;" name="Sub_Admin_Username">
	    <option value="">Избери потребител</option>
                <?php
                    $con = connectServer();
                    $query = "SELECT * FROM subadmin WHERE Admin_Username = '$_SESSION[adminUsername]'";
                    $results=mysqli_query($con, $query);
                    //loop
                    foreach ($results as $subAdmins){
                ?>
                        <option value="<?php echo $subAdmins['username'];?>"><?php echo $subAdmins['username'];?></option>
                <?php
                    }
                    mysqli_close($con);
                    
                ?>
    </select>            
    <br><br>
    <input type="submit" name="btnCheckUp" value="Направи справка" style = "border-radius: 2px; color: red;">  
	<br><br>
</form>
  <br><br>

<?php

$btnCheckUp = false;
if(isset($_POST["btnCheckUp"])) {
	$btnCheckUp = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnCheckUp == true) {

$con = connectServer();

$usernamesPairCheck = mysqli_query($con, "SELECT * FROM subadmin WHERE Admin_Username = '$_POST[Admin_Username]'
		                                  AND username = '$_POST[Sub_Admin_Username]'");

$usernamesInputError = false;

if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) > 0) {	
    
    if(mysqli_num_rows($usernamesPairCheck) < 1) {
               $usernamesInputError = true;
    		   $message = "Грешка! Несъответствие на йерархията подадминистратор потребител!";
       	       echo "<script>alert('$message');</script>";
    }
}

$checkUpType = $_POST['CheckUp'];
$fromDateService = $fromDate = $_POST['fromDate'];
$toDateService = $toDate = $_POST['toDate'];

$result = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'";
$resultAdminSubAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                              AND Admin_Username = '$_POST[Admin_Username]' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";
$resultAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                              AND Admin_Username = '$_POST[Admin_Username]'";
$resultSubAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                               AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";                            



$resultService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'";
$resultAdminSubAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                              AND Admin_Username = '$_POST[Admin_Username]' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";
$resultAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                              AND Admin_Username = '$_POST[Admin_Username]'";
$resultSubAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                               AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";


$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$dateB=date_create($fromDate);
//date_modify($dateB,"-1 year");
$dateE=date_create($toDate);
//date_modify($dateE,"-1 year");
date_format($dateB,"d/m/Y");
date_format($dateE,"d/m/Y");

echo "<div align = 'center'>";

$sqlResult = "";

if(strcmp($checkUpType, $gtpDate) == 0 || strcmp($checkUpType, $goDate) == 0 || strcmp($checkUpType, $kaskoDate) == 0 || strcmp($checkUpType, $vinetkaDate) == 0) {

    if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultData = mysqli_query($con, $result);
        $sqlResult = $resultData;
    }
        
    else if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultDataAdmin = mysqli_query($con, $resultAdmin);
        $sqlResult = $resultDataAdmin; 
    }
        
    else if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) > 0) { 
        $resultDataSubAdmin = mysqli_query($con, $resultSubAdmin);
        $sqlResult = $resultDataSubAdmin;
    }
    
    else {
        $resultDataAdminSubAdmin = mysqli_query($con, $resultAdminSubAdmin);
        $sqlResult = $resultDataAdminSubAdmin;
    }
    
    if(mysqli_num_rows($sqlResult) < 1 && !$usernamesInputError) {
        
        $message = "Няма данни по вашата справка!";
        echo "<script>alert('$message');</script>";
    }

}

if(strcmp($checkUpType, $oilsFiltersToDate) == 0) {

    if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultDataService = mysqli_query($con, $resultService);
        $sqlResult = $resultDataService;
    }
        
    else if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultDataAdminService = mysqli_query($con, $resultAdminService);
        $sqlResult = $resultDataAdminService; 
    }
        
    else if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) > 0) { 
        $resultDataSubAdminService = mysqli_query($con, $resultSubAdminService);
        $sqlResult = $resultDataSubAdminService;
    }
    
    else {
        $resultDataAdminSubAdminService = mysqli_query($con, $resultAdminSubAdminService);
        $sqlResult = $resultDataAdminSubAdminService;
    }
    
    if(mysqli_num_rows($sqlResult) < 1 && !$usernamesInputError) {
        
        $message = "Няма данни по вашата справка!";
              echo "<script>alert('$message');</script>";
    }

}

switch($checkUpType)
{
    case $gtpDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи ГТП на МПС от дата </span>' . " " .
                        '<span style="font-size: 16px; color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                        '<span style="font-size: 16px; color:black; ">до дата </span>' . " " .
                        '<span style="font-size: 16px; color:black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                        
                        
                        if(mysqli_num_rows($sqlResult) > 0) {
       	                    
                            echo "<br><br><br>";
                            echo "<table border='2' id = 't1'>
                            <tr>
                            <th bgcolor='$color1'>$h2 ID/№</th>
                            <th bgcolor='$color1'>$h2 МПС ID/№</th>
                            <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                            <th bgcolor='$color1'>$h2 ГТП дата</th>
                            <th bgcolor='$color1'>$h2 ГТП сума</th>
                            <th bgcolor='$color1'>$h2 Име</th>
                            <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                            <th bgcolor='$color1'>$h2 ДДС номер</th>
                            <th bgcolor='$color1'>$h2 Адрес</th>
                            <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                            <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                            <th bgcolor='$color1'>$h2 Телефон</th>
                            <th bgcolor='$color1'>$h2 Имейл</th>
                            <th bgcolor='$color1'>$h2 Лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                            </tr>";
                        }
                        
                        while($row = mysqli_fetch_array($sqlResult))
                          {
                            $gtpDate=date_create($row['GTP_Date']);
                            
                            echo "<tr>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Insurance_ID'] . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['AutosID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Legalentity_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>"; 
                            echo "<td style = 'border: 1px solid black;'>" . date_format($gtpDate,"d-m-Y") . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['GTP_Sum'] . "</td>";
                        
                        
                            if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                            {
                               $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                               
                               if (mysqli_num_rows($resultPerson) > 0)
                               {
                        	        
                        	        while($row1 = mysqli_fetch_array($resultPerson))
                        	        {
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Names'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['EGN'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address_MPS'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone_Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                        	            echo "</tr>";
                        	        }
                        	        
                                 }
                              }
                              else
                              {
                                   $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                   if (mysqli_num_rows($resultFirm) > 0)
                                   {
                               
                        	            while($row2 = mysqli_fetch_array($resultFirm))
                        	            {
                        	                echo "<td>" . $row2['Name'] . "</td>";
                        	                echo "<td>" . $row2['EIK'] . "</td>";
                        	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                        	                echo "<td>" . $row2['Address'] . "</td>";
                        	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                        	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                        	                echo "<td>" . $row2['Telephone'] . "</td>";
                        	                echo "<td>" . $row2['Email'] . "</td>";
                        	                echo "<td>" . $row2['Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Email_Contact_Person'] . "</td>";
                        	                echo "</tr>";
                        	            }
                        	   
                                   }
                              }
                               
                           }
                          
                        
                        echo "</table>";
                        echo "<br><br>";
                        if(mysqli_num_rows($sqlResult) > 0)
                            echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                        echo "<br><br>";
                    break;
                        
    case $goDate: echo '<span style="font-size: 16px;  color:black; ">Справка за изтичащи ГО на МПС от дата </span>' . " " .
                        '<span style="font-size: 16px; color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                        '<span style="font-size: 16px; color:black; ">до дата </span>' . " " .
                        '<span style="font-size: 16px; color:black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                        
                        
                        if(mysqli_num_rows($sqlResult) > 0) {
                            
                            echo "<br><br><br>";
                            echo "<table border='2' id = 't1'>
                            <tr>
                            <th bgcolor='$color1'>$h2 ID/№</th>
                            <th bgcolor='$color1'>$h2 МПС ID/№</th>
                            <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                            <th bgcolor='$color1'>$h2 ГО дата</th>
                            <th bgcolor='$color1'>$h2 ГО сума</th>
                            <th bgcolor='$color1'>$h2 ГО плащане</th>
                            <th bgcolor='$color1'>$h2 Име</th>
                            <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                            <th bgcolor='$color1'>$h2 ДДС номер</th>
                            <th bgcolor='$color1'>$h2 Адрес</th>
                            <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                            <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                            <th bgcolor='$color1'>$h2 Телефон</th>
                            <th bgcolor='$color1'>$h2 Имейл</th>
                            <th bgcolor='$color1'>$h2 Лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                            </tr>";
                        }
                        
                        while($row = mysqli_fetch_array($sqlResult))
                          {
                            $goDate=date_create($row['GO_Date']);
                            
                            echo "<tr>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Insurance_ID'] . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['AutosID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Legalentity_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>"; 
                            echo "<td style = 'border: 1px solid black;'>" . date_format($goDate,"d/m/Y") . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['GO_Sum'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['GO_Payment'] . "</td>";
                        
                            if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                            {
                               $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                               
                               if (mysqli_num_rows($resultPerson) > 0)
                               {
                        	        
                        	        while($row1 = mysqli_fetch_array($resultPerson))
                        	        {
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Names'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['EGN'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address_MPS'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone_Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                        	            echo "</tr>";
                        	        }
                        	        
                                 }
                              }
                              else
                              {
                                   $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                   if (mysqli_num_rows($resultFirm) > 0)
                                   {
                               
                        	            while($row2 = mysqli_fetch_array($resultFirm))
                        	            {
                        	                echo "<td>" . $row2['Name'] . "</td>";
                        	                echo "<td>" . $row2['EIK'] . "</td>";
                        	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                        	                echo "<td>" . $row2['Address'] . "</td>";
                        	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                        	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                        	                echo "<td>" . $row2['Telephone'] . "</td>";
                        	                echo "<td>" . $row2['Email'] . "</td>";
                        	                echo "<td>" . $row2['Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Email_Contact_Person'] . "</td>";
                        	                echo "</tr>";
                        	            }
                        	   
                                   }
                              }
                               
                           }
                          
                        
                        echo "</table>";
                        
                        echo "<br><br>";
                        if(mysqli_num_rows($sqlResult) > 0) 
                            echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                        echo "<br><br>";
                        
                    break;
     
    case $kaskoDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи КАСКО на МПС от дата </span>' . " " .
                        '<span style="font-size: 16px;   color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                        '<span style="font-size: 16px;   color:black; ">до дата </span>' . " " .
                        '<span style="font-size: 16px;   color:black; ">' . date_format($dateE,"d-m-Y") . '</span>'; 
                        
                        if(mysqli_num_rows($sqlResult) > 0) {
                            
                            echo "<br><br><br>";
                            echo "<table border='2' id = 't1'>
                            <tr>
                            <th bgcolor='$color1'>$h2 ID/№</th>
                            <th bgcolor='$color1'>$h2 МПС ID/№</th>
                            <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Каско дата</th>
                            <th bgcolor='$color1'>$h2 Каско сума</th>
                            <th bgcolor='$color1'>$h2 Каско плащане</th>
                            <th bgcolor='$color1'>$h2 Име</th>
                            <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                            <th bgcolor='$color1'>$h2 ДДС номер</th>
                            <th bgcolor='$color1'>$h2 Адрес</th>
                            <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                            <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                            <th bgcolor='$color1'>$h2 Телефон</th>
                            <th bgcolor='$color1'>$h2 Имейл</th>
                            <th bgcolor='$color1'>$h2 Лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                            </tr>";
                        }
                        
                        while($row = mysqli_fetch_array($sqlResult))
                          {
                            $kaskoDate=date_create($row['Kasko_Date']);

                            echo "<tr>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Insurance_ID'] . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['AutosID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Legalentity_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>"; 
                            echo "<td style = 'border: 1px solid black;'>" . date_format($kaskoDate,"d/m/Y") . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['Kasko_Sum'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Kasko_Payment'] . "</td>";
                        
                            if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                            {
                               $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                               
                               if (mysqli_num_rows($resultPerson) > 0)
                               {
                        	        
                        	        while($row1 = mysqli_fetch_array($resultPerson))
                        	        {
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Names'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['EGN'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address_MPS'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone_Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                        	            echo "</tr>";
                        	        }
                        	        
                                 }
                              }
                              else
                              {
                                   $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                   if (mysqli_num_rows($resultFirm) > 0)
                                   {
                               
                        	            while($row2 = mysqli_fetch_array($resultFirm))
                        	            {
                        	                echo "<td>" . $row2['Name'] . "</td>";
                        	                echo "<td>" . $row2['EIK'] . "</td>";
                        	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                        	                echo "<td>" . $row2['Address'] . "</td>";
                        	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                        	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                        	                echo "<td>" . $row2['Telephone'] . "</td>";
                        	                echo "<td>" . $row2['Email'] . "</td>";
                        	                echo "<td>" . $row2['Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Email_Contact_Person'] . "</td>";
                        	                echo "</tr>";
                        	            }
                        	   
                                   }
                              }
                               
                           }
                          
                        
                        echo "</table>";
                        
                        echo "<br><br>";
                        if(mysqli_num_rows($sqlResult) > 0) 
                            echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                        echo "<br><br>";
                        
                    break;
    
    case $vinetkaDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи Винетки на МПС от дата </span>' . " " .
                        '<span style="font-size: 16px;     color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                        '<span style="font-size: 16px;     color:black; ">до дата </span>' . " " .
                        '<span style="font-size: 16px;     color:black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                        
                        if(mysqli_num_rows($sqlResult) > 0) {
                            
                            echo "<br><br><br>";
                            echo "<table border='2' id = 't1'>
                            <tr>
                            <th bgcolor='$color1'>$h2 ID/№</th>
                            <th bgcolor='$color1'>$h2 МПС ID/№</th>
                            <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Винетка дата</th>
                            <th bgcolor='$color1'>$h2 Винетка сума</th>
                            <th bgcolor='$color1'>$h2 Винетка тип</th>
                            <th bgcolor='$color1'>$h2 Име</th>
                            <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                            <th bgcolor='$color1'>$h2 ДДС номер</th>
                            <th bgcolor='$color1'>$h2 Адрес</th>
                            <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                            <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                            <th bgcolor='$color1'>$h2 Телефон</th>
                            <th bgcolor='$color1'>$h2 Имейл</th>
                            <th bgcolor='$color1'>$h2 Лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                            </tr>";
                        }
                        
                        while($row = mysqli_fetch_array($sqlResult))
                          {
                            $vinetkaDate=date_create($row['Vinetka_Date']);

                            echo "<tr>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Insurance_ID'] . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['AutosID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Legalentity_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>"; 
                            echo "<td style = 'border: 1px solid black;'>" . date_format($vinetkaDate,"d/m/Y") . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['Vinetka_Sum'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Vinetka_Type'] . "</td>";
                        
                            if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                            {
                               $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                               
                               if (mysqli_num_rows($resultPerson) > 0)
                               {
                        	        
                        	        while($row1 = mysqli_fetch_array($resultPerson))
                        	        {
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Names'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['EGN'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address_MPS'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone_Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                        	            echo "</tr>";
                        	        }
                        	        
                                 }
                              }
                              else
                              {
                                   $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                   if (mysqli_num_rows($resultFirm) > 0)
                                   {
                               
                        	            while($row2 = mysqli_fetch_array($resultFirm))
                        	            {
                        	                echo "<td>" . $row2['Name'] . "</td>";
                        	                echo "<td>" . $row2['EIK'] . "</td>";
                        	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                        	                echo "<td>" . $row2['Address'] . "</td>";
                        	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                        	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                        	                echo "<td>" . $row2['Telephone'] . "</td>";
                        	                echo "<td>" . $row2['Email'] . "</td>";
                        	                echo "<td>" . $row2['Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                        	                echo "<td>" . $row2['Email_Contact_Person'] . "</td>";
                        	                echo "</tr>";
                        	            }
                        	   
                                   }
                              }
                               
                           }
                          
                        
                        echo "</table>";
                        
                        echo "<br><br>";
                        if(mysqli_num_rows($sqlResult) > 0) 
                            echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                        echo "<br><br>";
                        
                    break;
                        
    case $oilsFiltersToDate: echo '<span style="font-size: 16px; color:black; ">Справка за смяна на масла и филтри на МПС от дата </span>' . " " .
                                  '<span style="font-size: 16px; color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                                  '<span style="font-size: 16px; color:black; ">до дата </span>' . " " .
                                  '<span style="font-size: 16px; color:black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                        
                        
                        if(mysqli_num_rows($sqlResult) > 0) {
       	                    
                            echo "<br><br><br>";
                            echo "<table border='2' id = 't1'>
                            <tr>
                            <th bgcolor='$color1'>$h2 ID/№</th>
                            <th bgcolor='$color1'>$h2 МПС ID/№</th>
                            <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                            <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                            <th bgcolor='$color1'>$h2 Сервиз</th>
                            <th bgcolor='$color1'>$h2 Смяна на</th>
                            <th bgcolor='$color1'>$h2 Дата на смяна</th>
                            <th bgcolor='$color1'>$h2 Масла и филтри км</th>
                            <th bgcolor='$color1'>$h2 Масла и филтри след км</th>
                            <th bgcolor='$color1'>$h2 Масла и филтри след дата</th>
                            <th bgcolor='$color1'>$h2 Сума лв</th>
                            <th bgcolor='$color1'>$h2 Фактура</th>
                            <th bgcolor='$color1'>$h2 Име</th>
                            <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                            <th bgcolor='$color1'>$h2 ДДС номер</th>
                            <th bgcolor='$color1'>$h2 Адрес</th>
                            <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                            <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                            <th bgcolor='$color1'>$h2 Телефон</th>
                            <th bgcolor='$color1'>$h2 Имейл</th>
                            <th bgcolor='$color1'>$h2 Лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                            <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                            </tr>";
                        }
                        
                        while($row = mysqli_fetch_array($sqlResult))
                          {
                            $ofDate=date_create($row['Oils_Filters_Date']);
                            $oftDate=date_create($row['Oils_Filters_To_Date']);
                            
                            echo "<tr>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Insurance_ID'] . "</td>";	
                            echo "<td style = 'border: 1px solid black;'>" . $row['AutosID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Legalentity_ID'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Service'] . "</td>";
                            //echo "<td style = 'border: 1px solid black;'>" . date_format($ofDate,"d-m-Y") . "</td>";
                            //echo "<td style = 'border: 1px solid black;'>" . date_format($oftDate,"d-m-Y") . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Type'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Date_Of_Service'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Km'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['After_Km'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['After_Date'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Sum'] . "</td>";
                            echo "<td style = 'border: 1px solid black;'>" . $row['Invoice'] . "</td>";
                        
                        
                            if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                            {
                               $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                               
                               if (mysqli_num_rows($resultPerson) > 0)
                               {
                        	        
                        	        while($row1 = mysqli_fetch_array($resultPerson))
                        	        {
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Names'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['EGN'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Address_MPS'] . "</td>";
                        	            echo "<td>" . "" . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Telephone_Contact_Person'] . "</td>";
                        	            echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                        	            echo "</tr>";
                        	        }
                        	        
                                 }
                              }
                              else
                              {
                                   $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                   if (mysqli_num_rows($resultFirm) > 0)
                                   {
                               
                        	            while($row2 = mysqli_fetch_array($resultFirm))
                        	            {
                        	                echo "<td'>" . $row2['Name'] . "</td>";
                        	                echo "<td'>" . $row2['EIK'] . "</td>";
                        	                echo "<td'>" . $row2['DDS_Nomer'] . "</td>";
                        	                echo "<td'>" . $row2['Address'] . "</td>";
                        	                echo "<td'>" . $row2['Address_MPS'] . "</td>";
                        	                echo "<td'>" . $row2['MOL_Names'] . "</td>";
                        	                echo "<td'>" . $row2['Telephone'] . "</td>";
                        	                echo "<td'>" . $row2['Email'] . "</td>";
                        	                echo "<td'>" . $row2['Contact_Person'] . "</td>";
                        	                echo "<td'>" . $row2['Telephone_Contact_Person'] . "</td>";
                        	                echo "<td'>" . $row2['Email_Contact_Person'] . "</td>";
                        	                echo "</tr>";
                        	            }
                        	   
                                   }
                              }
                               
                           }
                          
                        
                        echo "</table>";
                        echo "<br><br>";
                        if(mysqli_num_rows($sqlResult) > 0)
                            echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                        echo "<br><br>";
                    break;
                    
}

echo "</div>";

echo "<br><br>";


mysqli_close($con);

}


?>


<script>

function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('t1'); // id of table

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


</script> 
  
</div>  
</body>
</html>