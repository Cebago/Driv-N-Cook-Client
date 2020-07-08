<?php
session_start();
require 'conf.inc.php';
require 'functions.php';

if (isActivated() && isConnected()) {
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
                        Votre panier
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
            <h3><span>Vos menus au panier</span></h3>
        </div>
        <div class="row">

            <?php
            if (empty($menus)) {
                echo "Vous n'avez aucun menu au panier";
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
                                          id="inputPriceMenu<?php echo $menu["idMenu"]; ?>"><?php echo number_format($menu["menuPrice"], 2) . "€" ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="style-change"
                                          id="inputMenu<?php echo $menu["idMenu"]; ?>"><?php echo $menu["quantity"]; ?></span>
                                </div>
                                <button type="button"
                                        onclick='deleteMenuQuantity(<?php echo $idCart . ", " . $menu["idMenu"]; ?>)'
                                        class="btn btn-sm btn-danger ml-1" id="<?php echo $menu["idMenu"] ?>"><i
                                            class="fas fa-minus"></i></button>
                                <button type="button"
                                        onclick='addMenuQuantity(<?php echo $idCart . ", " . $menu["idMenu"]; ?>)'
                                        class="btn btn-sm btn-success ml-1"><i class="fas fa-plus"></i></button>
                                <button type="button"
                                        onclick='completelyMenuDelete(<?php echo $idCart . ', ' . $menu["idMenu"]; ?>)'
                                        class="btn btn-sm btn-secondary ml-1 pull-right">Supprimer</i></button>
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
            <h3><span>Vos produits au panier</span></h3>
        </div>
        <div class="row">
            <?php
            $products = productsInCart($idCart);
            if ($products == null) {
                echo "Vous n'avez aucun produit au panier";
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
                                          id="inputPriceProduct<?php echo $product["idProduct"]; ?>"><?php echo number_format($product["productPrice"], 2) . "€" ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="style-change"
                                          id="inputProduct<?php echo $product["idProduct"]; ?>"><?php echo $product["quantity"]; ?></span>
                                </div>
                                <button type="button"
                                        onclick='deleteProductQuantity(<?php echo $idCart . ", " . $product["idProduct"]; ?>)'
                                        class="btn btn-sm btn-danger ml-1" id="<?php echo $product["idProduct"] ?>"><i
                                            class="fas fa-minus"></i></button>
                                <button type="button"
                                        onclick='addProductQuantity(<?php echo $idCart . ", " . $product["idProduct"] ?>)'
                                        class="btn btn-sm btn-success ml-1"><i class="fas fa-plus"></i></button>
                                <button type="button"
                                        onclick='completelyProductDelete(<?php echo $idCart . ', ' . $product["idProduct"]; ?>)'
                                        class="btn btn-sm btn-secondary ml-1 pull-right">Supprimer</i></button>
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
        <h4><span class="style-change"
                  id="total<?php echo $idCart ?>"><?php echo number_format($total, 2) . "€"; ?></span></h4>
    </div>
    <div class="pull-right col-md-3">
        <a href="payment.php" class="template-btn template-btn2 mt-4">Payer</a>
    </div>
</section>


<!-- Food Area End -->


<!-- Table Area Starts -->
<section class="table-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-top2 text-center">
                    <h3>Book <span>your</span> table</h3>
                    <p><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="#">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" id="datepicker">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <input type="text" id="datepicker2">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                        </div>
                        <input type="text">
                    </div>
                    <div class="table-btn text-center">
                        <a href="#" class="template-btn template-btn2 mt-4">book a table</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Table Area End -->


<!-- Footer Area Starts -->
<footer class="footer-area">
    <div class="footer-widget section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-widget single-widget1">
                        <a href="index.html"><img src="assets/images/logo/logo2.png" alt=""></a>
                        <p class="mt-3">Which morning fourth great won't is to fly bearing man. Called unto shall
                            seed, deep, herb set seed land divide after over first creeping. First creature set upon
                            stars deep male gathered said she'd an image spirit our</p>
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
    <div class="footer-copyright">
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
<script src="scripts/scripts.js"></script>
<?php } else {
    header("Location: login.php");
}


