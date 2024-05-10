<?php

require_once './Database/Query.php';
session_start();
$queryOb = new Query();

if (isset($_POST['submit'])) {
  $queryOb->insertStock($_POST['name'], $_POST['price'], $_SESSION['userEmail']);
}

$result = $queryOb->fetchStock($_SESSION['userEmail']);
