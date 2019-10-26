<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once ($root . '/model/config.php');
	
	$link = mysqli_connect($dblocation, $dbname, $dbpasswd, $dbname);
	$errorMSG = "";


if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}


if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}


if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $text = $_POST["message"];
}


$result = mysqli_query($link, "INSERT INTO main (name, email, text) VALUES ('$name', '$email', '$text')");


// redirect to success page
if ($result && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>