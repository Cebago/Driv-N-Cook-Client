<?php
require 'navbar.php';

if($_GET["idEvent"] != ""){
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT * FROM EVENTS WHERE idEvent = :idEvent;");
    $queryPrepared->execute([
        ":idEvent" => $_GET["idEvent"]
    ]);
    $events = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

}
?>
<!-- Banner Area Starts -->
<section class="banner-area banner-area2 contact-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i><?php foreach ($events as $name){ echo $name["eventName"]; }?></i></h1>

            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Food Area starts -->
<section class="update-area section-padding">
    <div class="container">
        <div class="row">
            <?php foreach ($events as $event){?>
            <div class="food-content">
                <h5><?php echo $event["eventDesc"]; ?> </h5>

                <div class="card mb-3 mt-5" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="single-slide d-sm-flex" style="height: 200px;">
                            <div class="customer-img mr-4 mb-4 mb-sm-0">
                                <img src="<?php echo $event["eventImg"] ?>" alt="" class="mb-4">
                            </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $event["eventType"]; ?></h5>
                                <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp<?php echo $event["eventAddress"] .", ". $event["eventPostalCode"]." ". $event["eventCity"]; ?></p>
                                <p class="card-text"><?php echo $event["eventBeginDate"] ."&nbsp=>&nbsp". $event["eventEndDate"];?></p>
                                <p class="card-text"><small class="text-muted"><?php echo $event["eventStartHour"] ." / ". $event["eventEndHour"];?></small></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    <?php } ?>
        </div>
    </div>
</section>


<?php require 'footer.php';?>