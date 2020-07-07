<?php

require "../conf.inc.php";
require "../functions.php";
session_start();

if (isset($_GET["menu"]) && isset($_GET["cart"]) && isset($_GET["total"])) {
    $idCart = $_GET["cart"];
    $idMenu = $_GET["menu"];
    $total = $_GET["total"];
    $email = $_SESSION["email"];

    $pdo = connectDB();

    $queryPrepared = $pdo->prepare("SELECT truck FROM MENUS WHERE idMenu = :menu;");
    $queryPrepared->execute([
        ":menu" => $idMenu
    ]);
    $idTruck = $queryPrepared->fetch(PDO::FETCH_ASSOC);

    $queryPrepared = $pdo->prepare("SELECT truck FROM CARTMENU, MENUS WHERE cart = :cart AND menu = idMenu AND truck != :truck ;");
    $queryPrepared->execute([
        ":cart" => $idCart,
        ":truck" => $idTruck["truck"]
    ]);
    $menuInCart = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($menuInCart)) {
        echo "Vous ne pouvez pas ajouter un menu provenant d'un autre camion";
    } else {
        $queryPrepared = $pdo->prepare("INSERT INTO CARTMENU (cart,menu,quantity) VALUES (:cart,:menu,1) ON DUPLICATE KEY UPDATE quantity = quantity + 1;");
        $queryPrepared->execute([
            ":cart" => $idCart,
            ":menu" => $idMenu
        ]);
    }

    $queryPrepared = $pdo->prepare("UPDATE CART SET cartPrice = :price WHERE idCart = :cart;");
    $queryPrepared->execute([
        ":price" => $total,
        ":cart" => $idCart
    ]);
    $total = $queryPrepared->fetch(PDO::FETCH_ASSOC);

} else {
    echo "Erreur lors de la modification. Merci de réessayer";
}
