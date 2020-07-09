<?php
require 'header.php';
require_once 'functions.php';

$jsonFile = file_get_contents('assets/traduction.json');
$jsonFile = json_decode($jsonFile, true);
$headerTabLang = $jsonFile['header'];
$tabLang = $jsonFile['values'];
if (isset($_COOKIE['Lang'])) {
    $setLanguage = $_COOKIE['Lang'];
} else {
    setcookie("Lang", "fr_FR", time() + 86400, '/');
    $setLanguage = "fr_FR";
}

if (isConnected() && isActivated() && !isActivated()) {
    $email = $_SESSION["email"];
    $pdo = connectDB();
    $cart = lastCart($_SESSION["email"]);
    $queryPrepared = $pdo->prepare("SELECT SUM(quantity) as quantity FROM CARTMENU, CART, MENUS WHERE CARTMENU.cart = idCart AND MENUS.idMenu = CARTMENU.menu AND idCart = :cart");
    $queryPrepared->execute([
        ":cart" => $cart
    ]);
    $menu = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $queryPrepared = $pdo->prepare("SELECT SUM(quantity) as quantity FROM CARTPRODUCT, CART, PRODUCTS  WHERE CARTPRODUCT.cart = idCart AND PRODUCTS.idProduct = CARTPRODUCT.product AND idCart = :cart");
    $queryPrepared->execute([
        ":cart" => $cart
    ]);
    $product = $queryPrepared->fetch(PDO::FETCH_ASSOC);

    if (empty($product)) {
        $product = 0;
    } else {
        $product = $product["quantity"];
    }
    if (empty($menu)) {
        $menu = 0;
    } else {
        $menu = $menu["quantity"];
    }
    $quantity = $menu + $product;

}

?>
<body>
<!-- Preloader Starts -->
<div class="preloader">
    <div class="spinner"></div>
</div>
<!-- Preloader End -->
<!-- Header Area Starts -->
<div class="sticky-top ">
    <header class="header-area shadow-lg p-3 mb-5 bg-info rounded-pill">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo-area">
                        <a href="home.php"><img src="./img/logo.png" alt="logo" class="img-fluid" ></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li class="active">
                                <a
                                        href="home.php"><?php echo getTranslate("accueil", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <li>
                                <a href="viewTrucks.php">
                                    <?php echo getTranslate("nos camions", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <li>
                                <a href="events.php">
                                    <?php echo getTranslate("evenements", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <li>
                                <a href="./assets/three-js/examples/test.html">
                                    <?php echo getTranslate("rejoignez-nous", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <?php
                            if (isConnected() && isActivated() && !isActivated()) { ?>
                                <li>
                                    <a href="cart.php" class="btn btn-transparent btn-lg active" role="button"
                                       aria-pressed="true">
                                        <i class="fas fa-shopping-cart"></i>
                                        &nbsp
                                        <span class="badge badge-alert" id="count">
                                        <?php echo $quantity; ?>
                                    </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdown09" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <span class="flag-icon <?php echo $headerTabLang[$setLanguage]["icon"] ?>">
                                    </span>
                                    <?php echo $headerTabLang[$setLanguage]["name"] ?>
                                </a>
                                <div class="dropdown-menu bg-info border-light" aria-labelledby="dropdown09">
                                    <?php
                                    foreach ($headerTabLang as $key => $value) {
                                        if ($key != $setLanguage)
                                            echo "<a class=\"dropdown-item\" href=\"./functions/changeLanguage.php?lang=" . $key . "\" ><span class=\"flag-icon " . $value['icon'] . "\"> </span> " . $value['name'] . "</a>";
                                    } ?>
                                </div>
                            </li>
                            <li>
                                <?php
                                if (isConnected() && isActivated() && !isActivated()) { ?>
                                <a href="#" class="btn btn-transparent btn-lg active" role="button"
                                   aria-pressed="true" data-toggle="dropdown"><i class="fas fa-user-circle"></i>&nbsp;
                                    <?php
                                    echo getTranslate("Mon compte", $tabLang, $setLanguage);
                                    echo "</a>";
                                    } else { ?>
                                    <a href="login.php" class="btn btn-transparent btn-lg active" role="button"
                                       aria-pressed="true"><i class="fas fa-user-circle"></i>&nbsp;
                                        <?php
                                        echo getTranslate("Connexion", $tabLang, $setLanguage);
                                        echo "</a>";
                                        }
                                        ?>
                                        <div class="dropdown-menu dropdown-menu-lg-left">
                                            <a class="dropdown-item" href="myProfile.php">
                                                <?php
                                                echo getTranslate("Mon profil", $tabLang, $setLanguage)
                                                ?>
                                            </a>
                                            <a class="dropdown-item" href="orderHistory.php">
                                                <?php
                                                echo getTranslate("Mes commandes", $tabLang, $setLanguage)
                                                ?>
                                            </a>
                                            <a class="dropdown-item" href="myPassword.php">
                                                <?php
                                                echo getTranslate("Mon mot de passe", $tabLang, $setLanguage)
                                                ?>
                                            </a>
                                            <a class="dropdown-item" href="functions/logout.php"><i
                                                        class="fas fa-sign-out-alt"></i>&nbsp;
                                                <?php
                                                echo getTranslate("Déconnexion", $tabLang, $setLanguage)
                                                ?></a>
                                        </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<!-- Header Area End -->

