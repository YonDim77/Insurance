<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername']) && !isset($_SESSION['adminUsername']) && !isset($_SESSION['subAdminUsername'])) {
header('Location: index.php');
}

include 'functions.php';

$con = connectServer();

 $data = mysqli_query($con, "SELECT * FROM discount");
 $goYes = 0;
 $gtpYes = 0;
 $kaskoYes = 0;
 $vinetkaYes = 0;
 $otherYes = 0;
 $no = 0;
 $one = 1;
 
// $tp1 = 1;
// $tp2 = 1;
// $tp3 = 1;
 
 if(mysqli_num_rows($data) == 1) {
     while($row = mysqli_fetch_array($data)) {
         $goYes = $row['GO'];
         $gtpYes = $row['GTP'];
         $kaskoYes = $row['Kasko'];
         $vinetkaYes = $row['Vinetka'];
         $otherYes = $row['Other'];
     }
 }
 
 //if(isset($_GET['q'])) {
 if(strlen($_GET['q']) > 0) {
    $query1 = "SELECT TP1 FROM tariffplan Where Type_MPS = ?";
               
    $stmt = mysqli_prepare($con, $query1);
    mysqli_stmt_bind_param($stmt, 's', $_GET['q']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $col1);
    
    while (mysqli_stmt_fetch($stmt))
        
        $_SESSION['valueTP1'] = $col1;
    
    $query2 = "SELECT TP2 FROM tariffplan Where Type_MPS = ?";
               
    $stmt1 = mysqli_prepare($con, $query2);
    mysqli_stmt_bind_param($stmt1, 's', $_GET['q']);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_store_result($stmt1);
    mysqli_stmt_bind_result($stmt1, $col2);
    
    while (mysqli_stmt_fetch($stmt1))
      $_SESSION['valueTP2'] = $col2;
    
    $query3 = "SELECT TP3 FROM tariffplan Where Type_MPS = ?";
               
    $stmt2 = mysqli_prepare($con, $query3);
    mysqli_stmt_bind_param($stmt2, 's', $_GET['q']);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_store_result($stmt2);
    mysqli_stmt_bind_result($stmt2, $col3);
     
    while (mysqli_stmt_fetch($stmt2))
       $_SESSION['valueTP3'] = $col3;
       
 }
 //else {
 //    $_SESSION['valueTP1'] = 1;
 //    $_SESSION['valueTP2'] = 1;
 //    $_SESSION['valueTP3'] = 1;
 //}
  
 mysqli_close($con);


if(isset($_GET['qGO'])) {
    if(strcmp($_GET['qGO'], "да") == 0)
        $_SESSION['valueGO'] = $goYes;
    else 
        $_SESSION['valueGO'] = $no;    
}


if(isset($_GET['qGTP'])) {
    if(strcmp($_GET['qGTP'], "да") == 0)
        $_SESSION['valueGTP'] = $gtpYes; 
    else 
        $_SESSION['valueGTP'] = $no;
}


if(isset($_GET['qKasko'])) {
    if(strcmp($_GET['qKasko'], "да") == 0)
        $_SESSION['valueKasko'] = $kaskoYes; 
    else 
        $_SESSION['valueKasko'] = $no;
}


if(isset($_GET['qVinetka'])) {
    if(strcmp($_GET['qVinetka'], "да") == 0)
        $_SESSION['valueVinetka'] = $vinetkaYes; 
    else 
        $_SESSION['valueVinetka'] = $no;
}


if(isset($_GET['qOther'])) {
    if(strcmp($_GET['qOther'], "да") == 0)
        $_SESSION['valueOther'] = $otherYes; 
    else 
        $_SESSION['valueOther'] = $no;
}

    
if(isset($_GET['qTP'])){
    if(strcmp($_GET['qTP'], "ТП1") == 0)
        $_SESSION['valueTP'] =  $_SESSION['valueTP1']; 
        
    else if(strcmp($_GET['qTP'], "ТП2") == 0)
        $_SESSION['valueTP'] = $_SESSION['valueTP2'];
        
    else if(strcmp($_GET['qTP'], "ТП3") == 0)
        $_SESSION['valueTP'] = $_SESSION['valueTP3'];
    
    else
        $_SESSION['valueTP'] = 1;
}
//    $_SESSION['valueTP'] = $_GET['qTP'];
 
$_SESSION['valueMAT'] = ($one - ($_SESSION['valueGO'] + $_SESSION['valueGTP'] + $_SESSION['valueKasko'] + $_SESSION['valueVinetka'] + $_SESSION['valueOther']))*$_SESSION['valueTP'];



?>
<!--<option value="<?php echo $_SESSION['valueMAT']; ?>"><?php echo $_SESSION['valueMAT']; ?></option>-->

<input type="text" data-toggle="tooltip" title="MAT" name="MAT" value="<?php echo $_SESSION['valueMAT']; ?>" required="required" placeholder = "МАТ" readonly>
    
    


    
   