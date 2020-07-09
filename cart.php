<?php
session_start();
require 'conf.inc.php';
require 'functions.php';

if (isActivated() && isConnected() && isClient()) {
    include 'header.php';
    $printedMenus = 0;
    $idCart = lastCart($_SESSION["email"]);
    $menus = menusInCart($idCart);
    $total = 0;

    ?>

    <?php include "navbar.php"; ?>
    <body>

<!-- Banner Area Starts -->
<section class="banner-area banner-area2 menu-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="style-change">
                    <i>
                        <?php echo getTranslate("Votre panier", $tabLang, $setLanguage); ?>
                    </i>
                </h1>
            </div>
        </div>
    </div>
</section>
<!-- Food Area starts -->
<section class="food-area section-padding4">
    <div class="container">
        <div class="section-top2 text-center">
            <h3>
                <span>
                    <?php echo getTranslate("Vos menus au panier", $tabLang, $setLanguage); ?>
                </span>
            </h3>
        </div>
        <div class="row">
            <?php
            if (empty($menus)) {
                echo getTranslate("Vous n'avez aucun menu au panier", $tabLang, $setLanguage);
            } else {
                foreach ($menus as $menu) {
                    $products = getProductsOfMenu($menu["idMenu"], $menu["truck"]);
                    if (empty($products)) {
                        $queryPrepared = $pdo->prepare("DELETE FROM CARTMENU WHERE cart = :cart AND menu = :menu");
                        $queryPrepared->execute([
                            ":cart" => $idCart["idCart"],
                            ":menu" => $menu["idMenu"]
                        ]);
                        continue;
                    }
                    $printedMenus++;
                    if (!empty($menu["quantity"])) {
                        $total += $menu["menuPrice"] * $menu["quantity"];
                    }
                    ?>
                    <div class="col-md-5 col-sm-4" id="deleteMenu<?php echo $menu["idMenu"]; ?>">
                        <div class="single-food">
                            <div class="food-img">
                                <img src="<?php echo $menu["menuImage"] ?>" class="img-fluid" alt="">
                            </div>
                            <div class="food-content">
                                <div class="d-flex justify-content-between">
                                    <h5><?php echo $menu["menuName"] ?></h5>
                                    <ul>
                                        <?php foreach ($products as $product) {
                                            echo "<li>" . $product["productName"] . "</li>";
                                        } ?>
                                    </ul>
                                    <span class="style-change"
                                          id="inputPriceMenu<?php echo $menu["idMenu"]; ?>">
                                        <?php echo number_format($menu["menuPrice"], 2) . "€" ?>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="style-change"
                                          id="inputMenu<?php echo $menu["idMenu"]; ?>">
                                        <?php echo $menu["quantity"]; ?>
                                    </span>
                                </div>
                                <button type="button"
                                        onclick='deleteMenuQuantity(<?php echo $idCart . ", " . $menu["idMenu"]; ?>)'
                                        class="btn btn-sm btn-danger ml-1" id="<?php echo $menu["idMenu"] ?>">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button"
                                        onclick='addMenuQuantity(<?php echo $idCart . ", " . $menu["idMenu"]; ?>)'
                                        class="btn btn-sm btn-success ml-1">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button"
                                        onclick='completelyMenuDelete(<?php echo $idCart . ', ' . $menu["idMenu"]; ?>)'
                                        class="btn btn-sm btn-secondary ml-1 pull-right">
                                    <?php echo getTranslate("Supprimer", $tabLang, $setLanguage); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<section class="food-area section-padding4">
    <div class="container">
        <div class="section-top2 text-center">
            <h3>
                <span>
                    <?php echo getTranslate("Vos produits au panier", $tabLang, $setLanguage); ?>
                </span>
            </h3>
        </div>
        <div class="row">
            <?php
            $products = productsInCart($idCart);
            if ($products == null) {
                echo getTranslate("Vous n'avez aucun produit au panier", $tabLang, $setLanguage);
            } else {
                foreach ($products as $product) {
                    $printedMenus++;

                    if (!empty($product["quantity"])) {
                        $total += $product["productPrice"] * $product["quantity"];
                    }
                    ?>
                    <div class="col-md-5 col-sm-4" id="deleteProduct<?php echo $product["idProduct"]; ?>">
                        <div class="single-food">
                            <div class="food-img">
                                <img src="#" class="img-fluid" alt="">
                            </div>
                            <div class="food-content">
                                <div class="d-flex justify-content-between">
                                    <h5><?php echo $product["productName"] ?></h5>
                                    <span class="style-change"
                                          id="inputPriceProduct<?php echo $product["idProduct"]; ?>">
                                        <?php echo number_format($product["productPrice"], 2) . "€" ?>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="style-change"
                                          id="inputProduct<?php echo $product["idProduct"]; ?>">
                                        <?php echo $product["quantity"]; ?>
                                    </span>
                                </div>
                                <button type="button"
                                        onclick='deleteProductQuantity(<?php echo $idCart . ", " . $product["idProduct"]; ?>)'
                                        class="btn btn-sm btn-danger ml-1" id="<?php echo $product["idProduct"] ?>">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button"
                                        onclick='addProductQuantity(<?php echo $idCart . ", " . $product["idProduct"] ?>)'
                                        class="btn btn-sm btn-success ml-1">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button"
                                        onclick='completelyProductDelete(<?php echo $idCart . ', ' . $product["idProduct"]; ?>)'
                                        class="btn btn-sm btn-secondary ml-1 pull-right">
                                    <?php echo getTranslate("Supprimer", $tabLang, $setLanguage); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <div class="section-top2 pull-right col-md-4">
        <h4>
            <span class="style-change"
                  id="total<?php echo $idCart ?>">
                <?php echo number_format($total, 2) . "€"; ?>
            </span>
        </h4>
    </div>
    <div class="pull-right col-md-3">
        <a href="payment.php" class="template-btn template-btn2 mt-4">
            <?php echo getTranslate("Payer", $tabLang, $setLanguage); ?>
        </a>
    </div>
</section>
<!-- Food Area End -->
<?php include "footer.php"; ?>
<script src="scripts/scripts.js"></script>
<?php } else {
    header("Location: login.php");
}


