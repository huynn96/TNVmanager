<?php
	include_once("connect_db.php") ;
	$cmt = $_GET["tnv"];
	echo $cmt;

	$sql = "DELETE FROM tinh_nguyen_vien WHERE so_cmt = '$cmt'";
	$query = mysql_query($sql);

	$sql = "DELETE FROM tnv_nghien_cuu WHERE so_cmt = '$cmt'";
	$query = mysql_query($sql);
	header("location: index.php");
?>