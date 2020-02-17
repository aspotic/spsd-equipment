<?php 
//First, check if the the device is in the closet device list.  If it is, then display it
if ($_POST['hName'] == "RTR") {
	$query = sprintf("SELECT * FROM closetdevices WHERE (ParentName IS NULL)");
} else {
	$query = sprintf("SELECT * FROM closetdevices WHERE (Name = '" . $hName . "')");
}
$result = mysql_query($query);
if ($row = mysql_fetch_assoc($result)) { 
	//Get the list of fields to display
	$fields = getCDFields();?>
	<div id="elementL">
		<div id="formTitle">
			<span><?php echo "Current Device \"" . $row['Name'] . "\" Details"; ?></span>
		</div>
		<form action="" method="post">
			<table border=1 id="hierarchy">
				<tr>
					<th id="text">
						Field
					</th>
					<th id="text">
						Value
					</th>
				</tr>
				<?php for ($i = 1; $i <= $fields[0]; $i++) {
					echo "<tr><td id='text'>" . $fields[$i] . "</td><td id='text'>" . $row[$fields[$i]] . "</td></tr>";
				} ?>
			</table>
		</form>
	</div>
<?php 
//The device was not in the closet device list, so now check the end point device list, and display if it is in there
} else {
	//Get the list of fields to display
	$endFields = getEPDFields();
	$query2 = sprintf("SELECT * FROM endpointdevices WHERE (Name = '" . $hName . "')");
	$result2 = mysql_query($query2);
	if ($row2 = mysql_fetch_assoc($result2)) { ?>
		<div id="elementL">
			<div id="formTitle">
			<span><?php echo "Current Device \"" . $row2['Name'] . "\" Details"; ?></span>
			</div>
			<form action="" method="post">
				<table border=1 id="hierarchy">
					<tr>
						<th id="text">
							Field
						</th>
						<th id="text">
							Value
						</th>
					</tr>
					<?php for ($i = 1; $i <= $endFields[0]; $i++) {
						echo "<tr><td id='text'>" . $endFields[$i] . "</td><td id='text'>" . $row2[$endFields[$i]] . "</td></tr>";
					} ?>
				</table>
			</form>
		</div>
	<?php } 
	} ?>