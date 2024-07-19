<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['subAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="adminCss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script> 

    $(function(){
      $("#subAdminNav").load("subAdminNav.php"); 
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

<div id = "subAdminNav"></div> 
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
$holdingName = "";
$fName = "";
$lName = ""; 
$telephone = ""; 
$saveUsername = "";
$password = ""; 


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
        $sql = "SELECT HoldingUsers_ID FROM holdingusers WHERE HoldingUsers_ID='$url_id' AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'";
        $result1 = mysqli_query($con, $sql);
    	
    	if(!mysqli_num_rows($result1) >0){
    		
    		//echo"<br><br>";
    	    //echo"<div align = 'center'>";
    	    $message = "Несъществуващо ID или нямате достъп!";
		    echo "<script>alert('$message');</script>";
    		//echo '<span style="font-size: 20px; color:red; ">Несъществуващ номер на данни!</span>';
    		//echo"<br><br><br><br>";
            //echo"</div>";
    	} 
     
      
        else {
      
        $result = mysqli_query($con, "SELECT * FROM holdingusers
									  WHERE HoldingUsers_ID = '$_POST[ID]' AND Sub_Admin_Username = '$_SESSION[subAdminUsername]'");
    	if (!$result) {
    	
    	die('Грешка: ' . mysqli_error($con));
    	}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $ID = $row['HoldingUsers_ID'];
                $holdingName = $row['Holding_Name'];
                $fName= $row['First_Name'];
                $lName = $row['Last_Name'];
                $telephone = $row['Telephone'];
                $saveUsername = $row['Username'];
                $password = $row['Password'];             
                
                $_SESSION['saveEmailUsername'] = $saveUsername;
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
      
        $zero1 = false; $one1 = false; $zero2 = false; $one2 = false; 
        
        $sqlUpdateUsernames ="UPDATE usernames SET username = '$_POST[username]' Where username = '$_SESSION[saveEmailUsername]'"; 
        
        $sqlUpdateHoldingUsers="UPDATE holdingusers SET First_Name = '$_POST[fName]', Last_Name = '$_POST[lName]', 
        Telephone = '$_POST[telephone]', Username = '$_POST[username]', Password = '$_POST[password]'
        Where HoldingUsers_ID = '$_POST[ID]'";
        
        mysqli_autocommit($con1, FALSE);
        mysqli_query($con1,"START TRANSACTION");
        
        $update1 = mysqli_query($con1, $sqlUpdateUsernames);
        if(mysqli_affected_rows($con1) == 0) {
            $zero1 = true;
        }
        if(mysqli_affected_rows($con1) >= 0) {
            $one1 = true;
        }
        
        $update2 = mysqli_query($con1, $sqlUpdateHoldingUsers);
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
          $message = "Данните са актуализирани успешно!";
          echo "<script>alert('$message');</script>";
          
        }
        else {
          //mysqli_query($con1,"ROLLBACK");
          mysqli_rollback($con1);
          $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име!";
          echo "<script>alert('$message');</script>";
        }
        mysqli_query($con1, "SET AUTOCOMMIT=TRUE");
      }
      
      $sqlShowUpdatedData = mysqli_query($con1, "SELECT * FROM holdingusers WHERE HoldingUsers_ID = '$_POST[ID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table style = 'margin-top: 6.0vw;' border='2'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Холдинг</th>
	    <th bgcolor='$color1'>$h2 Име</th>
	    <th bgcolor='$color1'>$h2 Фамилия</th>
	    <th bgcolor='$color1'>$h2 Телефон*</th>
	    <th bgcolor='$color1'>$h2 Имейл като <br> потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
	    echo "<tr>";
	    echo "<td>" . $row['HoldingUsers_ID'] . "</td>";
	    echo "<td>" . $row['Holding_Name'] . "</td>";
	    echo "<td>" . $row['First_Name'] . "</td>";	
	    echo "<td>" . $row['Last_Name'] . "</td>";
	    echo "<td>" . $row['Telephone'] . "</td>";
	    echo "<td>" . $row['Username'] . "</td>";
	    echo "<td>" . $row['Password'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	
	}
      
      mysqli_close($con1);
	}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw;">Актуализиране данни на потребител към холдинг</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <p id="demo" style = "margin-bottom: 0px;">ID*</p><input id = "numRec" oninput="checkInput()" type="number" name="ID" value = "<?php echo $ID;?>" required="required" placeholder = "Задължително попълване">
	<br><br>
    <input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;">
  </form>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <input type="number" name="ID" value = "<?php echo $ID;?>" style = "display: none;">
	<br><br>
	<table class = "iDataInput">
	    <tr>
	        <td></td>
	        <td>Холдинг<br><input type="text" name="holdingName"  value = "<?php echo $holdingName; ?>"readonly></td>
	        <td></td>
	    </tr>
	    <tr>
            <td>Име*<br><input type="text" name="fName"  value = "<?php echo $fName; ?>"required="required" placeholder = "Задължително попълване"/></td>
            
            <td>Фамилия*<br><input type="text" name="lName" value = "<?php echo $lName; ?>" required="required" placeholder = "Задължително попълване"/></td>
            
            <td>Телефон*<br><input type="text" name="telephone" value = "<?php echo $telephone; ?>" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td>Имейл като<br>потребителско име*<br><input type="email" name="username" value = "<?php echo $saveUsername; ?>" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Парола*<br><input type="password" name="password" value = "<?php echo $password; ?>" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Парола<br>повторно въвеждане*<br><input type="password" name="checkPassword" value = "<?php echo $password;?>" required="required" placeholder = "Задължително попълване"></td>
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