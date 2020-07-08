<?php

require "../conf.inc.php";
require "../functions.php";
session_start();


if (isset($_GET["cart"], $_GET["menu"])) {

    $cart = $_GET["cart"];
    $menu = $_GET["menu"];

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE CARTMENU SET quantity = quantity-1 WHERE cart = :cart AND menu = :menu");
    $queryPrepared->execute([
        ":cart" => $cart,
        ":menu" => $menu
    ]);

    $queryPrepared = $pdo->prepare("SELECT menuPrice FROM MENUS WHERE idMenu = :menu");
    $queryPrepared->execute([
        ":menu" => $menu,
    ]);
    $price = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $price = $price["menuPrice"];

    $queryPrepared = $pdo->prepare("SELECT cartPrice FROM CART WHERE idCart = :cart");
    $queryPrepared->execute([
        ":cart" => $cart
    ]);
    $cartPrice = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $cartPrice = $cartPrice["cartPrice"];
    $cartPrice = $cartPrice - $price;

    $queryPrepared = $pdo->prepare("UPDATE CART SET cartPrice = :price WHERE idCart = :cart");
    $queryPrepared->execute([
        ":price" => $cartPrice,
        ":cart" => $cart
    ]);
} else {
    echo "Erreur lors de la modification. Merci de réessayer";
}