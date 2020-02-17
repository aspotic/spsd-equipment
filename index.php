<!-- 18/5/2011 : 7h -->
<!-- 19/5/2011 : 3h -->
<HTML>
	<head>
		<?php
			//Include the configuration file
			require("scripts/config.php");
			require("scripts/writeDB.php");
			require("scripts/readDB.php");
			require("scripts/dropFromDB.php");
			require("scripts/runDBOps.php");
			
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
	
	
		<!-- a popup box used to create/edit/confirm deletion of entries and show details of a machine; pages are brought from subpages/secondary -->
		<?php 
			if ((isset($_POST['createSchool'])) || (isset($_POST['editSchool'])) ||(isset($_POST['removeSchool']))) {
				require("subpages/popup/modifySchool.php"); 
			} else if ((isset($_POST['createFloor'])) || (isset($_POST['editFloor'])) || (isset($_POST['removeFloor']))) {
				require("subpages/popup/modifyFloor.php"); 
			} else if ((isset($_POST['createCloset'])) || (isset($_POST['editCloset'])) || (isset($_POST['removeCloset']))) {
				require("subpages/popup/modifyCloset.php"); 
			} else if ((isset($_POST['createCD'])) || (isset($_POST['editCD'])) || (isset($_POST['removeCD'])) || (isset($_POST['remapCD'])) || (isset($_POST['setupCDRemap'])) || (isset($_POST['doCDRemap']))) {
				require("subpages/popup/modifyClosetDevice.php"); 
			} else if ((isset($_POST['createEPD'])) || (isset($_POST['editEPD'])) || (isset($_POST['removeEPD']))) {
				require("subpages/popup/modifyEndDevice.php"); 
			} else if (isset($_POST['viewCDDetails'])) {
				require("subpages/popup/closetDeviceDetails.php"); 
			} else {
		?>
		
		<!-- The main page content is held in this divider -->
		<div id="body">		
		
		
			<!--  HEADER; Contains website title -->
			<div id="header">
				<span><?php echo $siteTitle; ?></span>
			</div>
			
			<div id="links">
				<a href="equipment/index.php">Add Equipment Type</a> :
				<a href="history/index.php">See Network History</a>
			</div>
			
			<!-- DATA BODY; Contains the primary site interface and data -->
			<div id="dataBody">
			
			
				<!-- This divider contains the navigation boxes for level 1 and level 2 -->
				<div id="navigation">
				
				
					<!-- School selection form is always displayed, it is pulled from subpages/level1 -->
					<?php require("subpages/level1/selectSchool.php"); ?>
					
					
					<!-- Level 2 boxes are selected and displayed here, they are brought from the subpages/level2 folder-->
					<?php 
						if (isset($_POST['seeEPD'])) {
							require("subpages/level2/selectFloor.php");
						} else if (isset($_POST['seeCD'])) {
							require("subpages/level2/selectCloset.php");
						} else if (isset($_POST['seeHierarchy'])) {
							require("subpages/level2/seeHierarchy.php");
							require("subpages/level2/seeHierarchyDetails.php");
						}
					?>
					<div id="clear"></div>
				</div>
				
				
				<!-- Level 3 boxes are selected and displayed here, they are brought from the subpages/level3 folder-->
				<?php 
					if (isset($_POST['seeCDList'])) {
						require("subpages/level3/seeCloset.php");
					} else if (isset($_POST['seeEPDList'])) {
						require("subpages/level3/seeFloor.php");
					}
				?>	
			</div>
			
			
			<!-- FOOTER; Message configured in config file -->
			<div id="footer">
				<?php echo $footerText ?>
			</div>
		</div>
		<?php } ?>
	</body>
</HTML>


<!-- Close the database connection after page is parsed -->
<?php mysql_close($connect); ?>
