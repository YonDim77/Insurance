<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['usernameHolding'])) {
header('Location: index.php');
}


include 'functions.php';

$con = connectServer();

$query1 = "SELECT Reg_Number FROM autos WHERE Reg_Number = ?";

$stmt = mysqli_prepare($con, $query1);
mysqli_stmt_bind_param($stmt, 's', $_GET['q']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $col1);


while (mysqli_stmt_fetch($stmt)) {
        //printf("%s\n", $col1);

    
    $_SESSION['holdingFirmAutoRegNumber'] = $col1;
        
}
    mysqli_close($con);
    
?>
    
   