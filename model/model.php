<?php
	
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once ($root . '/model/config.php');
	$conn = new mysqli($dblocation, $dbname, $dbpasswd, $dbname);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	
		session_start();
	#$test = $_SESSION['query_sql'];
	if ($_SESSION['query_sql'] == 'nameu') {
		$sort = 'DESC';
		$cell = 'name';
	}
	elseif ($_SESSION['query_sql'] == 'namev') {
		$cell = 'name';
		$sort = 'ASC';
	}
	elseif ($_SESSION['query_sql'] == 'emailu') {
		$cell = 'email';
		$sort = 'DESC';
	}
	elseif ($_SESSION['query_sql'] == 'emailv') {
		$cell = 'email';
		$sort = 'ASC';
	}
	elseif ($_SESSION['query_sql'] == 'statusu') {
		$cell = 'statusc';
		$sort = 'ASC';
	}
	elseif ($_SESSION['query_sql'] == 'statusv') {
		$cell = 'statusc';
		$sort = 'DESC';
	}
	elseif ($_SESSION['query_sql'] == 'id') {
		$cell = 'statusc';
		$sort = 'DESC';
	}
	#print_r($_SESSION['query_sql']);
	$query = 'ORDER by '.$cell.' '.$sort;	
	$sql = "SELECT * FROM main $query";
	$result = $conn->query($sql);
	#$#$data_jobs = [];
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$tmp_jobs['id'][] = $row["id"];
		$tmp_jobs['email'][] = $row["email"];
		$tmp_jobs['name'][] = $row["name"];
		$tmp_jobs['text'][] = $row["text"];
		$tmp_jobs['statused'][] = $row["statused"];
		$tmp_jobs['statusc'][] = $row["statusc"];
        
    }
} else {
    echo "0 results";
}

for ($i=0; ; $i++)
{
	if ($i == count($tmp_jobs['id'])) {
        break;
    }
	$data_jobs[$i]['id'] = $tmp_jobs['id'][$i];
	$data_jobs[$i]['email'] = $tmp_jobs['email'][$i];
	$data_jobs[$i]['name'] = $tmp_jobs['name'][$i];
	$data_jobs[$i]['text'] = $tmp_jobs['text'][$i];
	$data_jobs[$i]['statused'] = $tmp_jobs['statused'][$i];
	$data_jobs[$i]['statusc'] = $tmp_jobs['statusc'][$i];
}
$data_jobs = array_reverse($data_jobs);
$conn->close();
#print_r($data_jobs);
