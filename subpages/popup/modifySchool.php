<div id="popup-wrapper">
	<?php if (isset($_POST['createSchool'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Create New School																									</li>
				<li><input class="text" type="text" name="schoolName" value="School Name" onClick="javascript: this.select();" />			</li>
				<li><input class="text" type="text" name="schoolID" value="School ID" onClick="javascript: this.select();" />				</li>
				<li><input id="createButton" type="submit" name="doCreateSchool" value="Create" />										</li>
				<li><input id="button" type="submit" name="cancel" value="Cancel" />													</li>
				<li><input type="hidden" name="SchoolLevel" />																			</li>
			</ul>
		</form>
	<?php } else if (isset($_POST['editSchool'])) { 
		
		$query = sprintf("SELECT * FROM schools WHERE SchoolName = '" . $_POST['schoolName'] . "'");
		$result = mysql_query($query);
		if ($row = mysql_fetch_assoc($result)) { ?>
			<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
				<ul>
					<li>Edit "<?php echo $_POST['schoolName']; ?>"																				</li>
					<li>NOTE: This action will update the school name of any associated closets, floors, end point devices, and closet devices		</li>
					<li><input class="text" type="text" name="schoolName" value="<?php echo $row['SchoolName'] ?>" onClick="javascript: this.select();" />	</li>
					<li><input class="text" type="text" name="schoolID" value="<?php echo $row['SchoolID'] ?>" onClick="javascript: this.select();" />	</li>
					<li><input id="createButton" type="submit" name="doEditSchool" value="Update" />												</li>
					<li><input id="button" type="submit" name="cancel" value="Cancel" />															</li>
					<li><input type="hidden" name="SchoolLevel" />																					</li>
				</ul>
			</form>
		<?php } else {
			die("Failed: " . mysql_error());
		}
	} else if (isset($_POST['removeSchool'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Are you sure you want to remove "<?php echo $_POST['schoolName']; ?>"?								</li>
				<li>NOTE: This action will remove any associated closets, floors, end point devices, and closet devices	</li>
				<li><input id="destroyButton" type="submit" name="doRemoveSchool" value="Yes" />						</li>
				<li><input id="button" type="submit" name="cancel" value="No" />										</li>
				<li><input type="hidden" name="SchoolLevel" />															</li>
				<li><input type="hidden" name="SchoolName" value="<?php echo $_POST['schoolName']; ?>" />				</li>
			</ul>
		</form>
	<?php } ?>
</div>