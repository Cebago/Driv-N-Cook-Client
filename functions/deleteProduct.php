<?php

require "../conf.inc.php";
require "../functions.php";
session_start();


if (isset($_GET["cart"], $_GET["product"])){

    $cart = $_GET["cart"];
    $product = $_GET["product"];

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE CARTPRODUCT SET quantity = quantity-1 WHERE cart = :cart AND product = :product");
    $queryPrepared->execute([
        ":cart" => $cart,
        ":product" => $product
    ]);

    $queryPrepared = $pdo->prepare("SELECT productPrice FROM PRODUCTS WHERE idProduct = :product");
    $queryPrepared->execute([
        ":product" => $product,
    ]);
    $price = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $price = $price["productPrice"];

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
}else{
    echo "Erreur lors de la modification. Merci de réessayer";
}