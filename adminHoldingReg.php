<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
header('Location: index.php');
}

include 'functions.php';

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

<script>

/*function showSubAdmin(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("subAdminValue").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("subAdminValue").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getSubAdmin.php?q="+str, true);
  xhttp.send();
}

function showAdmin(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("AdminValue").innerHTML = "<span style = 'color: red; font-weight: bold;'>Изберете холдинг!</span>";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("AdminValue").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getAdmin.php?q="+str, true);
  xhttp.send();
}
*/

function showSubAdmin1(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("subAdminValue1").innerHTML = "<span style = 'color: red; font-weight: bold;'>Изберете холдинг!</span>";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("subAdminValue1").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getSubAdmin1.php?q="+str, true);
  xhttp.send();
}

</script>

<div align = "center">
  <h3 style = "margin-top: 7.0vw;">Запис на данни на холдинг</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">
    <table class = "iDataInput"> 
        <tr>
            <!--<td>Избери подадмин<br><select style = "width: 174px; height: 27px;" name="Admin_Username"  onchange="showSubAdmin(this.value)" required="required">
                    <option value="">Избери подадмин*</option>
                          <?php
                              $con = connectServer();
                              $query = "SELECT * FROM admin";
                              $results=mysqli_query($con, $query);
                              //loop
                              foreach ($results as $admins){
                          ?>
                                  <option value="<?php echo $admins['username'];?>"><?php echo $admins['username'];?></option>
                          <?php
                              }
                              mysqli_close($con);
                              
                          ?>
                  
                    </select>
                </td>
                <input style = "display: none;" name="Admin_Username" value = "<?php echo $_SESSION['adminUsername']; ?>">-->
                <td>Избери потребител*<br><select  id="subAdminValue" style = "width: 174px; height: 27px;" name="Sub_Admin_Username" required="required">
                <option value="">Избери потребител*</option>
                    <?php
                        $con = connectServer();
                        $query = "SELECT * FROM subadmin WHERE Admin_Username = '$_SESSION[adminUsername]'";
                        $resultSA=mysqli_query($con, $query);
                        //loop
                        foreach ($resultSA as $subAdmins){
                    ?>
                        <option value="<?php echo $subAdmins['username'];?>"><?php echo $subAdmins['username'];?></option>
                    <?php
                        }
                        mysqli_close($con);
                        
                    ?>
                </select></td>
            
	        <td>Име холдинг*<br><input type="text" name="Ime" required="required" placeholder = "Задължително попълване"/></td>
                        
        </tr>
        
    </table><br><br><br>
    <input type="submit" name="btnSave" value="Запис" style = "border-radius: 2px; color: red; width: 174px;">
  </form>
  
 
<?php

$btnSave = false;
$btnSaveUser = false;

if(isset($_POST["btnSave"])) {
	$btnSave = true;
}

if(isset($_POST["btnSaveUser"])) {
	$btnSaveUser = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSave == true) {
  $con = connectServer();
   
  
    $sql="INSERT INTO holding (Admin_Username, Sub_Admin_Username, Name)
    VALUES
    ('$_SESSION[adminUsername]', '$_POST[Sub_Admin_Username]', '$_POST[Ime]')";
    
    
    mysqli_autocommit($con, FALSE);
  
    if (mysqli_query($con, $sql)) {
      mysqli_commit($con);
  	$message = "Данните са записани успешно!";
  	echo "<script>alert('$message');</script>";
    }  
    else {  
      mysqli_rollback($con);
  	$message = "Възникна грешка, опитайте отново! Дублиране име на холдинг!";
      echo "<script>alert('$message');</script>";
    }
     mysqli_query($con, "SET AUTOCOMMIT=TRUE");
  
     
  //}

mysqli_close($con);
	
	
}
 
?>

  <h3 style = "margin-top: 7.0vw;">Запис на данни на потребител към холдинг</h3>
  <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">
    <table class = "iDataInput"> 
        <tr>
            
            <td>Избери холдинг*<br><select style = "width: 174px; height: 27px;" name="Holding_Name" onchange="showSubAdmin1(this.value)" required="required" placeholder = "Задължително попълване"/>
                    <option value="">Избери холдинг</option>
                          <?php
                              $con = connectServer();
                              $query = "SELECT * FROM holding WHERE Admin_Username = '$_SESSION[adminUsername]'";
                              $results=mysqli_query($con, $query);
                              //loop
                              foreach ($results as $holdings){
                          ?>
                                  <option value="<?php echo $holdings['Name'];?>"><?php echo $holdings['Name'];?></option>
                          <?php
                              }
                              mysqli_close($con);
                              
                          ?>
                  
                    </select></td>
                    
            <!--<td><fieldset id = "AdminValue" >
            Подадминистратор*<br><input type = "text"  name="Admin_Username" value="" style = "width:174px; height: 26px;" placeholder = "Задължително попълване" required="required" readonly>
            </fieldset></td>-->   
            
                
            <td><fieldset id = "subAdminValue1" >
            Потребител*<br><input type = "text"  name="Sub_Admin_Username" value="" style = "width:174px; height: 26px;" placeholder = "Задължително попълване" required="required" readonly>
            </fieldset></td>
                        
        
            <td>Име*<br><input type="text" name="fName" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>    
            <td>Фамилия*<br><input type="text" name="lName" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Телефон*<br><input type="text" name="Telephone" required="required" placeholder = "Задължително попълване"></td>
	      
            <td>Потребителско име*<br><input type="email" name="Username" required="required" placeholder = "Задължително попълване"></td>
        </tr>    
        <tr>    
	        <td>Парола*<br><input type="password" name="Password" required="required" placeholder = "Задължително попълване"></td>
            
            <td>Парола<br>повторно въвеждане*<br><input type="password" name="checkPassword" required="required" placeholder = "Задължително попълване"></td>
            
        </tr>
        
    </table><br><br><br>
    <input type="submit" name="btnSaveUser" value="Запис" style = "border-radius: 2px; color: red; width: 174px;">
  </form>
  <br><br>

<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSaveUser == true) {
  $con = connectServer();
   
   $password = $_POST['Password'];
   $checkPassword = $_POST['checkPassword'];
//   $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

  if(strcmp($password, $checkPassword) != 0) {
      $message = "Паролите не съвпадат! Опитайте отново!";
  	  echo "<script>alert('$message');</script>";
  }
  else {

    $sqlUsernameCheck = "INSERT INTO usernames (username)
    VALUES
    ('$_POST[Username]')";
  
    $sql="INSERT INTO holdingusers (Holding_Name, Admin_Username, Sub_Admin_Username, First_Name, Last_Name, Telephone, Username, Password)
    VALUES
    ('$_POST[Holding_Name]', '$_SESSION[adminUsername]', '$_POST[Sub_Admin_Username]', '$_POST[fName]', '$_POST[lName]', '$_POST[Telephone]', '$_POST[Username]', '$password')";
    //('$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Ime]', '$_POST[Username]', '$password')";
    //('$_POST[Admin_Username]', '$_POST[Ime]', '$_POST[Familia]', '$_POST[Email]', '$_POST[Username]','$hashed_password')";
    
    
    mysqli_autocommit($con, FALSE);
  
    if (mysqli_query($con, $sqlUsernameCheck) && mysqli_query($con, $sql)) {
      $last_id = mysqli_insert_id($con);  
      mysqli_commit($con);
  	  $message = "Данните са записани успешно!";
  	  echo "<script>alert('$message');</script>";
    }  
    else {  
      mysqli_rollback($con);
  	  $message = "Възникна грешка, опитайте отново! Дублиране на потребителско име!";
      echo "<script>alert('$message');</script>";
    }
     mysqli_query($con, "SET AUTOCOMMIT=TRUE");
  
     
  }
  
    $resultInsert = mysqli_query($con, "SELECT * FROM holdingusers WHERE HoldingUsers_ID = $last_id");

    $h1 = " ";
    $h2 = " ";
    if ($h1 == " "){$color="#d8f0f3";}
    if ($h2 == " "){$color1="white";}
    
    echo "<br><br>";
    
    
    if($last_id > 0) {
        
        echo "<table border='2'>
        
        
        <tr>
        <th bgcolor='$color1'>$h2 Холдинг</th>
        <th bgcolor='$color1'>$h2 Потребител</th>
        <th bgcolor='$color1'>$h2 Име</th>
        <th bgcolor='$color1'>$h2 Фамилия</th>
        <th bgcolor='$color1'>$h2 Телефон</th>
        <th bgcolor='$color1'>$h2 Потребителско име</th>
        <th bgcolor='$color1'>$h2 Парола</th>
        </tr>";
        
        while($row = mysqli_fetch_array($resultInsert))
          {
          echo "<tr>";
          echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Holding_Name'] . "</td>";	
          //echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Admin_Username'] . "</td>";
          echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Sub_Admin_Username'] . "</td>";
          echo "<td style = 'border: 1px solid black; color: black;'>" . $row['First_Name'] . "</td>";
          echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Last_Name'] . "</td>";
          echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Telephone'] . "</td>";
          echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Username'] . "</td>";
          echo "<td style = 'border: 1px solid black; color: black;'>" . $row['Password'] . "</td>"; 
          echo "</tr>";
          }
        echo "</table>";
    }

mysqli_close($con);
	
	
}
 
?>
 
<br><br>  
</div>  
</body>
</html>