<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="startCss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
body {
    
    background-image: linear-gradient(grey,  #990000);
    background-repeat: no-repeat;
}
</style>
</head>
<body>  


<div align = "left">
  <h3 style = "margin-left: 50px; color: white;">Запис на данни на главен аминистратор</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 150px;">  
    
	Име:<br><input type="text" name="Ime" required="required" placeholder = "Задължително попълване"/>*
    <br><br>
    Фамилия:<br><input type="text" name="Familia" required="required" placeholder = "Задължително попълване"/>*
    <br><br>
    Имейл: <br><input type="email" name="Email" required="required" placeholder = "Задължително попълване">
    <br><br>
	Потребителско име: <br><input type="email" name="Username" required="required" placeholder = "Задължително попълване">
    <br><br>
	Парола: <br><input type="password" name="Password" required="required" placeholder = "Задължително попълване">
    <br><br>
    <input type="submit" name="btnSave" value="Запис" style = "border-radius: 2px; color: red;">  
  </form>
  <br><br>
 
<?php

$btnSave = false;

if(isset($_POST["btnSave"])) {
	$btnSave = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSave == true) {
  $con = mysqli_connect("localhost","stepsoft_admin","desibug82", "stepsoft_insurance");
   if(!$con)
     {
     die('Could not connect: ' . mysqli_error());
     }
   
   mysqli_select_db($con, "stepsoft_insurance");


mysqli_query($con, "SET CHARACTER SET utf8");

  $sqlUsernameCheck = "INSERT INTO usernames (username)
  VALUES
  ('$_POST[Username]')";
  
  $sql="INSERT INTO mainadmin (fName, lName, Email, username, password)
  VALUES
  ('$_POST[Ime]', '$_POST[Familia]', '$_POST[Email]', '$_POST[Username]','$_POST[Password]')";
  
  $userName = $_POST['Username'];
  $ColorW = "white";
  
  if(!mysqli_query($con, $sqlUsernameCheck))
  {
    //die('<b>Възникна грешка, опитайте отново!</b>: ' . mysql_error());
	echo"<br><br>";
	echo"<div align = 'center'>";
    echo '<span style="font-size: 20px; color:black;">Възникна грешка, опитайте отново! Дублиране на потребителско име!</span>'; // . " " .
	//'<span style="font-size: 20px; color:' . $ColorW . '">' .$userName . '</span>';
	echo"</div>";
  }
  
  else{
	if(!mysqli_query($con, $sql))
	{
		die('<b>Възникна грешка, опитайте отново!</b>: ' . mysql_error());
	}
	else
	{
		echo"<div align = 'center'>";
		echo"<span style='color:white; font-size: 20px;'>Данните са записани успешно!</span>";
		echo"</div>";
	}
  
  }

mysqli_close($con);
	
	
}
 
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