<?php
$pattern = '#^[0-9]+$#';
$routes = [
    // срабатывает при вызове корня или /index.php
    '/' => 'mainview',
	#login
    '/login' => 'login',
	'/add' => 'add',
	'/edit' => 'edit'
];