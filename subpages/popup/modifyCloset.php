<div id="popup-wrapper">
	<?php if (isset($_POST['createCloset'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Create New Closet At "<?php echo $_POST['schoolName']; ?>"													</li>
				<li><?php getNewClosetDD($_POST['schoolName']); ?>																</li>
				<li><input class="std" id="text" type="text" name="description" value="Description" onClick="javascript: this.select();"  /></li>
				<li><input class="std" id="createButton" type="submit" name="doCreateCloset" value="Create Closet" />						</li>
				<li><input class="std" id="button" type="submit" name="cancel" value="Cancel" />											</li>
				<li><input type="hidden" name="seeCD" value="1" />																</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />						</li>
			</ul>
		</form>
	<?php } else if (isset($_POST['editCloset'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Edit "<?php echo $_POST['closetName']; ?>" at "<?php echo $_POST['schoolName']; ?>"				</li>
				<li>NOTE: This action will also update the name of all devices on this Closet						</li>
				<li><input class="std" id="text" type="text" name="name" value="Name" onClick="javascript: this.select();"  />	</li>
				<li><input class="std" id="createButton" type="submit" name="doEditCloset" value="Update Closet" />				</li>
				<li><input class="std" id="button" type="submit" name="cancel" value="Cancel" />								</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />			</li>
				<li><input type="hidden" name="seeCD" value="1" />													</li>
			</ul>
		</form>
	<?php } else if (isset($_POST['removeCloset'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Are you sure you want to remove "<?php echo $_POST['closetName']; ?>" from "<?php echo $_POST['schoolName']; ?>"?	</li>
				<li>NOTE: This action will also delete all devices on this Closet														</li>
				<li><input class="std" id="destroyButton" type="submit" name="doRemoveCloset" value="Yes" />										</li>
				<li><input class="std" id="button" type="submit" name="cancel" value="No" />														</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />			</li>
				<li><input type="hidden" name="seeCD" value="1" />																		</li>
			</ul>
		</form>
	<?php } ?>
</div>