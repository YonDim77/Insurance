<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

$_SESSION['savePageNumber'] = $_POST['pageNumber'];

//$_SESSION['Admin_Username_Filter'] = $_POST['Admin_Username_Filter'];
//$_SESSION['Sub_Admin_Username_Filter'] = $_POST['Sub_Admin_Username_Filter'];

include 'functions.php';

?>

<!DOCTYPE html>
<html>
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="adminCss.css">

<script> 

    $(function(){
      $("#nav").load("nav.php"); 
    });
    
</script>

<style>



body {
    
}

table {
    margin-top: -150px;
    margin-left: 34.0vw;
}

th {
    text-align: center;
}

td {
    text-align: center;
    color: black;
}

</style>
</head>
<body> 

<div id = "nav"></div>

<br> 

<h3 style = "text-align: center; margin-top: 6.0vw;">Прехвърляне на физическо лице от един подадминистратор/потребител към друг:</h3>
<br><br>
<div align = "center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">
    № на страница:<input id = "pageN" type = "number"  style = "width: 50px;" name = "pageNumber" value = "<?php echo $_SESSION['savePageNumber']; ?>">
    <input type="submit" name="btnPage" value="Покажи" style = "border-radius: 2px; color: red;">
    </form>
    <br>
    <h3 style = "margin-left: 21.0vw;">Данни на физическо лице:</h3>

</div>

<script>

function showSubAdmin(str) {
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

</script>

<input type="submit" style = "position: fixed; top: 28.0vw; left: 5.0vw; border-radius: 2px; color: white; background-color: black;" onclick = "checkAll()" name="btnCheckAll" value="Маркирай/размаркирай всички">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">
    <select id = "sel" style = "position: fixed; top: 16.0vw; left: 5.0vw; width: 174px; height: 27px;" name="Admin_Username_Filter" onchange="showSubAdmin(this.value)">
        <option value="">Избери подадмин</option>
        <!--<option value="<?php if(strlen($_SESSION['Admin_Username_Filter']) > 0)  echo $_SESSION['Admin_Username_Filter']; else echo 'Избери подадмин';?>"><?php if(strlen($_SESSION['Admin_Username_Filter']) > 0)  echo $_SESSION['Admin_Username_Filter']; else echo 'Избери подадмин';?></option>-->
                
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
    <br><br>
    
    <br><!--<input style = "position: fixed; top: 22.0vw; left: 9.0vw;" type="email" name="Sub_Admin_Username" value = "<?php echo $Sub_Admin_Username;?>" placeholder = "Потреб. потреб. име" required ="required">-->
    <select id="subAdminValue" style = "position: fixed; top: 20.0vw; left: 5.0vw; width: 174px; height: 27px;" name="Sub_Admin_Username_Filter">
        <!--<option value="<?php if(strlen($_SESSION['Sub_Admin_Username_Filter']) > 0)  echo $_SESSION['Sub_Admin_Username_Filter']; else echo 'Избери потребител';?>"><?php if(strlen($_SESSION['Sub_Admin_Username_Filter']) > 0)  echo $_SESSION['Sub_Admin_Username_Filter']; else echo 'Избери потребител';?></option>
        <option value=""><?php if(strlen($_SESSION['Sub_Admin_Username_Filter']) > 0)  echo 'Избери потребител'; ?></option>-->
        <option value="">Избери потребител</option>
                
    </select>
    <br><br>
	
    <input type="submit" style = "position: fixed; top: 24.0vw; left: 5.0vw;" name="btnFilter" value="Филтриране" style = "border-radius: 2px; color: red;">

<?php

$btnFilter = false;
$btnUpdate = false;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnFilter"])) {
	$btnFilter = true;
}
if(isset($_POST["btnUpdate"])) {
	$btnUpdate = true;
}

$index = 0;
$checkboxId = 1;
$Individual_ID = array();
$Admin_Username = "";
$Sub_Admin_Username = ""; 
//$_SESSION['Admin_Username_Filter'] = ""; 
//$_SESSION['Sub_Admin_Username_Filter'] = ""; 
//$showIndividualData = true;

//if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFilter) {
    $con = connectServer();
    
    if((strlen($_POST['Admin_Username_Filter']) > 0 || strlen($_POST['Sub_Admin_Username_Filter']) > 0) && $btnFilter)
    {
        $_SESSION['Admin_Username_Filter'] = $_POST['Admin_Username_Filter'];
        $_SESSION['Sub_Admin_Username_Filter'] = $_POST['Sub_Admin_Username_Filter'];
    }
    
    if((strlen($_SESSION['Admin_Username_Filter']) > 0 && strlen($_SESSION['Sub_Admin_Username_Filter']) > 0) && $btnFilter)
    {
        $showIndividualData = mysqli_query($con, "SELECT * FROM individual WHERE Admin_Username = '$_SESSION[Admin_Username_Filter]' 
                                                  AND Sub_Admin_Username = '$_SESSION[Sub_Admin_Username_Filter]'");
    }
    
    else if((strlen($_SESSION['Admin_Username_Filter']) > 0 && strlen($_SESSION['Sub_Admin_Username_Filter']) == 0) && $btnFilter)
    {
        $showIndividualData = mysqli_query($con, "SELECT * FROM individual WHERE Admin_Username = '$_SESSION[Admin_Username_Filter]'");
    }
    
    // може и без следващия else if
    else if((strlen($_SESSION['Admin_Username_Filter']) == 0 && strlen($_SESSION['Sub_Admin_Username_Filter']) > 0) && $btnFilter)
    {
        $showIndividualData = mysqli_query($con, "SELECT * FROM individual WHERE Sub_Admin_Username = '$_SESSION[Sub_Admin_Username_Filter]'");
    }
    
    else 
    {
        $showIndividualData = mysqli_query($con, "SELECT * FROM individual");
    }
    
//    $showIndividualData = mysqli_query($con, "SELECT * FROM individual");



    $noDataPerson = true;
    
    if (mysqli_num_rows($showIndividualData) > 0) {
    //	    echo "<div align = 'center'>";
    	    echo "<br><br>";
    	    //echo '<span style="font-size: 20px; margin-left: 47.0vw;">Данни на физическо лице:</span>';
    	    echo "<br><br>";
    //	    echo"</div>";
    	    
    	   
    	    echo "<table border='2' id = 'iTable'>
    	    
    	    
    	    <tr>
    	    <th bgcolor='$color1'>$h2 Маркирай</th>
    	    <th bgcolor='$color1'>$h2 №</th>
    	    <th bgcolor='$color1'>$h2 Подадминистратор Потреб. име</th>
    	    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
    	    <th bgcolor='$color1'>$h2 Име и Фамилия</th>
    	    <th bgcolor='$color1'>$h2 ЕГН</th>
    
            </tr>";
            
            $i = 0; $page = 0; $inputPageValue = 1;
            //$inputPageValue = $_SESSION['savePageNumber'];
            if($_POST['pageNumber'] > 0)   
                $inputPageValue = $_POST['pageNumber'];
           // $_SESSION['savePageNumber'] = $inputPageValue;
            
            while($row = mysqli_fetch_array($showIndividualData))
    	    {
    	        
    	      $i++;     
    	      
    	      if($inputPageValue-1 == $page) {
    	        echo "<tr>";
    	        echo "<td>"; echo'<input id =  "' . $checkboxId . '" type = "checkbox"  name = "check' . $index . '">';echo"</td>";
    	        echo "<td>"; echo'<input style = "width: 50px;" type = "number" value="'. $row['Individual_ID']. '" name = "Individual_ID' . $index . '" readonly>'; echo"</td>";
    	        echo "<td>" . $row['Admin_Username'] . "</td>";
    	        echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
    	        echo "<td>" . $row['Names'] . "</td>";
    	        echo "<td>" . $row['EGN'] . "</td>";
    	        
    	        echo "</tr>";
    	        $noDataPerson = false; 
    	       
    	      }
    	      
    	      if($i % 10 == 0) {   
    	         $page++; 
    	      }
    	      
    	      if(isset($_POST['check' . $index . '']))
    	      {
    		  
    		    $Individual_ID[] = $_POST['Individual_ID' . $index . ''];
    		    //echo $Individual_ID[$i];
    		    //$i++;
    		    
    	      }
    	      
    	      $index++; $checkboxId++;
    	      
    	      if($inputPageValue == $page)
    	        break;
    	      
    	    }
    	    
    	    echo "</table>";
    	    
    	    if(!$row){
    	        echo "<br><br>";
    	        echo '<span style="font-size: 20px; margin-left: 53.0vw;">Няма повече данни!</span>'; 
    	    }
    	    if($noDataPerson)
    	        echo "<script>document.getElementById('iTable').style.display = 'none';</script>";
    	    
    	    
    }
    
  //  else
  //  {
  //      $message = "Въведете подадмин и потребител за филтриране на данни за физичесли лица!";
  // 	    echo "<script>alert('$message');</script>";
  //  }
      
    
    mysqli_close($con);
//}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con = connectServer();
                            
		$admin = $_POST['Admin_Username'];
		$subAdmin = $_POST['Sub_Admin_Username'];
		
		//$usernamesPairCheck = mysqli_query($con, "SELECT * FROM subadmin WHERE Admin_Username = '$_POST[Admin_Username]'
		//                                          AND username = '$_POST[Sub_Admin_Username]'");
		//
		if(strlen($admin) == 0 || strlen($subAdmin) == 0 || count($Individual_ID) == 0) {
		   $message = "Моля изберете подадминистратор и потребител и маркирайте!";
   	       echo "<script>alert('$message');</script>"; 
		}
		//else if(mysqli_num_rows($usernamesPairCheck) < 1) {
		//   $message = "Грешка! Промяна на йерархията подадминистратор потребител!";
   	    //   echo "<script>alert('$message');</script>";
		//}
		else {
		  
		  $updateCounter = 0; 
		  $noChangedData = 0;
		  $sizeArr = count($Individual_ID);  
		  //echo $sizeArr;
		  for ($x = 0; $x < $sizeArr; $x++) {
		  //    if(isset($_POST['check' . $x . '']))
	      //   {
		  //
		  //      $Individual_ID = $_POST['Individual_ID' . $x . ''];
		        //echo $Individual_ID[$x];
	      //   }
		      
		    $zeroIndividual = false; $oneIndividual = false; $zeroAutos = false; $oneAutos = false; $zeroInsurance = false; $oneInsurance = false;
		    $zeroService = false; $oneService = false; $zeroRepair = false; $oneRepair = false; $zeroTyres = false; $oneTyres = false;
		    $zeroDocuments = false; $oneDocuments = false;
		    
            $sqlUpdateIndividual="UPDATE individual 
		    SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]' 
            Where Individual_ID = '$Individual_ID[$x]'";
		    
		    $sqlUpdateIndividualAuto="UPDATE autos 
		    SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]' 
		    Where Individual_ID = '$Individual_ID[$x]'";
            
		    $sqlUpdateIndividualInsurance="UPDATE insurance 
		    SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]'
		    Where Individual_ID = '$Individual_ID[$x]'";
		    
		    $sqlUpdateIndividualService="UPDATE service 
		    SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]'
		    Where Individual_ID = '$Individual_ID[$x]'";
		    
		    $sqlUpdateIndividualRepair="UPDATE repair 
		    SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]'
		    Where Individual_ID = '$Individual_ID[$x]'";
		    
		    $sqlUpdateIndividualTyres="UPDATE tyres 
		    SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]'
		    Where Individual_ID = '$Individual_ID[$x]'";
            
            $sqlUpdateIndividualDocuments="UPDATE documents 
		    SET Admin_Username = '$_POST[Admin_Username]', Sub_Admin_Username = '$_POST[Sub_Admin_Username]'
		    Where Individual_ID = '$Individual_ID[$x]'";
            
            mysqli_autocommit($con, FALSE);
            mysqli_query($con,"START TRANSACTION");
            
            $updateIndividual = mysqli_query($con, $sqlUpdateIndividual);
            if(mysqli_affected_rows($con) == 0) {
                $zeroIndividual = true;
            }
            if(mysqli_affected_rows($con) == 1) {
                $oneIndividual = true;
            }
            
            $updateAutos = mysqli_query($con, $sqlUpdateIndividualAuto);
            if(mysqli_affected_rows($con) == 0) {
                $zeroAutos = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneAutos = true;
            }
            
		    $updateInsurance = mysqli_query($con, $sqlUpdateIndividualInsurance);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroInsurance = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneInsurance = true;
            }
            
            $updateService = mysqli_query($con, $sqlUpdateIndividualService);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroService = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneService = true;
            }
            
            $updateRepair = mysqli_query($con, $sqlUpdateIndividualRepair);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroRepair = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneRepair = true;
            }
            
            $updateTyres = mysqli_query($con, $sqlUpdateIndividualTyres);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroTyres = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneTyres = true;
            }
            
            $updateDocuments = mysqli_query($con, $sqlUpdateIndividualDocuments);
		    if(mysqli_affected_rows($con) == 0) {
                $zeroDocuments = true;
            }
            if(mysqli_affected_rows($con) >= 1) {
                $oneDocuments = true;
            }
		    
            if($zeroIndividual == true && $zeroAutos == true && $zeroInsurance == true && $zeroService == true && $zeroRepair == true &&
               $zeroTyres == true && $zeroDocuments == true) {
             mysqli_commit($con);
             $noChangedData++;
   	         
            } 
            
            else if($oneIndividual == true && $oneAutos == true && $oneInsurance == true && $oneService == true && $oneRepair == true &&
                    $oneTyres == true && $oneDocuments == true) {
             mysqli_commit($con);
             $updateCounter++;
   	         
            }
            
            else if($oneIndividual == true && $oneAutos == true && $oneInsurance == true && ($zeroService == true || $zeroRepair == true  || $zeroDocuments == true) &&
                    $oneTyres == true) {
             mysqli_commit($con);
             $updateCounter++;
   	         
            }
            
            else {  
             mysqli_rollback($con);
             $updateCounter = -1;
   	         $message = "Възникна грешка за физическо лице с ID: $Individual_ID[$x]";
             echo "<script>alert('$message');</script>";
             echo "<script> location.replace('mainAdminUpdateDataAdminSubAdminPerson.php'); </script>";  
             //break;                                                                                    
            }
          
		  }
		  
		  if($updateCounter == 0) {
              $message = "Няма промяна на данни!";
   	          echo "<script>alert('$message');</script>";
          }
          if(($noChangedData + $updateCounter == $sizeArr || $updateCounter == $sizeArr) && $sizeArr > 0 && $updateCounter > 0) {
              $message = "Данните са актуализирани успешно!";
   	          echo "<script>alert('$message');</script>";
   	          echo "<script> location.replace('mainAdminUpdateDataAdminSubAdminPerson.php'); </script>";
          }
		  
          mysqli_query($con, "SET AUTOCOMMIT=TRUE");
        
		}
      
      
      mysqli_close($con);
	}
?>

<script>

function showSubAdmin1(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("subAdminValue1").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("subAdminValue1").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getSubAdmin.php?q="+str, true);
  xhttp.send();
}

</script>

<div align = "left">
    <input style = "position: fixed; top: 28.0vw; left: 5.0vw; display: none;" type = "number"  name = "pageNumber" value = "<?php echo $_SESSION['savePageNumber']; ?>" placeholder = "Въведи № на страница:">
    <br><br>
    <select id = "admin" style = "position: fixed; top: 32.0vw; left: 5.0vw; width: 174px; height: 27px;" name="Admin_Username" onchange="showSubAdmin1(this.value)">
        <option value="">Избери подадмин</option>
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
    <br><br>
    
    <br><!--<input style = "position: fixed; top: 22.0vw; left: 9.0vw;" type="email" name="Sub_Admin_Username" value = "<?php echo $Sub_Admin_Username;?>" placeholder = "Потреб. потреб. име" required ="required">-->
    <select id = "subAdminValue1" style = "position: fixed; top: 36.0vw; left: 5.0vw; width: 174px; height: 27px;" name="Sub_Admin_Username">
        <option value="">Избери потребител</option>
        
    </select>
    <br><br>
	
    <input id = "bUpdate" type="submit" style = "position: fixed; top: 40.0vw; left: 5.0vw;" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;">  
  </form>
  
</div>	  
<script>

document.getElementById('bUpdate').onclick = function() {
    var id = document.getElementById('pageN').value;
    var checkBox = false;
    if(id < 1)
        id = 1;
    id = (id*10) - 9;
    while (id) {
        if(document.getElementById(id).checked == true) {
            checkBox = true; 
            break;
        }
    id++;
    }
    
    if(document.getElementById('admin').value != "" && document.getElementById('subAdminValue1').value != "" && checkBox)
        return confirm('Сигурни ли сте,че искате да извършите прехвърляне на физическо лице от един подадминистратор/потребител към друг?');
};

var checkedAll = false;

function checkAll() {
    if(!checkedAll) {
        $("form input:checkbox").prop('checked', true);
        checkedAll = true;
    }
    else {
        $("form input:checkbox").prop('checked', false);
        checkedAll = false;
    }
    
    //$("form input:checkbox").click(function(){
    //var chk = $(this).attr('checked')?true:false;
    //$("form input:checkbox").attr('checked',chk);
//});
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