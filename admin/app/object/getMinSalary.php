<?php

include '../../../database/db.php';
include '../class/salary.php';

$base = new Database;
$db = $base->connect();
$salary = new Salary($db);
$salary->getMinSalary();

?>