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
    width: 100%;
}

th, td {
    border: 1px solid black;
    text-align: center;
}
.iDataInput td{
    border: none;
    height: 80px;
}

table.iDataInput {
    width: 100%;
    border: none;
}

</style>
</head>
<body>  

<div id = "adminNav"></div>
<br>

<script>


function showEik(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("Eik").innerHTML = "<span style = 'color: red; font-weight: bold;'>Изберете холдинг!</span>";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("Eik").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getEik.php?q="+str, true);
  xhttp.send();
}

function showFirmName(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("firmName").innerHTML = "<span style = 'color: red; font-weight: bold;'>Моля изберете ЕИК!!!</span>";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("firmName").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getFirmName.php?q="+str, true);
  xhttp.send();
}

</script>

<div align = "center">
  <h3 style = "margin-top: 7.0vw;">Прехвърляне на фирма от холдинг в холдинг</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">
    <table class = "iDataInput"> 
        <tr>
            <td>Избери холдинг*<br><select style = "width: 174px; height: 27px;" name="Holding_Name" onchange="showEik(this.value)" required="required" placeholder = "Задължително попълване"/>
                    <option value="">Избери холдинг</option>
                          <?php
                              $con = connectServer();
                              $query = "SELECT * FROM holding WHERE Admin_Username = '$_SESSION[adminUsername]'";
                              $results=mysqli_query($con, $query);
                              //loop
                              foreach ($results as $holdings){
                          ?>
                                  <option value="<?php echo $holdings['Name'];?>"><?php echo $holdings['Name'];?></option>
                          <?php
                              }
                              mysqli_close($con);
                              
                          ?>
                  
                    </select></td>
                
                <td>Избери ЕИК*<br><select  id="Eik" style = "width: 174px; height: 27px;" name="EIK" onchange = "showFirmName(this.value)" required="required">
                <option value="">Избери ЕИК</option>
                </select></td>
            
	            <td><fieldset id = "firmName" >
                Фирма<br><input type = "text"  name="Firm_Name" value="" style = "width:174px; height: 26px;"  required="required" readonly>
                </fieldset></td>
                        
        </tr>
        <tr>
                <td></td>
                <td>Избери нов холдинг*<br><select style = "width: 174px; height: 27px;" name="New_Holding_Name"  required="required" placeholder = "Задължително попълване"/>
                    <option value="">Избери нов холдинг</option>
                          <?php
                              $con = connectServer();
                              $queryH = "SELECT * FROM holding WHERE Admin_Username = '$_SESSION[adminUsername]'";
                              $resultsH=mysqli_query($con, $queryH);
                              //loop
                              foreach ($resultsH as $holdingsH){
                          ?>
                                  <option value="<?php echo $holdingsH['Name'];?>"><?php echo $holdingsH['Name'];?></option>
                          <?php
                              }
                              mysqli_close($con);
                              
                          ?>
                  
                    </select></td>
                <td></td>
        </tr>        
    </table><br><br><br>
    <input type="submit" name="btnEdit" value="Прехвърляне" style = "border-radius: 2px; color: red; width: 174px;">
  </form>
  
 
<?php

$btnEdit = false;

if(isset($_POST["btnEdit"])) {
	$btnEdit = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnEdit == true) {
  $con = connectServer();
   
    $resultHistory = mysqli_query($con, "SELECT * FROM legalentity Where EIK = '$_POST[EIK]'");
    $adminSubadmin = "SELECT Admin_Username, Sub_Admin_Username FROM holding WHERE Name = '$_POST[New_Holding_Name]'"; 
    
    $admin = "";
    $subAdmin = "";
    $updateCounter = 0; 
    $noChangedData = 0;
    
    $zeroLegalentity = false; $oneLegalentity = false; $zeroAutos = false; $oneAutos = false; $zeroInsurance = false; $oneInsurance = false;
	$zeroService = false; $oneService = false; $zeroRepair = false; $oneRepair = false; $zeroTyres = false; $oneTyres = false;
    
    $select =  mysqli_query($con, $adminSubadmin);
    while($row = mysqli_fetch_array($select))
    {
        $admin = $row['Admin_Username'];
        $subAdmin = $row['Sub_Admin_Username'];
    }
    
    $firmId = '';
    $sqlFirmId = mysqli_query($con, "SELECT Legalentity_ID FROM legalentity WHERE EIK = '$_POST[EIK]'");
    while($rowId = mysqli_fetch_array($sqlFirmId))
    {
        $firmId = $rowId['Legalentity_ID'];
    }
    
    
    $sqlUpdateLegalentity ="UPDATE legalentity SET 
    Holding_Name = '$_POST[New_Holding_Name]', Admin_Username =  '$admin', Sub_Admin_Username = '$subAdmin'
    Where EIK = '$_POST[EIK]'";
    
    $sqlUpdateLegalentityAuto="UPDATE autos 
    SET Admin_Username = '$admin', Sub_Admin_Username = '$subAdmin' 
    Where Legalentity_ID = '$firmId'";
	
	$sqlUpdateLegalentityInsurance="UPDATE insurance 
	SET Admin_Username = '$admin', Sub_Admin_Username = '$subAdmin'
	Where Legalentity_ID = '$firmId'";
	
	$sqlUpdateLegalentityService="UPDATE service 
	SET Admin_Username = '$admin', Sub_Admin_Username = '$subAdmin'
	Where Legalentity_ID = '$firmId'";
	
	$sqlUpdateLegalentityRepair="UPDATE repair
	SET Admin_Username = '$admin', Sub_Admin_Username = '$subAdmin'
	Where Legalentity_ID = '$firmId'";
	
	$sqlUpdateLegalentityTyres="UPDATE tyres
	SET Admin_Username = '$admin', Sub_Admin_Username = '$subAdmin'
	Where Legalentity_ID = '$firmId'";
    
    
    
    mysqli_autocommit($con, FALSE);
    mysqli_query($con,"START TRANSACTION");
    
    $updateLegalentity = mysqli_query($con, $sqlUpdateLegalentity);
    if(mysqli_affected_rows($con) == 0) {
        $zeroLegalentity = true;
    }
    if(mysqli_affected_rows($con) == 1) {
        $oneLegalentity = true;
    }
    
    $updateAutos = mysqli_query($con, $sqlUpdateLegalentityAuto);
    if(mysqli_affected_rows($con) == 0) {
        $zeroAutos = true;
    }
    if(mysqli_affected_rows($con) >= 1) {
        $oneAutos = true;
    }
    
	$updateInsurance = mysqli_query($con, $sqlUpdateLegalentityInsurance);
	if(mysqli_affected_rows($con) == 0) {
        $zeroInsurance = true;
    }
    if(mysqli_affected_rows($con) >= 1) {
        $oneInsurance = true;
    }
    
    $updateService = mysqli_query($con, $sqlUpdateLegalentityService);
	if(mysqli_affected_rows($con) == 0) {
        $zeroService = true;
    }
    if(mysqli_affected_rows($con) >= 1) {
        $oneService = true;
    }
    
    $updateRepair = mysqli_query($con, $sqlUpdateLegalentityRepair);
	if(mysqli_affected_rows($con) == 0) {
        $zeroRepair = true;
    }
    if(mysqli_affected_rows($con) >= 1) {
        $oneRepair = true;
    }
    
    $updateTyres = mysqli_query($con, $sqlUpdateLegalentityTyres);
	if(mysqli_affected_rows($con) == 0) {
        $zeroTyres = true;
    }
    if(mysqli_affected_rows($con) >= 1) {
        $oneTyres = true;
    }
    if($select && mysqli_num_rows($select) == 1 && $zeroLegalentity == true && $zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true &&
        $zeroTyres == true) {
        mysqli_commit($con);
        $noChangedData++;
   	    
    }
    
    else if($select && mysqli_num_rows($select) == 1 && $oneLegalentity == true && ($zeroAutos == true && $zeroInsurance == true && $zeroService == true &&  $zeroRepair == true &&
        $zeroTyres == true)) {
        mysqli_commit($con);
        $updateCounter++;
   	    
    } 
    
    else if($select && mysqli_num_rows($select) == 1 && $oneLegalentity == true && $oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true &&
        $oneTyres == true) {
        mysqli_commit($con);
        $updateCounter++;
   	 
    } 
    
    else if($select && mysqli_num_rows($select) == 1 && $oneLegalentity == true && $oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true) &&
        $oneTyres == true) {
        mysqli_commit($con);
        $updateCounter++;
   	 
    }
    
    else {  
        mysqli_rollback($con);
        $updateCounter = -1;
        $noChangedData = -1;
   	    $message = "Възникна грешка!";
        echo "<script>alert('$message');</script>";
        //echo "<script> location.replace('mainAdminUpdateDataAdminSubAdminFirm.php'); </script>";  
     //break;                                                                                    
    }
    
    if($updateCounter == 0) {
        $message = "Няма промяна на данни!";
   	    echo "<script>alert('$message');</script>";
    }
    if($noChangedData == 0) {
        
      $nameFile = "Юридическо_Лице_ЕИК:";
      $nameFile = $nameFile.$_POST['EIK'];
      $dataS = "";
      $dataH= "";
      $updateDate = date("d-m-Y");
      
      if (!file_exists('history/legalentities/' . $nameFile . '.xls')) {
          $dataH= "<table>
          
          <tr>
	      <th>№</th>
	      <th>Подадминистратор Потреб. име</th>
	      <th>Потребител Потреб. име</th>
	      <th>Име</th>
	      <th>ЕИК</th>
	      <th>ДДС номер</th>
	      <th>Адрес</th>
	      <th>Адрес на МПС</th>
	      <th>МОЛ</th>
	      <th>Телефон</th>
	      <th>Имейл</th>
	      <th>Лице за контакти</th>
	      <th>Тел. на лице за контакти</th>
	      <th>Имейл на лице за контакти</th>
	      <th>Имейл като потребителско име</th>
	      <th>Парола</th>
	      <th>Холдинг име</th>
	      <th>Дата</th>
	      <th>Редактор</th>
	      <th>Дата на редакция</th>
	      </tr>
          </table>";
      }
      
      while($row = mysqli_fetch_array($resultHistory))
      {
      $dataD = "<table>
      <tr>
      <td>$row[Legalentity_ID]</td>
	  <td>$row[Admin_Username]</td>
	  <td>$row[Sub_Admin_Username]</td>
	  <td>$row[Name]</td>
	  <td>$row[EIK]</td>
	  <td>$row[DDS_Nomer]</td>
	  <td>$row[Address]</td>
	  <td>$row[Address_MPS]</td>
	  <td>$row[MOL_Names]</td>
	  <td>$row[Telephone]</td>
	  <td>$row[Email]</td>
	  <td>$row[Contact_Person]</td>
	  <td>$row[Telephone_Contact_Person]</td>
	  <td>$row[Email_Contact_Person]</td>
	  <td>$row[Email_Username]</td>
	  <td>$row[Password]</td>
	  <td>$row[Holding_Name]</td>
	  <td>$row[Date]</td>
      <td>$_SESSION[adminUsername]</td>
      <td>$updateDate</td>
      </tr>
      <table>";
       $dataS = $dataS.$dataD;
      }
      
      $dataHD = $dataH.$dataS;
      $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
      file_put_contents('history/legalentities/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
        
        $message = "Фирмата е прехвърлена успешно!";
   	    echo "<script>alert('$message');</script>";
   	    //echo "<script> location.replace('mainAdminUpdateDataAdminSubAdminFirm.php'); </script>";
    }
		  
    mysqli_query($con, "SET AUTOCOMMIT=TRUE");       
    
      
    mysqli_close($con);
	
	
}
 
?>



<br><br>  
  
</div>  
</body>
</html>