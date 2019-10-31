<?php
function getRequestPath() {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    return '/' . ltrim(str_replace('index.php', '', $path), '/');
}
function getMethod(array $routes, $path) {
    // перебор всех маршрутов
    foreach ($routes as $route => $method) {
        // если маршрут сопадает с путем, возвращаем функцию
        if ($path === $route) {
            return $method;
        }
    }

    return 'notFound';
}
function add() {
	include './view/header.php';
	include './view/add.view.php';
	include './view/footer.php';
}
function login() {
	include './view/header.php';
	include './view/login.view.php';
	include './view/footer.php';
}
function mainview() {
	include './view/header.php';
	include ('./model/model.php');
	include './view/main.view.php';
	include './view/footer.php';
}

function edit() {
	include './view/header.php';
	include './model/edit.php';
	session_start();
	if (Auth\User::isAuthorized()){
	include './view/edit.view.php';
	} else {
		include './view/edit404.view.php';
	}
	include './view/footer.php';
}

function notFound() {
    header("HTTP/1.0 404 Not Found");
	include './view/header.php';
     include './view/404.view.php';
}

