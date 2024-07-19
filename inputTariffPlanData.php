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

@media screen and (max-width: 767px) {
      table {
        width: 100%;
}

</style>
</head>
<body>  

<div id = "nav"></div>
<br>

<div align = "center">
  <h3 style = "margin-top: 7.0vw;">Запис на тарифни планове</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    Вид МПС:<br>
	<select name="Type_MPS" style = "width:174px; height: 27px;" required="required">*
    <option value="лек">лек</option>												
    <option value="лекотоварен">лекотоварен</option>
    <option value="камион">камион</option>
    <option value="влекач">влекач</option>
	<option value="селскостопански">селскостопански</option>
    <option value="индустриални">индустриални</option>
    <option value="мотоциклети">мотоциклети</option>
	<option value="яхти">яхти</option>
    <option value="каравани">каравани</option>
    <option value="ремаркета">ремаркета</option>
    </select>
    <br><br>
    ТП1:<br><input type="text" name="TP1" required="required" placeholder = "Задължително попълване"/ onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
    ТП2: <br><input type="text" name="TP2" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
	ТП3: <br><input type="text" name="TP3" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
    <br><br>
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
      
    
    $sql="INSERT INTO tariffplan (Type_MPS, TP1, TP2, TP3)
    VALUES
    ('$_POST[Type_MPS]', '$_POST[TP1]', '$_POST[TP2]', '$_POST[TP3]')";
            
    //mysqli_autocommit($con, FALSE);
    //mysqli_query($con,"START TRANSACTION");
  
    if (mysqli_query($con, $sql)) {
        $last_id = mysqli_insert_id($con);
        //mysqli_commit($con);
  	    $message = "Данните са записани успешно!";
  	    echo "<script>alert('$message');</script>";
    }  
    else {  
   // mysqli_rollback($con);
  	$message = "Възникна грешка, опитайте отново! Дублиране на вид МПС!";
    echo "<script>alert('$message');</script>";
    }
    
    //mysqli_query($con, "SET AUTOCOMMIT=TRUE");

  
    $result = mysqli_query($con, "SELECT * FROM tariffplan WHERE Tariff_ID = $last_id");

    $h1 = " ";
    $h2 = " ";
    if ($h1 == " "){$color="#d8f0f3";}
    if ($h2 == " "){$color1="white";}

    echo "<br><br>";

    echo "<div align = 'center'>";

    if($last_id > 0) {
    
        echo "<table border='2'>
        <tr>
        <th bgcolor='$color1'>$h2 ID/№</th>
        <th bgcolor='$color1'>$h2 Вид МПС</th>
        <th bgcolor='$color1'>$h2 ТП1</th>
        <th bgcolor='$color1'>$h2 ТП2</th>
        <th bgcolor='$color1'>$h2 ТП3</th>
        </tr>";
        
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['Tariff_ID'] . "</td>";
            echo "<td>" . $row['Type_MPS'] . "</td>";
            echo "<td>" . $row['TP1'] . "</td>";  
            echo "<td>" . $row['TP2'] . "</td>";
            echo "<td>" . $row['TP3'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    
    }

    mysqli_close($con);

}
	
	
?>

<br>
  
</div>  
</body>
</html>