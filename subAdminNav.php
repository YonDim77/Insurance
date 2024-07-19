<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['subAdminUsername'])) {
header('Location: index.php');
}

?>

<html>
<head>
    
<style>
    
@media (max-width: 768px) {
     #uList {
         width: 100%;
   }

 } 
 
 @media (min-width: 768px) {
     #uList {
       width: 300px;
   }
 } 
    
</style>
    
    
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
<!--      <a id = "brandMenu" class="navbar-brand" href="#" style = "color:red;">Буболечкоубийци</a>-->
          <button style = "margin-top: 17px;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="BugK.png" alt="Insurance" width="100px" height="20"></a>
    </div>
    
    
    <div class="collapse navbar-collapse" id="myNavbar">
        
        
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeMainAdmin.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
      <li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Администрация<span class="caret"></span></a>
	    <ul id = "uList" class="dropdown-menu">
<!--	      <li id = "sprayer" style = "background-color: white; color: white; margin-top:0px;">AAAA<img src="Sprayer.jpg" alt="BugKillers" width="60" height="50" style = "border-radius: 5px;"></li>-->
          <li class="dropdown dropdown-submenu"><a href = "#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на физическо лице</a>
            
            <ul class="dropdown-menu">
                <li><a href="subAdminInputDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на физическо лице и МПС</a></li>
                <li><a href="subAdminInputDataAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за застраховки и сервиз на МПС на физическо лице</a></li>
                <li><a href="subAdminInputDataTyresAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за ремонти и гуми на МПС на физическо лице</a></li>
                <li><a href="subAdminPersonAutoUploadDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на документи на МПС на физическо лице</a></li>

            </ul>
            
          </li>
          <li><hr style = "margin: 0px;"></li>
          <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на юридическо лице</a>
            <ul class="dropdown-menu">
                <li><a href="subAdminInputDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на юридическо лице и МПС</a></li>
                <li><a href="subAdminInputDataAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за застраховки и сервиз на МПС на  юридическо лице</a></li>
                <li><a href="subAdminInputDataTyresAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за ремонти и гуми на МПС на  юридическо лице</a></li>
                <li><a href="subAdminFirmAutoUploadDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на документи на МПС на юридическо лице</a></li>
            </ul> 
          </li>
		  <li><a href="subAdminHoldingReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на холдинг и потребители</a></li>
	    </ul>
      </li>
	  
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Клиенти<span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране на данни</a>
		    <ul class="dropdown-menu">      
		        <li><a href="subAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на физическо лице и МПС</a></li>
		        <li><a href="subAdminShowDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на юридическо лице и МПС</a></li>
		        <li><a href="subAdminShowHoldingFirms.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на фирми към холдинг</a></li>
                <li><a href="subAdminShowDataHoldingUser.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на потребител към холдинг</a></li>		  
		    </ul>
		  </li>
		  
		  <li><hr style = "margin: 0px;"></li>
		  <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране на данни</a>
		    <ul class="dropdown-menu">      
		        <li><a href="subAdminUpdateDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на физическо лице</a></li>
		        <li><a href="subAdminUpdateDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на юридическо лице</a></li>
		        <li><a href="subAdminUpdateHoldingName.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране име на холдинг</a></li>
		        <li><a href="subAdminUpdateDataHoldingUser.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на потребител към холдинг</a></li>
		        <!--<li><a href="subAdminUpdateDataSubAdmin.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на потребител</a></li>-->
		        <li><a href="subAdminUpdateDataAuto.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на МПС</a></li>
		        <li><a href="subAdminUpdatePersonAutoDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране документи на МПС на физическо лице</a></li>
		        <li><a href="subAdminUpdateFirmAutoDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране документи на МПС на юридическо лице</a></li>
		    </ul>
		  </li>
		  <li><hr style = "margin: 0px;"></li>
		  <li><a href="subAdminExportPersonData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Експорт на данни на физическо лице</a></li>
		  <li><a href="subAdminExportFirmData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Експорт на данни на юридическо лице</a></li>
   
	    </ul>  
	  </li>
	  <!--<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Прехвърляне<span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li><a href="mainAdminUpdateDataAdminSubAdminPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на ф. лице от един подадминистратор/потребител към друг</a></li>
		    <li><a href="mainAdminUpdateDataAdminSubAdminFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на ю. лице от един подадминистратор/потребител към друг</a></li>
		    <li><a href="transferAuto.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на МПС</a></li>
		    <li><a href="unsubscribedAutos.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Отписани МПС</a></li>   
	    </ul>
	  </li>-->
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Справки<span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li><a href="subAdminCheckForNoDataAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Проверки за ф. лица без данни за МПС</a></li>
	        <li><a href="subAdminCheckForNoDataAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Проверки за ю. лица без данни за МПС</a></li>
            <li><a href="subAdminCheckUp.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Справки по критерий</a></li>
        </ul>
      </li>
      <li><a href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Запитвания</a></li>
      <!--<li><a href="billing.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Билинг</a></li>
      <li><a href="history.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">История</a></li>-->
      
      <li class="dropdown"><a style = "color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-user-o">&nbsp;<?php echo  $_SESSION['subAdminfName']. " " . $_SESSION['subAdminlName']; ?></i><span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li><a href="subAdminProfile.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Профил</a></li>
	        <li><a href="help.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Помощ</a></li>
	        <!--<li><a href="history.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Смяна на парола</a></li>-->
	        <li><a href="logout.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Изход</a></li>
	    </ul>
	  </li>
	  	
	</ul>
	
	
	</div>
	
	
  </div>
</nav>

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

</script>

</body>
</html>