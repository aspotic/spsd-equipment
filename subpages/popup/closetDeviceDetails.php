<?php
	$fields = getCDFields();
	$endFields = getEPDFields();
?>

<div id="popup-wrapper">
	<div id="close">
		<form id="smallForm" action="<?php echo $homeDir; ?>" method="post">
			<input id="button" type="submit" name="closeCDDetails" value="Close Details Window" />
			<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
			<input type="hidden" name="closetName" value="<?php echo $_POST['closetName']; ?>" />		
			<input type="hidden" name="seeCDList" value="1" />
			<input type="hidden" name="seeCD" value="1" />
		</form>
	</div>
	
	
	<div id="head">Device Information</div>
	<table border=1>
		<tr>
			<?php for ($i = 1; $i <= $fields[0]; $i++) {
				echo "<th>" . $fields[$i] . "</th>";
			} 
			
			echo "<th>PoEPorts</th>";
			echo "<th>DataPorts</th>"; ?>
		</tr>
		<tr>
			<?php $query = sprintf("SELECT * FROM closetdevices WHERE Name = '" . $_POST['deviceName'] . "' LIMIT 1");
			$result = mysql_query($query);
			if ($row = mysql_fetch_assoc($result)) {
				//Show the standard field data
				for ($i = 1; $i <= $fields[0]; $i++) {
					echo "<td>" . $row[$fields[$i]] . "</td>";
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
				}
				
				$parentName = $row['ParentName'];
			} ?>
		</tr>
	</table>
	
	
	<div id="head">Parent Information</div>
	<table border=1>
		<tr>
			<?php for ($i = 1; $i <= $fields[0]; $i++) {
				echo "<th>" . $fields[$i] . "</th>";
			}
			
			echo "<th>PoEPorts</th>";
			echo "<th>DataPorts</th>"; ?>
		</tr>
		<tr>
			<?php $query = sprintf("SELECT * FROM closetdevices WHERE Name = '" . $parentName . "' LIMIT 1");
			$result = mysql_query($query);
			if ($row = mysql_fetch_assoc($result)) {
				for ($i = 1; $i <= $fields[0]; $i++) {
					echo "<td>" . $row[$fields[$i]] . "</td>";
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
				}
			} ?>
		</tr>
	</table>
	
	
	<div id="head">Child Closet Devices</div>
	<table border=1>
		<tr>
			<?php for ($i = 1; $i <= $fields[0]; $i++) {
				echo "<th>" . $fields[$i] . "</th>";
			}
			
			echo "<th>PoEPorts</th>";
			echo "<th>DataPorts</th>"; ?>
		</tr>
			
		<?php $query = sprintf("SELECT * FROM closetdevices WHERE ParentName = '" . $_POST['deviceName'] . "'");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {?>
			<tr>
				<?php for ($i = 1; $i <= $fields[0]; $i++) {
					echo "<td>" . $row[$fields[$i]] . "</td>";
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
	
	
	<div id="head">Child End Point Data Devices</div>
	<table border=1>
		<tr>
			<?php for ($i = 1; $i <= $endFields[0]; $i++) {
				echo "<th>" . $endFields[$i] . "</th>";
			} ?>
		</tr>
			
		<?php $query = sprintf("SELECT COUNT(*) FROM endpointdevices INNER JOIN endpointequipment ON endpointdevices.Equipment = endpointequipment.Name WHERE endpointdevices.ParentName = '" . $row['Name'] . "' AND endpointequipment.isPoE = '0'");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {?>
			<tr>
				<?php for ($i = 1; $i <= $endFields[0]; $i++) {
					echo "<td>" . $row[$endFields[$i]] . "</td>";
				} ?>
			</tr>
		<?php } ?>
	</table>
	
	
	<div id="head">Child End Point PoE Devices</div>
	<table border=1>
		<tr>
			<?php for ($i = 1; $i <= $endFields[0]; $i++) {
				echo "<th>" . $endFields[$i] . "</th>";
			} ?>
		</tr>
			
		<?php $query = sprintf("SELECT COUNT(*) FROM endpointdevices INNER JOIN endpointequipment ON endpointdevices.Equipment = endpointequipment.Name WHERE endpointdevices.ParentName = '" . $row['Name'] . "' AND endpointequipment.isPoE = '1'");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {?>
			<tr>
				<?php for ($i = 1; $i <= $endFields[0]; $i++) {
					echo "<td>" . $row[$endFields[$i]] . "</td>";
				} ?>
			</tr>
		<?php } ?>
	</table>
</div>