<?php

include '../../../database/db.php';
include '../class/boxes.php';

$base = new Database;
$db = $base->connect();
$boxes = new Boxes($db);
$boxes->ifIssetBoxes($_POST['dimensione'],$_POST['price']);

?>