<?php
session_start();
require 'conf.inc.php';
require 'functions.php';
include 'header.php';
if (isset($_GET["idTruck"])) {
    $printedMenus = 0;
    $pdo = connectDB();

    $queryPrepared = $pdo->prepare("SELECT truckName FROM TRUCK WHERE idTruck = :idTruck");
    $queryPrepared->execute([":idTruck" => $_GET["idTruck"]]);
    $truck = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

    $count = 0;
    if (isConnected() && isActivated()) {
        $cart = lastCart($_SESSION["email"]);
    }
    include "navbar.php"; ?>
<body onload="getOpenDays('<?php echo $_GET["idTruck"]; ?>')">

<!-- Banner Area Starts -->
<section class="banner-area banner-area2 menu-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>
                    <i>
                        <?php foreach ($truck as $key) {
                            echo $key["truckName"];
                        } ?>
                    </i>
                </h1>
            </div>
        </div>
    </div>
</section>
<!-- Food Area starts -->

<section class="food-area section-padding2">
    <div class="section-top2 text-center">
        <h3>
            <span>
                <?php echo getTranslate("Horaire du camion", $tabLang, $setLanguage); ?>
            </span>
        </h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9 ml-5 mt-4 mx-auto">
                <div class="tab-content card mt-1" id="myTabContent">
                    <div class="tab-pane fade show active" id="openDays" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table" id="openTable">
                            <thead class="table-warning">
                            <tr>
                                <th scope="col" class="text-center">
                                    <?php echo getTranslate("Jour de la semaine", $tabLang, $setLanguage); ?>
                                </th>
                                <th scope="col" class="text-center">
                                    <?php echo getTranslate("Ouverture", $tabLang, $setLanguage); ?>
                                </th>
                                <th scope="col" class="text-center">
                                    <?php echo getTranslate("Fermeture", $tabLang, $setLanguage); ?>
                                </th>
                            </tr>
                            </thead>
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center mt-5 mb-2">
        <h3>
            <a class="template-btn mt-3" href="#menus">
                <?php echo getTranslate("Voir les menus", $tabLang, $setLanguage) ?>
            </a>
        </h3>
        <h3>
            <a class="template-btn mt-3" href="#products">
                <?php echo getTranslate("Voir les produits", $tabLang, $setLanguage) ?>
            </a>
        </h3>
    </div>
</section>

<section class="food-area" id="menus">
    <!-- Deshes Area Starts -->
    <div class="deshes-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top2 text-center">
                        <h3>
                            <span>
                                <?php echo getTranslate("Tous les menus disponibles", $tabLang, $setLanguage) ?>
                            </span>
                        </h3>
                    </div>
                </div>
            </div>
            <?php
            $count = 0;
            $menus = allMenuFromTruck($_GET["idTruck"]);
            if ($menus != null) {
                foreach ($menus as $menu) {
                    if (getStatusOfMenu($menu["idMenu"] != null
                        && getStatusOfMenu($menu["idMenu"] == 23
                        ))) {
                        continue;
                    }
                    $products = getProductsOfMenu($menu["idMenu"], $_GET["idTruck"]);
                    if (empty($products)) {
                        continue;
                    }
                    foreach ($products as $product) {
                        if (getStatusOfProduct($product["idProduct"]) != null && getStatusOfProduct($product["idProduct"]) == 20) {
                            continue 2;
                        }
                        $ingredients = ingredientsFromProduct($product["idProduct"]);
                        foreach ($ingredients as $ingredient) {
                            if (!availableInTruck($ingredient["idIngredient"], $_GET["idTruck"])) {
                                continue 3;
                            }
                        }
                    }
                    $printedMenus++;
                    if ($count % 2 == 0) {
                        ?>
                        <div class="row">
                            <div class="col-lg-5 col-md-6 align-self-center">
                                <h1><?php echo $count + 1; ?>.</h1>
                                <div class="deshes-text">
                                    <h3><span id="<?php echo $menu["idMenu"] ?>"><?php echo $menu["menuName"] ?></span></h3>
                                    <ul>
                                        <?php
                                        foreach ($products as $product) {
                                            $ingredients = ingredientsFromProduct($product["idProduct"]);
                                            echo "<li>" . $product["productName"] . "<ul>";
                                            foreach ($ingredients as $ingredient) {
                                                echo "<li>&nbsp;&nbsp;-&nbsp;" . $ingredient["ingredientName"] . "</li>";
                                            }
                                            echo "</ul></li>";
                                        } ?>
                                    </ul>
                                    <span class="style-change"
                                          id="inputPriceMenu<?php echo $menu["idMenu"]; ?>"><?php echo number_format($menu["menuPrice"], 2) . "€" ?></span>
                                    <?php
                                    if (isConnected() && isActivated()) {
                                        ?>
                                        <a href="javascript:void(0)" class="template-btn3 mt-3"
                                           onclick='addMenuQuantity(<?php echo $cart . ", " . $menu["idMenu"]; ?>)'>
                                            <?php echo getTranslate("Ajouter à mon panier", $tabLang, $setLanguage) ?>
                                            <span>
                                            <i class="fa fa-long-arrow-right"></i>
                                        </span>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center mt-4 mt-md-0">
                                <img src="<?php echo $menu["menuImage"] ?>" class="img-fluid" alt="">
                            </div>
                        </div>
                        <?php $count++;
                    } else { ?>
                        <div class="row mt-5">
                            <div class="col-lg-5 col-md-6 align-self-center order-2 order-md-1 mt-4 mt-md-0">
                                <img src="<?php echo $menu["menuImage"] ?>" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center order-1 order-md-2">
                                <h1><?php echo $count + 1; ?>.</h1>
                                <div class="deshes-text">
                                    <h3>
                                        <span id="<?php echo $menu["idMenu"] ?>"><?php echo $menu["menuName"] ?></span>
                                    </h3>
                                    <ul>
                                        <?php
                                        foreach ($products as $product) {
                                            $ingredients = ingredientsFromProduct($product["idProduct"]);
                                            echo "<li>" . $product["productName"] . "<ul>";
                                            foreach ($ingredients as $ingredient) {
                                                echo "<li>&nbsp;&nbsp;-&nbsp;" . $ingredient["ingredientName"] . "</li>";
                                            }
                                            echo "</ul></li>";
                                        } ?>
                                    </ul>
                                    <span class="style-change"
                                          id="inputPriceMenu<?php echo $menu["idMenu"]; ?>"><?php echo number_format($menu["menuPrice"], 2) . "€" ?></span>
                                    <?php
                                    if (isConnected() && isActivated()) {
                                        ?>
                                        <a href="javascript:void(0)" class="template-btn3 mt-3"
                                           onclick='addMenuQuantity(<?php echo $cart . ", " . $menu["idMenu"]; ?>)'>
                                            <?php echo getTranslate("Ajouter à mon panier", $tabLang, $setLanguage) ?>
                                            <span>
                                            <i class="fa fa-long-arrow-right"></i>
                                        </span>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php $count++;
                    }
                }
            }
            ?>
        </div>
    </div>
</section>

<section class="food-area" id="products">
    <!-- Deshes Area Starts -->
    <div class="deshes-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top2 text-center">
                        <h3>
                            <span><?php echo getTranslate("Tous les produits disponibles", $tabLang, $setLanguage) ?></span>
                        </h3>
                    </div>
                </div>
            </div>
            <?php
            $count = 0;
            $products = allProductsFromTruck($_GET["idTruck"]);
            if (!empty($products)) {
                foreach ($products as $product) {
                    if (getStatusOfProduct($product["idProduct"]) != null && getStatusOfProduct($product["idProduct"]) == 20) {
                        continue;
                    }
                    $ingredients = ingredientsFromProduct($product["idProduct"]);
                    foreach ($ingredients as $ingredient) {
                        if (!availableInTruck($ingredient["idIngredient"], $_GET["idTruck"])) {
                            continue 2;
                        }
                    }
                    if ($count % 2 == 0) {
                        ?>
                        <div class="row">
                            <div class="col-lg-5 col-md-6 align-self-center">
                                <h1><?php echo $count + 1; ?>.</h1>
                                <div class="deshes-text">
                                    <h3>
                                    <span id="<?php echo $product["idProduct"] ?>">
                                        <?php echo $product["productName"] ?>
                                    </span>
                                    </h3>
                                    <ul>
                                        <?php
                                        foreach ($ingredients as $ingredient) {
                                            echo "<li>" . $ingredient["ingredientName"] . "</li>";
                                        }
                                        ?>
                                    </ul>
                                    <span class="style-change"
                                          id="inputPriceProduct<?php echo $product["idProduct"]; ?>">
                                    <?php echo number_format($product["productPrice"], 2) . "€" ?>
                                </span>
                                    <?php
                                    if (isConnected() && isActivated()) {
                                        ?>
                                        <a href="javascript:void(0)" class="template-btn3 mt-3"
                                           onclick='addProductQuantity(<?php echo $cart . ", " . $product["idProduct"] ?>)'>
                                            <?php echo getTranslate("Ajouter à mon panier", $tabLang, $setLanguage) ?>
                                            <span>
                                        <i class="fa fa-long-arrow-right"></i>
                                    </span>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php $count++;
                    } else { ?>
                        <!--            NEXT                    -->
                        <div class="row mt-5">
                            <div class="col-lg-5 col-md-6 align-self-center order-2 order-md-1 mt-4 mt-md-0">
                                <img src="#" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center order-1 order-md-2">
                                <h1><?php echo $count + 1; ?>.</h1>
                                <div class="deshes-text">
                                    <h3>
                                    <span>
                                        <?php echo $product["productName"] ?>
                                    </span>
                                    </h3>
                                    <ul>
                                        <?php
                                        foreach ($ingredients as $ingredient) {
                                            echo "<li>" . getTranslate($ingredient["ingredientName"], $tabLang, $setLanguage) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                    <span class="style-change"
                                          id="inputPriceProduct<?php echo $product["idProduct"]; ?>">
                                    <?php echo number_format($product["productPrice"], 2) . "€" ?>
                                </span>
                                    <?php
                                    if (isConnected() && isActivated()) {
                                        ?>
                                        <a href="javascript:void(0)" class="template-btn3 mt-3"
                                           onclick='addProductQuantity(<?php echo $cart . ", " . $product["idProduct"] ?>)'>
                                            <?php echo getTranslate("Ajouter à mon panier", $tabLang, $setLanguage) ?>
                                            <span><i class="fa fa-long-arrow-right"></i>
                                    </span>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php $count++;
                    }
                }
            } ?>
        </div>
    </div>
</section>
<!-- Deshes Area End -->
<?php include "footer.php"; ?>
<div class="modal fade" id="staticModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="staticBackdropLabel"><?php echo getTranslate("Erreur", $tabLang, $setLanguage) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo getTranslate("Vous ne pouvez pas ajouter un menu venant d'un autre camion", $tabLang, $setLanguage) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?php echo getTranslate("Fermer", $tabLang, $setLanguage) ?></button>
            </div>
        </div>
    </div>
</div>
<script src="scripts/scripts.js"></script>
    <?php
} else {
    header("Location: truckMenu.php?idTruck=1");
}



