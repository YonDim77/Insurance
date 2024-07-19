<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
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

<div id = "adminNav"></div>

<br>  

<?php

$mps = "mps";
$mpsIns = "mpsIns";
$mpsServ = "mpsServ";
$mpsRep = "mpsRep";
$mpsTyr = "mpsTyr";

?>

<script>



</script>

<div align = "left">
    <h3 style = "margin-left: 100px; margin-top: 6.0vw;">Редактиране данни на МПС</h3><br>

<!--<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 150px;">
	<select name="type" required="required">*
	<option value="">Избери редактиране на:</option>
    <option value="<?php echo $mps; ?>">общи данни на МПС</option>												
    <option value="<?php echo $mpsIns; ?>">данни за застраховки на МПС</option>
    <option value="<?php echo $mpsServ; ?>">данни за сервиз на МПС</option>
    </select>
    <br><br>
	<input type="submit" name="btnUpdateAuto" value="Покажи" style = "border-radius: 2px; color: red;">  
</form>-->

<form name="input" style = "color: black; margin-left: 150px;">
	<select id="mpsValue" name="type"  onchange="loadPage()" required="required" style = "height: 25px;">*
	<option value="">Избери редактиране на:</option>
    <option value="mps">общи данни на МПС</option>												
    <option value="mpsIns">данни за застраховки на МПС</option>
    <option value="mpsServ">данни за сервиз на МПС</option>
    <option value="mpsRep">данни за ремонт на МПС</option>
    <option value="mpsTyr">данни за гуми на МПС</option>
    </select>
    <br><br>
</form>
  <br><br>
  
</div>	

<?php


//$type = $_POST['type'];
//
//
//	switch($type)
//	{
//		case $mps:    echo "<script> location.replace('adminUpdateGeneralDataAuto.php'); </script>";
//					  break;
//		case $mpsIns: echo "<script> location.replace('adminUpdateInsuranceDataAuto.php'); </script>";
//					  break;
//		case $mpsServ: echo "<script> location.replace('adminUpdateServiceDataAuto.php'); </script>";
//					  break;
//		case $mpsRep: echo "<script> location.replace('adminUpdateRepairDataAuto.php'); </script>";
//					  break;
//		case $mpsTyr: echo "<script> location.replace('adminUpdateTyresDataAuto.php'); </script>";
//					  break;			  
//	}


?>

  
<script>

//adminUserName = "";
//document.cookie = "adminUserName = " + adminUserName;

function loadPage() {
    
    var choice = document.getElementById("mpsValue").value;
    
    switch(choice)
	{
		case "mps":   location.replace('adminUpdateGeneralDataAuto.php');
					  break;
		case "mpsIns": location.replace('adminUpdateInsuranceDataAuto.php');
					  break;
		case "mpsServ": location.replace('adminUpdateServiceDataAuto.php');
					  break;
		case "mpsRep": location.replace('adminUpdateRepairDataAuto.php');
					  break;
		case "mpsTyr": location.replace('adminUpdateTyresDataAuto.php');
					  break;			  
		//default:  alert(choice);			  
	}    
}

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