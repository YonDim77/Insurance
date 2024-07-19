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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="Insurance/startCss.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="adminCss.css">

<script> 

    $(function(){
      $("#nav").load("nav.php"); 
    });
    
</script>

<style>

/*@import url('startCss.css');*/
@media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
}

body{
margin: 0;
padding: 0;
font-family: sans-serif;
background: #f2e6ff;
}

.menu {
  width: 150px;
  z-index: 1;
  box-shadow: 0 4px 5px 3px rgba(0, 0, 0, 0.2);
  position: fixed;
  display: none;
  transition: 0.2s display ease-in;
  background-color: white;
}
.menu .menu-options {
  list-style: none;
  padding: 10px 0;
  z-index: 1;
}
.menu .menu-options .menu-option {
  font-weight: 500;
  z-index: 1;
  font-size: 14px;
  padding: 5px 20px 5px 20px;
  cursor: pointer;
}
.menu .menu-options .menu-option:hover {
  background: rgba(0, 0, 0, 0.2);
  
}

a:link {
    background-color: transparent; 
    text-decoration: none;
}

.dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
    top:0;
    left:100%;
    margin-top:-6px;
    margin-left:-1px;
    -webkit-border-radius:0 6px 6px 6px;
    -moz-border-radius:0 6px 6px 6px;
    border-radius:0 6px 6px 6px;
}
.dropdown-submenu>a:after {
    display:block;
    content:" ";
    float:right;
    width:0;
    height:0;
    border-color:transparent;
    border-style:solid;
    border-width:5px 0 5px 5px;
    border-left-color:#cccccc;
    margin-top:5px;
    margin-right:var(--my-margin-var);
}
.dropdown-submenu:hover>a:after {
    border-left-color:#555;
}
.dropdown-submenu.pull-left {
    float:none;
}
.dropdown-submenu.pull-left>.dropdown-menu {
    left:-100%;
    margin-left:10px;
    -webkit-border-radius:6px 0 6px 6px;
    -moz-border-radius:6px 0 6px 6px;
    border-radius:6px 0 6px 6px;
}

.navbar {
     
      border-radius: 0;
	  z-index:99;
	  
}

.navbar .navbar-nav a {
    padding: 22px 15px 27px 15px;
    font-size: 18px;
}
.navbar .dropdown-menu a {
    padding: 5px 10px 5px 10px;
    font-size: 14px;
}

.navbar-header img{
    margin-top: 10px;
}

@media screen and (min-width: 1350px) {
    .navbar-inverse {
        margin-top:0px; height: 70px; position: fixed; width: 100%;
    }
    ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;    
    }
}


@media (min-width: 768px) and (max-width: 1350px) {
    
    .navbar-header {
          float: none;
          
      }
      .navbar-toggle {
          display: block;
          margin-bottom: 17px;
          
      }
      
      .navbar-collapse {
          border-top: 1px solid transparent;
          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
          
      }
      .navbar-collapse.collapse {
          display: none!important;
      }
      .navbar-collapse.collapse.in {
          display: block!important;
          
      }
      .navbar-nav {
          float: none!important;
          margin: 7.5px -30px;
          
      }
      .navbar-nav>li {
          float: none;
          
      }
      .navbar-nav>li>a {
          padding-top: 10px;
          padding-bottom: 10px;
          
      }
      /*ul.nav a:hover { color: red !important; }*/
 
} 

 @media (max-width: 768px) {
     .navbar-nav {
       float: none!important;
       margin: 7.5px -20px;
     
   }
 }

table, th, td {
    text-align: center;
    color: black;
    
}


h3 {
    text-align: center;
    color: black;
}


</style>
</head>
<body>  

<div id = "nav"></div>

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

$_SESSION['lastInsertAutoID'] = 0;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}


$con = connectServer();

$mainAdminUsername = $_SESSION['username'];

$result = mysqli_query($con, "SELECT * FROM subadmin");

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

echo "<br><br><br><br>";
echo"<h3>Списък с потребители:</h3>";

echo "<br><br>";
if (mysqli_num_rows($result) > 0) {
  echo "<table border='2'>
  
  
  <tr>
  <th bgcolor='$color1'>$h2 №</th>
  <th bgcolor='$color1'>$h2 Подаминистратор потребителско име</th>
  <th bgcolor='$color1'>$h2 Име</th>
  <th bgcolor='$color1'>$h2 Фамилия</th>
  <th bgcolor='$color1'>$h2 Имейл</th>
  <th bgcolor='$color1'>$h2 Потребителско име</th>
  <th bgcolor='$color1'>$h2 Парола</th>
  </tr>";
}

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td style = 'border: 1px solid black;'>" . $row['ID'] . "</td>";
  echo "<td style = 'border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";	
  echo "<td style = 'border: 1px solid black;'>" . $row['fName'] . "</td>";
  echo "<td style = 'border: 1px solid black;'>" . $row['lName'] . "</td>";
  echo "<td style = 'border: 1px solid black;'>" . $row['Email'] . "</td>";
  echo "<td style = 'border: 1px solid black;'>" . $row['username'] . "</td>";
  echo "<td style = 'border: 1px solid black;'>" . $row['password'] . "</td>"; 
  echo "</tr>";
  }
echo "</table>";


mysqli_close($con);

?>

</div>

<script>

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

</script>

<!--<div class = "container-fluid">
    <div class = "row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">-->
        <div align = "center">    
            <br>
            <h3>Запис на данни за физическо лице</h3>
            <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
              <table class = "iDataInput">
              <tr>
            	<td>Избери подадмин<br><select style = "width: 174px; height: 27px;" name="Admin_Username"  onchange="showSubAdmin(this.value)" required="required">
                    <option value="">Избери подадмин*</option>
                          <?php
                              $con = connectServer();
                              $query = "SELECT * FROM admin";
                              $results=mysqli_query($con, $query);
                              //loop
                              foreach ($results as $admins){
                          ?>
                                  <option value="<?php echo $admins['username'];?>"><?php echo $admins['username'];?></option>
                          <?php
                              }
                              mysqli_close($con);
                              
                          ?>
                  
                    </select>
                </td>
                <td>Избери потребител<br><select  id="subAdminValue" style = "width: 174px; height: 27px;" name="Sub_Admin_Username" required="required">
                <option value="">Избери потребител*</option>
                </select></td>
                
                <td>Име и фамилия<br><input type="text" name="Ime_Familia" required="required" placeholder = "Име и фамилия"/>*</td>
                </tr>
                <tr>
                <td>ЕГН<br><input type="text" name="EGN" maxlength="10" required="required" placeholder = "ЕГН*">*</td>
                
                <td>Адрес<br><input type="text" name="Address" required="required" placeholder = "Адрес*">*</td>
                
                <td>Адрес на МПС<br><input type="text" name="Address_MPS" required="required" placeholder = "Адрес на МПС*">*</td>
                </tr>
                <tr>
                <td>Телефон<br><input type="text" name="Telephone" required="required" placeholder = "Телефон*">*</td>
                
                <td>Имейл<br><input type="email" name="Email" required="required" placeholder = "Имейл*">*</td>
                
                <td>Лице за контакти<br><input type="text" name="Contact_Person" required="required" placeholder = "Лице за контакти*">*</td>
                </tr>
                <tr>
                <td>Тел. на лице за контакти<br><input type="text" name="Telephone_Contact_Person" required="required" placeholder = "Тел. на лице за контакти*">*</td>
                
                <td>@-л на лице за контакти<br><input type="email" name="Email_Contact_Person" required="required" placeholder = "@-л на лице за контакти*">*</td>
                
                <td>Шофьорска книжка срок<br><input type="date" name="Driving_Licence_Date" required="required" style = "width: 174px;">*</td>
                </tr>
                <tr>
                <td>Задграничен паспорт срок<br><input type="date" name="Passport_Date" style = "width: 174px;"></td>
                
                <td>Потребителско име<br><input type="email" name="Username" required="required">*</td>
                
                <td>Парола<br><input type="password" name="Password"  required="required" placeholder = "Парола*">*</td>
               
                </tr>
                <tr>
                <td></td>
                <td>Парола повторно въвеждане<br><input type="password" name="checkPassword" required="required" placeholder = "Парола повторно въвеждане*">*</td>
                <td></td>
                </tr>
              </table>
              <br><br>
              <input type="submit" name="btnSave" value="Запис" style = "border-radius: 2px; color: red; width: 30%;">
            </form>
            <br><br>
            
            
            <button id = "showMpsData" onclick = "showMpsData()" style = "border-radius: 2px; color: red; width: 30%;">Покажи запис на данни на МПС</button>
            <button id = "hideMpsData" onclick = "hideMpsData()" style = "border-radius: 2px; color: red; width: 30%; display: none;">Скрий запис на данни на МПС</button>
            <br><br>
<script>
    function showMpsData() {
        $(document.getElementById('mpsData')).toggle(1500); //.style.display = 'block';
        document.getElementById('showMpsData').style.display = 'none';
        document.getElementById('hideMpsData').style.display = 'block';
    }
    function hideMpsData() {
        $(document.getElementById('mpsData')).toggle(1500); //.style.display = 'none';
        document.getElementById('showMpsData').style.display = 'block';
        document.getElementById('hideMpsData').style.display = 'none';
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
    ('$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Ime_Familia]','$_POST[EGN]', '$_POST[Address]','$_POST[Address_MPS]', 
     '$_POST[Telephone]', '$_POST[Email]', '$_POST[Contact_Person]', '$_POST[Telephone_Contact_Person]', '$_POST[Email_Contact_Person]', '$_POST[Driving_Licence_Date]', '$_POST[Passport_Date]', '$_POST[Username]', '$_POST[Password]')";
  
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
  	  $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име и/или на ЕГН!";
      echo "<script>alert('$message');</script>";
     }
     mysqli_query($con1, "SET AUTOCOMMIT=TRUE");
   
  }

/*  if(!mysql_query($sqlUsernameCheck,$con))
  {
    //die('<b>Възникна грешка, опитайте отново!</b>: ' . mysql_error());
	echo"<br><br>";
	echo"<div align = 'center'>";
    echo '<span style="font-size: 20px; color:black;">Възникна грешка, опитайте отново! Дублиране на потребителско име!</span>'; // . " " .
	//'<span style="font-size: 20px; color:' . $ColorW . '">' .$userName . '</span>';
	echo"</div>";
  }
  
  else{
	  
    if(!mysql_query($sql,$con))
    {
      die('<b>Възникна грешка, опитайте отново!</b>: ' . mysql_error());
    }
    else
    {
	  $last_id = mysql_insert_id($con);  
	  echo"<div align = 'center'>";
	  echo"<span style='color:white; font-size: 20px;'>Данните са записани успешно!</span>";
	  echo"</div>";
    }
  
}
*/
mysqli_close($con1);


$con = connectServer();

$adminUsername = $_SESSION['username'];

$result = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = $last_id");

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

echo "<br><br><br><br>";


if($last_id > 0) {
	
  echo "<table border='2'>
    
  <tr>
  <th bgcolor='$color1'>$h2 №</th>
  <th bgcolor='$color1'>$h2 Подаминистратор Потребителско име</th>
  <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
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
  <th bgcolor='$color1'>$h2 Дата</th>
  </tr>";
  
}

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Individual_ID'] . "</td>";
  echo "<td>" . $row['Admin_Username'] . "</td>";
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
  echo "<td>" . $row['Date'] . "</td>";
  echo "</tr>";
  }
echo "</table>";


mysqli_close($con);
	
	
}

?>

<script>

function showSubAdmin1(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("subAdminValue1").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("subAdminValue1").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getSubAdmin.php?q="+str, true);
  xhttp.send();
}

</script>
          
    
    <form id = "mpsData" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; display: none;">  
        <br>
        <h3>Запис на данни на МПС:</h3>
                <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
        <table class = "iDataInput">
            <tr>
                <td>ID/№ на ф. лице*<br><input  type="number" name="Individual_ID" required="required" placeholder = "ID/№ на ф. лице*"></td>
                
            	<td>Избери подадмин*<br><select style = "width: 174px; height: 27px;" name="Admin_Username"  onchange="showSubAdmin1(this.value)" required="required">
                    <option value="">Избери подадмин</option>
                            <?php
                                $con = connectServer();
                                $query = "SELECT * FROM admin";
                                $results=mysqli_query($con, $query);
                                //loop
                                foreach ($results as $admins){
                            ?>
                                    <option value="<?php echo $admins['username'];?>"><?php echo $admins['username'];?></option>
                            <?php
                                }
                                mysqli_close($con);
                                
                            ?>
                    
                </select>
                </td>
            	<td>Избери потребител*<br><select  id="subAdminValue1" style = "width: 174px; height: 27px;" name="Sub_Admin_Username" required="required">
                <option value="">Избери потребител</option>
                </select>
            	</td>
            </tr>
            <tr>
            	<td>Избери вид МПС*<br><select name="Type" onchange="typeMps(this.value)" style = "width:174px; height: 27px;" required="required">*
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
                    </select>
                    </td>
                <td>Марка*<br><input type="text" name="Brand" required="required" placeholder = "Марка*"  onkeypress="return (event.charCode == 32 || event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" /></td>
            	
                <td>Модел*<br><input type="text" name="Model" required="required" placeholder = "Модел*"  onkeypress="return (event.charCode == 32 || event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" /></td>
            </tr>
            <tr>
            	<td>Рег.№*<br><input type="text" name="RegNumber" required="required" placeholder = "Рег. номер*"></td>
            	<td>Купе*<br><select name="Kupe" style = "width:174px; height: 27px;" required="required">
            	<option value="">Избери купе*</option>   
                <option value="седан">седан</option>												
                <option value="хечбек">хечбек</option>
                <option value="комби">комби</option>
                <option value="купе">купе</option>
            	<option value="кабрио">кабрио</option>
                <option value="пикап">пикап</option>
                <option value="ван">ван</option>
            	<option value="джип">джип</option>
                <option value="други">други</option>
                </select>
                </td>
            	<td>Шаси*<br><input type="text" name="Shasi" required="required" placeholder = "Шаси*"></td>
            </tr>
            <tr>
            	<td>Първа рег.*<br><input type="text" name="FirstReg" style = "width:174px; height: 27px;" required="required" class="textbox-n" onfocus = "(this.type='date')"  id="date" placeholder = "Първа регистрация*"></td>
                
            	<td>Тегло кг*<br><input type="number" name="Weight" required="required" placeholder = "Тегло кг*"></td>
                
            	    
            	<td>Цвят*<br><select name="Color" style = "width:174px; height: 27px;" required="required">
            	<option value="">Цвят</option>    
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
                </select>
                <td>
            </tr>
            	<td>Брой места*<br><input  type="number" name="Seats" required="required" placeholder = "Брой места*"></td>
                
            	<td>Кубатура*<br><input  type="number" name="Cubature" required="required" placeholder = "Кубатура*"></td>
                
            	<td>Мощност в к.с*<br><input  type="number" name="Power" required="required" placeholder = "Мощност в к.с*"></td>
            <tr>    
            	<td>Двигател*<br><select name="Engine" style = "width:174px; height: 27px;" required="required">
            	<option value="">Двигател*</option>	    
                <option value="бензин">бензин</option>												
                <option value="дизел">дизел</option>
                <option value="газ">газ</option>
                <option value="метан">метан</option>
            	<option value="хибрид">хибрид</option>
                <option value="електрически">електрически</option>
                </select>
                </td>
            	<td>Скоростна кутия*<br><select name="Transmission" style = "width:174px; height: 27px;" required="required">
            	<option value="">Скоростна кутия*</option>    
                <option value="ръчна">ръчна</option>												
                <option value="автоматична">автоматична</option>
                </select>
                </td>
            	    
            	<td>Гаранция*<br><select name="Guarantee" style = "width:174px; height: 27px;" required="required">
            	<option value="">Гаранция*</option>
                <option value="да">да</option>												
                <option value="не">не</option>
                </select>
                </td>
            </tr>
            <tr>
            	<td>Гаранция до*<br><input type="text" name="GuaranteeDate" style = "width:174px; height: 27px;" required="required" class="textbox-n" onfocus = "(this.type='date')" id="date1" placeholder = "Гаранция до*"></td>
                
            	<td>Стойност на МПС лв*<br><input type="text" name="Price" required="required" placeholder = "Стойност на МПС лв*"></td>
                
            	<td>Адрес на домуване на МПС*<br><input type="text" name="Address_MPS" required="required" placeholder = "Адрес на домуване на МПС*"></td>
            </tr>
            <tr>
                <td>Текущи километри*<br><input  type="number" name="Current_Km" required="required" placeholder = "Текущи километри*"></td>
                <td>Дата текущи километри*<br><input  type="date" style = "width:174px; height: 26px;" name="Date_Current_Km" required="required" placeholder = "Дата Текущи километри*"></td>
            	<td>ТП<br><select style = "width:174px; height: 26px;" name="TP"  required="required" onchange="tpF(this.value)">
                <option value="">ТП*</option> 
                <option value="ТП1">ТП1</option>
                <option value="ТП2">ТП2</option>
                <option value="ТП3">ТП3</option>
                </select>
                </td>
                
            </tr>
            <tr>
                <td>ГО*<br><select name="GO"  style = "width:174px; height: 26px;" required="required" onchange="goF(this.value)">*
            	<option value="">Избери ГО, да или не</option> 
                <option value="да">да</option>
                <option value="не">не</option>	
                </select>
            	</td>
                <td>ГТП*<br><select name="GTP"  style = "width:174px; height: 26px;" required="required" onchange="gtpF(this.value)">*
                <option value="">Избери ГТП, да или не</option>
                <option value="да">да</option>
                <option value="не">не</option>
                </select>
                </td>
                <td>Каско*<br><select name="Kasko"  style = "width:174px; height: 26px;" required="required" onchange="kaskoF(this.value)">*
                <option value="">Избери Каско, да или не</option>
                <option value="да">да</option>
                <option value="не">не</option>
                </select>
            	</td>
            </tr>
            <tr>
            	<!--МАТ: <br><select id = "mat" name="MAT" style = "width:174px; height: 26px;" required="required" >
                <option value=""></option>
                </select>
                -->
                <td>Винетка*<br><select name="Vinetka"  style = "width:174px; height: 26px;" required="required" onchange="vinetkaF(this.value)">*
                <option value="">Избери Винетка, да или не</option>
                <option value="да">да</option>
                <option value="не">не</option>
                </select>
            	</td>
            	<td>Друго*<br><select name="Others"  style = "width:174px; height: 26px;" required="required" onchange="otherF(this.value)">*
                <option value="">Избери Друго, да или не</option>
                <option value="да">да</option>
                <option value="не">не</option>
                </select>
                </td>
                <td>МАТ<br><fieldset id = "mat" >
                <input type = "text"  data-toggle="tooltip" title="МАТ" name="MAT" value="<?php echo $mat;?>" style = "width:174px; height: 26px;" required="required" placeholder = "МАТ" readonly>
                </fieldset>
                </td>
            	<!--<select name="Address_MPS" style = "width:174px; height: 27px;" required="required">*
                <option value="<?php //echo $address; ?>"><?php //echo $address; ?></option>												
                <option value="<?php //echo $address_MPS; ?>"><?php //echo $address_MPS; ?></option>
                </select>-->
            </tr>    
        </table>
                <br><br>
                <input type="submit" name="btnSaveAuto" value="Запис" style = "border-radius: 2px; color: red; width: 30%;">  
              </form>
              <br>
              
              <button onclick = "location.href='mainAdminInputDataServiceAutoPerson.php'" style = "border-radius: 2px; color: red; width: 30%;">Въвеждане данни за застраховки и сервиз на МПС</button>
              <br><br>
        </div>
<!--        </div>
        <div class="col-sm-1"></div>
    </div>
</div>-->            
  
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveAuto == true) {
  $con2 = connectServer();
  
  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID]
                                  AND Admin_Username = '$_POST[Admin_Username]'
                                  AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  $sqlInsertAuto = "INSERT INTO autos (Individual_ID, Admin_Username, Sub_Admin_Username, Type, Brand, Model, Reg_Number, Kupe, Shasi, First_Reg, Weight, Color, Seats, Cubature, Power, Engine, 
        Transmission, Guarantee, GuaranteeDate, Price, Address_MPS, Current_Km, Date_Current_Km, TP, GO, GTP, Kasko, Vinetka, Others, MAT)
  VALUES
  ('$_POST[Individual_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Type]', '$_POST[Brand]','$_POST[Model]', '$_POST[RegNumber]', '$_POST[Kupe]', 
   '$_POST[Shasi]', '$_POST[FirstReg]', '$_POST[Weight]', '$_POST[Color]', '$_POST[Seats]', '$_POST[Cubature]', '$_POST[Power]',
   '$_POST[Engine]', '$_POST[Transmission]', '$_POST[Guarantee]', '$_POST[GuaranteeDate]', '$_POST[Price]', '$_POST[Address_MPS]', '$_POST[Current_Km]', '$_POST[Date_Current_Km]',
   '$_POST[TP]', '$_POST[GO]', '$_POST[GTP]', '$_POST[Kasko]', '$_POST[Vinetka]', '$_POST[Others]', '$_POST[MAT]')";
  
  if(mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAuto) || mysqli_affected_rows($con2) == -1)
  {
    $message = "Възникна грешка, дублиране на регистрационен номер, грешно въведено ID или промяна в йерархията подаминистратор потребител!";
	echo "<script>alert('$message');</script>";
	die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
  }
  else
  {
    $_SESSION['lastInsertAutoID'] = mysqli_insert_id($con2);
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
	//header('Location: mainAdminInputDataAuto.php');
    echo "<script> location.replace('mainAdminInputDataServiceAutoPerson.php'); </script>";
  }
  
//}

mysqli_close($con2);
	
	
}
 
?>

<script>
(function ($) {
    $(document).ready(function () {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
    });
})(jQuery);


$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
 
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

function typeMps(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
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
  
</body>
</html>