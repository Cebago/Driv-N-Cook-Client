<?php
session_start();
require "navbar.php";
$orders = ordersOfUser($_SESSION["email"]);

?>
<body>
<section class="banner-area banner-area2 blog-page text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i>Historique</i></h1>
            </div>
        </div>
    </div>
</section>
<!-- Start Sample Area -->
<section class="sample-text-area section-padding4">
    <div class="container row col-md-10">
        <?php
        if ($orders != null) {
            foreach ($orders as $order) {
                $statuses = statusOfOrder($order["idOrder"])
                ?>
                <div class="card mx-auto w-25">
                    <div class="card-header"><?php echo $order["orderDate"] . " - " . number_format($order["orderPrice"], 2) . "€" ?></div>
                    <div class="card-body">
                        <?php
                        $menus = menusInCart($order["cart"]);
                        if ($menus != null) {
                            echo "<p class='text-muted'>Menus :</p>";
                            echo "<ul>";
                            foreach ($menus as $menu) {
                                echo "<li>" . $menu["menuName"] . "</li>";
                            }
                            echo "</ul>";
                        }
                        $products = productsInCart($order["cart"]);
                        if ($products != null) {
                            echo "<p class='text-muted'>Produits :</p>";
                            echo "<ul>";
                            foreach ($products as $product) {
                                echo "<li>" . $product["productName"] . "</li>";
                            }
                            echo "</ul>";
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <?php
                        echo "Commande N° " . $order["idOrder"] . "&nbsp;|&nbsp;" . $statuses[0]["statusName"] . "&nbsp;-&nbsp;" . $statuses[1]["statusName"] ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</section>
<!-- End Sample Area -->

<footer class="footer-area">
    <div class="footer-widget section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-widget single-widget1">
                        <a href="index.html"><img src="assets/images/logo/logo2.png" alt=""></a>
                        <p class="mt-3">Which morning fourth great won't is to fly bearing man. Called unto shall seed, deep, herb set seed land divide after over first creeping. First creature set upon stars deep male gathered said she'd an image spirit our</p>
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
</footer>


<?php include "footer.php" ?>
