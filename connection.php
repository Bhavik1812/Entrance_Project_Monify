<?php
Class dbObj{
	/* Database connection start */
	var $servername = "localhost";
	var $username = "root";
	var $password = "";
	var $dbname = "members";
	var $conn;
	
	function getConnstring() {
		$con = new mysqli($this->servername, $this->username, $this->password);
		/* check connection */
		if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
else {
			
			if(mysqli_select_db($con,'members')){
				
				$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());
				$this->conn = $con;
			}
			else
			{
				$sql = "CREATE DATABASE members";
				if ($con->query($sql) === TRUE) {
                // echo "Database created successfully";
				 
					$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
						// sql to create table
					$sql = "CREATE TABLE tblmembers (
					id INT(6) UNSIGNED PRIMARY KEY, 
					lastname VARCHAR(30) NOT NULL,
					firstname VARCHAR(30) NOT NULL,
					email VARCHAR(50),
					telephone VARCHAR(50),
					dob VARCHAR(50),
					address VARCHAR(50),
					city VARCHAR(50),
					province VARCHAR(50),
					postalcode VARCHAR(50)
					)";

				if ($con->query($sql) === TRUE) {
					//echo "Table tblMembers created successfully";
					// Loading the XML file
					$xml = simplexml_load_file("members.xml");
				//	echo "<h2>".$xml->getName()."</h2><br />";
					foreach($xml->children() as $member)
					{
						$sql="insert into tblMembers(id,lastname,firstname,email,telephone,dob,address,city,province,postalcode)values('".$member->attributes()->id."','".$member->lastname."','".$member->firstname."','".$member->email."','".$member->telephone."','".$member->dob."','".$member->address."','".$member->city."','".$member->province."','".$member->{'postal-code'}."')";
						$con->query($sql);
					}
					} else {
						echo "Error creating table: " . $conn->error;
					}
					
					$sql = "CREATE TABLE tbldeletedmembers (
					id INT(6) UNSIGNED PRIMARY KEY, 
					lastname VARCHAR(30) NOT NULL,
					firstname VARCHAR(30) NOT NULL,
					email VARCHAR(50),
					telephone VARCHAR(50),
					dob VARCHAR(50),
					address VARCHAR(50),
					city VARCHAR(50),
					province VARCHAR(50),
					postalcode VARCHAR(50)
					)";

				if ($con->query($sql) === TRUE) {
					} else {
						echo "Error creating table: " . $conn->error;
					}
             } 
			$this->conn = mysqli_connect($this->servername, $this->username, $this->password, "members") or die("Connection failed: " . mysqli_connect_error());
			}
			
			
		}
		return $this->conn;
	}
	
}

?>