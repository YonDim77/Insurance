<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}


include 'functions.php';

$con = connectServer();

$data = mysqli_query($con, "SELECT * FROM discount");
 //$goYes = 0;
 $gtpYes = 0;
 $no = 0;
 //$one = 1;
 
 if(mysqli_num_rows($data) == 1) {
     while($row = mysqli_fetch_array($data)) {
         //$goYes = $row['GO'];
         $gtpYes = $row['GTP'];
     }
     
     
 }

$valueGO = $_GET['q1'];


?>

<option value="<?php echo "";?>"><?php echo "";?></option>

<option value="<?php echo $gtpYes + $valueGO; ?>"><?php echo $gtpYes + $valueGO; ?></option>
<option value="<?php echo $no + $valueGO; ?>"><?php echo $no + $valueGO; ?></option>
<?php
        
    
    mysqli_close($con);
    
?>
    
   