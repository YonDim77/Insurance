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
<link rel="stylesheet" href="adminCss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script> 

    $(function(){
      $("#nav").load("nav.php"); 
    });
    
</script>

<style>
body {

}

table, th, td {
    text-align: center;

}

table {
    width: 50%;
}

</style>
</head>
<body>  

<div id = "nav"></div>
<br>


<div align = "center">
  <h3 style = "margin-top: 7.0vw;">Запис на отстъпки</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">      	    
    ГО:<br><input type="text" name="GO" required="required" placeholder = "Задължително попълване"/ onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
    ГТП: <br><input type="text" name="GTP" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
	Каско: <br><input type="text" name="Kasko" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
	Винетка: <br><input type="text" name="Vinetka" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
	Друго: <br><input type="text" name="Other" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
	<br><input type="number" value = "<?php $noRepeat = 0; echo $noRepeat;  ?>"name="NoRepeat" required="required" style = "display: none;">
    
    <input type="submit" name="btnSave" value="Запис" style = "border-radius: 2px; color: red;">  
  </form>
  <br><br>
 
<?php

include 'functions.php';	

$btnSave = false;

if(isset($_POST["btnSave"])) {
	$btnSave = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSave == true) {
    
    $con = connectServer();
      
    
    $sql="INSERT INTO discount (GO, GTP, Kasko, Vinetka, Other, NoRepeat)
    VALUES
    ('$_POST[GO]', '$_POST[GTP]', '$_POST[Kasko]', '$_POST[Vinetka]', '$_POST[Other]', '$_POST[NoRepeat]')";
            
    
  
    if (mysqli_query($con, $sql)) {
        $last_id = mysqli_insert_id($con);      
  	    $message = "Данните са записани успешно!";
  	    echo "<script>alert('$message');</script>";
    }  
    else {  
  	$message = "Таблицата има само един ред. Можете само да редактирате!";
    echo "<script>alert('$message');</script>";
    }    
   
  
    //$result = mysqli_query($con, "SELECT * FROM tariffplan WHERE Tariff_ID = $last_id");

    $h1 = " ";
    $h2 = " ";
    if ($h1 == " "){$color="#d8f0f3";}
    if ($h2 == " "){$color1="white";}


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