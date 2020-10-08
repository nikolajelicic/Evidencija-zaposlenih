<?php

include '../../database/db.php';
include '../class/user.php';

$base = new Database;
$db = $base->connect();
$user = new User($db);
$user->edit($_POST['id'],$_POST['email'],$_POST['pass']);

?>