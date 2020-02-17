<div id="elementL">
	<div id="formTitle">
		Select School
	</div>
	<!-- This is a form used for navigating, creating, editing, and removing schools -->
	<form action="<?php echo $homeDir; ?>" method="post">
		<ul>
			<!-- See scripts/readDB.php for function getSchoolDD() -->
			<li><?php getSchoolDD(); ?></li>
			<li><input id="button" type="submit" name="seeEPD" value="View End Point Devices" />					</li>
			<li><input id="button" type="submit" name="seeCD" value="View Closet Devices" />						</li>
			<li><input id="button" type="submit" name="seeHierarchy" value="View Hierarchy" />						</li>
			<li><input id="createButton" type="submit" name="createSchool" value="Create New School" />				</li>
<!--			<li><input id="createButton" type="submit" name="editSchool" value="Edit Selected School" />			</li>-->
<!--			<li><input id="destroyButton" type="submit" name="removeSchool" value="Remove Selected School" />		</li>-->
			<li><input type="hidden" name="hName" value="RTR" />													</li>
		</ul>
	</form>
</div>