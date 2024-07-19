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
    width: 130%;
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

$btnSaveAuto = false;
if(isset($_POST["btnSaveAuto"])) {
	$btnSaveAuto = true;
}

$subAdminUsername = $_SESSION['subAdminUsername'];

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$con = connectServer();

$lastAutoID = $_SESSION['lastInsertAutoFirmID'];

$result = mysqli_query($con, "SELECT * FROM autos WHERE AutosID = $lastAutoID AND Sub_Admin_Username = '".$subAdminUsername."'");

if($lastAutoID > 0 && mysqli_num_rows($result) > 0) {
    
  echo"<div align = 'center'>";
  echo "<br>"; 
  echo "<h3 style = 'margin-top: 4.0vw;'>Последно въведени общи данни на МПС</h3>"; 
  echo "<br><br>";
  echo"</div>";    
    
  echo "<table border='2'>
    
  <tr>
  <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
  <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
  <th bgcolor='$color1'>$h2 Тип</th>
  <th bgcolor='$color1'>$h2 Марка</th>
  <th bgcolor='$color1'>$h2 Модел</th>
  <th bgcolor='$color1'>$h2 Рег. №</th>
  <th bgcolor='$color1'>$h2 Купе</th>
  <th bgcolor='$color1'>$h2 Шаси</th>
  <th bgcolor='$color1'>$h2 Първа регистрация</th>
  <th bgcolor='$color1'>$h2 Тегло кг</th>
  <th bgcolor='$color1'>$h2 Цвят</th>
  <th bgcolor='$color1'>$h2 Брой места</th>
  <th bgcolor='$color1'>$h2 Кубатура</th>
  <th bgcolor='$color1'>$h2 Мощност к.с.</th>
  <th bgcolor='$color1'>$h2 Двигател</th>
  <th bgcolor='$color1'>$h2 Скоростна кутия</th>
  <th bgcolor='$color1'>$h2 Гаранция</th>
  <th bgcolor='$color1'>$h2 Гаранция до</th>
  <th bgcolor='$color1'>$h2 Цена</th>
  <th bgcolor='$color1'>$h2 Адрес на МПС</th>
  <th bgcolor='$color1'>$h2 Текущи км</th>
  <th bgcolor='$color1'>$h2 Дата тек. км</th>
  <th bgcolor='$color1'>$h2 Шофьор име</th>
  <th bgcolor='$color1'>$h2 Шофьор фамилия</th>
  <th bgcolor='$color1'>$h2 Шофьор тел. №</th>
  <th bgcolor='$color1'>$h2 ТП</th>
  <th bgcolor='$color1'>$h2 ГО</th>
  <th bgcolor='$color1'>$h2 ГТП</th>
  <th bgcolor='$color1'>$h2 Каско</th>
  <th bgcolor='$color1'>$h2 Винетка</th>
  <th bgcolor='$color1'>$h2 Друго</th>
  <th bgcolor='$color1'>$h2 МАТ</th>
  </tr>";
  

    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['AutosID'] . "</td>";
        echo "<td>" . $row['Legalentity_ID'] . "</td>";
        //echo "<td>" . $row['Sub_Admin_Username'] . "</td>";  
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Brand'] . "</td>";
        echo "<td>" . $row['Model'] . "</td>";
        echo "<td>" . $row['Reg_Number'] . "</td>";
        echo "<td>" . $row['Kupe'] . "</td>";
        echo "<td>" . $row['Shasi'] . "</td>";
        echo "<td>" . $row['First_Reg'] . "</td>";
        echo "<td>" . $row['Weight'] . "</td>";
        echo "<td>" . $row['Color'] . "</td>";
        echo "<td>" . $row['Seats'] . "</td>";
        echo "<td>" . $row['Cubature'] . "</td>";
        echo "<td>" . $row['Power'] . "</td>";
        echo "<td>" . $row['Engine'] . "</td>";
        echo "<td>" . $row['Transmission'] . "</td>";
        echo "<td>" . $row['Guarantee'] . "</td>";
        echo "<td>" . $row['GuaranteeDate'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "<td>" . $row['Address_MPS'] . "</td>";
        echo "<td>" . $row['Current_Km'] . "</td>";
        echo "<td>" . $row['Date_Current_Km'] . "</td>";
        echo "<td>" . $row['Driver_First_Name'] . "</td>";
        echo "<td>" . $row['Driver_Last_Name'] . "</td>";
        echo "<td>" . $row['Driver_Phone_Number'] . "</td>";
        echo "<td>" . $row['TP'] . "</td>";
        echo "<td>" . $row['GO'] . "</td>";
        echo "<td>" . $row['GTP'] . "</td>";
        echo "<td>" . $row['Kasko'] . "</td>";
        echo "<td>" . $row['Vinetka'] . "</td>";
        echo "<td>" . $row['Others'] . "</td>";
        echo "<td>" . $row['MAT'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}    

?> 


<h3 style = "margin-top: 7.0vw">Запис на данни за застраховки, винетка и данък на МПС на юридическо лице:</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        <tr>
            <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
            <td>ID/№ на МПС*<br><input  type="number" name="AutosID" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ID/№ на юридическо лице*<br><input  type="number" name="Legalentity_ID" required="required" placeholder = "Задължително попълване"></td>
            
            <input type="email" name="Admin_Username" value = "<?php echo $_SESSION['adminUserName']; ?>" style = "display: none;" />
            <input type="email" name="Sub_Admin_Username" value = "<?php echo $_SESSION['subAdminUsername']; ?>" style = "display: none;" />
	        
            <td>ГТП дата*<br><input type="Date" name="GTP_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>ГТП сума лв*<br><input type="text" name="GTP_Sum"  onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ГО дата*<br><input type="Date" name="GO_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
            <td>ГО сума лв*<br><input type="text" name="GO_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>ГО плащане*<br>
            <select name="GO_Payment" style = "width:174px; height: 27px;" required="required">
            <option value="годишно">годишно</option>												
            <option value="полугодишно">полугодишно</option>
            <option value="тримесечно">тримесечно</option>
            </select></td>
            
            <td>Каско дата*<br><input type="Date" name="Kasko_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Каско сума*<br><input type="text" name="Kasko_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Каско плащане:<br>
            <select name="Kasko_Payment" style = "width:174px; height: 27px;" required="required">
            <option value="годишно">годишно</option>												
            <option value="полугодишно">полугодишно</option>
            <option value="тримесечно">тримесечно</option>
            </select></td>
            
            <td>Винетка дата*<br><input type="Date" name="Vinetka_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Винетка сума лв*<br><input type="text" name="Vinetka_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Винетка вид*<br>
            <select name="Vinetka_Type" style = "width:174px; height: 27px;" required="required">*
            <option value="годишна">годишна</option>												
            <option value="полугодишна">полугодишна</option>
            <option value="тримесечна">тримесечна</option>
            <option value="месечна">месечна</option>												
            <option value="седмична">седмична</option>
            <option value="weekend">weekend</option>
            </select></td>
        
            <td>Данък*<br><input type="text" name="Tax" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Данък сума лв*<br><input type="text" name="Tax_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Данък платен до*<br><input type="Date" name="Tax_Paid_Till" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            <td></td>
            <td>Ефективност*<br><input type="text" name="Efficiency" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        
	        <!--<select name="Address_MPS" style = "width:174px; height: 27px;" required="required">*
            <option value="<?php //echo $address; ?>"><?php //echo $address; ?></option>												
            <option value="<?php //echo $address_MPS; ?>"><?php //echo $address_MPS; ?></option>
            </select>-->
    </table>
    <br><br>
    <input type="submit" name="btnSaveAuto" value="Запис" style = "width: 32%; border-radius: 2px; color: red;">  
  </form>
  <br><br>
  
<button id = "showAutoServiceData" onclick = "showAutoServiceData()" style = "border-radius: 2px; color: red; width: 32%;">Покажи запис на данни за сервиз на МПС на юридическо лице</button>
<button id = "hideAutoServiceData" onclick = "hideAutoServiceData()" style = "border-radius: 2px; color: red; width: 32%; display: none;">Скрий запис на данни за сервиз на МПС на юридическо лице</button>

<script>
    function showAutoServiceData() {
        $(document.getElementById("autoServiceData")).toggle(1500); //.fadeIn("slow");
        document.getElementById('showAutoServiceData').style.display = 'none';
        document.getElementById('hideAutoServiceData').style.display = 'block';
          
    }
    function hideAutoServiceData() {
        $(document.getElementById('autoServiceData')).toggle(1500);  //.fadeOut("slow"); //.style.display = 'none';
        document.getElementById('showAutoServiceData').style.display = 'block';
        document.getElementById('hideAutoServiceData').style.display = 'none';
    }
</script>
  
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveAuto == true) {
    
  $con2 = connectServer();
  
  $notSent = "неизпратено";
  $lastAutoInsuranceID = 0;
  
//  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID]");
  
  $idCheck = mysqli_query($con2, "SELECT * FROM autos WHERE AutosID = $_POST[AutosID] 
                                  AND Legalentity_ID = $_POST[Legalentity_ID]
                                  AND Admin_Username = '$_POST[Admin_Username]'
                                  AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  $sqlInsertAuto = "INSERT INTO insurance (AutosID, Legalentity_ID, Admin_Username, Sub_Admin_Username, GTP_Date, GTP_Email, GTP_Sum, GO_Date, GO_Email, GO_Sum, GO_Payment,
                    Kasko_Date, Kasko_Email, Kasko_Sum, Kasko_Payment, Vinetka_Date, Vinetka_Email, Vinetka_Sum, Vinetka_Type, Tax, Tax_Sum, Tax_Paid_Till, Efficiency)
  VALUES
  ('$_POST[AutosID]', '$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[GTP_Date]', '$notSent', '$_POST[GTP_Sum]', '$_POST[GO_Date]', '$notSent', 
   '$_POST[GO_Sum]', '$_POST[GO_Payment]', '$_POST[Kasko_Date]', '$notSent', '$_POST[Kasko_Sum]', '$_POST[Kasko_Payment]', '$_POST[Vinetka_Date]', '$notSent', '$_POST[Vinetka_Sum]',
   '$_POST[Vinetka_Type]', '$_POST[Tax]', '$_POST[Tax_Sum]', '$_POST[Tax_Paid_Till]', '$_POST[Efficiency]')";
  
  mysqli_autocommit($con2, FALSE);
  mysqli_query($con2,"START TRANSACTION");
  
  if(!$idCheck || mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAuto))
  {
    mysqli_rollback($con2);  
    $message = "Възникна грешка!Дублиране на ID/№ на МПС, грешно въведено ID/№ на юридическо лице!";
	echo "<script>alert('$message');</script>";
	//die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
  }
  else
  {
    $lastAutoInsuranceID = mysqli_insert_id($con2);
    mysqli_commit($con2);  
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
  }
  
  mysqli_query($con2, "SET AUTOCOMMIT=TRUE");
  
  $resultAutoInsurance = mysqli_query($con2, "SELECT * FROM insurance WHERE Insurance_ID = $lastAutoInsuranceID
                                              AND Sub_Admin_Username =  '$_POST[Sub_Admin_Username]'");

if($lastAutoInsuranceID > 0 && mysqli_num_rows($resultAutoInsurance) > 0) {
    
  echo "<table border='2' style = 'margin-top: 4.0vw;'>
    
  <tr>
  <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
  <th bgcolor='$color1'>$h2 ID/№ на ю. лице</th>
  <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
  <th bgcolor='$color1'>$h2 ГТП дата</th>
  <th bgcolor='$color1'>$h2 ГТП уведомление</th>
  <th bgcolor='$color1'>$h2 ГТП сума лв</th>
  <th bgcolor='$color1'>$h2 ГО дата</th>
  <th bgcolor='$color1'>$h2 ГО уведомление</th>
  <th bgcolor='$color1'>$h2 ГО сума лв</th>
  <th bgcolor='$color1'>$h2 ГО плащане</th>
  <th bgcolor='$color1'>$h2 Каско дата</th>
  <th bgcolor='$color1'>$h2 Каско уведомление</th>
  <th bgcolor='$color1'>$h2 Каско сума лв</th>
  <th bgcolor='$color1'>$h2 Каско плащане</th>
  <th bgcolor='$color1'>$h2 Винетка дата</th>
  <th bgcolor='$color1'>$h2 Винетка уведомление</th>
  <th bgcolor='$color1'>$h2 Винетка сума лв</th>
  <th bgcolor='$color1'>$h2 Винетка тип</th>
  <th bgcolor='$color1'>$h2 Данък</th>
  <th bgcolor='$color1'>$h2 Данък сума лв</th>
  <th bgcolor='$color1'>$h2 Данък платен до</th>
  <th bgcolor='$color1'>$h2 Ефективност</th>
  </tr>";
  
}

while($row = mysqli_fetch_array($resultAutoInsurance))
  {
    echo "<tr>";
    echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
    echo "<td style='color:black;'>" . $row['Legalentity_ID'] . "</td>";
    //echo "<td style='color:black;'>" . $row['Admin_Username'] . "</td>";
    echo "<td style='color:black;'>" . $row['Sub_Admin_Username'] . "</td>";  
    echo "<td style='color:black;'>" . $row['GTP_Date'] . "</td>";
    echo "<td style='color:black;'>" . $row['GTP_Email'] . "</td>";
    echo "<td style='color:black;'>" . $row['GTP_Sum'] . "</td>";
    echo "<td style='color:black;'>" . $row['GO_Date'] . "</td>";
    echo "<td style='color:black;'>" . $row['GO_Email'] . "</td>";
    echo "<td style='color:black;'>" . $row['GO_Sum'] . "</td>";
    echo "<td style='color:black;'>" . $row['GO_Payment'] . "</td>";
    echo "<td style='color:black;'>" . $row['Kasko_Date'] . "</td>";
    echo "<td style='color:black;'>" . $row['Kasko_Email'] . "</td>";
    echo "<td style='color:black;'>" . $row['Kasko_Sum'] . "</td>";
    echo "<td style='color:black;'>" . $row['Kasko_Payment'] . "</td>";
    echo "<td style='color:black;'>" . $row['Vinetka_Date'] . "</td>";
    echo "<td style='color:black;'>" . $row['Vinetka_Email'] . "</td>";
    echo "<td style='color:black;'>" . $row['Vinetka_Sum'] . "</td>";
    echo "<td style='color:black;'>" . $row['Vinetka_Type'] . "</td>";
    echo "<td style='color:black;'>" . $row['Tax'] . "</td>";
    echo "<td style='color:black;'>" . $row['Tax_Sum'] . "</td>";
    echo "<td style='color:black;'>" . $row['Tax_Paid_Till'] . "</td>";
    echo "<td style='color:black;'>" . $row['Efficiency'] . "</td>";
    echo "</tr>";
  }
echo "</table>"; 

mysqli_close($con2);
	
	
}
 
?>

<br>
  <form id = "autoServiceData" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "display: none;">  
    <h3 style = "">Запис на данни за сервиз на МПС на юридическо лице:</h3>
    <table class = "iDataInput">
        <tr>
            <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
            <td>ID/№ на МПС*<br><input  type="number" name="AutosID" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ID/№ на ю. лице*<br><input  type="number" name="Legalentity_ID" required="required" placeholder = "Задължително попълване"></td>
	        
	        <input type="email" name="Admin_Username" value = "<?php echo $_SESSION['adminUserName']; ?>" style = "display: none;" />
	        <input type="email" name="Sub_Admin_Username" value = "<?php echo $_SESSION['subAdminUsername']; ?>" style = "display: none;" />
	  
            <td>Сервиз*<br>
            <select name="Service" style = "width:174px; height: 27px;" required="required">
            <option value="гаранционен">гаранционен</option>												
            <option value="редовен">редовен</option>
            </select></td>
        </tr>
        <tr>    
            <td>Обслужване на*<br>
            <select name="Type" style = "width:174px; height: 27px;" required="required">
            <option value="масла и филтри">масла и филтри</option>												
            <option value="ремъци">ремъци</option>
            <option value="спирачки">спирачки</option>												
            <option value="скоростна кутия">скоростна кутия</option>
            </select></td>
            
            <td>Дата на обслужване*<br><input type="Date" name="Date_Of_Service" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Километри*<br><input type="number" name="Km" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>След километри*<br><input type="number" name="After_Km" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>След дата*<br><input type="Date" name="After_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Сума*<br><input type="text" name="Sum" style = "width:174px; height: 27px;" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td></td>
            <td>Фактура №*<br><input type="text" name="Invoice" required="required" placeholder = "Задължително попълване"></td>
            <td></td>
        </tr>
    </table>
    <input type="submit" name="btnSaveServiceAuto" value="Запис" style = "width: 32%; border-radius: 2px; color: red;">  
  </form>
  <br><br>
  
  <button onclick = "location.href='subAdminInputDataTyresAutoFirm.php'" style = "width: 32%; border-radius: 2px; color: red;">Въвеждане на данни за ремонти и гуми на МПС</button>
  <br><br>
  
<?php

$btnSaveServiceAuto = false;
if(isset($_POST["btnSaveServiceAuto"])) {
	$btnSaveServiceAuto = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveServiceAuto == true) {
    
  $con2 = connectServer();
  $_SESSION['lastAutoFirmServiceID'] = 0;

  
//  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID]");
  $CheckDuplicateEntry = mysqli_query($con2, "SELECT * FROM service WHERE AutosID = $_POST[AutosID] 
                                  AND Type = '$_POST[Type]'
                                  AND Date_Of_Service = '$_POST[Date_Of_Service]'
                                  AND Invoice = '$_POST[Invoice]'");
                                  
  $idCheck = mysqli_query($con2, "SELECT * FROM insurance WHERE AutosID = $_POST[AutosID] 
                                  AND Legalentity_ID = $_POST[Legalentity_ID]
                                  AND Admin_Username = '$_POST[Admin_Username]'
                                  AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  if(strcmp($_POST['Type'], 'масла и филтри') != 0) {
    
    $sqlInsertAutoService = "INSERT INTO service (AutosID, Legalentity_ID, Admin_Username, Sub_Admin_Username, Service, Type, Date_Of_Service,
                             Km, After_Km, After_Date, Sum, Invoice, Oils_Filters_Email)
                           
    VALUES
    ('$_POST[AutosID]', '$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Service]', '$_POST[Type]', '$_POST[Date_Of_Service]', 
     '$_POST[Km]', '$_POST[After_Km]', '$_POST[After_Date]', '$_POST[Sum]', '$_POST[Invoice]', '')";
  
  }
  else {
      
   $sqlInsertAutoService = "INSERT INTO service (AutosID, Legalentity_ID, Admin_Username, Sub_Admin_Username, Service, Type, Date_Of_Service,
                             Km, After_Km, After_Date, Sum, Invoice, Oils_Filters_Email)
                           
    VALUES
    ('$_POST[AutosID]', '$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Service]', '$_POST[Type]', '$_POST[Date_Of_Service]', 
     '$_POST[Km]', '$_POST[After_Km]', '$_POST[After_Date]', '$_POST[Sum]', '$_POST[Invoice]', 'неизпратено')";   
      
  }
  
  mysqli_autocommit($con2, FALSE);
  mysqli_query($con2,"START TRANSACTION");
  
  if(mysqli_num_rows($CheckDuplicateEntry) > 0 || !$idCheck || mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAutoService)) //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  {
    //die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
    mysqli_rollback($con2);
    $message = "Възникна грешка!Дублиране на ID/№ на МПС или грешно въведено ID!";
	echo "<script>alert('$message');</script>";
	
  }
  else
  {
    $_SESSION['lastAutoFirmServiceID'] = mysqli_insert_id($con2);
    mysqli_commit($con2);
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
	echo "<script> location.replace('subAdminInputDataTyresAutoFirm.php'); </script>";
  }
  mysqli_query($con2, "SET AUTOCOMMIT=TRUE");
  
//}

mysqli_close($con2);
	
	
}
 
?>  

<script>
 
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