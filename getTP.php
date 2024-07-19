<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}


include 'functions.php';

$con = connectServer();


$query1 = "SELECT TP1 FROM tariffplan Where Type_MPS = ?";
           
$stmt = mysqli_prepare($con, $query1);
mysqli_stmt_bind_param($stmt, 's', $_GET['q']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $col1);

$query2 = "SELECT TP2 FROM tariffplan Where Type_MPS = ?";
           
$stmt1 = mysqli_prepare($con, $query2);
mysqli_stmt_bind_param($stmt1, 's', $_GET['q']);
mysqli_stmt_execute($stmt1);
mysqli_stmt_store_result($stmt1);
mysqli_stmt_bind_result($stmt1, $col2);

$query3 = "SELECT TP3 FROM tariffplan Where Type_MPS = ?";
           
$stmt2 = mysqli_prepare($con, $query3);
mysqli_stmt_bind_param($stmt2, 's', $_GET['q']);
mysqli_stmt_execute($stmt2);
mysqli_stmt_store_result($stmt2);
mysqli_stmt_bind_result($stmt2, $col3);

?>

<option value="<?php echo "";?>"><?php echo "";?></option>

<?php

while (mysqli_stmt_fetch($stmt)) {
        //printf("%s\n", $col1);

?>
    <option value="<?php echo $col1;?>">ТП1</option>
    
<?php

}

while (mysqli_stmt_fetch($stmt1)) {
    
    
?>
    <option value="<?php echo $col2;?>">ТП2</option>
    
<?php

}

while (mysqli_stmt_fetch($stmt2)) {
    
    
?>
    <option value="<?php echo $col3;?>">ТП3</option>
    
<?php

}



    mysqli_close($con);
    
?>
    
   