<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminUsername'])) {
header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">-->
<meta charset="UTF-8">
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
    
}
table {
    width: 120%;
}

th, td {
    
    text-align: center;
}

</style>
</head>
<body> 

<div id = "adminNav"></div>

<br>  

<?php

include 'functions.php';

$_SESSION['valueMAT'] = 1;
$_SESSION['valueGO'] = 0;
$_SESSION['valueGTP'] = 0;
$_SESSION['valueKasko'] = 0;
$_SESSION['valueVinetka'] = 0;
$_SESSION['valueOther'] = 0;
$_SESSION['valueTP'] = 1;
$_SESSION['valueTP1'] = 1;
$_SESSION['valueTP2'] = 1;
$_SESSION['valueTP3'] = 1;

$btnFillData = false;
$btnUpdate = false;

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

if(isset($_POST["btnFillData"])) {
	$btnFillData = true;
}
if(isset($_POST["btnUpdate"])) {
	$btnUpdate = true;
}

$AutosID = "";
//$Admin_Username = "";
//$Sub_Admin_Username = ""; 
$Type = ""; 
$Brand = "";
$Model = ""; 
$Reg_Number = "";
$Kupe = "";
$Shasi = "";
$First_Reg =  ""; 
$Weight = ""; 
$Color = ""; 
$Seats = "";
$Cobature = "";
$Power = "";
$Engine = "";
$Transmission = "";
$Guarantee = "";
$GuaranteeDate = "";
$Price = "";
$Address_MPS = "";
$Current_Km = "";
$Date_Current_Km = "";
$mat = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnFillData) {
	
    $con = connectServer();
    
    $messageError = "<h2>Моля попълнете полето!</h2>";
    //$AutosID = $_POST["Autos_ID"];
    
      
      /*if(strlen($AutosID)==0)
    	
      {
        echo $messageError;
      }
      
      else if (!filter_var($AutosID, FILTER_VALIDATE_INT)) {
        
    	echo "<br>";
        echo"<br><br>";
    	echo"<div align = 'center'>";
    	echo'<span style="font-size: 20px; color:red; ">Въведете цяло число в полето "ID"!</span>';
        echo"</div>";	
    	
      } 
      
      else {   // if(filter_var($Nomer, FILTER_VALIDATE_INT)) {
    */	  
    	//$url_id = mysqli_real_escape_string($con, $_POST['Individual_ID']);
    	
    	$rNumber = mysqli_real_escape_string($con, $_POST['Reg_Number']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sql = "SELECT Reg_Number FROM autos WHERE Reg_Number='$rNumber' AND Admin_Username = '$_SESSION[adminUsername]'";
        $result1 = mysqli_query($con, $sql);
    	
    	if(!mysqli_num_rows($result1) >0){
    		
    		//echo"<br><br>";
    	    //echo"<div align = 'center'>";
    	    $message = "Несъществуващ или регистрационен номер, до който нямате достъп!";
		    echo "<script>alert('$message');</script>";
    		//echo '<span style="font-size: 20px; color:red; ">Несъществуващ номер на данни!</span>';
    		//echo"<br><br><br><br>";
            //echo"</div>";
    	} 
     
      
        else {
      
        $result = mysqli_query($con, "SELECT * FROM autos
    	                      WHERE Reg_Number = '$rNumber'
    	                      AND Admin_Username = '$_SESSION[adminUsername]'");  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    	if (!$result) {
    	
    	die('Грешка: ' . mysqli_error());
    	}
    	 	
    		if($row = mysqli_fetch_array($result))
            {
                $AutosID = $row['AutosID'];
                //$Admin_Username = $row['Admin_Username'];
                //$Sub_Admin_Username = $row['Sub_Admin_Username'];
                $Type = $row['Type']; 
                $Brand = $row['Brand'];
                $Model = $row['Model']; 
                $Reg_Number = $row['Reg_Number'];
                $Kupe = $row['Kupe'];
                $Shasi = $row['Shasi'];
                $First_Reg =  $row['First_Reg'];
                $Weight =  $row['Weight']; 
                $Color =  $row['Color']; 
                $Seats =  $row['Seats'];
                $Cubature =  $row['Cubature'];
                $Power =  $row['Power'];
                $Engine = $row['Engine'];
                $Transmission =  $row['Transmission'];
                $Guarantee = $row['Guarantee'];
                $GuaranteeDate = $row['GuaranteeDate'];
                $Price = $row['Price'];
                $Address_MPS = $row['Address_MPS'];
                $Current_Km = $row['Current_Km'];
                $Date_Current_Km = $row['Date_Current_Km'];
                $mat = $row['MAT'];
 
                
                //$_SESSION['saveEmailUsername'] = $Email_Username;
    		}
    	}
//	  }
	  mysqli_close($con);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdate) {
	
      $con = connectServer();
      
        //$sqlUpdateUsernames ="UPDATE usernames SET username = '$_POST[Email_Username]' Where username = '$_SESSION[saveEmailUsername]'"; 
        
        $resultHistory = mysqli_query($con, "SELECT * FROM autos Where AutosID = '$_POST[AutosID]'");
        
        $sqlUpdateAutos="UPDATE autos SET  
        Type = '$_POST[Type]', Brand = '$_POST[Brand]', Model = '$_POST[Model]', Reg_Number = '$_POST[Reg_Number]',
        Kupe = '$_POST[Kupe]', Shasi = '$_POST[Shasi]', First_Reg= '$_POST[First_Reg]', Weight= '$_POST[Weight]',
        Color = '$_POST[Color]', Seats = '$_POST[Seats]', Cubature = '$_POST[Cubature]', Power = '$_POST[Power]', Engine = '$_POST[Engine]',
        Transmission = '$_POST[Transmission]', Guarantee = '$_POST[Guarantee]', GuaranteeDate = '$_POST[GuaranteeDate]',
        Price = '$_POST[Price]', Address_MPS = '$_POST[Address_MPS]', Current_Km = '$_POST[Current_Km]', Date_Current_Km = '$_POST[Date_Current_Km]',
        TP = '$_POST[TP]', GO = '$_POST[GO]', GTP = '$_POST[GTP]', Kasko = '$_POST[Kasko]',
        Vinetka = '$_POST[Vinetka]', Others = '$_POST[Others]', MAT = '$_POST[MAT]'
        Where AutosID = '$_POST[AutosID]'
        AND Admin_Username = '$_SESSION[adminUsername]'";
      
        mysqli_autocommit($con, FALSE);
        mysqli_query($con,"START TRANSACTION");
        $update = mysqli_query($con, $sqlUpdateAutos);
        
      
        if ($update && mysqli_affected_rows($con) == 0) {
         mysqli_commit($con);
   	     $message = "Няма промяна на данни!";
   	     echo "<script>alert('$message');</script>";
        } 
        else if ($update && mysqli_affected_rows($con) == 1) {
            
          $nameFile = "Общи_Данни_МПС_Рег_№";
          $nameFile = $nameFile.$_POST['Reg_Number'];
          $dataS = "";
          $dataH= "";
          $updateDate = date("d-m-Y");
          
          if (!file_exists('history/general_data_autos/' . $nameFile . '.xls')) {
              $dataH= "<table>
              
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
              <th>Дата тек. км</th>
              <th>ТП</th>
              <th>ГО</th>
              <th>ГТП</th>
              <th>Каско</th>
              <th>Винетка</th>
              <th>Друго</th>
              <th>МАТ</th>
	          <th>Редактор</th>
	          <th>Дата на редакция</th>
	          </tr>
              </table>";
          }
          
          while($row = mysqli_fetch_array($resultHistory))
          {
          $dataD = "<table>
          <tr>
          <td>$row[Type]</td> 
	      <td>$row[Brand]</td>
	      <td>$row[Model]</td>
	      <td>$row[Reg_Number]</td>
	      <td>$row[Kupe]</td>
	      <td>$row[Shasi]</td>
	      <td>$row[First_Reg]</td>
	      <td>$row[Weight]</td>
	      <td>$row[Color]</td>
	      <td>$row[Seats]</td>
	      <td>$row[Cubature]</td>
	      <td>$row[Power]</td>
	      <td>$row[Engine]</td>
	      <td>$row[Transmission]</td>
	      <td>$row[Guarantee] </td>
	      <td>$row[GuaranteeDate] </td>
	      <td>$row[Price]</td>
	      <td>$row[Address_MPS]</td>
	      <td>$row[Current_Km]</td>
          <td>$row[Date_Current_Km]</td>
          <td>$row[TP]</td>
          <td>$row[GO]</td>
          <td>$row[GTP]</td>
          <td>$row[Kasko]</td>
          <td>$row[Vinetka]</td>
          <td>$row[Others]</td>
          <td>$row[MAT]</td>
          <td>$_SESSION[adminUsername]</td>
          <td>$updateDate</td>
          </tr>
          <table>";
           $dataS = $dataS.$dataD;
          }
          
          $dataHD = $dataH.$dataS;
          $dataHD= mb_convert_encoding($dataHD, "windows-1251", "auto");
          file_put_contents('history/general_data_autos/' . $nameFile . '.xls', $dataHD, FILE_APPEND | LOCK_EX);
          
          mysqli_commit($con);
   	      $message = "Данните са актуализирани успешно!";
   	      echo "<script>alert('$message');</script>";
        }  
        else {  
         mysqli_rollback($con);
   	     $message = "Възникна грешка, опитайте отново! Дублиране на регистрационен номер!"; //!!!!номер шаси
         echo "<script>alert('$message');</script>";
        }
        mysqli_query($con, "SET AUTOCOMMIT=TRUE");
//    }  
      $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM autos WHERE AutosID = '$_POST[AutosID]'");
      
      if (mysqli_num_rows($sqlShowUpdatedData) > 0) {
	
	
	    echo "<table border='2' style = 'margin-top: 7.0vw;'>
	    
	    
	    <tr>
	    <th bgcolor='$color1'>$h2 Вид МПС</th>
	    <th bgcolor='$color1'>$h2 Марка</th>
	    <th bgcolor='$color1'>$h2 Модел</th>
	    <th bgcolor='$color1'>$h2 Рег. №</th>
	    <th bgcolor='$color1'>$h2 Купе</th>
	    <th bgcolor='$color1'>$h2 Шаси</th>
	    <th bgcolor='$color1'>$h2 Първа Рег.</th>
	    <th bgcolor='$color1'>$h2 Тегло</th>
	    <th bgcolor='$color1'>$h2 Цвят</th>
	    <th bgcolor='$color1'>$h2 Брой места</th>
	    <th bgcolor='$color1'>$h2 Кубатура</th>
	    <th bgcolor='$color1'>$h2 Мощност в к.с.</th>
	    <th bgcolor='$color1'>$h2 Двигател</th>
	    <th bgcolor='$color1'>$h2 Скоростна кутия</th>
	    <th bgcolor='$color1'>$h2 Гаранция</th>
	    <th bgcolor='$color1'>$h2 Гаранция до</th>
	    <th bgcolor='$color1'>$h2 Стойност на МПС</th>
	    <th bgcolor='$color1'>$h2 Адрес на домуване на МПС</th>
	    <th bgcolor='$color1'>$h2 Текущи км</th>
        <th bgcolor='$color1'>$h2 Дата тек. км</th>
        <th bgcolor='$color1'>$h2 ТП</th>
        <th bgcolor='$color1'>$h2 ГО</th>
        <th bgcolor='$color1'>$h2 ГТП</th>
        <th bgcolor='$color1'>$h2 Каско</th>
        <th bgcolor='$color1'>$h2 Винетка</th>
        <th bgcolor='$color1'>$h2 Друго</th>
        <th bgcolor='$color1'>$h2 МАТ</th>
	    </tr>";
	    
	    while($row = mysqli_fetch_array($sqlShowUpdatedData))
	    {
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
	    echo "<td style='color:black;'>" . $row['Current_Km'] . "</td>";
        echo "<td style='color:black;'>" . $row['Date_Current_Km'] . "</td>";
        echo "<td style='color:black;'>" . $row['TP'] . "</td>";
        echo "<td style='color:black;'>" . $row['GO'] . "</td>";
        echo "<td style='color:black;'>" . $row['GTP'] . "</td>";
        echo "<td style='color:black;'>" . $row['Kasko'] . "</td>";
        echo "<td style='color:black;'>" . $row['Vinetka'] . "</td>";
        echo "<td style='color:black;'>" . $row['Others'] . "</td>";
        echo "<td style='color:black;'>" . $row['MAT'] . "</td>";
	    echo "</tr>";
	    }
	    echo "</table>";
	
	}
      
      mysqli_close($con);
	}
?>	

<div align = "center">
  
  
  <h3 style = "margin-top: 7.0vw;">Актуализиране общи данни на МПС:</h3>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = ""> 
    <table class = "iDataInput">
        <tr>
            <!--<p id="demo" style = "margin-bottom: 0px;">ID/№:</p><input id = "numRec" oninput="checkInput()" type="number" name="Individual_ID" value = "<?php echo $Individual_ID;?>" required="required" placeholder = "Задължително попълване">*-->
	        <td></td>
	        <td><p style = "margin-bottom: 0px;">Рег. №*</p><input type="text" name="Reg_Number" value = "<?php if(isset($_SESSION['Reg_Number_Global'])) echo $_SESSION['Reg_Number_Global']; else echo $Reg_Number;?>" required="required" placeholder = "Задължително попълване"></td>
	        <td></td>
	   </tr>
	   <tr>
	        <td></td>
            <td><br><input type="submit" name="btnFillData" value="Попълни данни" style = "border-radius: 2px; color: red;"></td>
            <td></td>
       </tr>
    </table>
  </form>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "">  
    <table class = "iDataInput">
        <tr>
            <input type="number" name="AutosID" value = "<?php echo $AutosID;?>" style = "display: none;">
	        <br><br>
	        <td>Вид МПС*<br>    
	        <select name="Type" onchange="typeMps(this.value)" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Type;?>"><?php echo $Type;?></option>
                        <?php
                            $con = connectServer();
                            $query = "SELECT Type_MPS FROM tariffplan";
                            $results=mysqli_query($con, $query);
                            //loop
                            foreach ($results as $tPlans){
                        ?>
                                <option value="<?php echo $tPlans['Type_MPS'];?>"><?php echo $tPlans['Type_MPS'];?></option>
                        <?php
                            }
                            mysqli_close($con);
                            
                        ?>
            </select></td>
            
            <td>Марка*<br><input type="text" value="<?php echo $Brand;?>" name="Brand" required="required" placeholder = "Задължително попълване"  onkeypress="return (event.charCode == 32 || event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" /></td>
	        
            
	        <td>Модел*<br><input type="text" value="<?php echo $Model;?>" name="Model" required="required" placeholder = "Задължително попълване"  onkeypress="return (event.charCode == 32 || event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" /></td>
        </tr>
        <tr>
	        <td>Рег. номер*<br><input type="text" value="<?php echo $Reg_Number;?>" name="Reg_Number" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Купе*<br>    
	        <select name="Kupe" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Kupe;?>"><?php echo $Kupe;?></option>
            <option value="седан">седан</option>												
            <option value="хечбек">хечбек</option>
            <option value="комби">комби</option>
            <option value="купе">купе</option>
	        <option value="кабрио">кабрио</option>
            <option value="пикап">пикап</option>
            <option value="ван">ван</option>
	        <option value="джип">джип</option>
            <option value="други">други</option>
            </select></td>
            
	        <td>Шаси*<br><input type="text" value="<?php echo $Shasi;?>" name="Shasi" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td>Първа регистрация*<br><input type="Date" value="<?php echo $First_Reg;?>" name="First_Reg" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Тегло кг*<br><input type="number" value="<?php echo $Weight;?>" name="Weight" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Цвят*<br>    
	        <select name="Color" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Color;?>"><?php echo $Color;?></option>
            <option value="бял">бял</option>												
            <option value="перла">перла</option>
            <option value="слонова кост">слонова кост</option>
            <option value="бежов">бежов</option>
	        <option value="графит">графит</option>
            <option value="сив">сив</option>
            <option value="сребрист">сребрист</option>
	        <option value="жълт">жълт</option>
            <option value="зелен">зелен</option>
	        <option value="златист">златист</option>
            <option value="кафяв">кафяв</option>
	        <option value="розов">розов</option>
            <option value="лилав">лилав</option>
	        <option value="светло зелен">светло зелен</option>
	        <option value="тъмно зелен">тъмно зелен</option>
            <option value="син">син</option>
            <option value="светло син ">светло син</option>
	        <option value="тъмно син">тъмно син</option>
            <option value="светло червен">светло червен</option>
	        <option value="червен">червен</option>
            <option value="тъмно червен">тъмно червен</option>
	        <option value="хамелеон">хамелеон</option>
            <option value="черен">черен</option>
            </select></td>
        </tr>
        <tr>
	        <td>Брой места*<br><input  type="number" value="<?php echo $Seats;?>" name="Seats" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Кубатура*<br><input  type="number" value="<?php echo $Cubature;?>" name="Cubature" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Мощност в к.с.*<br><input  type="number" value="<?php echo $Power;?>" name="Power" required="required" placeholder = "Задължително попълване"></td>
        </tr>
        <tr>
	        <td>Двигател*<br>    
	        <select name="Engine" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Engine;?>"><?php echo $Engine;?></option>
            <option value="бензин">бензин</option>												
            <option value="дизел">дизел</option>
            <option value="газ">газ</option>
            <option value="метан">метан</option>
	        <option value="хибрид">хибрид</option>
            <option value="електрически">електрически</option>
            </select></td>
            
	        <td>Скоростна кутия*<br>    
	        <select name="Transmission" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Transmission;?>"><?php echo $Transmission;?></option>
            <option value="ръчна">ръчна</option>												
            <option value="автоматична">автоматична</option>
            </select></td>
            
	        <td>Гаранция*<br>    
	        <select name="Guarantee" style = "width:174px; height: 27px;" required="required">
	        <option value="<?php echo $Guarantee;?>"><?php echo $Guarantee;?></option>
            <option value="да">да</option>												
            <option value="не">не</option>
            </select></td>
        </tr>
        <tr>
	        <td>Гаранция до*<br><input type="date" value="<?php echo $GuaranteeDate;?>" name="GuaranteeDate" style = "width:174px; height: 27px;" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Стойност на МПС*<br><input type="text" value="<?php echo $Price;?>" name="Price" required="required" placeholder = "Задължително попълване"></td>
            
	        <td>Адрес на домуване на МПС*<br><input type="text" value='<?php echo $Address_MPS;?>' name="Address_MPS" required="required" placeholder = "Задължително попълване"></td>
        <tr>
            <td>Текущи километри*<br><input  type="number" value='<?php echo $Current_Km;?>' name="Current_Km" required="required" placeholder = "Текущи километри*"></td>
                  
            <td>Дата текущи километри*<br><input  style = "width:174px;" type="date" value='<?php echo $Date_Current_Km;?>' name="Date_Current_Km" required="required" placeholder = "Дата Текущи километри*"></td>
            
            <td>ТП:<br><select style = "width:174px; height: 26px;" name="TP"  required="required" onchange="tpF(this.value)">
            <option value=""></option>
            <option value="ТП1">ТП1</option>
            <option value="ТП2">ТП2</option>
            <option value="ТП3">ТП3</option>
            </select></td>
        </tr>
        <tr>
            <td>ГО*<br><select name="GO"  style = "width:174px; height: 26px;" required="required" onchange="goF(this.value)">
	        <option value=""></option> 
            <option value="да">да</option>
            <option value="не">не</option>	
            </select></td>
	        
            <td>ГТП*<br><select name="GTP"  style = "width:174px; height: 26px;" required="required" onchange="gtpF(this.value)">
            <option value=""></option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
            
            <td>Каско*<br><select name="Kasko"  style = "width:174px; height: 26px;" required="required" onchange="kaskoF(this.value)">
            <<option value=""></option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	   </tr>
	   <tr>
	        <td>Винетка*<br><select name="Vinetka"  style = "width:174px; height: 26px;" required="required" onchange="vinetkaF(this.value)">
            <option value=""></option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	        
	        <td>Друго*<br><select name="Others"  style = "width:174px; height: 26px;" required="required" onchange="otherF(this.value)">
            <option value=""></option>
            <option value="да">да</option>
            <option value="не">не</option>
            </select></td>
	        
	        <!--МАТ: <br><select id = "mat" name="MAT" style = "width:174px; height: 26px;" required="required" >
            <option value="<?php echo $mat;?>"><?php echo $mat;?></option>
            </select>-->
            <td><fieldset id = "mat">
            МАТ*<br><input type = "text"  name="MAT" value="<?php echo $mat;?>" style = "width:174px; height: 26px;" required="required" readonly>
            </fieldset></td>
        </tr>
        <tr>
            <td></td>
            <td><br><input type="submit" name="btnUpdate" value="Актуализиране" style = "border-radius: 2px; color: red;"></td>
            <td></td>
        </tr>
    </table>
  </form>
  
</div>	

<?php
unset($_SESSION['Reg_Number_Global']);
?>

<script>

function typeMps(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?q="+str, true);
  xhttp.send();
}

function goF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете ГО!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qGO="+str, true);
  xhttp.send();
}

function gtpF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете ГТП!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qGTP="+str, true);
  xhttp.send();
}

function tpF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете тарифен план!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qTP="+str, true);
  xhttp.send();
}

function kaskoF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете каско!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qKasko="+str, true);
  xhttp.send();
}

function vinetkaF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете винетка!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qVinetka="+str, true);
  xhttp.send();
}

function otherF(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("mat").innerHTML = "";
    alert("Моля изберете друго!");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("mat").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getBillingData.php?qOther="+str, true);
  xhttp.send();
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
<br>		  
</body>		  
</html>