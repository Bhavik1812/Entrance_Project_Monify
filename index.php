<!-- Entrance Project
Developed by : Bhavik Desai
Created Date : July 12, 2017
Submitted on : July 13, 2017 -->
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
<!--<script src="dist/custom.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {
	var grid = $("#member_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "response.php",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
        //alert("You pressed edit on row: " + $(this).data("row-id"));
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();
            var g_name = $(this).parent().siblings(':nth-of-type(2)').html();
console.log(g_id);
                    console.log(g_name);

		//console.log(grid.data());//
		$('#edit_model').modal('show');
					if($(this).data("row-id") >0) {
							
                                // collect the data
                                $('#edit_id').val(ele.siblings(':first').html()); // in case we're changing the key
                                $('#edit_lastname').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_firstname').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_email').val(ele.siblings(':nth-of-type(4)').html());
								$('#edit_telephone').val(ele.siblings(':nth-of-type(5)').html());
								$('#edit_dob').val(ele.siblings(':nth-of-type(6)').html());
								$('#edit_address').val(ele.siblings(':nth-of-type(7)').html());
								$('#edit_city').val(ele.siblings(':nth-of-type(8)').html());
								$('#edit_province').val(ele.siblings(':nth-of-type(9)').html());
								$('#edit_postalcode').val(ele.siblings(':nth-of-type(10)').html());
					} else {
					 alert('Now row selected! First select row, then click edit button');
					}
    }).end().find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
					alert(conf);
                    if(conf){
                                $.post('response.php', { id: $(this).data("row-id"), action:'delete'}
                                    , function(success){
										//alert(success);
                                        // when ajax returns (callback), 
										$("#member_grid").bootgrid('reload');
										$("#delmember_grid").bootgrid('reload');
										$("#viewmember_grid").bootgrid('reload');
                                }); 
								//$(this).parent('tr').remove();
								//$("#employee_grid").bootgrid('remove', $(this).data("row-id"))
                    }
    });
});

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

function validatePostalcode(postalcode) {
    var filter = /^[A-Z][1-9][A-Z](-|\s){0,1}[1-9][A-Z][1-9]$/;
    if (filter.test(postalcode)) {
        return true;
    }
    else {
        return false;
    }
}

function ajaxAction(action) {
	
	 var id = document.getElementById("id").value;
	 var firstname = document.getElementById("firstname").value;
	 var lastname = document.getElementById("lastname").value;
	 var email = document.getElementById("email").value;
	 var telephone = document.getElementById("telephone").value;
	 var dob = document.getElementById("dob").value;
	 var address = document.getElementById("address").value;
	 var city = document.getElementById("city").value;
	 var province = document.getElementById("province").value;
	 var postalcode = document.getElementById("postalcode").value;
         //alert("id:" + document.getElementById("name"));
        // alert("name:" +name);
          
          //alert("email:" +email);
        
         //alert("comment:" +comment);
		 if(firstname==""||lastname=="" || email=="" || telephone==""|| dob==""|| address==""|| city==""|| province==""|| postalcode==""|| !validateEmail(email)||!validatePostalcode(postalcode))
		 {
			
			  var messageAlert = 'alert-danger';
			  if(email !="" && !validateEmail(email) )
			  { 
				var messageText = "Please enter valid Email";   
			  }
			  else if(postalcode !="" && !validatePostalcode(postalcode))
			  {
				  var messageText = "Please enter valid PostalCode";  
			  }
              else
              {
                var messageText = "Please fill all fields"; 
              }		  
			  
			  var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
              if (messageAlert && messageText) {
                  // alert(document.getElementById('msg'));
                  $('#frm_add').find('#msg').html(alertBox);
				   $('#msg').fadeIn(3000);
				   $('#msg').delay(4000).fadeOut(300); 
                 // $('#contactusform')[0].reset();
				 
              }
			   
			  
		 }
		 else{ 
				data = $("#frm_"+action).serializeArray();
				
				$.ajax({
				  type: "POST",  
				  url: "response.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
					 
					$('#'+action+'_model').modal('hide');
					$("#member_grid").bootgrid('reload');
					$("#viewmember_grid").bootgrid('reload');
				  }   
				});
		 }
}
			
		var grid1 = $("#delmember_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "response.php?action=delmembers",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
   // $("#delmember_grid").bootgrid('reload');
});

var grid2 = $("#viewmember_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "response.php?action=viewmembers",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
   // $("#delmember_grid").bootgrid('reload');
});

			
			$( "#command-add" ).click(function() {
				
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
				
			  ajaxAction('add');
			});
			$( "#btn_edit" ).click(function() {
			  ajaxAction('edit');
			});
			$( "#command-del" ).click(function() {
			 $('#deleted_model').modal('show');
			});
			$( "#command-view" ).click(function() {
			 $("#viewmember_grid").bootgrid('reload');	
			 $('#view_model').modal('show');
			});
});


</script>
<script type="text/javascript">
$(document).ready(function() {
    var x_timer;    
    $("#id").keyup(function (e){
        clearTimeout(x_timer);
        var user_name = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(user_name);
        }, 1000);
    }); 

function check_username_ajax(id){
    $("#user-result").html('<img src="ajax-loader.gif" height="20" width="20" />');
    $.post('id-checker.php', {'id':id}, function(data) {
		
      $("#user-result").html(data);
    });
}
});
</script>
</head>

<body>
<div class="container">
      <div class="">
        <h1>Entrance Project</h1>
		<h2>Developed by Bhavik Desai</h2>
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
