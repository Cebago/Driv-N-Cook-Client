/**
 *
 * @param idtruck
 */
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
                        thd.className = "text-center";
                        thd.id = myJson[i]["openDay"];
                        thd.innerText = myJson[i]["openDay"];
                        thd.setAttribute("rowspan", "1");
                        tr.appendChild(thd);
                    } else {
                        let rowspan = Number(search.getAttribute("rowspan"));
                        rowspan += 1;
                        search.setAttribute("rowspan", "" + rowspan);
                        search.className = "align-middle text-center";
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
                                            'truckMenu.php?idTruck=' + myJson[i]["idTruck"],
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

/**
 *
 * @param cart
 * @param menu
 */
function deleteMenuQuantity(cart, menu) {

    let input = document.getElementById("inputMenu" + menu);
    let inputPrice = document.getElementById("inputPriceMenu" + menu);
    const count = document.getElementById('count');
    inputPrice = inputPrice.innerText.split("€")[0];
    if (Number(input.innerText) > 1) {
        const request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    if (request.responseText !== "") {
                        alert(request.responseText);
                    } else {
                        count.innerText = Number(count.innerText) - 1;
                        input.innerText = Number(input.innerText) - 1;
                        let total = document.getElementById("total" + cart);
                        if (total !== null) {
                            let tmp = total.innerText.split("€")[0];
                            tmp = Number(tmp) - Number(inputPrice);
                            total.innerText = tmp + "€";
                        }
                    }
                }
            }
        };
        request.open('GET', 'functions/deleteMenu.php?cart=' + cart + '&menu=' + menu);
        request.send();
    } else {
        completelyMenuDelete(cart, menu);
    }
}

/**
 *
 * @param cart
 * @param menu
 */
function addMenuQuantity(cart, menu) {
    let input = document.getElementById("inputMenu" + menu);
    let inputPrice = document.getElementById("inputPriceMenu" + menu);
    const count = document.getElementById('count');
    inputPrice = inputPrice.innerText.split("€")[0];
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                if (request.responseText !== "") {
                    $('#staticModal').modal('show');
                } else {
                    if (input != null) {
                        input.innerText = Number(input.innerText) + 1;
                    }
                    if (count != null) {
                        count.innerText = Number(count.innerText) + 1;
                    }
                    let total = document.getElementById("total" + cart);
                    if (total !== null) {
                        let tmp = total.innerText.split("€")[0];
                        tmp = Number(tmp) + Number(inputPrice);
                        total.innerText = tmp + "€";
                    }
                }
            }
        }
    };
    request.open('GET', 'functions/addMenu.php?cart=' + cart + '&menu=' + menu);
    request.send();
}

/**
 *
 * @param cart
 * @param menu
 */
function completelyMenuDelete(cart, menu) {
    const count = document.getElementById('count');
    let deleteMenu = document.getElementById("deleteMenu" + menu);
    let qty = document.getElementById("inputMenu" + menu);
    let inputPrice = document.getElementById("inputPriceMenu" + menu);
    inputPrice = inputPrice.innerText.split("€")[0];
    qty = Number(qty.innerText);
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                if (request.responseText !== "") {
                    alert(request.responseText);
                } else {
                    if (Number(count.innerText > Number(qty.innerText))) {
                        count.innerText = Number(count.innerText) - Number(qty.innerText);
                    } else {
                        count.innerText = 0;
                    }
                    let total = document.getElementById("total" + cart);
                    if (total !== null) {
                        let tmp = total.innerText.split("€")[0];
                        tmp = Number(tmp) - qty * Number(inputPrice);
                        total.innerText = tmp + "€";
                    }
                    deleteMenu.remove();
                }
            }
        }
    };
    request.open('GET', 'functions/completelyDelete.php?cart=' + cart + '&menu=' + menu);
    request.send();
}

/**
 *
 * @param cart
 * @param product
 */
function deleteProductQuantity(cart, product) {

    let input = document.getElementById("inputProduct" + product);
    const count = document.getElementById('count');
    let inputPrice = document.getElementById("inputPriceProduct" + product);
    inputPrice = inputPrice.innerText.split("€")[0];
    if (Number(input.innerText) > 1) {
        const request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    if (request.responseText !== "") {
                        alert(request.responseText);
                    } else {
                        count.innerText = Number(count.innerText) - 1;
                        input.innerText = Number(input.innerText) - 1;
                        let total = document.getElementById("total" + cart);
                        if (total !== null) {
                            let tmp = total.innerText.split("€")[0];
                            tmp = Number(tmp) - Number(inputPrice);
                            total.innerText = tmp + "€";
                        }
                    }
                }
            }
        };
        request.open('GET', 'functions/deleteProduct.php?cart=' + cart + '&product=' + product);
        request.send();
    } else {
        completelyProductDelete(cart, product);
    }

}

/**
 *
 * @param cart
 * @param product
 */
function addProductQuantity(cart, product) {
    let input = document.getElementById("inputProduct" + product);
    const count = document.getElementById('count');
    let inputPrice = document.getElementById("inputPriceProduct" + product);
    inputPrice = inputPrice.innerText.split("€")[0];
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                if (request.responseText !== "") {
                    $('#staticModal').modal('show');
                } else {
                    if (input != null) {
                        input.innerText = Number(input.innerText) + 1;
                    }
                    if (count != null) {
                        count.innerText = Number(count.innerText) + 1;
                    }
                    let total = document.getElementById("total" + cart);
                    if (total !== null) {
                        let tmp = total.innerText.split("€")[0];
                        tmp = Number(tmp) + Number(inputPrice);
                        total.innerText = tmp + "€";
                    }
                }
            }
        }
    };
    request.open('GET', 'functions/addProduct.php?cart=' + cart + '&product=' + product);
    request.send();
}

/**
 *
 * @param cart
 * @param product
 */
function completelyProductDelete(cart, product) {
    const count = document.getElementById('count');
    let deleteMenu = document.getElementById("deleteProduct" + product);
    let qty = document.getElementById("inputProduct" + product);
    let inputPrice = document.getElementById("inputPriceProduct" + product);
    inputPrice = inputPrice.innerText.split("€")[0];
    qty = Number(qty.innerText);
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                if (request.responseText !== "") {
                    alert(request.responseText);
                } else {
                    if (Number(count.innerText > Number(qty.innerText))) {
                        count.innerText = Number(count.innerText) - Number(qty.innerText);
                    } else {
                        count.innerText = 0;
                    }
                    let total = document.getElementById("total" + cart);
                    if (total !== null) {
                        let tmp = total.innerText.split("€")[0];
                        tmp = Number(tmp) - qty * Number(inputPrice);
                        total.innerText = tmp + "€";
                    }
                    deleteMenu.remove();
                }
            }
        }
    };
    request.open('GET', 'functions/completelyProductDelete.php?cart=' + cart + '&product=' + product);
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

var events, results;

function getListOfEvents() {
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                if (request.responseText !== '') {
                    events = JSON.parse(request.responseText);
                    getLocation();
                }
            }
        }
    };
    request.open('GET', 'functions/getEvents.php');
    request.send();
}


function getLocation() {

    if (navigator.geolocation) {//si la geoloc est activé sur le navigateur
        //on appelle la méthode getCurrentPosition qui appelle l'api du navigateur (par défaut google)
        //on lui met en paramètre les fonctions qui seront appellées en retour, success or error
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
        errorCallback()
    }

}

function errorCallback(result) {
    console.log(result);
    for (let j = 0; j < events.length; j++) {
        printEvent(j, null)
    }
}

function successCallback(position) {
    let pos = {
        'lng': position.coords.longitude,
        'lat': position.coords.latitude
    }
    calculDistance(pos);
}


function calculDistance(origin) {
    let addressTab = [];
    events.forEach(function (event) {
        addressTab.push(event["eventAddress"] + " " + event["eventCity"] + " " + event["eventPostalCode"]);
    })

    var service = new google.maps.DistanceMatrixService();
    let options = {
        origins: [origin],
        destinations: addressTab,
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC,
    }
    service.getDistanceMatrix(options, callback);

    function callback(response, status) {
        results = response.rows[0].elements;
        results = sortDistances(results);
        for (let j = 0; j < results.length; j++) {
            printEvent(j, status);
        }
    }

}

function printEvent(j, status) {

    let child = document.getElementById("containerToEvents");

    let cardDiv = document.createElement('div');
    cardDiv.className = "col-md-4 my-2";
    cardDiv.setAttribute("onclick", "window.location.href='eventsDetails.php?idEvent=" + events[j]["idEvent"] + "'");
    child.appendChild(cardDiv);

    let cartDiv2 = document.createElement('div');
    cartDiv2.className = "single-food";
    cardDiv.appendChild(cartDiv2);

    let cartImg = document.createElement('div');
    cartImg.className = "food-img";
    cartDiv2.appendChild(cartImg);

    let img = document.createElement('img');
    img.src = events[j]["eventImg"];
    img.className = "img-fluid"
    img.style.height = "250px"
    cartImg.appendChild(img);

    let content = document.createElement('div');
    content.className = "food-content";
    cartDiv2.appendChild(content);

    let post = document.createElement('div');
    cartImg.className = "post-admin d-lg-flex mb-3";
    content.appendChild(post);

    let spanTruck = document.createElement('span');
    spanTruck.innerHTML = '<i class="fa fa-user"></i> ' + events[j]["truckName"] + "<br>";
    post.appendChild(spanTruck);

    let spanDate = document.createElement('span');
    spanDate.innerHTML = '<i class="fa fa-calendar-o mr-2"></i>' + events[j]["eventBeginDate"] + "<br>";
    post.appendChild(spanDate);
    if (status == 'OK') {
        let spanDistance = document.createElement('span');
        spanDistance.innerHTML = '<i class="fa fa-map-signs mr-2"></i>' + results[j].distance.text + "<br>";
        post.appendChild(spanDistance);
    }

    let eventName = document.createElement('h5');
    eventName.textContent = events[j]["eventName"];
    content.appendChild(eventName);

    let eventDetails = document.createElement('p');
    eventDetails.className = "pt-3 eventText ";
    eventDetails.textContent = events[j]["eventDesc"];
    content.appendChild(eventDetails);

}


function sortDistances(array) {
    return array.sort(function (rowA, rowB) {
        let a = rowA.distance.value;
        let b = rowB.distance.value;
        return a < b ? -1 : a > b ? 1 : 0;
    })
}
