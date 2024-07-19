<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['consultantUserName'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script>//sessionStorage.setItem("scroll", "0");
        //sessionStorage.getItem("y") = 0;
//		sessionStorage.setItem("counter", "0"); 
		
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
body {
  background: #f2e6ff;  
	
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
    background: #f2e6ff;
    
}

a:link {
    background-color: transparent; 
    text-decoration: none;
}


.navbar {
     
      border-radius: 0;
	  z-index:99;
	  
}

.navbar .navbar-nav a {
    padding: 22px 15px 27px 15px;
    font-size: 18px;
}
.navbar .dropdown-menu a {
    padding: 5px 10px 5px 10px;
    font-size: 14px;
}

.navbar-header img{
    margin-top: 10px;
}

@media screen and (min-width: 768px) {
    .navbar-inverse {
        margin-top:0px; height: 70px; position: fixed; width: 100%;
    }
    ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;    
    }
}


</style>

</head>
<body>
 
<nav class="navbar navbar-inverse" style = "margin-top: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="" alt="Insurance" width="150" height="20"></a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeIndividual.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
      <!--<li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="services.html" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Опции<span class="caret"></span></a>
	  <ul class="dropdown-menu">
          
          <li><a href="subAdminShowDataAllPersons.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране на вашите лични данни</a></li>
          <li><a href="subAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на МПС</a></li>
          
	  </ul>
      </li>-->

      <li class="dropdown"><a style = "color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-user-o">&nbsp;<?php echo  $_SESSION['consultantfName'] . " " . $_SESSION['consultantlName']; ?></i><span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <!--<li><a style="cursor:pointer" onClick = "document.getElementById('dataInd').style.display = 'block'" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране на вашите лични данни</a></li>
	        <li><a style="cursor:pointer" onClick = "document.getElementById('mpsData').style.display = 'block'" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на МПС</a></li>
	        <li><a href="history.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Смяна на парола</a></li>-->
	        <li><a href="logout.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Изход</a></li>
	    </ul>
	  </li>
	  
	</ul>	
  </div>
</nav> 
 
<div align = "center">
    <br><br>
    <h3 style = "margin-top: 4.0vw;">Визуализиране данни на МПС</h3>
      <br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;"> 
        <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
    	<p style = "margin-bottom: 0px;">Рег. №:</p><input type="text" name="Reg_Number" value = "<?php echo $Reg_Number;?>" required="required" placeholder = "Задължително попълване">*
    	<br><br>
        <input type="submit" name="btnShowData" value="Покажи данни" style = "border-radius: 2px; color: red;">
      </form>
    <br><br>  

</div>

<?php

include 'functions.php';

$btnShowData = false;
if(isset($_POST["btnShowData"])) {
	$btnShowData = true;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnShowData) {
	
    $con = connectServer();
    
    	$AutosID = 0;
    	$rNumber = mysqli_real_escape_string($con, $_POST['Reg_Number']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sql = "SELECT Reg_Number FROM autos WHERE Reg_Number='$rNumber'";
        $result1 = mysqli_query($con, $sql);
    	
    	if(!mysqli_num_rows($result1) >0){
    		
    		
    	    $message = "Несъществуващ регистрационен номер!";
		    echo "<script>alert('$message');</script>";
    		
    	} 
     
      
        else {
      
            $result = mysqli_query($con, "SELECT * FROM autos
    	                          WHERE Reg_Number = '$rNumber'");  
    	    
    	    if (!$result) {
    	    
    	    die('Грешка: ' . mysqli_error());
    	    }
    	    
    	    echo"<div align = 'center'>";
    	    echo'<span style="font-size: 20px;">Общи данни на МПС:</span>';
    	    echo "<br><br>";
    	 	
    	 	echo "<table border='2'>
	    
	        <tr>
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
	        
	        while($row = mysqli_fetch_array($result))
	        {
	            $AutosID = $row['AutosID'];
	            
	            echo "<tr>";
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
    		echo "<br><br>";
    	}
    	echo"<div align = 'center'>";
    	echo'<span style="font-size: 20px;">Данни за сервиз на МПС:</span>';
    	echo "<br><br>";
    	
    	$serviceData =  mysqli_query($con, "SELECT * FROM service WHERE AutosID = '$AutosID'"); 
    	
    	if (mysqli_num_rows($serviceData) > 0) {
	
	    echo "<table border='2'>
	    
	    <tr>
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
	    
	    echo "<br><br>";
	    echo"<div align = 'center'>";
    	echo'<span style="font-size: 20px;">Данни за ремонт на МПС:</span>';
    	echo "<br><br>";
    	
    	$repairData =  mysqli_query($con, "SELECT * FROM repair WHERE AutosID = '$AutosID'"); 
    	
    	if (mysqli_num_rows($repairData) > 0) {
    	    
    	    echo "<table border='2'>
	    
	        <tr>
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
    	
    	echo "<br><br>";
	    echo"<div align = 'center'>";
    	echo'<span style="font-size: 20px;">Данни за гуми на МПС:</span>';
    	echo "<br><br>";
    	
    	$tyresData =  mysqli_query($con, "SELECT * FROM tyres WHERE AutosID = '$AutosID'"); 
    	
    	if (mysqli_num_rows($tyresData) > 0) {
    	    
    	    echo "<table border='2'>
	    
	        <tr>
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

	  mysqli_close($con);
	}

?>
  

<script> 

</script>

</body>
</html>