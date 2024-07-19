<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['subAdminUsername'])) {
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
      $("#subAdminNav").load("subAdminNav.php"); 
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

<div id = "subAdminNav"></div>

<br>

<div align = "center">

 
<?php

include 'functions.php';

$_SESSION['valueMAT'] = 1;
$_SESSION['valueGO'] = 0;
$_SESSION['valueGTP'] = 0;
$_SESSION['valueKasko'] = 0;
$_SESSION['valueVinetka'] = 0;
$_SESSION['valueOther'] = 0;
$_SESSION['valueTP'] = 1;
$_SESSION['valueTP1'] = 1;
$_SESSION['valueTP2'] = 1;
$_SESSION['valueTP3'] = 1;

$_SESSION['lastInsertAutoFirmID'] = 0;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$subAdminUsername = $_SESSION['subAdminUsername'];


?>

  <h3 style = "margin-top: 7.0vw;">Запис на данни за юридическо лице</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        
        <input type="email" name="Admin_Username"  value = "<?php echo $_SESSION['adminUserName']; ?>" style = "display: none;"/>
        <input type="email" name="Sub_Admin_Username" value = "<?php echo $_SESSION['subAdminUsername']; ?>" style = "display: none;" />
	    <tr> 
	    
	        <td>Избери юридическо лице*<br>
                <select id = "lEntity" name="Legalentity"  onchange="toggleEnable()" required="required" style = "width: 174px; height: 27px;">
                     <option value="">Избери юридическо лице</option>
                     <option value="legalentity">юридическо лице</option>
                     <option value="holding">юридическо лице към холдинг</option>
                </select></td>
            
            <td>Име*<br><input type="text" name="Name" required="required" placeholder = "Задължително попълване"/></td>
            
            <td>ЕИК*<br><input type="text" name="EIK" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td>ДДС номер*<br><input type="text" name="DDS_Nomer" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Адрес*<br><input type="text" name="Address" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Адрес на МПС*<br><input type="text" name="Address_MPS" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>МОЛ - три имена*<br><input type="text" name="MOL_Names" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Телефон*<br><input type="text" name="Telephone" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Имейл*<br><input type="email" name="Email" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Лице за контакти*<br><input type="text" name="Contact_Person" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Тел. на лице за контакти*<br><input type="text" name="Telephone_Contact_Person" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Емейл на лице за контакти*<br><input type="email" name="Email_Contact_Person" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td>Имейл за потребителско име*<br><input id = "uName" type="email" name="Username" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Парола*<br><input id = "psw1" type="password" name="Password"  required="required" placeholder = "Задължително попълване"></td>
            
            <td>Парола повторно въвеждане*<br><input id = "psw2" type="password" name="checkPassword" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td></td>
            
            <td>Избери холдинг*<br>
                <select id = "hName" name="Holding_Name" style = "width: 174px; height: 27px;" required="required" placeholder = "Задължително попълване"/>
                  <option value="">Избери холдинг</option>
                  <?php
                      $con = connectServer();
                      $query = "SELECT * FROM holding WHERE Sub_Admin_Username = '$_SESSION[subAdminUsername]'";
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
                
            <td></td>
        </tr>
    </table> 
    <br><br>
    <input type="submit" name="btnSave" value="Запис" style = "border-radius: 2px; color: red; width: 27%;">  
  </form>
  <br><br>
  
<button id = "showAutoData" onclick = "showAutoData()" style = "border-radius: 2px; color: red; width: 27%;">Покажи запис на данни на МПС на юридическо лице</button>
<button id = "hideAutoData" onclick = "hideAutoData()" style = "border-radius: 2px; color: red; width: 27%; display: none;">Скрий запис на данни на МПС на юридическо лице</button>

<script>

    function toggleEnable() {
        
        var legalValue = document.getElementById('lEntity').value;
        
        if(legalValue.localeCompare('legalentity') == 0) {
            document.getElementById('hName').disabled = true;
            document.getElementById('hName').style.color = "grey";
            document.getElementById('hName').style.backgroundColor = "lightgrey";
            
            document.getElementById('uName').disabled = false;
            document.getElementById('psw1').disabled = false;
            document.getElementById('psw2').disabled = false;
        }
        else if(legalValue.localeCompare('holding') == 0){
            document.getElementById('hName').disabled = false;
            document.getElementById('hName').style.color = "black";
            document.getElementById('hName').style.backgroundColor = "white";
            
            document.getElementById('uName').disabled = true;
            document.getElementById('psw1').disabled = true;
            document.getElementById('psw2').disabled = true;
        }
        else {
            
            document.getElementById('uName').disabled = false;
            document.getElementById('psw1').disabled = false;
            document.getElementById('psw2').disabled = false;
            document.getElementById('hName').disabled = false;
            document.getElementById('hName').style.color = "black";
            document.getElementById('hName').style.backgroundColor = "white";
        }
    }
    
    function showAutoData() {
        $(document.getElementById("autoData")).toggle(1500); //.fadeIn("slow");
        document.getElementById('showAutoData').style.display = 'none';
        document.getElementById('hideAutoData').style.display = 'block';
          
    }
    function hideAutoData() {
        $(document.getElementById('autoData')).toggle(1500);  //.fadeOut("slow"); //.style.display = 'none';
        document.getElementById('showAutoData').style.display = 'block';
        document.getElementById('hideAutoData').style.display = 'none';
    }
</script>

<?php

//$address = "";
//$address_MPS = "";
$btnSave = false;
$btnSaveAuto = false;
$last_id = 0;

if(isset($_POST["btnSave"])) {
	$btnSave = true;
}
if(isset($_POST["btnSaveAuto"])) {
	$btnSaveAuto = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSave == true) {
    
    $con1 = connectServer();
    
    $subject = "Успешна регистрация на нов клиент в CarLife.bg";

    $comment = "Уважаеми " . $_POST['Contact_Person'] . ",
    
    Добре дошли в Carlife.bg. Вашата регистрация е успешна!
    
    Потребителско име: " . $_POST['Username'] . "
    Парола: " . $_POST['Password'] . "
    
    Напомняме Ви, че в акаунта си можете да качите и преглеждате всички данни, които искате да следим вместо Вас:
    
    - Голям/малък талон
    - ГО
    - Каско
    - Платен данък
    - Винетка
    - ГТП
    - Гуми - вид, марка, съхранение, размер, цена
    - Шофьорска книжка
    - Сервизна книжка
    - Задграничен паспорт
    
    Благодарим Ви, че ни се доверихте!
    
    
    Поздрави,
    Екипът на CarLife";
    
    mb_internal_encoding('UTF-8');
    $encoded_subject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n", strlen('Subject: '));
    
    $noReplyEmail = "no-reply@carlife.bg";
    $noReplyEmailPassword = "BioMio2020";
    $emailContactPerson = $_POST['Email_Contact_Person'];
    
    if(strlen($_POST['Holding_Name']) == 0) {
    
        $password = $_POST['Password'];
        $checkPassword = $_POST['checkPassword'];
        
        if(strcmp($password, $checkPassword) != 0) {
            $message = "Паролите не съвпадат! Опитайте отново!";
        	  echo "<script>alert('$message');</script>";
        }
        else {
            $sqlUsernameCheck = "INSERT INTO usernames (username)
            VALUES
            ('$_POST[Username]')";
    
            $sql="INSERT INTO legalentity (Admin_Username, Sub_Admin_Username, Name, EIK, DDS_Nomer, Address, Address_MPS, MOL_Names, Telephone, Email, Contact_Person, Telephone_Contact_Person, Email_Contact_Person, Email_Username, Password)
            VALUES
            ('$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Name]', '$_POST[EIK]', '$_POST[DDS_Nomer]', '$_POST[Address]', '$_POST[Address_MPS]', '$_POST[MOL_Names]', '$_POST[Telephone]', '$_POST[Email]', '$_POST[Contact_Person]', '$_POST[Telephone_Contact_Person]', '$_POST[Email_Contact_Person]', '$_POST[Username]', '$_POST[Password]')";
        
 // $address = $_POST['Address1'];
 // $address_MPS = $_POST['Address1_MPS'];
 
            mysqli_autocommit($con1, FALSE);
            mysqli_query($con1,"START TRANSACTION");
            
            if (mysqli_query($con1, $sqlUsernameCheck) && mysqli_affected_rows($con1) == 1 && mysqli_query($con1, $sql) && mysqli_affected_rows($con1) == 1) {
                $last_id = mysqli_insert_id($con1);
                mysqli_commit($con1);
             
                if (!filter_var($_POST['Email_Contact_Person'], FILTER_VALIDATE_EMAIL)) {
                   $emailErr = "Невалиден имейл адрес на лице за контакти!";
                   echo "<script>alert('$emailErr');</script>";
                }
	            else {  
	                $success = mail($emailContactPerson, $encoded_subject, $comment, "MIME-Version: 1.0" . "\r\n" . "Content-type: text/plain; charset=UTF-8" . "\r\n". "From:" . $noReplyEmail, $noReplyEmailPassword);
	                if (!$success) {
                        $errorMessage1 = error_get_last();
                        print_r($errorMessage1);
                        $errorMessage = "Данните са записани успешно! Неуспешно изпращане на имейл!";
                        echo "<script>alert('$errorMessage');</script>";
                        //mail($employeeEmail, $encoded_subject, $comment, "MIME-Version: 1.0" . "\r\n" . "Content-type: text/plain; charset=UTF-8" . "\r\n". "From:" . $bossEmail, $bossEmailPassword);
                    }
                    else {
                     
                        $message = "Данните са записани успешно!";
  	                    echo "<script>alert('$message');</script>"; 
                     
                    }
                }
            }  
            else {  
             mysqli_rollback($con1);
  	         $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име и/или на ЕИК!";
             echo "<script>alert('$message');</script>";
            }
            mysqli_query($con1, "SET AUTOCOMMIT=TRUE");
   
        }

    }
    else {
      
      $sql="INSERT INTO legalentity (Admin_Username, Sub_Admin_Username, Name, EIK, DDS_Nomer, Address, Address_MPS, MOL_Names, Telephone, Email, Contact_Person, Telephone_Contact_Person, Email_Contact_Person, Holding_Name)
      VALUES
      ('$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Name]', '$_POST[EIK]', '$_POST[DDS_Nomer]', '$_POST[Address]',
       '$_POST[Address_MPS]', '$_POST[MOL_Names]', '$_POST[Telephone]', '$_POST[Email]', '$_POST[Contact_Person]', 
       '$_POST[Telephone_Contact_Person]', '$_POST[Email_Contact_Person]', '$_POST[Holding_Name]')";
    
    
       mysqli_autocommit($con1, FALSE);
    
       if (mysqli_query($con1, $sql)) {
          $last_id = mysqli_insert_id($con1);
          mysqli_commit($con1);
    	  $message = "Данните са записани успешно!";
    	  echo "<script>alert('$message');</script>";
       }  
       else {  
          mysqli_rollback($con1);
    	  $message = "Възникна грешка, опитайте отново! Дублиране на ЕИК/ДДС номер!";
          echo "<script>alert('$message');</script>";
       }
       mysqli_query($con1, "SET AUTOCOMMIT=TRUE");
      
    }
    
    
mysqli_close($con1);

$con = connectServer();

$adminUsername = $_SESSION['adminUsername'];

$result = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = $last_id");

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

echo "<br><br><br><br>";


if($last_id > 0) {
	
  echo "<table border='2'>
    
  <tr>
  <th bgcolor='$color1'>$h2 №</th>
  
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
  <th bgcolor='$color1'>$h2 Потребителско име</th>
  <th bgcolor='$color1'>$h2 Парола</th>
  <th bgcolor='$color1'>$h2 Име холдинг</th>
  <th bgcolor='$color1'>$h2 Дата</th>
  </tr>";
  

  while($row = mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>" . $row['Legalentity_ID'] . "</td>";
    //echo "<td style='color:white;'>" . $row['Admin_Username'] . "</td>";
    //echo "<td>" . $row['Sub_Admin_Username'] . "</td>";  
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

<br><br>
  <form id = "autoData" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "display: none;">  
    <h3 style = "">Запис на данни на МПС:</h3>
    <table class = "iDataInput">
        <tr>
            <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
            <td>ID/№ на ю. лице*<br><input  type="number" name="Legalentity_ID" required="required" placeholder = "Задължително попълване"></td>
            
            <input type="email" name="Admin_Username"  value = "<?php echo $_SESSION['adminUserName']; ?>" style = "display: none;"/>
            <input type="email" name="Sub_Admin_Username" value = "<?php echo $_SESSION['subAdminUsername']; ?>" style = "display: none;" />
            
	        <td>Вид МПС*<br>    
            <select name="Type" onchange="typeMps(this.value)" style = "width:174px; height: 27px;" required="required">
	        <option value="">Избери вид МПС</option>
                        <?php
                            $con = connectServer();
                            $query = "SELECT Type_MPS FROM tariffplan";
                            $results=mysqli_query($con, $query);
                            //loop
                            foreach ($results as $tPlans){
                        ?>
                                <option value="<?php echo $tPlans['Type_MPS'];?>"><?php echo $tPlans['Type_MPS'];?></option>
                        <?php
                            }
                            mysqli_close($con);
                            
                        ?>
            </select></td>
        
            <td>Марка*<br><input type="text" name="Brand" required="required" placeholder = "Задължително попълване"  onkeypress="return (event.charCode == 32 || event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" /></td>
	    </tr>
        <tr>    
	        <td>Модел*<br><input type="text" name="Model" required="required" placeholder = "Задължително попълване"  onkeypress="return (event.charCode == 32 || event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" /></td>
            
	        <td>Рег. номер*<br><input type="text" name="RegNumber" required="required" placeholder = "Задължително попълване"></td>
        
	        <td>Купе*<br>    
	        <select name="Kupe" style = "width:174px; height: 27px;" required="required">
            <option value="седан">седан</option>												
            <option value="хечбек">хечбек</option>
            <option value="комби">комби</option>
            <option value="купе">купе</option>
	        <option value="кабрио">кабрио</option>
            <option value="пикап">пикап</option>
            <option value="ван">ван</option>
	        <option value="джип">джип</option>
            <option value="други">други</option>
            </select></td>
        </tr>
        <tr>    
	        <td>Шаси*<br><input type="text" name="Shasi" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Първа регистрация*<br><input type="Date" name="FirstReg" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
	        <td>Тегло кг*<br><input type="number" name="Weight" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
	        <td>Цвят*<br>    
	        <select name="Color" style = "width:174px; height: 27px;" required="required">
            <option value="бял">бял</option>												
            <option value="перла">перла</option>
            <option value="слонова кост">слонова кост</option>
            <option value="бежов">бежов</option>
	        <option value="графит">графит</option>
            <option value="сив">сив</option>
            <option value="сребрист">сребрист</option>
	        <option value="жълт">жълт</option>
            <option value="зелен">зелен</option>
	        <option value="златист">златист</option>
            <option value="кафяв">кафяв</option>
	        <option value="розов">розов</option>
            <option value="лилав">лилав</option>
	        <option value="светло зелен">светло зелен</option>
	        <option value="тъмно зелен">тъмно зелен</option>
            <option value="син">син</option>
            <option value="светло син ">светло син</option>
	        <option value="тъмно син">тъмно син</option>
            <option value="светло червен">светло червен</option>
	        <option value="червен">червен</option>
            <option value="тъмно червен">тъмно червен</option>
	        <option value="хамелеон">хамелеон</option>
            <option value="черен">черен</option>
            </select></td>
            
	        <td>Брой места*<br><input  type="number" name="Seats" required="required" placeholder = "Задължително попълване"></td>
        
	        <td>Кубатура*<br><input  type="number" name="Cubature" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
	        <td>Мощност в к.с.*<br><input  type="number" name="Power" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Двигател*<br>    
	        <select name="Engine" style = "width:174px; height: 27px;" required="required">*
            <option value="бензин">бензин</option>												
            <option value="дизел">дизел</option>
            <option value="газ">газ</option>
            <option value="метан">метан</option>
	        <option value="хибрид">хибрид</option>
            <option value="електрически">електрически</option>
            </select></td>
        
	        <td>Скоростна кутия*<br>    
	        <select name="Transmission" style = "width:174px; height: 27px;" required="required">
            <option value="ръчна">ръчна</option>												
            <option value="автоматична">автоматична</option>
            </select></td>
        </tr>
        <tr>    
	        <td>Гаранция*<br>    
	        <select name="Guarantee" style = "width:174px; height: 27px;" required="required">
            <option value="да">да</option>												
            <option value="не">не</option>
            </select></td>
            
	        <td>Гаранция до*<br><input type="date" name="GuaranteeDate" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
	        <td>Стойност на МПС лв*<br><input type="text" name="Price" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
	        <td>Адрес на домуване на МПС*<br><input type="text" name="Address_MPS" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Текущи километри*<br>
            <input type = "number" name = "Current_Km" required = "required" placeholder = "Въведете текущи километри" style = "width: 174px; height: 27px;"></td>
            
            <td>Шофьор име*<br><input  type="text" name="Driver_First_Name" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Шофьр фамилия*<br><input  type="text" name="Driver_Last_Name" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Шофьор телефонен №*<br><input  type="text" name="Driver_Phone_Number" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ТП*<br><select style = "width:174px; height: 26px;" name="TP"  required="required" onchange="tpF(this.value)">
            <option value="">Изберете тарифен план</option> 
            <option value="ТП1">ТП1</option>
            <option value="ТП2">ТП2</option>
            <option value="ТП3">ТП3</option>
            </select></td>
        </tr>
        <tr>    
            <td>ГО*<br><select name="GO"  style = "width:174px; height: 26px;" required="required" onchange="goF(this.value)">
	        <option value="">Избери ГО, да или не</option> 
            <option value="да">да</option>
            <option value="не">не</option>	
            </select></td>
	       
            <td>ГТП*<br><select name="GTP"  style = "width:174px; height: 26px;" required="required" onchange="gtpF(this.value)">
            <option value="">Избери ГТП, да или не</option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
        
            <td>Каско*<br><select name="Kasko"  style = "width:174px; height: 26px;" required="required" onchange="kaskoF(this.value)">
            <option value="">Избери Каско, да или не</option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	    </tr>
        <tr>    
	        <td>Винетка*<br><select name="Vinetka"  style = "width:174px; height: 26px;" required="required" onchange="vinetkaF(this.value)">
            <option value="">Избери Винетка, да или не</option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	        <br><br>
	        <td>Друго*<br><select name="Others"  style = "width:175px; height: 26px;" required="required" onchange="otherF(this.value)">
            <option value="">Избери Друго, да или не</option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	   
	        <!--МАТ: <br><select id = "mat" name="MAT" style = "width:174px; height: 26px;" required="required" >
            <option value=""></option>
            </select>
            <br><br>-->
            
            <td><fieldset id = "mat" >
            МАТ*<br><input type = "text"  name="MAT" value="<?php echo $mat;?>" style = "width:174px; height: 26px;" required="required" readonly>
            </fieldset></td>
            
        </tr>
    </table>
	<!--<select name="Address_MPS" style = "width:174px; height: 27px;" required="required">*
    <option value="<?php //echo $address; ?>"><?php //echo $address; ?></option>												
    <option value="<?php //echo $address_MPS; ?>"><?php //echo $address_MPS; ?></option>
    </select>-->
    <br><br>
    <input type="submit" name="btnSaveAuto" value="Запис" style = "border-radius: 2px; color: red; width: 27%;">  
  </form>
  <br>
  
  <button onclick = "location.href='subAdminInputDataAutoFirm.php'" style = "width: 27%; border-radius: 2px; color: red;">Въвеждане данни за застраховки и сервиз на МПС</button>
  <br><br>
  
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveAuto == true) {
  $con2 = connectServer();
  
  //$Individual_ID = 0;
  date_default_timezone_set('Bulgaria/Sofia');
  $Date_Current_Km = date('Y-m-d', time());
  
  $idCheck = mysqli_query($con2, "SELECT * FROM legalentity WHERE Legalentity_ID = $_POST[Legalentity_ID] 
                                  AND Admin_Username = '$_POST[Admin_Username]' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  $sqlInsertAuto = "INSERT INTO autos (Legalentity_ID, Admin_Username, Sub_Admin_Username, Type, Brand, Model, Reg_Number, Kupe, Shasi, First_Reg, Weight, Color, Seats, Cubature, Power, Engine, 
                                       Transmission, Guarantee, GuaranteeDate, Price, Address_MPS, Current_Km, Date_Current_Km, Driver_First_Name, Driver_Last_Name, Driver_Phone_Number, TP, GO, GTP, Kasko, Vinetka, Others, MAT)
  VALUES
  ('$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Type]', '$_POST[Brand]','$_POST[Model]', '$_POST[RegNumber]', '$_POST[Kupe]', 
   '$_POST[Shasi]', '$_POST[FirstReg]', '$_POST[Weight]', '$_POST[Color]', '$_POST[Seats]', '$_POST[Cubature]', '$_POST[Power]',
   '$_POST[Engine]', '$_POST[Transmission]', '$_POST[Guarantee]', '$_POST[GuaranteeDate]', '$_POST[Price]', '$_POST[Address_MPS]', '$_POST[Current_Km]', '$Date_Current_Km',
   '$_POST[Driver_First_Name]', '$_POST[Driver_Last_Name]', '$_POST[Driver_Phone_Number]',
   '$_POST[TP]', '$_POST[GO]', '$_POST[GTP]', '$_POST[Kasko]', '$_POST[Vinetka]', '$_POST[Others]', '$_POST[MAT]')";
  
  if(mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAuto) || mysqli_affected_rows($con2) == -1)
  {
    $message = "Възникна грешка, дублиране на регистрационен номер, грешно въведено ID или промяна в йерархията подаминистратор потребител!";
	echo "<script>alert('$message');</script>";
	die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
  }
  else
  {
    $_SESSION['lastInsertAutoFirmID'] = mysqli_insert_id($con2);
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
	echo "<script> location.replace('subAdminInputDataAutoFirm.php'); </script>";
  }
  
//}

mysqli_close($con2);
	
	
}
 
?>

<script>

function typeMps(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете вид МПС!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?q="+str, true);
  xhttp.send();
}

function goF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете ГО!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qGO="+str, true);
  xhttp.send();
}

function gtpF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете ГТП!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qGTP="+str, true);
  xhttp.send();
}

function tpF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете тарифен план!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qTP="+str, true);
  xhttp.send();
}

function kaskoF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете каско!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qKasko="+str, true);
  xhttp.send();
}

function vinetkaF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете винетка!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qVinetka="+str, true);
  xhttp.send();
}

function otherF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете друго!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qOther="+str, true);
  xhttp.send();
}
 
/*$("#user").keypress(function(event){
    var ew = event.which;
    if(ew == 32)
        return true;
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    return false;
});
*/

</script>

<br>
  
</div>  
</body>
</html>