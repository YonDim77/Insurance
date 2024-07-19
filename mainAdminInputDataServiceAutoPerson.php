<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
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
    
    background: #f2e6ff;
}

table {
    width: 130%;
   
}

table, th, td {
    border: 1px solid black;
    text-align: center;
}

.iDataInput th, td {
    
    border: none;
}

table.iDataInput {
    width: 100%;
    border: none;
}

.navbar .navbar-nav a {
    padding: 22px 15px 27px 15px;
    font-size: 18px;
}
.navbar .dropdown-menu a {
    padding: 5px 10px 5px 10px;
    font-size: 14px;
}

@media screen and (min-width: 1350px) {
    .navbar-inverse {
        margin-top:0px; height: 70px; position: fixed;
    }
    ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;    
    }
}

</style>
</head>
<body>  

<div id = "nav"></div>

<br>
 
<?php

include 'functions.php';

$btnSaveAuto = false;
if(isset($_POST["btnSaveAuto"])) {
	$btnSaveAuto = true;
}

$btnSaveServiceAuto = false;
if(isset($_POST["btnSaveServiceAuto"])) {
	$btnSaveServiceAuto = true;
}

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$con = connectServer();

$lastAutoID = $_SESSION['lastInsertAutoID'];

$result = mysqli_query($con, "SELECT * FROM autos WHERE AutosID = $lastAutoID");

if($lastAutoID > 0) {
    
    //echo "<br><br><br>";
    echo "<table border='2' style = 'margin-top: 8.0vw;'>
    
    <tr>
    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
    <th bgcolor='$color1'>$h2 ID/№ на физическо лице</th>
    <th bgcolor='$color1'>$h2 Подаминистратор Потребителско име</th>
    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
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
      echo "<td style = 'border: 1px solid black'>" . $row['AutosID'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Individual_ID'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Admin_Username'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Sub_Admin_Username'] . "</td>";  
      echo "<td style = 'border: 1px solid black'>" . $row['Type'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Brand'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Model'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Reg_Number'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Kupe'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Shasi'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['First_Reg'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Weight'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Color'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Seats'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Cubature'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Power'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Engine'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Transmission'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Guarantee'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['GuaranteeDate'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Price'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Address_MPS'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Current_Km'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Date_Current_Km'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['TP'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['GO'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['GTP'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Kasko'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Vinetka'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['Others'] . "</td>";
      echo "<td style = 'border: 1px solid black'>" . $row['MAT'] . "</td>";
      echo "</tr>";
      }
    echo "</table>";
}    


?> 

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
            <h3 style = "margin-top: 100px;">Запис на данни за застраховки, винетка и данък на МПС на физическо лице:</h3>
            <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-top: 50px;">  
                <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
                <table class = "iDataInput"> 
                    <tr>
                        <td>ID/№ на МПС*<br><input  type="number" name="AutosID" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>ID/№ на физическо лице*<br><input  type="number" name="Individual_ID" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>Подамин потребителско име*<br>
                        <select style = "width: 174px; height: 27px;" name="Admin_Username"  onchange="showSubAdmin(this.value)" required="required">
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
                            
                        </select></td>
                    </tr>
                    <tr>    
                        <td> Потребител потребителско име*<br>
                        <select  id="subAdminValue" style = "width: 174px; height: 27px;" name="Sub_Admin_Username" required="required">
                        <option value="">Избери потребител</option>
                        </select></td>
                        
                        <td>ГТП дата*<br><input id = "gtp" type="Date" name="GTP_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване" onchange = "GtpDateCheck(this.id)"></td>
                        
                        <td>ГТП сума лв*:<br><input type="text" name="GTP_Sum"  onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
                    </tr>
                    <tr>
                        <td>ГО дата*<br><input type="Date" name="GO_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>ГО сума лв*<br><input type="text" name="GO_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>ГО плащане лв*<br>
                        <select name="GO_Payment" style = "width:174px; height: 27px;" required="required">лв*
                        <option value="годишно">годишно</option>												
                        <option value="полугодишно">полугодишно</option>
                        <option value="тримесечно">тримесечно</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Каско дата*<br><input type="Date" name="Kasko_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>Каско сума лв*<br><input type="text" name="Kasko_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>Каско плащане*<br>
                        <select name="Kasko_Payment" style = "width:174px; height: 27px;" required="required">*
                        <option value="годишно">годишно</option>												
                        <option value="полугодишно">полугодишно</option>
                        <option value="тримесечно">тримесечно</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Винетка дата*<br><input type="Date" name="Vinetka_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>Винетка сума лв*<br><input type="text" name="Vinetka_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>Винетка вид*<br>
                        <select name="Vinetka_Type" style = "width:174px; height: 27px;" required="required">
                        <option value="годишна">годишна</option>												
                        <option value="полугодишна">полугодишна</option>
                        <option value="тримесечна">тримесечна</option>
                        <option value="месечна">месечна</option>												
                        <option value="седмична">седмична</option>
                        <option value="weekend">weekend</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Данък* <br><input type="text" name="Tax" required="required" placeholder = "Задължително попълване">
                        
                        <td>Данък сума лв*<br><input type="text" name="Tax_Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
                        
                        <td>Данък платен до*<br><input type="Date" name="Tax_Paid_Till" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
                    </tr>
                    <tr>
                        
                        <td></td>
                        <td>Ефективност*<br><input type="text" name="Efficiency" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
                        <td></td>
            
                        <!--<select name="Address_MPS" style = "width:174px; height: 27px;" required="required">*
                        <option value="<?php //echo $address; ?>"><?php //echo $address; ?></option>												
                        <option value="<?php //echo $address_MPS; ?>"><?php //echo $address_MPS; ?></option>
                        </select>-->
                     </tr>   
                        
                </table>
                <br><br>
                <input type="submit" name="btnSaveAuto" value="Запис" style = "width: 35%; border-radius: 2px; color: red;"> 
            </form>
            <br><br>
            
            
            <button id = "showServiceData" onclick = "showServiceData()" style = "border-radius: 2px; color: red; width: 35%;">Покажи запис на данни за сервиз на МПС на физическо лице</button>
            <button id = "hideServiceData" onclick = "hideServiceData()" style = "border-radius: 2px; color: red; width: 35%; display: none;">Скрий запис на данни за сервиз на МПС на физическо лице</button>
            <br><br>
<script>
    function showServiceData() {
        $(document.getElementById('serviceData')).toggle(1500);  //.style.display = 'block';
        document.getElementById('showServiceData').style.display = 'none';
        document.getElementById('hideServiceData').style.display = 'block';
    }
    function hideServiceData() {
        $(document.getElementById('serviceData')).toggle(1500);  //.style.display = 'none';
        document.getElementById('showServiceData').style.display = 'block';
        document.getElementById('hideServiceData').style.display = 'none';
    }
    
    function GtpDateCheck(idparam) {
        
        var currentDate = new Date();
        var date = new Date(document.getElementById(idparam).value);
    
        if(date.getTime() + 86400000 < currentDate.getTime()) {
            alert("Моля въведете дата не по-стара от днешната!");
            document.getElementById(idparam).value = "";
        }
        
    }
    
</script>
  

  
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveAuto == true) {
    
  $con2 = connectServer();
  $lastAutoInsuranceID = 0;
  
  
//  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID]");
  
  $idCheck = mysqli_query($con2, "SELECT * FROM autos WHERE AutosID = $_POST[AutosID] 
                                  AND Individual_ID = $_POST[Individual_ID]
                                  AND Admin_Username = '$_POST[Admin_Username]'
                                  AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  $sqlInsertAuto = "INSERT INTO insurance (AutosID, Individual_ID, Admin_Username, Sub_Admin_Username, GTP_Date, GTP_Email, GTP_Sum, GO_Date, GO_Email, GO_Sum, GO_Payment,
                    Kasko_Date, Kasko_Email, Kasko_Sum, Kasko_Payment, Vinetka_Date, Vinetka_Email, Vinetka_Sum, Vinetka_Type, Tax, Tax_Sum, Tax_Paid_Till, Efficiency)
  VALUES
  ('$_POST[AutosID]', '$_POST[Individual_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[GTP_Date]', 'неизпратено', '$_POST[GTP_Sum]', '$_POST[GO_Date]', 
   'неизпратено', '$_POST[GO_Sum]', '$_POST[GO_Payment]', '$_POST[Kasko_Date]', 'неизпратено', '$_POST[Kasko_Sum]', '$_POST[Kasko_Payment]', '$_POST[Vinetka_Date]', 'неизпратено', '$_POST[Vinetka_Sum]',
   '$_POST[Vinetka_Type]', '$_POST[Tax]', '$_POST[Tax_Sum]', '$_POST[Tax_Paid_Till]', '$_POST[Efficiency]')";
  
  mysqli_autocommit($con2, FALSE);
  mysqli_query($con2,"START TRANSACTION");
  
  if(!$idCheck || mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAuto)) //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  {
    mysqli_rollback($con2);
    $message = "Възникна грешка!Дублиране на ID/№ на МПС, грешно въведено ID или грешка в йерархията подадминистратор/потребител!";
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

  
  $resultAutoInsurance = mysqli_query($con2, "SELECT * FROM insurance WHERE Insurance_ID = $lastAutoInsuranceID");

  if($lastAutoInsuranceID > 0) {
    
    echo "<br><br>";
    echo "<table border='2'>
    
    <tr>
    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
    <th bgcolor='$color1'>$h2 ID/№ на физическо лице</th>
    <th bgcolor='$color1'>$h2 Подаминистратор Потребителско име</th>
    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
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
    <th bgcolor='$color1'>$h2 Винетка сума</th>
    <th bgcolor='$color1'>$h2 Винетка тип</th>
    <th bgcolor='$color1'>$h2 Данък</th>
    <th bgcolor='$color1'>$h2 Данък сума</th>
    <th bgcolor='$color1'>$h2 Данък платен до</th>
    <th bgcolor='$color1'>$h2 Ефективност</th>
    </tr>";
  
}

while($row = mysqli_fetch_array($resultAutoInsurance))
  {
  echo "<tr>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['AutosID'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Individual_ID'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Admin_Username'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Sub_Admin_Username'] . "</td>";  
  echo "<td style='color:black; border: 1px solid black;'>" . $row['GTP_Date'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['GTP_Email'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['GTP_Sum'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['GO_Date'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['GO_Email'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['GO_Sum'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['GO_Payment'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Kasko_Date'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Kasko_Email'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Kasko_Sum'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Kasko_Payment'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Vinetka_Date'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Vinetka_Email'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Vinetka_Sum'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Vinetka_Type'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Tax'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Tax_Sum'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Tax_Paid_Till'] . "</td>";
  echo "<td style='color:black; border: 1px solid black;'>" . $row['Efficiency'] . "</td>";
  echo "</tr>";
  }
echo "</table>";  
  
//}

mysqli_close($con2);
	
	
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


  <form id = "serviceData" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; display: none;">  
    <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
    <br><br>
    <h3>Запис на данни за сервиз на МПС на физическо лице:</h3>
    <table class = "iDataInput"> 
        <tr>
            <td>ID/№ на МПС*<br><input  type="number" name="AutosID" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ID/№ на физическо лице*<br><input  type="number" name="Individual_ID" required="required" placeholder = "Задължително попълване"></td>
	        
	        <td>Подамин потребителско име*<br>
	        <select style = "width: 174px; height: 27px;" name="Admin_Username"  onchange="showSubAdmin1(this.value)" required="required">
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
                
            </select></td>
        </tr>
        <tr>
	        <td>Потребител потребителско име*<br>
	        <select  id="subAdminValue1" style = "width: 174px; height: 27px;" name="Sub_Admin_Username" required="required">
            <option value="">Избери потребител</option>
            </select></td>
            
            <td>Сервиз*<br>
            <select name="Service" style = "width:174px; height: 27px;" required="required">
            <option value="гаранционен">гаранционен</option>												
            <option value="редовен">редовен</option>
            </select></td>
            
            <td>Обслужване на*<br>
            <select name="Type" style = "width:174px; height: 27px;" required="required">
            <option value="масла и филтри">масла и филтри</option>												
            <option value="ремъци">ремъци</option>
            <option value="спирачки">спирачки</option>												
            <option value="скоростна кутия">скоростна кутия</option>
            </select></td>
        </tr>
        <tr>
            <td>Дата на обслужване*<br><input type="Date" name="Date_Of_Service" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Километри*<br><input type="number" name="Km" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>След километри*<br><input type="number" name="After_Km" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>След дата*<br><input type="Date" name="After_Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Сума лв*<br><input type="text" name="Sum" style = "width:174px; height: 27px;" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Фактура №*<br><input type="text" name="Invoice" required="required" placeholder = "Задължително попълване"></td>
        </tr>
    </table>
    <br><br>
    <input type="submit" name="btnSaveServiceAuto" value="Запис" style = "width: 35%; border-radius: 2px; color: red;">
  </form>
  <br>
  
  <button onclick = "location.href='mainAdminInputDataRepairAutoPerson.php'" style = "width: 35%; border-radius: 2px; color: red;">Въвеждане на данни за ремонти и гуми на МПС</button>
  <br><br>
  
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveServiceAuto == true) {
    
  $con2 = connectServer();
  $_SESSION['lastAutoServiceID'] = 0;

  
//  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID]");
  $CheckDuplicateEntry = mysqli_query($con2, "SELECT * FROM service WHERE AutosID = $_POST[AutosID] 
                                  AND Type = '$_POST[Type]'
                                  AND Date_Of_Service = '$_POST[Date_Of_Service]'
                                  AND Invoice = '$_POST[Invoice]'");
                                  
  $idCheck = mysqli_query($con2, "SELECT * FROM insurance WHERE AutosID = $_POST[AutosID] 
                                  AND Individual_ID = $_POST[Individual_ID]
                                  AND Admin_Username = '$_POST[Admin_Username]'
                                  AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
                                  
  if(strcmp($_POST['Type'], 'масла и филтри') != 0) {
    $sqlInsertAutoService = "INSERT INTO service (AutosID, Individual_ID, Admin_Username, Sub_Admin_Username, Service, Type, Date_Of_Service,
                             Km, After_Km, After_Date, Sum, Invoice, Oils_Filters_Email)
                           
    VALUES
    ('$_POST[AutosID]', '$_POST[Individual_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Service]', '$_POST[Type]', '$_POST[Date_Of_Service]', 
     '$_POST[Km]', '$_POST[After_Km]', '$_POST[After_Date]', '$_POST[Sum]', '$_POST[Invoice]', '')";
  }
  else {
     $sqlInsertAutoService = "INSERT INTO service (AutosID, Individual_ID, Admin_Username, Sub_Admin_Username, Service, Type, Date_Of_Service,
                             Km, After_Km, After_Date, Sum, Invoice, Oils_Filters_Email)
                           
    VALUES
    ('$_POST[AutosID]', '$_POST[Individual_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Service]', '$_POST[Type]', '$_POST[Date_Of_Service]', 
     '$_POST[Km]', '$_POST[After_Km]', '$_POST[After_Date]', '$_POST[Sum]', '$_POST[Invoice]', 'неизпратено')"; 
  }
  
  mysqli_autocommit($con2, FALSE);
  mysqli_query($con2,"START TRANSACTION");
  
  if(mysqli_num_rows($CheckDuplicateEntry) > 0 || !$idCheck || mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAutoService)) //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  {
    mysqli_rollback($con2);
    $message = "Възникна грешка!Дублиране на ID/№ на МПС или грешно въведено ID!";
	echo "<script>alert('$message');</script>";
	//die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
  }
  else
  {
    $_SESSION['lastAutoServiceID'] = mysqli_insert_id($con2);
    mysqli_commit($con2);
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
	echo "<script> location.replace('mainAdminInputDataRepairAutoPerson.php'); </script>";
  }
  mysqli_query($con2, "SET AUTOCOMMIT=TRUE");
  
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
        </div>
<!--        </div>
        <div class="col-sm-1"></div>
    </div>
</div>-->
</body>
</html>