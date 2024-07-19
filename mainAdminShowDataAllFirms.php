<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
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
table, th, td {
    border: 2px solid black;
    border-collapse: collapse;
    text-align: center;	
}
table, th {
	font-size: 16px;
	color: red;
}
table, td {
	font-size: 14px;
	color: black;
}
table {
	background-color: white;
}
tr:nth-child(even) {background-color: #d8f0f3;}
tr:hover  td {background-color:red; color: white;}

</style>
</head>
<body> 

<div class="menu">
  <ul class="menu-options">
    <li class="menu-option" style = "margin-top: -10px;"><a href="inputData.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Запис на данни на физическо лице</a></li>
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
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="BugK.png" alt="Insurance" width="150" height="20"></a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome" style = "margin-top: 3px;"><a href="homeMainAdmin.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
      <li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="services.html" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Опции<span class="caret"></span></a>
	  <ul class="dropdown-menu">
<!--	      <li id = "sprayer" style = "background-color: white; color: white; margin-top:0px;">AAAA<img src="Sprayer.jpg" alt="BugKillers" width="60" height="50" style = "border-radius: 5px;"></li>-->
          <li><a href="mainAdminInputDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за физическо лице</a></li>
          <li><a href="mainAdminAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на подаминистратор</a></li>
		  <li><a href="mainAdminSubAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на потребител</a></li>
		  <li><a href="mainAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на физическо лице</a></li>
		  <li><a href="mainAdminShowAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на подаминистратор</a></li>
          <li><a href="mainAdminShowSubAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на потребител</a></li>		  
		  <li><a href="lineData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Данни на фирма/обект по зададен номер</a></li>          
	      <li><a href="editPW_UN.php" style = "color: red;" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='red'">Промяна на парола и потребителско име</a></li>		  
	  </ul>
      </li>
	  
      <li id = "listGallery"><a href="mainAdminShowDataAllPersons.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Извеждане на данни за всички физически лица</a></li>
      <li><a href="logout.php" onMouseOver="this.style.backgroundColor='red'" onMouseOut="this.style.backgroundColor=''">Изход</a></li>
	  	
	</ul>	
  </div>
</nav>
<br>
<h2 style = "color: white; text-align: center;">Данни за всички юридически лица:</h2>

<?php

include 'functions.php';

$con = connectServer();
//$adminUsername = $_SESSION['username'];

$result = mysqli_query($con, "SELECT * FROM legalentity");

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

echo "<br><br><br><br>";

echo "<table border='2'>


<tr>
<th bgcolor='$color1'>$h2 №</th>
<th bgcolor='$color1'>$h2 Подадминистратор Потребителско име</th>
<th bgcolor='$color1'>$h2 Потребител Потребителско име</th>
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
<th bgcolor='$color1'>$h2 Имейл на лице за контакти</th>
<th bgcolor='$color1'>$h2 Имейл като потребителско име</th>
<th bgcolor='$color1'>$h2 Парола</th>
<th bgcolor='$color1'>$h2 Дата</th>
</tr>";

while($row = mysqli_fetch_array($result))
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


mysqli_close($con);

?>

<script>

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
//	window.addEventListener('contextmenu', function(e) {
    e.preventDefault();
//    e.preventDefault();
    
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
//    else if($(window).scrollTop() > menuDimension.y ) {
//		menuPosition.y = mousePosition.y + menuDimension.y;
//	}
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