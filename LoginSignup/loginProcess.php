<?php
session_start();
require './Database/Query.php';

if (isset($_SESSION['flag'])) {
  header('location: /dashboard');
  exit();
}
if (isset($_POST['login'])) {
  $emailUser = $_POST['emailUser'];
  $password = $_POST['password'];
  $obLogin = new Query();
  $isSignUp = $obLogin->LoginSelect($emailUser);

  if (password_verify($password, $isSignUp) && $isSignUp) {
    $_SESSION['flag'] = 1;
    $_SESSION['userEmail'] = $emailUser;
    header('location: /dashboard');
    exit();
  }
  else {
    session_destroy();
    $isSignUp = FALSE;
  }
}
