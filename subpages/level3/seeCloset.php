<!-- This page will display a box containing the device list of a closet -->
<div id="elementFixed">
	<div id="elementHead">
		<span><?php echo $_POST['closetName'] . " Device List for " . $_POST['schoolName']; ?></span>
	</div>
	<div id="elementBody">
		<div id="tableDesc"><?php getClosetDesc($_POST['closetName'], $_POST['schoolName']); ?></div>
		<?php $fields = getCDFields(); ?>
		<table id="wide" border=1>
			<tr>
				<th>
					<form id="smallForm" action="<?php echo $homeDir; ?>" method="post">
						<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
						<input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />
						<input type="hidden" name="seeCDList" value="1" />
						<input type="hidden" name="seeCD" value="1" />	
						<input id="createButtonMed3" type="submit" name="createCD" value="Create New Entry" />
						<input id="createButtonMed3" type="submit" name="remapCD" value="Replace Devices" />
					</form>
				</th>
				<?php for ($i = 1; $i <= $fields[0]; $i++) {
					echo "<th id='text'>" . $fields[$i] . "</th>";
				}
			
				echo "<th>PoEPorts</th>";
				echo "<th>DataPorts</th>"; ?>
			</tr>
				
			<?php $query = sprintf("SELECT * FROM closetdevices WHERE ( School = '" . $_POST['schoolName'] . "' AND Closet = '" . $_POST['closetName'] . "')");
			$result = mysql_query($query);
			while ($row = mysql_fetch_assoc($result)) {?>
				<tr>
					<td>
						<form id="smallForm" action="<?php echo $homeDir; ?>" method="post">
							<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
							<input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />
							<input type="hidden" name="deviceName" value="<?php echo $row['Name']; ?>" />
							<input type="hidden" name="seeCDList" value="1" />
							<input type="hidden" name="seeCD" value="1" />	
							<input id="buttonSmall" type="submit" name="viewCDDetails" value="Details" /> 
<!--							<input id="createButtonSmall" type="submit" name="editCD" value="Edit" />   -->
<!--							<input id="destroyButtonSmall" type="submit" name="removeCD" value="Remove" />  -->
						</form>
					</td>
					<?php for ($i = 1; $i <= $fields[0]; $i++) {
						echo "<td id='text'>" . $row[$fields[$i]] . "</td>";
					}
				
					//Get the number of PoE ports on the device
					$query2 = sprintf("SELECT * FROM closetequipment WHERE Name = '" . $row['Equipment'] . "' LIMIT 1");
					$result2 = mysql_query($query2);
					if ($row2 = mysql_fetch_assoc($result2)) {
						//Get the number of used PoE ports
						$query3 = sprintf("SELECT COUNT(*) FROM endpointdevices INNER JOIN endpointequipment ON endpointdevices.Equipment = endpointequipment.Name WHERE endpointdevices.ParentName = '" . $row['Name'] . "' AND endpointequipment.isPoE = '1'");
						$result3 = mysql_query($query3);
						if ($row3 = mysql_fetch_row($result3)) {
							echo "<td>" . $row3[0] . "/" . $row2['PoEPorts'] . "</td>";
						}
					}
					//Get the number of Data ports on the device
					$query2 = sprintf("SELECT * FROM closetequipment WHERE Name = '" . $row['Equipment'] . "' LIMIT 1");
					$result2 = mysql_query($query2);
					if ($row2 = mysql_fetch_assoc($result2)) {
						//Get the number of used Data ports
						$query3 = sprintf("SELECT COUNT(*) FROM endpointdevices INNER JOIN endpointequipment ON endpointdevices.Equipment = endpointequipment.Name WHERE endpointdevices.ParentName = '" . $row['Name'] . "' AND endpointequipment.isPoE = '0'");
						$result3 = mysql_query($query3);
						if ($row3 = mysql_fetch_row($result3)) {
							echo "<td>" . $row3[0] . "/" . $row2['DataPorts'] . "</td>";
						}
					} ?>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>