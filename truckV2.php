<?php

require('navbar.php');

if(!isset( $_GET['idTruck'])){
    header("Location: 404.html");
}
?>
    </head>
        <body onload="getOpenDays('<?php echo $_GET['idTruck']?>')">

    </body>

<script src="scripts/scripts.js"></script>
<?php include "footer.php"; ?>

