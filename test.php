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
<link rel="stylesheet" href="startCss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
body {
    
    background-image: linear-gradient(grey,  #990000);
    background-repeat: no-repeat;
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

<div class="menu">
  <ul class="menu-options">
    <li class="menu-option" style = "margin-top: -10px;"><a href="inputData.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Запис на данни за нова фирма/обект</a></li>
    <li class="menu-option"><a href="dataUpDate.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Актуализиране данни на фирма/обект</a></li>
    <li class="menu-option"><a href="showDataRegion.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Данни на фирми/обекти за дадено населено място </a></li>
    <li class="menu-option"><a href="showDataFirm.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Визуализиране данни на фирма </a></li>
    <li class="menu-option"><a href="lineData.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Данни на фирма/обект по зададен номер</a></li>
	<li class="menu-option"><a href="eraseData.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Изтриване на данни по зададен номер</a></li>
    <li class="menu-option" style = "margin-bottom: -20px;"><a href="editPW_UN.php" style = "color: red;" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='red'">Промяна на парола и потребителско име</a></li>
  </ul>
</div>

<nav class="navbar navbar-inverse" style = "margin-top:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
<!--      <a id = "brandMenu" class="navbar-brand" href="#" style = "color:red;">Буболечкоубийци</a>-->
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="BugK.png" alt="Insurance" width="150" height="20"></a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeMainAdmin.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
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

<script>
   // document.cookie = "mpsString = " +  mpsString;
    
function tariffPlan(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getGTP.php?q="+str, true);
  xhttp.send();
}

function gtpF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getGTP.php?qGO="+str, true);
  xhttp.send();
}

function matF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getGTP.php?qGTP="+str, true);
  xhttp.send();
}

function tpF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getGTP.php?qTP="+str, true);
  xhttp.send();
}
</script>

<?php

include 'functions.php';

//$_SESSION['valueMAT'] = 0;
//$_SESSION['valueGO'] = 0;
//$_SESSION['valueGTP'] = 0;
//$_SESSION['valueTP'] = 1;
//$_SESSION['valueTP1'] = 1;
//$_SESSION['valueTP2'] = 1;
//$_SESSION['valueTP3'] = 1;

//$con = connectServer();
//
// $data = mysqli_query($con, "SELECT * FROM discount");
// $goYes = 0;
// $gtpYes = 0;
// $no = 0;
// //$one = 1;
// 
// if(mysqli_num_rows($data) == 1) {
//     while($row = mysqli_fetch_array($data)) {
//         $goYes = $row['GO'];
//         $gtpYes = $row['GTP'];
//     }
//     
//     
// }
// mysqli_close($con);



?>

<div align = "left">
  <h3 style = "margin-left: 50px; color: white;">Отстъпки и ТП</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; margin-left: 150px;">      	    
    Вид МПС:<br><select id = "mps" name="Type_MPS"  onchange="tariffPlan(this.value)" required="required">*
    <option value=""></option>
    <option value="лек">лек</option>												   
    </select>
    <br><br>
	ТП:<br><select id = "tPlan" name="TP"  required="required" onchange="tpF(this.value)">*
    <option value="Избери ТП">Избери ТП</option> 
    <option value="ТП1">ТП1</option>
    <option value="ТП2">ТП2</option>
    <option value="ТП3">ТП3</option>
    </select>
    <br><br>
	ГО:<br><select name="GO"  required="required" onchange="gtpF(this.value)">*
	<option value="">Избери ГО, да или не</option> 
    <option value="да">да</option>
    <option value="не">не</option>	
    </select>
	<br><br>
    ГТП: <br><select id = "gtp" name="GTP"  required="required" onchange="matF(this.value)">*
    <option value="">Избери ГТП, да или не</option>
    <option value="да">да</option>
    <option value="не">не</option>
    	
    </select>
	<br><br>
	<!--МАТ:<br><input type="text" id = "mat" name="MAT" style = "width:174px; height: 27px;" required="required" >*-->
	МАТ: <br><select id = "mat" name="MAT" style = "width:174px; height: 27px;" required="required" >
    <option value=""></option>
    </select>
    <br><br>
	
    <input type="submit" name="btnSave" value="Запис" style = "border-radius: 2px; color: red;">  
  </form>
  <br><br>
 
<script> 

//var select = document.getElementById("mps");
//    select.onchange = function(){
//    mpsString = select.options[select.selectedIndex].value;
//    //alert(mpsString);
}

</script> 
 
<?php
//$myPhpVar= $_COOKIE['mpsString'];

	

$btnSave = false;

if(isset($_POST["btnSave"])) {
	$btnSave = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSave == true) {
    
    $con = connectServer();
      
    
    $sql="INSERT INTO test (TP, GO, GTP, MAT)
    VALUES
    ('$_POST[TP]', '$_POST[GO]', '$_POST[GTP]', '$_POST[MAT]')";
            
    
  
    if (mysqli_query($con, $sql)) {
        $last_id = mysqli_insert_id($con);      
  	    $message = "Данните са записани успешно!";
  	    echo "<script>alert('$message');</script>";
    }  
    else {  
  	$message = "Възникна грешка, опитайте отново!";
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