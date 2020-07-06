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

if (isConnected() && isActivated()) {
    $email = $_SESSION["email"];
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT SUM(quantity) as quantity FROM CARTMENU, CART, MENUS, USER WHERE CARTMENU.cart = idCart AND MENUS.idMenu = CARTMENU.menu AND CART.user = idUser AND emailAddress = :email  GROUP BY idCart;");
    $queryPrepared->execute([
        ":email" => $email
    ]);
    if (empty($queryPrepared->fetch(PDO::FETCH_ASSOC))) {
        $quantity = 0;
    } else {
        $quantity = $queryPrepared->fetch(PDO::FETCH_ASSOC);
        $quantity = $quantity["quantity"];
    }

}


?>


</head>

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
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="home.php"><img src="./img/logo.png" alt="logo"></a>
                        <span>Driv'n Cook</span>
                    </div>

                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li class="active">
                                <a
                                    href="home.php"><?php getTranslate("accueil", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <li>
                                <a href="truckMenu.php">
                                    <?php getTranslate("nos camions", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <li>
                                <a href="menu.html">
                                    <?php getTranslate("evenements", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <li>
                                <a href="http://franchises.drivncook.fr">
                                    <?php getTranslate("rejoignez-nous", $tabLang, $setLanguage); ?>
                                </a>
                            </li>
                            <?php
                            if (isConnected() && isActivated()) {?>
                            <li>
                                <a href="payment.php" class="btn btn-transparent btn-lg active" role="button"
                                   aria-pressed="true"><i class="fas fa-shopping-cart"></i>&nbsp
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
                                if (isConnected() && isActivated()) { ?>
                                    <a href="login.php" class="btn btn-transparent btn-lg active" role="button"
                                       aria-pressed="true"><i class="fas fa-user-circle"></i>&nbsp;
                                    <?php
                                    getTranslate("Mon compte", $tabLang, $setLanguage);
                                    } else { ?>
                                    <a href="login.php" class="btn btn-transparent btn-lg active" role="button"
                                       aria-pressed="true"><i class="fas fa-user-circle"></i>&nbsp;
                                    <?php
                                    getTranslate("Connexion", $tabLang, $setLanguage);
                                    }
                                    ?>
                                    </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
</body>
<!-- Header Area End -->

