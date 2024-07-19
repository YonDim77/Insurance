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
    width: 80%;
}

th {
    text-align: center;
}

@media screen and (max-width: 767px) {
      table {
        width: 100%;
}

</style>
</head>
<body>  

<div id = "adminNav"></div>
<br>

<div align = "center">

<h3 style = "margin-top: 7.0vw;">Списък с потребители към холдинг:</h3>

<?php

include 'functions.php';

$con = connectServer();

$result = mysqli_query($con, "SELECT * FROM holdingusers WHERE Admin_Username = '$_SESSION[adminUsername]'");

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

echo "<br><br>";

echo "<table border='2'>


<tr>
<th bgcolor='$color1'>$h2 ID/№</th>
<th bgcolor='$color1'>$h2 Холдинг</th>
<th bgcolor='$color1'>$h2 Потребител</th>
<th bgcolor='$color1'>$h2 Име</th>
<th bgcolor='$color1'>$h2 Фамилия</th>
<th bgcolor='$color1'>$h2 Телефон</th>
<th bgcolor='$color1'>$h2 Потребителско име</th>
<th bgcolor='$color1'>$h2 Парола</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['HoldingUsers_ID'] . "</td>";
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Holding_Name'] . "</td>";	
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Sub_Admin_Username'] . "</td>";
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['First_Name'] . "</td>";
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Last_Name'] . "</td>";
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone'] . "</td>";
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Username'] . "</td>";
  echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Password'] . "</td>"; 
  echo "</tr>";
  }
echo "</table>";


mysqli_close($con);

?>


  
</div>  
</body>
</html>