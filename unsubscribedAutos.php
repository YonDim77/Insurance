<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="adminCss.css">

<script>//sessionStorage.setItem("scroll", "0");
        //sessionStorage.getItem("y") = 0;
//		sessionStorage.setItem("counter", "0"); 
		
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script> 

    $(function(){
      $("#nav").load("nav.php"); 
    });
    
</script>

<style>
body {
	
}

table {
    width: 100%;
}

table, th, td {
    text-align: center;
}

th {
    background-color: white;
    
}

td {
    color: black;
    
}


</style>

</head>
<body>

<div id = "nav"></div>

<br>

  
<br><br>

<?php

    include 'functions.php';

    $con = connectServer();
    
    $unsubscribed = true;
    
    $resultAuto = mysqli_query($con, "SELECT * FROM autos WHERE Individual_ID = 0 AND Legalentity_ID = 0");
    
    if (!$resultAuto) {
            die('Грешка: ' . mysqli_error());
        }
    else if (mysqli_num_rows($resultAuto) > 0) {
  	    
        echo "<br><br>";
        echo"<div align = 'center'>";
        echo '<span style="font-size: 20px;">Общи данни на отписани МПС</span>';
	         //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
	    echo"</div>";
        echo "<br><br>";
        
        echo "<table border='2'>
        
        <tr>
        <th>ID/№</th>
        <th>Вид МПС</th>
        <th>Марка</th>
        <th>Модел</th>
        <th>Рег. №</th>
        <th>Купе</th>
        <th>Шаси</th>
        <th>Първа Рег.</th>
        <th>Тегло</th>
        <th>Цвят</th>
        <th>Брой места</th>
        <th>Кубатура</th>
        <th>Мощност в к.с.</th>
        <th>Двигател</th>
        <th>Скоростна кутия</th>
        <th>Гаранция</th>
        <th>Гаранция до</th>
        <th>Стойност на МПС</th>
        <th>Адрес на домуване на МПС</th>
        <th>Текущи км</th>
        <th>Дата текущи км</th>
        </tr>";
        
        while($row = mysqli_fetch_array($resultAuto))
        {
            $autoId = $row['AutosID'];
            echo "<tr>";
            echo "<td>" . $row['AutosID'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>"; 
            echo "<td>" . $row['Brand'] . "</td>";
            echo "<td>" . $row['Model'] . "</td>";
            echo "<td>" . $row['Reg_Number'] . "</td>";
            echo "<td>" . $row['Kupe'] . "</td>";
            echo "<td>" . $row['Shasi'] . "</td>";
            echo "<td>" . $row['First_Reg'] . "</td>";
            echo "<td>" . $row['Weight'] . "</td>";
            echo "<td>" . $row['Color'] . "</td>";
            echo "<td>" . $row['Seats'] . "</td>";
            echo "<td>" . $row['Cubature'] . "</td>";
            echo "<td>" . $row['Power'] . "</td>";
            echo "<td>" . $row['Engine'] . "</td>";
            echo "<td>" . $row['Transmission'] . "</td>";
            echo "<td>" . $row['Guarantee'] . "</td>";
            echo "<td>" . $row['GuaranteeDate'] . "</td>";
            echo "<td>" . $row['Price'] . "</td>";
            echo "<td>" . $row['Address_MPS'] . "</td>";
            echo "<td>" . $row['Current_Km'] . "</td>";
            echo "<td>" . $row['Date_Current_Km'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
  	    
    }
    
    else {
        echo "<br><br>";
        echo"<div align = 'center'>";
        echo '<span style="font-size: 20px; color:black;">Няма данни за отписани МПС</span>'; // . "  " .
	         //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
	    echo"</div>";
	    $unsubscribed = false;
        echo "<br><br>";
    }

    if($unsubscribed) {

        $resultInsurance = mysqli_query($con, "SELECT * FROM insurance WHERE Individual_ID = 0 AND Legalentity_ID = 0");
	    
	    if (!$resultInsurance) {
         
                die('Грешка: ' . mysqli_error());
            }
            
	    else if (mysqli_num_rows($resultInsurance) > 0) {
	    
	        echo "<br><br>";
	        echo"<div align = 'center'>";
            echo '<span style="font-size: 20px;">Данни за застраховки на отписани МПС</span>'; //. "  " .
	             //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
            echo"</div>";
            echo "<br><br>";
         
	        echo "<table border='2'>
	        
	        <tr>
	        <th>ID/№</th>
	        <th bgcolor='$color1'>$h2 ГТП дата</th>
            <th bgcolor='$color1'>$h2 ГТП сума</th>
            <th bgcolor='$color1'>$h2 ГО дата</th>
            <th bgcolor='$color1'>$h2 ГО сума</th>
            <th bgcolor='$color1'>$h2 ГО плащане</th>
            <th bgcolor='$color1'>$h2 Каско дата</th>
            <th bgcolor='$color1'>$h2 Каско сума</th>
            <th bgcolor='$color1'>$h2 Каско плащане</th>
            <th bgcolor='$color1'>$h2 Винетка дата</th>
            <th bgcolor='$color1'>$h2 Винетка сума</th>
            <th bgcolor='$color1'>$h2 Винетка тип</th>
            <th bgcolor='$color1'>$h2 Данък</th>
            <th bgcolor='$color1'>$h2 Данък сума</th>
            <th bgcolor='$color1'>$h2 Данък платен до</th>
            <th bgcolor='$color1'>$h2 Ефективност</th>
            </tr>";
	        
	        while($row = mysqli_fetch_array($resultInsurance))
	        {
	            echo "<tr>";
	            echo "<td>" . $row['AutosID'] . "</td>";
	            echo "<td>" . $row['GTP_Date'] . "</td>";
                echo "<td>" . $row['GTP_Sum'] . "</td>";
                echo "<td>" . $row['GO_Date'] . "</td>";
                echo "<td>" . $row['GO_Sum'] . "</td>";
                echo "<td>" . $row['GO_Payment'] . "</td>";
                echo "<td>" . $row['Kasko_Date'] . "</td>";
                echo "<td>" . $row['Kasko_Sum'] . "</td>";
                echo "<td>" . $row['Kasko_Payment'] . "</td>";
                echo "<td>" . $row['Vinetka_Date'] . "</td>";
                echo "<td>" . $row['Vinetka_Sum'] . "</td>";
                echo "<td>" . $row['Vinetka_Type'] . "</td>";
                echo "<td>" . $row['Tax'] . "</td>";
                echo "<td>" . $row['Tax_Sum'] . "</td>";
                echo "<td>" . $row['Tax_Paid_Till'] . "</td>";
                echo "<td>" . $row['Efficiency'] . "</td>";
                echo "</tr>";
	        }
	        echo "</table>";
	       
        }
        else {
            echo "<br><br>";
            echo '<span style="font-size: 20px;">Няма данни за застраховки на отписани МПС</span>';  // . "  " .
	             //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
            echo "<br><br>";
        }
        	
        	$serviceData =  mysqli_query($con, "SELECT * FROM service WHERE Individual_ID = 0 AND Legalentity_ID = 0"); 
        	
        	if (mysqli_num_rows($serviceData) > 0) {
        	    echo "<br><br>";
                echo"<div align = 'center'>";
        	    echo '<span style="font-size: 20px;">Данни за сервиз на отписани МПС</span>'; // . "  " .
	                 //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
        	    echo "<br><br>";
	    
	            echo "<table border='2'>
	            
	            <tr>
	            <th>ID/№</th>
	            <th>Сервиз</th>
	            <th>Обслужване на</th>
                <th>Дата на обслужване</th>
                <th>Километри</th>
                <th>След километри</th>
                <th>След дата</th>
                <th>Сума лв</th>
                <th>Фактура №</th>
	            </tr>";
	            
	            while($row = mysqli_fetch_array($serviceData))
	            {
	                echo "<tr>";
	                
	                echo "<td>" . $row['AutosID'] . "</td>";
	                echo "<td>" . $row['Service'] . "</td>"; 
	                echo "<td>" . $row['Type'] . "</td>";
                    echo "<td>" . $row['Date_Of_Service'] . "</td>";
                    echo "<td>" . $row['Km'] . "</td>";
                    echo "<td>" . $row['After_Km'] . "</td>";
                    echo "<td>" . $row['After_Date'] . "</td>";
                    echo "<td>" . $row['Sum'] . "</td>";
                    echo "<td>" . $row['Invoice'] . "</td>";	    
	                echo "</tr>";
	            }
	            echo "</table>";
	            echo "</div>";
	    
	        }
	        
	        else {
	            echo "<br><br>";
	            echo"<div align = 'center'>";
        	    echo '<span style="font-size: 20px;">Няма данни за сервиз на отписани МПС</span>'; // . "  " .
	                 //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
        	    echo "<br><br>";
	            
	        }
        	
        	$repairData =  mysqli_query($con, "SELECT * FROM repair WHERE Individual_ID = 0 AND Legalentity_ID = 0"); 
        	
        	if (mysqli_num_rows($repairData) > 0) {
        	    
        	    echo "<br><br>";
	            echo"<div align = 'center'>";
        	    echo '<span style="font-size: 20px;">Данни за ремонт на отписани МПС</span>'; // . "  " .
	                 //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
        	    echo "<br><br>";
        	    echo "<table border='2'>
	        
	            <tr>
	            <th>ID/№</th>
                <th>Ремонт вид</th>
                <th>Ремонт на</th>
                <th>Километри</th>
                <th>Смяна на</th>
                <th>Сума лв</th>
                <th>Фактура №</th>
                <th>Дата</th>
                </tr>";
	            
	            while($row = mysqli_fetch_array($repairData))
	            {
	                echo "<tr>";
	                echo "<td>" . $row['AutosID'] . "</td>";
                    echo "<td>" . $row['Repair_Type'] . "</td>";
                    echo "<td>" . $row['Repair_Of'] . "</td>";
                    echo "<td>" . $row['Km'] . "</td>";
                    echo "<td>" . $row['Change_Of'] . "</td>";
                    echo "<td>" . $row['Sum'] . "</td>";
                    echo "<td>" . $row['Invoice'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "</tr>";
	            }
	            echo "</table>";
	            
        	}
        	
        	else {
	            echo "<br><br>";
	            echo"<div align = 'center'>";
        	    echo '<span style="font-size: 20px;">Няма данни за ремонт на отписани МПС</span>'; // . "  " .
	                 //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
        	    echo "<br><br>";
	            
	        }
        	
        	
        	$tyresData =  mysqli_query($con, "SELECT * FROM tyres WHERE Individual_ID = 0 AND Legalentity_ID = 0"); 
        	
        	if (mysqli_num_rows($tyresData) > 0) {
        	    
        	    echo "<br><br>";
	            echo"<div align = 'center'>";
        	    echo '<span style="font-size: 20px;">Данни за гуми на отписани МПС</span>'; // . "  " .
	                 //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
        	    echo "<br><br>";
        	    echo "<table border='2'>
	        
	            <tr>
	            <th>ID/№</th>
	    	    <th>Вид гуми</th>
	    	    <th>Дата на закупуване</th>
	    	    <th>Размер</th>
	    	    <th>Цена лв</th>
	    	    <th>Съхранявани в</th>
	    	    <th>Използваемост</th>
	            </tr>";
	            
	            while($row = mysqli_fetch_array($tyresData))
	            {
	                echo "<tr>";
	                echo "<td>" . $row['AutosID'] . "</td>";
	    	        echo "<td>" . $row['Type'] . "</td>";
	    	        echo "<td>" . $row['Date'] . "</td>";
	    	        echo "<td>" . $row['Size'] . "</td>";
	    	        echo "<td>" . $row['Price'] . "</td>";
	    	        echo "<td>" . $row['Saved_In'] . "</td>";
	    	        echo "<td>" . $row['Usability'] . "</td>";	    
	                echo "</tr>";
	            }
	            echo "</table>";
	            echo "</div>";
	            echo "<br><br>";
        	}
        	
        	else {
	            echo "<br><br>";
	            echo"<div align = 'center'>";
        	    echo '<span style="font-size: 20px;">Няма данни за гуми на отписани МПС</span>'; // . "  " .
	                 //'<span style="font-size: 20px; color:white;">' . $_POST['Reg_Number'] . '</span>';
        	    echo "<br><br>";
	            
	        }
	    
        echo"</div>";
        
        mysqli_close($con);
    
    }

?>	

<br><br>
<script> 

(function ($) {
    $(document).ready(function () {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
    });
})(jQuery);


$(document).ready(function (){
    var ID = "";
    var tables = document.getElementsByTagName("table");
    for (var i = 0; i < tables.length; i++) {
        if(tables[i].id != "")
            ID = tables[i].id;
    }
            //$("#click").click(function (){
            
                $('html, body').animate({
                    scrollTop: $("#" + ID).offset().top - 200
                }, 2000);
            
            
            //});
});




</script>

</body>
</html>