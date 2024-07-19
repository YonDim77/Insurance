<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
header('Location: index.php');
}

include 'functions.php';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="adminCss.css">
<script> 

    $(function(){
      $("#adminNav").load("adminNav.php"); 
    });
    
</script>

<style>
body {
    
}
table, th, td {
    border: 2px solid black;
    border-collapse: collapse;
    text-align: center;	
}
table, th {
	font-size: 16px;
	color: red;
}
table, td {
	font-size: 14px;
	color: black;
}
table {
	background-color: white;
}
tr:nth-child(even) {background-color: #d8f0f3;}
tr:hover  td {background-color:red; color: white;}

</style>
</head>
<body> 

<iframe id="txtArea1" style="display:none"></iframe>

<div id = "adminNav"></div>
<br>

<div align = "center">
    <h3 style = "margin-top: 7.0vw; text-align: center;">Данни за всички физически лица:</h3>
    
        
            
    <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
      
    	<!--Избери подадмин<br><select style = "width: 174px; height: 27px;" name="Admin_Username">
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
                    //  mysqli_close($con);
                      
                  ?>
          
            </select>
        <br><br><br>
        Избери потребител<br><select style = "width: 174px; height: 27px;" name="Sub_Admin_Username">
            <option value="">или потребител</option>
                  <?php
                      //$con = connectServer();
                      $querySA = "SELECT * FROM subadmin";
                      $resultSA=mysqli_query($con, $querySA);
                      //loop
                      foreach ($resultSA as $subAdmins){
                  ?>
                          <option value="<?php echo $subAdmins['username'];?>"><?php echo $subAdmins['username'];?></option>
                  <?php
                      }
                      mysqli_close($con);
                      
                  ?>
          
            </select>-->
            <br><br>
            <input type="submit" name="btnDisplayData" value="Покажи данни" style = "width: 130px; border-radius: 2px; color: red;"> 
        
    </form>
    <br><br>
    <button style = "" id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>
    <br>
</div>

<?php

$btnDisplayData = false;
if(isset($_POST["btnDisplayData"])) {
	$btnDisplayData = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnDisplayData) {
    $con = connectServer();
    
    //$adminUsername = $_SESSION['username'];
    
    //$admin = $_POST['Admin_Username'];
    //$subAdmin = $_POST['Sub_Admin_Username'];
    
    //if((strlen($admin) == 0 && strlen($subAdmin) == 0) || (strlen($admin) > 0 && strlen($subAdmin) > 0)) {
    //    
    //    $message = "Моля изберете подадминистратор или потребител!";
	//	echo "<script>alert('$message');</script>";
    //}
    //else {
        
    
        $result = mysqli_query($con, "SELECT * FROM individual WHERE Admin_Username = '$_SESSION[adminUsername]'");
        
        $h1 = " ";
        $h2 = " ";
        if ($h1 == " "){$color="#d8f0f3";}
        if ($h2 == " "){$color1="white";}
        
        echo "<br><br><br><br>";
        
        if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='2' id = 't1'>
            
            <tr>
            <th bgcolor='$color1'>$h2 №</th>
            <th bgcolor='$color1'>$h2 Подадминистратор Потребителско име</th>
            <th bgcolor='$color1'>$h2 Потребител Потребителско име</th>
            <th bgcolor='$color1'>$h2 Име и Фамилия</th>
            <th bgcolor='$color1'>$h2 ЕГН</th>
            <th bgcolor='$color1'>$h2 Адрес</th>
            <th bgcolor='$color1'>$h2 Адрес на МПС</th>
            <th bgcolor='$color1'>$h2 Телефон</th>
            <th bgcolor='$color1'>$h2 Имейл</th>
            <th bgcolor='$color1'>$h2 Лице за контакти</th>
            <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
            <th bgcolor='$color1'>$h2 Имейл на лице за контакти</th>
            <th bgcolor='$color1'>$h2 Имейл като потребителско име</th>
            <th bgcolor='$color1'>$h2 Парола</th>
            <th bgcolor='$color1'>$h2 Дата</th>
            </tr>";
            
            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['Individual_ID'] . "</td>";
              echo "<td>" . $row['Admin_Username'] . "</td>";
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
              echo "<td>" . $row['Email_Username'] . "</td>";
              echo "<td>" . $row['Password'] . "</td>"; 
              echo "<td>" . $row['Date'] . "</td>";
              echo "</tr>";
              }
            echo "</table>";
        //}
        //
        //else 
        //{
        //    $message = "Няма данни за физически лица, които да са към ". $admin . "  ". $subAdmin . "!";
	    //	echo "<script>alert('$message');</script>";
        //}
        }
    
    mysqli_close($con);

}

?>

<script>

function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('t1'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}


</script>

</body>
</html>