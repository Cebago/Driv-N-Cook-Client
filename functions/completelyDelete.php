<?php

require "../conf.inc.php";
require "../functions.php";
session_start();


if (isset($_GET["cart"], $_GET["menu"])){

    $cart = $_GET["cart"];
    $menu = $_GET["menu"];

    $pdo = connectDB();


    $queryPrepared = $pdo->prepare("SELECT menuPrice, quantity FROM MENUS, CARTMENU WHERE idMenu = :menu AND menu = idMenu");
    $queryPrepared->execute([
        ":menu" =>$menu,
    ]);
    $info = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $price = $info["menuPrice"];
    $quantity = $info["quantity"];

    $price = $quantity * $price;

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

    $queryPrepared = $pdo->prepare("DELETE FROM CARTMENU WHERE cart = :cart AND menu = :menu");
    $queryPrepared->execute([
        ":cart" => $cart,
        ":menu" => $menu
    ]);

}else{
    echo "Erreur lors de la modification. Merci de réessayer";

}