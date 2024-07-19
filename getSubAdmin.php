<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}


include 'functions.php';

$con = connectServer();

$query1 = "SELECT username FROM subadmin Where Admin_Username = ?";

$stmt = mysqli_prepare($con, $query1);
mysqli_stmt_bind_param($stmt, 's', $_GET['q']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $col1);

?>

<option value="<?php echo "";?>"><?php echo "";?></option>

<?php

while (mysqli_stmt_fetch($stmt)) {
        //printf("%s\n", $col1);

?>
    <option value="<?php echo $col1;?>"><?php echo $col1;?></option>
<?php
        
    }
    mysqli_close($con);
    
?>
    
   