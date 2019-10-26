<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once ($root . '/controller/routes.php');
require_once ($root . '/controller/controller.php');





// получаем путь запроса
$path = getRequestPath();
// получаем функцию обработчик
$method = getMethod($routes, $path);
// отдаем данные клиенту
echo $method();


