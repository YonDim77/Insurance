<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
<!--      <a id = "brandMenu" class="navbar-brand" href="#" style = "color:red;">Буболечкоубийци</a>-->
          <button style = "margin-top: 17px;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id = "brandMenu" class="navbar-brand" href="#"><img src="CI.jpg" alt="Insurance" style = "margin-top: -7px; border-radius: 5px;" width="100px" height="50"></a>
    </div>
    
    
    <div class="collapse navbar-collapse" id="myNavbar">
        
        
    <ul class="nav navbar-nav">
      <li id = "listHome"><a href="homeMainAdmin.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-home">Начало</i></a></li>
	  
      <li id = "listServices" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Администрация<span class="caret"></span></a>
	    <ul class="dropdown-menu">
<!--	      <li id = "sprayer" style = "background-color: white; color: white; margin-top:0px;">AAAA<img src="Sprayer.jpg" alt="BugKillers" width="60" height="50" style = "border-radius: 5px;"></li>-->
          <li class="dropdown dropdown-submenu"><a href = "#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на физическо лице</a>
            
            <ul class="dropdown-menu">
                <li><a href="mainAdminInputDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на физическо лице и МПС</a></li>
                <li><a href="mainAdminInputDataServiceAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за застраховки и сервиз на МПС на физическо лице</a></li>
                <li><a href="mainAdminInputDataRepairAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за ремонти и гуми на МПС на физическо лице</a></li>
                <li><a href="mainAdminPersonAutoUploadDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на документи на МПС на физическо лице</a></li>
            </ul>
            
          </li>
          <li><hr style = "margin: 0px;"></li>
          <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на юридическо лице</a>
            <ul class="dropdown-menu">
                <li><a href="mainAdminInputDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на юридическо лице и МПС</a></li>
                <li><a href="mainAdminInputDataAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за застраховки и сервиз на МПС на  юридическо лице</a></li>
                <li><a href="mainAdminInputDataRepairAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за ремонти и гуми на МПС на  юридическо лице</a></li>
                <li><a href="mainAdminFirmAutoUploadDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на документи на МПС на юридическо лице</a></li>
            </ul> 
          </li>
          <li><hr style = "margin: 0px;"></li>
          <li><a href="mainAdminHoldingReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на холдинг и потребители</a></li>
          <li><a href="mainAdminAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на подаминистратор &nbsp; &nbsp;</a></li>
		  <li><a href="mainAdminSubAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на потребител</a></li>
		  <li><a href="mainAdminConsultantReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на консултант</a></li>
		  <li><a href="inputTariffPlanData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на тарифни планове</a></li>
		  <li><a href="inputDiscountData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на отстъпки</a></li>
		  
	    </ul>
      </li>
	  
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Клиенти<span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране на данни</a>
		    <ul class="dropdown-menu">      
		        <li><a href="mainAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на физическо лице и МПС</a></li>
		        <li><a href="mainAdminShowDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на юридическо лице и МПС</a></li>
		        <li><a href="mainAdminShowHoldingFirms.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на фирми към холдинг</a></li>
		        <li><a href="mainAdminShowDataHoldingUser.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на потребител към холдинг</a></li>
		        <li><a href="mainAdminShowAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на подаминистратор</a></li>
                <li><a href="mainAdminShowSubAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на потребител</a></li>		  
		    </ul>
		  </li>
		  
		  <li><hr style = "margin: 0px;"></li>
		  <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране на данни</a>
		    <ul class="dropdown-menu">      
		        <li><a href="mainAdminUpdateDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на физическо лице</a></li>
		        <li><a href="mainAdminUpdateDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на юридическо лице</a></li>
		        <li><a href="mainAdminUpdateHoldingName.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране име на холдинг</a></li>
		        <li><a href="mainAdminUpdateDataHoldingUser.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на потребител към холдинг</a></li>
		        <li><a href="mainAdminUpdateDataAdmin.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на подадминистратор</a></li>
		        <li><a href="mainAdminUpdateDataSubAdmin.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на потребител</a></li>
		        <li><a href="mainAdminUpdateDataAuto.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на МПС</a></li>
		        <li><a href="mainAdminUpdatePersonAutoDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране документи на МПС на физическо лице</a></li>
		        <li><a href="mainAdminUpdateFirmAutoDocs.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране документи на МПС на юридическо лице</a></li>
		    </ul>
		  </li>
		  <li><hr style = "margin: 0px;"></li>
		  <li><a href="mainAdminExportAdminSubAdminPersonData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Експорт на данни на ф. лице за даден подадминистратор/потребител</a></li>
		  <li><a href="mainAdminExportAdminSubAdminFirmData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Експорт на данни на ю. лице за даден подадминистратор/потребител</a></li>
   
	    </ul>  
	  </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Прехвърляне<span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li><a href="mainAdminUpdateDataAdminSubAdminPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на ф. лице от един подадминистратор/потребител към друг</a></li>
		    <li><a href="mainAdminUpdateDataAdminSubAdminFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на ю. лице от един подадминистратор/потребител към друг</a></li>
		    <li><a href="mainAdminTransferHoldingToAdminSubAdmin.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на холдинг от един подадминистратор/потребител към друг</a></li>
		    <li><a href="transferFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на фирма от холдинг в холдинг</a></li>
		    <li><a href="transferAuto.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на МПС</a></li>
		    <li><a href="unsubscribedAutos.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Отписани МПС</a></li>   
	    </ul>
	  </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Справки<span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li><a href="checkForNoDataAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Проверки за ф. лица без данни за МПС</a></li>
	        <li><a href="checkForNoDataAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Проверки за ю. лица без данни за МПС</a></li>
            <li><a href="mainAdminCheckUp.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Справки по критерий</a></li>
        </ul>
      </li>
      <li><a href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Запитвания</a></li>
      <li><a href="billing.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">Билинг</a></li>
      <li><a href="history.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''">История</a></li>
      
      <li class="dropdown"><a style = "color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class="fa fa-user-o">&nbsp;<?php echo  $_SESSION['mainAdminfName']. " " . $_SESSION['mainAdminlName']; ?></i><span class="caret"></span></a>
	    <ul class="dropdown-menu">
	        <li><a href="mainAdminProfile.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Профил</a></li>
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