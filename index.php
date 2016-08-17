<?php
require_once 'setting.php';
session_start();
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);


// $_SERVER['REQUEST_URI'] - URI, который был передан для того, чтобы получить доступ к этой странице. Например, '/index.html'
// URI - Uniform Resource Identifier — унифицированный (единообразный) идентификатор ресурса
// URL — это URI, который, помимо идентификации ресурса, предоставляет ещё и информацию о местонахождении этого ресурса
if ($_SERVER['REQUEST_URI'] == '/') {
    $Page = 'index';
    $Module = 'index';
} else {
    // парсим путь URL (без домена)
    $URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // обрезаем пробелы и слеши по краям и режем на части, передавая их в массив
    $URL_Parts = explode('/', trim($URL_Path, ' /'));
    // первый элемент массива будет страница
    $Page = array_shift($URL_Parts);
    // второй элемент массива будет модулем
    $Module = array_shift($URL_Parts);

    // если модуль был передан в URL, то извлекаем все параметры в массив $Param
    // например, /register/module/id/1/name/den => [id => 1, name => den]
    if (!empty($Module)) {
        $Param = array();
        for ($i = 0; $i < count($URL_Parts); $i++) {
            $Param[$URL_Parts[$i]] = $URL_Parts[++$i];
        }
    }
}


if ($Page == 'index')
    echo 'Главная';
else if ($Page == 'login')
    include('page/login.php');
else if ($Page == 'register')
    include('page/register.php');