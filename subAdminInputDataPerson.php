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
    
  <h3 style = "margin-top: 7.0vw;">Запис на данни за физическо лице.</h3>
   <br>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        <tr>
            <input type="text" name="Admin_Username" value = "<?php echo $_SESSION['adminUserName']; ?>" style = "display: none;">
	        <input type="text" name="Sub_Admin_Username" value = "<?php echo $_SESSION['subAdminUsername']; ?>" style = "display: none;">
            
            <td>Име и фамилия*<br><input type="text" name="Ime_Familia" required="required" placeholder = "Задължително попълване"/></td>
            
            <td>ЕГН*<br><input type="text" name="EGN" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Адрес*<br><input type="text" name="Address" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Адрес на МПС*<br><input type="text" name="Address_MPS" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Телефон*<br><input type="text" name="Telephone" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Имейл*<br><input type="text" name="Email" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Лице за контакти*<br><input type="text" name="Contact_Person" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Тел. на лице за контакти*<br><input type="text" name="Telephone_Contact_Person" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Емейл на лице за контакти*<br><input type="text" name="Email_Contact_Person" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Шофьорска книжка срок*<br><input type="date" name="Driving_Licence_Date" required="required" style = "width: 174px;"></td>
            
	        <td>Задграничен паспорт срок<br><input type="date" name="Passport_Date" style = "width: 174px;"></td>
	        
	        <td>Потребителско име*<br><input type="text" name="Username" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Парола*<br><input type="password" name="Password" required="required" placeholder = "Задължително попълване"></td> 
            <td></td>
            <td>Парола повторно въвеждане*<br><input type="password" name="checkPassword" required="required" placeholder = "Задължително попълване"></td>
        </tr>
    </table>
    <br><br>
    <input type="submit" name="btnSave" value="Запис" style = "width: 27%; border-radius: 2px; color: red;">
  </form>
  <br><br>
  
<button id = "showAutoData" onclick = "showAutoData()" style = "border-radius: 2px; color: red; width: 27%;">Покажи запис на данни на МПС на физическо лице</button>
<button id = "hideAutoData" onclick = "hideAutoData()" style = "border-radius: 2px; color: red; width: 27%; display: none;">Скрий запис на данни на МПС на физическо лице</button>
<br>
<script>
    function showAutoData() {
        $(document.getElementById("autoData")).toggle(1500);
        document.getElementById('showAutoData').style.display = 'none';
        document.getElementById('hideAutoData').style.display = 'block';
    }
    function hideAutoData() {
        $(document.getElementById('autoData')).toggle(1500);
        document.getElementById('showAutoData').style.display = 'block';
        document.getElementById('hideAutoData').style.display = 'none';
    }
</script> 
 
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

$_SESSION['lastInsertAutoID'] = 0;
$adminUsername = $_SESSION['adminUserName'];

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

  $con = connectServer();
  
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
    
    $sql="INSERT INTO individual (Admin_Username, Sub_Admin_Username, Names, EGN, Address, Address_MPS, Telephone, Email, Contact_Person, Telephone_Contact_Person, Email_Contact_Person, Driving_Licence_Date, Passport_Date, Email_Username, Password)
    VALUES
    ('$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Ime_Familia]','$_POST[EGN]', '$_POST[Address]','$_POST[Address_MPS]', '$_POST[Telephone]', '$_POST[Email]', '$_POST[Contact_Person]', '$_POST[Telephone_Contact_Person]', '$_POST[Email_Contact_Person]', '$_POST[Driving_Licence_Date]', '$_POST[Passport_Date]', '$_POST[Username]', '$_POST[Password]')";
    
    
    mysqli_autocommit($con, FALSE);
  
     if (mysqli_query($con, $sqlUsernameCheck) && mysqli_query($con, $sql)) {
      $last_id = mysqli_insert_id($con);
      mysqli_commit($con);
      
      
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
      mysqli_rollback($con);
  	$message = "Възникна грешка, опитайте отново! Дублиране на потребителско име и/или на ЕГН!";
      echo "<script>alert('$message');</script>";
     }
     mysqli_query($con, "SET AUTOCOMMIT=TRUE");
   
  }
  

//mysqli_close($con);

//$con = connectServer();

//$adminUsername = $_SESSION['adminUsername'];

$result = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = $last_id");

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

echo "<br><br><br><br>";
if($last_id > 0){
  echo "<table border='2'>
  
  
  <tr>
  <th bgcolor='$color1'>$h2 №</th>
  <th bgcolor='$color1'>$h2 Име и Фамилия</th>
  <th bgcolor='$color1'>$h2 ЕГН</th>
  <th bgcolor='$color1'>$h2 Адрес</th>
  <th bgcolor='$color1'>$h2 Адрес на МПС</th>
  <th bgcolor='$color1'>$h2 Телефон</th>
  <th bgcolor='$color1'>$h2 Имейл</th>
  <th bgcolor='$color1'>$h2 Лице за контакти</th>
  <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
  <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
  <th bgcolor='$color1'>$h2 Шофьорска книжка срок</th>
  <th bgcolor='$color1'>$h2 Задграничен паспорт срок</th>
  <th bgcolor='$color1'>$h2 Потребителско име</th>
  <th bgcolor='$color1'>$h2 Парола</th>
  </tr>";
}

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Individual_ID'] . "</td>";
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


mysqli_close($con);
	
	
}
 
?>


  <form id = "autoData" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "display: none;">  
    <h3 style = "">Запис на данни на МПС</h3><br>
	
    <table class = "iDataInput">
        <tr>
            <td>ID/№ на ф. лице*<br><input  type="number" name="Individual_ID" required="required" placeholder = "Задължително попълване"></td>
            
            <input type="text" name="Admin_Username" value = "<?php echo $_SESSION['adminUserName']; ?>" style = "display: none;">
	        <input type="text" name="Sub_Admin_Username" value = "<?php echo $_SESSION['subAdminUsername']; ?>" style = "display: none;">          
            
	        <td>Избери вид МПС*<br>    
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
            
	        <td>Рег. номер: <br><input type="text" name="RegNumber" required="required" placeholder = "Задължително попълване"></td>
        
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
	        <select name="Engine" style = "width:174px; height: 27px;" required="required">
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
        
           <td> Каско*<br><select name="Kasko"  style = "width:174px; height: 26px;" required="required" onchange="kaskoF(this.value)">
            <option value="">Избери Каско, да или не</option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	    </tr>
        <tr>    
	        <td>Винетка* <br><select name="Vinetka"  style = "width:174px; height: 26px;" required="required" onchange="vinetkaF(this.value)">
            <option value="">Избери Винетка, да или не</option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	        
	       <td> Друго*<br><select name="Others"  style = "width:174px; height: 26px;" required="required" onchange="otherF(this.value)">
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
    <br><br>
    <input type="submit" name="btnSaveAuto" value="Запис" style = "border-radius: 2px; color: red; width: 27%;">  
  </form>
  <br><br>
  
  <button onclick = "location.href='subAdminInputDataAutoPerson.php'" style = "border-radius: 2px; color: red; width: 27%;">Въвеждане данни за застраховки и сервиз на МПС</button>
  <br><br>
  
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveAuto == true) {
  $con2 = connectServer();
  
  //$Legalentity_ID = 0;
  date_default_timezone_set('Bulgaria/Sofia');
  $Date_Current_Km = date('Y-m-d', time());
   
  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID] 
                                  AND Admin_Username = '".$adminUsername."' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  $sqlInsertAuto = "INSERT INTO autos (Individual_ID, Admin_Username, Sub_Admin_Username, Type, Brand, Model, Reg_Number, Kupe, Shasi, First_Reg, Weight, Color, Seats, Cubature, Power, Engine, 
                                       Transmission, Guarantee, GuaranteeDate, Price, Address_MPS, Current_Km, Date_Current_Km, TP, GO, GTP, Kasko, Vinetka, Others, MAT)
  VALUES
  ('$_POST[Individual_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Type]', '$_POST[Brand]','$_POST[Model]', '$_POST[RegNumber]', '$_POST[Kupe]', 
   '$_POST[Shasi]', '$_POST[FirstReg]', '$_POST[Weight]', '$_POST[Color]', '$_POST[Seats]', '$_POST[Cubature]', '$_POST[Power]',
   '$_POST[Engine]', '$_POST[Transmission]', '$_POST[Guarantee]', '$_POST[GuaranteeDate]', '$_POST[Price]', '$_POST[Address_MPS]', '$_POST[Current_Km]', '$Date_Current_Km',
   '$_POST[TP]', '$_POST[GO]', '$_POST[GTP]', '$_POST[Kasko]', '$_POST[Vinetka]', '$_POST[Others]', '$_POST[MAT]')";
  
  if(mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAuto) || mysqli_affected_rows($con2) == -1)
  {
    $message = "Възникна грешка, дублиране на регистрационен номер, грешно въведено ID!";
	echo "<script>alert('$message');</script>";
	die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
  }
  else
  {
    $_SESSION['lastInsertAutoID'] = mysqli_insert_id($con2);
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
	echo "<script> location.replace('subAdminInputDataAutoPerson.php'); </script>";
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


</script>

<br>
  
</div>  
</body>
</html>