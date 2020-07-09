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
                <h1>
                    <i>
                        <?php echo getTranslate("Historique", $tabLang, $setLanguage); ?>
                    </i>
                </h1>
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
                            echo "<p class='text-muted mt-3 mb-3'>" . getTranslate("Menus", $tabLang, $setLanguage) . " :</p>";
                            echo "<ul>";
                            foreach ($menus as $menu) {
                                echo "<li>" . $menu["menuName"] . "</li>";
                            }
                            echo "</ul>";
                        }
                        $products = productsInCart($order["cart"]);
                        if ($products != null) {
                            echo "<p class='text-muted mt-3 mb-3'>" . getTranslate("Produits", $tabLang, $setLanguage) . " :</p>";
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
                        echo getTranslate("Commande", $tabLang, $setLanguage) . " N° " . $order["idOrder"] . "&nbsp;|&nbsp;" . getTranslate($statuses[0]["statusName"], $tabLang, $setLanguage) . "&nbsp;-&nbsp;" . getTranslate($statuses[1]["statusName"], $tabLang, $setLanguage) ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</section>
<!-- End Sample Area -->

<?php include "footer.php" ?>
