<?php

	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once ($root . '/model/config.php');
	
	$link = mysqli_connect($dblocation, $dbname, $dbpasswd, $dbname);
	$errorMSG = "";
	
	if (empty($_POST["id"])) {
		$errorMSG = "Name is required ";
	} else {
		$id = $_POST["id"];
	}
	
	$result = mysqli_query($link, "SELECT * FROM main WHERE id='$id'");
	
	if (mysqli_num_rows($result)==true)
	{
		mysqli_query($link, "DELETE FROM main WHERE id='$id'");	
		
	}
	else
	{
		exit;		
	}