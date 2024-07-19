<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['usernameHolding'])) {
    header('Location: index.php');
}

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

    
</script>

<style>
body {
    
}

input[type=text] {
  /*width: 500px;*/
}

table, th, td {
    text-align: center;
    
}
table {
    width: 100%;
}

.docPics tr:hover {
    
    background-color:#f2e6ff;
    
}

</style>
</head>
<body> 

<nav class="navbar navbar-inverse" style = "margin-top:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
<!--      <a id = "brandMenu" class="navbar-brand" href="#" style = "color:red;">Буболечкоубийци</a>-->
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="BugK.png" alt="Insurance" width="150" height="20"></a>
    </div>
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeHolding.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
<!--  <li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="services.html" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Администрация<span class="caret"></span></a>
	  <ul class="dropdown-menu">
	      <li id = "sprayer" style = "background-color: white; color: white; margin-top:0px;">AAAA<img src="Sprayer.jpg" alt="BugKillers" width="60" height="50" style = "border-radius: 5px;"></li>
          <li><a href="subAdminShowDataAllPersons.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на холдинг</a></li>
          <li><a href="subAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на МПС</a></li>

	  </ul>
      </li>-->
      <li class="dropdown"><a style = "color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-user-o">&nbsp;<?php echo  $_SESSION['userHoldingfName']. " " . $_SESSION['userHoldinglName']; ?></i><span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <!--<li><a href="adminProfile.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Профил</a></li>
	        <li><a href="help.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Помощ</a></li>
	        <li><a href="history.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Смяна на парола</a></li>-->
	        <li><a href="logout.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Изход</a></li>
	    </ul>
	  </li>
	  	
	</ul>	
  </div>
</nav>
<br> 

<div align = "center">
    <h3 style = "margin-top: 7.0vw;"><b>Актуализиране на документи на МПС</b></h3><br>
    
    <?php

    include 'functions.php';

    $btnUpdatePdf = false;
    
    $h1 = " ";
    $h2 = " ";
    if ($h1 == " "){$color="#d8f0f3";}
    if ($h2 == " "){$color1="white";}
    
    
    if(isset($_POST["btnUpdatePdf"])) {
    	$btnUpdatePdf = true;
    }
    


//$Reg_Number = "";  

if (!$btnUpdatePdf) {
	
    $con = connectServer();
    	
    	$Reg_Number = $_SESSION['holdingFirmAutoRegNumber']; //mysqli_real_escape_string($con, $_POST['Reg_Number']);       // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        
		$checkForDocsData =  mysqli_query($con, "SELECT * FROM documents WHERE Reg_Number = '$Reg_Number'");
 
    	
		if(!mysqli_num_rows($checkForDocsData) > 0){
		    $message = "Няма данни за документи за този регистрационен номер!";
		    echo "<script>alert('$message');</script>";
		} 
           
        else {
      
			//$result = mysqli_query($con, "SELECT * FROM documents WHERE Reg_Number = '$Reg_Number'");
								  
								
			//$_SESSION['Reg_Number']	= $Reg_Number;
			
			//if (!$result) {
			//
			//die('Грешка: ' . mysqli_error());
			//}
    	 	
    		if($row = mysqli_fetch_array($checkForDocsData))
            {
                echo "<br>";
                      echo '<span style="font-size: 25px; color:black;">Документи на МПС с регистрационен номер ' . '<b>' . $Reg_Number . '</b>' . '</span>';
                      echo "<br><br>";
                
                if($row['Pdf_File'] != NULL)
                {
                    
                    echo '  
                           <tr>  
                                <td>  
                                     
                                     <iframe src="data:application/pdf;base64,'.base64_encode($row['Pdf_File']).'" type="application/pdf" style="height:400px;width:50%"></iframe>
    
                                </td>  
                           </tr>  
                      ';
                    echo "<br><br>";
                    
                    echo '<form method="post" enctype="multipart/form-data" style = "">';
                        echo '<input id = "pdf" type="file" name="pdf" style = "">';
?>                    
                        <input type="text" name="rNumber" value = "<?php echo $Reg_Number; ?>" style = "display: none;">
<?php                    
                        echo "<br><br>";
                        echo '<input id = "update" type="submit" name="btnUpdatePdf" style = "" value = "Редакция">';
                    echo '</form>';
                    echo "<br><br>";
                }
                else
                {
                    echo '<form method="post" enctype="multipart/form-data" style = "">';
?>
                    <input type="text" name="rNumber" value = "<?php echo $Reg_Number; ?>" style = "display: none;">
<?php
                    echo "<table class = 'docPics' style = 'width: 100%;'>";  
                      echo "<tr>";  
                            echo "<td>";  
                                 
                                 if(strcmp($row['Go_Ext'], 'pdf') == 0)
                                    echo' <b>ГО</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Go_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else 
                                    echo' <b>ГО</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Go_Pic'] ).'" style="height:300px; width:25.0vw;"><br>';
                                 
                                 echo '<div align = "center">';

                                    echo'<br><input id = "img1" type="file" name = "img1" style = "">';
                                    
                                 echo '</div>';   
                                  
                            echo"</td>"; 
                            echo "<td>";  
                                 
                                 if(strcmp($row['Kasko_Ext'], 'pdf') == 0)
                                    echo' <b>Каско</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Kasko_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <b>Каско</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Kasko_Pic'] ).'" style="height:300px; width:25.0vw;">';
                                 
                                 echo '<div align = "center">';
                                    echo '<br><input id = "img2" type="file" name="img2" style = "">';
                                 echo '</div>';
                                
                            echo "</td>";
                            echo "<td>";  
                                 
                                 if(strcmp($row['Vinetka_Ext'], 'pdf') == 0)
                                    echo' <b>Винетка</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Vinetka_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <b>Винетка</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Vinetka_Pic'] ).'" style="height:300px; width:25.0vw;">';
                                 
                                 echo '<div align = "center">';
                                    echo '<br><input id = "img3" type="file" name="img3" style = "">';
                                 echo '</div>';
                                 
                            echo "</td>";
                           echo "</tr>"; 
                           
                           echo "<tr>";  
                            echo "<td>";  
                                 
                                 if(strcmp($row['GTP_Ext'], 'pdf') == 0)
                                    echo' <br><b>ГТП</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['GTP_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>ГТП</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['GTP_Pic'] ).'" style="height:300px; width:25.0vw;">';

                                    echo '<div align = "center">';
                                        echo '<br><input id = "img4" type="file" name="img4" style = "">';
                                    echo '</div>';
                                 
                            echo"</td>"; 
                            echo "<td>";  
                                 
                                 if(strcmp($row['Tax_Ext'], 'pdf') == 0)
                                    echo' <br><b>Данък</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Tax_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Данък</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Tax_Pic'] ).'" style="height:300px; width:25.0vw;">';
                                    
                                 echo '<div align = "center">';
                                     echo '<br><input id = "img5" type="file" name="img5" style = "">';
                                 echo '</div>';    

                            echo "</td>";
                            echo "<td>";  
                                 
                                 if(strcmp($row['Tyres_Ext'], 'pdf') == 0)
                                    echo' <br><b>Гуми</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Tyres_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Гуми</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Tyres_Pic'] ).'" style="height:300px; width:25.0vw;">';
                                 
                                 echo '<div align = "center">';
                                     echo '<br><input id = "img6" type="file" name="img6" style = "">';
                                 echo '</div>';
                                 
                            echo "</td>";
                           echo "</tr>";
                           
                           echo "<tr>";  
                            echo "<td>";  
                                 
                                 if(strcmp($row['Talon_Ext'], 'pdf') == 0)
                                    echo' <br><b>Малък талон</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Talon_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Малък талон</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Talon_Pic'] ).'" style="height:300px; width:25.0vw;">';
                                 
                                 echo '<div align = "center">';
                                    echo '<br><input id = "img7" type="file" name="img7" style = "">';
                                 echo '</div>';
                                 
                            echo"</td>"; 
                            echo "<td>";  
                                 
                                 if(strcmp($row['ServiceBook_Ext'], 'pdf') == 0)
                                    echo' <br><b>Сервизна книжка</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['ServiceBook_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Сервизна книжка</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['ServiceBook_Pic'] ).'" style="height:300px; width:25.0vw;">';
                                 
                                 echo '<div align = "center">';
                                    echo '<br><input id = "img8" type="file" name="img8" style = "">';
                                 echo '</div>';
                                 
                            echo "</td>";
                            echo "<td>";  
                                 
                                 if(strcmp($row['DrivingL_Ext'], 'pdf') == 0)
                                    echo' <br><b>Шофьорска книжка</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['DrivingL_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else
                                    echo' <br><b>Шофьорска книжка</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['DrivingL_Pic'] ).'" style="height:300px; width:25.0vw;">';
                                 
                                 echo '<div align = "center">';
                                    echo '<br><input id = "img9" type="file" name="img9" style = "">';
                                 echo '</div>';
                                 
                            echo "</td>";
                           echo "</tr>";
                      echo "</table>";
                      echo '<br>';
                      echo "<br><br>";
                      echo '<input id = "update" type="submit" name="btnUpdatePdf" style = "" value = "Редакция">';
                      echo '</form>';
                      echo "<br><br>";
                }
                
    		}
    	}
//	  }
	  mysqli_close($con);
	  //unset($_SESSION['holdingFirmAutoRegNumber']);
	}
	
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnUpdatePdf) {
	
      $con = connectServer();
      
        //if(isset($_POST['pdf']))
        if($_FILES['pdf']['size'] > 0)
        {    
            $file = addslashes(file_get_contents($_FILES["pdf"]["tmp_name"]));
            
            $sqlUpdateDocs = "UPDATE documents SET
            Pdf_File = '$file' 
            Where Reg_Number = '$_POST[rNumber]'";
        
            $update = mysqli_query($con, $sqlUpdateDocs);
            
            if ($update && mysqli_affected_rows($con) == 0) {
             
   	         $message = "Няма промяна на данни!";
   	         echo "<script>alert('$message');</script>";
   	         echo "<script>location.assign('holdingFirmUpdateAutoDocs.php');</script>";
            } 
            else if ($update && mysqli_affected_rows($con) == 1) {
                
                
   	            $message = "Данните са актуализирани успешно!";
   	            echo "<script>alert('$message');</script>";
   	            
   	            echo "<br>";
                echo '<span style="font-size: 25px; color:black;">Документи на МПС с регистрационен номер ' . '<b>' . $_POST['rNumber'] . '</b>' . '</span>';
                echo "<br><br>";
                
                $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM documents WHERE Reg_Number = '$_POST[rNumber]'");
                if($row = mysqli_fetch_array($sqlShowUpdatedData))
                {
   	               echo '  
                      <tr>  
                           <td>  
                                
                                <iframe src="data:application/pdf;base64,'.base64_encode($row['Pdf_File']).'" type="application/pdf" style="height:400px;width:50%"></iframe>
                           </td>  
                      </tr>  
                                ';
                   echo "<br><br><br>";
                           
                }
            }
            else {  
             
   	         $message = "Възникна грешка, опитайте отново!"; 
             echo "<script>alert('$message');</script>";
             echo "<script>location.assign('holdingFirmUpdateAutoDocs.php');</script>";
            }
        
	    }
	    else
	    {
	            //if(empty($_POST['img11']))
	            $isUpdate = false;
	            
	            $boolZeroData=array(); $boolOneData=array();
	            
	            $zero1 = false; $one1 = false; $zero2 = false; $one2 = false; $zero3 = false; $one3 = false; $zero4 = false; $one4 = false;
	            $zero5 = false; $one5 = false; $zero6 = false; $one6 = false; $zero7 = false; $one7 = false; $zero8 = false; $one8 = false;
	            $zero9 = false; $one9 = false;
	            
	            mysqli_autocommit($con, FALSE);
                mysqli_query($con,"START TRANSACTION");
	            
	            if($_FILES['img1']['size'] > 0)
	            {
                    
	                $file1 = addslashes(file_get_contents($_FILES["img1"]["tmp_name"]));
                    $path1 = $_FILES["img1"]["name"];
                    $ext1 = pathinfo($path1, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs1 = "UPDATE documents SET
                    Go_Pic = '$file1', Go_Ext = '$ext1'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update1 = mysqli_query($con, $sqlUpdateDocs1);
                    if ($update1 && mysqli_affected_rows($con) == 0)
                    {
                        $zero1 = true;
                        $boolZeroData[] = $zero1;
                    }
                    if ($update1 && mysqli_affected_rows($con) == 1)
                    {
                        $one1 = true;
                        $boolOneData[] = $one1;
                    }
	            } 
	            
	            if($_FILES['img2']['size'] > 0)
	            {
                    
	                $file2 = addslashes(file_get_contents($_FILES["img2"]["tmp_name"]));
                    $path2 = $_FILES["img2"]["name"];
                    $ext2 = pathinfo($path2, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs2 = "UPDATE documents SET
                    Kasko_Pic = '$file2', Kasko_Ext = '$ext2'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update2 = mysqli_query($con, $sqlUpdateDocs2);
                    if ($update2 && mysqli_affected_rows($con) == 0)
                    {
                        $zero2 = true;
                        $boolZeroData[] = $zero2;
                    }
                    if ($update2 && mysqli_affected_rows($con) == 1)
                    {
                        $one2 = true;
                        $boolOneData[] = $one2;
                    }
	            }
	            
	            if($_FILES['img3']['size'] > 0)
	            {
                    
	                $file3 = addslashes(file_get_contents($_FILES["img3"]["tmp_name"]));
                    $path3 = $_FILES["img3"]["name"];
                    $ext3 = pathinfo($path3, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs3 = "UPDATE documents SET
                    Vinetka_Pic = '$file3', Vinetka_Ext = '$ext3'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update3 = mysqli_query($con, $sqlUpdateDocs3);
                    if ($update3 && mysqli_affected_rows($con) == 0)
                    {
                        $zero3 = true;
                        $boolZeroData[] = $zero3;
                    }
                    if ($update3 && mysqli_affected_rows($con) == 1)
                    {
                        $one3 = true;
                        $boolOneData[] = $one3;
                    }
	            }
	            
	            if($_FILES['img4']['size'] > 0)
	            {
                    
	                $file4 = addslashes(file_get_contents($_FILES["img4"]["tmp_name"]));
                    $path4 = $_FILES["img4"]["name"];
                    $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs4 = "UPDATE documents SET
                    GTP_Pic = '$file4', GTP_Ext = '$ext4'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update4 = mysqli_query($con, $sqlUpdateDocs4);
                    if ($update4 && mysqli_affected_rows($con) == 0)
                    {
                        $zero4 = true;
                        $boolZeroData[] = $zero4;
                    }
                    if ($update4 && mysqli_affected_rows($con) == 1)
                    {
                        $one4 = true;
                        $boolOneData[] = $one4;
                    }
	            }
	            
	            if($_FILES['img5']['size'] > 0)
	            {
                    
	                $file5 = addslashes(file_get_contents($_FILES["img5"]["tmp_name"]));
                    $path5 = $_FILES["img5"]["name"];
                    $ext5 = pathinfo($path5, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs5 = "UPDATE documents SET
                    Tax_Pic = '$file5', Tax_Ext = '$ext5'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update5 = mysqli_query($con, $sqlUpdateDocs5);
                    if ($update5 && mysqli_affected_rows($con) == 0)
                    {
                        $zero5 = true;
                        $boolZeroData[] = $zero5;
                    }
                    if ($update5 && mysqli_affected_rows($con) == 1)
                    {
                        $one5 = true;
                        $boolOneData[] = $one5;
                    }
	            }
	            
	            if($_FILES['img6']['size'] > 0)
	            {
                    
	                $file6 = addslashes(file_get_contents($_FILES["img6"]["tmp_name"]));
                    $path6 = $_FILES["img6"]["name"];
                    $ext6 = pathinfo($path6, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs6 = "UPDATE documents SET
                    Tyres_Pic = '$file6', Tyres_Ext = '$ext6'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update6 = mysqli_query($con, $sqlUpdateDocs6);
                    if ($update6 && mysqli_affected_rows($con) == 0)
                    {
                        $zero6 = true;
                        $boolZeroData[] = $zero6;
                    }
                    if ($update6 && mysqli_affected_rows($con) == 1)
                    {
                        $one6 = true;
                        $boolOneData[] = $one6;
                    }
	            }
	            
	            if($_FILES['img7']['size'] > 0)
	            {
                    
	                $file7 = addslashes(file_get_contents($_FILES["img7"]["tmp_name"]));
                    $path7 = $_FILES["img7"]["name"];
                    $ext7 = pathinfo($path7, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs7 = "UPDATE documents SET
                    Talon_Pic = '$file7', Talon_Ext = '$ext7'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update7 = mysqli_query($con, $sqlUpdateDocs7);
                    if ($update7 && mysqli_affected_rows($con) == 0)
                    {
                        $zero7 = true;
                        $boolZeroData[] = $zero7;
                    }
                    if ($update7 && mysqli_affected_rows($con) == 1)
                    {
                        $one7 = true;
                        $boolOneData[] = $one7;
                    }
	            }
	            
	            if($_FILES['img8']['size'] > 0)
	            {
                    
	                $file8 = addslashes(file_get_contents($_FILES["img8"]["tmp_name"]));
                    $path8 = $_FILES["img8"]["name"];
                    $ext8 = pathinfo($path8, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs8 = "UPDATE documents SET
                    ServiceBook_Pic = '$file8', ServiceBook_Ext = '$ext8'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update8 = mysqli_query($con, $sqlUpdateDocs8);
                    if ($update8 && mysqli_affected_rows($con) == 0)
                    {
                        $zero8 = true;
                        $boolZeroData[] = $zero8;
                    }
                    if ($update8 && mysqli_affected_rows($con) == 1)
                    {
                        $one8 = true;
                        $boolOneData[] = $one8;
                    }
	            }
	            
	            if($_FILES['img9']['size'] > 0)
	            {
                    
	                $file9 = addslashes(file_get_contents($_FILES["img9"]["tmp_name"]));
                    $path9 = $_FILES["img9"]["name"];
                    $ext9 = pathinfo($path9, PATHINFO_EXTENSION);
        
                    $sqlUpdateDocs9 = "UPDATE documents SET
                    DrivingL_Pic = '$file9', DrivingL_Ext = '$ext9'
                    Where Reg_Number = '$_POST[rNumber]'";
                
                    $update9 = mysqli_query($con, $sqlUpdateDocs9);
                    if ($update9 && mysqli_affected_rows($con) == 0)
                    {
                        $zero9 = true;
                        $boolZeroData[] = $zero9;
                    }
                    if ($update9 && mysqli_affected_rows($con) == 1)
                    {
                        $one9 = true;
                        $boolOneData[] = $one9;
                    }
	            }
	            
	            $counterZero = 0; $counterOne = 0;
	            
	            for($i = 0; $i < count($boolZeroData); $i++)
	            {
	                    
	                if($boolZeroData[$i] == true)
	                    $counterZero++;
	                
	            }
	            
	            for($i = 0; $i < count($boolOneData); $i++)
	            {
	                    
	                if($boolOneData[$i] == true)
	                    $counterOne++;
	               
	            }
	            if($counterZero == count($boolZeroData) && count($boolOneData) == 0)
	            {
	                mysqli_commit($con);
                    $message = "Няма промяна на данни!";
                    echo "<script>alert('$message');</script>";
                    echo "<script>location.assign('holdingFirmUpdateAutoDocs.php');</script>";
	            }
	            else if($counterOne == count($boolOneData))
	            {
	                mysqli_commit($con);
                    $message = "Данните са актуализирани успешно!";
                    echo "<script>alert('$message');</script>";
                    $isUpdate = true;
	            }
	            else {
          
                    mysqli_rollback($con);
                    $message = "Възникна грешка, опитайте отново!";
                    echo "<script>alert('$message');</script>";
                    echo "<script>location.assign('holdingFirmUpdateAutoDocs.php');</script>";
	            
                }
                
                if($isUpdate)
                {
                    echo "<br>";
                    echo '<span style="font-size: 25px; color:black;">Документи на МПС с регистрационен номер ' . '<b>' . $_POST['rNumber'] . '</b>' . '</span>';
                    echo "<br><br>";
                    $sqlShowUpdatedData = mysqli_query($con, "SELECT * FROM documents WHERE Reg_Number = '$_POST[rNumber]'");
                    while($row = mysqli_fetch_array($sqlShowUpdatedData))
                    {
                        echo "<table class = 'docPics' style = 'width: 100%;'>";  
                        echo "<tr>";  
                            echo "<td>";  
                                 
                                 if(strcmp($row['Go_Ext'], 'pdf') == 0)
                                    echo' <b>ГО</b><br><iframe src="data:application/pdf;base64,'.base64_encode($row['Go_Pic']).'" type="application/pdf" style="height:300px; width:25.0vw;"></iframe>';   
                                 else 
                                    echo' <b>ГО</b><br><img src="data:image/jpeg;base64,'.base64_encode($row['Go_Pic'] ).'" style="height:300px; width:25.0vw;"><br>';
                                 
                                  
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
                      echo "<br><br>";
                    }
                }
                
        mysqli_query($con, "SET AUTOCOMMIT=TRUE");    
	        
	    }
          
      mysqli_close($con);
	}
	
 	
	
?>	

 
</div>


<?php
//unset($_SESSION['Reg_Number']);
?>



<script>

$(document).ready(function(){  
        $('#update').click(function(){
           
           
            if(document.getElementById("pdf") != null)
            {    
                var pdf_name = $('#pdf').val();
                var extension0 = $('#pdf').val().split('.').pop().toLowerCase();
                    
                if(pdf_name != '')
                {
                    
                    if(jQuery.inArray(extension0, ['pdf']) == -1)  
                         {  
                              alert('Невалиден тип на файл!');  
                              $('#pdf').val('');  
                              return false;  
                         }
                     
                }
                else
                {
                    alert('Моля изберете файл!');  
                 
                    return false;
                }
                
            }
            else
            {
                
                var img1_name = $('#img1').val();
                var img2_name = $('#img2').val();
                var img3_name = $('#img3').val();
                var img4_name = $('#img4').val();
                var img5_name = $('#img5').val();
                var img6_name = $('#img6').val();
                var img7_name = $('#img7').val();
                var img8_name = $('#img8').val();
                var img9_name = $('#img9').val();
                 
                var extension1 = $('#img1').val().split('.').pop().toLowerCase();
                var extension2 = $('#img2').val().split('.').pop().toLowerCase();
                var extension3 = $('#img3').val().split('.').pop().toLowerCase();
                var extension4 = $('#img4').val().split('.').pop().toLowerCase();
                var extension5 = $('#img5').val().split('.').pop().toLowerCase();
                var extension6 = $('#img6').val().split('.').pop().toLowerCase();
                var extension7 = $('#img7').val().split('.').pop().toLowerCase();
                var extension8 = $('#img8').val().split('.').pop().toLowerCase();
                var extension9 = $('#img9').val().split('.').pop().toLowerCase();
                
                if(img1_name != '' || img2_name != '' || img3_name != '' || img4_name != '' ||
                   img5_name != '' || img6_name != '' || img7_name != '' || img8_name != '' || img9_name != '')
                {
                    
                    if(jQuery.inArray(extension1, ['png','jpg','jpeg', 'pdf']) == -1 && img1_name != '')  
                         {  
                              alert('Невалиден тип на файл за ГО!');  
                              $('#img1').val('');  
                              return false;  
                         }
                    else if(jQuery.inArray(extension2, ['png','jpg','jpeg', 'pdf']) == -1 && img2_name != '')  
                    {  
                         alert('Невалиден тип на файл за Каско!');  
                         $('#img2').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension3, ['png','jpg','jpeg', 'pdf']) == -1 && img3_name != '')  
                    {  
                         alert('Невалиден тип на файл за Винетка!');  
                         $('#img3').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension4, ['png','jpg','jpeg', 'pdf']) == -1 && img4_name != '')  
                    {  
                         alert('Невалиден тип на файл за ГТП!');  
                         $('#img4').val('');  
                         return false;  
                    }
                    else if(jQuery.inArray(extension5, ['png','jpg','jpeg', 'pdf']) == -1 && img5_name != '')  
                    {  
                         alert('Невалиден тип на файл за Данък!');  
                         $('#img5').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension6, ['png','jpg','jpeg', 'pdf']) == -1 && img6_name != '')  
                    {  
                         alert('Невалиден тип на файл за Гуми!');  
                         $('#img6').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension7, ['png','jpg','jpeg', 'pdf']) == -1 && img7_name != '')  
                    {  
                         alert('Невалиден тип на файл за Малък талон!');  
                         $('#img7').val('');  
                         return false;  
                    }
                    else if(jQuery.inArray(extension8, ['png','jpg','jpeg', 'pdf']) == -1 && img8_name != '')  
                    {  
                         alert('Невалиден тип на файл за Сервизна книжка!');  
                         $('#img8').val('');  
                         return false;  
                    }
                    
                    else if(jQuery.inArray(extension9, ['png','jpg','jpeg', 'pdf']) == -1 && img9_name != '')  
                    {  
                         alert('Невалиден тип на файл за Шофьорска книжка!');  
                         $('#img9').val('');  
                         return false;  
                    }
                         
                    
                }
                else
                {
                    alert('Моля изберете файл!');  
                 
                    return false;
                }
            }
            
                
           

    });  
});

document.forms[1].addEventListener('submit', function( evt ) {
    
    if(document.getElementById("pdf") != null)
    {
        var file0 = document.getElementById('pdf').files[0];
        
        
        if(file0 && file0.size > 1048576) {                         // 1 MB (this size is in bytes 1048576)
            evt.preventDefault();
            alert("PDF файла е прекалено голям!");        
        }
    }
    else
    {
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
    }
}, false);


 
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