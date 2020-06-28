<?php

require('navbar.php');

if(!isset( $_GET['idTruck'])){
    header("Location: 404.html");
}
?>
    </head>
        <body onload="getOpenDays('<?php echo $_GET['idTruck']?>')">

        <div class="mt-1">
            <div class="tab-content card mt-1" id="myTabContent">
                <div class="tab-pane fade show active" id="openDays" role="tabpanel"  aria-labelledby="home-tab">
                    <table class="table" id="openTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Jour de la semaine</th>
                            <th scope="col">Ouverture</th>
                            <th scope="col">Fermeture</th>
                        </tr>
                        </thead>
                        <tbody id="tableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

<script src="scripts/scripts.js"></script>
<?php include "footer.php"; ?>

