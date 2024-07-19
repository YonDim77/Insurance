<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="adminCss.css"/>

<script> 

    $(function(){
      $("#nav").load("nav.php"); 
    });
    
</script>

<style>

table, th, td {
    text-align: center;
    border: 1px solid black;

}

table {
    width: 35%;
}

@media screen and (max-width: 768px) {
    table {
    width: 100%;
}
}

</style>
</head>
<body>  

<div id = "nav"></div>

<br>

<h3 style = "margin-top: 6.0vw; text-align: center;">Тарифни планове</h3>

 
<?php

include 'functions.php';

$con = connectServer();

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$result = mysqli_query($con, "SELECT * FROM tariffplan");
$resultD = mysqli_query($con, "SELECT * FROM discount");

echo "<br>";

    echo "<div align = 'center'>";

    
        echo "<table border='2'>
        <tr>
        <th bgcolor='$color1'>$h2 Вид МПС</th>
        <th bgcolor='$color1'>$h2 ТП1</th>
        <th bgcolor='$color1'>$h2 ТП2</th>
        <th bgcolor='$color1'>$h2 ТП3</th>
        </tr>";
        
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td style='color:black;'>" . $row['Type_MPS'] . "</td>";
            echo "<td style='color:black;'>" . $row['TP1'] . "</td>";  
            echo "<td style='color:black;'>" . $row['TP2'] . "</td>";
            echo "<td style='color:black;'>" . $row['TP3'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
?>
<br>
<h3 style = "text-align: center;">Отстъпки</h3>
<br>
<?php
        echo "<table border='2'>
        <tr>
        <th bgcolor='$color1'>$h2 ГО</th>
        <th bgcolor='$color1'>$h2 ГТП</th>
        <th bgcolor='$color1'>$h2 Каско</th>
        <th bgcolor='$color1'>$h2 Винетка</th>
        <th bgcolor='$color1'>$h2 Друго</th>
        </tr>";
        
        while($row = mysqli_fetch_array($resultD))
        {
            echo "<tr>";
            echo "<td style='color:black;'>" . $row['GO'] . "</td>";
            echo "<td style='color:black;'>" . $row['GTP'] . "</td>";  
            echo "<td style='color:black;'>" . $row['Kasko'] . "</td>";
            echo "<td style='color:black;'>" . $row['Vinetka'] . "</td>";
            echo "<td style='color:black;'>" . $row['Other'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    echo "</div>";
		
mysqli_close($con);	

$typeMps = "Изберете вид МПС";
$tp1 = "";
$tp2 = "";
$tp3 = "";
$btnUpdate = false;
$btnFillData = false;

if(isset($_POST["btnUpdate"])) {
	$btnUpdate = true;
}
if(isset($_POST["btnFillData"])) {
	$btnFillData = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData == true) {
    
    $con = connectServer();
      
   
        $fillData = mysqli_query($con, "SELECT * FROM tariffplan
    	                      WHERE Type_MPS = '$_POST[Type_MPS]'");
    	if (!$fillData) {
    	
    	die('Грешка: ' . mysqli_error($con));
    	}
    	
    	$typeMps = $_POST['Type_MPS'];
    	 	
    	if($row = mysqli_fetch_array($fillData))
        {
            $tp1 = $row['TP1'];
            $tp2 = $row['TP2'];
            $tp3 = $row['TP3'];
        }

    mysqli_close($con);

}


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate == true) {
    
    $con = connectServer();
    
    $zero1 = false; $one1 = false;
    $updateTp="UPDATE tariffplan SET TP1 = '$_POST[TP1]', TP2 = '$_POST[TP2]', TP3 = '$_POST[TP3]' 
               Where Type_MPS = '$_POST[Type_MPS]'";
    
    $update = mysqli_query($con, $updateTp); 
    if(mysqli_affected_rows($con) == 0) {
        $zero1 = true;
    }
    if(mysqli_affected_rows($con) == 1) {
        $one1 = true;
    }
        
    if($zero1 == true) {
        $message = "Няма промяна на данни!";
        echo "<script>alert('$message');</script>";
   	         
    }
    else if($one1 == true) {
        $message = "Данните са актуализирани успешно!";
        echo "<script>alert('$message');</script>";
        echo "<script> location.replace('billing.php'); </script>";
    }
    else {
        $message = "Възникна грешка, опитайте отново!";
        echo "<script>alert('$message');</script>";
    }
    
    mysqli_close($con);
    
}

$btnFillDiscountData = false;
$go = "";
$gtp = "";
$kasko = "";
$vinetka = "";
$other = "";

if(isset($_POST["btnFillDiscountData"])) {
	$btnFillDiscountData = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillDiscountData == true) {
    
    $con = connectServer();
      
   
        $fillData = mysqli_query($con, "SELECT * FROM discount");
    	if (!$fillData) {
    	
    	die('Грешка: ' . mysqli_error($con));
    	}
    	
    	//$typeMps = $_POST['Type_MPS'];
    	 	
    	if($row = mysqli_fetch_array($fillData))
        {
            $go = $row['GO'];
            $gtp = $row['GTP'];
            $kasko = $row['Kasko'];
            $vinetka = $row['Vinetka'];
            $other = $row['Other'];
        }

    mysqli_close($con);

}


$btnUpdateDiscount = false;

if(isset($_POST["btnUpdateDiscount"])) {
	$btnUpdateDiscount = true;
}	

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdateDiscount == true) {
    
    $con = connectServer();
    
    $zero1 = false; $one1 = false;
    $updateD="UPDATE discount SET GO = '$_POST[GO]', GTP = '$_POST[GTP]', Kasko = '$_POST[Kasko]', Vinetka = '$_POST[Vinetka]', Other = '$_POST[Other]'
               Where NoRepeat = '$_POST[NoRepeat]'";
    
    $update = mysqli_query($con, $updateD); 
    if(mysqli_affected_rows($con) == 0) {
        $zero1 = true;
    }
    if(mysqli_affected_rows($con) == 1) {
        $one1 = true;
    }
        
    if($zero1 == true) {
        $message = "Няма промяна на данни!";
        echo "<script>alert('$message');</script>";
   	         
    }
    else if($one1 == true) {
        $message = "Данните са актуализирани успешно!";
        echo "<script>alert('$message');</script>";
        echo "<script> location.replace('billing.php'); </script>";
    }
    else {
        $message = "Възникна грешка, опитайте отново!";
        echo "<script>alert('$message');</script>";
    }
    
    mysqli_close($con);
    
}
	
?>


<div class="container-fluid" style = "margin-top:-21px;">
    <div class="row">
        <div class="col-sm-6">
	    <div align = "center">
	        
            <br><br>
            <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
            <h3>Актуализиране на тарифни планове</h3>  
              
              Вид МПС:<br>
              <select name="Type_MPS" style = "width:174px; height: 26px;" required="required">
              <option value="<?php echo $typeMps; ?>"><?php echo $typeMps; ?></option>
                          <?php
                              $con = connectServer();
                              $query = "SELECT * FROM tariffplan";
                              $results=mysqli_query($con, $query);
                              //loop
                              foreach ($results as $tp){
                          ?>
                                  <option value="<?php echo $tp['Type_MPS'];?>"><?php echo $tp['Type_MPS'];?></option>
                          <?php
                              }
                              mysqli_close($con);
                              
                          ?>
              </select>
              <br><br>
              <input type="submit" name="btnFillData" value="Попълни" style = "border-radius: 2px; color: red;">
            </form>
            
            <br><br>
            
            <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">
              <br><input type="text" name="Type_MPS" value = "<?php echo $typeMps; ?>" style = "display: none;">
              
              ТП1:<br><input type="text" name="TP1" value = "<?php echo $tp1; ?>" required="required" placeholder = "Задължително попълване"/ onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
              <br><br>
              ТП2: <br><input type="text" name="TP2" value = "<?php echo $tp2; ?>" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
              <br><br>
              ТП3: <br><input type="text" name="TP3" value = "<?php echo $tp3; ?>" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
              <br><br>
              <input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;">  
            </form>

	    </div>
	    </div>
        <div class="col-sm-6">
            <div align = "center">
	        <br><br>
            <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">  
                <h3>Актуализиране на отстъпки</h3> 
                <br>
                <input type="submit" name="btnFillDiscountData" value="Попълни" style = "border-radius: 2px; color: red;">
            </form>
            <br><br>
            <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">
            <br>  
              
                ГО:<br><input type="text" name="GO" value = "<?php echo $go; ?>" required="required" placeholder = "Задължително попълване"/ onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
                <br><br>
                ГТП:<br><input type="text" name="GTP" value = "<?php echo $gtp; ?>" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
                <br><br>
                Каско:<br><input type="text" name="Kasko" value = "<?php echo $kasko; ?>" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
                <br><br>
                Винетка:<br><input type="text" name="Vinetka" value = "<?php echo $vinetka; ?>" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
                <br><br>
                Друго:<br><input type="text" name="Other" value = "<?php echo $other; ?>" required="required" placeholder = "Задължително попълване" onkeypress="return (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)">*
                <br><br>
                <input type="text" name="NoRepeat" value = "<?php $noRepeat = 0; echo $noRepeat; ?>" style = "display: none;">
                <input type="submit" name="btnUpdateDiscount" value="Актуализиране" style = "border-radius: 2px; color: red;">  
            </form>
            <br><br>
        
            </div>
        </div>  	
    </div>
</div>

<div align = "center">
    <h3>Експорт справка билинг</h3> 
    <form name="input" onsubmit="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black;">
        <br><br>
        <input id = "btnSubmit" type="submit" name="btnLoadData" value="Направи справка" style = "border-radius: 2px; color: red;">
        <br><br>
    </form>
    
<?php

$btnLoadData = false;

if(isset($_POST["btnLoadData"])) {
	$btnLoadData = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnLoadData == true) {
    
    echo "<script>document.getElementById('btnSubmit').style.display = 'none';</script>";
    
    $con = connectServer();
    
    $billingPerson = mysqli_query($con, "SELECT autos.Reg_Number, autos.Type, autos.TP, autos.GO, autos.GTP, autos.Kasko, autos.Vinetka, autos.Others, autos.MAT, autos.Admin_Username, autos.Sub_Admin_Username, individual.Names, individual.EGN  
                                   FROM autos
                                   LEFT JOIN individual ON autos.Individual_ID = individual.Individual_ID
                                   WHERE autos.Individual_ID <> 0");
                                   //autos.Individual_ID IS NOT NULL AND
    $billingFirm = mysqli_query($con, "SELECT autos.Reg_Number, autos.Type, autos.TP, autos.GO, autos.GTP, autos.Kasko, autos.Vinetka, autos.Others, autos.MAT, autos.Admin_Username, autos.Sub_Admin_Username, legalentity.Name, legalentity.EIK  
                                   FROM autos
                                   LEFT JOIN legalentity ON autos.Legalentity_ID = legalentity.Legalentity_ID
                                   WHERE autos.Legalentity_ID <> 0");
    
    	if (!$billingPerson) {
    	
    	    die('Грешка: ' . mysqli_error($con));
    	}
    	
    	echo "<table style = 'display: none' border='2' id = 'billing'>
    
        <tr>
        <th bgcolor='$color1'>$h2 Рег. №</th>
        <th bgcolor='$color1'>$h2 Тип</th>
        <th bgcolor='$color1'>$h2 ТП</th>
        <th bgcolor='$color1'>$h2 ГО</th>
        <th bgcolor='$color1'>$h2 ГТП</th>
        <th bgcolor='$color1'>$h2 Каско</th>
        <th bgcolor='$color1'>$h2 Винетка</th>
        <th bgcolor='$color1'>$h2 Друго</th>
        <th bgcolor='$color1'>$h2 МАТ</th>
        <th bgcolor='$color1'>$h2 Подаминистратор Потребителско име</th>
        <th bgcolor='$color1'>$h2 Потребител Потреб. име</th>
        <th bgcolor='$color1'>$h2 Име</th>
        <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
        </tr>";
        
        while($row = mysqli_fetch_array($billingPerson))
        {
        echo "<tr>";
        
        echo "<td style='color:black;'>" . $row['Reg_Number'] . "</td>";
        echo "<td style='color:black;'>" . $row['Type'] . "</td>";
        echo "<td style='color:black;'>" . $row['TP'] . "</td>";
        echo "<td style='color:black;'>" . $row['GO'] . "</td>";
        echo "<td style='color:black;'>" . $row['GTP'] . "</td>";
        echo "<td style='color:black;'>" . $row['Kasko'] . "</td>";
        echo "<td style='color:black;'>" . $row['Vinetka'] . "</td>";
        echo "<td style='color:black;'>" . $row['Others'] . "</td>";
        echo "<td style='color:black;'>" . $row['MAT'] . "</td>";
        echo "<td style='color:black;'>" . $row['Admin_Username'] . "</td>";
        echo "<td style='color:black;'>" . $row['Sub_Admin_Username'] . "</td>";
        echo "<td style='color:black;'>" . $row['Names'] . "</td>";
	    echo "<td style='color:black;'>" . $row['EGN'] . "</td>";
        echo "</tr>";
        }
        
        while($row = mysqli_fetch_array($billingFirm))
        {
        echo "<tr>";
        
        echo "<td style='color:white;'>" . $row['Reg_Number'] . "</td>";
        echo "<td style='color:white;'>" . $row['Type'] . "</td>";
        echo "<td style='color:white;'>" . $row['TP'] . "</td>";
        echo "<td style='color:white;'>" . $row['GO'] . "</td>";
        echo "<td style='color:white;'>" . $row['GTP'] . "</td>";
        echo "<td style='color:white;'>" . $row['Kasko'] . "</td>";
        echo "<td style='color:white;'>" . $row['Vinetka'] . "</td>";
        echo "<td style='color:white;'>" . $row['Others'] . "</td>";
        echo "<td style='color:white;'>" . $row['MAT'] . "</td>";
        echo "<td style='color:white;'>" . $row['Admin_Username'] . "</td>";
        echo "<td style='color:white;'>" . $row['Sub_Admin_Username'] . "</td>";
        echo "<td style='color: white;'>" . $row['Name'] . "</td>";
	    echo "<td style='color: white;'>" . $row['EIK'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
        
        mysqli_close($con);
    


?>

<button style = "border-radius: 3px; width: 300px; color: red;" id="btnExport" onclick="fnExcelReport();">Експорт на данни</button><br><br>

<?php
}
?>


    
</div>


<script>


function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('billing'); // id of table

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

const menu = document.querySelector(".menu");
let menuVisible = false;

const toggleMenu = command => {
  menu.style.display = command === "show" ? "block" : "none";
  menuVisible = !menuVisible;
};

const setPosition = ({ top, left }) => {
  menu.style.left = `${left}px`;
  menu.style.top = `${top}px`;
  toggleMenu("show");
};

window.addEventListener("click", e => {
  if(menuVisible)toggleMenu("hide");
});

window.addEventListener("contextmenu", e => {
    e.preventDefault();
    
    var mousePosition = {};
    var menuPosition = {};
    var menuDimension = {};
	
	$(document).ready(function(){
           
		menuDimension.x = $("div").outerWidth();  
		menuDimension.y = $("div").outerHeight(); 
		mousePosition.x = e.pageX; 
        mousePosition.y = e.pageY; 
 
    if (mousePosition.x + menuDimension.x > $(window).width() + $(window).scrollLeft()) {
        menuPosition.x = mousePosition.x - menuDimension.x - $(window).scrollLeft(); 
    } else {
        menuPosition.x = mousePosition.x;  
    }

    if (mousePosition.y + menuDimension.y > $(window).height()) {
         menuPosition.y = mousePosition.y - menuDimension.y - $(window).scrollTop(); 
     } 
	else if(mousePosition.y < menuDimension.y || $(window).scrollTop() > 0) {
		 menuPosition.y = mousePosition.y - $(window).scrollTop();
	 }
	else {
         menuPosition.y = mousePosition.y; 
     }
	
	  const origin = {
      left: menuPosition.x,
	   top: menuPosition.y
	};
	
	setPosition(origin);

});
   

  return false;       
  
});
 

</script> 
  
</div>  
</body>
</html>