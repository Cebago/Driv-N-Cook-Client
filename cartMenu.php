<?php
session_start();
require 'conf.inc.php';
require 'functions.php';

if (isActivated() && isConnected()) {
    include 'header.php';
    $printedMenus = 0;
    $pdo = connectDB();

    $queryPrepared = $pdo->prepare("SELECT truckName FROM TRUCK WHERE idTruck = :idTruck");
    $queryPrepared->execute([":idTruck" => $_GET["idTruck"]]);
    $truck = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

    $queryPrepared = $pdo->prepare("SELECT idCart FROM CART, USER WHERE user = idUser AND emailAddress = :email ORDER BY idCart DESC LIMIT 1");
    $queryPrepared->execute([":email" => $_SESSION["email"]]);
    $idCart = $queryPrepared->fetch(PDO::FETCH_ASSOC);

    $queryPrepared = $pdo->prepare("SELECT menuName, menuImage, menuPrice, idMenu, truck, quantity FROM MENUS, TRUCK, CARTMENU, CART WHERE MENUS.truck = TRUCK.idTruck AND idCart = :cart AND menu = idMenu AND idCart = cart");
    $queryPrepared->execute([":cart" => $idCart["idCart"]]);
    $result = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


//if (isset($_GET["idTruck"])){
//    header("Location: cartMenu.php?idTruck=1");
//}

    ?>

    <?php include "navbar.php"; ?>
<body onload="getOpenDays('<?php echo $_GET["idTruck"]; ?>//')">
<body>

<!-- Banner Area Starts -->
<section class="banner-area banner-area2 menu-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="style-change"><i><?php foreach ($truck as $key) {
                            echo $key["truckName"];
                        } ?></i></h1>
                <p class="pt-2"><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
            </div>
        </div>
    </div>
</section>
<!-- Food Area starts -->
<section class="food-area section-padding4">
    <div class="container">
        <div class="section-top2 text-center">
            <h3><span>Nos menus</span></h3>
        </div>
        <div class="row">

            <?php foreach ($result as $value) {
                $products = getMenus($value);
                if (empty($products)) {
                    $queryPrepared = $pdo->prepare("DELETE FROM CARTMENU WHERE cart = :cart AND menu = :menu");
                    $queryPrepared->execute([
                        ":cart" => $idCart["idCart"],
                        ":menu" => $value["idMenu"]
                    ]);
                    continue;
                }
                    $printedMenus++;
                ?>
                <div class="col-md-5 col-sm-4" id="delete<?php echo $value["idMenu"];?>">
                    <div class="single-food">
                        <div class="food-img">
                            <img src="<?php echo $value["menuImage"] ?>" class="img-fluid" alt="">
                        </div>
                        <div class="food-content">
                            <div class="d-flex justify-content-between">
                                <h5><?php echo $value["menuName"] ?></h5>
                                <ul>
                                    <?php foreach ($products as $product) {
                                        echo "<li>" . $product["productName"] . "</li>";
                                    } ?>
                                </ul>
                                <span class="style-change"><?php echo number_format($value["menuPrice"], 2) . "€" ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="style-change"
                                      id="input<?php echo $value["idMenu"]; ?>"><?php echo $value["quantity"]; ?></span>
                            </div>
                            <button type="button"
                                    onclick='deleteQuantity(<?php echo $idCart["idCart"] . ", " . $value["idMenu"]; ?>,this)'
                                    class="btn btn-sm btn-danger ml-1" id="<?php echo $value["idMenu"] ?>"><i
                                        class="fas fa-minus"></i></button>
                            <button type="button"
                                    onclick='addQuantity(<?php echo $idCart["idCart"] . ", " . $value["idMenu"]; ?>)'
                                    class="btn btn-sm btn-success ml-1"><i class="fas fa-plus"></i></button>
                            <button type="button"
                                    onclick='completelyDelete(<?php echo $idCart["idCart"].', '. $value["idMenu"]; ?>)'
                                    class="btn btn-sm btn-secondary ml-1 pull-right">Supprimer</i></button>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
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


