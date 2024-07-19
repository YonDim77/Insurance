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

$btnUpdate = false;

if(isset($_POST["btnUpdate"])) {
	$btnUpdate = true;
}

	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con1 = connectServer();
               
      
        $zero1 = false; $one1 = false;  $zero2 = false; $one2 = false; $zero3 = false; $one3 = false;
        
        $sqlUpdateHoldingName ="UPDATE holding SET Name = '$_POST[holdingNameEdit]' Where Name = '$_POST[Holding_Name]'"; 
        $sqlUpdateHoldingNameL ="UPDATE legalentity SET Holding_Name = '$_POST[holdingNameEdit]' Where Holding_Name = '$_POST[Holding_Name]'";
        $sqlUpdateHoldingNameHU ="UPDATE holdingusers SET Holding_Name = '$_POST[holdingNameEdit]' Where Holding_Name = '$_POST[Holding_Name]'";
        
        mysqli_autocommit($con1, FALSE);
        mysqli_query($con1,"START TRANSACTION");
        
        $update1 = mysqli_query($con1, $sqlUpdateHoldingName);
        if(mysqli_affected_rows($con1) == 0) {
            $zero1 = true;
        }
        if(mysqli_affected_rows($con1) == 1) {
            $one1 = true;
        }
        
        $update2 = mysqli_query($con1, $sqlUpdateHoldingNameL);
        if(mysqli_affected_rows($con1) == 0) {
            $zero2 = true;
        }
        if(mysqli_affected_rows($con1) >= 1) {
            $one2 = true;
        }
        
        $update1 = mysqli_query($con1, $sqlUpdateHoldingNameHU);
        if(mysqli_affected_rows($con1) == 0) {
            $zero3 = true;
        }
        if(mysqli_affected_rows($con1) >= 1) {
            $one3 = true;
        }
        
  
        //if($update1 && mysqli_affected_rows($con1) == 0 && $update2 && mysqli_affected_rows($con1) == 0){
        //  mysqli_query($con1,"COMMIT");
        if($zero1 == true && $zero2 == true && $zero3 == true) {
          mysqli_commit($con1);
          $message = "Няма промяна на данни!";
          echo "<script>alert('$message');</script>";
          
        } 
        //else if($update1 && mysqli_affected_rows($con1) >= 0 && $update2 && mysqli_affected_rows($con1) == 1){
        //  mysqli_query($con1,"COMMIT");
        else if($one1 == true && $one2 == true && $one3 == true) {
          mysqli_commit($con1);
          $message = "Данните са актуализирани успешно!";
          echo "<script>alert('$message');</script>";
          
        }
        else if($one1 == true && $one2 == false && $one3 == false) {
          mysqli_commit($con1);
          $message = "Данните са актуализирани успешно!";
          echo "<script>alert('$message');</script>";
          
        }
        else if($one1 == true && $one2 == false && $one3 == true) {
          mysqli_commit($con1);
          $message = "Данните са актуализирани успешно!";
          echo "<script>alert('$message');</script>";
          
        }
        else if($one1 == true && $one2 == true && $one3 == false) {
          mysqli_commit($con1);
          $message = "Данните са актуализирани успешно!";
          echo "<script>alert('$message');</script>";
          
        }
        else {
          //mysqli_query($con1,"ROLLBACK");
          mysqli_rollback($con1);
          $message = "Възникна грешка, опитайте отново! Дублиране име на холдинг!";
          echo "<script>alert('$message');</script>";
        }
        mysqli_query($con1, "SET AUTOCOMMIT=TRUE");
      
      
      
      
      mysqli_close($con1);
	}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw;">Актуализиране име на холдинг</h3>
  
  <br><br>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <select id = "hName" style = "width: 174px; height: 27px;" name="Holding_Name" onchange = "getHoldingName()" required = "required">
        <option value="">Изберете холдинг</option>
              <?php
                  $con = connectServer();
                  $query = "SELECT * FROM holding WHERE Sub_Admin_Username = '$_SESSION[subAdminUsername]'";
                  $results=mysqli_query($con, $query);
                  //loop
                  foreach ($results as $holdings){
              ?>
        <option value="<?php echo $holdings['Name'];?>"><?php echo $holdings['Name'];?></option>
              <?php
                  }
                  mysqli_close($con);
                  
              ?>
                  
    </select>
	<br><br>
	<table class = "iDataInput">
	    <tr>
	        <td></td>
	        <td>Холдинг<br><input id = "hNameEdit" type="text" name="holdingNameEdit"  required="required"></td>
	        <td></td>
	    </tr>
	    
    </table>
    <br><br>
    <input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;">  
  </form>
  <br><br>
</div>	  
<script>

function getHoldingName() {
    
    var hName = document.getElementById("hName").value;
    document.getElementById("hNameEdit").value = hName;
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


</script>
		  
</body>		  
</html>