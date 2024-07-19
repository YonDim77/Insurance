<?php

// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['mainAdminUsername'])) {
header('Location: index.php');
}

include 'functions.php';

?>

<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script>//sessionStorage.setItem("scroll", "0");
        //sessionStorage.getItem("y") = 0;
//		sessionStorage.setItem("counter", "0"); 
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="adminCss.css">

<style>



@media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
}

body{
margin: 0;
padding: 0;
font-family: sans-serif;
background: #f2e6ff;
}

.menu {
  width: 150px;
  z-index: 1;
  box-shadow: 0 4px 5px 3px rgba(0, 0, 0, 0.2);
  position: fixed;
  display: none;
  transition: 0.2s display ease-in;
  background-color: white;
}
.menu .menu-options {
  list-style: none;
  padding: 10px 0;
  z-index: 1;
}
.menu .menu-options .menu-option {
  font-weight: 500;
  z-index: 1;
  font-size: 14px;
  padding: 5px 20px 5px 20px;
  cursor: pointer;
}
.menu .menu-options .menu-option:hover {
  background: rgba(0, 0, 0, 0.2);
  
}

a:link {
    background-color: transparent; 
    text-decoration: none;
}

.dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
    top:0;
    left:100%;
    margin-top:-6px;
    margin-left:-1px;
    -webkit-border-radius:0 6px 6px 6px;
    -moz-border-radius:0 6px 6px 6px;
    border-radius:0 6px 6px 6px;
}
.dropdown-submenu>a:after {
    display:block;
    content:" ";
    float:right;
    width:0;
    height:0;
    border-color:transparent;
    border-style:solid;
    border-width:5px 0 5px 5px;
    border-left-color:#cccccc;
    margin-top:5px;
    margin-right:var(--my-margin-var);
}
.dropdown-submenu:hover>a:after {
    border-left-color:#555;
}
.dropdown-submenu.pull-left {
    float:none;
}
.dropdown-submenu.pull-left>.dropdown-menu {
    left:-100%;
    margin-left:10px;
    -webkit-border-radius:6px 0 6px 6px;
    -moz-border-radius:6px 0 6px 6px;
    border-radius:6px 0 6px 6px;
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

@media screen and (min-width: 1351px) {
    .navbar-inverse {
        margin-top:0px; height: 70px; position: fixed; width: 100%;
    }
    ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;    
    }
}

table {
    width: 140%;
}

table, th, td {
    color: black;
    text-align: center;
    border: 1px solid black;
}

tr:hover {background-color:#ccffcc;}

@media (min-width: 768px) and (max-width: 1350px) {
    
    .navbar-header {
          float: none;
          
      }
      .navbar-toggle {
          display: block;
          margin-bottom: 17px;
          
      }
      
      .navbar-collapse {
          border-top: 1px solid transparent;
          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
          
      }
      .navbar-collapse.collapse {
          display: none!important;
      }
      .navbar-collapse.collapse.in {
          display: block!important;
          
      }
      .navbar-nav {
          float: none!important;
          margin: 7.5px -30px;
          
      }
      .navbar-nav>li {
          float: none;
          
      }
      .navbar-nav>li>a {
          padding-top: 10px;
          padding-bottom: 10px;
          
      }
      /*ul.nav a:hover { color: red !important; }*/
 
}     
      @media (max-width: 768px) {
          .navbar-nav {
            float: none!important;
            margin: 7.5px -20px;
          
        }
      }

.tooltips {
  position: relative;
  display: inline-block;
}

.tooltips .tooltiptext {
  visibility: hidden;
  white-space: nowrap;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 7px;

  /* Position the tooltip */
  position: absolute;
  display: block;
  z-index: 1;
  top: 0px;
  right: 105%;
}

.tooltips .tooltiptext::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 100%;
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent transparent black;
}

.tooltips:hover .tooltiptext {
  visibility: visible;
}

      

</style>

</head>
<body>

<div class="menu">
  <ul class="menu-options">
    <li class="menu-option" style = "margin-top: -10px;"><a href="homeMainAdmin.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Начало</a></li>
    <li class="dropdown dropdown-submenu" onMouseOver="this.style.backgroundColor='rgba(0, 0, 0, 0.2)'" onMouseOut="this.style.backgroundColor=''"><a href= "#" style = "--my-margin-var: 10px; margin-left: 20px; color: black;" class="dropdown-toggle" data-toggle="dropdown">Администрация</a>
        <ul class="dropdown-menu">    
            <li class="dropdown dropdown-submenu"><a href = "#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на физическо лице</a>
                <ul class="dropdown-menu">
                    <li><a href="mainAdminInputDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на ф. лице и МПС</a></li>
                    <li><a href="mainAdminInputDataServiceAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за застраховки и сервиз на МПС на ф. лице</a></li>
                    <li><a href="mainAdminInputDataRepairAutoPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за ремонти и гуми на МПС на ф. лице</a></li>
                </ul>
            </li>
            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на юридическо лице</a>
                <ul class="dropdown-menu">
                    <li><a href="mainAdminInputDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на ю. лице и МПС</a></li>
                    <li><a href="mainAdminInputDataAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за застраховки и сервиз на МПС на  ю. лице</a></li>
                    <li><a href="mainAdminInputDataRepairAutoFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни за ремонти и гуми на МПС на  ю. лице</a></li>
                </ul> 
            </li>
          <li><a href="mainAdminHoldingReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на холдинг</a></li>
          <li><a href="mainAdminAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на подаминистратор</a></li>
		  <li><a href="mainAdminSubAdminReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на потребител</a></li>
		  <li><a href="mainAdminConsultantReg.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на данни на консултант</a></li>
		  <li><a href="inputTariffPlanData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Запис на тарифни планове</a></li>
		  <li><hr style = "margin: 0px;"></li>
		  
		  <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране на данни</a>
		       <ul class="dropdown-menu">      
		            <li><a href="mainAdminShowDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на физическо лице и МПС</a></li>
		            <li><a href="mainAdminShowDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на юридическо лице и МПС</a></li>
		            <li><a href="mainAdminShowAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на подаминистратор</a></li>
                    <li><a href="mainAdminShowSubAdminData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Визуализиране данни на потребител</a></li>		  
		       </ul>
		  </li>
		  
		  <li><hr style = "margin: 0px;"></li>
		  <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране на данни</a>
		       <ul class="dropdown-menu">      
		            <li><a href="mainAdminUpdateDataPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на физическо лице</a></li>
		            <li><a href="mainAdminUpdateDataFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на юридическо лице</a></li>
		            <li><a href="mainAdminUpdateDataAdmin.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на подадминистратор</a></li>
		            <li><a href="mainAdminUpdateDataSubAdmin.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на потребител</a></li>
		            <li><a href="mainAdminUpdateDataAuto.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Редактиране данни на МПС</a></li>
		       </ul>
		  </li>
		  <li><hr style = "margin: 0px;"></li>
		  <li><a href="mainAdminExportAdminSubAdminPersonData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Експорт на данни на ф. лице за даден подадминистратор/потребител</a></li>
		  <li><a href="mainAdminExportAdminSubAdminFirmData.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Експорт на данни на ю. лице за даден подадминистратор/потребител</a></li>
		  <li><hr style = "margin: 0px;"></li>
		  <li><a href="mainAdminUpdateDataAdminSubAdminPerson.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на ф. лице от един подадминистратор/потребител към друг</a></li>
		  <li><a href="mainAdminUpdateDataAdminSubAdminFirm.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на ю. лице от един подадминистратор/потребител към друг</a></li>
		  <li><a href="transferAuto.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color=''">Прехвърляне на МПС</a></li>
            
        </ul>
    </li>
    
    <li class="menu-option"><a href="mainAdminCheckUp.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Справки</a></li>
    <li class="menu-option"><a href="billing.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">Билинг</a></li>
	<li class="menu-option"><a href="history.php" style = "color: black;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'">История</a></li>
    <li class="menu-option" style = "margin-bottom: -20px;"><a href="logout.php" style = "color: red;" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='red'">Изход</a>
  </ul>
</div>

 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
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
      <!--<li><a href="help.php" onMouseOver="this.style.backgroundColor='black'" onMouseOut="this.style.backgroundColor=''"><i class='fa fa-info-circle' style='font-size:18px;color:white'></i></a></li>-->
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

<?php

$gtpDate = "GTP_Date";
$goDate = "GO_Date";
$kaskoDate = "Kasko_Date";
$vinetkaDate = "Vinetka_Date";
$oilsFiltersToDate = "After_Date";

?>

<script>

function showSubAdmin(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("subAdminValue").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("subAdminValue").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getSubAdmin.php?q="+str, true);
  xhttp.send();
}

</script>

 <br><br><br><br><br>
<div align = "center">

    <form name="input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="UTF-8" style = "color: black; font-size: 14px;">
    	<h4>Справка за следващите 14 дни за изтичащи:</h4><br>
    	<select name="CheckUp"  style = "width:174px; height: 27px;" required="required">*
    	<option value="<?php echo $_POST["CheckUp"]; ?>">Избери</option>
        <option value="<?php echo $gtpDate; ?>">ГТП </option>												
        <option value="<?php echo $goDate; ?>">ГО </option>
        <option value="<?php echo $kaskoDate; ?>">Каско </option>
        <option value="<?php echo $vinetkaDate; ?>">Винетки </option>
        <option value="<?php echo $oilsFiltersToDate; ?>">Масла и филтри</option>
        </select>
        <br><br>
        
    	<select style = "width: 174px; height: 27px;" name="Admin_Username" onchange="showSubAdmin(this.value)">
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
                        mysqli_close($con);
                        
                    ?>
            
        </select>
        <br><br>
        <select id="subAdminValue" style = "width: 174px; height: 27px;" name="Sub_Admin_Username">
            <option value="">Избери потребител</option>
            
        </select>
        <br><br>
        <input type="submit" name="btnCheckUp" value="Направи справка" style = "border-radius: 2px; color: red;">  
    	<br><br>
    <!--</form>-->
<br><br>

</div>

<?php

$btnCheckUp = false;
if(isset($_POST["btnCheckUp"])) {
	$btnCheckUp = true;
}

//$btnSend = false;
//if(isset($_POST['button' . $index . ''])) {
//   $btnSend = true; 
//}

//if ($_SERVER["REQUEST_METHOD"] == "POST" && ($btnCheckUp == true || $btnSend == true)) {
if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST["CheckUp"]) > 0) {

$con = connectServer();

$noData = false;
$usernamesPairCheck = mysqli_query($con, "SELECT * FROM subadmin WHERE Admin_Username = '$_POST[Admin_Username]'
		                                  AND username = '$_POST[Sub_Admin_Username]'");

$usernamesInputError = false;

if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) > 0) {	
    
    if(mysqli_num_rows($usernamesPairCheck) < 1) {
        $usernamesInputError = true;
    	$message = "Грешка! Несъответствие на йерархията подадминистратор потребител!";
       	echo "<script>alert('$message');</script>";
    }
}

date_default_timezone_set('Bulgaria/Sofia');
$currentDate = date('Y-m-d', time());
$toDate=Date('y:m:d', strtotime("+14 days")); // <-- 14 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//date_add($toDate,date_interval_create_from_date_string("14 days"));


$checkUpType = $_POST['CheckUp'];
$fromDateService = $fromDate = $currentDate;
$toDateService = $toDate;

$result = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'";
$resultAdminSubAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                        AND Admin_Username = '$_POST[Admin_Username]' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";
$resultAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                AND Admin_Username = '$_POST[Admin_Username]'";
$resultSubAdmin = "SELECT * FROM insurance WHERE $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                   AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";                            



$resultService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'";
$resultAdminSubAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                              AND Admin_Username = '$_POST[Admin_Username]' AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";
$resultAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                              AND Admin_Username = '$_POST[Admin_Username]'";
$resultSubAdminService = "SELECT * FROM service WHERE Type = 'масла и филтри' AND $checkUpType >= '$fromDate' AND $checkUpType <= '$toDate'
                               AND Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";

$afterKmService = "SELECT service.* FROM service
				   LEFT JOIN autos ON (service.AutosID = autos.AutosID)
				   WHERE service.Type = 'масла и филтри'
				   AND service.After_Km <= autos.Current_Km";
				   
$afterKmAdminSubAdminService = "SELECT service.* FROM service
				                LEFT JOIN autos ON (service.AutosID = autos.AutosID)
				                WHERE service.Type = 'масла и филтри'
				                AND service.After_Km <= autos.Current_Km 				   
                                AND service.Admin_Username = '$_POST[Admin_Username]' AND service.Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";

$afterKmAdminService = "SELECT service.* FROM service
				        LEFT JOIN autos ON (service.AutosID = autos.AutosID)
				        WHERE service.Type = 'масла и филтри'
				        AND service.After_Km <= autos.Current_Km 				   
                        AND service.Admin_Username = '$_POST[Admin_Username]'"; 
                        
$afterKmSubAdminService = "SELECT service.* FROM service
				           LEFT JOIN autos ON (service.AutosID = autos.AutosID)
				           WHERE service.Type = 'масла и филтри'
				           AND service.After_Km <= autos.Current_Km 				   
                           AND service.Sub_Admin_Username = '$_POST[Sub_Admin_Username]'";

$h1 = " ";
$h2 = " ";
if ($h1 == " "){$color="#d8f0f3";}
if ($h2 == " "){$color1="white";}

$dateB=date_create($fromDate);
$dateE=date_create($fromDate);
date_add($dateE,date_interval_create_from_date_string("14 days"));

date_format($dateB,"d/m/Y");
date_format($dateE,"d/m/Y");

echo "<div align = 'center'>";

$sqlResult = "";

if(strcmp($checkUpType, $gtpDate) == 0 || strcmp($checkUpType, $goDate) == 0 || strcmp($checkUpType, $kaskoDate) == 0 || strcmp($checkUpType, $vinetkaDate) == 0) {

    if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultData = mysqli_query($con, $result);
        $sqlResult = $resultData;
    }
        
    else if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultDataAdmin = mysqli_query($con, $resultAdmin);
        $sqlResult = $resultDataAdmin; 
    }
        
    else if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) > 0) { 
        $resultDataSubAdmin = mysqli_query($con, $resultSubAdmin);
        $sqlResult = $resultDataSubAdmin;
    }
    
    else {
        $resultDataAdminSubAdmin = mysqli_query($con, $resultAdminSubAdmin);
        $sqlResult = $resultDataAdminSubAdmin;
    }
    
    if(mysqli_num_rows($sqlResult) < 1 && !$usernamesInputError) {
        
        $noData = true;
        $message = "Няма данни по вашата справка!";
        echo "<script>alert('$message');</script>";
    }

}

if(strcmp($checkUpType, $oilsFiltersToDate) == 0) {

    if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultDataService = mysqli_query($con, $resultService);
        $sqlResultKm = mysqli_query($con, $afterKmService);
        $sqlResult = $resultDataService;
    }
        
    else if(strlen($_POST['Admin_Username'])  > 0 && strlen($_POST['Sub_Admin_Username']) == 0) {
        $resultDataAdminService = mysqli_query($con, $resultAdminService);
        $sqlResultKm = mysqli_query($con, $afterKmAdminService);
        $sqlResult = $resultDataAdminService; 
    }
        
    else if(strlen($_POST['Admin_Username'])  == 0 && strlen($_POST['Sub_Admin_Username']) > 0) { 
        $resultDataSubAdminService = mysqli_query($con, $resultSubAdminService);
        $sqlResultKm = mysqli_query($con, $afterKmSubAdminService);
        $sqlResult = $resultDataSubAdminService;
    }
    
    else {
        $resultDataAdminSubAdminService = mysqli_query($con, $resultAdminSubAdminService);
        $sqlResultKm = mysqli_query($con, $afterKmAdminSubAdminService);
        $sqlResult = $resultDataAdminSubAdminService;
    }
    
    if(mysqli_num_rows($sqlResult) < 1 && !$usernamesInputError) {
        
        $noData = true;
        $message = "Няма данни по вашата справка!";
              echo "<script>alert('$message');</script>";
    }

}

$index = 1;

$btnSendEmail = false;
$typeEmail = "";

    if(!$noData) {
        
    
        switch($checkUpType)
        {
            case $gtpDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи ГТП на МПС от дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                                '<span style="font-size: 16px; color:black; ">до дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                                
                                
                                if(mysqli_num_rows($sqlResult) > 0) {
               	                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't1'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 ГТП дата</th>
                                    <th bgcolor='$color1'>$h2 ГТП сума</th>
                                    <th bgcolor='$color1'>$h2 Име</th>
                                    <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                                    <th bgcolor='$color1'>$h2 ДДС номер</th>
                                    <th bgcolor='$color1'>$h2 Адрес</th>
                                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                                    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                                    <th bgcolor='$color1'>$h2 Телефон</th>
                                    <th bgcolor='$color1'>$h2 Имейл</th>
                                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    $gtpDate=date_create($row['GTP_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    echo "<td>" . $row['Admin_Username'] . "</td>";
                                    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($gtpDate,"d-m-Y") . "</td>";
                                    echo "<td>" . date_format($gtpDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($gtpDate,"d/m/Y") . '" name = "GTP_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['GTP_Sum'] . "</td>";
                                
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            
                                	            $isNotSent = "SELECT GTP_Email FROM insurance WHERE GTP_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            echo "</tr>";
                                	        }
                                	        
                                         }
                                      }
                                      else
                                      {
                                           $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                           if (mysqli_num_rows($resultFirm) > 0)
                                           {
                                       
                                	            while($row2 = mysqli_fetch_array($resultFirm))
                                	            {
                                	                echo "<td>" . $row2['Name'] . "</td>";
                                	                echo "<td>" . $row2['EIK'] . "</td>";
                                	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td>" . $row2['Address'] . "</td>";
                                	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td>" . $row2['Telephone'] . "</td>";
                                	                echo "<td>" . $row2['Email'] . "</td>";
                                	                //echo "<td>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT GTP_Email FROM insurance WHERE GTP_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $gtpDateValue = $_POST['GTP_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "GTP_Email";
                                          $mpsID = $row['AutosID'];
                                          
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0)
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                            break;
                                
            case $goDate: echo '<span style="font-size: 16px;  black; ">Справка за изтичащи ГО на МПС от дата </span>' . " " .
                                '<span style="font-size: 16px; black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                                '<span style="font-size: 16px; black; ">до дата </span>' . " " .
                                '<span style="font-size: 16px; black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                                
                                
                                if(mysqli_num_rows($sqlResult) > 0) {
                                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't1'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 ГО дата</th>
                                    <th bgcolor='$color1'>$h2 ГО сума</th>
                                    <th bgcolor='$color1'>$h2 ГО плащане</th>
                                    <th bgcolor='$color1'>$h2 Име</th>
                                    <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                                    <th bgcolor='$color1'>$h2 ДДС номер</th>
                                    <th bgcolor='$color1'>$h2 Адрес</th>
                                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                                    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                                    <th bgcolor='$color1'>$h2 Телефон</th>
                                    <th bgcolor='$color1'>$h2 Имейл</th>
                                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                {
                                    $goDate=date_create($row['GO_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");                   
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    echo "<td>" . $row['Admin_Username'] . "</td>";
                                    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }    
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($goDate,"d/m/Y") . "</td>";
                                    echo "<td>" . date_format($goDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($goDate,"d/m/Y") . '" name = "GO_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['GO_Sum'] . "</td>";
                                    echo "<td>" . $row['GO_Payment'] . "</td>";
                    
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT GO_Email FROM insurance WHERE GO_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            echo "</tr>";
                                	        }
                                	        
                                         }
                                      }
                                      else
                                      {
                                           $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                           if (mysqli_num_rows($resultFirm) > 0)
                                           {
                                       
                                	            while($row2 = mysqli_fetch_array($resultFirm))
                                	            {
                                	                echo "<td style = 'color: black;'>" . $row2['Name'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['EIK'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Email'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT GO_Email FROM insurance WHERE GO_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $goDateValue = $_POST['GO_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "GO_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                }
                                  
                                
                                echo "</table>";
                                
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0) 
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
             
            case $kaskoDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи КАСКО на МПС от дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                                '<span style="font-size: 16px; color:black; ">до дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateE,"d-m-Y") . '</span>'; 
                                
                                if(mysqli_num_rows($sqlResult) > 0) {
                                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't1'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 Каско дата</th>
                                    <th bgcolor='$color1'>$h2 Каско сума</th>
                                    <th bgcolor='$color1'>$h2 Каско плащане</th>
                                    <th bgcolor='$color1'>$h2 Име</th>
                                    <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                                    <th bgcolor='$color1'>$h2 ДДС номер</th>
                                    <th bgcolor='$color1'>$h2 Адрес</th>
                                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                                    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                                    <th bgcolor='$color1'>$h2 Телефон</th>
                                    <th bgcolor='$color1'>$h2 Имейл</th>
                                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    $kaskoDate=date_create($row['Kasko_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");
        
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    echo "<td>" . $row['Admin_Username'] . "</td>";
                                    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }
                                    //echo "<td>" . date_format($kaskoDate,"d/m/Y") . "</td>";
                                    echo "<td>" . date_format($kaskoDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($kaskoDate,"d/m/Y") . '" name = "Kasko_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Kasko_Sum'] . "</td>";
                                    echo "<td>" . $row['Kasko_Payment'] . "</td>";
                        
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Kasko_Email FROM insurance WHERE Kasko_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            echo "</tr>";
                                	        }
                                	        
                                         }
                                      }
                                      else
                                      {
                                           $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                           if (mysqli_num_rows($resultFirm) > 0)
                                           {
                                       
                                	            while($row2 = mysqli_fetch_array($resultFirm))
                                	            {
                                	                echo "<td>" . $row2['Name'] . "</td>";
                                	                echo "<td>" . $row2['EIK'] . "</td>";
                                	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td>" . $row2['Address'] . "</td>";
                                	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td>" . $row2['Telephone'] . "</td>";
                                	                echo "<td>" . $row2['Email'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Kasko_Email FROM insurance WHERE Kasko_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $kaskoDateValue = $_POST['Kasko_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Kasko_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0) 
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
            
            case $vinetkaDate: echo '<span style="font-size: 16px; color:black; ">Справка за изтичащи Винетки на МПС от дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                                '<span style="font-size: 16px; color:black; ">до дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                                
                                if(mysqli_num_rows($sqlResult) > 0) {
                                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't1'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 Винетка дата</th>
                                    <th bgcolor='$color1'>$h2 Винетка сума</th>
                                    <th bgcolor='$color1'>$h2 Винетка тип</th>
                                    <th bgcolor='$color1'>$h2 Име</th>
                                    <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                                    <th bgcolor='$color1'>$h2 ДДС номер</th>
                                    <th bgcolor='$color1'>$h2 Адрес</th>
                                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                                    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                                    <th bgcolor='$color1'>$h2 Телефон</th>
                                    <th bgcolor='$color1'>$h2 Имейл</th>
                                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                  {
                                    $vinetkaDate=date_create($row['Vinetka_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number FROM autos WHERE AutosID = '$row[AutosID]'");
        
                                    echo "<tr>";
                                    echo "<td>" . $row['Insurance_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    echo "<td>" . $row['Admin_Username'] . "</td>";
                                    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                    }
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($vinetkaDate,"d/m/Y") . "</td>";
                                    echo "<td>" . date_format($vinetkaDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($vinetkaDate,"d/m/Y") . '" name = "Vinetka_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Vinetka_Sum'] . "</td>";
                                    echo "<td>" . $row['Vinetka_Type'] . "</td>";
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Vinetka_Email FROM insurance WHERE Vinetka_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            echo "</tr>";
                                	        }
                                	        
                                         }
                                      }
                                      else
                                      {
                                           $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                           if (mysqli_num_rows($resultFirm) > 0)
                                           {
                                       
                                	            while($row2 = mysqli_fetch_array($resultFirm))
                                	            {
                                	                echo "<td style = 'color: black;'>" . $row2['Name'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['EIK'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone'] . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Email'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td style = 'color: black;'>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Vinetka_Email FROM insurance WHERE Vinetka_Email = 'неизпратено' AND AutosID = $row[AutosID]";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $vinetkaDateValue = $_POST['Vinetka_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Vinetka_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                
                                echo "</table>";
                                
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0) 
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
                                
            case $oilsFiltersToDate: echo '<span style="font-size: 16px;">Справка за смяна на масла и филтри на МПС от дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateB,"d-m-Y") . '</span>' . " " .
                                '<span style="font-size: 16px; color:black; ">до дата </span>' . " " .
                                '<span style="font-size: 16px; color:black; ">' . date_format($dateE,"d-m-Y") . '</span>';
                                
                                
                                //if(mysqli_num_rows($sqlResult) > 0) { 
               	                if(mysqli_num_rows($sqlResult) > 0) {
               	                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't1'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 Текущи км</th>
                                    <th bgcolor='$color1'>$h2 Сервиз</th>
                                    <th bgcolor='$color1'>$h2 Смяна на</th>
                                    <th bgcolor='$color1'>$h2 Дата на смяна</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след дата</th>
                                    <th bgcolor='$color1'>$h2 Сума</th>
                                    <th bgcolor='$color1'>$h2 Фактура</th>
                                    <th bgcolor='$color1'>$h2 Име</th>
                                    <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                                    <th bgcolor='$color1'>$h2 ДДС номер</th>
                                    <th bgcolor='$color1'>$h2 Адрес</th>
                                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                                    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                                    <th bgcolor='$color1'>$h2 Телефон</th>
                                    <th bgcolor='$color1'>$h2 Имейл</th>
                                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResult))
                                
                                {
                                    //$ofDate=date_create($row['Oils_Filters_Date']);
                                    //$oftDate=date_create($row['Oils_Filters_To_Date']);
                                    $afterDate = date_create($row['After_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number, Current_Km FROM autos WHERE AutosID = '$row[AutosID]'");
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Service_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    echo "<td>" . $row['Admin_Username'] . "</td>";
                                    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                        echo "<td>" . $rowRegNumber['Current_Km'] . "</td>";
                                    }
                                    echo "<td>" . $row['Service'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($ofDate,"d-m-Y") . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($oftDate,"d-m-Y") . "</td>";
                                    echo "<td>" . $row['Type'] . "</td>";
                                    echo "<td>" . $row['Date_Of_Service'] . "</td>";
                                    echo "<td>" . $row['Km'] . "</td>";
                                    echo "<td>" . $row['After_Km'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . $row['After_Date'] . "</td>";
                                    echo "<td>" . date_format($afterDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($afterDate,"d/m/Y") . '" name = "Oils_Filters_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Sum'] . "</td>";
                                    echo "<td>" . $row['Invoice'] . "</td>";
                                
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	               echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            echo "</tr>";
                                	        }
                                	        
                                         }
                                      }
                                      else
                                      {
                                           $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                           if (mysqli_num_rows($resultFirm) > 0)
                                           {
                                       
                                	            while($row2 = mysqli_fetch_array($resultFirm))
                                	            {
                                	                echo "<td>" . $row2['Name'] . "</td>";
                                	                echo "<td>" . $row2['EIK'] . "</td>";
                                	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td>" . $row2['Address'] . "</td>";
                                	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td>" . $row2['Telephone'] . "</td>";
                                	                echo "<td>" . $row2['Email'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $afterDateValue = $_POST['Oils_Filters_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Oils_Filters_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                echo "</table>";
                                
                                echo "<br><br>";
                                if(mysqli_num_rows($sqlResult) > 0) 
                                    echo '<button id="btnExport" onclick="fnExcelReport();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                                
                                echo"<br><br>";
                                echo '<span style="font-size: 16px; color:black; ">Справка за смяна на масла и филтри на МПС при изминати километри:</span>'; 
                                echo"<br><br>";
                                
                                if(mysqli_num_rows($sqlResultKm) > 0) {
               	                    
                                    echo "<br><br><br>";
                                    echo "<table border='2' id = 't2'>
                                    <tr>
                                    <th bgcolor='$color1'>$h2 ID/№</th>
                                    <th bgcolor='$color1'>$h2 МПС ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ф. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Ю. лице ID/№</th>
                                    <th bgcolor='$color1'>$h2 Подадмин. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Потреб. потреб. име</th>
                                    <th bgcolor='$color1'>$h2 Рег.№</th>
                                    <th bgcolor='$color1'>$h2 Текущи км</th>
                                    <th bgcolor='$color1'>$h2 Сервиз</th>
                                    <th bgcolor='$color1'>$h2 Смяна на</th>
                                    <th bgcolor='$color1'>$h2 Дата на смяна</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след км</th>
                                    <th bgcolor='$color1'>$h2 Масла и филтри след дата</th>
                                    <th bgcolor='$color1'>$h2 Сума</th>
                                    <th bgcolor='$color1'>$h2 Фактура</th>
                                    <th bgcolor='$color1'>$h2 Име</th>
                                    <th bgcolor='$color1'>$h2 ЕГН/ЕИК</th>
                                    <th bgcolor='$color1'>$h2 ДДС номер</th>
                                    <th bgcolor='$color1'>$h2 Адрес</th>
                                    <th bgcolor='$color1'>$h2 Адрес на МПС</th>
                                    <th bgcolor='$color1'>$h2 МОЛ три имена</th>
                                    <th bgcolor='$color1'>$h2 Телефон</th>
                                    <th bgcolor='$color1'>$h2 Имейл</th>
                                    <th bgcolor='$color1'>$h2 Лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Тел. на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Емейл на лице за контакти</th>
                                    <th bgcolor='$color1'>$h2 Изпрати имейл</th>
                                    </tr>";
                                }
                                
                                while($row = mysqli_fetch_array($sqlResultKm))
                                
                                {
                                    //$ofDate=date_create($row['Oils_Filters_Date']);
                                    //$oftDate=date_create($row['Oils_Filters_To_Date']);
                                    $afterDate = date_create($row['After_Date']);
                                    $regNumberData = mysqli_query($con, "SELECT Reg_Number, Current_Km FROM autos WHERE AutosID = '$row[AutosID]'");
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['Service_ID'] . "</td>";	
                                    echo "<td>" . $row['AutosID'] . "</td>";
                                    echo "<td>" . $row['Individual_ID'] . "</td>";
                                    echo "<td>" . $row['Legalentity_ID'] . "</td>";
                                    echo "<td>" . $row['Admin_Username'] . "</td>";
                                    echo "<td>" . $row['Sub_Admin_Username'] . "</td>";
                                    if($rowRegNumber = mysqli_fetch_array($regNumberData)) {
                                        //echo "<td style = 'border: 1px solid black;'>" . $rowRegNumber['Reg_Number'] . "</td>";
                                        echo "<td>" . $rowRegNumber['Reg_Number'] . '<input style = "display: none;" type = "text" value="'. $rowRegNumber['Reg_Number'] . '" name = "Reg_Number' . $index . '" readonly>' . "</td>";
                                        echo "<td>" . $rowRegNumber['Current_Km'] . "</td>";
                                    }
                                    echo "<td>" . $row['Service'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($ofDate,"d-m-Y") . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . date_format($oftDate,"d-m-Y") . "</td>";
                                    echo "<td>" . $row['Type'] . "</td>";
                                    echo "<td>" . $row['Date_Of_Service'] . "</td>";
                                    echo "<td>" . $row['Km'] . "</td>";
                                    echo "<td>" . $row['After_Km'] . "</td>";
                                    //echo "<td style = 'border: 1px solid black;'>" . $row['After_Date'] . "</td>";
                                    echo "<td>" . date_format($afterDate,"d/m/Y") . '<input style = "display: none;" type = "text" value="'. date_format($afterDate,"d/m/Y") . '" name = "Oils_Filters_Date' . $index . '" readonly>' . "</td>";
                                    echo "<td>" . $row['Sum'] . "</td>";
                                    echo "<td>" . $row['Invoice'] . "</td>";
                                
                                
                                    if(strlen($row['Individual_ID']) > 0 && $row['Individual_ID'] != 0)
                                    {
                                       $resultPerson = mysqli_query($con, "SELECT * FROM individual WHERE Individual_ID = '$row[Individual_ID]'");
                                       
                                       if (mysqli_num_rows($resultPerson) > 0)
                                       {
                                	        
                                	        while($row1 = mysqli_fetch_array($resultPerson))
                                	        {
                                	            echo "<td>" . $row1['Names'] . "</td>";
                                	            echo "<td>" . $row1['EGN'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Address'] . "</td>";
                                	            echo "<td>" . $row1['Address_MPS'] . "</td>";
                                	            echo "<td>" . "" . "</td>";
                                	            echo "<td>" . $row1['Telephone'] . "</td>";
                                	            echo "<td>" . $row1['Email'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	            echo "<td>" . $row1['Telephone_Contact_Person'] . "</td>";
                                	            //echo "<td style = 'border: 1px solid black;'>" . $row1['Email_Contact_Person'] . "</td>";
                                	            echo "<td>" . $row1['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row1['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	            $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	            $isNotSentResult = mysqli_query($con, $isNotSent);
                                	            if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            else {
                                	                echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row1['Names'] . '</span>'; echo'</div>'; echo"</td>";
                                	            }
                                	            echo "</tr>";
                                	        }
                                	        
                                         }
                                      }
                                      else
                                      {
                                           $resultFirm = mysqli_query($con, "SELECT * FROM legalentity WHERE Legalentity_ID = '$row[Legalentity_ID]'");
                                           if (mysqli_num_rows($resultFirm) > 0)
                                           {
                                       
                                	            while($row2 = mysqli_fetch_array($resultFirm))
                                	            {
                                	                echo "<td>" . $row2['Name'] . "</td>";
                                	                echo "<td>" . $row2['EIK'] . "</td>";
                                	                echo "<td>" . $row2['DDS_Nomer'] . "</td>";
                                	                echo "<td>" . $row2['Address'] . "</td>";
                                	                echo "<td>" . $row2['Address_MPS'] . "</td>";
                                	                echo "<td>" . $row2['MOL_Names'] . "</td>";
                                	                echo "<td>" . $row2['Telephone'] . "</td>";
                                	                echo "<td>" . $row2['Email'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Contact_Person']. '" name = "Contact_Person' . $index . '" readonly>' . "</td>";
                                	                echo "<td>" . $row2['Telephone_Contact_Person'] . "</td>";
                                	                //echo "<td style = 'color: black;'>" . $row2['Email_Contact_Person'] . "</td>";
                                	                echo "<td>" . $row2['Email_Contact_Person']. '<input style = "display: none;" type = "text" value="'. $row2['Email_Contact_Person']. '" name = "Email_Contact_Person' . $index . '" readonly>' . "</td>";
                                	                $isNotSent = "SELECT Oils_Filters_Email FROM service WHERE Oils_Filters_Email = 'неизпратено' AND AutosID = $row[AutosID] AND Type = 'масла и филтри'";
                                	                $isNotSentResult = mysqli_query($con, $isNotSent);
                                	                if($isNotSentResult && mysqli_num_rows($isNotSentResult) == 1) {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпрати" style = "width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                else {
                                	                    echo "<td>"; echo '<div class="tooltips">'; echo'<input type = "submit" value="Изпратен" disabled = "true" style = "color : red; width: 100px;" name = "button' . $index . '" >'; echo'<span class="tooltiptext">'. $row2['Name'] . '</span>'; echo'</div>'; echo"</td>";
                                	                }
                                	                echo "</tr>";
                                	            }
                                	   
                                           }
                                      }
                                      
                                      if(isset($_POST['button' . $index . '']))
                                      {
                                          $regNumberValue = $_POST['Reg_Number' . $index . ''];
                                          $afterDateValue = $_POST['Oils_Filters_Date' . $index . ''];
                                          $contactPerson = $_POST['Contact_Person' . $index . ''];
                                          $emailContactPerson = $_POST['Email_Contact_Person' . $index . ''];
                                          $btnSendEmail = true;
                                          $typeEmail = "Oils_Filters_Email";
                                          $mpsID = $row['AutosID'];
                                      }
                                    
                                      $index++;
                                       
                                   }
                                  
                                echo "</table>";
                                
                                echo "<br><br>";
                                
                                if(mysqli_num_rows($sqlResultKm) > 0)
                                    echo '<button id="btnExport2" onclick="fnExcelReport2();">Експорт на данни</button>';
                                echo "<br><br>";
                                
                            break;
                            
        }
    }
    
echo "</div>";

echo "<br><br>";


mysqli_close($con);
//$con = null;

}

    $subject = "";
    $comment = "";
    
    switch($checkUpType)
        {
            case "GTP_Date": $subject = "Напомняне за изтичащ Годишен технически преглед";
                           //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                           //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                           //Текст на имейла: 
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
                           
                           break;
            
            case "GO_Date": $subject = "Напомняне за изтичащa Гражданска отговорност";
                           //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                           //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                           //Текст на имейла: 
                           $comment = "Здравейте " . $contactPerson . ",
                           
                           Напомняме Ви, че срокът на Гражданска отговорност на автомобил " . $regNumberValue . " изтича. Молим за Вашето внимание, за да организираме подновяването и преди " . $goDateValue . ". 
                           Екипът ни Ви напомня, че необходимите Ви документи са:
                           
                           -   Голям регистрационен талон
                               
                           За да подновим полицата ви и да получите най-добрите 3 оферти на пазара, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                           
                           Благодарим Ви, че сте наш лоялен клиент!
                           
                           
                           Поздрави,
                           Екипът на CarLife"; 
                           
                           break;
                           
            case "Kasko_Date": $subject = "Напомняне за изтичащa застраховка Каско";
                               //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                               //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                               //Текст на имейла: 
                               $comment = "Здравейте " . $contactPerson . ",
                               
                               Напомняме Ви, че срокът на застраховката Каско на автомобил " . $regNumberValue . " изтича. Молим за Вашето внимание, за да организираме подновяването и преди " . $kaskoDateValue . ".
                               Екипът ни Ви напомня, че необходимите ви документи са:
                               
                               - Голям регистрационен талон
                               
                               За да подновим полицата Ви и да получите най-добрите 3 оферти на пазара, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                               
                               Благодарим Ви, че сте наш лоялен клиент!
                               
                               
                               Поздрави,
                               Екипът на CarLife";
                               
                               break;
                               
            case "Vinetka_Date": $subject = "Напомняне за изтичащa Винетка";
                                 //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                                 //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                                 //Текст на имейла: 
                                 $comment = "Здравейте " . $contactPerson . ",
                                 
                                 Напомняме Ви, че срокът на вашата Винетка на автомобил " . $regNumberValue . " изтича. Молим за Вашето внимание, за да организираме подновяването и преди " . $vinetkaDateValue . ".
                                 
                                 За да подновим Винетката Ви, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                                 Ако управлявате автомобила си с weekend, седмична или месечна винетка, моля да имате впредвид, че след " . $vinetkaDateValue . ", не можете да управлявате автомобил " . $regNumberValue . " по националната пътна мрежа на Република България и подлежите на санкциониране.
                                 
                                 Благодарим Ви, че сте наш лоялен клиент!
                                 
                                 
                                 Поздрави,
                                 Екипът на CarLife";
                                 
                                 break;
                                     
            case "After_Date": $subject = "Напомняне за изтичащо техническо обслужване за масла и филтри";
                               //Използва специфичен from адрес: Не Специфичен from имейл: Специфично from Име:
                               //Данни за тест: {&quot;displayname&quot;: &quot;displayname&quot;, &quot;reportperiod&quot;: &quot;01/06/2017 - 30/06/2017&quot;, &quot;companyname&quot;: &#39;companyname&quot;}
                               //Текст на имейла: 
                               $comment = "Здравейте " . $contactPerson . ",
                               
                               Напомняме Ви, че срокът на техническо обслужване за масла и филтри на автомобил " . $regNumberValue . " изтича. 
                               Молим за Вашето внимание, за да организираме обслужването преди " . $afterDateValue . ", за да спазим условията на гаранцията на автомобила.
                               Екипът ни Ви напомня, че необходимите Ви документи са:
                               
                               - Голям или малък регистрационен талон
                               
                               За да извършим техническото обслужване за масла, следва да отговорите с „Участвам“ на този мейл и наш сътрудник ще се свърже с Вас, за да поеме организацията.
                               
                               Благодарим Ви, че сте наш лоялен клиент!
                               
                               
                               Поздрави,
                               Екипът на CarLife";
                               
                               break;
            
            //default : echo "<script>alert('$gtpDate');</script>"; break;
                
        }
    
    

    
    $emailErr = "";
    $mainAdminEmail = "";
    
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
      return $data;
	}
    //$emailContactPerson = "wel2bul@gmail.com";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $mainAdminEmail = $_SESSION['mainAdminUsername']; //test_input($_POST['email']);

	}
    //$subject = "Тест";  //$_REQUEST['subject'];
    //$comment = "Здравейте!";//$_REQUEST['comment'];
   
    mb_internal_encoding('UTF-8');
    $encoded_subject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n", strlen('Subject: '));
  
    if ($_SERVER["REQUEST_METHOD"] == "POST"  && $btnSendEmail && strlen($emailContactPerson) > 0 && strlen($subject) > 0 && strlen($comment) > 0) {
        if (!filter_var($emailContactPerson, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Невалиден имейл адрес на лице за контакти!";
              echo "<script>alert('$emailErr');</script>";
        }
	    else {  
	        $success = mail($emailContactPerson, $encoded_subject, $comment, "MIME-Version: 1.0" . "\r\n" . "Content-type: text/plain; charset=UTF-8" . "\r\n". "From:" . $mainAdminEmail);
	        if (!$success) {
              //$errorMessage = error_get_last();
              //print_r($errorMessage);
              $errorMessage = "Неуспешно изпращане на имейл!";
              echo "<script>alert('$errorMessage');</script>";
            }
            else {
                
                $message = "Имейла е изпратен успешно!";
                echo "<script>alert('$message');</script>"; 
                
                $con = connectServer();
                
                if(strcmp($typeEmail, "Oils_Filters_Email") == 0)
                    $emailSent ="UPDATE service SET $typeEmail = 'изпратено' Where AutosID = $mpsID AND Type = 'масла и филтри'";
                else
                    $emailSent ="UPDATE insurance SET $typeEmail = 'изпратено' Where AutosID = $mpsID";
                    
                if (mysqli_query($con, $emailSent) && mysqli_affected_rows($con) == 0) {
                    $message = "Моля изпратете имейла отново!";
                    echo "<script>alert('$message');</script>";    
                }
                //echo "<script>location.reload();</script>"; 
                echo "<script> location.replace('homeMainAdmin.php'); </script>";
            }
        }
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $btnSendEmail && (strlen($emailContactPerson) == 0 || strlen($subject) == 0 || strlen($comment) == 0)) {
        $errorMessage = "Неуспешно изпращане на имейл!";
        echo "<script>alert('$errorMessage');</script>"; 
    }


?>

</form>

<script>

//$(document).ready(function(){
//  $("[data-toggle = 'tooltip']").tooltip({title: "", html: true, placement: "left"});   
//});

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

function fnExcelReport2()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('t2'); // id of table

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
        menuPosition.x = mousePosition.x - menuDimension.x; 
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





/*
$(document).contextmenu(function(e) {  
	var left = e.pageX, top = e.pageY;
	// left and top will be the position of your custom menu
	$(menu).show().css({
		left:left,
		top:top
	});
	return false;// this return statement will prevent the default action / context menu
});

*/
</script>

</body>
</html>