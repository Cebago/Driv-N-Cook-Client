<?php
require 'navbar.php';

$pdo = connectDB();
$queryPrepared = $pdo->prepare("SELECT idEvent, eventDesc, eventImg, eventType, eventName, eventAddress, eventCity, eventPostalCode, eventBeginDate, eventEndDate, eventStartHour, eventEndHour FROM EVENTS, HOST, TRUCK WHERE event = idEvent AND truck = idTruck AND eventType = 'Dégustation'");
$queryPrepared->execute();

$info = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);



?>
<button onclick="getLocation('<?php echo $info[0]["eventAddress"].' '.$info[0]["eventPostalCode"].' '.$info[0]["eventCity"] ?>')"> COUCOU </button>


<script>

    function getLocation(destination) {

        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            calculDistance(pos, destination)
        });
    }



    function calculDistance(origin, destination) {

        console.dir(destination);


        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
            {
                origins: [origin],
                destinations: [destination],
                travelMode: 'DRIVING',
                unitSystem:  google.maps.UnitSystem.METRIC,
            }, callback);

        function callback(response, status) {
            var results = response.rows[0].elements;
            for (var j = 0; j < results.length; j++) {
                console.log("Distance : " + results[j].distance.text);
            }
        }

    }






</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr_vOUs3BJrToO67yuX8dmTYvr8qCbWB8&callback=calculDistance">
</script>

<?php include "footer.php"; ?>

