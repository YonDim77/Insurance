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

<div align = "center">


 
<?php

include 'functions.php';

$btnSaveRepairAuto = false;
if(isset($_POST["btnSaveRepairAuto"])) {
	$btnSaveRepairAuto = true;
}

$btnSaveTyresAuto = false;
if(isset($_POST["btnSaveTyresAuto"])) {
	$btnSaveTyresAuto = true;
}

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$con = connectServer();

$resultAutoServiceOFE = mysqli_query($con, "SELECT * FROM service WHERE Service_ID = $_SESSION[lastAutoFirmServiceID]
                                            AND Type = 'масла и филтри'");

$resultAutoService = mysqli_query($con, "SELECT * FROM service WHERE Service_ID = $_SESSION[lastAutoFirmServiceID]");

if($_SESSION['lastAutoFirmServiceID'] > 0) {
  
  echo"<div align = 'center'>";
  echo "<br>"; 
  echo "<h3 style = 'margin-top: 4.0vw;'>Последно въведени данни за сервиз на МПС</h3>"; 
  echo "<br><br>";
  echo"</div>";
  
  if(mysqli_num_rows($resultAutoServiceOFE) < 1) {
    echo "<table border='2'>
      
    <tr>
    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
    <th bgcolor='$color1'>$h2 ID/№ на юридическо лице</th>
    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
    <th bgcolor='$color1'>$h2 Сервиз</th>
    <th bgcolor='$color1'>$h2 Обслужване на</th>
    <th bgcolor='$color1'>$h2 Дата на обслужване</th>
    <th bgcolor='$color1'>$h2 Километри</th>
    <th bgcolor='$color1'>$h2 След километри</th>
    <th bgcolor='$color1'>$h2 След дата</th>
    <th bgcolor='$color1'>$h2 Сума лв</th>
    <th bgcolor='$color1'>$h2 Фактура №</th>
    </tr>";
  }
  else {
    echo "<table border='2'>
      
    <tr>
    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
    <th bgcolor='$color1'>$h2 ID/№ на юридическо лице</th>
    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
    <th bgcolor='$color1'>$h2 Сервиз</th>
    <th bgcolor='$color1'>$h2 Обслужване на</th>
    <th bgcolor='$color1'>$h2 Дата на обслужване</th>
    <th bgcolor='$color1'>$h2 Километри</th>
    <th bgcolor='$color1'>$h2 След километри</th>
    <th bgcolor='$color1'>$h2 След дата</th>
    <th bgcolor='$color1'>$h2 Сума лв</th>
    <th bgcolor='$color1'>$h2 Фактура №</th>
    <th bgcolor='$color1'>$h2 Масла и филтри уведомление</th>
    </tr>";  
  }
  while($row = mysqli_fetch_array($resultAutoService))
  {
    echo "<tr>";
    echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
    echo "<td style='color:black;'>" . $row['Legalentity_ID'] . "</td>";
    //echo "<td style='color:black;'>" . $row['Admin_Username'] . "</td>";
    echo "<td style='color:black;'>" . $row['Sub_Admin_Username'] . "</td>";  
    echo "<td style='color:black;'>" . $row['Service'] . "</td>";
    echo "<td style='color:black;'>" . $row['Type'] . "</td>";
    echo "<td style='color:black;'>" . $row['Date_Of_Service'] . "</td>";
    echo "<td style='color:black;'>" . $row['Km'] . "</td>";
    echo "<td style='color:black;'>" . $row['After_Km'] . "</td>";
    echo "<td style='color:black;'>" . $row['After_Date'] . "</td>";
    echo "<td style='color:black;'>" . $row['Sum'] . "</td>";
    echo "<td style='color:black;'>" . $row['Invoice'] . "</td>";
    if(mysqli_num_rows($resultAutoServiceOFE) == 1) echo "<td style='color:black;'>" . $row['Oils_Filters_Email'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";  

}

mysqli_close($con);
?> 

<br>
<h3 style = "margin-top: 7.0vw;">Запис на данни за ремонти на МПС на юридическо лице:</h3><br>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        <tr>
            <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
            <td>ID/№ на МПС*<br><input  type="number" name="AutosID" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ID/№ на юридическо лице*<br><input  type="number" name="Legalentity_ID" required="required" placeholder = "Задължително попълване"></td>
            
            <input type="email" name="Admin_Username" value = "<?php echo $_SESSION['adminUsername']; ?>" style = "display: none;" />
	        
	        <td>Избери потребител*<br>
	        <select style = "width: 174px; height: 27px;" name="Sub_Admin_Username"   required="required">
	            <option value="">Избери потребител</option>
                        <?php
                            $con = connectServer();
                            $query = "SELECT * FROM subadmin WHERE Admin_Username = '$_SESSION[adminUsername]'";
                            $results=mysqli_query($con, $query);
                            //loop
                            foreach ($results as $subAdmins){
                        ?>
                                <option value="<?php echo $subAdmins['username'];?>"><?php echo $subAdmins['username'];?></option>
                        <?php
                            }
                            mysqli_close($con);
                            
                        ?>
            </select></td> 
        </tr>
        <tr>
            <td>Ремонт вид*<br>
            <select name="Repair_Type" style = "width:174px; height: 27px;" required="required">
            <option value="гаранционно">гаранционно</option>												
            <option value="редовно">редовно</option>
            </select></td>
            
            <td>Ремонт на*<br>
            <select name="Repair_Of" style = "width:174px; height: 27px;" required="required">
            <option value="двигател">двигател</option>												
            <option value="ходова част">ходова част</option>
            <option value="охлаждаща система">охлаждаща система</option>												
            <option value="скоростна кутия">скоростна кутия</option>
            <option value="климатична система">климатична система</option>												
            <option value="купе">купе</option>
            <option value="спирачки">спирачки</option>
            <option value="ел. система">ел. система</option>												
            <option value="фарове">фарове</option>
            <option value="Компютър">компютър</option>												
            <option value="други">други</option>
            </select></td>
            
            <td>Километри*<br><input type="number" name="Km"  required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td>Смяна на*<br><input type="text" name="Change_Of" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Сума лв*<br><input type="text" name="Sum" onkeypress="return (event.charCode == 44 || event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Фактура №*<br><input type="text" name="Invoice" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
            <td></td>
            <td>Дата*<br><input type="date" name="Date" required="required" placeholder = "Задължително попълване"></td>
            <td></td>
        </tr>
        
	        <!--<select name="Address_MPS" style = "width:174px; height: 27px;" required="required">*
            <option value="<?php //echo $address; ?>"><?php //echo $address; ?></option>												
            <option value="<?php //echo $address_MPS; ?>"><?php //echo $address_MPS; ?></option>
            </select>-->
            <br><br>
    </table>
    <br><br>
    <input type="submit" name="btnSaveRepairAuto" value="Запис" style = "width: 31%; border-radius: 2px; color: red;">  
  </form>
  <br><br>

<button id = "showTyresData" onclick = "showTyresData()" style = "border-radius: 2px; color: red; width: 31%;">Покажи запис на данни за сервиз на МПС на физическо лице</button>
<button id = "hideTyresData" onclick = "hideTyresData()" style = "border-radius: 2px; color: red; width: 31%; display: none;">Скрий запис на данни за сервиз на МПС на физическо лице</button>
<br>
<script>
    function showTyresData() {
        $(document.getElementById('autoTyresData')).toggle(1500); //.style.display = 'block';
        document.getElementById('showTyresData').style.display = 'none';
        document.getElementById('hideTyresData').style.display = 'block';
    }
    function hideTyresData() {
        $(document.getElementById('autoTyresData')).toggle(1500); //.style.display = 'none';
        document.getElementById('showTyresData').style.display = 'block';
        document.getElementById('hideTyresData').style.display = 'none';
    }
</script>  

  
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveRepairAuto == true) {
  $con2 = connectServer();
  $lastAutoInsuranceID = 0;
  
//  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID]");
  $CheckDuplicateEntry = mysqli_query($con2, "SELECT * FROM repair WHERE AutosID = $_POST[AutosID] 
                                  AND Repair_Of = '$_POST[Repair_Of]'
                                  AND Invoice = '$_POST[Invoice]'
                                  AND Date = '$_POST[Date]'");
  
  $idCheck = mysqli_query($con2, "SELECT * FROM insurance WHERE AutosID = $_POST[AutosID] 
                                  AND Legalentity_ID = $_POST[Legalentity_ID]
                                  AND Admin_Username = '$_POST[Admin_Username]'
                                  AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  $sqlInsertAutoRepair = "INSERT INTO repair (AutosID, Legalentity_ID, Admin_Username, Sub_Admin_Username, Repair_Type, Repair_Of, Km, Change_Of,  
                          Sum, Invoice, Date)
  VALUES
  ('$_POST[AutosID]', '$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Repair_Type]', '$_POST[Repair_Of]', 
  '$_POST[Km]', '$_POST[Change_Of]', '$_POST[Sum]', '$_POST[Invoice]', '$_POST[Date]')";
  
  mysqli_autocommit($con2, FALSE);
  mysqli_query($con2,"START TRANSACTION");
  
  if(mysqli_num_rows($CheckDuplicateEntry) > 0 || !$idCheck || mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAutoRepair)) //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  {
    mysqli_rollback($con2);
    $message = "Възникна грешка!Дублиране на данни на МПС, прескачане ред на въвеждане на данни или грешка в йерархията подадминистратор потребител!";
	echo "<script>alert('$message');</script>";
	//die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
  }
  else
  {
    $lastAutoRepairID = mysqli_insert_id($con2);
    mysqli_commit($con2);
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
  }
  mysqli_query($con2, "SET AUTOCOMMIT=TRUE");
  
  $resultAutoRepair = mysqli_query($con2, "SELECT * FROM repair WHERE Repair_ID = $lastAutoRepairID");

if($lastAutoRepairID > 0) {
    
    echo "<br>";
    echo "<table border='2'>
    
    <tr>
    <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
    <th bgcolor='$color1'>$h2 ID/№ на юридическо лице</th>
    
    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
    <th bgcolor='$color1'>$h2 Ремонт вид</th>
    <th bgcolor='$color1'>$h2 Ремонт на</th>
    <th bgcolor='$color1'>$h2 Километри</th>
    <th bgcolor='$color1'>$h2 Смяна на</th>
    <th bgcolor='$color1'>$h2 Сума лв</th>
    <th bgcolor='$color1'>$h2 Фактура №</th>
    <th bgcolor='$color1'>$h2 Дата</th>
    </tr>";
  

    while($row = mysqli_fetch_array($resultAutoRepair))
      {
      echo "<tr>";
      echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
      echo "<td style='color:black;'>" . $row['Legalentity_ID'] . "</td>";
      //echo "<td style='color:black;'>" . $row['Admin_Username'] . "</td>";
      echo "<td style='color:black;'>" . $row['Sub_Admin_Username'] . "</td>";  
      echo "<td style='color:black;'>" . $row['Repair_Type'] . "</td>";
      echo "<td style='color:black;'>" . $row['Repair_Of'] . "</td>";
      echo "<td style='color:black;'>" . $row['Km'] . "</td>";
      echo "<td style='color:black;'>" . $row['Change_Of'] . "</td>";
      echo "<td style='color:black;'>" . $row['Sum'] . "</td>";
      echo "<td style='color:black;'>" . $row['Invoice'] . "</td>";
      echo "<td style='color:black;'>" . $row['Date'] . "</td>";
      echo "</tr>";
      }
    echo "</table>";  
  
}

mysqli_close($con2);
	
	
}
 
?>

  <form id = "autoTyresData" name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "display: none;">  
    <h3 style = "margin-top: 40px;">Запис на данни за гуми на МПС на юридическо лице:</h3>
    <table class = "iDataInput">
        <tr>
            <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
            <td>ID/№ на МПС*<br><input  type="number" name="AutosID" required="required" placeholder = "Задължително попълване"></td>
            
            <td>ID/№ на юридическо лице*<br><input  type="number" name="Legalentity_ID" required="required" placeholder = "Задължително попълване"></td>
	        
	        <input type="email" name="Admin_Username" value = "<?php echo $_SESSION['adminUsername']; ?>" style = "display: none;" />
	        
	        <td>Избери потребител*<br>
	        <select style = "width: 174px; height: 27px;" name="Sub_Admin_Username"   required="required">
	            <option value="">Избери потребител</option>
                        <?php
                            $con = connectServer();
                            $query = "SELECT * FROM subadmin WHERE Admin_Username = '$_SESSION[adminUsername]'";
                            $results=mysqli_query($con, $query);
                            //loop
                            foreach ($results as $subAdmins){
                        ?>
                                <option value="<?php echo $subAdmins['username'];?>"><?php echo $subAdmins['username'];?></option>
                        <?php
                            }
                            mysqli_close($con);
                            
                        ?>
            </select></td> 
        </tr>
        <tr>
            <td>Вид гуми*<br>
            <select name="Type" style = "width:174px; height: 27px;" required="required">
            <option value="зимни">зимни</option>												
            <option value="летни">летни</option>
            <option value="всесезонни">всесезонни</option>
            </select></td>
            
            <td>Дата на закупуване*<br><input type="Date" name="Date" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Размер*<br><input type="text" name="Size" style = "width:174px; height: 27px;" required="required" placeholder = "AAA/BB/CC"
                   onkeypress="return (event.charCode >= 47 && event.charCode <= 57)"></td>
        </tr>
        <tr>
            <td>Цена лв*<br><input type="text" name="Price" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
        
            <td>Съхранявани в*<br><input type="text" name="Saved_In" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Използваемост*<br>
            <select name="Usability" style = "width:174px; height: 27px;" required="required">
            <option value="активни">активни</option>												
            <option value="неактивни">неактивни</option>
            </select></td>
        </tr>
    </table>
    <br><br>
    <input type="submit" name="btnSaveTyresAuto" value="Запис" style = "width: 31%; border-radius: 2px; color: red;">  
  </form>
  <br><br>
  
  <!--<button onclick = "location.href='mainAdminInputDataRepairAutoPerson.php'" style = "margin-left: 150px; border-radius: 2px; color: red;">Въвеждане на данни за ремонти и гуми на МПС</button>-->
  
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveTyresAuto == true) {
    
  $con2 = connectServer();
  $lastAutoTyresID = 0;

  
//  $idCheck = mysqli_query($con2, "SELECT * FROM individual WHERE Individual_ID = $_POST[Individual_ID]");
  
  $idCheck = mysqli_query($con2, "SELECT * FROM insurance WHERE AutosID = $_POST[AutosID] 
                                  AND Legalentity_ID = $_POST[Legalentity_ID]
                                  AND Admin_Username = '$_POST[Admin_Username]'
                                  AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'");
  
  $sqlInsertAutoTyres = "INSERT INTO tyres (AutosID, Legalentity_ID, Admin_Username, Sub_Admin_Username, Type, Date, Size, Price, Saved_In, Usability)
                           
  VALUES
  ('$_POST[AutosID]', '$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Type]', '$_POST[Date]', 
   '$_POST[Size]', '$_POST[Price]', '$_POST[Saved_In]', '$_POST[Usability]')";
  
  mysqli_autocommit($con2, FALSE);
  mysqli_query($con2,"START TRANSACTION");
  
  if(!$idCheck || mysqli_num_rows($idCheck) < 1 || !mysqli_query($con2, $sqlInsertAutoTyres)) //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  {
     mysqli_rollback($con2);
     $message = "Възникна грешка!Дублиране на ID/№ на МПС, грешно въведено ID или грешка в йерархията подадминистратор потребител!";
	 echo "<script>alert('$message');</script>";
	//die('<b>Възникна грешка, опитайте отново!</b>: ' . mysqli_error($con2));
  }
  else
  {
    $lastAutoTyresID = mysqli_insert_id($con2);
    mysqli_commit($con2);
    $message = "Данните са записани успешно!";
	echo "<script>alert('$message');</script>";
	//echo "<script> location.replace('mainAdminInputDataRepairAutoPerson.php'); </script>";
  }
  mysqli_query($con2, "SET AUTOCOMMIT=TRUE");
  
  $resultAutoTyres = mysqli_query($con2, "SELECT * FROM tyres WHERE Tyres_ID = $lastAutoTyresID");

if($lastAutoTyresID > 0) {
    
  echo "<table border='2'>
    
  <tr>
  <th bgcolor='$color1'>$h2 ID/№ на МПС</th>
  <th bgcolor='$color1'>$h2 ID/№ на юридическо лице</th>
  
  <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
  <th bgcolor='$color1'>$h2 Вид гуми</th>
  <th bgcolor='$color1'>$h2 Дата на закупуване</th>
  <th bgcolor='$color1'>$h2 Размер</th>
  <th bgcolor='$color1'>$h2 Цена лв</th>
  <th bgcolor='$color1'>$h2 Съхранявани в</th>
  <th bgcolor='$color1'>$h2 Използваемост</th>
  </tr>";
  


  while($row = mysqli_fetch_array($resultAutoTyres))
    {
        echo "<tr>";
        echo "<td style='color:black;'>" . $row['AutosID'] . "</td>";
        echo "<td style='color:black;'>" . $row['Legalentity_ID'] . "</td>";
        //echo "<td style='color:black;'>" . $row['Admin_Username'] . "</td>";
        echo "<td style='color:black;'>" . $row['Sub_Admin_Username'] . "</td>";  
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
echo "<br><br>";

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
const menu = document.querySelector(".menu");
let menuVisible = false;

const toggleMenu = command => {
  menu.style.display = command === "show" ? "block" : "none";
  menuVisible = !menuVisible;
};

const setPosition = ({ top, left }) => {
  menu.style.left = `${left}px`;
  menu.style.top = `${top}px`;
  toggleMenu("show");
};

window.addEventListener("click", e => {
  if(menuVisible)toggleMenu("hide");
});

window.addEventListener("contextmenu", e => {
    e.preventDefault();
    
    var mousePosition = {};
    var menuPosition = {};
    var menuDimension = {};
	
	$(document).ready(function(){
           
		menuDimension.x = $("div").outerWidth();  
		menuDimension.y = $("div").outerHeight(); 
		mousePosition.x = e.pageX; 
        mousePosition.y = e.pageY; 
 
    if (mousePosition.x + menuDimension.x > $(window).width() + $(window).scrollLeft()) {
        menuPosition.x = mousePosition.x - menuDimension.x - $(window).scrollLeft(); 
    } else {
        menuPosition.x = mousePosition.x;  
    }

    if (mousePosition.y + menuDimension.y > $(window).height()) {
         menuPosition.y = mousePosition.y - menuDimension.y - $(window).scrollTop(); 
     } 
	else if(mousePosition.y < menuDimension.y || $(window).scrollTop() > 0) {
		 menuPosition.y = mousePosition.y - $(window).scrollTop();
	 }
	else {
         menuPosition.y = mousePosition.y; 
     }
	
	  const origin = {
      left: menuPosition.x,
	   top: menuPosition.y
	};
	
	setPosition(origin);

});
   

  return false;       
  
});
 

</script> 
  
</div>  
</body>
</html>