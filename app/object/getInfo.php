<?php

include '../../database/db.php';
include '../class/user.php';

$base = new Database;
$db = $base->connect();
$user = new User($db);
$user->getInfo($_POST['id']);

?>