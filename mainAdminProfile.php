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
<!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<div id = "nav"></div> 
<br> 

<?php

include 'functions.php';

$btnUpdate = false;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnUpdate"])) {
	$btnUpdate = true;
}

$ID = "";
$fName = "";
$lName = ""; 
$Email = ""; 
$saveUsername = "";
$password = ""; 

	
    $con = connectServer();
      
        $sql = "SELECT * FROM mainadmin";
        $result = mysqli_query($con, $sql);
    	
    	if(!mysqli_num_rows($result) >0){
    		
    		//echo"<br><br>";
    	    //echo"<div align = 'center'>";
    	    $message = "Възникна грешка, моля презаредете страницата!";
		    echo "<script>alert('$message');</script>";
		    die('Грешка: ' . mysqli_error($con));
    		//echo '<span style="font-size: 20px; color:red; ">Несъществуващ номер на данни!</span>';
    		//echo"<br><br><br><br>";
            //echo"</div>";
    	} 
     
      
        else {
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $ID = $row['ID'];
                $fName= $row['fName'];
                $lName = $row['lName'];
                $Email = $row['Email'];
                $saveUsername = $row['username'];
                $password = $row['password'];             
                
                $_SESSION['saveEmailUsername'] = $saveUsername;
    		}
    	}
	  
	  mysqli_close($con);
	  
	  
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con1 = connectServer();
      
      $password = $_POST['password'];
      $checkPassword = $_POST['checkPassword'];
      
      if(strcmp($password, $checkPassword) != 0) {
        $message = "Паролите не съвпадат! Опитайте отново!";
  	    echo "<script>alert('$message');</script>";
      }
      else {
          
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $zero1 = false; $one1 = false; $zero2 = false; $one2 = false; 
        
        $sqlUpdateUsernames ="UPDATE usernames SET username = '$_POST[username]' Where username = '$_SESSION[saveEmailUsername]'"; 
        
        $sqlUpdateMainAdmin="UPDATE mainadmin SET fName = '$_POST[fName]', lName = '$_POST[lName]', 
        Email = '$_POST[Email]', username = '$_POST[username]', password = '$hashed_password'
        Where ID = '$_POST[ID]'";
        
        mysqli_autocommit($con1, FALSE);
        mysqli_query($con1,"START TRANSACTION");
        
        $update1 = mysqli_query($con1, $sqlUpdateUsernames);
        if(mysqli_affected_rows($con1) == 0) {
            $zero1 = true;
        }
        if(mysqli_affected_rows($con1) >= 0) {
            $one1 = true;
        }
        
        $update2 = mysqli_query($con1, $sqlUpdateMainAdmin);
        if(mysqli_affected_rows($con1) == 0) {
            $zero2 = true;
        }
        if(mysqli_affected_rows($con1) >= 0) {
            $one2 = true;
        }
  
        //if($update1 && mysqli_affected_rows($con1) == 0 && $update2 && mysqli_affected_rows($con1) == 0){
        //  mysqli_query($con1,"COMMIT");
        if($zero1 == true && $zero2 == true) {
          mysqli_commit($con1);
          $message = "Няма промяна на данни!";
          echo "<script>alert('$message');</script>";
          
        } 
        //else if($update1 && mysqli_affected_rows($con1) >= 0 && $update2 && mysqli_affected_rows($con1) == 1){
        //  mysqli_query($con1,"COMMIT");
        else if($one1 == true && $one2 == true) {
          mysqli_commit($con1);
          $_SESSION['mainAdminfName'] = $_POST['fName'];
          $_SESSION['mainAdminlName'] = $_POST['lName'];
          $message = "Данните са актуализирани успешно!";
          echo "<script>alert('$message');</script>";
          echo "<script> location.replace('mainAdminProfile.php'); </script>"; 
          
        }
        else {
          //mysqli_query($con1,"ROLLBACK");
          mysqli_rollback($con1);
          $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име!";
          echo "<script>alert('$message');</script>";
        }
        mysqli_query($con1, "SET AUTOCOMMIT=TRUE");
      }
      
/*      $sqlShowUpdatedData = mysqli_query($con1, "SELECT * FROM admin WHERE ID = '$_POST[ID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table style = 'margin-top: 6.0vw;' border='2'>
	    
	    
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
*/      
      mysqli_close($con1);
	}
?>	

<div align = "center">
  <h3 style = "margin-top: 7.0vw;">Моят профил</h3>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <input type="number" name="ID" value = "<?php echo $ID;?>" style = "display: none;">
	<br><br>
	<table class = "iDataInput">
	    <tr>
            <td>Име*<br><input type="text" name="fName"  value = "<?php echo $fName; ?>"required="required" placeholder = "Задължително попълване"/></td>
            
            <td>Фамилия*<br><input type="text" name="lName" value = "<?php echo $lName; ?>" required="required" placeholder = "Задължително попълване"/></td>
            
            <td>Имейл*<br><input type="email" name="Email" value = "<?php echo $Email; ?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td>Имейл като<br>потребителско име*<br><input type="email" name="username" value = "<?php echo $saveUsername; ?>" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Парола*<br><input type="password" name="password" value = "" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Парола<br>повторно въвеждане*<br><input type="password" name="checkPassword" value = "" required="required" placeholder = "Задължително попълване"></td>
        </tr>
    </table>
    <br><br>
    <input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;">  
  </form>
  <br><br>
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


</script>
		  
</body>		  
</html>