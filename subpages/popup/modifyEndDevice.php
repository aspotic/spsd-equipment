<div id="popup-wrapper">
	<?php if (isset($_POST['createEPD'])) { ?>
		<?php $fields = getEPDFields(); ?>
		<form id="popupForm" name="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<table>
				<tr>
					<th colspan="2">
						Create New End Point Device At <?php echo $_POST['schoolName']; ?>
					</th>
				</tr>	
				<tr>
					<th>
						Name
					</th>
					<th>
						<input class="text" type="text" name="name" value="" onClick="javascript: this.select();" />
					</th>
				</tr>	
				<tr>
					<th>
						ParentName
					</th>
					<th>
						<?php getParentDD($_POST['schoolName'],"EPD"); ?>
					</th>
				</tr>		
				<tr>
					<th>
						Room
					</th>
					<th>
						<input class="text" type="text" name="room" value="" onClick="javascript: this.select();" />
					</th>
				</tr>		
				<tr>
					<th>
						Closet #
					</th>
					<th>
						<input class="disabledText" id="closet" type="text" name="closet" value="" onClick="this.disabled = true;" />
					</th>
				</tr>		
				<tr>
					<th>
						Panel #
					</th>
					<th>
						<input class="text" type="text" name="panel" value="" onClick="javascript: this.select();" />
					</th>
				</tr>		
				<tr>
					<th>
						Port #
					</th>
					<th>
						<input class="text" type="text" name="port" value="" onClick="javascript: this.select();" />
					</th>
				</tr>	
				<tr>
					<th>
						Equipment
					</th>
					<th>
						<?php getEPDEquipmentDD(); ?>
					</th>
				</tr>
				<?php for ($i = 9; $i <= $fields[0]; $i++) {
					echo "<tr><td>" . $fields[$i] . "</td><td><input class='text' type='text' name='" . $fields[$i] . "' value='' onClick='javascript: this.select();' /></td></tr>";
				} ?>						
				<tr>
					<td colspan="2" id="specialTD">
						<input id="createButton" type="submit" name="doCreateEPD" value="Create End Point Device" />
					</td>
				</tr>
				<tr>
					<td colspan="2" id="specialTD">
						<input id="button" type="submit" name="cancel" value="Cancel" />
						<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
						<input type="hidden" name="floorName" value="<?php echo $_POST['floorName']; ?>" />
					</td>
				</tr>
			</table>
			<?php if (isset($_POST['fromDetails'])) { ?>
				<input type="hidden" name="seeCD" value="1" />											
				<input type="hidden" name="seeCDList" value="1" />										
				<input type="hidden" name="viewCDDetails" value="1" />									
			<?php } else {?>
				<input type="hidden" name="seeEPD" value="1" />										
				<input type="hidden" name="seeEPDList" value="1" />				
			<?php } ?>
		</form>
	<?php } else if (isset($_POST['editEPD'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<table>
				<tr>
					<th colspan="2" id="specialTD">
						Edit End Point Device \Name/
					</th>
				</tr>
				<?php for ($i = 0; $i < $numFields; $i++) {
					echo "<tr><td>" . $fields[$i] . "</td><td><input class='text' type='text' name='" . $fields[$i] . "' value='' onClick='javascript: this.select();' /></td></tr>";
				} ?>															
				<tr>
					<td colspan="2" id="specialTD">
						<input id="createButton" type="submit" name="doEditEPD" value="Update End Point Device" />
					</td>
				</tr>
				<tr>
					<td colspan="2" id="specialTD">
						<input id="button" type="submit" name="cancel" value="Cancel" />
						<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
						<input type="hidden" name="floorName" value="<?php echo $_POST['floorName']; ?>" />
					</td>
				</tr>
			</table>
			<?php if (isset($_POST['fromDetails'])) { ?>
				<input type="hidden" name="seeCD" value="1" />											
				<input type="hidden" name="seeCDList" value="1" />										
				<input type="hidden" name="viewCDDetails" value="1" />									
			<?php } else {?>
				<input type="hidden" name="seeEPD" value="1" />										
				<input type="hidden" name="seeEPDList" value="1" />				
			<?php } ?>
		</form>
	<?php } else if (isset($_POST['removeEPD'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Are you sure you want to remove this end point device?										</li>
				<li><input id="destroyButton" type="submit" name="doRemoveEPD" value="Yes" />					</li>
				<li><input id="button" type="submit" name="cancel" value="No" />								</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />		</li>
				<li><input type="hidden" name="floorName" value="<?php echo $_POST['floorName']; ?>" />			</li>							
				<?php if (isset($_POST['fromDetails'])) { ?>
					<li><input type="hidden" name="seeCD" value="1" />											</li>
					<li><input type="hidden" name="seeCDList" value="1" />										</li>
					<li><input type="hidden" name="viewCDDetails" value="1" />									</li>
				<?php } else {?>
					<li><input type="hidden" name="seeEPD" value="1" />											</li>
					<li><input type="hidden" name="seeEPDList" value="1" />										</li>
				<?php } ?>
			</ul>
		</form>
	<?php } ?>
</div>