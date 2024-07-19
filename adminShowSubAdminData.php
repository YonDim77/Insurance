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
    width: 70%;
}

th, td {
    border: 1px solid black;
    text-align: center;
}
.iDataInput td{
    border: none;
    height: 80px;
}

table.iDataInput {
    width: 100%;
    border: none;
}
</style>
</head>
<body>  

<div id = "adminNav"></div>

<br>

<div align = "center">

<h3 style = "margin-top: 7.0vw;">Списък с потребители:</h3>

<?php

include 'functions.php';

$con = connectServer();

$adminUsername = $_SESSION['adminUsername'];

$result = mysqli_query($con, "SELECT * FROM subadmin WHERE Admin_Username = '".$adminUsername."'");

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

echo "<br><br>";

if (mysqli_num_rows($result) > 0) {
  echo "<table border='2' style = ''>
  
  
  <tr>
  <th bgcolor='$color1'>$h2 №</th>
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