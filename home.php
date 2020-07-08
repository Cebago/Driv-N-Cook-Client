<?php

require('navbar.php');
$truckMenu=[];
$count = 0;
?>

</head>
<body>


<!-- Header Area Starts -->
<div class="sticky-top ">
    <header class="header-area shadow-lg p-3 mb-5 bg-info rounded-pill">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="index.html"><img src="/img/logo.png" alt="logo"></a>
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
                            <li class="active"><a
                                        href="index.html"><?php getTranslate("accueil", $tabLang, $setLanguage); ?></a>
                            </li>
                            <li><a href="about.html"><?php getTranslate("nos camions", $tabLang, $setLanguage); ?></a>
                            </li>
                            <li><a href="menu.html"><?php getTranslate("evenements ", $tabLang, $setLanguage); ?></a>
                            </li>
                            <li>
                                <a href="animateTruck.html"><?php getTranslate("rejoignez-nous", $tabLang, $setLanguage); ?></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdown09" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false"><span
                                            class="flag-icon <?php echo $headerTabLang[$setLanguage]["icon"] ?>"> </span> <?php echo $headerTabLang[$_COOKIE['Lang']]["name"] ?>
                                </a>
                                <div class="dropdown-menu bg-info border-light" aria-labelledby="dropdown09">
                                    <?php
                                    foreach ($headerTabLang as $key => $value) {
                                        if ($key != $setLanguage)
                                            echo "<a class=\"dropdown-item\" href=\"./functions/changeLanguage.php?lang=" . $key . "\" ><span class=\"flag-icon " . $value['icon'] . "\"> </span> " . $value['name'] . "</a>";
                                    } ?>


                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
<!-- Header Area End -->

<!-- Banner Area Starts -->
<section class="banner-area text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><?php getTranslate("titre1", $tabLang, $setLanguage); ?></h6>
                <h1><?php getTranslate("titre2", $tabLang, $setLanguage); ?></h1>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->



<!-- Welcome Area Starts -->
<section class="welcome-area section-padding4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <div class="welcome-img">
                    <img src="assets/images/welcome-bg.png" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-6 align-self-center">
                <div class="welcome-text mt-5 mt-md-0">
                    <h3><span class="style-change"><?php getTranslate("bienvenue", $tabLang, $setLanguage); ?></span>&nbsp<?php getTranslate("chez", $tabLang, $setLanguage); ?></h3>
                    <p class="pt-3"><?php getTranslate("descriptionHome", $tabLang, $setLanguage); ?></p>
                    <a href="#" class="template-btn mt-3"><?php getTranslate("voirTruck", $tabLang, $setLanguage); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Welcome Area End -->

<!-- Reservation Area Starts -->
<div class="reservation-area section-padding text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?php getTranslate("titreMenuHome", $tabLang, $setLanguage); ?></h2>
                <h4 class="mt-1"><?php getTranslate("descriptionMenuHome", $tabLang, $setLanguage); ?></h4>
            </div>
        </div>
    </div>
</div>
<!-- Reservation Area End -->

<!-- Food Area starts -->
<section class="food-area section-padding">
    <div class="container">
        <div class="row">
            <?php $getMenus = getMenuForHomePage();
            foreach ($getMenus as $getMenu){
                if($count < '6'){
                    if (!in_array($getMenu["truck"], $truckMenu)) {
                        ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="single-food">
                                <div class="food-img">
                                    <img src="assets/images/food1.jpg" class="img-fluid" alt="">
                                </div>
                                <div class="food-content">
                                    <div class="d-flex justify-content-between">
                                        <h5><?php echo $getMenu["menuName"]; ?></h5>
                                        <span class="style-change"><?php echo number_format($getMenu["menuPrice"],2)."€"; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $truckMenu[] = $getMenu["truck"];
                        $count++;
                    }
                }
            } ?>
        </div>
    </div>
</section>
<!-- Food Area End -->


<?php

$events = getEventsPreview();

?>

<!-- Testimonial Area Starts -->
<section class="testimonial-area section-padding4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-top2 text-center">
                    <h3>Nos <span>événements</span></h3>
                    <p><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider owl-carousel">
                    <?php foreach ($events as $event){?>
                    <div class="single-slide d-sm-flex" style="height: 200px;">
                        <div class="customer-img mr-4 mb-4 mb-sm-0">
                            <img src="<?php echo $event["eventImg"]?>" alt="">
                        </div>
                        <div class="customer-text">
                            <h5><?php echo $event["eventName"] ?></h5>
                            <span><i><?php echo $event["truckName"] ?></i></span>
                            <p class="pt-3 eventText "><?php echo $event["eventDesc"] ?></p>
                        </div>
                    </div>
                   <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Area End -->



<!-- Footer Area Starts -->
<footer class="footer-area">
    <div class="footer-widget section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="single-widget single-widget1">
                        <a href="index.html"><img src="assets/images/logo/logo2.png" alt=""></a>
                        <p class="mt-3">Which morning fourth great won't is to fly bearing man. Called unto shall seed,
                            deep, herb set seed land divide after over first creeping. First creature set upon stars
                            deep male gathered said she'd an image spirit our</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-widget single-widget2 my-5 my-md-0">
                        <h5 class="mb-4"><?php getTranslate("contactezNous", $tabLang, $setLanguage); ?></h5>
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
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                        <span>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by
                                <a href="https://colorlib.com" target="_blank">Colorlib</a></span>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="social-icons">
                        <ul>
                            <li class="no-margin">Follow Us</li>
                            <li><a href="https://www.facebook.com/ESGIParis"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/ESGI?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/esgiparis/?hl=fr"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<?php
require 'footer.php';
?>
