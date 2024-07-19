<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="adminCss.css">
<script> 

    $(function(){
      $("#adminNav").load("adminNav.php"); 
    });
    
</script>

<style>
body {
    
}

th, td {
    
    text-align: center;
}


table{
    width: 100%;
}

</style>
</head>
<body onload = "toggleEnable()"> 

<div id = "adminNav"></div>

<br> 

<?php

include 'functions.php';

$btnFillData = false;
$btnUpdate = false;
$btnShowData = false;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnFillData"])) {
	$btnFillData = true;
}
if(isset($_POST["btnUpdate"])) {
	$btnUpdate = true;
}

if(isset($_POST["btnShowData"])) {
	$btnShowData = true;
}

//$_SESSION['Reg_Number'] = "";
$Reg_Number = "";
$AutosID = 0; 
$Service = ""; 
$Type = "";
$Date_Of_Service = ""; 
$Km = "";
$After_Km = "";
$After_Date = "";
$Sum =  ""; 
$Invoice = "";
$Oils_Filters_Email = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowData) {
	
    $con = connectServer();
    
    	
    	$_SESSION['Reg_NumberLocalS'] = mysqli_real_escape_string($con, $_POST['Reg_Number']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sql = "SELECT AutosID FROM autos WHERE Reg_Number='$_SESSION[Reg_NumberLocalS]' AND Admin_Username = '$_SESSION[adminUsername]'";
        $resultID = mysqli_query($con, $sql);
    	
		if($row = mysqli_fetch_array($resultID)){
			
            $_SESSION['Autos_ID'] = $AutosID = $row['AutosID'];
		}
		$checkForServiceData = mysqli_query($con, "SELECT *FROM service WHERE AutosID = '$AutosID' 
		                                           AND Admin_Username = '$_SESSION[adminUsername]'");
		
		if(!mysqli_num_rows($resultID) >0){
    		
    	    $message = "Несъществуващ регистрационен номер!";
		    echo "<script>alert('$message');</script>";
    		
    	}
		
		else if(!mysqli_num_rows($checkForServiceData) > 0){
		    
		    $message = "Няма данни за сервиз за този регистрационен номер!";
		    echo "<script>alert('$message');</script>";
		} 
           
        else {
            
            if(strlen($_POST['Invoice']) > 0) {
                $resultInvoice = mysqli_query($con, "SELECT * FROM service
								                     WHERE AutosID = '$AutosID' 
								                     AND Invoice = '$_POST[Invoice]'
								                     AND Admin_Username = '$_SESSION[adminUsername]'");
				if (!$resultInvoice) {
			
			        die('Грешка: ' . mysqli_error());
			    }				                     
            }
      
            else {
			    $result = mysqli_query($con, "SELECT * FROM service
			    					          WHERE AutosID = '$AutosID'
			    					          AND Admin_Username = '$_SESSION[adminUsername]'");  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			    if (!$result) {
			    
			    die('Грешка: ' . mysqli_error());
			    }
            }
    	 	
    	 	if((strlen($_POST['Invoice']) > 0)? mysqli_num_rows($resultInvoice) > 0: mysqli_num_rows($result) > 0) {
    		    echo "<table border='2' style = 'margin-top: 7.0vw;'>
        
                <tr>
                <th>Сервиз ID/№</th>
	            <th>МПС ID/№</th>
	            <th>Сервиз</th>
	            <th>Обслужване на</th>
                <th>Дата на обслужване</th>
                <th>Километри</th>
                <th>След километри</th>
                <th>След дата</th>
                <th>Сума лв</th>
                <th>Фактура №</th>
                <th>Масла и филтри уведомление</th>
	            </tr>";
                
                while($row = mysqli_fetch_array((strlen($_POST['Invoice']) > 0)? $resultInvoice: $result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['Service_ID'] . "</td>";
	                echo "<td>" . $row['AutosID'] . "</td>";
	                echo "<td>" . $row['Service'] . "</td>"; 
	                echo "<td>" . $row['Type'] . "</td>";
                    echo "<td>" . $row['Date_Of_Service'] . "</td>";
                    echo "<td>" . $row['Km'] . "</td>";
                    echo "<td>" . $row['After_Km'] . "</td>";
                    echo "<td>" . $row['After_Date'] . "</td>";
                    echo "<td>" . $row['Sum'] . "</td>";
                    echo "<td>" . $row['Invoice'] . "</td>";
                    echo "<td>" . $row['Oils_Filters_Email'] . "</td>";
	                echo "</tr>";
                }
                echo "</table>"; 
    	    }
    	    
    	    else {
    	        $message = "Грешен номер на фактура!";
		        echo "<script>alert('$message');</script>";
    	    }
	  }

	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    	
    	$Service_ID = mysqli_real_escape_string($con, $_POST['Service_ID']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        
		
		$checkForServiceId = mysqli_query($con, "SELECT *FROM service WHERE Service_ID = '$Service_ID' 
		                                         AND AutosID = '$_SESSION[Autos_ID]'
		                                         AND Admin_Username = '$_SESSION[adminUsername]'");
		
		if (!isset($_SESSION['Reg_NumberLocalS'])){
		    $message = "Моля първо въведете рег. № на МПС, вижте данните и след това въведете Сервиз ID/№ за попълване на данните за редакция!";
		    echo "<script>alert('$message');</script>";
		}
		else if(!mysqli_num_rows($checkForServiceId) >0){
		    $message = "Несъществуващо ID/№ или грешно ID/№!";
		    echo "<script>alert('$message');</script>";
		} 
		
        else {
      
			$result = mysqli_query($con, "SELECT * FROM service
								          WHERE Service_ID = '$Service_ID'
								          AND Admin_Username = '$_SESSION[adminUsername]'");  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			if (!$result) {
			
			die('Грешка: ' . mysqli_error());
			}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $Service_ID = $row['Service_ID'];
                $AutosID = $row['AutosID'];                
                $Service = $row['Service']; 
				$Type = $row['Type'];
				$Date_Of_Service = $row['Date_Of_Service']; 
				$Km = $row['Km'];
				$After_Km = $row['After_Km'];
				$After_Date = $row['After_Date'];
				$Sum =  $row['Sum']; 
				$Invoice = $row['Invoice']; 
				$Oils_Filters_Email = $row['Oils_Filters_Email'];							 
    		}
    	}
//	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
        $con = connectServer();
      
        $resultHistory = mysqli_query($con, "SELECT * FROM service Where Service_ID = '$_POST[Service_ID]' AND Admin_Username = '$_SESSION[adminUsername]'");
        
        if(strcmp($_POST['Type'], 'масла и филтри') != 0) {
            
            $sqlUpdateService = "UPDATE service SET
            Service = '$_POST[Service]', Type = '$_POST[Type]', Date_Of_Service = '$_POST[Date_Of_Service]', Km = '$_POST[Km]', 
            After_Km = '$_POST[After_Km]', After_Date = '$_POST[After_Date]', Sum = '$_POST[Sum]', Invoice = '$_POST[Invoice]'
            Where Service_ID = '$_POST[Service_ID]' AND Admin_Username = '$_SESSION[adminUsername]'";
        
            mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            $update = mysqli_query($con, $sqlUpdateService);
            
        
            if ($update && mysqli_affected_rows($con) == 0) {
             mysqli_commit($con);
             unset($_SESSION['Reg_NumberLocalS']);
   	         $message = "Няма промяна на данни!";
   	         echo "<script>alert('$message');</script>";
            } 
            else if ($update && mysqli_affected_rows($con) == 1) {
                
             $nameFile = "Сервиз_МПС_Рег_№";
             $nameFile = $nameFile.$_POST['Reg_Num'];
             $dataS = "";
             $dataH= "";
             $updateDate = date("d-m-Y");
             
             if (!file_exists('history/service_data_autos/' . $nameFile . '.xls')) {
                  $dataH= "<table>
                  
                  <tr>
	              <th>МПС ID/№</th>
	              <th>Сервиз</th>
	              <th>Обслужване на</th>
	              <th>Дата на обслужване</th>
	              <th>Километри</th>
	              <th>След километри</th>
	              <th>След дата</th>
	              <th>Сума</th>
	              <th>Фактура №</th>
	              <th>Масла и филтри уведомление</th>
	              <th>Редактор</th>
	              <th>Дата на редакция</th>
	              </tr>
                  </table>";
             }
              
                  while($row = mysqli_fetch_array($resultHistory))
                  {
                  $dataD = "<table>
                  <tr>
                  <td>$row[AutosID]</td>
	              <td>$row[Service]</td> 
	              <td>$row[Type]</td>
	              <td>$row[Date_Of_Service]</td>
	              <td>$row[Km]</td>
	              <td>$row[After_Km]</td>
	              <td>$row[After_Date]</td>
	              <td>$row[Sum]</td>
	              <td>$row[Invoice]</td>
	              <td>$row[Oils_Filters_Email]</td>
                  <td>$_SESSION[adminUsername]</td>
                  <td>$updateDate</td>
                  </tr>
                  <table>";
                   $dataS = $dataS.$dataD;
                  }
            
              
              $dataHD = $dataH.$dataS;
              $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
              file_put_contents('history/service_data_autos/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);   
                
             mysqli_commit($con);
             unset($_SESSION['Reg_NumberLocalS']);
   	         $message = "Данните са актуализирани успешно!";
   	         echo "<script>alert('$message');</script>";
            }  
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка, опитайте отново! Дублиране ID на МПС!"; //!!!!номер шаси
             echo "<script>alert('$message');</script>";
            }
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
        }
        else {
           
            $sqlUpdateService = "UPDATE service SET
            Service = '$_POST[Service]', Type = '$_POST[Type]', Date_Of_Service = '$_POST[Date_Of_Service]', Km = '$_POST[Km]', 
            After_Km = '$_POST[After_Km]', After_Date = '$_POST[After_Date]', Sum = '$_POST[Sum]', Invoice = '$_POST[Invoice]', Oils_Filters_Email = '$_POST[Oils_Filters_Email]'
            Where Service_ID = '$_POST[Service_ID]' AND Admin_Username = '$_SESSION[adminUsername]'";
        
            mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            $update = mysqli_query($con, $sqlUpdateService);
            
        
            if ($update && mysqli_affected_rows($con) == 0) {
             mysqli_commit($con);
             unset($_SESSION['Reg_NumberLocalS']);
   	         $message = "Няма промяна на данни!";
   	         echo "<script>alert('$message');</script>";
            } 
            else if ($update && mysqli_affected_rows($con) == 1) {
                
             $nameFile = "Сервиз_МПС_Рег_№";
             $nameFile = $nameFile.$_POST['Reg_Num'];
             $dataS = "";
             $dataH= "";
             $updateDate = date("d-m-Y");
             
             if (!file_exists('history/service_data_autos/' . $nameFile . '.xls')) {
                  $dataH= "<table>
                  
                  <tr>
	              <th>МПС ID/№</th>
	              <th>Сервиз</th>
	              <th>Обслужване на</th>
	              <th>Дата на обслужване</th>
	              <th>Километри</th>
	              <th>След километри</th>
	              <th>След дата</th>
	              <th>Сума</th>
	              <th>Фактура №</th>
	              <th>Масла и филтри уведомление</th>
	              <th>Редактор</th>
	              <th>Дата на редакция</th>
	              </tr>
                  </table>";
             }
              
                  while($row = mysqli_fetch_array($resultHistory))
                  {
                  $dataD = "<table>
                  <tr>
                  <td>$row[AutosID]</td>
	              <td>$row[Service]</td> 
	              <td>$row[Type]</td>
	              <td>$row[Date_Of_Service]</td>
	              <td>$row[Km]</td>
	              <td>$row[After_Km]</td>
	              <td>$row[After_Date]</td>
	              <td>$row[Sum]</td>
	              <td>$row[Invoice]</td>
	              <td>$row[Oils_Filters_Email]</td>
                  <td>$_SESSION[adminUsername]</td>
                  <td>$updateDate</td>
                  </tr>
                  <table>";
                   $dataS = $dataS.$dataD;
                  }
            
              
              $dataHD = $dataH.$dataS;
              $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
              file_put_contents('history/service_data_autos/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);   
                
             mysqli_commit($con);
             unset($_SESSION['Reg_NumberLocalS']);
   	         $message = "Данните са актуализирани успешно!";
   	         echo "<script>alert('$message');</script>";
            }  
            else {  
             mysqli_rollback($con);
   	         $message = "Възникна грешка, опитайте отново! Дублиране ID на МПС!"; //!!!!номер шаси
             echo "<script>alert('$message');</script>";
            }
            mysqli_query($con, "SET AUTOCOMMIT=TRUE");
            
        }
        
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM service WHERE Service_ID = '$_POST[Service_ID]' AND Admin_Username = '$_SESSION[adminUsername]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	    echo "<div align = 'center'>";
	    if(strcmp($_POST['Type'], 'масла и филтри') == 0) {
	        echo "<table border='2' style = 'margin-top: 7.0vw;'>
	        
	        <tr>
	        <th>Сервиз ID/№</th>
	        <th>МПС ID/№</th>
	        <th>Сервиз</th>
	        <th>Обслужване на</th>
            <th>Дата на обслужване</th>
            <th>Километри</th>
            <th>След километри</th>
            <th>След дата</th>
            <th>Сума лв</th>
            <th>Фактура №</th>
            <th>Масла и филтри уведомление</th>
	        </tr>";
	    
	    }
	    else {
	        
	        echo "<table border='2' style = 'margin-top: 7.0vw;'>
	        
	        <tr>
	        <th>Сервиз ID/№</th>
	        <th>МПС ID/№</th>
	        <th>Сервиз</th>
	        <th>Обслужване на</th>
            <th>Дата на обслужване</th>
            <th>Километри</th>
            <th>След километри</th>
            <th>След дата</th>
            <th>Сума лв</th>
            <th>Фактура №</th>
	        </tr>";
	        
	    }
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
	    echo "<tr>";
	    echo "<td>" . $row['Service_ID'] . "</td>";
	    echo "<td>" . $row['AutosID'] . "</td>";
	    echo "<td>" . $row['Service'] . "</td>"; 
	    echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Date_Of_Service'] . "</td>";
        echo "<td>" . $row['Km'] . "</td>";
        echo "<td>" . $row['After_Km'] . "</td>";
        echo "<td>" . $row['After_Date'] . "</td>";
        echo "<td>" . $row['Sum'] . "</td>";
        echo "<td>" . $row['Invoice'] . "</td>";
        if (strcmp($_POST['Type'], 'масла и филтри') == 0)  echo "<td>" . $row['Oils_Filters_Email'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	    echo "</div>";
	}
      
      mysqli_close($con);
	}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw; margin-left: 4.0vw;;">Актуализиране на данни за сервиз на МПС:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
	<p style = "margin-bottom: 0px;">Рег. №*</p><input type="text" name="Reg_Number" value = "<?php if(isset($_SESSION['Reg_Number_Global'])) echo $_SESSION['Reg_Number_Global']; else echo $_SESSION['Reg_NumberLocalS'];?>" style = "width:174px;" required="required" placeholder = "Задължително попълване">
	<br><br>
	Фактура №:<br><input type="text" name="Invoice" value = "<?php if($btnShowData) echo $Invoice; else echo "";?>"  placeholder = "">
    <br><br>
    <input type="submit" name="btnShowData" value="Покажи данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <br><br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
	<p style = "margin-bottom: 0px;">Сервиз ID/№*</p><input type="number" name="Service_ID" value = "<?php echo $Service_ID;?>" style = "width:174px;" required="required" placeholder = "Задължително попълване">
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <table class = "iDataInput">
        <tr>
            <input type="number" name="Service_ID" value = "<?php echo $Service_ID;?>" style = "display: none;">
            <input type="text" name="Reg_Num" value = "<?php echo $_SESSION['Reg_NumberLocalS'];?>" style = "display: none;">
	        
            <td>Сервиз*<br>
            <select name="Service" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Service;?>"><?php echo $Service;?></option>
            <option value="гаранционен">гаранционен</option>												
            <option value="редовен">редовен</option>
            </select></td>
        
            <td>Обслужване на*<br>
            <select id = "tEntity" name="Type" style = "width:174px; height: 27px;" onchange = "toggleEnable()" required="required">
            <option value="<?php echo $Type;?>"><?php echo $Type;?></option>
            <option value="масла и филтри">масла и филтри</option>												
            <option value="ремъци">ремъци</option>
            <option value="спирачки">спирачки</option>												
            <option value="скоростна кутия">скоростна кутия</option>
            </select></td>
        </td>
            <td>Дата на обслужване*<br><input type="Date" value="<?php echo $Date_Of_Service;?>" name="Date_Of_Service" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Километри*<br><input type="number" value="<?php echo $Km;?>" name="Km" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>След километри*<br><input type="number" value="<?php echo $After_Km;?>" name="After_Km" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>След дата*<br><input type="Date" value="<?php echo $After_Date;?>" name="After_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Сума лв*<br><input type="text" value="<?php echo $Sum;?>" name="Sum" style = "width:174px; height: 27px;" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Фактура №*<br><input type="text" value="<?php echo $Invoice;?>" name="Invoice" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Масла и филтри уведомление*<br>
            <select id = "ofe" name="Oils_Filters_Email" style = "width:174px; height: 27px;" required="required">
	            <option value="<?php echo $Oils_Filters_Email;?>"><?php echo $Oils_Filters_Email;?></option>
	            <option style = "color: red;" value="">без данни</option>
                <option value="неизпратено">неизпратено</option>												
                <option value="изпратено">изпратено</option>
            </select></td>
            
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;"></td>
            <td></td>
        </tr>
    <br><br>
    </table>
  </form>
  
</div>

<?php
unset($_SESSION['Reg_Number_Global']);
?>

<script>

function toggleEnable() {
        
        var typeValue = document.getElementById('tEntity').value;
        
        if(typeValue.localeCompare('масла и филтри') == 0) {
            document.getElementById('ofe').disabled = false;
            document.getElementById('ofe').style.color = "";
            document.getElementById('ofe').style.backgroundColor = "";
            
        }
        //else if(legalValue.localeCompare('') != 0){
        else {    
            document.getElementById('ofe').disabled = true;
            document.getElementById('ofe').style.color = "grey";
            document.getElementById('ofe').style.backgroundColor = "lightgrey";
            
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

<br>

</body>		  
</html>