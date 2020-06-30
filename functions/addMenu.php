<?php

require "../conf.inc.php";
require "../functions.php";
session_start();

if (isset($_GET["menu"]) && isset($_GET["cart"])) {
    $idCart = $_GET["cart"];
    $idMenu = $_GET["menu"];
    $email = $_SESSION["email"];

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("INSERT INTO CARTMENU (cart,menu,quantity) VALUES (:cart,:menu,1) ON DUPLICATE KEY UPDATE quantity = quantity + 1;");
    $queryPrepared->execute([
        ":cart" => $idCart,
        ":menu" => $idMenu
    ]);

} else {
    echo "Erreur lors de la modification. Merci de réessayer";
}
