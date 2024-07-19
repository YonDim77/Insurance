<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}


include 'functions.php';

$con = connectServer();

$query1 = "SELECT Admin_Username FROM holding Where Name = ?";

$stmt = mysqli_prepare($con, $query1);
mysqli_stmt_bind_param($stmt, 's', $_GET['q']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $col1);


while (mysqli_stmt_fetch($stmt)) {
        //printf("%s\n", $col1);

?>
    Подадминистратор*<br><input type="text" name="Admin_Username" value="<?php echo  $col1; ?>" required="required" placeholder = "Подадмин" readonly>
    
<?php
        
    }
    mysqli_close($con);
    
?>
    
   