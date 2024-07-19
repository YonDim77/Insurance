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
    margin-left: 28.0vw;
}

th {
    text-align: center;
}

td {
    text-align: center;
    color: black;
}

</style>
</head>
<body> 

<div id = "nav"></div>
<br>

<?php
$subAdmins = "subAdmins";
$individuals = "individuals";
$legalentities = "legalentities";
$auto = "auto";
$autoInsurance = "autoInsurance";
$autoService = "autoService";
$autoRepair = "autoRepair";
$autoTyres = "autoTyres";
?>

<div align = "left">
    <h3 style = "margin-top: 7.0vw; margin-left: 4.0vw;">История:</h3>

<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 150px;">
	<select name="type"  required="required" style = "height: 27px;">*
	<option value="">Избери история за:</option>
    <option value="<?php echo $subAdmins; ?>">потребители</option>												
    <option value="<?php echo $individuals; ?>">физически лица</option>
    <option value="<?php echo $legalentities; ?>">юридически лица</option>
    <option value="<?php echo $auto; ?>">общи данни на МПС</option>
    <option value="<?php echo $autoInsurance; ?>">данни за застраховки на МПС</option>
    <option value="<?php echo $autoService; ?>">данни за сервиз на МПС</option>
    <option value="<?php echo $autoRepair; ?>">данни за ремонт на МПС</option>
    <option value="<?php echo $autoTyres; ?>">данни за гуми на МПС</option>
    </select>
    <br><br>
	<input type="submit" name="btnHistory" value="Покажи списък" style = "border-radius: 2px; color: red;">  
</form>
  <br><br>
  
</div>	

<?php

$type = $_POST['type'];

switch($type)
{
    case $subAdmins: foreach(glob('history'.'/Потребител_ID*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break;
    case $individuals: foreach(glob('history/individuals'.'/Физическо_Лице_ЕГН:*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break;
    case $legalentities: foreach(glob('history/legalentities'.'/Юридическо_Лице_ЕИК:*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break;   
    case $auto: foreach(glob('history/general_data_autos'.'/Общи_Данни_МПС_Рег_№*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break; 
    case $autoInsurance: foreach(glob('history/insurance_data_autos'.'/Застраховки_МПС_Рег_№*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break;
    case $autoService: foreach(glob('history/service_data_autos'.'/Сервиз_МПС_Рег_№*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break;
    case $autoRepair: foreach(glob('history/repair_data_autos'.'/Ремонт_МПС_Рег_№*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break; 
    case $autoTyres: foreach(glob('history/tyres_data_autos'.'/Гуми_МПС_Рег_№*.xls') as $filename) {
                     echo "<span style = 'margin-left: 150px; color: red;'>Свали файл: </span>";
                     echo "<a style='font-size: 16px; color:black;' href = '$filename' download = '$filename'>$filename </a>"; 
                     echo "<br>";
                     }
                     break;                 
}
?>

  
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