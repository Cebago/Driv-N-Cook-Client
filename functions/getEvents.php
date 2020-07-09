<?php

require "../conf.inc.php";
require "../functions.php";

$pdo = connectDB();
$queryPrepared = $pdo->prepare("SELECT idEvent, eventDesc, truckName, eventImg, eventType, eventName, eventAddress, eventCity, eventPostalCode, eventBeginDate, eventEndDate, eventStartHour, eventEndHour FROM EVENTS, HOST, TRUCK WHERE event = idEvent AND truck = idTruck AND eventType = 'Dégustation'");
$queryPrepared->execute();

$events = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events);