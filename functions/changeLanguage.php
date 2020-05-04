<?php

session_start();
require "../conf.inc.php";
require "../functions.php";


if(isset($_GET['lang'])){

    $askedLang = $_GET['lang'];
    $pdo = connectDB();
    $query = "UPDATE USER set lang = :lang WHERE idUser = :idUser";
    $queryPrepared = $pdo->prepare($query);
    $queryPrepared->execute([":lang" => $askedLang , ":idUser" => 1]);

    setcookie("Lang",$askedLang,time() + 86400, '/');


}

$url = $_SERVER["HTTP_REFERER"];
header("Location: ".$url);
