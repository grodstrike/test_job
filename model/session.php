<?php

session_start();
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
		} else {
			$_SESSION['query_sql'] = $_POST["name"];
			
		}
		
	
if (!empty($_SESSION['query_sql']))
{
	echo 'success';
}