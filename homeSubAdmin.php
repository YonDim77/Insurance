<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['subAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="adminCss.css">

<script>//sessionStorage.setItem("scroll", "0");
        //sessionStorage.getItem("y") = 0;
//		sessionStorage.setItem("counter", "0"); 
		
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script> 

    $(function(){
      $("#subAdminNav").load("subAdminNav.php"); 
    });
    
</script>

<style>
body {
	
}

table {
    width: 140%;
}

table, th, td {
    color: black;
    text-align: center;
}


.tooltips {
  position: relative;
  display: inline-block;
}

.tooltips .tooltiptext {
  visibility: hidden;
  white-space: nowrap;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 7px;

  /* Position the tooltip */
  position: absolute;
  display: block;
  z-index: 1;
  top: 0px;
  right: 105%;
}

.tooltips .tooltiptext::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 100%;
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent transparent black;
}

.tooltips:hover .tooltiptext {
  visibility: visible;
}


</style>

</head>
<body>

<div id = "subAdminNav"></div>

<br>

<?php

$gtpDate = "GTP_Date";
$goDate = "GO_Date";
$kaskoDate = "Kasko_Date";
$vinetkaDate = "Vinetka_Date";
$oilsFiltersToDate = "After_Date";

?>

<script>

/*
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
*/

</script>

 <br><br><br><br><br>
<div align = "center">

    <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; font-size: 14px;">
    	<h4>Справка за следващите 14 дни за изтичащи:</h4><br>
    	<select name="CheckUp"  style = "width:174px; height: 27px;" required="required">*
    	<option value="<?php echo $_POST["CheckUp"]; ?>">Избери</option>
        <option value="<?php echo $gtpDate; ?>">ГТП </option>												
        <option value="<?php echo $goDate; ?>">ГО </option>
        <option value="<?php echo $kaskoDate; ?>">Каско </option>
        <option value="<?php echo $vinetkaDate; ?>">Винетки </option>
        <option value="<?php echo $oilsFiltersToDate; ?>">Масла и филтри</option>
        </select>
        <br><br>
        
        
        <br>
        <input type="submit" name="btnCheckUp" value="Направи справка" style = "border-radius: 2px; color: red;">  
    	<br><br>
    <!--</form>-->
<br><br>

</div>

<?php

$btnCheckUp = false;
if(isset($_POST["btnCheckUp"])) {
	$btnCheckUp = true;
}

//if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnCheckUp == true) {
if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST["CheckUp"]) > 0) {

include 'functions.php';

$con = connectServer();

$noData = false;
//$usernamesPairCheck = mysqli_query($con, "SELECT * FROM subadmin WHERE Admin_Username = '$_POST[Admin_Username]'
//		                                          AND username = '$_POST[Sub_Admin_Username]'");

$usernamesInputError = false;

//if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) > 0) {	
//    
//    if(mysqli_num_rows($usernamesPairCheck) < 1) {
//               $usernamesInputError = true;
//    		   $message = "Грешка! Несъответствие на йерархията подадминистратор потребител!";
//       	       echo "<script>alert('$message');</script>";
//    }
//}

date_default_timezone_set('Bulgaria/Sofia');
$currentDate = date('Y-m-d', time());
$toDate=Date('y:m:d', strtotime("+500 days"));
//date_add($toDate,date_interval_create_from_date_string("14 days"));

$checkUpType = $_POST['CheckUp'];
$fromDateService = $fromDate = $currentDate;
$toDateService = $toDate;

//$result = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'";
//$resultAdminSubAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
//                              AND Admin_Username = '$_POST[Admin_Username]' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";
//$resultAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
//                              AND Admin_Username = '$_POST[Admin_Username]'";

$resultSubAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                               AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'";                            



//$resultService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'";
//$resultAdminSubAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
//                              AND Admin_Username = '$_POST[Admin_Username]' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";
//$resultAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
//                              AND Admin_Username = '$_POST[Admin_Username]'";

$resultSubAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                               AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'";
                               
$afterKmSubAdminService = "SELECT service.* FROM service
				                LEFT JOIN autos ON (service.AutosID = autos.AutosID)
				                WHERE service.Type = 'масла и филтри'
				                AND service.After_Km <= autos.Current_Km 				   
                                AND service.Sub_Admin_Username = '$_SESSION[subAdminUsername]'";


$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$dateB=date_create($fromDate);
$dateE=date_create($fromDate);
date_add($dateE,date_interval_create_from_date_string("14 days"));

date_format($dateB,"d/m/Y");
date_format($dateE,"d/m/Y");

echo "<div align = 'center'>";

$sqlResult = "";

if(strcmp($checkUpType, $gtpDate) == 0 || strcmp($checkUpType, $goDate) == 0 || strcmp($checkUpType, $kaskoDate) == 0 || strcmp($checkUpType, $vinetkaDate) == 0) {

    //if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
    //    $resultData = mysqli_query($con, $result);
    //    $sqlResult = $resultData;
    //}
        
    //if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
    //    $resultDataAdmin = mysqli_query($con, $resultAdmin);
    //    $sqlResult = $resultDataAdmin; 
    //}
        
    //else if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) > 0) { 
    //    $resultDataSubAdmin = mysqli_query($con, $resultSubAdmin);
    //    $sqlResult = $resultDataSubAdmin;
    //}
    
    //else {
        $resultDataSubAdmin = mysqli_query($con, $resultSubAdmin);
        $sqlResult = $resultDataSubAdmin;
    //}
    
    if(mysqli_num_rows($sqlResult) < 1 && !$usernamesInputError) {
        
        $noData = true;
        $message = "Няма данни по вашата справка!";
              echo "<script>alert('$message');</script>";
    }

}

if(strcmp($checkUpType, $oilsFiltersToDate) == 0) {

    //if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
    //    $resultDataService = mysqli_query($con, $resultService);
    //    $sqlResult = $resultDataService;
    //}
        
    //if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
    //    $resultDataAdminService = mysqli_query($con, $resultAdminService);
    //    $sqlResult = $resultDataAdminService; 
    //}
        
    //else if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) > 0) { 
    //    $resultDataSubAdminService = mysqli_query($con, $resultSubAdminService);
    //    $sqlResult = $resultDataSubAdminService;
    //}
    
    //else {
        $resultDataSubAdminService = mysqli_query($con, $resultSubAdminService);
        $sqlResultKm = mysqli_query($con, $afterKmSubAdminService);
        $sqlResult = $resultDataSubAdminService;
    //}
    
    if(mysqli_num_rows($sqlResult) < 1 && !$usernamesInputError) {
        
        $noData = true;
        $message = "Няма данни по вашата справка!";
              echo "<script>alert('$message');</script>";
    }

}


$index = 1;

$btnSendEmail = false;
$typeEmail = "";

    if(!$noData) {
        
    
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
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
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
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    $gtpDate=date_create($row['GTP_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    //echo "<td>" . $row['Admin_Username'] . "</td>";
                                    //echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }
                                    //echo "<td>" . date_format($gtpDate,"d-m-Y") . "</td>";
                                    echo "<td>" . date_format($gtpDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($gtpDate,"d/m/Y") . '" name = "GTP_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['GTP_Sum'] . "</td>";
                                
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT GTP_Email FROM insurance WHERE GTP_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
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
                                	                //echo "<td style = 'color: black'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT GTP_Email FROM insurance WHERE GTP_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $gtpDateValue = $_POST['GTP_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "GTP_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0)
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                            break;
                                
            case $goDate: echo '<span style="font-size: 16px;  black; ">Справка за изтичащи ГО на МПС от дата </span>' . " " .
                                '<span style="font-size: 16px; black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                                '<span style="font-size: 16px; black; ">до дата </span>' . " " .
                                '<span style="font-size: 16px; black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                                
                                
                                if(mysqli_num_rows($sqlResult) > 0) {
                                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't1'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
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
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    $goDate=date_create($row['GO_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");                   
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    //echo "<td>" . $row['Admin_Username'] . "</td>";
                                    //echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($goDate,"d/m/Y") . "</td>";
                                    echo "<td>" . date_format($goDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($goDate,"d/m/Y") . '" name = "GO_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['GO_Sum'] . "</td>";
                                    echo "<td>" . $row['GO_Payment'] . "</td>";
                        
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT GO_Email FROM insurance WHERE GO_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
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
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT GO_Email FROM insurance WHERE GO_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $goDateValue = $_POST['GO_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "GO_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0) 
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
             
            case $kaskoDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи КАСКО на МПС от дата </span>' . " " .
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
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
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
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    $kaskoDate=date_create($row['Kasko_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");
        
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    //echo "<td>" . $row['Admin_Username'] . "</td>";
                                    //echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($kaskoDate,"d/m/Y") . "</td>";
                                    echo "<td>" . date_format($kaskoDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($kaskoDate,"d/m/Y") . '" name = "Kasko_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Kasko_Sum'] . "</td>";
                                    echo "<td>" . $row['Kasko_Payment'] . "</td>";
                        
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Kasko_Email FROM insurance WHERE Kasko_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
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
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Kasko_Email FROM insurance WHERE Kasko_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	                }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $kaskoDateValue = $_POST['Kasko_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Kasko_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0) 
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
            
            case $vinetkaDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи Винетки на МПС от дата </span>' . " " .
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
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
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
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    $vinetkaDate=date_create($row['Vinetka_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");
        
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    //echo "<td>" . $row['Admin_Username'] . "</td>";
                                    //echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($vinetkaDate,"d/m/Y") . "</td>";
                                    echo "<td>" . date_format($vinetkaDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($vinetkaDate,"d/m/Y") . '" name = "Vinetka_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Vinetka_Sum'] . "</td>";
                                    echo "<td>" . $row['Vinetka_Type'] . "</td>";
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Vinetka_Email FROM insurance WHERE Vinetka_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
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
                                	                echo "<td style = 'color: black;'>" . $row2['Name'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['EIK'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Email'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Vinetka_Email FROM insurance WHERE Vinetka_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	                }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $vinetkaDateValue = $_POST['Vinetka_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Vinetka_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0) 
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
                                
            case $oilsFiltersToDate: echo '<span style="font-size: 16px;">Справка за смяна на масла и филтри на МПС от дата </span>' . " " .
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
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 Текущи км</th>
                                    <th bgcolor='$color1'>$h2 Сервиз</th>
                                    <th bgcolor='$color1'>$h2 Смяна на</th>
                                    <th bgcolor='$color1'>$h2 Дата на смяна</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след дата</th>
                                    <th bgcolor='$color1'>$h2 Сума</th>
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
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    //$ofDate=date_create($row['Oils_Filters_Date']);
                                    //$oftDate=date_create($row['Oils_Filters_To_Date']);
                                    $afterDate = date_create($row['After_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number, Current_Km FROM autos WHERE AutosID = '$row[AutosID]'");
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    //echo "<td>" . $row['Admin_Username'] . "</td>";
                                    //echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                        echo "<td>" . $rowRegNumber['Current_Km'] . "</td>";
                                    }
                                    echo "<td>" . $row['Service'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($ofDate,"d-m-Y") . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($oftDate,"d-m-Y") . "</td>";
                                    echo "<td>" . $row['Type'] . "</td>";
                                    echo "<td>" . $row['Date_Of_Service'] . "</td>";
                                    echo "<td>" . $row['Km'] . "</td>";
                                    echo "<td>" . $row['After_Km'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . $row['After_Date'] . "</td>";
                                    echo "<td>" . date_format($afterDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($afterDate,"d/m/Y") . '" name = "Oils_Filters_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Sum'] . "</td>";
                                    echo "<td>" . $row['Invoice'] . "</td>";
                                
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
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
                                	                echo "<td style = 'color: black;'>" . $row2['Name'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['EIK'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Email'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	                }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $afterDateValue = $_POST['Oils_Filters_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Oils_Filters_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0)
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                                
                                echo"<br><br>";
                                echo '<span style="font-size: 16px; color:black; ">Справка за смяна на масла и филтри на МПС при изминати километри:</span>'; 
                                echo"<br><br>";
                                
                                if(mysqli_num_rows($sqlResultKm) > 0) {
               	                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't2'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 Текущи км</th>
                                    <th bgcolor='$color1'>$h2 Сервиз</th>
                                    <th bgcolor='$color1'>$h2 Смяна на</th>
                                    <th bgcolor='$color1'>$h2 Дата на смяна</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след дата</th>
                                    <th bgcolor='$color1'>$h2 Сума</th>
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
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResultKm))
                                
                                {
                                    //$ofDate=date_create($row['Oils_Filters_Date']);
                                    //$oftDate=date_create($row['Oils_Filters_To_Date']);
                                    $afterDate = date_create($row['After_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number, Current_Km FROM autos WHERE AutosID = '$row[AutosID]'");
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Service_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    echo "<td>" . $row['Admin_Username'] . "</td>";
                                    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                        echo "<td>" . $rowRegNumber['Current_Km'] . "</td>";
                                    }
                                    echo "<td>" . $row['Service'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($ofDate,"d-m-Y") . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($oftDate,"d-m-Y") . "</td>";
                                    echo "<td>" . $row['Type'] . "</td>";
                                    echo "<td>" . $row['Date_Of_Service'] . "</td>";
                                    echo "<td>" . $row['Km'] . "</td>";
                                    echo "<td>" . $row['After_Km'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . $row['After_Date'] . "</td>";
                                    echo "<td>" . date_format($afterDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($afterDate,"d/m/Y") . '" name = "Oils_Filters_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Sum'] . "</td>";
                                    echo "<td>" . $row['Invoice'] . "</td>";
                                
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
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
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $afterDateValue = $_POST['Oils_Filters_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Oils_Filters_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                echo "</table>";
                                
                                echo "<br><br>";
                                
                                if(mysqli_num_rows($sqlResultKm) > 0)
                                    echo '<button id="btnExport2" onclick="fnExcelReport2();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
                            
        }
    }
    
echo "</div>";

echo "<br><br>";


mysqli_close($con);

}

    $subject = "";
    $comment = "";
    
    switch($checkUpType)
        {
            case "GTP_Date": $subject = "Напомняне за изтичащ Годишен технически преглед";
                           //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                           //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                           //Текст на имейла: 
                            $comment = "Здравейте " . $contactPerson . ",
                           
                           Напомняме Ви, че срокът на годишния технически преглед на автомобил " . $regNumberValue . " изтича. Молим за вашето внимание, за да организираме преминаването му преди " . $gtpDateValue . " . 
                           Екипът ни Ви напомня, че необходимите Ви документи са:
                           
                               - Голям и малък регистрационен талон;
                               - Квитанция за платен данък;
                               - Валидна гражданска отговорност;
                               - Шофьорска книжка;
                               - Талон от предишния ви преглед.
                               
                           Автомобилът трябва да е в добро техническо и външно състояние.
                           Ние можем да организираме всичко това вместо Вас. За целта следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                           
                           Благодарим Ви, че сте наш лоялен клиент!
                           
                           
                           Поздрави,
                           Екипът на CarLife";
                           
                           break;
            
            case "GO_Date": $subject = "Напомняне за изтичащa Гражданска отговорност";
                           //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                           //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                           //Текст на имейла: 
                           $comment = "Здравейте " . $contactPerson . ",
                           
                           Напомняме Ви, че срокът на Гражданска отговорност на автомобил " . $regNumberValue . " изтича. Молим за Вашето внимание, за да организираме подновяването и преди " . $goDateValue . ". 
                           Екипът ни Ви напомня, че необходимите Ви документи са:
                           
                           -   Голям регистрационен талон
                               
                           За да подновим полицата ви и да получите най-добрите 3 оферти на пазара, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                           
                           Благодарим Ви, че сте наш лоялен клиент!
                           
                           
                           Поздрави,
                           Екипът на CarLife"; 
                           
                           break;
                           
            case "Kasko_Date": $subject = "Напомняне за изтичащa застраховка Каско";
                               //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                               //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                               //Текст на имейла: 
                               $comment = "Здравейте " . $contactPerson . ",
                               
                               Напомняме Ви, че срокът на застраховката Каско на автомобил " . $regNumberValue . " изтича. Молим за Вашето внимание, за да организираме подновяването и преди " . $kaskoDateValue . ".
                               Екипът ни Ви напомня, че необходимите ви документи са:
                               
                               - Голям регистрационен талон
                               
                               За да подновим полицата Ви и да получите най-добрите 3 оферти на пазара, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                               
                               Благодарим Ви, че сте наш лоялен клиент!
                               
                               
                               Поздрави,
                               Екипът на CarLife";
                               
                               break;
                               
            case "Vinetka_Date": $subject = "Напомняне за изтичащa Винетка";
                                 //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                                 //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                                 //Текст на имейла: 
                                 $comment = "Здравейте " . $contactPerson . ",
                                 
                                 Напомняме Ви, че срокът на вашата Винетка на автомобил " . $regNumberValue . " изтича. Молим за Вашето внимание, за да организираме подновяването и преди " . $vinetkaDateValue . ".
                                 
                                 За да подновим Винетката Ви, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                                 Ако управлявате автомобила си с weekend, седмична или месечна винетка, моля да имате впредвид, че след " . $vinetkaDateValue . ", не можете да управлявате автомобил " . $regNumberValue . " по националната пътна мрежа на Република България и подлежите на санкциониране.
                                 
                                 Благодарим Ви, че сте наш лоялен клиент!
                                 
                                 
                                 Поздрави,
                                 Екипът на CarLife";
                                 
                                 break;
                                     
            case "After_Date": $subject = "Напомняне за изтичащо техническо обслужване за масла и филтри";
                               //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                               //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                               //Текст на имейла: 
                               $comment = "Здравейте " . $contactPerson . ",
                               
                               Напомняме Ви, че срокът на техническо обслужване за масла и филтри на автомобил " . $regNumberValue . " изтича. 
                               Молим за Вашето внимание, за да организираме обслужването преди " . $afterDateValue . ", за да спазим условията на гаранцията на автомобила.
                               Екипът ни Ви напомня, че необходимите Ви документи са:
                               
                               - Голям или малък регистрационен талон
                               
                               За да извършим техническото обслужване за масла, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                               
                               Благодарим Ви, че сте наш лоялен клиент!
                               
                               
                               Поздрави,
                               Екипът на CarLife";
                               
                               break;
            
            //default : echo "<script>alert('$gtpDate');</script>"; break;
                
        }
    
    

    
    $emailErr = "";
    $mainAdminEmail = "";
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
      return $data;
	}
    
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $subAdminEmail = $_SESSION['subAdminUsername']; 

	}
   
    mb_internal_encoding('UTF-8');
    $encoded_subject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n", strlen('Subject: '));
  
    if ($_SERVER["REQUEST_METHOD"] == "POST"  && $btnSendEmail && strlen($emailContactPerson) > 0 && strlen($subject) > 0 && strlen($comment) > 0) {
        if (!filter_var($emailContactPerson, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Невалиден имейл адрес на лице за контакти!";
              echo "<script>alert('$emailErr');</script>";
        }
	    else {  
	      $success = mail($emailContactPerson, $encoded_subject, $comment, "MIME-Version: 1.0" . "\r\n" . "Content-type: text/plain; charset=UTF-8" . "\r\n". "From:" . $subAdminEmail);
	      if (!$success) {
            $errorMessage = "Неуспешно изпращане на имейл!";
            echo "<script>alert('$errorMessage');</script>";
          }
          else {
             $message = "Имейла е изпратен успешно!";
             echo "<script>alert('$message');</script>"; 
             
             $con = connectServer();
                
             if(strcmp($typeEmail, "Oils_Filters_Email") == 0)
                 $emailSent ="UPDATE service SET $typeEmail = 'изпратено' Where AutosID = $mpsID AND Type = 'масла и филтри'";
             else
                 $emailSent ="UPDATE insurance SET $typeEmail = 'изпратено' Where AutosID = $mpsID";
                 
             if (mysqli_query($con, $emailSent) && mysqli_affected_rows($con) == 0) {
                 $message = "Моля изпратете имейла отново!";
                 echo "<script>alert('$message');</script>";    
             }
             //echo "<script>location.reload();</script>"; 
             echo "<script> location.replace('homeSubAdmin.php'); </script>";
             
          }
        }
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSendEmail && (strlen($emailContactPerson) == 0 || strlen($subject) == 0 || strlen($comment) == 0)) {
        $errorMessage = "Неуспешно изпращане на имейл!";
        echo "<script>alert('$errorMessage');</script>"; 
    }


?>

</form>

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

function fnExcelReport2()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('t2'); // id of table

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


</body>
</html>