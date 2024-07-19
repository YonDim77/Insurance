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

table {
    width: 100%;
}
th, td {
    
    text-align: center;
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

$Reg_Number = "";
$AutosID = 0; 
$GTP_Date= ""; 
$GTP_Email = "";
$GTP_Sum = "";
$GO_Date = "";
$GO_Email = "";
$GO_Sum = "";
$GO_Payment = "";
$Kasko_Date = "";
$Kasko_Email = "";
$Kasko_Sum =  ""; 
$Kasko_Payment = ""; 
$Vinetka_Date = "";
$Vinetka_Email = "";
$Vinetka_Sum = "";
$Vinetka_Type = "";
$Tax = "";
$Tax_Sum = "";
$Tax_Paid_Till = "";
$Efficiency = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    $messageError = "<h2>Моля попълнете полето!</h2>";
    //$AutosID = $_POST["Autos_ID"];
    
      
      /*if(strlen($AutosID)==0)
    	
      {
        echo $messageError;
      }
      
      else if (!filter_var($AutosID, FILTER_VALIDATE_INT)) {
        
    	echo "<br>";
        echo"<br><br>";
    	echo"<div align = 'center'>";
    	echo'<span style="font-size: 20px; color:red; ">Въведете цяло число в полето "ID"!</span>';
        echo"</div>";	
    	
      } 
      
      else {   // if(filter_var($Nomer, FILTER_VALIDATE_INT)) {
    */	  
    	//$url_id = mysqli_real_escape_string($con, $_POST['Individual_ID']);
    	
    	$Reg_Number = mysqli_real_escape_string($con, $_POST['Reg_Number']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sql = "SELECT AutosID FROM autos WHERE Reg_Number='$Reg_Number'";
        $resultID = mysqli_query($con, $sql);
    	
		if($row = mysqli_fetch_array($resultID)){
			
            $AutosID = $row['AutosID'];
		}
		
		$checkForInsuranceData = mysqli_query($con, "SELECT *FROM insurance WHERE AutosID = '$AutosID'");
		
		if(!mysqli_num_rows($resultID) >0){
    		
    		//echo"<br><br>";
    	    //echo"<div align = 'center'>";
    	    $message = "Несъществуващ регистрационен номер!";
		    echo "<script>alert('$message');</script>";
    		//echo '<span style="font-size: 20px; color:red; ">Несъществуващ номер на данни!</span>';
    		//echo"<br><br><br><br>";
            //echo"</div>";
    	} 
    	
		else if(!mysqli_num_rows($checkForInsuranceData) >0){
		    $message = "Няма данни за застраховки за този регистрационен номер!";
		    echo "<script>alert('$message');</script>";
		} 
           
        else{
      
			$result = mysqli_query($con, "SELECT * FROM insurance
								WHERE AutosID = '$AutosID'");  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			if (!$result) {
			
			die('Грешка: ' . mysqli_error());
			}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $AutosID = $row['AutosID'];                
                $GTP_Date= $row['GTP_Date'];
                $GTP_Email = $row['GTP_Email'];
				$GTP_Sum = $row['GTP_Sum'];
				$GO_Date = $row['GO_Date'];
				$GO_Email = $row['GO_Email'];
				$GO_Sum = $row['GO_Sum'];
				$GO_Payment = $row['GO_Payment'];
				$Kasko_Date = $row['Kasko_Date'];
				$Kasko_Email = $row['Kasko_Email'];
				$Kasko_Sum =  $row['Kasko_Sum']; 
				$Kasko_Payment = $row['Kasko_Payment']; 
				$Vinetka_Date = $row['Vinetka_Date'];
				$Vinetka_Email = $row['Vinetka_Email'];
				$Vinetka_Sum = $row['Vinetka_Sum'];
				$Vinetka_Type = $row['Vinetka_Type'];
				$Tax = $row['Tax'];
				$Tax_Sum = $row['Tax_Sum'];
				$Tax_Paid_Till = $row['Tax_Paid_Till'];
				$Efficiency = $row['Efficiency'];
				
                
                //$_SESSION['saveEmailUsername'] = $Email_Username;
    		}
    	}
//	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con = connectServer();
      
        $resultHistory = mysqli_query($con, "SELECT * FROM insurance Where AutosID = '$_POST[AutosID]'");

        $sqlUpdateInsurance="UPDATE insurance SET
        GTP_Date = '$_POST[GTP_Date]', GTP_Email = '$_POST[GTP_Email]', GTP_Sum = '$_POST[GTP_Sum]', GO_Date = '$_POST[GO_Date]', GO_Email = '$_POST[GO_Email]', GO_Sum = '$_POST[GO_Sum]', GO_Payment = '$_POST[GO_Payment]',
        Kasko_Date = '$_POST[Kasko_Date]', Kasko_Email = '$_POST[Kasko_Email]', Kasko_Sum = '$_POST[Kasko_Sum]', Kasko_Payment = '$_POST[Kasko_Payment]', Vinetka_Date = '$_POST[Vinetka_Date]', 
        Vinetka_Email = '$_POST[Vinetka_Email]', Vinetka_Sum = '$_POST[Vinetka_Sum]', Vinetka_Type = '$_POST[Vinetka_Type]', Tax = '$_POST[Tax]', Tax_Sum = '$_POST[Tax_Sum]', 
        Tax_Paid_Till = '$_POST[Tax_Paid_Till]', Efficiency = '$_POST[Efficiency]'
        Where AutosID = '$_POST[AutosID]'";
      
        mysqli_autocommit($con, FALSE);
        mysqli_query($con,"START TRANSACTION");
        $update = mysqli_query($con, $sqlUpdateInsurance);
        
      
        if ($update && mysqli_affected_rows($con) == 0) {
         mysqli_commit($con);
   	     $message = "Няма промяна на данни!";
   	     echo "<script>alert('$message');</script>";
        } 
        else if ($update && mysqli_affected_rows($con) == 1) {
            
         $nameFile = "Застраховки_МПС_Рег_№";
         $nameFile = $nameFile.$_POST['Reg_Num']; // Reg_Num !!!!!
         $dataS = "";
         $dataH= "";
         $updateDate = date("d-m-Y");
         
         if (!file_exists('history/insurance_data_autos/' . $nameFile . '.xls')) {
              $dataH= "<table>
              
              <tr>
	          <th>МПС ID/№</th>
	          <th>ГТП дата</th>
	          <th>ГТП уведомление</th>
	          <th>ГТП сума</th>
	          <th>ГО дата</th>
	          <th>ГО уведомление</th>
	          <th>ГО сума</th>
	          <th>ГО плащане</th>
	          <th>Каско дата</th>
	          <th>Каско уведомление</th>
	          <th>Каско сума</th>
	          <th>Каско плащане</th>
	          <th>Винетка дата</th>
	          <th>Винетка уведомление</th>
	          <th>Винатка сума</th>
	          <th>Винетка тип</th>
	          <th>Данък</th>
	          <th>Данък сума</th>
	          <th>Данък платен до</th>
	          <th>Ефективност</th>
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
	          <td>$row[GTP_Date]</td>
	          <td>$row[GTP_Email]</td>
	          <td>$row[GTP_Sum]</td>
	          <td>$row[GO_Date]</td>
	          <td>$row[GO_Email]</td>
	          <td>$row[GO_Sum]</td>
	          <td>$row[GO_Payment]</td>
	          <td>$row[Kasko_Date]</td>
	          <td>$row[Kasko_Email]</td>
	          <td>$row[Kasko_Sum]</td>
	          <td>$row[Kasko_Payment]</td>
	          <td>$row[Vinetka_Date]</td>
	          <td>$row[Vinetka_Email]</td>
	          <td>$row[Vinetka_Sum]</td>
	          <td>$row[Vinetka_Type]</td>
	          <td>$row[Tax]</td>
	          <td>$row[Tax_Sum]</td>
	          <td>$row[Tax_Paid_Till]</td>
	          <td>$row[Efficiency]</td>
              <td>$_SESSION[mainAdminUsername]</td>
              <td>$updateDate</td>
              </tr>
              <table>";
               $dataS = $dataS.$dataD;
              }
        
          
          $dataHD = $dataH.$dataS;
          $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
          file_put_contents('history/insurance_data_autos/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
          mysqli_commit($con);
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
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM insurance WHERE AutosID = '$_POST[AutosID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	    echo "<table border='2' style = 'margin-top: 7.0vw;'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 МПС ID/№</th>
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
	    <th bgcolor='$color1'>$h2 Винатка сума</th>
	    <th bgcolor='$color1'>$h2 Винетка тип</th>
	    <th bgcolor='$color1'>$h2 Данък</th>
	    <th bgcolor='$color1'>$h2 Данък сума</th>
	    <th bgcolor='$color1'>$h2 Данък платен до</th>
	    <th bgcolor='$color1'>$h2 Ефективност</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
	    echo "<tr>";
	    echo "<td>" . $row['AutosID'] . "</td>";
	    echo "<td>" . $row['GTP_Date'] . "</td>";
	    echo "<td>" . $row['GTP_Email'] . "</td>";
	    echo "<td>" . $row['GTP_Sum'] . "</td>";
	    echo "<td>" . $row['GO_Date'] . "</td>";
	    echo "<td>" . $row['GO_Email'] . "</td>";
	    echo "<td>" . $row['GO_Sum'] . "</td>";
	    echo "<td>" . $row['GO_Payment'] . "</td>";
	    echo "<td>" . $row['Kasko_Date'] . "</td>";
	    echo "<td>" . $row['Kasko_Email'] . "</td>";
	    echo "<td>" . $row['Kasko_Sum'] . "</td>";
	    echo "<td>" . $row['Kasko_Payment'] . "</td>";
	    echo "<td>" . $row['Vinetka_Date'] . "</td>";
	    echo "<td>" . $row['Vinetka_Email'] . "</td>";
	    echo "<td>" . $row['Vinetka_Sum'] . "</td>";
	    echo "<td>" . $row['Vinetka_Type'] . "</td>";
	    echo "<td>" . $row['Tax'] . "</td>";
	    echo "<td>" . $row['Tax_Sum'] . "</td>";
	    echo "<td>" . $row['Tax_Paid_Till'] . "</td>";
	    echo "<td>" . $row['Efficiency'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	
	}
      
      mysqli_close($con);
	}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw;">Актуализиране на данни за застраховки на МПС:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
	<p style = "margin-bottom: 0px;">Рег. №*</p><input type="text" name="Reg_Number" value = "<?php if(isset($_SESSION['Reg_Number'])) echo $_SESSION['Reg_Number']; else echo $Reg_Number;?>" required="required" placeholder = "Задължително попълване">
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        <tr>
            <input type="number" name="AutosID" value = "<?php echo $AutosID;?>" style = "display: none;">
	        <br><br>
	        <input type="text" name="Reg_Num" value = "<?php echo $Reg_Number;?>" style = "display: none;">
	        <br><br>
	        <td>ГТП дата*<br><input type="Date" name="GTP_Date" value = "<?php echo $GTP_Date;?>" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ГТП уведомление*<br>
            <select name="GTP_Email" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $GTP_Email;?>"><?php echo $GTP_Email;?></option>
            <option value="неизпратено">неизпратено</option>												
            <option value="изпратено">изпратено</option>
            </select></td>
            
            <td>ГТП сума лв*<br><input type="text" name="GTP_Sum"  value = "<?php echo $GTP_Sum;?>" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>ГО дата*<br><input type="Date" name="GO_Date" value = "<?php echo $GO_Date;?>" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ГО уведомление*<br>
            <select name="GO_Email" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $GO_Email;?>"><?php echo $GO_Email;?></option>
            <option value="неизпратено">неизпратено</option>												
            <option value="изпратено">изпратено</option>
            </select></td>
            
            <td>ГО сума лв*<br><input type="text" name="GO_Sum" value = "<?php echo $GO_Sum;?>" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>ГО плащане*<br>
            <select name="GO_Payment" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $GO_Payment;?>"><?php echo $GO_Payment;?></option>
            <option value="годишно">годишно</option>												
            <option value="полугодишно">полугодишно</option>
            <option value="тримесечно">тримесечно</option>
            </select></td>
            
            <td>Каско дата*<br><input type="Date" name="Kasko_Date" value = "<?php echo $Kasko_Date;?>" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Каско уведомление*<br>
            <select name="Kasko_Email" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Kasko_Email;?>"><?php echo $Kasko_Email;?></option>
            <option value="неизпратено">неизпратено</option>												
            <option value="изпратено">изпратено</option>
            </select></td>
        </tr>
        <tr>    
            <td>Каско сума лв*<br><input type="text" name="Kasko_Sum" value = "<?php echo $Kasko_Sum;?>" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Каско плащане*<br>
            <select name="Kasko_Payment" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Kasko_Payment;?>"><?php echo $Kasko_Payment;?></option>
            <option value="годишно">годишно</option>												
            <option value="полугодишно">полугодишно</option>
            <option value="тримесечно">тримесечно</option>
            </select></td>
            
            <td>Винетка дата*<br><input type="Date" name="Vinetka_Date" value = "<?php echo $Vinetka_Date;?>" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Винетка уведомление*<br>
            <select name="Vinetka_Email" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Vinetka_Email;?>"><?php echo $Vinetka_Email;?></option>
            <option value="неизпратено">неизпратено</option>												
            <option value="изпратено">изпратено</option>
            </select></td>
            
            <td>Винетка сума лв*<br><input type="text" name="Vinetka_Sum" value = "<?php echo $Vinetka_Sum;?>" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Винетка вид*<br>
            <select name="Vinetka_Type" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Vinetka_Type;?>"><?php echo $Vinetka_Type;?></option>
            <option value="годишна">годишна</option>												
            <option value="полугодишна">полугодишна</option>
            <option value="тримесечна">тримесечна</option>
            <option value="месечна">месечна</option>												
            <option value="седмична">седмична</option>
            <option value="weekend">weekend</option>
            </select></td>
        </tr>
        <tr>    
            <td>Данък*<br><input type="text" name="Tax" value = "<?php echo $Tax;?>" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Данък сума лв*<br><input type="text" name="Tax_Sum" value = "<?php echo $Tax_Sum;?>" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Данък платен до*<br><input type="Date" name="Tax_Paid_Till" value = "<?php echo $Tax_Paid_Till;?>" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr> 
            <td></td>
            <td>Ефективност*<br><input type="text" name="Efficiency" value = "<?php echo $Efficiency;?>" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;"></td>
            <td></td>
        </tr>
    </table>
  </form>
  
</div>	 

<?php
unset($_SESSION['Reg_Number']);
?>

<script>

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