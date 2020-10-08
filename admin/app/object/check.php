<?php

include '../../../database/db.php';
include '../class/boxes.php';

$base = new Database;
$db = $base->connect();
$boxes = new Boxes($db);
$boxes->check($_POST['month'],$_POST['year'],$_POST['number'],$_POST['id']);

?>