<?php

require "../conf.inc.php";
require "../functions.php";
session_start();


if (isset($_GET["cart"], $_GET["product"])) {

    $cart = $_GET["cart"];
    $product = $_GET["product"];

    $pdo = connectDB();

    $queryPrepared = $pdo->prepare("SELECT productPrice, quantity FROM PRODUCTS, CARTPRODUCT WHERE idProduct = :product AND product = idProduct");
    $queryPrepared->execute([
        ":product" => $product,
    ]);
    $info = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $price = $info["productPrice"];
    $quantity = $info["quantity"];

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

    $queryPrepared = $pdo->prepare("DELETE FROM CARTPRODUCT WHERE cart = :cart AND product = :product");
    $queryPrepared->execute([
        ":cart" => $cart,
        ":product" => $product
    ]);

} else {
    echo "Erreur lors de la modification. Merci de réessayer";

}