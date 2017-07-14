<?php
if(isset($_POST["id"]))
{
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }
    $mysqli = new mysqli('localhost' , 'root', '', 'members');
    if ($mysqli->connect_error){
        die('Could not connect to database!');
    }
    
    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    
    $statement = $mysqli->prepare("SELECT id FROM tblmembers WHERE id=".$id);
   // $statement->bind_param('id', $id);
    $statement->execute();
    $statement->bind_result($id);
    if($statement->fetch()){
        die('<img src="not-available.png" height="20" width="20" />');
    }else{
        die('<img src="available.png" height="20" width="20" />');
    }
}
?>