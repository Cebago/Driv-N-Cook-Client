<?php

require "../conf.inc.php";
require "../functions.php";
session_start();


if (isset($_GET["cart"], $_GET["menu"])){

    $cart = $_GET["cart"];
    $menu = $_GET["menu"];

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("DELETE FROM CARTMENU WHERE cart = :cart AND menu = :menu");
    $queryPrepared->execute([
        ":cart" => $cart,
        ":menu" => $menu
    ]);

}else{
    echo "Erreur lors de la modification. Merci de réessayer";

}