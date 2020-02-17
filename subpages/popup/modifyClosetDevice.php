<div id="popup-wrapper">
	<?php if (isset($_POST['createCD'])) { ?>
		<?php $fields = getCDFields(); ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<table>
				<tr>
					<th colspan="2" id="specialTD">
						Create New Closet Device At <?php echo $_POST['schoolName']; ?>
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
						<?php getParentDD($_POST['schoolName'],"CD"); ?>
					</th>
				</tr>	
				<tr>
					<th>
						Equipment
					</th>
					<th>
						<?php getCDEquipmentDD(); ?>
					</th>
				</tr>
				<?php for ($i = 5; $i <= $fields[0]; $i++) {
					echo "<tr><td>" . $fields[$i] . "</td><td><input class='text' type='text' name='" . $fields[$i] . "' value='' onClick='javascript: this.select();' /></td></tr>";
				} ?>	
				<tr>
					<td colspan="2" id="specialTD">
						<input id="createButton" type="submit" name="doCreateCD" value="Create Closet Device" />
					</td>
				</tr>
				<tr>
					<td colspan="2" id="specialTD">
						<input id="button" type="submit" name="cancel" value="Cancel" />
						<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
						<input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />
						<input type="hidden" name="seeCD" value="1" />												
						<input type="hidden" name="seeCDList" value="1" />		
					</td>
				</tr>
			</table>									
		</form>
		
		
		
		
	<?php } else if (isset($_POST['remapCD'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<table id="wide">
				<tr>
					<th colspan="3" id="specialTD">
						Remap Devices At <?php echo $_POST['schoolName']; ?> in <?php echo $_POST['closetName']; ?>
					</th>
				</tr>	
				<tr>
					<th>Closet Device</th>
					<th>To</th>
					<th>From</th>
				</tr>
				<?php 
				
				$query = sprintf("SELECT * FROM closetdevices WHERE School = '" . $_POST['schoolName'] . "' AND Closet = '" . $_POST['closetName'] . "' ORDER BY Name ASC");
				$result = mysql_query($query);
				while ($row = mysql_fetch_assoc($result)) {
					echo "<tr>";
						echo "<td>" . $row['Name'] . "</td>";
						echo "<td><input type='checkbox' name='" . $row['Name'] . "_n' value='new' /></td>";
						echo "<td><input type='checkbox' name='" . $row['Name'] . "_o' value='old' /></td>";
					echo "</tr>";
				}
				
				?>
			</table>
		
			<input id="button" type="submit" name="cancel" value="Cancel" />
			<input id="button" type="submit" name="setupCDRemap" value="Next" />
			<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
			<input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />
			<input type="hidden" name="seeCD" value="1" />												
			<input type="hidden" name="seeCDList" value="1" />								
		</form>
		
		
		
		
	<?php } else if (isset($_POST['setupCDRemap'])) {
		//Get the list of new devices
		$newDeviceCount = 0;
		$oldDeviceCount = 0;
		
		$query = sprintf("SELECT * FROM closetdevices WHERE School = '" . $_POST['schoolName'] . "' AND Closet = '" . $_POST['closetName'] . "' ORDER BY Name ASC");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {
			if ($_POST[$row['Name'] . "_n"] == "new") {
				$newDevices[] = $row['Name'];
				$newDeviceCount++;
			}
			if ($_POST[$row['Name'] . "_o"] == "old") {
				$oldDevices[] = $row['Name'];
				$oldDeviceCount++;
			}
		}
		
		//Create the old device query
		$oldDeviceQuery = "WHERE endpointdevices.ParentName = '" . $oldDevices[0] . "'";
		for ($i = 1; $i < $oldDeviceCount; $i++) {
			$oldDeviceQuery = $oldDeviceQuery . " OR endpointdevices.ParentName = '" . $oldDevices[$i] . "'";
		}

		//Get the list devices on the "from" devices, and the ports they may be moved to on the "to" devices
		?>
		
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<table id="wide">
				<tr>
					<th>Remap</th>
					<th>End Point Device</th>
					<th>Parent</th>
					<th>Parent Port</th>
					
					<?php for ($i = 0; $i < $newDeviceCount; $i++) {
						echo "<th>" . $newDevices[$i] . "</th>";
					} ?>
					
				</tr>
				<?php $query = sprintf("SELECT endpointdevices.Port AS Port,endpointdevices.Name AS EPDName,endpointdevices.ParentName AS ParentName,closetdevices.Name,closetdevices.Equipment,closetequipment.Name,closetequipment.PoEPorts AS PoEPorts,closetequipment.DataPorts AS DataPorts FROM endpointdevices INNER JOIN closetdevices ON endpointdevices.ParentName = closetdevices.Name INNER JOIN closetequipment ON closetdevices.Equipment = closetequipment.Name " . $oldDeviceQuery . " ORDER BY endpointdevices.ParentName ASC");
				$result = mysql_query($query);
				while ($row = mysql_fetch_assoc($result)) {
					//Display each deviced attached to old closet devices
					echo "<tr>\n";
						echo "<td><input type='checkbox' /></td>\n";
						echo "<td>" . $row['EPDName'] . "</td>\n";
						echo "<td>" . $row['ParentName'] . "</td>\n";
						echo "<td>" . $row['Port'] . "</td>\n";
						for ($i = 0; $i < $newDeviceCount; $i++) {
							echo "<td><select class='map'>\n";
							echo "<option name='" . $newDevices[$i] . "." . $row['EPDName'] . "'></option>\n";
							for ($j = 1; $j <= ($row['PoEPorts']+$row['DataPorts']); $j++) {
								echo "<option>" . $j . "</option>\n";
							}
							echo "</select></td>\n";
						}
					echo "</tr>\n";
				}
				
				?>
			</table>
		
			<input id="button" type="submit" name="cancel" value="Cancel" />
			<input id="button" type="submit" name="setupCDRemap" value="Next" />
			<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
			<input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />
			<input type="hidden" name="seeCD" value="1" />												
			<input type="hidden" name="seeCDList" value="1" />								
		</form>
	
	
	
	
	
	<?php } else if (isset($_POST['doCDRemap'])) { 
	//Verify that the remap will work
	
	//create a list of the devices and their parents/parentports that can be remapped
	//remap all the devices in the list
	//make sure no duplicats occured, and devices are left unattached to a device
	//if errors were found, then go back to the previous page
	//if no errors were found, then update the database with the remap
	
	
	
	 } else if (isset($_POST['editCD'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<table>
				<tr><td colspan="2" id="specialTD">Edit Closet Device \Name/																	</td></tr>
				<?php for ($i = 0; $i < $numFields; $i++) {
					echo "<tr><td>" . $fields[$i] . "</td><td><input class='text' type='text' name='" . $fields[$i] . "' value='' onClick='javascript: this.select();' /></td></tr>";
				} ?>	
				<tr>
					<td colspan="2" id="specialTD">
						<input id="createButton" type="submit" name="doEditCD" value="Update Closet Device" />
					</td>
				</tr>
				<tr>
					<td colspan="2" id="specialTD">
						<input id="button" type="submit" name="cancel" value="Cancel" />
						<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
						<input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />
				<input type="hidden" name="seeCD" value="1" />												
				<input type="hidden" name="seeCDList" value="1" />		
					</td>
				</tr>
			</table>									
		</form>
		
		
		
		
	<?php } else if (isset($_POST['removeCD'])) { ?>
		<form id="popupForm" action="<?php echo $homeDir; ?>" method="post">
			<ul>
				<li>Are you sure you want to remove this closet device?										</li>
				<li><input id="destroyButton" type="submit" name="doRemoveCD" value="Yes" />				</li>
				<li><input id="button" type="submit" name="cancel" value="No" />							</li>
				<li><input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />	</li>
				<li><input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />	</li>
				<li><input type="hidden" name="seeCD" value="1" />											</li>
				<li><input type="hidden" name="seeCDList" value="1" />										</li>
			</ul>
		</form>
	<?php } ?>
</div>