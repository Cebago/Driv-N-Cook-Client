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
                <h1><i>Our Menu</i></h1>
                <p class="pt-2"><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->


<div class="mapModal" id="mapAllTrucks"></div>


<!-- Food Area starts -->
<section class="food-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="section-top">
                    <h3><span class="style-change">we serve</span> <br>delicious food</h3>
                    <p class="pt-3">They're fill divide i their yielding our after have him fish on there for greater man moveth, moved Won't together isn't for fly divide mids fish firmament on net.</p>
                </div>
            </div>
        </div>

        <div class="row">
        <?php
            foreach ($listTrucks as $truck){
        ?>
        <!-- truck block -->
            <div class="col-md-4 col-sm-6">
                <div class="single-food">
                    <div class="food-img">
                        <img src="<?php echo $truck["truckPicture"]?>" class="img-fluid" style="height: 350px">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5><?php echo $truck["truckName"]?> </h5>

                                <?php
                                if (isOpen($truck["idTruck"])){
                                    echo '<span class="style-change" style="color: green"> Ouvert </span>';
                                }else{
                                    echo '<span class="style-change" style="color: darkred"> Fermé </span>';
                                }

                                ?>

                        </div>
                        <p class="pt-3"><?php echo $truck["categorie"]?> </p>
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr_vOUs3BJrToO67yuX8dmTYvr8qCbWB8&callback=initMap"></script>
<script src="scripts/scripts.js"></script>

<?php include "footer.php"; ?>

