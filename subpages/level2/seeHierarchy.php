<?php 
//If this is the top school device being displayed, then get the schoolID to create the proper ___RTR name.
if ($_POST['hName'] == "RTR") {
	$query = sprintf("SELECT Name,ParentName FROM closetdevices WHERE (ParentName IS NULL)");
	$result = mysql_query($query);
	if ($row = mysql_fetch_assoc($result)) {
		$hName = $row['Name'];
	}
} else {
	$hName = $_POST['hName'];
} ?>

<div id="elementL">
	<div id="formTitle">
		<span><?php echo "Device Hierarchy at " . $_POST['schoolName']; ?></span>
	</div>
		<form action="<?php echo $homeDir; ?>" method="post">
			<?php 
			// If there is a device name to use, then look for its data
			if (isset($hName)) {
				//Query the device's fields for its parent's name
				$query = sprintf("SELECT School,Name,ParentName FROM closetdevices WHERE (Name = '" . $hName . "') UNION SELECT School,Name,ParentName FROM endpointdevices WHERE (Name = '" . $hName . "')");
				$result = mysql_query($query);
				if ($row = mysql_fetch_assoc($result)) {
					//If a parent was found, then display the parent device stats
					$query2 = sprintf("SELECT School,Name,ParentName FROM closetdevices WHERE (Name = '" . $row['ParentName'] . "') UNION SELECT School,Name,ParentName FROM endpointdevices WHERE (Name = '" . $row['ParentName'] . "')");
					$result2 = mysql_query($query2);
					if ($row2 = mysql_fetch_assoc($result2)) { ?>
					<table border=1 id="hierarchy">
						<tr>
							<th id="text">
								Parent
							</th>
						</tr>
						<tr>
							<td>
								<input id="destroyButton" type="submit" name="hName" value="<?php echo $row2['Name']; ?>" />
							</td>
						</tr>
					</table>
					<?php } ?>
				<?php } ?>
				
				
				<?php 
				//Now display all of this device's children, provided they are closet type devices
				$query = sprintf("SELECT * FROM closetdevices WHERE ParentName = '" . $hName . "'");
				$result = mysql_query($query);
				if ($row = mysql_fetch_assoc($result)) {?>
					<table border=1 id="hierarchy">
							<tr>
								<th id="text">
									Closet Children
								</th>
							</tr>
							<tr>
								<td>
									<input id="createButton" type="submit" name="hName" value="<?php echo $row['Name']; ?>" />
								</td>
							</tr>
				<?php }
				while ($row = mysql_fetch_assoc($result)) {?>
					<tr>
						<td>
							<input id="createButton" type="submit" name="hName" value="<?php echo $row['Name']; ?>" />
						</td>
					</tr>
				<?php } ?>
				
				</table>
				
				<?php 
				//Finally, display the stats for the device's child end point devices
				$query = sprintf("SELECT * FROM endpointdevices WHERE (ParentName = '" . $hName . "')");
				$result = mysql_query($query);
				if ($row = mysql_fetch_assoc($result)) {?>
					<table border=1 id="hierarchy">
						<tr>
							<th id="text">
								End Point Children
							</th>
						</tr>
						<tr>
							<td>
								<input id="createButton" type="submit" name="hName" value="<?php echo $row['Name']; ?>" />
							</td>
						</tr>
				<?php }
				while ($row = mysql_fetch_assoc($result)) {?>
					<tr>
						<td>
							<input id="createButton" type="submit" name="hName" value="<?php echo $row['Name']; ?>" />
						</td>
					</tr>
				<?php } ?>
				</table>
			<?php } ?>
		<input type="hidden" name="seeHierarchy" value="1" />
		<input type="hidden" name="schoolName" value="<?php echo $_POST['schoolName']; ?>" />
	</form>
</div>