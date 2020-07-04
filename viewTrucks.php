<?php

require 'navbar.php';


$listTrucks = getTrucks();
?>

</head>
<body onload="showMap()">

<!-- Banner Area Starts -->
<section class="banner-area banner-area2 menu-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i><?php getTranslate("Nos menus", $tabLang, $setLanguage) ?></i></h1>
                <p class="pt-2"><i><?php getTranslate("titreViewTrucks1", $tabLang, $setLanguage) ?></i></p>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->


<div class="mapModal" id="mapAllTrucks"></div>


<!-- Food Area starts -->
<section class="food-area section-padding">
    <div class="container">

        <div class="btn-group btn-group-toggle " data-toggle="buttons">
            <label class="btn btn-success active">
                <input type="radio" name="options" id="option1" autocomplete="off" onclick="removeFilterTruck()"
                       checked><?php getTranslate("Tous", $tabLang, $setLanguage) ?>
            </label>
            <label class="btn btn-success">
                <input type="radio" name="options" id="option2" autocomplete="off"
                       onclick="filterTruck()"> <?php getTranslate("Ouvert", $tabLang, $setLanguage) ?>
            </label>
        </div>

        <div class="row">
            <?php
            foreach ($listTrucks as $truck) {
                ?>
                <!-- truck block -->
                <div class="col-md-4 col-sm-6 truckCard" style="margin-top: 10px; display: block"
                     onclick="location.href='http://127.0.0.1/Driv-N-Cook-Client/truck.php?idTruck=<?php echo $truck["idTruck"] ?>'">
                    <div class="single-food">
                        <div class="food-img">
                            <img src="<?php echo $truck["truckPicture"] ?>" class="img-fluid" style="height: 350px">
                        </div>
                        <div class="food-content">
                            <div class="d-flex justify-content-between">
                                <h5><?php echo $truck["truckName"] ?> </h5>
                                <?php
                                if (isOpen($truck["idTruck"])) {
                                    echo '<span class="style-change" style="color: green">';
                                    getTranslate("Ouvert", $tabLang, $setLanguage);
                                } else {
                                    echo '<span class="style-change isClosed" style="color: darkred">';
                                    getTranslate("Fermé", $tabLang, $setLanguage);
                                }
                                echo '</span>'

                                ?>

                            </div>
                            <p class="pt-3"><?php echo $truck["categorie"] ?> </p>
                        </div>
                    </div>
                </div>
                <!-- End truck block -->

                <?php
            }
            ?>
        </div>


    </div>
</section>
<!-- Food Area End -->

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr_vOUs3BJrToO67yuX8dmTYvr8qCbWB8&callback=initMap"></script>
<script src="scripts/scripts.js"></script>

<?php include "footer.php"; ?>

