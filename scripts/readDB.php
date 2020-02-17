<?php 
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//fields[]: should be an empty array that will contain the 
	//			list of fields, with fields[0] containing the # of fields
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//returns the list of closet device fields to display, in the correct order 
	//	with the first entry being the number of fields to display with the first array item
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getCDFields() {
		$fields[] = 4;
		$fields[] = "Name";
		$fields[] = "ParentName";
		$fields[] = "Equipment";
		$fields[] = "Modified";
		
		$query = sprintf("SELECT * FROM displayedcdfields ORDER BY DisplayOrder ASC");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row['DisplayOrder'] >= 0) {
				$fields[] = $row['FieldName'];
				$fields[0]++;
			}
		}
		return $fields;
	}	

	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//fields[]: should be an empty array that will contain the 
	//			list of fields, with fields[0] containing the # of fields
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//returns the list of end point device fields to display, in the correct order 
	//	with the first entry being the number of fields to display with the first array item
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getEPDFields() {
		$fields[] = 8;
		$fields[] = "Name";
		$fields[] = "ParentName";
		$fields[] = "Equipment";
		$fields[] = "Room";
		$fields[] = "Modified";
		$fields[] = "Closet";
		$fields[] = "Panel";
		$fields[] = "Port";
		
		$query = sprintf("SELECT * FROM displayedepdfields ORDER BY DisplayOrder ASC");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row['DisplayOrder'] >= 0) {
				$fields[] = $row['FieldName'];
				$fields[0]++;
			}
		}
		return $fields;
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//schoolName: Name of the school listed in the database
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//returns the proper school id, returns empty if a bad school is given
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getSchoolID($schoolName) {
		$query = sprintf("SELECT SchoolID FROM schools WHERE SchoolName = '" . $schoolName . "'");
		$result = mysql_query($query);
		if ($row = mysql_fetch_assoc($result)) {
			return $row['SchoolID'];
		} else {
			return "";
		}
	}

	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//closetName: Name of the closet listed in the database
	//schoolName: Name of the school listed in the database
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos the description of a given closet in a given school
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getClosetDesc($closetName, $schoolName) {
		$query = sprintf("SELECT Description FROM closets WHERE ( SchoolName = '" . $schoolName . "' AND Name = '" . $closetName . "' )");
		$result = mysql_query($query);
		if ($row = mysql_fetch_assoc($result)) {
			echo $row['Description'];
		}
	}



	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'parentName' containing each possible parent device in the school
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getParentDD ($schoolName, $type) {
		$query = sprintf("SELECT * FROM closetdevices WHERE School = '" . $schoolName . "'");
		$result = mysql_query($query);
		echo "<select id='parentName' name='parentName'>";
		if ($type == "CD") {
			if ($row = mysql_fetch_assoc($result)) {
				echo "<option>" . $row['Name'] . "</option>";
			} else {
				echo "<option>NO PARENT</option>";
			}
			
			while ($row = mysql_fetch_assoc($result)) {
				echo "<option>" . $row['Name'] . "</option>";
			}
		} else {
			echo "<option></option>";
			while ($row = mysql_fetch_assoc($result)) {
				$closetNum = explode(" ", $row['Closet']);
				echo "<option onClick=\"document.getElementById('closet').value = '" . $closetNum[1] . "';\">" . $row['Name'] . "</option>";
			}
		}
		echo "</select>";
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'equipment' containing each type of closet equipment
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getCDEquipmentDD () {
		$query = sprintf("SELECT * FROM closetequipment");
		$result = mysql_query($query);
		echo "<select name='equipment'>";
		while ($row = mysql_fetch_assoc($result)) {
			echo "<option>" . $row['Name'] . "</option>";
		}
		echo "</select>";
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'equipment' containing each type of end point device equipment
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getEPDEquipmentDD () {
		$query = sprintf("SELECT * FROM endpointequipment");
		$result = mysql_query($query);
		echo "<select name='equipment'>";
		while ($row = mysql_fetch_assoc($result)) {
			echo "<option>" . $row['Name'] . "</option>";
		}
		echo "</select>";
	}
		
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'schoolName' containing each school name in the database
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getSchoolDD() {
		$query = sprintf("SELECT * FROM schools");
		$result = mysql_query($query);
		echo "<select name='schoolName'>";
		while ($row = mysql_fetch_assoc($result)) {
			echo "<option ";
			if (isset($_POST['schoolName'])) { 
				if ($row['SchoolName'] == $_POST['schoolName']) {
					echo "selected";
				}
			}
			echo ">" . $row['SchoolName'] . "</option>";
		}
		echo "</select>";
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'closetName' containing each closet 
	//	name listed in the database under a given school
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getClosetDD() {
		$query = sprintf("SELECT * FROM closets WHERE SchoolName = '" . $_POST['schoolName'] . "'");
		$result = mysql_query($query);
		echo "<select name='closetName'>";
		while ($row = mysql_fetch_assoc($result)) {
			echo "<option ";
			if (isset($_POST['closetName'])) { 
				if ($row['Name'] == $_POST['closetName']) {
					echo "selected";
				}
			}
			echo ">" . $row['Name'] . "</option>";
		}
		echo "</select>";
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'floorName' containing each floor
	// name listed in the database under a given school
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getFloorDD() {
		$query = sprintf("SELECT * FROM floors WHERE SchoolName = '" . $_POST['schoolName'] . "'");
		$result = mysql_query($query);
		echo "<select name='floorName'>";
		while ($row = mysql_fetch_assoc($result)) {
			echo "<option ";
			if (isset($_POST['floorName'])) { 
				if ($row['Name'] == $_POST['floorName']) {
					echo "selected";
				}
			}
			echo ">" . $row['Name'] . "</option>";
		}
		echo "</select>";
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'name' containing each available new floor
	// name listed in the database under a given school
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getNewFloorDD() {
		$numAvailableFloors = 4; //+ Basement and Main Floor
		
		//Create available floors
			$newFloors[] = "Basement";
			$newFloors[] = "Main Floor";
		for ($i = 0; $i < $numAvailableFloors; $i++) {
			$newFloors[] = "Floor " . ($i+2);
		}
		
		
		//See which floors already exist
		$query = sprintf("SELECT * FROM floors WHERE SchoolName = '" . $_POST['schoolName'] . "'");
		$result = mysql_query($query);
		$existingFloors[0] = 0;
		while ($row = mysql_fetch_assoc($result)) {
			$existingFloors[] = $row['Name'];
			$existingFloors[0]++;
		}
		
		//Pull existing floors from new floors list
		for ($i = 0; $i < ($numAvailableFloors+2); $i++) {
			for ($j = 1; $j <= $existingFloors[0]; $j++) {
				if ($newFloors[$i] == $existingFloors[$j]) {$newFloors[$i] = "";}
			}
		}
		
		echo "<select name='name'>";
		for ($i = 0; $i < ($numAvailableFloors+2); $i++) {
			if ($newFloors[$i] != "") {
				echo "<option>" . $newFloors[$i] . "</option>";
			}
		}
		echo "</select>";
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Echos a drop down menu called 'name' containing each available new closet
	// name listed in the database under a given school
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getNewClosetDD() {
		$numAvailableClosets = 20;
		
		//Create available floors
		for ($i = 1; $i <= $numAvailableClosets; $i++) {
			$newClosets[] = "Closet " . $i;
		}		
		
		//See which closets already exist
		$query = sprintf("SELECT * FROM closets WHERE SchoolName = '" . $_POST['schoolName'] . "'");
		$result = mysql_query($query);
		$existingClosets[0] = 0;
		while ($row = mysql_fetch_assoc($result)) {
			$existingClosets[] = $row['Name'];
			$existingClosets[0]++;
		}
		
		//Pull existing floors from new floors list
		for ($i = 0; $i < $numAvailableClosets; $i++) {
			for ($j = 1; $j <= $existingClosets[0]; $j++) {
				if ($newClosets[$i] == $existingClosets[$j]) {$newClosets[$i] = "";}
			}
		}
		
		echo "<select name='name'>";
		for ($i = 0; $i < $numAvailableClosets; $i++) {
			if ($newClosets[$i] != "") {
				echo "<option>" . $newClosets[$i] . "</option>";
			}
		}
		echo "</select>";
	}




	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeEditEPD() {
		
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeEditCD() {
		
	}

	
	
?>