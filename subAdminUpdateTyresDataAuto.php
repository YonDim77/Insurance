<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['subAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">-->
<meta charset="UTF-8">
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

<div id = "subAdminNav"></div>

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
$tyresID = 0;
$AutosID = 0; 
$Type = ""; 
$Date = "";
$Size = ""; 
$Price = "";
$Saved_In = "";
$Usability = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    $messageError = "<h2>Моля попълнете полето!</h2>";
    	
    	$Reg_Number = mysqli_real_escape_string($con, $_POST['Reg_Number']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sql = "SELECT AutosID FROM autos WHERE Reg_Number='$Reg_Number' AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'";
        $resultID = mysqli_query($con, $sql);
    	
		if($row = mysqli_fetch_array($resultID)){
			
            $AutosID = $row['AutosID'];
		}
		
		$checkForTyresData = mysqli_query($con, "SELECT *FROM tyres WHERE AutosID = '$AutosID' 
		                                         AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'");
												 
		if(!mysqli_num_rows($resultID) >0){
    		
    		//echo"<br><br>";
    	    //echo"<div align = 'center'>";
    	    $message = "Несъществуващ регистрационен номер или нямате достъп!";
		    echo "<script>alert('$message');</script>";
    		//echo '<span style="font-size: 20px; color:red; ">Несъществуващ номер на данни!</span>';
    		//echo"<br><br><br><br>";
            //echo"</div>";
    	} 
		
		else if(!mysqli_num_rows($checkForTyresData) >0){
		    $message = "Няма данни за гуми за този регистрационен номер!";
		    echo "<script>alert('$message');</script>";
		} 		
           
        else{
      
			$result = mysqli_query($con, "SELECT * FROM tyres
								          WHERE AutosID = '$AutosID' AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'");  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			
			//$_SESSION['Reg_Number']	= $Reg_Number;
			
			if (!$result) {
			
			die('Грешка: ' . mysqli_error());
			}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $tyresID = $row['Tyres_ID'];
                $AutosID = $row['AutosID'];                
                $Type = $row['Type']; 
				$Date = $row['Date'];
				$Size = $row['Size']; 
				$Price = $row['Price'];
				$Saved_In = $row['Saved_In'];
				$Usability = $row['Usability'];											                 
                
    		}
    	}
//	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con = connectServer();
      
        $resultHistory = mysqli_query($con, "SELECT * FROM tyres Where  Tyres_ID = '$_POST[Tyres_ID]'
                                             AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'");

        $sqlUpdateTyres = "UPDATE tyres SET
        Type = '$_POST[Type]', Date = '$_POST[Date]', Size = '$_POST[Size]', 
		Price = '$_POST[Price]', Saved_In = '$_POST[Saved_In]', Usability = '$_POST[Usability]' 
        Where AutosID = '$_POST[AutosID]' AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'";
      
        mysqli_autocommit($con, FALSE);
        mysqli_query($con,"START TRANSACTION");
        $update = mysqli_query($con, $sqlUpdateTyres);
        
      
        if ($update && mysqli_affected_rows($con) == 0) {
         mysqli_commit($con);
   	     $message = "Няма промяна на данни!";
   	     echo "<script>alert('$message');</script>";
        } 
        else if ($update && mysqli_affected_rows($con) == 1) {
            
         $nameFile = "Гуми_МПС_Рег_№";
         $nameFile = $nameFile.$_POST['Reg_Num'];
         $dataS = "";
         $dataH= "";
         $updateDate = date("d-m-Y"); 
         
         if (!file_exists('history/tyres_data_autos/' . $nameFile . '.xls')) {
              $dataH= "<table>
              
              <tr>
	          <th>ID/№ на МПС</th>
		      <th>Вид гуми</th>
		      <th>Дата на закупуване</th>
		      <th>Размер</th>
		      <th>Цена лв</th>
		      <th>Съхранявани в</th>
		      <th>Използваемост</th>
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
		      <td>$row[Type]</td>
		      <td>$row[Date]</td>
		      <td>$row[Size]</td>
		      <td>$row[Price]</td>
		      <td>$row[Saved_In]</td>
		      <td>$row[Usability]</td>
              <td>$_SESSION[subAdminUsername]</td>
              <td>$updateDate</td>
              </tr>
              <table>";
               $dataS = $dataS.$dataD;
              }
        
          
         $dataHD = $dataH.$dataS;
         $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
         file_put_contents('history/tyres_data_autos/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
            
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
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM tyres WHERE AutosID = '$_POST[AutosID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table border='2' style = 'margin-top: 7.0vw;'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
		<th bgcolor='$color1'>$h2 Вид гуми</th>
		<th bgcolor='$color1'>$h2 Дата на закупуване</th>
		<th bgcolor='$color1'>$h2 Размер</th>
		<th bgcolor='$color1'>$h2 Цена лв</th>
		<th bgcolor='$color1'>$h2 Съхранявани в</th>
		<th bgcolor='$color1'>$h2 Използваемост</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
	    echo "<tr>";
	    echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";  
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

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw;">Актуализиране на данни за гуми на МПС:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
	<p style = "margin-bottom: 0px;">Рег. №:</p><input type="text" name="Reg_Number" value = "<?php if(isset($_SESSION['Reg_Number_Global'])) echo $_SESSION['Reg_Number_Global']; else echo $Reg_Number;?>" style = "width:174px;" required="required" placeholder = "Задължително попълване">*
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  <br><br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        <tr>
            <input type="number" name="Tyres_ID" value = "<?php echo $tyresID;?>" style = "display: none;">
            <input type="number" name="AutosID" value = "<?php echo $AutosID;?>" style = "display: none;">
            <input type="text" name="Reg_Num" value = "<?php //echo $_SESSION['Reg_Number']; 
                                                               echo $Reg_Number;?>" style = "display: none;">
	        <td>Вид гуми*<br>
            <select name="Type" style = "width:174px; height: 27px;" required="required">
            <option value="<?php echo $Type;?>"><?php echo $Type;?></option>
            <option value="зимни">зимни</option>												
            <option value="летни">летни</option>
            <option value="всесезонни">всесезонни</option>
            </select></td>
            
            <td>Дата на закупуване*<br><input type="Date" value="<?php echo $Date;?>" name="Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Размер*<br><input type="text" value="<?php echo $Size;?>" name="Size" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Цена лв*<br><input type="text" value="<?php echo $Price;?>" name="Price" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Съхранявани в*<br><input type="text" value="<?php echo $Saved_In;?>" name="Saved_In" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Използваемост*<br>
            <select name="Usability" style = "width:174px; height: 27px;" required="required">
            <option value="<?php echo $Usability;?>"><?php echo $Usability;?></option>
            <option value="активни">активни</option>												
            <option value="неактивни">неактивни</option>
            </select></td>
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
unset($_SESSION['Reg_Number_Global']);
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
		  
</body>		  
</html>