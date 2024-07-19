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

$ID = "";
$adminUsername = $_SESSION['adminUsername'];
$fName = "";
$lName = ""; 
$Email = ""; 
$saveUsername = "";
$fillPassword = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    $messageError = "<h2>Моля попълнете полето!</h2>";
      $ID = $_POST["ID"];
    
      
      if(strlen($ID)==0)
    	
      {
        echo $messageError;
      }
      
      else if (!filter_var($ID, FILTER_VALIDATE_INT)) {
        
		$message = "Въведете цяло число в полето ID!";
		echo "<script>alert('$message');</script>";		
    	
      } 
      
      else {   // if(filter_var($Nomer, FILTER_VALIDATE_INT)) {
    	  
    	$url_id = mysqli_real_escape_string($con, $_POST['ID']);
        $sql = "SELECT ID FROM subadmin WHERE ID='$url_id' AND Admin_Username = '".$adminUsername."'";
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
      
        $result = mysqli_query($con, "SELECT * FROM subadmin
    	                      WHERE ID = '$url_id'");
    	if (!$result) {
    	
    	die('Грешка: ' . mysqli_error($con));
    	}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $ID = $row['ID'];
                $fName= $row['fName'];
                $lName = $row['lName'];
                $Email = $row['Email'];
                $saveUsername = $row['username'];
                $fillPassword = $row['password'];             
                
                $_SESSION['saveSubAdminUsername'] = $saveUsername;
    		}
    	}
	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con1 = connectServer();
      
      $password = $_POST['password'];
      $checkPassword = $_POST['checkPassword'];
      
      if(strcmp($password, $checkPassword) != 0) {
        $message = "Паролите не съвпадат! Опитайте отново!";
  	    echo "<script>alert('$message');</script>";
      }
      else {
      
        $sqlUpdateUsernames ="UPDATE usernames SET username = '$_POST[username]' Where username = '$_SESSION[saveSubAdminUsername]'"; 
        
        $sqlUpdateSubAdmin="UPDATE subadmin SET fName = '$_POST[fName]', lName = '$_POST[lName]', 
        Email = '$_POST[Email]', username = '$_POST[username]', password = '$_POST[password]'
        Where ID = '$_POST[ID]'";
        
        mysqli_autocommit($con1, FALSE);
        mysqli_query($con1,"START TRANSACTION");
        $update1 = mysqli_query($con1, $sqlUpdateUsernames); 
        $update2 = mysqli_query($con1, $sqlUpdateSubAdmin);
  
       
        if($update1 && mysqli_affected_rows($con1) == 0 && $update2 && mysqli_affected_rows($con1) == 0){
          mysqli_query($con1,"COMMIT");
          $message = "Няма промяна на данни!";
          echo "<script>alert('$message');</script>";
          
        } 
        else if($update1 && mysqli_affected_rows($con1) >= 0 && $update2 && mysqli_affected_rows($con1) == 1){
          mysqli_query($con1,"COMMIT");
          $message = "Данните са актуализирани успешно!";
          echo "<script>alert('$message');</script>";
          
        }
        else {
          mysqli_query($con1,"ROLLBACK");
          $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име!";
          echo "<script>alert('$message');</script>";
        }
        mysqli_query($con1, "SET AUTOCOMMIT=TRUE");
      
      }
      
      $sqlShowUpdatedData = mysqli_query($con1, "SELECT * FROM subadmin WHERE ID = '$_POST[ID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table style = 'margin-top: 7.0vw;' border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Име</th>
	    <th bgcolor='$color1'>$h2 Фамилия</th>
	    <th bgcolor='$color1'>$h2 Имейл</th>
	    <th bgcolor='$color1'>$h2 Имейл като <br> потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
	    echo "<tr>";
	    echo "<td>" . $row['ID'] . "</td>";
	    echo "<td>" . $row['fName'] . "</td>";	
	    echo "<td>" . $row['lName'] . "</td>";
	    echo "<td>" . $row['Email'] . "</td>";
	    echo "<td>" . $row['username'] . "</td>";
	    echo "<td>" . $row['password'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	
	}
      
      mysqli_close($con1);
	}
?>	

<div align = "center">
  
  
    <h3 style = "margin-top: 7.0vw;">Актуализиране данни на потребител</h3>
    <table class = "iDataInput">
        <tr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
              <td></td>
              <td><p id="demo" style = "margin-bottom: 0px;">ID*</p><input id = "numRec" oninput="checkInput()" type="number" name="ID" value = "<?php echo $ID;?>" required="required" placeholder = "Задължително попълване"></td>
              <td></td>
        </tr>
        <tr>
              <td></td>
              <td><input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;"></td>
              <td></td>
        </tr>
            </form>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
        <tr>      
              <input type="number" name="ID" value = "<?php echo $ID;?>" style = "display: none;">
              <td>Име*<br><input type="text" name="fName"  value = "<?php echo $fName; ?>"required="required" placeholder = "Задължително попълване"/></td>
              
              <td>Фамилия*<br><input type="text" name="lName" value = "<?php echo $lName; ?>" required="required" placeholder = "Задължително попълване"/></td>
              
              <td>Имейл*<br><input type="email" name="Email" value = "<?php echo $Email; ?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
              <td>Потребителско име*<br><input type="email" name="username" value = "<?php echo $saveUsername; ?>" required="required" placeholder = "Задължително попълване"></td>
              
              <td>Парола*<br><input type="password" name="password" value = "<?php echo $fillPassword; ?>" required="required" placeholder = "Задължително попълване"></td>
              
              <td>Парола повторно въвеждане*<br><input type="password" name="checkPassword" value = "<?php echo $fillPassword;?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
              <td></td>
              <td><input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;"></td>
              <td></td>
        </tr>
            </form>

    </table>
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