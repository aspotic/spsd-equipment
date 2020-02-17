<div id="elementL">
	<div id="formTitle">
		<span>Select a Floor at <?php echo $_POST['schoolName']; ?></span>
	</div>
	<!-- This is a form used for navigating, creating, editing, and removing floors within a selected school -->
	<form action="<?php echo $homeDir; ?>" method="post">
		<ul>
			<!-- See scripts/readDB.php for function getFloorDD() -->
			<li><?php getFloorDD(); ?>																		</li>
			<li><input id="button" type="submit" name="seeEPDList" value="Go to Floor" />					</li>
			<li><input id="createButton" type="submit" name="createFloor" value="Create New Floor" />		</li>
<!--			<li><input id="createButton" type="submit" name="editFloor" value="Edit Selected Floor" />		</li>-->
<!--			<li><input id="destroyButton" type="submit" name="removeFloor" value="Remove Selected Floor" />	</li>-->
			<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />		</li>
			<li><input type="hidden" name="seeEPD" value="1" />												</li>
		</ul>
	</form>
</div>