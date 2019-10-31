<?php
#########
#модель редактора задач
#########
	
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once ($root . '/model/config.php');
	$conn = new mysqli($dblocation, $dbname, $dbpasswd, $dbname);
	$explode_names = $_GET['id'];

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
	$sql = "SELECT * FROM main WHERE id='$explode_names'";

	$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$task_data = $row;
			
			
		}
	} else {
	   header('Location: /');
	}

	if (empty($task_data['statusc'])) {
		$checked = '';
	} else {
		$checked = 'checked';
	}

	$test_edit = $_SESSION['user_id'];
	
	if (empty($_GET['id']) || empty($task_data['id'])) { 
	require_once ($root . '/view/404.view.php');
	exit();
	}
