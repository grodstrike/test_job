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
if (empty($_POST["id"])) {
    $errorMSG .= "id is required ";
} else {
    $id = $_POST["id"];
}

if (empty($_POST["session"])) {
    $errorMSG .= "id is required ";
} else {
    $session = $_POST["session"];
}

if (empty($_POST["checked"])) {
    $checked = ',statusc=0';
} else {
    $checked = ',statusc=1';
}
session_start();

if (!empty($_SESSION['user_id'])) {
$result = mysqli_query($link, "UPDATE main SET name='$name', text='$text', email='$email', statused='1'".$checked." WHERE id='$id'");

}
else 
{
	echo 'Вы не авторизованы. Перейдите на страницу авторазации для редактирования.';
}
// redirect to success page
if ($result && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo ' Что-то пошло не так :(';
    } else {
        echo $errorMSG;
    }
}

?>