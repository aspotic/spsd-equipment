<div id="popup-wrapper">
	<?php if (isset($_POST['createFloor'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Create New Floor At "<?php echo $_POST['schoolName']; ?>"										</li>
				<li><?php getNewFloorDD($_POST['schoolName']); ?>													</li>
				<li><input id="createButton" type="submit" name="doCreateFloor" value="Create Floor" />				</li>
				<li><input id="button" type="submit" name="cancel" value="Cancel" />								</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />			</li>
				<li><input type="hidden" name="seeEPD" value="1" />													</li>
			</ul>
		</form>
	<?php } else if (isset($_POST['editFloor'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Edit "<?php echo $_POST['floorName']; ?>" at "<?php echo $_POST['schoolName']; ?>"				</li>
				<li>NOTE: This action will also update the name of all devices on this floor						</li>
				<li><input class="text" type="text" name="name" value="Name" onClick="javascript: this.select();" />	</li>
				<li><input id="createButton" type="submit" name="doEditFloor" value="Update Floor" />				</li>
				<li><input id="button" type="submit" name="cancel" value="Cancel" />								</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />			</li>
				<li><input type="hidden" name="seeEPD" value="1" />													</li>
			</ul>
		</form>
	<?php } else if (isset($_POST['removeFloor'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Are you sure you want to remove "<?php echo $_POST['floorName']; ?>" from "<?php echo $_POST['schoolName']; ?>"?	</li>
				<li>NOTE: This action will also delete all devices on this floor														</li>
				<li><input id="destroyButton" type="submit" name="doRemoveFloor" value="Yes" />											</li>
				<li><input id="button" type="submit" name="cancel" value="No" />														</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />								</li>
				<li><input type="hidden" name="seeEPD" value="1" />																		</li>
			</ul>
		</form>
	<?php } ?>
</div>