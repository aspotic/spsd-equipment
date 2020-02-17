<HTML>
	<head>
		<?php
			//Include the configuration file
			require("../scripts/config.php");
			
			//Setup the page information using config file data
			echo "\n";
			echo "		<title>" . $siteTitle . "</title>\n";
			echo "		<meta name='title' content='" . $siteTitle . "' />\n";
		?>
		
		
		<!-- Setup page graphics -->
		<link rel="icon" href="<?php echo $homeDir ?>favicon.ico" type="image/x-icon" />
		<link rel="StyleSheet" href="<?php echo $homeDir; ?>stylesheets/<?php echo $layout_theme; ?>.css" type="text/css" />
	</head>
	<body>
	
		
		<!-- The main page content is held in this divider -->
		<div id="body">		
		
		
			<!--  HEADER; Contains website title -->
			<div id="header">
				<span><?php echo $siteTitle; ?></span>
			</div>
			
			<div id="links">
				<a href="../index.php">Database</a> :
				<a href="../equipment/index.php">Add Equipment Type</a>
			</div>
			
			<!-- DATA BODY; Contains the primary site interface and data -->
			<div id="dataBody">
			
			
				<!-- This divider contains the navigation boxes for level 1 and level 2 -->
				<div id="navigation">
				
				</div>
	
			</div>
			
			
			<!-- FOOTER; Message configured in config file -->
			<div id="footer">
				<?php echo $footerText ?>
			</div>
		</div>
	</body>
</HTML>


<!-- Close the database connection after page is parsed -->
<?php mysql_close($connect); ?>
