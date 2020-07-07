<?php
require "conf.inc.php";
require "functions.php";
if (!isset($_GET["cle"], $_GET["id"])) {
    header("Location: login.php");
}
if (!empty($_GET["id"]) && !empty($_GET["cle"])) {
    $id = $_GET["id"];
    $token = $_GET["cle"];
}
$_SESSION["id"] = $id;
$_SESSION["token"] = $token;
$pdo = connectDB();
$queryPrepared = $pdo->prepare("SELECT USERTOKEN.token FROM USER, USERTOKEN WHERE idUser = :id AND tokenType = 'Site' AND user = idUser");
$queryPrepared->execute([
    ":id" => $id
]);
$result = $queryPrepared->fetch();

if ($result["token"] != $token) {
    unset($_SESSION["id"]);
    header("Location: forgotPassword.php");
}
require "header.php";
?>
<body>
<?php
require "navbar.php";
?>

<!-- Banner Area Starts -->
<section class="banner-area banner-area2 blog-page text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i>Réinitialiser le mot de passe</i></h1>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Start Sample Area -->
<section class="sample-text-area section-padding4">
    <div class="card-body">
        <form method="POST" action="verifyPassword.php">
            <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
                <div class="card card-login mx-auto mt-5 p-5">
                    <?php
                    if (isset($_SESSION["errors"])) {
                        echo "<div class='alert alert-danger'>";
                        foreach ($_SESSION["errors"] as $error) {
                            echo "<li>" . $error;
                        }
                        echo "</div>";
                    }
                    unset($_SESSION["errors"]);
                    ?>
                    <p class="text-justify">Votre mot de passe doit contenir au moins un chiffre, une minuscule
                        et une majuscule et comprendre au moins 8 caractères.</p>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" class="form-control focus" placeholder="Nouveau mot de passe"
                                   required="required" autofocus="autofocus" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" class="form-control focus"
                                   placeholder="Confirmation mot de passe" required="required"
                                   autofocus="autofocus" name="passwordConfirm">
                        </div>
                    </div>
                    <input class="btn btn-primary degrade btn-block pt-2 pb-2 " type="submit" value="Connexion">
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Sample Area -->

<!-- Footer Area Starts -->
<footer class="footer-area">
    <div class="footer-widget section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-widget single-widget1">
                        <a href="index.html"><img alt="" src="assets/images/logo/logo2.png"></a>
                        <p class="mt-3">Which morning fourth great won't is to fly bearing man. Called unto shall seed,
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
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                    aria-hidden="true" class="fa fa-heart-o"></i> by <a href="https://colorlib.com"
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
</footer>
<!-- Footer Area End -->


<!-- Javascript -->
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="assets/js/vendor/bootstrap-4.1.3.min.js"></script>
<script src="assets/js/vendor/wow.min.js"></script>
<script src="assets/js/vendor/owl-carousel.min.js"></script>
<script src="assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
<script src="assets/js/vendor/jquery.nice-select.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
