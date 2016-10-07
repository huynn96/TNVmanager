<?php
	$connect_db = mysql_connect("localhost", "root", "");
    $select_db = mysql_select_db("tnv_manager", $connect_db);
    $set_lang = mysql_query("SET NAMES 'utf8'"); 
?>