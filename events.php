<?php
require 'navbar.php';


?>
<body onload="getListOfEvents()"></body>


<!-- Banner Area Starts -->
<section class="banner-area banner-area2 contact-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i>Découvrez les évènements près de chez vous</i></h1>

            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Food Area starts -->
<section class="update-area section-padding">
    <div class="container">
        <div class="row" id="containerToEvents">


        </div>
    </div>
</section>

<script src="scripts/scripts.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr_vOUs3BJrToO67yuX8dmTYvr8qCbWB8&callback=calculDistance">
</script>

<?php include "footer.php"; ?>

