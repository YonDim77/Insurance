<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
header('Location: index.php');
}

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
    
    text-align: center;
}

</style>
</head>
<body>  

<div id = "adminNav"></div>

<br> 

<?php

include 'functions.php';

$btnFillData = false;
$btnUpdate = false;
$adminUsername = $_SESSION['adminUsername'];

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

$Individual_ID = "";
$Sub_Admin_Username = ""; 
$Names = ""; 
$EGN = "";
$Address = ""; 
$Address_MPS = "";
$Telephone = "";
$Email = "";
$Contact_Person =  ""; 
$Telephone_Contact_Person = ""; 
$Email_Contact_Person = "";
$Driving_Licence_Date = "";
$Passport_Date = "";
$Email_Username = "";
$Password = ""; 



if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    $messageError = "<h2>Моля попълнете полето!</h2>";
    $Individual_ID = $_POST["Individual_ID"];
    
      
      if(strlen($Individual_ID)==0)
    	
      {
        echo $messageError;
      }
      
      else if (!filter_var($Individual_ID, FILTER_VALIDATE_INT)) {
        
    	echo "<br>";
        echo"<br><br>";
    	echo"<div align = 'center'>";
    	echo'<span style="font-size: 20px; color:red; ">Въведете цяло число в полето "ID"!</span>';
        echo"</div>";	
    	
      } 
      
      else {   // if(filter_var($Nomer, FILTER_VALIDATE_INT)) {
    	  
    	$url_id = mysqli_real_escape_string($con, $_POST['Individual_ID']);
        $sql = "SELECT Individual_ID FROM individual WHERE Individual_ID='$url_id' AND Admin_Username = '".$adminUsername."'";
        $result1 = mysqli_query($con, $sql);
    	
    	if(!mysqli_num_rows($result1) >0){
    		
    		//echo"<br><br>";
    	    //echo"<div align = 'center'>";
    	    $message = "Несъществуващо ID!";
		    echo "<script>alert('$message');</script>";
    		//echo '<span style="font-size: 20px; color:red; ">Несъществуващ номер на данни!</span>';
    		//echo"<br><br><br><br>";
            //echo"</div>";
    	} 
     
      
        else {
      
        $result = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID='$url_id' AND Admin_Username = '".$adminUsername."'");
    	if (!$result) {
    	
    	die('Грешка: ' . mysqli_error($con));
    	}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $Individual_ID = $row['Individual_ID'];
                $Sub_Admin_Username = $row['Sub_Admin_Username'];
                $Names = $row['Names'];
                $EGN = $row['EGN'];
                $Address = $row['Address']; 
                $Address_MPS = $row['Address_MPS'];
                $Telephone = $row['Telephone'];
                $Email = $row['Email'];
                $Contact_Person =  $row['Contact_Person']; 
                $Telephone_Contact_Person = $row['Telephone_Contact_Person']; 
                $Email_Contact_Person = $row['Email_Contact_Person'];
                $Driving_Licence_Date = $row['Driving_Licence_Date'];
                $Passport_Date = $row['Passport_Date'];
                $Email_Username = $row['Email_Username']; 
                $Password = $row['Password']; 
                
                $_SESSION['saveEmailUsername'] = $Email_Username;
    		}
    	}
	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con = connectServer();
      
      $password = $_POST['Password'];
      $checkPassword = $_POST['checkPassword'];
  
      if(strcmp($password, $checkPassword) != 0) {
        $message = "Паролите не съвпадат! Опитайте отново!";
  	    echo "<script>alert('$message');</script>";
      }
      else {
        
        $resultHistory = mysqli_query($con, "SELECT * FROM individual Where Individual_ID = '$_POST[Individual_ID]'");
        
        $sqlUpdateUsernames ="UPDATE usernames SET username = '$_POST[Email_Username]' Where username = '$_SESSION[saveEmailUsername]'"; 
        
        $sqlUpdateIndividual="UPDATE individual SET Sub_Admin_Username = '$_POST[Sub_Admin_Username]', 
        Names = '$_POST[Names]', EGN = '$_POST[EGN]', Address = '$_POST[Address]', Address_MPS = '$_POST[Address_MPS]',
        Telephone = '$_POST[Telephone]', Email = '$_POST[Email]', Contact_Person = '$_POST[Contact_Person]', Telephone_Contact_Person = '$_POST[Telephone_Contact_Person]',
        Email_Contact_Person = '$_POST[Email_Contact_Person]', Driving_Licence_Date = '$_POST[Driving_Licence_Date]', Passport_Date = '$_POST[Passport_Date]', Email_Username = '$_POST[Email_Username]', Password = '$_POST[Password]'
        Where Individual_ID = '$_POST[Individual_ID]'";
        
        mysqli_autocommit($con, FALSE);
        mysqli_query($con,"START TRANSACTION");
        $update1 = mysqli_query($con, $sqlUpdateUsernames);
        $update2 = mysqli_query($con, $sqlUpdateIndividual);
        
        if ($update1 && mysqli_affected_rows($con) == 0 &&  $update2 && mysqli_affected_rows($con) == 0) {
         mysqli_commit($con);
   	     $message = "Няма промяна на данни!";
   	     echo "<script>alert('$message');</script>";
        } 
        else if ($update1 && mysqli_affected_rows($con) >= 0 &&  $update2 && mysqli_affected_rows($con) == 1) {
            
          $nameFile = "Физическо_Лице_ЕГН:";
          $nameFile = $nameFile.$_POST['EGN'];
          $dataS = "";
          $dataH= "";
          $updateDate = date("d-m-Y");
          
          if (!file_exists('history/individuals/' . $nameFile . '.xls')) {
              $dataH= "<table>
              
              <tr>
	          <th>№</th>
	          <th>Подадминистратор Потреб. име</th>
	          <th>Потребител Потреб. име</th>
	          <th>Име и Фамилия</th>
	          <th>ЕГН</th>
	          <th>Адрес</th>
	          <th>Адрес на МПС</th>
	          <th>Телефон</th>
	          <th>Имейл</th>
	          <th>Лице за контакти</th>
	          <th>Тел. на лице за контакти</th>
	          <th>Имейл на лице за контакти</th>
	          <th>Шофьорска книжка срок</th>
	          <th>Задграничен паспорт срок</th>
	          <th>Имейл като потребителско име</th>
	          <th>Парола</th>
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
          <td>$row[Individual_ID]</td>
	      <td>$row[Admin_Username]</td>
	      <td>$row[Sub_Admin_Username]</td>
	      <td>$row[Names]</td>
	      <td>$row[EGN]</td>
	      <td>$row[Address]</td>
	      <td>$row[Address_MPS]</td>
	      <td>$row[Telephone]</td>
	      <td>$row[Email]</td>
	      <td>$row[Contact_Person]</td>
	      <td>$row[Telephone_Contact_Person]</td>
	      <td>$row[Email_Contact_Person]</td>
	      <td>$row[Driving_Licence_Date]</td>
	      <td>$row[Passport_Date]</td>
	      <td>$row[Email_Username]</td>
	      <td>$row[Password]</td>
	      <td>$row[Date]</td>
          <td>$_SESSION[adminUsername]</td>
          <td>$updateDate</td>
          </tr>
          <table>";
           $dataS = $dataS.$dataD;
          }
          
          $dataHD = $dataH.$dataS;
          $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
          file_put_contents('history/individuals/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
            
         mysqli_commit($con);
   	     $message = "Данните са актуализирани успешно!";
   	     echo "<script>alert('$message');</script>";
        }  
        else {  
         mysqli_rollback($con);
   	     $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име и/или на ЕГН!";
         echo "<script>alert('$message');</script>";
        }
        mysqli_query($con, "SET AUTOCOMMIT=TRUE");
      }
      
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$_POST[Individual_ID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table border='2' style = 'margin-top: 7.0vw;'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	    <th bgcolor='$color1'>$h2 Име и Фамилия</th>
	    <th bgcolor='$color1'>$h2 ЕГН</th>
	    <th bgcolor='$color1'>$h2 Адрес</th>
	    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	    <th bgcolor='$color1'>$h2 Телефон</th>
	    <th bgcolor='$color1'>$h2 Имейл</th>
	    <th bgcolor='$color1'>$h2 Лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Имейл на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Шофьорска книжка срок</th>
	    <th bgcolor='$color1'>$h2 Задграничен паспорт срок</th>
	    <th bgcolor='$color1'>$h2 Имейл като потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
	    echo "<tr>";
	    echo "<td>" . $row['Individual_ID'] . "</td>";
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
	    echo "<td>" . $row['Passport_Date'] . "</td>";
	    echo "<td>" . $row['Email_Username'] . "</td>";
	    echo "<td>" . $row['Password'] . "</td>"; 
	    echo "</tr>";
	    }
	    echo "</table>";
	
	}
      
      mysqli_close($con);
	}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw;">Актуализиране данни на физическо лице:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <p id="demo" style = "margin-bottom: 0px;">ID*</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  <br><br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        <tr>
            <input type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" style = "display: none;">
	        
            <td>Потребител*<br><input type="email" name="Sub_Admin_Username" value = "<?php echo $Sub_Admin_Username;?>" required="required" readonly></td>
            
	        <td>Име и фамилия*<br><input type="text" name="Names" value = "<?php echo $Names;?>" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ЕГН*<br><input type="text" name="EGN" value = '<?php echo $EGN;?>' required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Адрес*<br><input type="text" name="Address" value = '<?php echo $Address;?>' required="required" placeholder = "Задължително попълване"></td>
        
            <td>Адрес на МПС*<br><input type="text" name="Address_MPS"value = '<?php echo $Address_MPS;?>' required="required" placeholder = "Задължително попълване"></td>
            
            <td>Телефон*<br><input type="text" name="Telephone" value = "<?php echo $Telephone;?>"required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Имейл*<br><input type="email" name="Email" value = '<?php echo $Email;?>' required="required" placeholder = "Задължително попълване"></td>
            
            <td>Лице за контакти*<br><input type="text" name="Contact_Person" value = "<?php echo $Contact_Person;?>" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Тел. на лице за контакти*<br><input type="text" name="Telephone_Contact_Person" value = "<?php echo $Telephone_Contact_Person;?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td>Имейл на лице за контакти*<br><input type="email" name="Email_Contact_Person" value = "<?php echo $Email_Contact_Person;?>" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Шофьорска книжка срок*<br><input type="date" name="Driving_Licence_Date" value = "<?php echo $Driving_Licence_Date;?>" required="required" style = "width: 174px;"></td>
            
            <td>Задграничен паспорт срок<br><input type="date" name="Passport_Date" value = "<?php echo $Passport_Date;?>" style = "width: 174px;"></td>
        </tr>
        <tr> 
            <td>Потребителско име*<br><input type="email" name="Email_Username" value = "<?php echo $Email_Username;?>" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Парола*<br><input type="password" name="Password" value = "<?php echo $Password;?>" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Парола повторно въвеждане*<br><input type="password" name="checkPassword" value = "<?php echo $Password;?>" required="required" placeholder = "Задължително попълване"></td>
            
        </tr>
        <td></td>
            <td><br><input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;"></td>
            <td></td>
    </table>
      
  </form>
  
</div>	  
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