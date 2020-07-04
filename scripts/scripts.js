function getOpenDays(idtruck) {
    const table = document.getElementById("tableBody");
    table.innerText = "";

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                let myJson = JSON.parse(request.responseText);
                const tbody = document.getElementById("tableBody");
                for (let i = 0; i < myJson.length; i++) {
                    const tr = document.createElement("tr");
                    const search = document.getElementById(myJson[i]["openDay"]);
                    if (search === null) {
                        const thd = document.createElement("th");
                        thd.scope = "row";
                        thd.id = myJson[i]["openDay"];
                        thd.innerText = myJson[i]["openDay"];
                        tr.appendChild(thd);
                    } else {

                        search.setAttribute("rowspan", "2");
                        search.className = "align-middle";
                    }
                    const td1 = document.createElement("td");
                    td1.innerText = myJson[i]["startHour"];
                    td1.className = "text-center";
                    const td2 = document.createElement("td");
                    td2.innerText = myJson[i]["endHour"];
                    td2.className = "text-center";
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tbody.appendChild(tr);
                }
            }
        }
    };
    request.open('POST', 'functions/getOpenDays.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(
        'truck=' + idtruck
    );
    setTimeout(refreshTable, 1000);
}

function refreshTable() {
    const content = document.getElementById("tablebody");

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                //console.log(request.responseText);
                content.innerHTML = request.responseText;
            }
        }
    };
    request.open('GET', './functions/getTruckList.php', true);
    request.send();
}

function showMap() {
    let opt = {  //point où regarder
        center: new google.maps.LatLng(48.8376962, 2.3896693),
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map;

    map = new google.maps.Map(document.getElementById("mapAllTrucks"), opt);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                if (request.responseText !== "") {
                    let myJson = JSON.parse(request.responseText);
                    console.log(myJson);
                    for (let i = 0; i < myJson.length; i++) {

                        let geocoder = new google.maps.Geocoder; //affiche la localisation du camion
                        let latlng = {lat: parseFloat(myJson[i]["lat"]), lng: parseFloat(myJson[i]["lng"])};
                        geocoder.geocode({'location': latlng}, function (results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    var marker = new google.maps.Marker({
                                        position: latlng,
                                        icon: 'img/truck.png',
                                        map: map
                                    });
                                    var smallInfoString = '<div id="content" class="dataInfos">' +
                                        '<div id="siteNotice">' +
                                        '</div>' +
                                        '<h5>' + myJson[i]["truckName"] + '</h5>' +
                                        '<img src = "' + myJson[i]["truckPicture"] + '" style="width: 100px">' +
                                        '<div>' + results[i].formatted_address + '</div>' +
                                        '<div id="bodyContent">' +
                                        '</div>';
                                    let smallInfo = new google.maps.InfoWindow({
                                        content: smallInfoString
                                    });


                                    marker.addListener('mouseover', function () {
                                        smallInfo.open(map, marker);
                                    });
                                    marker.addListener('mouseout', function () {
                                        smallInfo.close(map, marker);
                                    });
                                    marker.addListener('click', function () {
                                        window.open(
                                            'http://127.0.0.1/Driv-N-Cook-Client/truck.php?idTruck=' + myJson[i]["idTruck"],
                                            '_blank'
                                        );
                                    });

                                } else {
                                    window.alert('No results found');
                                }
                            } else {
                                window.alert('Geocoder failed due to: ' + status);
                            }
                        });
                    }
                }
            }
        }
        return 0;
    };
    request.open('GET', 'functions/getTruck.php');
    request.send();
}

function filterTruck() {
    let closed = document.getElementsByClassName("isClosed");
    for (let i = 0; i < closed.length; i++) {
        closed[i].parentElement.parentElement.parentElement.parentElement.style.display = "none";
    }
}

function removeFilterTruck() {
    let closed = document.getElementsByClassName("isClosed");
    for (let i = 0; i < closed.length; i++) {
        closed[i].parentElement.parentElement.parentElement.parentElement.style.display = "block";
    }
}

