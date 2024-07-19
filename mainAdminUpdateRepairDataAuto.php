<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
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
      $("#nav").load("nav.php"); 
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
<body> 

<div id = "nav"></div>

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
$Invoice = "";
$AutosID = 0; 
$Repair_Type = ""; 
$Repair_Of = "";
$Km = ""; 
$Change_Of = "";
$Sum = "";
$Date = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowData) {
	
    $con = connectServer();
    
    	
    	$_SESSION['Reg_NumberLocal'] = mysqli_real_escape_string($con, $_POST['Reg_Number']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sql = "SELECT AutosID FROM autos WHERE Reg_Number='$_SESSION[Reg_NumberLocal]'";
        $resultID = mysqli_query($con, $sql);
    	
		if($row = mysqli_fetch_array($resultID)){
			
            $_SESSION['Autos_ID'] = $AutosID = $row['AutosID'];
		}
		$checkForRepairData = mysqli_query($con, "SELECT *FROM repair WHERE AutosID = '$AutosID'");
		
		if(!mysqli_num_rows($resultID) >0){
    		
    	    $message = "Несъществуващ регистрационен номер!";
		    echo "<script>alert('$message');</script>";
    		
    	}
		
		else if(!mysqli_num_rows($checkForRepairData) > 0){
		    
		    $message = "Няма данни за ремонт за този регистрационен номер!";
		    echo "<script>alert('$message');</script>";
		} 
           
        else {
            
            if(strlen($_POST['Invoice']) > 0) {
                $resultInvoice = mysqli_query($con, "SELECT * FROM repair
								                     WHERE AutosID = '$AutosID' AND Invoice = '$_POST[Invoice]'");
				if (!$resultInvoice) {
			
			        die('Грешка: ' . mysqli_error());
			    }				                     
            }
      
            else {
			    $result = mysqli_query($con, "SELECT * FROM repair
			    					WHERE AutosID = '$AutosID'");  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			    if (!$result) {
			    
			    die('Грешка: ' . mysqli_error());
			    }
            }
    	 	
    	 	if((strlen($_POST['Invoice']) > 0)? mysqli_num_rows($resultInvoice) > 0: mysqli_num_rows($result) > 0) {
    		    echo "<table border='2' style = 'margin-top: 7.0vw;'>
        
                <tr>
                <th bgcolor='$color1'>$h2 ID/№ на ремонт на МПС</th>
                <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
                <th bgcolor='$color1'>$h2 Подаминистратор Потребителско име</th>
                <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
                <th bgcolor='$color1'>$h2 Ремонт вид</th>
                <th bgcolor='$color1'>$h2 Ремонт на</th>
                <th bgcolor='$color1'>$h2 Километри</th>
                <th bgcolor='$color1'>$h2 Смяна на</th>
                <th bgcolor='$color1'>$h2 Сума лв</th>
                <th bgcolor='$color1'>$h2 Фактура №</th>
                <th bgcolor='$color1'>$h2 Дата</th>
                </tr>";
                
                while($row = mysqli_fetch_array((strlen($_POST['Invoice']) > 0)? $resultInvoice: $result))
                {
                    echo "<tr>";
                    echo "<td style='color:black;'>" . $row['Repair_ID'] . "</td>";
                    echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
                    echo "<td style='color:black;'>" . $row['Admin_Username'] . "</td>";
                    echo "<td style='color:black;'>" . $row['Sub_Admin_Username'] . "</td>";  
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
    	    
    	    else {
    	        $message = "Грешен номер на фактура!";
		        echo "<script>alert('$message');</script>";
    	    }
	  }

	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    	
    	$Repair_ID = mysqli_real_escape_string($con, $_POST['Repair_ID']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        
		
		$checkForRepairId = mysqli_query($con, "SELECT *FROM repair WHERE Repair_ID = '$Repair_ID' AND AutosID = '$_SESSION[Autos_ID]'");
		
		if (!isset($_SESSION['Reg_NumberLocal'])){
		    $message = "Моля първо въведете рег. № на МПС, вижте данните и след това въведете Ремонт ID/№ за попълване на данните за редакция!";
		    echo "<script>alert('$message');</script>";
		}
		else if(!mysqli_num_rows($checkForRepairId) >0){
		    $message = "Несъществуващо ID/№ или грешно ID/№!";
		    echo "<script>alert('$message');</script>";
		} 
		
        else {
      
			$result = mysqli_query($con, "SELECT * FROM repair
								WHERE Repair_ID = '$Repair_ID'");  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			if (!$result) {
			
			die('Грешка: ' . mysqli_error());
			}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $Repair_ID = $row['Repair_ID'];                
                $Repair_Type = $row['Repair_Type']; 
				$Repair_Of = $row['Repair_Of'];
				$Km = $row['Km']; 
				$Change_Of = $row['Change_Of'];
				$Sum = $row['Sum'];
				$Invoice = $row['Invoice'];
				$Date =  $row['Date']; 
											 
    		}
    	}
//	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con = connectServer();
      
        $resultHistory = mysqli_query($con, "SELECT * FROM repair Where  Repair_ID = '$_POST[Repair_ID]'");

        $sqlUpdateRepair = "UPDATE repair SET
        Repair_Type = '$_POST[Repair_Type]', Repair_Of = '$_POST[Repair_Of]', Km = '$_POST[Km]', 
		Change_Of = '$_POST[Change_Of]', Sum = '$_POST[Sum]',
        Invoice = '$_POST[Invoice]', Date = '$_POST[Date]'
        Where Repair_ID = '$_POST[Repair_ID]'";
      
        mysqli_autocommit($con, FALSE);
        mysqli_query($con,"START TRANSACTION");
        $update = mysqli_query($con, $sqlUpdateRepair);
        
      
        if ($update && mysqli_affected_rows($con) == 0) {
         mysqli_commit($con);
         unset($_SESSION['Reg_NumberLocal']);
   	     $message = "Няма промяна на данни!";
   	     echo "<script>alert('$message');</script>";
        } 
        else if ($update && mysqli_affected_rows($con) == 1) {
         $nameFile = "Ремонт_МПС_Рег_№";
         $nameFile = $nameFile.$_POST['Reg_Num'];
         $dataS = "";
         $dataH= "";
         $updateDate = date("d-m-Y"); 
         
         if (!file_exists('history/repair_data_autos/' . $nameFile . '.xls')) {
              $dataH= "<table>
              
              <tr>
	          <th>ID/№ на ремонт на МПС</th>
              <th>ID/№ на МПС</th>
              <th>Подаминистратор Потребителско име</th>
              <th>Потребител Потреб. име</th>
              <th>Ремонт вид</th>
              <th>Ремонт на</th>
              <th>Километри</th>
              <th>Смяна на</th>
              <th>Сума лв</th>
              <th>Фактура №</th>
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
	          <td>$row[Repair_ID]</td>
              <td>$row[AutosID]</td>
              <td>$row[Admin_Username]</td>
              <td>$row[Sub_Admin_Username]</td>  
              <td>$row[Repair_Type]</td>
              <td>$row[Repair_Of]</td>
              <td>$row[Km]</td>
              <td>$row[Change_Of]</td>
              <td>$row[Sum]</td>
              <td>$row[Invoice]</td>
              <td>$row[Date]</td>
              <td>$_SESSION[mainAdminUsername]</td>
              <td>$updateDate</td>
              </tr>
              <table>";
               $dataS = $dataS.$dataD;
              }
        
          
         $dataHD = $dataH.$dataS;
         $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
         file_put_contents('history/repair_data_autos/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
            
            
         mysqli_commit($con);
         unset($_SESSION['Reg_NumberLocal']);
   	     $message = "Данните са актуализирани успешно!";
   	     echo "<script>alert('$message');</script>";
        }  
        else {  
         mysqli_rollback($con);
   	     $message = "Възникна грешка, опитайте отново! Дублиране ID на МПС!"; //!!!!номер шаси
         echo "<script>alert('$message');</script>";
        }
        mysqli_query($con, "SET AUTOCOMMIT=TRUE");
//    }  
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM repair WHERE Repair_ID = '$_POST[Repair_ID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table border='2' style = 'margin-top: 7.0vw;'>
	    
	    <tr>
        <th bgcolor='$color1'>$h2 ID/№ на ремонт на МПС</th>
        <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
        <th bgcolor='$color1'>$h2 Подаминистратор Потребителско име</th>
        <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
        <th bgcolor='$color1'>$h2 Ремонт вид</th>
        <th bgcolor='$color1'>$h2 Ремонт на</th>
        <th bgcolor='$color1'>$h2 Километри</th>
        <th bgcolor='$color1'>$h2 Смяна на</th>
        <th bgcolor='$color1'>$h2 Сума лв</th>
        <th bgcolor='$color1'>$h2 Фактура №</th>
        <th bgcolor='$color1'>$h2 Дата</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
	    echo "<tr>";
            echo "<td style='color:black;'>" . $row['Repair_ID'] . "</td>";
            echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
            echo "<td style='color:black;'>" . $row['Admin_Username'] . "</td>";
            echo "<td style='color:black;'>" . $row['Sub_Admin_Username'] . "</td>";  
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
      
      mysqli_close($con);
	}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw; margin-left: 4.0vw;">Актуализиране на данни за ремонт на МПС:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
	<p style = "margin-bottom: 0px;">Рег. №*</p><input type="text" name="Reg_Number" value = "<?php if(isset($_SESSION['Reg_Number'])) echo $_SESSION['Reg_Number']; else echo $_SESSION['Reg_NumberLocal'];?>" style = "width:174px;" required="required" placeholder = "Задължително попълване">
	<br><br>
	Фактура №*<br><input type="text" name="Invoice" value = "<?php if($btnShowData) echo $Invoice; else echo "";?>"  placeholder = "">
    <br><br>
    <input type="submit" name="btnShowData" value="Покажи данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <br><br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
	<p style = "margin-bottom: 0px;">Ремонт ID/№*</p><input type="number" name="Repair_ID" value = "<?php echo $Repair_ID;?>" style = "width:174px;" required="required" placeholder = "Задължително попълване">
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <input type="number" name="Repair_ID" value = "<?php echo $Repair_ID;?>" style = "display: none;">
    <input type="text" name="Reg_Num" value = "<?php echo $_SESSION['Reg_NumberLocal'];?>" style = "display: none;">
	<br><br>
	<table class = "iDataInput">
	    <tr>
            <td>Ремонт вид*<br>
            <select name="Repair_Type" style = "width:174px; height: 27px;" required="required">
            <option value="<?php echo $Repair_Type;?>"><?php echo $Repair_Type;?></option>
            <option value="гаранционно">гаранционно</option>												
            <option value="редовно">редовно</option>
            </select></td>
            
            <td>Ремонт на*<br>
            <select name="Repair_Of" style = "width:174px; height: 27px;" required="required">
            <option value="<?php echo $Repair_Of;?>"><?php echo $Repair_Of;?></option>
            <option value="двигател">двигател</option>												
            <option value="ходова част">ходова част</option>
            <option value="охлаждаща система">охлаждаща система</option>												
            <option value="скоростна кутия">скоростна кутия</option>
            <option value="климатична система">климатична система</option>												
            <option value="купе">купе</option>
            <option value="спирачки">спирачки</option>
            <option value="ел. система">ел. система</option>												
            <option value="фарове">фарове</option>
            <option value="Компютър">компютър</option>												
            <option value="други">други</option>
            </select></td>
            
            <td>Километри*<br><input type="number" name="Km"  value = "<?php echo $Km;?>"required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Смяна на*<br><input type="text" name="Change_Of" value = "<?php echo $Change_Of;?>"required="required" placeholder = "Задължително попълване"></td>
            
            <td>Сума лв*<br><input type="text" name="Sum" value = "<?php echo $Sum;?>" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Фактура №*<br><input type="text" name="Invoice" value = "<?php echo $Invoice;?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td></td>
            <td>Дата*<br><input type="date" name="Date" value = "<?php echo $Date;?>" required="required" placeholder = "Задължително попълване"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;"></td>
            <td></td>
        </tr>
    </table>
    <br><br>
  </form>
  
</div>

<?php
unset($_SESSION['Reg_Number']);
?>

<script>

function checkInput() {
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
		  
</body>		  
</html>