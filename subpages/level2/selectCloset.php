<div id="elementL">
	<div id="formTitle">
		<span>Select a Closet in <?php echo $_POST['schoolName']; ?></span>
	</div>
	<!-- This is a form used for navigating, creating, editing, and removing closets within a selected school -->
	<form action="<?php echo $homeDir; ?>" method="post">
		<ul>
			<!-- See scripts/readDB.php for function getClosetDD() -->
			<li><?php getClosetDD(); ?>																			</li>
			<li><input id="button" type="submit" name="seeCDList" value="Go to Closet" />						</li>
			<li><input id="createButton" type="submit" name="createCloset" value="Create New Closet" />			</li>
<!--			<li><input id="createButton" type="submit" name="editCloset" value="Edit Selected Closet" />		</li>-->
<!--			<li><input id="destroyButton" type="submit" name="removeCloset" value="Remove Selected Closet" />	</li>-->
			<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />			</li>
			<li><input type="hidden" name="seeCD" value="1" />													</li>
		</ul>
	</form>
</div>