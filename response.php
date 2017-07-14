
<?php
	//include connection file 
	include_once("connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();
 //   echo $connString;
	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Member($connString);
    
	switch($action) {
	 case 'add':
		$empCls->insertMember($params);
	 break;
	 case 'edit':
		$empCls->updateMember($params);
	 break;
	 case 'delete':
		$empCls->deleteMember($params);
	 break;
	 case 'delmembers':
		$empCls->getDeletedMember($params);
	 break;
	 case 'viewmembers':
		$empCls->getLastMember($params);
	 break;
	 default:
	 $empCls->getMember($params);
	 return;
	}
	
	class Member {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getMember($params) {
		
		$this->data = $this->getRecords($params);
		
		echo json_encode($this->data);
	}
	public function getDeletedMember($params) {
		
		$this->data = $this->getDeletedRecords($params);
		
		echo json_encode($this->data);
	}
	public function getLastMember($params) {
		
		$this->data = $this->getLastRecords($params);
		
		echo json_encode($this->data);
	}
	function insertMember($params) {
		$data = array();;
		$sql = "INSERT INTO `tblmembers` (id,lastname,firstname,email,telephone,dob,address,city,province,postalcode) VALUES('" . $params["id"] . "', '" . $params["lastname"] . "','" . $params["firstname"] . "','" . $params["email"] . "','" . $params["telephone"] . "','" . $params["dob"] . "','" . $params["address"] . "','" . $params["city"] . "','" . $params["province"] . "','" . $params["postalcode"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert employee data");
		
	}
	
	
	function getRecords($params) {
		//echo "in";
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( province LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR city LIKE '".$params['searchPhrase']."%' ";

			$where .=" OR firstname LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `tblmembers` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot employees data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	
	function getDeletedRecords($params) {
		//echo "in";
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( province LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR city LIKE '".$params['searchPhrase']."%' ";

			$where .=" OR firstname LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `tbldeletedmembers` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot employees data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	function getLastRecords($params) {
		//echo "in";
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( province LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR city LIKE '".$params['searchPhrase']."%' ";

			$where .=" OR firstname LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT
    id,lastname,firstname,email,address,city,province
FROM
    (SELECT
            id,
            lastname,
			firstname,
			email,
			address,
			city,
            province,
            @rn:=CASE
                WHEN @var_customer_id = province THEN @rn + 1
                ELSE 1
            END AS rn,
            @var_customer_id:=province
    FROM
        (SELECT @var_customer_id:=NULL, @rn:=NULL) vars, tblmembers
        WHERE
        province IN (SELECT province FROM tblmembers)
    ORDER BY province,id DESC) as sub_table
WHERE
    rn <= 100
ORDER BY province,id asc";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot employees data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	
	function updateMember($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update `tblmembers` set lastname = '" . $params["edit_lastname"] . "', firstname='" . $params["edit_firstname"]."', email='" . $params["edit_email"] . "', telephone='" . $params["edit_telephone"] . "', dob='" . $params["edit_dob"] . "', address='" . $params["edit_address"] . "', city='" . $params["edit_city"] . "', province='" . $params["edit_province"] . "', postalcode='" . $params["edit_postalcode"] . "' WHERE id='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
	}
	
	function deleteMember($params) {
		$data = array();
		//print_R($_POST);die;
		$query="select * from `tblmembers` where id='".$params["id"]."'";
		if ($result=mysqli_query($this->conn,$query))
  {
		 while ($nt=mysqli_fetch_row($result)) {
			    print_r($nt);
                $sql = "INSERT INTO `tbldeletedmembers` (id,lastname,firstname,email,telephone,dob,address,city,province,postalcode) VALUES('" . $nt[0] . "', '" . $nt[1] . "','" . $nt[2] . "','" . $nt[3] . "','" . $nt[4] . "','" . $nt[5] . "','" . $nt[6] . "','" . $nt[7] . "','" . $nt[8] . "','" . $nt[9] . "')";
		
		        echo $result = mysqli_query($this->conn, $sql) or die("error to insert member data");
  }}
		$sql = "delete from `tblmembers` WHERE id='".$params["id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete member data");
	}
} 
?>
	