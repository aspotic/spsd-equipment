<?php 
	function doCreateSchool() {
		$query = sprintf("INSERT INTO schools (SchoolName, SchoolID) VALUES ('" . mysql_real_escape_string($_POST['schoolName']) . "', '" . mysql_real_escape_string($_POST['schoolID']) . "')");
		$result = mysql_query($query);
		if (!$result) {
			die("Failed: " . mysql_error());
		}
	}
	
	
	function doCreateFloor() {
		$query = sprintf("INSERT INTO floors (Name, SchoolName) VALUES ('" . mysql_real_escape_string($_POST['name']) . "', '" . mysql_real_escape_string($_POST['schoolName']) . "')");
		$result = mysql_query($query);
		if (!$result) {
			die("Failed: " . mysql_error());
		}
	}
	
	
	function doCreateCloset() {
		$query = sprintf("INSERT INTO closets (Name, SchoolName, Description) VALUES ('" . mysql_real_escape_string($_POST['name'])  . "', '" . mysql_real_escape_string($_POST['schoolName']) . "', '" . mysql_real_escape_string($_POST['description']) . "')");
		$result = mysql_query($query);
		if (!$result) {
			die("Failed: " . mysql_error());
		}
	}
	
	
	function doCreateEPD() {
		//Create the list of fields being edited by querying displayedepdfields
		$numFields = 0;
		$query = sprintf("SELECT * FROM displayedepdfields");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {
			$fields[] = $row['FieldName'];
			$numFields++;
		}
		
		//Create the add item query
		$query = "INSERT INTO endpointdevices (Name, ParentName, School, Floor, Room, Equipment, Closet, Panel, Port ";
		for ($i = 0; $i < $numFields; $i++) {
			$query = $query . ", " . $fields[$i];
		}
		//NEED TO SETUP MODIFIED DATE
		$query = $query . ") VALUES ('" . 	mysql_real_escape_string($_POST['name']) . "', '" . 
											mysql_real_escape_string($_POST['parentName']) . "', '" . 
											mysql_real_escape_string($_POST['schoolName']) . "', '" . 
											mysql_real_escape_string($_POST['floorName']) . "', '" . 
											mysql_real_escape_string($_POST['room']) . "', '" . 
											mysql_real_escape_string($_POST['equipment']) . "', '" . 
											mysql_real_escape_string($_POST['closet']) . "', '" . 
											mysql_real_escape_string($_POST['panel']) . "', '" . 
											mysql_real_escape_string($_POST['port']);
		for ($i = 0; $i < $numFields; $i++) {
		$query = $query . "', '" . mysql_real_escape_string($_POST[$fields[$i]]);
		}
		$query = $query . "')";
		//Put the item in the database
		$result = mysql_query(sprintf($query));
		if (!$result) {
			die("Failed: " . mysql_error() . "<br />" . $query);
		}
	}
	
	
	function doCreateCD() {
		//Create the list of fields being edited by querying displayedcdfields
		$numFields = 0;
		$query = sprintf("SELECT * FROM displayedcdfields");
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {
			$fields[] = $row['FieldName'];
			$numFields++;
		}
		
		//Create the add item query
		if ($_POST['parentName'] == "NO PARENT") {
			$query = "INSERT INTO closetdevices (Name, School, Closet, Equipment";
			for ($i = 0; $i < $numFields; $i++) {
				$query = $query . ", " . $fields[$i];
			}
			$query = $query . ") VALUES ('" . 	mysql_real_escape_string($_POST['name']) . "', '" . 
												mysql_real_escape_string($_POST['schoolName']) . "', '" . 
												mysql_real_escape_string($_POST['closetName']) . "', '" . 
												mysql_real_escape_string($_POST['equipment']);
			for ($i = 0; $i < $numFields; $i++) {
			$query = $query . "', '" . mysql_real_escape_string($_POST[$fields[$i]]);
			}
			$query = $query . "')";
		} else {
			$query = "INSERT INTO closetdevices (Name, ParentName, School, Closet, Equipment";
			for ($i = 0; $i < $numFields; $i++) {
				$query = $query . ", " . $fields[$i];
			}
			$query = $query . ") VALUES ('" . 	mysql_real_escape_string($_POST['name']) . "', '" . 
												mysql_real_escape_string($_POST['parentName']) . "', '" . 
												mysql_real_escape_string($_POST['schoolName']) . "', '" . 
												mysql_real_escape_string($_POST['closetName']) . "', '" . 
												mysql_real_escape_string($_POST['equipment']);
			for ($i = 0; $i < $numFields; $i++) {
			$query = $query . "', '" . mysql_real_escape_string($_POST[$fields[$i]]);
			}
			$query = $query . "')";
		}
		//Put the item in the database
		$result = mysql_query(sprintf($query));
		if (!$result) {
			die("Failed: " . mysql_error());
		}
	}



	function doEditSchool() {
		//edit school name and code
		//edit floors school names and codes
		//edit closets school names and codes
		//edit closet item school names and codes
		//edit floor item school names and codes
	}


	//doEditFloor()


	//doEditCloset()
	
	
	//doEditEPD()
	
	
	//doEditCD()
?>