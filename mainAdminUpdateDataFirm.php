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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

input {
    width: 190px;
}

</style>
</head>
<body onload = "toggleEnable()"> 

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

$Legalentity_ID = "";
//$Admin_Username = "";
//$Sub_Admin_Username = ""; 
$Name = ""; 
$EIK = "";
$DDS_Nomer = "";
$Address = ""; 
$Address_MPS = "";
$MOL_Names = "";
$Telephone = "";
$Email = "";
$Contact_Person =  ""; 
$Telephone_Contact_Person = ""; 
$Email_Contact_Person = ""; 
$Email_Username = "";
$Password = ""; 



if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    $messageError = "<h2>Моля попълнете полето!</h2>";
    $Legalentity_ID = $_POST["Legalentity_ID"];
    
      
      if(strlen($Legalentity_ID)==0)
    	
      {
        echo $messageError;
      }
      
      else if (!filter_var($Legalentity_ID, FILTER_VALIDATE_INT)) {
        
    	echo "<br>";
        echo"<br><br>";
    	echo"<div align = 'center'>";
    	echo'<span style="font-size: 20px; color:red; ">Въведете цяло число в полето "ID"!</span>';
        echo"</div>";	
    	
      } 
      
      else {   // if(filter_var($Nomer, FILTER_VALIDATE_INT)) {
    	  
    	$url_id = mysqli_real_escape_string($con, $_POST['Legalentity_ID']);
        $sql = "SELECT Legalentity_ID FROM legalentity WHERE Legalentity_ID='$url_id'";
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
      
        $result = mysqli_query($con, "SELECT * FROM legalentity
    	                      WHERE Legalentity_ID = '$_POST[Legalentity_ID]'");
    	if (!$result) {
    	
    	die('Грешка: ' . mysqli_error());
    	}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $Legalentity_ID = $row['Legalentity_ID'];
                //$Admin_Username = $row['Admin_Username'];
                //$Sub_Admin_Username = $row['Sub_Admin_Username'];
                $Name = $row['Name'];
                $EIK = $row['EIK'];
                $DDS_Nomer = $row['DDS_Nomer'];
                $Address = $row['Address']; 
                $Address_MPS = $row['Address_MPS'];
                $MOL_Names = $row['MOL_Names'];
                $Telephone = $row['Telephone'];
                $Email = $row['Email'];
                $Contact_Person =  $row['Contact_Person']; 
                $Telephone_Contact_Person = $row['Telephone_Contact_Person']; 
                $Email_Contact_Person = $row['Email_Contact_Person'];  
                $Email_Username = $row['Email_Username']; 
                $Password = $row['Password']; 
                $Holding_Name = $row['Holding_Name'];
                
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
    
        if(strlen($_POST['Holding_Name']) == 0) {
            
            if(strcmp($password, $checkPassword) != 0) {
              $message = "Паролите не съвпадат! Опитайте отново!";
  	          echo "<script>alert('$message');</script>";
            }
            else {
                
              $resultHistory = mysqli_query($con, "SELECT * FROM legalentity Where Legalentity_ID = '$_POST[Legalentity_ID]'");
                
              $zero1 = false; $one1 = false; $zero2 = false; $one2 = false;  
            
              $sqlUpdateUsernames ="UPDATE usernames SET username = '$_POST[Email_Username]' Where username = '$_SESSION[saveEmailUsername]'"; 
              
              $sqlUpdateFirm="UPDATE legalentity SET  
              Name = '$_POST[Name]', EIK = '$_POST[EIK]', DDS_Nomer = '$_POST[DDS_Nomer]', Address = '$_POST[Address]', Address_MPS = '$_POST[Address_MPS]',
              MOL_Names = '$_POST[MOL_Names]', Telephone = '$_POST[Telephone]', Email = '$_POST[Email]', Contact_Person = '$_POST[Contact_Person]', Telephone_Contact_Person = '$_POST[Telephone_Contact_Person]',
              Email_Contact_Person = '$_POST[Email_Contact_Person]', Email_Username = '$_POST[Email_Username]', Password = '$_POST[Password]'
              Where Legalentity_ID = '$_POST[Legalentity_ID]'";
            
              mysqli_autocommit($con, FALSE);
              mysqli_query($con,"START TRANSACTION");
              
              $update1 = mysqli_query($con, $sqlUpdateUsernames);
              if(mysqli_affected_rows($con) == 0) {
                  $zero1 = true;
              }
              if(mysqli_affected_rows($con) >= 0) {
                  $one1 = true;
              }
              
              $update2 = mysqli_query($con, $sqlUpdateFirm);
              if(mysqli_affected_rows($con) == 0) {
                  $zero2 = true;
              }
              if(mysqli_affected_rows($con) >= 0) {
                  $one2 = true;
              }
            
              //if ($update1 && mysqli_affected_rows($con) == 0 &&  $update2 && mysqli_affected_rows($con) == 0) {
              if($zero1 == true && $zero2 == true) {
               mysqli_commit($con);
   	           $message = "Няма промяна на данни!";
   	           echo "<script>alert('$message');</script>";
              } 
              //else if ($update1 && mysqli_affected_rows($con) >= 0 &&  $update2 && mysqli_affected_rows($con) == 1) {
              else if($one1 == true && $one2 == true) {
                  
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
                <td>$_SESSION[mainAdminUsername]</td>
                <td>$updateDate</td>
                </tr>
                <table>";
                 $dataS = $dataS.$dataD;
                }
                
                $dataHD = $dataH.$dataS;
                $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
                file_put_contents('history/legalentities/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
                
                mysqli_commit($con);
   	            $message = "Данните са актуализирани успешно!";
   	            echo "<script>alert('$message');</script>";
              }  
              else {  
               mysqli_rollback($con);
   	           $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име и/или на ЕИК!";
               echo "<script>alert('$message');</script>";
              }
              mysqli_query($con, "SET AUTOCOMMIT=TRUE");
        }
    }
    
    else {
        
        $resultHistory = mysqli_query($con, "SELECT * FROM legalentity Where Legalentity_ID = '$_POST[Legalentity_ID]'");
                
        $zero1 = false; $one1 = false; $zero2 = false; $one2 = false;  

        //$sqlUpdateUsernames ="UPDATE usernames SET username = '$_POST[Email_Username]' Where username = '$_SESSION[saveEmailUsername]'"; 
        
        $sqlUpdateFirm="UPDATE legalentity SET  
        Name = '$_POST[Name]', EIK = '$_POST[EIK]', DDS_Nomer = '$_POST[DDS_Nomer]', Address = '$_POST[Address]', Address_MPS = '$_POST[Address_MPS]',
        MOL_Names = '$_POST[MOL_Names]', Telephone = '$_POST[Telephone]', Email = '$_POST[Email]', Contact_Person = '$_POST[Contact_Person]', Telephone_Contact_Person = '$_POST[Telephone_Contact_Person]',
        Email_Contact_Person = '$_POST[Email_Contact_Person]'
        Where Legalentity_ID = '$_POST[Legalentity_ID]'";

        mysqli_autocommit($con, FALSE);
        mysqli_query($con,"START TRANSACTION");
        
        //$update1 = mysqli_query($con, $sqlUpdateUsernames);
        //if(mysqli_affected_rows($con) == 0) {
        //    $zero1 = true;
        //}
        //if(mysqli_affected_rows($con) >= 0) {
        //    $one1 = true;
        //}
        
        $update2 = mysqli_query($con, $sqlUpdateFirm);
        if(mysqli_affected_rows($con) == 0) {
            $zero2 = true;
        }
        if(mysqli_affected_rows($con) >= 0) {
            $one2 = true;
        }

        //if ($update1 && mysqli_affected_rows($con) == 0 &&  $update2 && mysqli_affected_rows($con) == 0) {
        if($zero2 == true) {
         mysqli_commit($con);
   	     $message = "Няма промяна на данни!";
   	     echo "<script>alert('$message');</script>";
        } 
        //else if ($update1 && mysqli_affected_rows($con) >= 0 &&  $update2 && mysqli_affected_rows($con) == 1) {
        else if($one2 == true) {
            
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
          <td>$_SESSION[mainAdminUsername]</td>
          <td>$updateDate</td>
          </tr>
          <table>";
           $dataS = $dataS.$dataD;
          }
          
          $dataHD = $dataH.$dataS;
          $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
          file_put_contents('history/legalentities/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
          
          mysqli_commit($con);
   	      $message = "Данните са актуализирани успешно!";
   	      echo "<script>alert('$message');</script>";
        }  
        else {  
         mysqli_rollback($con);
   	     $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име и/или на ЕИК!";
         echo "<script>alert('$message');</script>";
        }
        mysqli_query($con, "SET AUTOCOMMIT=TRUE");
        
    }
    
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$_POST[Legalentity_ID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table border='2' style = 'margin-top: 7.0vw;'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор Потреб. име</th>
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
	    <th bgcolor='$color1'>$h2 Имейл на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Имейл като потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    <th bgcolor='$color1'>$h2 Холдинг</th>
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
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
	    echo "<td>" . $row['Email_Username'] . "</td>";
	    echo "<td>" . $row['Password'] . "</td>";
	    echo "<td>" . $row['Holding_Name'] . "</td>";
	    echo "<td>" . $row['Date'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	
	}
      
      mysqli_close($con);
}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 6.0vw;">Актуализиране данни на юридическо лице:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <p id="demo" style = "margin-bottom: 0px;">ID на юридическо лице*</p><input id = "numRec" oninput="checkInput()" type="number" name="Legalentity_ID" value = "<?php echo $Legalentity_ID;?>" required="required" placeholder = "Задължително попълване">
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <input type="number" name="Legalentity_ID" value = "<?php echo $Legalentity_ID;?>" style = "display: none;">
	<br><br>
    <table class = "iDataInput">
        <tr>
            <td>Юридическо лице към холдинг<br>
                <input id = "lEntity" type = "text" name="Holding_Name"  value = "<?php echo $Holding_Name;?>" required="required" style = "width: 190px; height: 27px;" readonly>
                  <!--<option value="">Избери юридическо лице</option>
                  <option value="legalentity">юридическо лице</option>
                  <option value="holding">юридическо лице към холдинг</option>
                </select>-->
            </td>
            
	        <td>Име*<br><input type="text" name="Name" value = "<?php echo $Name;?>" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ЕИК*<br><input type="text" name="EIK" value = '<?php echo $EIK;?>' required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>ДДС номер*<br><input type="text" name="DDS_Nomer" value = '<?php echo $DDS_Nomer;?>' required="required" placeholder = "Задължително попълване"></td>
        
            <td>Адрес*<br><input type="text" name="Address" value = '<?php echo $Address;?>' required="required" placeholder = "Задължително попълване"></td>
            
            <td>Адрес на МПС*<br><input type="text" name="Address_MPS"value = '<?php echo $Address_MPS;?>' required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>МОЛ*<br><input type="text" name="MOL_Names" value = '<?php echo $MOL_Names;?>' required="required" placeholder = "Задължително попълване"></td>
        
            <td>Телефон*<br><input type="text" name="Telephone" value = "<?php echo $Telephone;?>"required="required" placeholder = "Задължително попълване"></td>
            
            <td>Имейл*<br><input type="email" name="Email" value = '<?php echo $Email;?>' required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Лице за контакти*<br><input type="text" name="Contact_Person" value = "<?php echo $Contact_Person;?>" required="required" placeholder = "Задължително попълване"></td>
        
	        <td>Тел. на лице за контакти*<br><input type="text" name="Telephone_Contact_Person" value = "<?php echo $Telephone_Contact_Person;?>" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Имейл на лице за контакти:<br><input type="text" name="Email_Contact_Person" value = "<?php echo $Email_Contact_Person;?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Потребителско име*<br><input id = "uName" type="email" name="Email_Username" value = "<?php echo $Email_Username;?>" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Парола*<br><input id = "psw1" type="password" name="Password" value = "<?php echo $Password;?>" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Парола потвърждаване* <br><input id = "psw2" type="password" name="checkPassword" value = "<?php echo $Password;?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;"></td>
            <td></td>
        </tr>
    </table>
  </form>

<br>  
</div>	  
<script>

function toggleEnable() {
        
        var legalValue = document.getElementById('lEntity').value;
        
        if(legalValue.localeCompare('') == 0) {
            document.getElementById('uName').disabled = false;
            document.getElementById('psw1').disabled = false;
            document.getElementById('psw2').disabled = false;
        }
        //else if(legalValue.localeCompare('') != 0){
        else {    
            document.getElementById('uName').disabled = true;
            document.getElementById('psw1').disabled = true;
            document.getElementById('psw2').disabled = true;
        }
        //else {
        //    
        //    document.getElementById('uName').disabled = false;
        //    document.getElementById('psw1').disabled = false;
        //    document.getElementById('psw2').disabled = false;
        //    document.getElementById('hName').disabled = false;
        //    document.getElementById('hName').style.color = "black";
        //    document.getElementById('hName').style.backgroundColor = "white";
        //}
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
		  
</body>		  
</html>