<?php
session_start();
require "../conf.inc.php";
require "../functions.php";


if (isConnected() && isActivated()) {
    if (count($_POST) >= 5 && isset($_POST["cardNumber"], $_POST["username"],
            $_POST["month"], $_POST["year"], $_POST["ccv"])) {

        $cardNumber = $_POST["cardNumber"];
        $username = trim($_POST["username"]);
        $month = $_POST["month"];
        $year = $_POST["year"];
        $ccv = $_POST["ccv"];

        $error = false;
        $listOfErrors = [];

        if (!preg_match("#[0-9]{16}#", $cardNumber) || strlen($cardNumber) != 16) {
            $error = true;
            $listOfErrors[] = "Votre numéro de carte bleue n'est pas bon";
        }

        if ($month < 1 || $month > 12) {
            $error = true;
            $listOfErrors[] = "Le mois saisi n'est pas bon";
        }

        if ($year < date("y") || $year > date('y') + 5) {
            $error = true;
            $listOfErrors[] = "L'année saisie n'est pas bonne";
        }

        if (!preg_match("#[0-9]{3}#", $ccv) || strlen($ccv) != 3) {
            $error = true;
            $listOfErrors[] = "Le code n'est pas dans un format valide";
        }

        if ($error) {
            $_SESSION["errors"] = $listOfErrors;
            $_SESSION["input"] = $_POST;
            header("Location: ../payment.php");

        } else {

            $pdo = connectDB();
            $queryPrepared = $pdo->prepare("SELECT idUser FROM USER WHERE emailAddress = :email");
            $queryPrepared->execute([":email" => $_SESSION["email"]]);
            $info = $queryPrepared->fetch(PDO::FETCH_ASSOC);
            $idUser = $info["idUser"];

            $cart = lastCart($_SESSION["email"]);

            $queryPrepared = $pdo->prepare("SELECT cartPrice FROM CART WHERE idCart = :cart");
            $queryPrepared->execute([":cart" => $cart]);
            $price = $queryPrepared->fetch(PDO::FETCH_ASSOC);
            $price = $price["cartPrice"];

            $pointsToAdd = number_format($price);
            $queryPrepared = $pdo->prepare("SELECT points FROM USER, FIDELITY WHERE idFidelity = fidelityCard AND emailAddress = :email");
            $queryPrepared->execute([":email" => $_SESSION["email"]]);
            $points = $queryPrepared->fetch(PDO::FETCH_ASSOC);
            if (!empty($points)) {
                $points = $points["points"];
                $pointsToAdd += $points;
                $queryPrepared = $pdo->prepare("UPDATE FIDELITY, USER SET points = :points WHERE emailAddress = :email AND idFidelity = fidelityCard");
                $queryPrepared->execute([
                    "points" => $pointsToAdd,
                    ":email" => $_SESSION["email"]
                ]);
            }

            if (menusInCart($cart) != null) {
                $queryPrepared = $pdo->prepare("SELECT truck FROM MENUS, CART, CARTMENU WHERE cart = idCart AND menu = idMenu AND idCart = :cart");
                $queryPrepared->execute([
                    ":cart" => $cart
                ]);
            } else {
                $queryPrepared = $pdo->prepare("SELECT truck FROM PRODUCTS, CART, CARTPRODUCT WHERE cart = idCart AND product = idProduct AND idCart = :cart");
                $queryPrepared->execute([
                    ":cart" => $cart
                ]);
            }
            $truck = $queryPrepared->fetch(PDO::FETCH_ASSOC);
            $truck = $truck["truck"];

            $queryPrepared = $pdo->prepare("INSERT INTO ORDERS (orderPrice, orderType, truck, user, cart) VALUES (:orderPrice, 'Commande client', :truck, :user, :cart)");
            $queryPrepared->execute([
                ":orderPrice" => $price,
                ":truck" => $truck,
                ":user" => $idUser,
                ":cart" => $cart
            ]);

            $order = $pdo->lastInsertId();
            $queryPrepared = $pdo->prepare("INSERT INTO ORDERSTATUS (orders, status) VALUES (:order, 1)");
            $queryPrepared->execute([
                ":order" => $order
            ]);
            $queryPrepared = $pdo->prepare("INSERT INTO ORDERSTATUS (orders, status) VALUES (:order, 27)");
            $queryPrepared->execute([
                ":order" => $order
            ]);

            $queryPrepared = $pdo->prepare("INSERT INTO TRANSACTION (transactionType, price, user, orders) 
                                                        VALUES ('client', :price, :user, :order)");
            $queryPrepared->execute([
                ":price" => $price,
                ":user" => $idUser,
                ":order" => $order
            ]);

            if (isset($_POST["advantageSelect"]) && $_POST["advantageSelect"] != "") {
                $queryPrepared = $pdo->prepare("SELECT points FROM USER, FIDELITY WHERE idFidelity = fidelityCard AND emailAddress = :email");
                $queryPrepared->execute([":email" => $_SESSION["email"]]);
                $points = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if (!empty($points)) {
                    $queryPrepared = $pdo->prepare("SELECT advantagePoints FROM ADVANTAGE WHERE idAdvantage = :id");
                    $queryPrepared->execute([":id" => $_POST["advantageSelect"]]);
                    $cost = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                    $cost = $cost["advantagePoints"];
                    $points = $points - $cost;
                    $queryPrepared = $pdo->prepare("UPDATE FIDELITY, USER SET points = :points WHERE idFidelity = fidelityCard AND emailAddress = :email");
                    $queryPrepared->execute([
                        ":points" => $points,
                        ":email" => $_SESSION["email"]
                    ]);
                }
            }

            $queryPrepared = $pdo->prepare("UPDATE CARTSTATUS SET status = 8 WHERE cart = :cart");
            $queryPrepared->execute([
                ":cart" => $cart
            ]);


            $queryPrepared = $pdo->prepare("INSERT INTO CART (cartPrice, cartType, user) VALUES (0, 'Commande client', :user)");
            $queryPrepared->execute([":user" => $idUser]);

            $newCart = $pdo->lastInsertId();
            $queryPrepared = $pdo->prepare("INSERT INTO CARTSTATUS (cart, status) VALUES (:cart, 9)");
            $queryPrepared->execute([":cart" => $newCart]);

            header("Location: ../orderHistory.php");
        }
    } else {
        die("Ne pas modifier le formulaire");
    }
} else {
    header("Location: ../login.php");
}