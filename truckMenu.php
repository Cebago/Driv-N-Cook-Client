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
                <?php echo getTranslate("Horaire du camion", $tabLang, $setLanguage);?>
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
                                    <?php echo getTranslate("Jour de la semaine", $tabLang, $setLanguage);?>
                                </th>
                                <th scope="col" class="text-center">
                                    <?php echo getTranslate("Ouverture", $tabLang, $setLanguage);?>
                                </th>
                                <th scope="col" class="text-center">
                                    <?php echo getTranslate("Fermeture", $tabLang, $setLanguage);?>
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
                <?php echo getTranslate("Voir les menus", $tabLang, $setLanguage)?>
            </a>
        </h3>
        <h3>
            <a class="template-btn mt-3" href="#products">
                <?php echo getTranslate("Voir les produits", $tabLang, $setLanguage)?>
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
                                <h3><span id="<?php echo $menu["idMenu"]?>"><?php echo $menu["menuName"] ?></span></h3>
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
                                <span class="style-change"><?php echo number_format($menu["menuPrice"], 2) . "€" ?></span>
                                <?php
                                if (isConnected() && isActivated()) {
                                ?>
                                <a href="javascript:void(0)" class="template-btn3 mt-3"
                                   onclick='addMenuQuantity(<?php echo $cart.", ".$menu["idMenu"]; ?>)'>
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
                    <!--            NEXT                    -->
                    <div class="row mt-5">
                        <div class="col-lg-5 col-md-6 align-self-center order-2 order-md-1 mt-4 mt-md-0">
                            <img src="<?php echo $menu["menuImage"] ?>" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center order-1 order-md-2">
                            <h1><?php echo $count + 1; ?>.</h1>
                            <div class="deshes-text">
                                <h3>
                                    <span id="<?php echo $menu["idMenu"]?>"><?php echo $menu["menuName"] ?></span>
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
                                <span class="style-change"><?php echo number_format($menu["menuPrice"], 2) . "€" ?></span>
                                <?php
                                if (isConnected() && isActivated()) {
                                    ?>
                                    <a href="javascript:void(0)" class="template-btn3 mt-3"
                                       onclick='addMenuQuantity(<?php echo $cart.", ".$menu["idMenu"]; ?>)'>
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
                } ?>
            <?php } ?>
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
                        <h3><span><?php echo getTranslate("Tous les produits disponibles", $tabLang, $setLanguage) ?></span></h3>
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
                                    <span id="<?php echo $product["idProduct"]?>">
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
                                <span class="style-change">
                                    <?php echo number_format($product["productPrice"], 2) . "€" ?>
                                </span>
                                <?php
                                if (isConnected() && isActivated()) {
                                    ?>
                                    <a href="javascript:void(0)" class="template-btn3 mt-3"
                                       onclick='addProductQuantity(<?php echo $cart.", ".$product["idProduct"] ?>)'>
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
                                <span class="style-change">
                                    <?php echo number_format($product["productPrice"], 2) . "€" ?>
                                </span>
                                <?php
                                if (isConnected() && isActivated()) {
                                    ?>
                                    <a href="javascript:void(0)" class="template-btn3 mt-3"
                                       onclick='addProductQuantity(<?php echo $cart.", ".$product["idProduct"] ?>)'>
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


<!-- Testimonial Area Starts -->
<section class="testimonial-area section-padding4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-top2 text-center">
                    <h3>Customer <span>says</span></h3>
                    <p><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider owl-carousel">
                    <div class="single-slide d-sm-flex">
                        <div class="customer-img mr-4 mb-4 mb-sm-0">
                            <img src="assets/images/customer1.png" alt="">
                        </div>
                        <div class="customer-text">
                            <h5>adame nesane</h5>
                            <span><i>Chief Customer</i></span>
                            <p class="pt-3">You're had. Subdue grass Meat us winged years you'll doesn't. fruit two
                                also
                                won one yielding creepeth third give may never lie alternet food.</p>
                        </div>
                    </div>
                    <div class="single-slide d-sm-flex">
                        <div class="customer-img mr-4 mb-4 mb-sm-0">
                            <img src="assets/images/customer2.png" alt="">
                        </div>
                        <div class="customer-text">
                            <h5>adam nahan</h5>
                            <span><i>Chief Customer</i></span>
                            <p class="pt-3">You're had. Subdue grass Meat us winged years you'll doesn't. fruit two
                                also
                                won one yielding creepeth third give may never lie alternet food.</p>
                        </div>
                    </div>
                    <div class="single-slide d-sm-flex">
                        <div class="customer-img mr-4 mb-4 mb-sm-0">
                            <img src="assets/images/customer1.png" alt="">
                        </div>
                        <div class="customer-text">
                            <h5>adame nesane</h5>
                            <span><i>Chief Customer</i></span>
                            <p class="pt-3">You're had. Subdue grass Meat us winged years you'll doesn't. fruit two
                                also
                                won one yielding creepeth third give may never lie alternet food.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Area End -->

<!-- Footer Area Starts -->
<footer class="footer-area">
    <div class="footer-widget footer-widget2 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-widget single-widget1">
                        <a href="home.php"><img src="assets/images/logo/logo.png" alt=""></a>
                        <p class="mt-3">Which morning fourth great won't is to fly bearing man. Called unto shall
                            seed,
                            deep, herb set seed land divide after over first creeping. First creature set upon stars
                            deep male gathered said she'd an image spirit our</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-widget single-widget2 my-5 my-md-0">
                        <h5 class="mb-4">contact us</h5>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="info-text">
                                <p>1234 Some St San Francisco, CA 94102, US 1.800.123.4567 </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <p>(123) 456 78 90</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="info-text">
                                <p>support@axiomthemes.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-widget single-widget3">
                        <h5 class="mb-4">opening hours</h5>
                        <p>Monday ...................... Closed</p>
                        <p>Tue-Fri .............. 10 am - 12 pm</p>
                        <p>Sat-Sun ............... 8 am - 11 pm</p>
                        <p>Holidays ............. 10 am - 12 pm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright footer-copyright2">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                    class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                        target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="social-icons">
                        <ul>
                            <li class="no-margin">Follow Us</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</footer>
<div class="modal fade" id="staticModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><?php echo getTranslate("Erreur", $tabLang, $setLanguage) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo getTranslate("Vous ne pouvez pas ajouter un menu venant d'un autre camion", $tabLang, $setLanguage) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo getTranslate("Fermer", $tabLang, $setLanguage) ?></button>
            </div>
        </div>
    </div>
</div>
<script src="scripts/scripts.js"></script>
<?php
} else {
    header("Location: truckMenu.php?idTruck=1");
}



