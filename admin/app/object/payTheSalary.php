<?php

include '../../../database/db.php';
include '../class/worker.php';

$base = new Database;
$db = $base->connect();
$worker = new Worker($db);
$worker->ifIssetSalary($_POST['workerId'],$_POST['month'],$_POST['year'],$_POST['salary']);

?>