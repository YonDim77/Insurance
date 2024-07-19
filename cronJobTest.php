<?php

// Inialize session
//session_start();
// Check, if username session is NOT set then this page will jump to login page
//if (!isset($_SESSION['mainAdminUsername'])) {
//header('Location: index.php');
//}

include 'functions.php';

?>

<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="adminCss.css">-->

<style>

      

</style>

</head>
<body>



<?php

$gtpDate = "GTP_Date";
$goDate = "GO_Date";
$kaskoDate = "Kasko_Date";
$vinetkaDate = "Vinetka_Date";
$oilsFiltersToDate = "After_Date";



//$btnSend = false;
//if(isset($_POST['button' . $index . ''])) {
//   $btnSend = true; 
//}

//if ($_SERVER["REQUEST_METHOD"] == "POST" && ($btnCheckUp == true || $btnSend == true)) {
//if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST["CheckUp"]) > 0) {

$con = connectServer();


date_default_timezone_set('Bulgaria/Sofia');
$currentDate = date('Y-m-d', time());
$toDate=Date('y:m:d', strtotime("+14 days")); // <-- 14 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//date_add($toDate,date_interval_create_from_date_string("14 days"));


$fromDateService = $fromDate = $currentDate;
$toDateService = $toDate;

$resultGtp = "SELECT * FROM insurance WHERE GTP_Date >= '$fromDate' AND GTP_Date <= '$toDate'";
                           

$resultService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND After_Date >= '$fromDate' AND After_Date <= '$toDate'";


$afterKmService = "SELECT service.* FROM service
				   LEFT JOIN autos ON (service.AutosID = autos.AutosID)
				   WHERE service.Type = 'масла и филтри'
				   AND service.After_Km <= autos.Current_Km";
				   

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

//$dateB=date_create($fromDate);
//$dateE=date_create($fromDate);
//date_add($dateE,date_interval_create_from_date_string("14 days"));
//
//date_format($dateB,"d/m/Y");
//date_format($dateE,"d/m/Y");

echo "<div align = 'center'>";

//$sqlResult = "";
   
    $resultDataGtp = mysqli_query($con, $resultGtp);
    //$sqlResult = $resultData;
    
$contactPerson = "";
$regNumberValue = "";
$gtpDateValue = "";


    if(mysqli_num_rows($resultDataGtp) > 0) {
			
        while($row = mysqli_fetch_array($resultDataGtp))
        {
			$gtpDate=date_create($row['GTP_Date']);
		    $gtpDateValue = date_format($gtpDate,"d/m/Y");
			$regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");
			if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                $regNumberValue = $rowRegNumber['Reg_Number'];                         
			}
			
			if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
            {
                $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                
                if (mysqli_num_rows($resultPerson) > 0)
                {
                 
                    while($row1 = mysqli_fetch_array($resultPerson))
                    {                     
                        $contactPerson = $row1['Contact_Person']; 
                        
                        $emailContactPerson = $row1['Email_Contact_Person'];                                         
                    }
                    
                    $subject = "Напомняне за изтичащ Годишен технически преглед";

                    $comment = "Здравейте " . $contactPerson . ",
                    
                    Напомняме Ви, че срокът на годишния технически преглед на автомобил " . $regNumberValue . " изтича. Молим за вашето внимание, за да организираме преминаването му преди " . $gtpDateValue . " . 
                    Екипът ни Ви напомня, че необходимите Ви документи са:
                    
                        - Голям и малък регистрационен талон;
                        - Квитанция за платен данък;
                        - Валидна гражданска отговорност;
                        - Шофьорска книжка;
                        - Талон от предишния ви преглед.
                        
                    Автомобилът трябва да е в добро техническо и външно състояние.
                    Ние можем да организираме всичко това вместо Вас. За целта следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                    
                    Благодарим Ви, че сте наш лоялен клиент!
                    
                    
                    Поздрави,
                    Екипът на CarLife";
                    
					mb_internal_encoding('UTF-8');
					$encoded_subject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n", strlen('Subject: '));
					$noReplyEmail = "email@stepsoft.org"; //"no-reply@carlife.bg";
					$noReplyEmailPassword = "StepSoft@77";  //"BioMio2020";
					mail($emailContactPerson, $encoded_subject, $comment, "MIME-Version: 1.0" . "\r\n" . "Content-type: text/plain; charset=UTF-8" . "\r\n". "From:" . $noReplyEmail, $noReplyEmailPassword);
                 
                }
				
            }
			else
                {
                    $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                    if (mysqli_num_rows($resultFirm) > 0)
                    {
                 
                        while($row2 = mysqli_fetch_array($resultFirm))
                        {                          
                            $contactPerson = $row2['Contact_Person'];
                            $emailContactPerson = $row2['Email_Contact_Person'];
                        }
                        
                        $subject = "Напомняне за изтичащ Годишен технически преглед";

                        $comment = "Здравейте " . $contactPerson . ",
                        
                        Напомняме Ви, че срокът на годишния технически преглед на автомобил " . $regNumberValue . " изтича. Молим за вашето внимание, за да организираме преминаването му преди " . $gtpDateValue . " . 
                        Екипът ни Ви напомня, че необходимите Ви документи са:
                        
                            - Голям и малък регистрационен талон;
                            - Квитанция за платен данък;
                            - Валидна гражданска отговорност;
                            - Шофьорска книжка;
                            - Талон от предишния ви преглед.
                            
                        Автомобилът трябва да е в добро техническо и външно състояние.
                        Ние можем да организираме всичко това вместо Вас. За целта следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                        
                        Благодарим Ви, че сте наш лоялен клиент!
                        
                        
                        Поздрави,
                        Екипът на CarLife";
                        
						mb_internal_encoding('UTF-8');
						$encoded_subject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n", strlen('Subject: '));
						$noReplyEmail = "email@stepsoft.org"; //"no-reply@carlife.bg";
						$noReplyEmailPassword = "StepSoft@77";  //"BioMio2020";
						mail($emailContactPerson, $encoded_subject, $comment, "MIME-Version: 1.0" . "\r\n" . "Content-type: text/plain; charset=UTF-8" . "\r\n". "From:" . $noReplyEmail, $noReplyEmailPassword);
						                
                    }
                }
			
		}
        
    }

    
    //$resultDataService = mysqli_query($con, $resultService);
    //$sqlResultKm = mysqli_query($con, $afterKmService);
    //$sqlResult = $resultDataService;
    //        
    //
    //if(mysqli_num_rows($sqlResult) > 0) {
    //    
    //    
    //    
    //}





?>



</body>
</html>