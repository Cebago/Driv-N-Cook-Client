<?php
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
                <h1><i>Elements</i></h1>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Start Sample Area -->
<section class="sample-text-area">
    <div class="container">
        <h3 class="text-heading title_color">Une petite faim ?</h3>
        <p class="sample-text">
            N'hésitez pas à créer un compte pour pouvoir profiter de tous les avantages.
        </p>
    </div>
</section>
<!-- End Sample Area -->

<!-- Start Button -->
<section class="button-area mb-5 section-padding4">
    <div class="pt-5 container mb-3">
        <div class="col-xs-10 col-sm-10  col-lg-6 mx-auto">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab"
                       aria-controls="home" aria-selected="true">Se connecter</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#signin" role="tab"
                       aria-controls="profile" aria-selected="false">S'inscrire</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="card mx-auto p-5 tab-pane fade show active" id="login">
                    <div class="card-body">
                        <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'><li>Identifiants incorrects</div>";
                        }
                        ?>
                        <form method="POST" action="login.php">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inputEmail">
                                        Addresse email :
                                    </label>
                                    <input type="email" id="inputEmail" class="form-control focus"
                                           placeholder="Adresse mail" required="required" autofocus="autofocus"
                                           name="inputEmail"
                                           value="<?php echo (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '' ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inputPassword">
                                        Mot de passe :
                                    </label>
                                    <input type="password" id="inputPassword" class="form-control focus"
                                           placeholder="Mot de passe" required="required" name="inputPassword">
                                </div>
                            </div>
                            <input class="genric-btn primary circle " type="submit" value="Connexion">
                        </form>
                        <div class="text-center">
                            <a class="d-block small pt-3 text-center text-secondary" href="forgotPassword.php">Mot de
                                passe oublié ?
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="signin">
                    <div class="card card-login mx-auto p-5">
                        <div class="card-body">
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
                            <form method="POST" action="addUser.php" enctype="multipart/form-data">
                                <div class="form-label-group">
                                    <div class="form-row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <!-- Prénom -->
                                                <label for="firstName">
                                                    Prénom :
                                                </label>
                                                <input type="text" id="firstName" class="form-control focus"
                                                       placeholder="Prénom" required="required" name="firstName"
                                                       value="<?php echo (isset($_SESSION["inputErrors"]))
                                                           ? $_SESSION["inputErrors"]["firstName"]
                                                           : ""; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <!-- Nom -->
                                                <label for="lastName">
                                                    Nom :
                                                </label>
                                                <input type="text" id="lastName" class="form-control focus"
                                                       placeholder="Nom" required="required" name="lastName"
                                                       value="<?php echo (isset($_SESSION["inputErrors"]))
                                                           ? $_SESSION["inputErrors"]["lastName"]
                                                           : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- Email -->
                                    <label for="inputEmail">
                                        Adresse email :
                                    </label>
                                    <input type="email" id="inputEmail" class="form-control focus" placeholder="Email"
                                           required="required" name="inputEmail"
                                           value="<?php echo (isset($_SESSION["inputErrors"]))
                                               ? $_SESSION["inputErrors"]["inputEmail"]
                                               : ""; ?>">
                                </div>
                                <div class="form-group">
                                    <!-- Mot de passe -->
                                    <label for="inputPassword">
                                        Mot de passe :
                                    </label>
                                    <input type="password" id="inputPassword" class="form-control focus"
                                           placeholder="Mot de passe" required="required" name="inputPassword"
                                           autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <!-- Confirmation mot de passe -->
                                    <label for="confirmPassword">
                                        Confirmation de mot de passe :
                                    </label>
                                    <input type="password" id="confirmPassword" class="form-control focus"
                                           placeholder="Confirmation mot de passe" required="required"
                                           name="confirmPassword" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <!-- Captcha image -->
                                        <img src="captcha.php" alt="captcha">
                                    </div>
                                    <!-- Captcha réponse -->
                                    <label for="inputCaptcha">
                                        Captcha :
                                    </label>
                                    <input type="text" name="captcha" id="inputCaptcha" placeholder="Captcha"
                                           required="required" class="form-control focus" autocomplete="off">
                                </div>
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" name="newsletterAgreement" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">J'accepte de recevoir les newsletter par email</label>
                                </div>
                                <input class="genric-btn primary circle" type="submit" value="Inscription">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Button -->

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
