<?php
include '../../../database/db.php';
include '../class/workPlaces.php';

$base = new Database;
$db = $base->connect();
$worker = new WorkPlaces($db);
$worker->infoWorkPlaces();

?>