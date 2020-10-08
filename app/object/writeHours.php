<?php

include '../../database/db.php';
include '../class/user.php';

$base = new Database;
$db = $base->connect();
$user = new User($db);
$user->ifIsset($_POST['month'],$_POST['year'],$_POST['hours'],$_POST['id']);

?>