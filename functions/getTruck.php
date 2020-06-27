<?php
session_start();
require "../conf.inc.php";
require "../functions.php";
header('content-type:application/json');

$pdo = connectDB();

$queryPrepared = $pdo->prepare("SELECT truckName, status, categorie, truckPicture, lat, lng, idTruck from TRUCK, TRUCKSTATUS, LOCATION WHERE TRUCKSTATUS.truck = idTruck AND LOCATION.truck = idTruck;");
$queryPrepared->execute();

$result = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);;

