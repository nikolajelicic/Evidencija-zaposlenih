<?php

include '../../../database/db.php';
include '../class/worker.php';

$base = new Database;
$db = $base->connect();
$worker = new Worker($db);
$worker->ifIssetEmail($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['pass'],$_POST['workPlaces']);

?>