<?php

include '../../../database/db.php';
include '../class/boxes.php';

$base = new Database;
$db = $base->connect();
$boxes = new Boxes($db);
$boxes->typesOfBoxes();

?>