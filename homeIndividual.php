<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['individualNames'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
body {
  background: #f2e6ff;  
	
}

table {
    width: 100%;
}

table, th, td {
    text-align: center;
}

th {
    background-color: white;
    
}

td {
    color: black;
    background: #f2e6ff;
    
}

a:link {
    background-color: transparent; 
    text-decoration: none;
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

@media screen and (min-width: 768px) {
    .navbar-inverse {
        margin-top:0px; height: 70px; position: fixed; width: 100%;
    }
    ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;    
    }
}


/*@media (min-width: 768px) and (max-width: 1350px) {
    
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
      */
      
      /*ul.nav a:hover { color: red !important; }
 
} 
*/

/*
 @media (max-width: 768px) {
     .navbar-nav {
       float: none!important;
       margin: 7.5px -20px;
     
   }

   ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;    
    }
 }
*/
</style>

</head>
<body>
 
<nav class="navbar navbar-inverse" style = "margin-top: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="BugK.png" alt="Insurance" width="150" height="20"></a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeIndividual.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
      <!--<li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="services.html" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Опции<span class="caret"></span></a>
	  <ul class="dropdown-menu">
          
          <li><a href="subAdminShowDataAllPersons.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране на вашите лични данни</a></li>
          <li><a href="subAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на МПС</a></li>
          
	  </ul>
      </li>-->

      <li class="dropdown"><a style = "color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-user-o">&nbsp;<?php echo  $_SESSION['individualNames']; ?></i><span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li><a style="cursor:pointer" onClick = "document.getElementById('dataInd').style.display = 'block'" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране на вашите лични данни</a></li>
	        <li><a style="cursor:pointer" onClick = "document.getElementById('mpsData').style.display = 'block'" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на МПС</a></li>
	        <li><a href="individualUploadAutoDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на документи на МПС</a></li>
	        <li><a href="individualUpdateAutoDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редакция на документи на МПС</a></li>
	        <li><a href="logout.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Изход</a></li>
	    </ul>
	  </li>
	  
	</ul>	
  </div>
</nav>


<!--
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeAdmin.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
</nav>-->

<br><br><br><br><br><br>

<?php
    date_default_timezone_set('Bulgaria/Sofia');
    $date = date('Y-m-d', time());
    echo"<div align = 'center'>";
	
    include 'functions.php';
    
    $con = connectServer();
    $result = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$_SESSION[individualID]'");
    //$regNum =  mysqli_query($con, "SELECT Reg_Number FROM autos WHERE Individual_ID = '$_SESSION[individualID]'");
    //$regNumbers = array();
    //
    //while($row = mysqli_fetch_array($regNum))
	//    {
	//       $regNumbers[] = $row['Reg_Number'];
	//    }
	//    
	//$_SESSION['RegNum'] = $regNumbers;   
	
	if (mysqli_num_rows($result) > 0) {
	    
	    if (!$result) {
    	    
    	    die('Грешка: ' . mysqli_error());
    	}    
	    
	    echo "<table border = '2' id = 'dataInd' style = 'display: none;'>
	    
	    <tr>
	    <th>Име и Фамилия</th>
	    <th>ЕГН</th>
	    <th>Адрес</th>
	    <th>Адрес на МПС</th>
	    <th>Телефон</th>
	    <th>Имейл</th>
	    <th>Лице за контакти</th>
	    <th>Тел. на лице за контакти</th>
	    <th>Емейл на лице за контакти</th>
	    <th>Шофьорска книжка срок</th>
	    <th>Потребителско име</th>
	    <th>Парола</th>
	    <th>Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($result))
	    {
	        echo "<tr>";
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
	        echo "<td>" . $row['Email_Username'] . "</td>";
	        echo "<td>" . $row['Password'] . "</td>";
	        echo "<td>" . $row['Date'] . "</td>";
	        echo "</tr>";
	    }
	    echo "</table>";
	    
    }
    mysqli_close($con);

?>

<br><br>
<h3 style = "">Въвеждане на текущи километри на МПС</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
    <br>
	<select style = "width: 220px; height: 27px;" name="Reg_Numbers"  required="required">
        <option value="">Изберете регистрационен №</option>
                <?php
                    $con = connectServer();
                    //$query = "SELECT * FROM autos WHERE Legalentity_ID = '$_SESSION[legalentityID]'";
                    $query = "SELECT Reg_Number FROM autos WHERE Individual_ID = '$_SESSION[individualID]'";
                    $results=mysqli_query($con, $query);
                    //loop
                    foreach ($results as $regNums){
                ?>
                        <option value="<?php echo $regNums['Reg_Number'];?>"><?php echo $regNums['Reg_Number'];?></option>
                <?php
                    }
                    mysqli_close($con);
                ?>
        
    </select><br><br>
    <input type = "number" name = "Current_Km" required = "required" placeholder = "Въведете текущи километри" style = "width: 220px; height: 27px;"><br><br>
    <input type = "date" name = "Date_Current_Km" value = "<?php echo $date;?>" required = "required" style = "display: none;"><br>
    <input type="submit" name="btnUpdateCurrentKm" value="Актуализирай" style = "border-radius: 2px; color: red;">
  </form>    
<br><br>

<?php

$btnUpdateCurrentKm = false;
if(isset($_POST["btnUpdateCurrentKm"])) {
	$btnUpdateCurrentKm = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdateCurrentKm == true) {

    $con = connectServer();
    $currentKmAutoId = 0;
    $zero = false; $one = false;
    $resultAuto = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Numbers]'");
    
    if (mysqli_num_rows($resultAuto) > 0) {
        while($row = mysqli_fetch_array($resultAuto))
            $currentKmAutoId = $row['AutosID'];
    }
    else {
            die('Грешка: ' . mysqli_error());
    }
    
    
    $updateAutoKM = "UPDATE autos SET Current_Km = '$_POST[Current_Km]', Date_Current_Km = '$_POST[Date_Current_Km]' WHERE AutosID = '$currentKmAutoId'";
    
    mysqli_autocommit($con, FALSE);
    mysqli_query($con,"START TRANSACTION");
    
    $update1 = mysqli_query($con, $updateAutoKM);
    if(mysqli_affected_rows($con) == 0) {
        $zero = true;
    }
    if(mysqli_affected_rows($con) >= 0) {
        $one = true;
    }
    
    if($zero == true) {
          mysqli_commit($con);
          $message = "Няма промяна на данни!";
          echo "<script>alert('$message');</script>";
          
    } 
    else if($one == true) {
      mysqli_commit($con);
      $message = "Данните са актуализирани успешно!";
      echo "<script>alert('$message');</script>";
      
    }
    else {
      mysqli_rollback($con);
      $message = "Възникна грешка, опитайте отново!";
      echo "<script>alert('$message');</script>";
    }
    mysqli_query($con, "SET AUTOCOMMIT=TRUE");

    mysqli_close($con);
}


?>


<br><br>
  <form id = "mpsData" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; display: none;">  
    <h3 style = "">Данни за МПС</h3>
    <br>
	<select style = "width: 220px; height: 27px;" name="Reg_Number"  required="required">
        <option value="">Изберете регистрационен №</option>
                <?php
                    $con = connectServer();
                    //$query = "SELECT * FROM autos WHERE Legalentity_ID = '$_SESSION[legalentityID]'";
                    $query = "SELECT  Reg_Number FROM autos WHERE Individual_ID = '$_SESSION[individualID]'";
                    $results=mysqli_query($con, $query);
                    //loop
                    foreach ($results as $regNums){
                ?>
                        <option value="<?php echo $regNums['Reg_Number'];?>"><?php echo $regNums['Reg_Number'];?></option>
                <?php
                    }
                    mysqli_close($con);
                    
                ?>
        
    </select>&nbsp; &nbsp;
    <input type="submit" name="btnShowData" value="Покажи данни" style = "border-radius: 2px; color: red;">
  </form>    
<br><br>

<?php

$btnShowData = false;
if(isset($_POST["btnShowData"])) {
	$btnShowData = true;
}

$autoId = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowData == true) {

    $con = connectServer();
    
    $resultAuto = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
    
    if (!$resultAuto) {
            die('Грешка: ' . mysqli_error());
        }
    else if (mysqli_num_rows($resultAuto) > 0) {
  	    
        echo "<br><br>";
        echo '<span style="font-size: 20px; color:black;">Общи данни на МПС с регистрационен №</span>' . "  " .
	         '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
        echo "<br><br>";
        
        echo "<table border='2'>
        
        <tr>
        <th>Вид МПС</th>
        <th>Марка</th>
        <th>Модел</th>
        <th>Рег. №</th>
        <th>Купе</th>
        <th>Шаси</th>
        <th>Първа Рег.</th>
        <th>Тегло</th>
        <th>Цвят</th>
        <th>Брой места</th>
        <th>Кубатура</th>
        <th>Мощност в к.с.</th>
        <th>Двигател</th>
        <th>Скоростна кутия</th>
        <th>Гаранция</th>
        <th>Гаранция до</th>
        <th>Стойност на МПС</th>
        <th>Адрес на домуване на МПС</th>
        <th>Текущи км</th>
        <th>Дата текущи км</th>
        </tr>";
        
        while($row = mysqli_fetch_array($resultAuto))
        {
            $autoId = $row['AutosID'];
            echo "<tr>";
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
            echo "</tr>";
        }
        echo "</table>";
  	    
    }
    
    else {
        echo "<br><br>";
        echo '<span style="font-size: 20px; color:black;">Няма данни на МПС с регистрационен №</span>' . "  " .
	         '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
        echo "<br><br>";
    }
    
    $resultInsurance = mysqli_query($con, "SELECT * FROM insurance WHERE AutosID = '$autoId'");
	
	if (!$resultInsurance) {
     
            die('Грешка: ' . mysqli_error());
        }
        
	else if (mysqli_num_rows($resultInsurance) > 0) {
	
	    echo "<br><br>";
        echo '<span style="font-size: 20px; color:black;">Данни за застраховки на МПС с регистрационен №</span>' . "  " .
	         '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
        echo "<br><br>";
     
	    echo "<table border='2'>
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 ГТП дата</th>
        <th bgcolor='$color1'>$h2 ГТП сума</th>
        <th bgcolor='$color1'>$h2 ГО дата</th>
        <th bgcolor='$color1'>$h2 ГО сума</th>
        <th bgcolor='$color1'>$h2 ГО плащане</th>
        <th bgcolor='$color1'>$h2 Каско дата</th>
        <th bgcolor='$color1'>$h2 Каско сума</th>
        <th bgcolor='$color1'>$h2 Каско плащане</th>
        <th bgcolor='$color1'>$h2 Винетка дата</th>
        <th bgcolor='$color1'>$h2 Винетка сума</th>
        <th bgcolor='$color1'>$h2 Винетка тип</th>
        <th bgcolor='$color1'>$h2 Данък</th>
        <th bgcolor='$color1'>$h2 Данък сума</th>
        <th bgcolor='$color1'>$h2 Данък платен до</th>
        <th bgcolor='$color1'>$h2 Ефективност</th>
        </tr>";
	    
	    while($row = mysqli_fetch_array($resultInsurance))
	    {
	        echo "<tr>";
	        echo "<td>" . $row['GTP_Date'] . "</td>";
            echo "<td>" . $row['GTP_Sum'] . "</td>";
            echo "<td>" . $row['GO_Date'] . "</td>";
            echo "<td>" . $row['GO_Sum'] . "</td>";
            echo "<td>" . $row['GO_Payment'] . "</td>";
            echo "<td>" . $row['Kasko_Date'] . "</td>";
            echo "<td>" . $row['Kasko_Sum'] . "</td>";
            echo "<td>" . $row['Kasko_Payment'] . "</td>";
            echo "<td>" . $row['Vinetka_Date'] . "</td>";
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
    else {
        echo "<br><br>";
        echo '<span style="font-size: 20px; color:black;">Няма данни за застраховки на МПС с регистрационен №</span>' . "  " .
	         '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
        echo "<br><br>";
    }
    	
    	$serviceData =  mysqli_query($con, "SELECT * FROM service WHERE AutosID = '$autoId'"); 
    	
    	if (mysqli_num_rows($serviceData) > 0) {
    	    echo "<br><br>";
            echo"<div align = 'center'>";
    	    echo '<span style="font-size: 20px; color:black;">Данни за сервиз на МПС с регистрационен №</span>' . "  " .
	             '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
    	    echo "<br><br>";
	
	        echo "<table border='2'>
	        
	        <tr>
	        <th>Сервиз</th>
	        <th>Обслужване на</th>
            <th>Дата на обслужване</th>
            <th>Километри</th>
            <th>След километри</th>
            <th>След дата</th>
            <th>Сума лв</th>
            <th>Фактура №</th>
	        </tr>";
	        
	        while($row = mysqli_fetch_array($serviceData))
	        {
	            echo "<tr>";
	            
	            echo "<td>" . $row['Service'] . "</td>"; 
	            echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Date_Of_Service'] . "</td>";
                echo "<td>" . $row['Km'] . "</td>";
                echo "<td>" . $row['After_Km'] . "</td>";
                echo "<td>" . $row['After_Date'] . "</td>";
                echo "<td>" . $row['Sum'] . "</td>";
                echo "<td>" . $row['Invoice'] . "</td>";	    
	            echo "</tr>";
	        }
	        echo "</table>";
	        echo "</div>";
	
	    }
	    
	    else {
	        echo "<br><br>";
	        echo"<div align = 'center'>";
    	    echo '<span style="font-size: 20px; color:black;">Няма данни за сервиз на МПС с регистрационен №</span>' . "  " .
	             '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
    	    echo "<br><br>";
	        
	    }
    	
    	$repairData =  mysqli_query($con, "SELECT * FROM repair WHERE AutosID = '$autoId'"); 
    	
    	if (mysqli_num_rows($repairData) > 0) {
    	    
    	    echo "<br><br>";
	        echo"<div align = 'center'>";
    	    echo '<span style="font-size: 20px; color:black;">Данни за ремонт на МПС с регистрационен №</span>' . "  " .
	             '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
    	    echo "<br><br>";
    	    echo "<table border='2'>
	    
	        <tr>
            <th>Ремонт вид</th>
            <th>Ремонт на</th>
            <th>Километри</th>
            <th>Смяна на</th>
            <th>Сума лв</th>
            <th>Фактура №</th>
            <th>Дата</th>
            </tr>";
	        
	        while($row = mysqli_fetch_array($repairData))
	        {
	            echo "<tr>";
                echo "<td>" . $row['Repair_Type'] . "</td>";
                echo "<td>" . $row['Repair_Of'] . "</td>";
                echo "<td>" . $row['Km'] . "</td>";
                echo "<td>" . $row['Change_Of'] . "</td>";
                echo "<td>" . $row['Sum'] . "</td>";
                echo "<td>" . $row['Invoice'] . "</td>";
                echo "<td>" . $row['Date'] . "</td>";
                echo "</tr>";
	        }
	        echo "</table>";
	        
    	}
    	
    	else {
	        echo "<br><br>";
	        echo"<div align = 'center'>";
    	    echo '<span style="font-size: 20px; color:black;">Няма данни за ремонт на МПС с регистрационен №</span>' . "  " .
	             '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
    	    echo "<br><br>";
	        
	    }
    	
    	
    	$tyresData =  mysqli_query($con, "SELECT * FROM tyres WHERE AutosID = '$autoId'"); 
    	
    	if (mysqli_num_rows($tyresData) > 0) {
    	    
    	    echo "<br><br>";
	        echo"<div align = 'center'>";
    	    echo '<span style="font-size: 20px; color:black;">Данни за гуми на МПС с регистрационен №</span>' . "  " .
	             '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
    	    echo "<br><br>";
    	    echo "<table border='2'>
	    
	        <tr>
		    <th>Вид гуми</th>
		    <th>Дата на закупуване</th>
		    <th>Размер</th>
		    <th>Цена лв</th>
		    <th>Съхранявани в</th>
		    <th>Използваемост</th>
	        </tr>";
	        
	        while($row = mysqli_fetch_array($tyresData))
	        {
	            echo "<tr>";
		        echo "<td>" . $row['Type'] . "</td>";
		        echo "<td>" . $row['Date'] . "</td>";
		        echo "<td>" . $row['Size'] . "</td>";
		        echo "<td>" . $row['Price'] . "</td>";
		        echo "<td>" . $row['Saved_In'] . "</td>";
		        echo "<td>" . $row['Usability'] . "</td>";	    
	            echo "</tr>";
	        }
	        echo "</table>";
	        echo "</div>";
	        echo "<br><br>";
    	}
    	
    	else {
	        echo "<br><br>";
	        echo"<div align = 'center'>";
    	    echo '<span style="font-size: 20px; color:black;">Няма данни за гуми на МПС с регистрационен №</span>' . "  " .
	             '<span style="font-size: 20px; color:red;">' . $_POST['Reg_Number'] . '</span>';
    	    echo "<br><br>";
	        
	    }
	    
	    mysqli_close($con);
  
}
	
    echo"</div>";
?>	

<br><br>
<script> 

/*
$(document).ready(function (){
    var ID = "";
    var tables = document.getElementsByTagName("table");
    for (var i = 0; i < tables.length; i++) {
        if(tables[i].id != "")
            ID = tables[i].id;
    }
            //$("#click").click(function (){
            
                $('html, body').animate({
                    scrollTop: $("#" + ID).offset().top - 200
                }, 2000);
            
            
            //});
        });


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

*/
</script>

</body>
</html>