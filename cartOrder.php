<?php
session_start();
require 'conf.inc.php';
require 'functions.php';
include 'header.php';

$pdo = connectDB();
$queryPrepared = $pdo->prepare("SELECT menuName, menuImage, menuPrice, idMenu FROM MENUS");
$queryPrepared->execute();
$result = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

?>

