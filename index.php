<?php

$url = $_SERVER['REQUEST_URI'];
$urlArr = explode('/',$url);
$route = '';
if (strpos($urlArr[1],'?')) {
  $urlNew = explode('?',$urlArr[1]);
  $route = $urlNew[0];
}
else {
  $route = $urlArr[1];
}

switch ($route) {
  case '':
    require './LoginSignup/login.php';
    break;
  case 'login':
    require './LoginSignup/login.php';
    break;
  case 'register':
    require './LoginSignup/registration.php';
    break;
  case 'dashboard':
    require './Dashboard/dashboard.php';
    break;
  case 'enterstock':
    require './Dashboard/stockEntry.php';
    break;
}
