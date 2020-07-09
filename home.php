<?php
session_start();
require('navbar.php');
$truckMenu = [];
$count = 0;
?>
<body>
<!-- Header Area End -->

<!-- Banner Area Starts -->
<section class="banner-area text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><?php echo getTranslate("titre1", $tabLang, $setLanguage); ?></h6>
                <h1><?php echo getTranslate("titre2", $tabLang, $setLanguage); ?></h1>
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
                    <h3>
                        <span class="style-change"><?php echo getTranslate("bienvenue", $tabLang, $setLanguage); ?></span>&nbsp<?php echo getTranslate("chez", $tabLang, $setLanguage); ?>
                    </h3>
                    <p class="pt-3"><?php echo getTranslate("descriptionHome", $tabLang, $setLanguage); ?></p>
                    <a href="./viewTrucks.php"
                       class="template-btn mt-3"><?php echo getTranslate("voirTruck", $tabLang, $setLanguage); ?></a>
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
                <h2><?php echo getTranslate("titreMenuHome", $tabLang, $setLanguage); ?></h2>
                <h4 class="mt-1"><?php echo getTranslate("descriptionMenuHome", $tabLang, $setLanguage); ?></h4>
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
            foreach ($getMenus as $getMenu) {
                if ($count < '6') {
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
                                        <span class="style-change"><?php echo number_format($getMenu["menuPrice"], 2) . "€"; ?></span>
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
                    <h3>
                        <?php
                        echo getTranslate("eventPres", $tabLang, $setLanguage);
                        ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider owl-carousel">
                    <?php foreach ($events as $event) { ?>
                        <div class="single-slide d-sm-flex" style="height: 200px;">
                            <div class="customer-img mr-4 mb-4 mb-sm-0">
                                <img src="<?php echo $event["eventImg"] ?>" alt="">
                            </div>
                            <div class="customer-text">
                                <h5><?php echo $event["eventName"] ?></h5>
                                <span><i><?php echo $event["truckName"] ?></i></span>
                                <p class="pt-3 eventText "><?php echo $event["eventDesc"] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Area End -->

<?php
require 'footer.php';
?>
