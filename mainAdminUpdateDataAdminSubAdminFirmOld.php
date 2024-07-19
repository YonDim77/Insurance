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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="startCss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
body {
    
    background-image: linear-gradient(grey, #990000);
    background-repeat: no-repeat;
}
</style>
</head>
<body> 

<div class="menu">
  <ul class="menu-options">
    <li class="menu-option" style = "margin-top: -10px;"><a href="inputData.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Запис на данни за нова фирма/обект</a></li>
    <li class="menu-option"><a href="dataUpDate.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Актуализиране данни на фирма/обект</a></li>
    <li class="menu-option"><a href="showDataRegion.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Данни на фирми/обекти за дадено населено място </a></li>
    <li class="menu-option"><a href="showDataFirm.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Визуализиране данни на фирма </a></li>
    <li class="menu-option"><a href="lineData.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Данни на фирма/обект по зададен номер</a></li>
	<li class="menu-option"><a href="eraseData.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Изтриване на данни по зададен номер</a></li>
    <li class="menu-option" style = "margin-bottom: -20px;"><a href="editPW_UN.php" style = "color: red;" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='red'">Промяна на парола и потребителско име</a>
  </ul>
</div>

<nav class="navbar navbar-inverse" style = "margin-top:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
<!--      <a id = "brandMenu" class="navbar-brand" href="#" style = "color:red;">Буболечкоубийци</a>-->
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="BugK.png" alt="BugKillers" width="150" height="20"></a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeMainAdmin.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
      <li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="services.html" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Администрация<span class="caret"></span></a>
	  <ul class="dropdown-menu">
<!--	      <li id = "sprayer" style = "background-color: white; color: white; margin-top:0px;">AAAA<img src="Sprayer.jpg" alt="BugKillers" width="60" height="50" style = "border-radius: 5px;"></li>-->
          <li><a href="mainAdminInputDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за физическо лице</a></li>
          <li><a href="mainAdminAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на подаминистратор</a></li>
		  <li><a href="mainAdminSubAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на потребител</a></li>
		  <li><hr style = "margin: 0px; border: 1px solid grey;"></li>
		  <li><a href="mainAdminShowDataAllPersons.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на всички физически лица</a></li>
		  <li><a href="mainAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на физическо лице</a></li>
		  <li><a href="mainAdminShowAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на подаминистратор</a></li>
          <li><a href="mainAdminShowSubAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на потребител</a></li>		  
		  <li><hr style = "margin: 0px; border: 1px solid grey;"></li>
		  <li><a href="mainAdminUpdateDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на физическо лице</a></li>
		  <li><hr style = "margin: 0px; border: 1px solid grey;"></li>
		  <li><a href="lineData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Данни на фирма/обект по зададен номер</a></li>          
	      <li><a href="editPW_UN.php" style = "color: red;" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='red'">Промяна на парола и потребителско име</a></li>
	  </ul>
      </li>
	  
      <li id = "listGallery"><a href="showData.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Извеждане на данни за всички фирми/обекти</a></li>
      <li><a href="logout.php" onMouseOver="this.style.backgroundColor='red'" onMouseOut="this.style.backgroundColor=''">Изход</a></li>
	  	
	</ul>	
  </div>
</nav> 

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

$Individual_ID = "";
$Admin_Username = "";
$Sub_Admin_Username = ""; 




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
                $Admin_Username = $row['Admin_Username'];
                $Sub_Admin_Username = $row['Sub_Admin_Username'];            
                
                //$_SESSION['saveEmailUsername'] = $Email_Username;
    		}
    	}
	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con = connectServer();
                            
		$admin = $_POST['Admin_Username'];
		$subAdmin = $_POST['Sub_Admin_Username'];
		
		if(strcmp($admin, $subAdmin) == 0) {
		   $message = "Грешка! Потребителските имена не трябва да съвпадат!";
   	       echo "<script>alert('$message');</script>"; 
		}
		else {
		    
          $sqlUpdateIndividual="UPDATE legalentity 
		  SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]' 
          Where Legalentity_ID = '$_POST[Legalentity_ID]'";
		  
		  $sqlUpdateIndividualAuto="UPDATE autos 
		  SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]' 
          Where Legalentity_ID = '$_POST[Legalentity_ID]'";
		  
		  $sqlUpdateIndividualInsurance="UPDATE insurance 
		  SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]' 
          Where Legalentity_ID = '$_POST[Legalentity_ID]'";
        
          mysqli_autocommit($con, FALSE);
          mysqli_query($con,"START TRANSACTION");
          $update1 = mysqli_query($con, $sqlUpdateIndividual);
          $update2 = mysqli_query($con, $sqlUpdateIndividualAuto);
		  $update3 = mysqli_query($con, $sqlUpdateIndividualInsurance);
        
          if ($update1 && mysqli_affected_rows($con) == 0 &&  $update2 && mysqli_affected_rows($con) == 0 &&  $update3 && mysqli_affected_rows($con) == 0) {
           mysqli_commit($con);
   	       $message = "Няма промяна на данни!";
   	       echo "<script>alert('$message');</script>";
          } 
          else if ($update1 && mysqli_affected_rows($con) == 1 &&  $update2 && mysqli_affected_rows($con) == 1 &&  $update3 && mysqli_affected_rows($con) == 1) {
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
        
		}
      
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$_POST[Legalentity_ID]'");
      $sqlShowUpdatedDataAuto = mysqli_query($con, "SELECT * FROM autos WHERE Legalentity_ID = '$_POST[Legalentity_ID]'");
      $sqlShowUpdatedDataInsurance = mysqli_query($con, "SELECT * FROM insurance WHERE Legalentity_ID = '$_POST[Legalentity_ID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	    echo "<div align = 'center'>";
	    echo "<br><br>";
	    echo '<span style="font-size: 20px; color: white; ">Данни на юридическо лице:</span>';
	    echo "<br><br>";
	    echo"</div>";
	    
	    echo "<table border='2'>
	    
	    
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
	      echo "<td>" . $row['Date'] . "</td>";
	      echo "</tr>";
	    }
	    echo "</table>";
	
	}
	
/*	if (mysqli_num_rows($sqlShowUpdatedDataAuto) > 0) {
	
	    
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор Потреб. име</th>
	    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedDataAuto))
	    {
	      echo "<tr>";
	      echo "<td>" . $row['Legalentity_ID'] . "</td>";
	      echo "<td>" . $row['Admin_Username'] . "</td>";
	      echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	      echo "</tr>";
	    }
	    echo "</table>";
	}
	
	if (mysqli_num_rows($sqlShowUpdatedDataInsurance) > 0) {
	
	
	    echo "<table border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Подадминистратор Потреб. име</th>
	    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedDataInsurance))
	    {
	      echo "<tr>";
	      echo "<td>" . $row['Legalentity_ID'] . "</td>";
	      echo "<td>" . $row['Admin_Username'] . "</td>";
	      echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	      echo "</tr>";
	    }
	    echo "</table>";
	}
*/      
      mysqli_close($con);
	}
?>	

<div align = "left">
  
  
  <h3 style = "text-align: center; margin-left: 50px; color: white;">Прехвърляне на юридическо лице от един подадминистратор/потребител към друг:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 150px;"> 
    <p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Legalentity_ID" value = "<?php echo $Legalentity_ID;?>" required="required" placeholder = "Задължително попълване">*
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 150px;">  
    <input type="number" name="Legalentity_ID" value = "<?php echo $Legalentity_ID;?>" style = "display: none;">
	<br><br>
    Подаминистратор<br>
    потребителско име:<br><input type="email" name="Admin_Username" value = "<?php echo $Admin_Username;?>" required ="required">
    <br><br>
    Потребител<br>
    потребителско име:<br><input type="email" name="Sub_Admin_Username" value = "<?php echo $Sub_Admin_Username;?>" required ="required">
    <br><br>
	
    <input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;">  
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
		  
</body>		  
</html>