<?php

include '../../../database/db.php';
include '../class/worker.php';

$base = new Database;
$db = $base->connect();
$worker = new Worker($db);
$worker->edit($_POST['id'],$_POST['email'],$_POST['pass']);

?>