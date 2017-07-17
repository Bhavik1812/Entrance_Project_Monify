<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Members</title>
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<script src="dist/custom.js"></script> 

</head>

<body>
<div class="container">
      <div class="">
        <h1>Manage Members</h1>
        <div class="col-sm-12">
		<div class="well clearfix">
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
			<span class="glyphicon glyphicon-plus"></span> Record</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-del" data-row-id="0">
			<span class="glyphicon glyphicon-trash"></span>Deleted Members</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-view" data-row-id="0">
			<span class="glyphicon glyphicon-list-alt"></span>View Last 100 from each province</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>			
			</div>
		<table id="member_grid" class="table table-condensed table-hover table-striped" width="80%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
					<th data-column-id="lastname">LastName</th>
					<th data-column-id="firstname">FirstNAme</th>
					<th data-column-id="email">Email</th>
					<th data-column-id="telephone">Telephone</th>
					<th data-column-id="dob">DOB</th>
					<th data-column-id="address">Address</th>
					<th data-column-id="city">City</th>
					<th data-column-id="province">Province</th>
					<th data-column-id="postalcode">PostalCode</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
<div id="view_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">	
		   <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Last 100 members from each province</h4>
            </div>
		  <div class="container">
      <div class="">
       
        <div class="col-sm-6">
		<table id="viewmember_grid" class="table table-condensed table-hover table-striped" width="80%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
					<th data-column-id="lastname">LastName</th>
					<th data-column-id="firstname">FirstNAme</th>
					<th data-column-id="email">Email</th>
					
					<th data-column-id="address">Address</th>
					<th data-column-id="city">City</th>
					<th data-column-id="province">Province</th>
					
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
        </div>
    </div>
</div>			
<div id="deleted_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">	
		   <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Deleted Members</h4>
            </div>
		  <div class="container">
      <div class="">
       
        <div class="col-sm-6">
		<table id="delmember_grid" class="table table-condensed table-hover table-striped" width="80%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
					<th data-column-id="lastname">LastName</th>
					<th data-column-id="firstname">FirstNAme</th>
					<th data-column-id="email">Email</th>
					
					<th data-column-id="address">Address</th>
					<th data-column-id="city">City</th>
					<th data-column-id="province">Province</th>
					
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
        </div>
    </div>
</div>		
<div id="add_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Member</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_add">
				<div class="col-md-12 col-sm-12"><div id="msg"></div></div>
				<input type="hidden" value="add" name="action" id="action">
                  <div class="form-group">
                    <label for="id" class="control-label">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" required />
                  </div>
				   <div class="form-group">
				     <span id="user-result"></span>
				   </div>
                  <div class="form-group">
                    <label for="lastname" class="control-label">Lastname:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required />
                  </div>
				  <div class="form-group">
                    <label for="firstname" class="control-label">Firstname:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required />
                  </div>
				   <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required />
                  </div>
				  <div class="form-group">
                    <label for="telephone" class="control-label">Telephone:</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" required />
                  </div>
                   <div class="form-group">
                    <label for="dob" class="control-label">Dob:</label>
                    <input type="text" class="form-control" id="dob" name="dob" required />
                  </div>
                  <div class="form-group">
                    <label for="address" class="control-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" required />
                  </div>
                  <div class="form-group">
                    <label for="city" class="control-label">City:</label>
                    <input type="text" class="form-control" id="city" name="city" required />
                  </div>
                  <div class="form-group">
                    <label for="province" class="control-label">Province:</label>
                    <input type="text" class="form-control" id="province" name="province" required />
                  </div>
                  <div class="form-group">
                    <label for="postalcode" class="control-label">Postalcode:</label>
                    <input type="text" class="form-control" id="postalcode" name="postalcode" required />
                  </div>				  
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Member</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="id" id="id">
                 <div class="form-group">
                    <label for="id" class="control-label">ID:</label>
                    <input type="text" class="form-control" id="edit_id" name="edit_id"/>
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="control-label">Lastname:</label>
                    <input type="text" class="form-control" id="edit_lastname" name="edit_lastname"/>
                  </div>
				  <div class="form-group">
                    <label for="firstname" class="control-label">Firstname:</label>
                    <input type="text" class="form-control" id="edit_firstname" name="edit_firstname"/>
                  </div>
				   <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="edit_email" name="edit_email"/>
                  </div>
				  <div class="form-group">
                    <label for="telephone" class="control-label">Telephone:</label>
                    <input type="text" class="form-control" id="edit_telephone" name="edit_telephone"/>
                  </div>
                   <div class="form-group">
                    <label for="dob" class="control-label">Dob:</label>
                    <input type="text" class="form-control" id="edit_dob" name="edit_dob"/>
                  </div>
                  <div class="form-group">
                    <label for="address" class="control-label">Address:</label>
                    <input type="text" class="form-control" id="edit_address" name="edit_address"/>
                  </div>
                  <div class="form-group">
                    <label for="city" class="control-label">City:</label>
                    <input type="text" class="form-control" id="edit_city" name="edit_city"/>
                  </div>
                  <div class="form-group">
                    <label for="province" class="control-label">Province:</label>
                    <input type="text" class="form-control" id="edit_province" name="edit_province"/>
                  </div>
                  <div class="form-group">
                    <label for="postalcode" class="control-label">Postalcode:</label>
                    <input type="text" class="form-control" id="edit_postalcode" name="edit_postalcode"/>
                  </div>		
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_edit" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>
<?php
/*$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(mysqli_select_db($conn,'members')){
$conn = new mysqli($servername, $username, $password,'members');   
$sql = "SELECT * FROM tblMembers";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-bordered'>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>lastname</th>";
                echo "<th>firstname</th>";
                echo "<th>email</th>";
				echo "<th>telephone</th>";
				echo "<th>dob</th>";
				echo "<th>address</th>";
				echo "<th>city</th>";
			    echo "<th>province</th>";
			    echo "<th>postalcode</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['telephone'] . "</td>";
				echo "<td>" . $row['dob'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['city'] . "</td>";
				echo "<td>" . $row['province'] . "</td>";
				echo "<td>" . $row['postalcode'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
		
        // Free result set
        mysqli_free_result($result);
		
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
}else{
// Create database
$sql = "CREATE DATABASE members";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
$conn1 = new mysqli($servername, $username, "", "members");	
	// sql to create table
$sql = "CREATE TABLE tblMembers (
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

if ($conn1->query($sql) === TRUE) {
    echo "Table tblMembers created successfully";
	// Loading the XML file
    $xml = simplexml_load_file("members.xml");
    echo "<h2>".$xml->getName()."</h2><br />";
    foreach($xml->children() as $member)
    {
	    $sql="insert into tblMembers(id,lastname,firstname,email,telephone,dob,address,city,province,postalcode)values('".$member->attributes()->id."','".$member->lastname."','".$member->firstname."','".$member->email."','".$member->telephone."','".$member->dob."','".$member->address."','".$member->city."','".$member->province."','".$member->{'postal-code'}."')";
		$conn1->query($sql);
        echo "member : ".$member->attributes()->id."<br />";
        echo "Lastname : ".$member->lastname." <br />";
        echo "Firstname : ".$member->firstname." <br />";
        echo "Email : ".$member->email." <br />";
        echo "Telephone : ".$member->telephone." <br />";
        echo "Dob : ".$member->dob." <br />";
        echo "Address : ".$member->address." <br />";
		echo "City : ".$member->city." <br />";
		echo "Province : ".$member->province." <br />";
		echo "PostalCode : ".$member->{'postal-code'}." <br />";
        echo "<hr/>";
    }
} else {
    echo "Error creating table: " . $conn->error;
}
} 
}




$conn->close(); */
?>



</body>
</html>
