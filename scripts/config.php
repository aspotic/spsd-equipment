<?php
	////////////////////////////VARIABLES SET BY WEBMASTER//////////////////////////////////////
	//Site Info
	static $itemsPerPage = 10;
	static $siteTitle = "SPSD Hardware Database";
	static $footerText = "Saskatoon Public School Division";
	static $siteFolder = "index.php";	//the name of the index page

	//DB Login Info
	static $mysql_Host = "localhost"; 
	static $mysql_User = "noanomie_goose";
	static $mysql_Pass = "uolttoissooleisslpfsbalf";
	static $database = "spsd_network_equipment";
	
	//Style _Settings
	$layout_theme = "mini";	//name of a stylesheet file located in the stylesheets folder
	
	if ($_SERVER["SERVER_NAME"] == "127.0.0.1")
		$subFolder = "/sps/";	//The subfolder below the domain that your site resides in
	else
		$subFolder = "/sps/";
	

	
	
	/////////////////'/////////DON'T EDIT ANYTHING PAST HERE//////////////'//////////////////////					
	////////////CONNECT TO WEBSITE DATABASE///////////////
	$connect = mysql_connect($mysql_Host, $mysql_User, $mysql_Pass);
	if(!$connect) {die("could not connect to mysql server: ". mysql_error());}
	
	$mysql_DB = mysql_select_db($database, $connect);
	if(!$mysql_DB) {die("could not connect to mysql database: ". mysql_error());}
	
	////////////VARIOUS SHORT COMMANDS///////////////
	//set the current date variable
	$date = date("o-m-d");

	//setup addressing variables
	$homeDir = "http://" . $_SERVER["SERVER_NAME"] . $subFolder;

?>