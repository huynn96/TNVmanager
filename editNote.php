<?php
	$id = $_POST["id"];
	$so_cmt = $_POST["so_cmt"];
	include_once("connect_db.php");
	if (isset($_POST["notes"])){
		$note = $_POST["notes"]; 
	    $sql = "UPDATE tnv_nghien_cuu SET note='$note' WHERE id='$id' AND so_cmt='$so_cmt'";
	    $query = mysql_query($sql);
 	}
 	else{
 		$sql = "SELECT * FROM tnv_nghien_cuu WHERE id='$id' AND so_cmt='$so_cmt'";
    	$query = mysql_query($sql);
    	$row = mysql_fetch_array($query);
    	echo $row["note"];
 	}
?>