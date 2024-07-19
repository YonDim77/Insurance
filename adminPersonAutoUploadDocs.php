<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
header('Location: index.php');
}

$_SESSION['Names'] = $_POST['Names'];
$_SESSION['Egn'] = $_POST['EGN'];
//$_SESSION['Reg_Number'] = "";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
    
    background-size: 130%;
}
table, th, td {
    
    border-collapse: collapse;
    text-align: center;	
}
table, th {
	font-size: 16px;
	color: red;
}

td {
	font-size: 14px;
	color: black;
	
}

table {
	
	width: 130%;
}

th {
    background-color: white;
}

.docPics tr:hover {
    
    background-color:#f2e6ff;
    
}


</style>
</head>
<body> 

<div id = "adminNav"></div>
<br>

<div align = "center">;
    <h3 style = "margin-top: 6.0vw;">Запис на документи на МПС на физически лица:</h3>
    <br>
      <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8">  
        <!--<input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">-->
        Име:<br><input style = "" type="text" name="Names" value = "<?php echo $_SESSION['Names']; ?>" placeholder = "Попълнете едното "/>
        <br><br>
        ЕГН:<br><input style = "" type="text" name="EGN" value = "<?php echo $_SESSION['Egn']; ?>" placeholder = "от двете полета"/>
        <br><br>
    	<input type="submit" name="btnShowData" value="Покажи данни" style = "border-radius: 2px; color: red;">
      
      
      
      <!--<form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8">  
        <input type="text" name="Admin_Username" value = "<?php //echo $_SESSION['username']; ?>" style = "display: none;">
        ID:<br><input type="number" name="Individual_ID" required="required" placeholder = "Задължително попълване"/>*
        <br><br>
    	<input type="submit" name="btnShowDataForm" value="Покажи данни" style = "border-radius: 2px; color: red;">-->
  

<?php

include 'functions.php';

$btnShowData = false;
$btnShowDataForm = false;
$btnShowDataAuto = false;
$btnUploadDataAuto = false;

$index = 0;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}


if(isset($_POST["btnShowData"])) {
	$btnShowData = true;
}
//if(isset($_POST["btnShowDataForm"])) {
//	$btnShowDataForm = true;
//}
if(isset($_POST["btnShowDataAuto"])) {
	$btnShowDataAuto = true;
}

if(isset($_POST["btnUploadDataAuto"])) {
	$btnUploadDataAuto = true;
}

if (($_SERVER["REQUEST_METHOD"] == "POST" || $btnShowData == true) && $btnShowDataAuto == false && $btnUploadDataAuto == false) {
	$con = connectServer();

	
	//$adminUsername = $_SESSION['username']; //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
	$_SESSION['Names'] = $_POST['Names'];
	$Names = $_SESSION['Names'];
	$_SESSION['Egn'] = $_POST['EGN'];
	
	$result = mysqli_query($con, "SELECT * FROM individual WHERE Names LIKE '$Names%' AND Admin_Username = '$_SESSION[adminUsername]'"); 
	$resultEgn = mysqli_query($con, "SELECT * FROM individual WHERE EGN = '$_POST[EGN]' AND Admin_Username = '$_SESSION[adminUsername]'");
	
	$Color = "red";
	
	if(strlen($_POST['Names']) > 0 && strlen($_POST['EGN']) > 0 || strlen($_POST['Names']) == 0 && strlen($_POST['EGN']) == 0) {
	    $message = "Моля попълнете едно от двете полета!";
	    echo "<script>alert('$message');</script>";
	}
	
	else if(strlen($_POST['Names']) > 0)
	{				  
	    if (mysqli_num_rows($result) < 1) {
	    	
	    	$message = "Няма " . $Names . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    
	    if (mysqli_num_rows($result) > 0) {
	        
	        //echo "<br><br><br>";
	        echo"<div align = 'center'>";
            echo '<span id = "text" style="font-size: 20px; color:black;"><br><br>Данни за име или име започващо с: </span>' . "  " .
	        '<span id = "name" style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	        echo"</div>";
            echo"<br><br>";
	        
	        echo "<table border='2' id = 't1'>
	        
	        
	        <tr>
	        <th bgcolor='$color1'>$h2 </th>
	        <th bgcolor='$color1'>$h2 №</th>
	        <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	        <th bgcolor='$color1'>$h2 Име и Фамилия</th>
	        <th bgcolor='$color1'>$h2 ЕГН</th>
	        <th bgcolor='$color1'>$h2 Адрес</th>
	        <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	        <th bgcolor='$color1'>$h2 Телефон</th>
	        <th bgcolor='$color1'>$h2 Имейл</th>
	        <th bgcolor='$color1'>$h2 Лице за контакти</th>
	        <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	        <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	        <th bgcolor='$color1'>$h2 Шофьорска книжка срок</th>
	        <th bgcolor='$color1'>$h2 Потребителско име</th>
	        <th bgcolor='$color1'>$h2 Парола</th>
	        <th bgcolor='$color1'>$h2 Дата</th>
	        </tr>";
	        
	        while($row = mysqli_fetch_array($result))
	        {
	            echo "<tr>";
	            echo "<td>"; echo'<input type = "submit" value="Покажи" style = "width: 70px;" name = "button' . $index . '" >';
	            //echo "<td>" . $row['Individual_ID'] . "</td>";
	            echo "<td>"; echo'<input style = "width: 50px; border: 0px; text-align: center;" type = "text" value="'. $row['Individual_ID']. '" name = "Individual_ID' . $index . '" readonly>'; echo"</td>";
	            //echo "<td>" . $row['Admin_Username'] . "</td>";
	            echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	            echo "<td>" . $row['Names'] . "</td>";
	            echo "<td>" . $row['EGN'] . "</td>";
	            echo "<td>" . $row['Address'] . "</td>";
	            echo "<td>" . $row['Address_MPS'] . "</td>";
	            echo "<td>" . $row['Telephone'] . "</td>";
	            echo "<td>" . $row['Email'] . "</td>";
	            echo "<td>" . $row['Contact_Person'] . "</td>";
	            echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	            echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	            echo "<td>" . $row['Driving_Licence_Date'] . "</td>";
	            echo "<td>" . $row['Email_Username'] . "</td>";
	            echo "<td>" . $row['Password'] . "</td>";
	            echo "<td>" . $row['Date'] . "</td>";
	            echo "</tr>";
	            
	            if(isset($_POST['button' . $index . '']))
    	        {
    	             $Individual_ID = $_POST['Individual_ID' . $index . ''];
    	             $btnShowDataForm = true;
	    	         echo "<script>document.getElementById('t1').style.display = 'none';</script>";
	    	         echo "<script>document.getElementById('text').style.display = 'none';</script>";
	    	         echo "<script>document.getElementById('name').style.display = 'none';</script>";
    	        }
	            
	            $index++;
	        }
	        echo "</table>";
	    
	    }
	}
	else if(strlen($_POST['EGN']) > 0) {
	    
	    if (mysqli_num_rows($resultEgn) < 1) {
	    	
	    	$message = "Няма лице с ЕГН: " . $_SESSION['Egn'] . " в базата данни!";
	    	echo "<script>alert('$message');</script>";
	    }
	    
	    //echo "<br><br>";
	    if (mysqli_num_rows($resultEgn) > 0) {
	    
	    echo"<div align = 'center'>";
        echo '<span id = "iFace" style="font-size: 20px; color:black;"><br><br>Данни за лице с ЕГН: </span>' . "  " .
	    '<span id = "egn" style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Egn'] . '</span>';
	    echo"</div>";
        echo"<br><br>";
	    
	    echo "<table border='2' id = 't2'>
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 </th>
	    <th bgcolor='$color1'>$h2 №</th>
	    <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
	    <th bgcolor='$color1'>$h2 Име и Фамилия</th>
	    <th bgcolor='$color1'>$h2 ЕГН</th>
	    <th bgcolor='$color1'>$h2 Адрес</th>
	    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
	    <th bgcolor='$color1'>$h2 Телефон</th>
	    <th bgcolor='$color1'>$h2 Имейл</th>
	    <th bgcolor='$color1'>$h2 Лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
	    <th bgcolor='$color1'>$h2 Шофьорска книжка срок</th>
	    <th bgcolor='$color1'>$h2 Потребителско име</th>
	    <th bgcolor='$color1'>$h2 Парола</th>
	    <th bgcolor='$color1'>$h2 Дата</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($resultEgn))
	    {
	    echo "<tr>";
	    echo "<td>"; echo'<input type = "submit" value="Покажи" style = "width: 70px;" name = "button' . $index . '" >'; echo"</td>";
	    //echo "<td>" . $row['Individual_ID'] . "</td>";
	    echo "<td>"; echo'<input style = "width: 50px; border: 0px; text-align: center;" type = "text" value="'. $row['Individual_ID']. '" name = "Individual_ID' . $index . '" readonly>'; echo"</td>";
	    //echo "<td>" . $row['Admin_Username'] . "</td>";
	    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";	
	    echo "<td>" . $row['Names'] . "</td>";
	    echo "<td>" . $row['EGN'] . "</td>";
	    echo "<td>" . $row['Address'] . "</td>";
	    echo "<td>" . $row['Address_MPS'] . "</td>";
	    echo "<td>" . $row['Telephone'] . "</td>";
	    echo "<td>" . $row['Email'] . "</td>";
	    echo "<td>" . $row['Contact_Person'] . "</td>";
	    echo "<td>" . $row['Telephone_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Email_Contact_Person'] . "</td>";
	    echo "<td>" . $row['Driving_Licence_Date'] . "</td>";
	    echo "<td>" . $row['Email_Username'] . "</td>";
	    echo "<td>" . $row['Password'] . "</td>";
	    echo "<td>" . $row['Date'] . "</td>";
	    echo "</tr>";
	    }
	    
	    if(isset($_POST['button' . $index . '']))
    	{
    	     $Individual_ID = $_POST['Individual_ID' . $index . ''];
    	     $btnShowDataForm = true;
	         echo "<script>document.getElementById('t2').style.display = 'none';</script>";
    	}
	 
	    $index++;
	    
	    echo "</table>";
	    
	    }
	    
	}
	
	
	mysqli_close($con);

}


?>

</form>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataForm == true) {
    
    $con = connectServer();

	
	//$adminUsername = $_SESSION['username'];
	//$Individual_ID = $_POST['Individual_ID'];
	
	$resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$Individual_ID'");
	$resultPersonName = mysqli_query($con, "SELECT Names FROM individual WHERE Individual_ID = '$Individual_ID'");
	
	$Color = "red";
	$_SESSION['NumberID'] = true;
	$_SESSION['Person'] = true;
	
	if (!filter_var($Individual_ID, FILTER_VALIDATE_INT)) {
    
	echo "<br>";
    echo"<br><br>";
	echo"<div align = 'center'>";
	echo'<span style="font-size: 20px; color:white; ">Въведете цяло число в полето "ID"!</span>';
    echo"</div>";
	$_SESSION['NumberID'] =	false;
	
    } 
	
	if (mysqli_num_rows($resultPerson) < 1 && $_SESSION['NumberID']) {
		
		//echo"<br><br>";
		//echo"<div align = 'center'>";
		//echo '<span style="font-size: 20px; color:black;">Грешка! Няма данни за физическо лице!</span>'; //. " " .
		
		//'<span style="font-size: 20px; color:' . $Color . '">' . $Individual_ID . '</span>' . " " .	
		//'<span style="font-size: 20px; color:black;"> в базата данни!</span>';
		
		//echo"</div>";
		$message = "Грешка! Няма данни за физическо лице!";
		echo "<script>alert('$message');</script>";
	    $_SESSION['Person'] = false;
	}
	
	if (mysqli_num_rows($resultPerson) > 0 && mysqli_num_rows($resultPersonName) > 0 && $_SESSION['NumberID']) {
	    
	    if($rowName = mysqli_fetch_array($resultPersonName)) {
	        echo"<div align = 'center'>";
	        echo "<script>document.getElementById('iFace').style.display = 'none';</script>";
	    	echo "<script>document.getElementById('egn').style.display = 'none';</script>";
    /*        echo '<span style="font-size: 20px; color:black;">Данни на </span>'  . "  " .
	        '<span style="font-size: 20px; color:' . $Color . '">' . $rowName['Names'] . '</span>';
	        echo"</div>";
            echo"<br><br>"; */
	    }
	
	
?>



<div align = "center">
    <h3 style = "">Регистрационен номер на МПС</h3>
      <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
        <br>
    	<select style = "width: 220px; height: 27px;" name="Reg_Number"  required="required">
            <option value="">Изберете регистрационен №</option>
                    <?php
                        //$con = connectServer();
                        //$query = "SELECT * FROM autos WHERE Legalentity_ID = '$_SESSION[legalentityID]'";
                        $query = "SELECT  Reg_Number FROM autos WHERE Individual_ID = '$Individual_ID'";
                        $results=mysqli_query($con, $query);
                        //loop
                        foreach ($results as $regNums){
                    ?>
                            <option value="<?php echo $regNums['Reg_Number'];?>"><?php echo $regNums['Reg_Number'];?></option>
                    <?php
                        }
                        //mysqli_close($con);
                        
                    ?>
            
        </select>&nbsp; &nbsp;
        <input type="submit" name="btnShowDataAuto" value="Покажи запис на документи на МПС" style = "border-radius: 2px; color: red;">
      </form>    
    <br><br>
</div>

<?php
	
	}
	
	mysqli_close($con);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowDataAuto == true) {
    
   $con = connectServer();
   $autoId = 0;
   
   $individualID = 0;
   $legalentityID = 0;
   $adminUsername = "";
   $subAdminUsername = "";
   $regNumberMps = "";
   
   
   $result = mysqli_query($con, "SELECT * FROM autos WHERE Reg_Number = '$_POST[Reg_Number]'");
					  
	if (mysqli_num_rows($result) < 1 && $_SESSION['NumberID'] && $_SESSION['Person']) {
		
		$message = "Възникна грешка!";
		echo "<script>alert('$message');</script>";
		
		echo"</div>";
	
	}

	
	echo "<br><br>";
	if (mysqli_num_rows($result) > 0 && $_SESSION['NumberID'] && $_SESSION['Person']) {
	
	    //echo"<div align = 'center'>";
	    //echo '<span style="font-size: 25px; color:black;">Изберете една от двете форми за запис на документи</span>';
	    //echo"<br><br>";
        //echo '<span style="font-size: 20px; color:black;">Документи на МПС на физическо лице в *.pdf формат</span>'; // . "  " .
	    ////'<span style="font-size: 20px; color:' . $Color . '">' . $_SESSION['Names'] . '</span>';
	    //echo"</div>";
        //echo"<br><br>";
	    
	    
	    
	    while($row = mysqli_fetch_array($result))
	    {
	        $autoId = $row['AutosID'];
	        
	        $individualID = $row['Individual_ID'];
            $legalentityID = $row['Legalentity_ID'];
            $adminUsername = $row['Admin_Username'];
            $subAdminUsername = $row['Sub_Admin_Username'];
            $regNumberMps = $row['Reg_Number'];
	        
	    }
	    
	
	}
	
	mysqli_close($con);
	
?>



    <h3>Запис на документи на МПС с регистрационен номер <span style = "color: red;"><?php echo $regNumberMps?></span></h3><br>
    <h4>Можете да съхраните всички документи в един PDF файл </h4>
	<form method="post" enctype="multipart/form-data">
	    <input type="number" value = "<?php echo $individualID;?>" name="Individual_ID" required="required" style = "display: none"> 
	    <input type="number" value = "<?php echo $legalentityID;?>" name="Legalentity_ID" style = "display: none">
	    <input type="text"   value = "<?php echo $adminUsername;?>" name="Admin_Username" required="required" style = "display: none">
	    <input type="text"   value = "<?php echo $subAdminUsername;?>" name="Sub_Admin_Username" required="required" style = "display: none">
	    <input type="text"   value = "<?php echo $regNumberMps;?>" name="Reg_Number" required="required" style = "display: none">
        
	    <br><br>
	    
	        
        <input id = "pdf" type="file" name="pdf" style = "">
        <br><br>
    <h4>Можете да съхраните всеки документ в отделен файл</h4><br>
    
        Формата на документа може да бъде *.png; *.jpg; *.jpeg; *.pdf<br><br>
        
        <table class = "iDataInput" style = "width: 100%;">
            <tr>
                <td style = "">ГО снимка<input id = "img1" type="file" name="img1" style = "margin: auto; width: 250px;"></td>
                
                <td style = "">Каско снимка<input id = "img2" type="file" name="img2" style = "margin: auto; width: 250px;"></td>
                
                <td style = "">Винетка снимка<input id = "img3" type="file" name="img3" style = "margin: auto; width: 250px;"></td>
            </tr>
        
        
        
            <tr>
                <td style = "">ГТП снимка<input id = "img4" type="file" name="img4" style = "margin: auto; width: 250px;"></td>
                
                <td style = "">Данък снимка<input id = "img5" type="file" name="img5" style = "margin: auto; width: 250px;"></td>
                
                <td style = "">Гуми снимка<input id = "img6" type="file" name="img6" style = "margin: auto; width: 250px;"></td>
            </tr>
        
        
        
            <tr>
                <td style = "">Малък талон снимка<input id = "img7" type="file" name="img7" style = "margin: auto; width: 250px;"></td>
                
                <td style = "">Сервизна книжка снимка<input id = "img8" type="file" name="img8" style = "margin: auto; width: 250px;"></td>
                
                <td style = "">Шофьорска книжка снимка<input id = "img9" type="file" name="img9" style = "margin: auto; width: 250px;"></td>
            </tr>
        </table>
        
        <br><br>  
        <input type="submit" name="btnUploadDataAuto" id="insert" value="Запис на документи на МПС"/>  
    </form>



<?php

}

?>

<script> 

/* function SelectFormat() {
     
   var fileExt = document.getElementById('format').value;
   if(fileExt == "pdf")
   {
        document.getElementById('pdf').style = "display:block";
        document.getElementById('insert').style = "display:block";
        document.getElementById('p').style = "display:block";
        document.getElementById('i1').style = "display:none";
        document.getElementById('i2').style = "display:none";
        document.getElementById('i3').style = "display:none";
        
        return fileExt;
   }
   
   else if(fileExt == "png")
   {
        document.getElementById('pdf').style = "display:none";
        document.getElementById('p').style = "display:none";
        document.getElementById('insert').style = "display:block";
        document.getElementById('i1').style = "display:block";
        document.getElementById('i2').style = "display:block";
        document.getElementById('i3').style = "display:block";
        
        return fileExt;
   }
   
   else
   {
        document.getElementById('pdf').style = "display:none";
        document.getElementById('p').style = "display:none";
        document.getElementById('insert').style = "display:none";
        document.getElementById('i1').style = "display:none";
        document.getElementById('i2').style = "display:none";
        document.getElementById('i3').style = "display:none";
        
        return fileExt;
   }
 }
*/

    $(document).ready(function(){  
        $('#insert').click(function(){
          
            var pdf_name = $('#pdf').val();
            
            var img1_name = $('#img1').val();
            var img2_name = $('#img2').val();
            var img3_name = $('#img3').val();
            var img4_name = $('#img4').val();
            var img5_name = $('#img5').val();
            var img6_name = $('#img6').val();
            var img7_name = $('#img7').val();
            var img8_name = $('#img8').val();
            var img9_name = $('#img9').val();
            
            if(pdf_name == '' && img1_name == '' && img2_name == '' && img3_name == '' && img4_name == '' &&
              img5_name == '' && img6_name == '' && img7_name == '' && img8_name == '' && img9_name == '')  
            {  
                 alert("Моля изберете снимка на документ!");  
                 return false;  
            }
            
            else if(pdf_name == '' && (img1_name == '' || img2_name == '' || img3_name == '' || img4_name == '' ||
                    img5_name == '' || img6_name == '' || img7_name == '' || img8_name == '' || img9_name == ''))  
            {  
                 alert("Моля изберете снимка на документ!");  
                 return false;  
            }
            
            else if(pdf_name != '' && (img1_name != '' || img2_name != '' || img3_name != '' || img4_name != '' ||
                    img5_name != '' || img6_name != '' || img7_name != '' || img8_name != '' || img9_name != ''))  
            {  
                 alert("Изберете опцията -> всички снимки на документи в един PDF файл или изберете опцията -> всички снимки на документи отделно!");
                 $('#pdf').val(''); $('#img1').val(''); $('#img2').val(''); $('#img3').val(''); $('#img4').val(''); $('#img5').val(''); 
                 $('#img6').val(''); $('#img7').val(''); $('#img8').val(''); $('#img9').val('');
                 
                 return false;  
            }
            
            else  
            {  
                 var extension0 = $('#pdf').val().split('.').pop().toLowerCase();
                 
                 var extension1 = $('#img1').val().split('.').pop().toLowerCase();
                 var extension2 = $('#img2').val().split('.').pop().toLowerCase();
                 var extension3 = $('#img3').val().split('.').pop().toLowerCase();
                 var extension4 = $('#img4').val().split('.').pop().toLowerCase();
                 var extension5 = $('#img5').val().split('.').pop().toLowerCase();
                 var extension6 = $('#img6').val().split('.').pop().toLowerCase();
                 var extension7 = $('#img7').val().split('.').pop().toLowerCase();
                 var extension8 = $('#img8').val().split('.').pop().toLowerCase();
                 var extension9 = $('#img9').val().split('.').pop().toLowerCase();
                 
                 if(pdf_name != '' && (img1_name == '' && img2_name == '' && img3_name == '' && img4_name == '' && 
                    img5_name == '' && img6_name == '' && img7_name == '' && img8_name == '' && img9_name == '')) 
                 {   
                    if(jQuery.inArray(extension0, ['pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за -> Всички снимки на документи в един PDF файл!');  
                         $('#pdf').val('');  
                         return false;  
                    }
                 }
                 
                 if(pdf_name == '' && (img1_name != '' && img2_name != '' && img3_name != '' && img4_name != '' && 
                    img5_name != '' && img6_name != '' && img7_name != '' && img8_name != '' && img9_name != ''))
                 {   
                    if(jQuery.inArray(extension1, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за ГО!');  
                         $('#img1').val('');  
                         return false;  
                    }
                    else if(jQuery.inArray(extension2, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за Каско!');  
                         $('#img2').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension3, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за Винетка!');  
                         $('#img3').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension4, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за ГТП!');  
                         $('#img4').val('');  
                         return false;  
                    }
                    else if(jQuery.inArray(extension5, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за Данък!');  
                         $('#img5').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension6, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за Гуми!');  
                         $('#img6').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension7, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за Малък талон!');  
                         $('#img7').val('');  
                         return false;  
                    }
                    else if(jQuery.inArray(extension8, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за Сервизна книжка!');  
                         $('#img8').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension9, ['png','jpg','jpeg', 'pdf']) == -1)  
                    {  
                         alert('Невалиден тип на файл за Шофьорска книжка!');  
                         $('#img9').val('');  
                         return false;  
                    }
                 }
                 
            }
          
            
            
      });  
 });
 
 document.forms[1].addEventListener('submit', function( evt ) {
    
    var file0 = document.getElementById('pdf').files[0];
    var file1 = document.getElementById('img1').files[0];
    var file2 = document.getElementById('img2').files[0];
    var file3 = document.getElementById('img3').files[0];
    var file4 = document.getElementById('img4').files[0];
    var file5 = document.getElementById('img5').files[0];
    var file6 = document.getElementById('img6').files[0];
    var file7 = document.getElementById('img7').files[0];
    var file8 = document.getElementById('img8').files[0];
    var file9 = document.getElementById('img9').files[0];
    
    if(file0 && file0.size > 1048576) {                         // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за -> Всички снимки на документи в един PDF файл е прекалено голям!");        
    }
    else if(file1 && file1.size > 1048576) {                         // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за ГО е прекалено голям!");        
    }
    else if(file2 && file2.size > 1048576) {                    // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за Каско е прекалено голям!");        
    }
    else if(file3 && file3.size > 1048576) {                    // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за Винетка е прекалено голям!");        
    } 
    else if(file4 && file4.size > 1048576) {                         // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за ГТП е прекалено голям!");        
    }
    else if(file5 && file5.size > 1048576) {                    // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за Данък е прекалено голям!");        
    }
    else if(file6 && file6.size > 1048576) {                    // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за Гуми е прекалено голям!");        
    }
    else if(file7 && file7.size > 1048576) {                         // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за Малък талон е прекалено голям!");        
    }
    else if(file8 && file8.size > 1048576) {                    // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за Сервизна книжка е прекалено голям!");        
    }
    else if(file9 && file9.size > 1048576) {                    // 1 MB (this size is in bytes)
        evt.preventDefault();
        alert("Файла за Шофьорска книжка е прекалено голям!");        
    } 
    
    
}, false);
 
 </script>
 
 <?php
 
 function compressImage($source, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    //imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $image; 
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUploadDataAuto == true) {

    $con = connectServer();
    
    if($_FILES['pdf']['size'] > 0)
    {
    
        $file = addslashes(file_get_contents($_FILES["pdf"]["tmp_name"]));  
        $query = "INSERT INTO documents(Individual_ID, Legalentity_ID, Admin_Username, Sub_Admin_Username, Reg_Number, Pdf_File) 
                  VALUES ('$_POST[Individual_ID]', '$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Reg_Number]', '$file')";  
        
        if($_FILES['pdf']['size'] > 1048576) { //1 MB (size is also in bytes)
        
            echo '<script>alert("Файла е прекалено голям!")</script>';
            
        } else {
            
            if(mysqli_query($con, $query))  
            {  
                 $last_id = mysqli_insert_id($con); 
                 echo '<script>alert("Документа е записан успешно!")</script>';
                 
                 $queryShowDocs = "SELECT * FROM documents WHERE ID = $last_id";  
                 $result = mysqli_query($con, $queryShowDocs);  
                 while($row = mysqli_fetch_array($result))  
                 { 
                      echo "<br><br>";
                      echo '<span style="font-size: 25px; color:black;">Документи на МПС с регистрационен номер ' . $_POST['Reg_Number'] . '</span>';
                      echo "<br><br>";
                      echo '  
                           <tr>  
                                <td>  
                                     
                                     <iframe src="data:application/pdf;base64,'.base64_encode($row['Pdf_File']).'" type="application/pdf" style="height:400px;width:50%"></iframe>
    
                                </td>  
                           </tr>  
                      ';  
                 } 
            }
            else {
                echo '<script>alert("Възникна Грешка или вече има записани документи на МПС!")</script>';
            }
        }
    }
    
    else
    {
        //$compressedImage1 = compressImage($_FILES["img1"]["tmp_name"], 75);
        $file1 = addslashes(file_get_contents($_FILES["img1"]["tmp_name"]));
        $path1 = $_FILES["img1"]["name"];
        $ext1 = pathinfo($path1, PATHINFO_EXTENSION);
        
        $file2 = addslashes(file_get_contents($_FILES["img2"]["tmp_name"]));
        $path2 = $_FILES["img2"]["name"];
        $ext2 = pathinfo($path2, PATHINFO_EXTENSION);
        
        $file3 = addslashes(file_get_contents($_FILES["img3"]["tmp_name"]));
        $path3 = $_FILES["img3"]["name"];
        $ext3 = pathinfo($path3, PATHINFO_EXTENSION);
        
        $file4 = addslashes(file_get_contents($_FILES["img4"]["tmp_name"]));
        $path4 = $_FILES["img4"]["name"];
        $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
        
        $file5 = addslashes(file_get_contents($_FILES["img5"]["tmp_name"]));
        $path5 = $_FILES["img5"]["name"];
        $ext5 = pathinfo($path5, PATHINFO_EXTENSION);
        
        $file6 = addslashes(file_get_contents($_FILES["img6"]["tmp_name"]));
        $path6 = $_FILES["img6"]["name"];
        $ext6 = pathinfo($path6, PATHINFO_EXTENSION);
        
        $file7 = addslashes(file_get_contents($_FILES["img7"]["tmp_name"]));
        $path7 = $_FILES["img7"]["name"];
        $ext7 = pathinfo($path7, PATHINFO_EXTENSION);
        
        $file8 = addslashes(file_get_contents($_FILES["img8"]["tmp_name"]));
        $path8 = $_FILES["img8"]["name"];
        $ext8 = pathinfo($path8, PATHINFO_EXTENSION);
        
        $file9 = addslashes(file_get_contents($_FILES["img9"]["tmp_name"]));
        $path9 = $_FILES["img9"]["name"];
        $ext9 = pathinfo($path9, PATHINFO_EXTENSION);
        
        $query = "INSERT INTO documents(Individual_ID, Legalentity_ID, Admin_Username, Sub_Admin_Username, Reg_Number, Go_Pic, Go_Ext, Kasko_Pic, Kasko_Ext, Vinetka_Pic, Vinetka_Ext, GTP_Pic, GTP_Ext, Tax_Pic, Tax_Ext, Tyres_Pic, Tyres_Ext, Talon_Pic, Talon_Ext, ServiceBook_Pic, ServiceBook_Ext, DrivingL_Pic, DrivingL_Ext) 
                  VALUES ('$_POST[Individual_ID]', '$_POST[Legalentity_ID]', '$_POST[Admin_Username]', '$_POST[Sub_Admin_Username]', '$_POST[Reg_Number]', '$file1', '$ext1', '$file2', '$ext2', '$file3', '$ext3', '$file4', '$ext4', '$file5', '$ext5', '$file6', '$ext6', '$file7', '$ext7', '$file8', '$ext8', '$file9', '$ext9')";  
        
        if($_FILES['img1']['size'] > 1048576 || $_FILES['img2']['size'] > 1048576 || $_FILES['img3']['size'] > 1048576) { //1 MB (size is also in bytes)
        
            echo '<script>alert("Файла е прекалено голям!")</script>';
            
        } else {
            
            if(mysqli_query($con, $query))  
            {  
                 $last_id = mysqli_insert_id($con); 
                 echo '<script>alert("Документите са записани успешно!")</script>';
                 
                 $queryShowDocs = "SELECT * FROM documents WHERE ID = $last_id";  
                 $result = mysqli_query($con, $queryShowDocs);  
                 while($row = mysqli_fetch_array($result))  
                 { 
                      echo "<br><br>";
                      echo '<span style="font-size: 25px; color:black;">Документи на МПС с регистрационен номер ' . $_POST['Reg_Number'] . '</span>';
                      echo "<br><br>";
                      echo "<table class = 'docPics' style = 'width: 100%;'>";  
                      echo "<tr>";  
                            echo "<td>";  
                                 
                                 if(strcmp($row['Go_Ext'], 'pdf') == 0)
                                    echo' <b>ГО</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Go_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <b>ГО</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Go_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo"</td>"; 
                            echo "<td>";  
                                 
                                 if(strcmp($row['Kasko_Ext'], 'pdf') == 0)
                                    echo' <b>Каско</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Kasko_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <b>Каско</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Kasko_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo "</td>";
                            echo "<td>";  
                                 
                                 if(strcmp($row['Vinetka_Ext'], 'pdf') == 0)
                                    echo' <b>Винетка</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Vinetka_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <b>Винетка</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Vinetka_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo "</td>";
                           echo "</tr>"; 
                           
                           echo "<tr>";  
                            echo "<td>";  
                                 
                                 if(strcmp($row['GTP_Ext'], 'pdf') == 0)
                                    echo' <br><b>ГТП</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['GTP_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>ГТП</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['GTP_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo"</td>"; 
                            echo "<td>";  
                                 
                                 if(strcmp($row['Tax_Ext'], 'pdf') == 0)
                                    echo' <br><b>Данък</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Tax_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Данък</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Tax_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo "</td>";
                            echo "<td>";  
                                 
                                 if(strcmp($row['Tyres_Ext'], 'pdf') == 0)
                                    echo' <br><b>Гуми</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Tyres_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Гуми</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Tyres_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo "</td>";
                           echo "</tr>";
                           
                           echo "<tr>";  
                            echo "<td>";  
                                 
                                 if(strcmp($row['Talon_Ext'], 'pdf') == 0)
                                    echo' <br><b>Малък талон</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Talon_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Малък талон</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Talon_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo"</td>"; 
                            echo "<td>";  
                                 
                                 if(strcmp($row['ServiceBook_Ext'], 'pdf') == 0)
                                    echo' <br><b>Сервизна книжка</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['ServiceBook_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Сервизна книжка</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['ServiceBook_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo "</td>";
                            echo "<td>";  
                                 
                                 if(strcmp($row['DrivingL_Ext'], 'pdf') == 0)
                                    echo' <br><b>Шофьорска книжка</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['DrivingL_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Шофьорска книжка</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['DrivingL_Pic'] ).'" style="height:300px; width:25.0vw;">';

                            echo "</td>";
                           echo "</tr>";
                      echo "</table>";  
                 } 
            }
            else {
                echo '<script>alert("Възникна Грешка или вече има записани документи на МПС!")</script>';
            }
        }
    }
    
    mysqli_close($con);
    
}
 
 
 ?>

<br><br>

</div>
</body>
</html>
          