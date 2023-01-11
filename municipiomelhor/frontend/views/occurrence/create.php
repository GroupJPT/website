<?php

use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Criar Ocorrência || MunicípioMelhor!';
?>

<div class="row occ-create">
    <div class="col-7">
        <div id="map"></div>
    </div>

    <?php $form = ActiveForm::begin([
        'action' => '/occurrence/create',
        'options' => [
            'class' => 'col-5'
        ]
    ]); ?>
    <div class="row-cols-1">

        <!-- Step 1 -->
        <div class="col occ-form-page occ-create-active">
            <h2>1. Selecione a categoria.</h2>
            <p>Em que categoria se encaixa o seu problema?</p>

            <?php

            $dataCategory = ArrayHelper::map(Category::find()->all(), 'id', 'name');

            echo $form->field($model, 'category_id')->dropDownList(
                $dataCategory,
                [
                    'prompt'=>'Selecione a categoria',

                    'onchange'=>'
                        $.get(
                            "'.Url::toRoute('occurrence/subcategories').'",
                            { id: $(this).val() },
                            function(res){
                                $("#occurrence-subcategory_id").html(res);
                            },
                        ); visibleSubcategory();
                    '])->label("Categoria");

            echo $form->field($model, 'subcategory_id')->dropDownList(['prompt'=>'Selecione uma Categoria'])->label("");

            ?>

        </div>

        <!-- Step 2 -->
        <div class="col occ-form-page">
            <h2>2. Qual é a rua?</h2>
            <p>Rua</p>
            <?= $form->field($model, 'address')->textInput() ?>
            <?= $form->field($model, 'postal_code')->textInput() ?>
            <?= $form->field($model, 'region')->textInput() ?>
        </div>

        <!-- Step 3 -->
        <div class="col occ-form-page">
            <h2>3. Descrição.</h2>
            <p>Descrição</p>
            <?= $form->field($model, 'description')->textarea() ?>
        </div>

        <!--
        <div class="col occ-form-page">
            <h2>4. Fotografias.</h2>
            <p>Fotografias</p>
        </div>
        -->

        <!-- Step 4 -->
        <div class="col occ-form-page">
            <h2>Confirmação dos dados.</h2>
            <p id="final-category"></p>
            <p id="final-subcategory"></p>
            <p id="final-address"></p>
            <p id="final-description"></p>
            <div style="display: none;">
                <?= $form->field($model, 'lat')->textInput() ?>
                <?= $form->field($model, 'lng')->textInput() ?>
            </div>

        </div>



        <div class="col occ-btns">
            <div class="row">
                <div class="col-6 d-flex flex-column align-items-center">
                    <button type="button" id="occ-create-prev" class="btn btn-dark" onclick="nextPrev(-1)">Anterior</button>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <button type="button" id="occ-create-next" class="btn btn-dark" onclick="nextPrev(1)">Proximo</button>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>




























    <script>
        var page = 0;
        showCreatePage(page);

        function showCreatePage(n) {
            var x = document.getElementsByClassName("occ-form-page");
            x[n].style.display = "block";

            if (n == 0)
                document.getElementById("occ-create-prev").style.display = "none";
            else
                document.getElementById("occ-create-prev").style.display = "inline";
        }

        function nextPrev(n) {
            switch (page) {
                case 0:
                    if(document.getElementById("occurrence-category_id").value == "" || document.getElementById("occurrence-subcategory_id").value == "") return false;
                    break;
                case 1:
                    if(document.getElementById("occurrence-category_id").value == "") return false;
                    break;
            }

            var x = document.getElementsByClassName("occ-form-page");
            x[page].style.display = "none";
            page = page + n;
            if (page == 3) {
                document.getElementById("final-category").innerHTML = "Categoria: "+document.getElementById("occurrence-category_id").text;
                document.getElementById("final-subcategory").innerHTML = "Subcategoria: "+document.getElementById("occurrence-subcategory_id").text;
                document.getElementById("final-address").innerHTML = "Morada: "+document.getElementById('occurrence-address').value + ", " +document.getElementById('occurrence-postal_code').value + " " + document.getElementById('occurrence-region').value;
                document.getElementById("final-description").innerHTML = "Descrição: "+document.getElementById("occurrence-description").value;
                document.getElementById("occ-create-next").textContent = "Submeter"
            }
            else if(page == 4){
                document.getElementById("occ-create-next").type = "submit";
                return;
            }
            else{
                document.getElementById("occ-create-next").type = "button";
                document.getElementById("occ-create-next").textContent = "Próximo"

            }
            showCreatePage(page);
        }

        function visibleSubcategory() {
            if(document.getElementById("occurrence-category_id").value != "") {
                document.getElementById("occurrence-subcategory_id").style.display = "inline";
            }
            else {
                document.getElementById("occurrence-subcategory_id").style.display = "none";
            }
        }

    </script>


    <script>
        const TORRES_VEDRAS_BOUNDS = {
            north: 39.234965,
            south: 38.992024,
            west: -9.469608,
            east: -9.087146,
        };

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 39.1100526, lng: -9.4139981},
                restriction: {
                    latLngBounds: TORRES_VEDRAS_BOUNDS,
                    strictBounds: false,
                },
                streetViewControl: false,
                zoom: 1,
                scrollwheel:true,
                styles: [
                    {
                        "featureType": "landscape.man_made",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural.landcover",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#afdca5"
                            },
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural.terrain",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#c0c0c0"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#444444"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    }
                ]
            });


            var warrenParishCoordinates = [
                {lng: -9.2441, lat: 39.0057},
                {lng: -9.2491, lat: 39.0081},
                {lng: -9.2516, lat: 39.0111},
                {lng: -9.2541, lat: 39.01},
                {lng: -9.254, lat: 39.0119},
                {lng: -9.2579, lat: 39.0135},
                {lng: -9.2656, lat: 39.0217},
                {lng: -9.2756, lat: 39.0202},
                {lng: -9.2888, lat: 39.0214},
                {lng: -9.2925, lat: 39.0235},
                {lng: -9.2911, lat: 39.0268},
                {lng: -9.297, lat: 39.0301},
                {lng: -9.3015, lat: 39.028},
                {lng: -9.3007, lat: 39.0233},
                {lng: -9.303, lat: 39.0225},
                {lng: -9.2988, lat: 39.0179},
                {lng: -9.3019, lat: 39.0172},
                {lng: -9.3005, lat: 39.0141},
                {lng: -9.3035, lat: 39.0144},
                {lng: -9.3055, lat: 39.0126},
                {lng: -9.3039, lat: 39.0104},
                {lng: -9.3062, lat: 39.0063},
                {lng: -9.3096, lat: 39.0058},
                {lng: -9.3121, lat: 39.008},
                {lng: -9.3123, lat: 39.0106},
                {lng: -9.3158, lat: 39.0123},
                {lng: -9.33, lat: 39.01},
                {lng: -9.3347, lat: 39.0141},
                {lng: -9.335, lat: 39.0165},
                {lng: -9.3393, lat: 39.0171},
                {lng: -9.3333, lat: 39.0221},
                {lng: -9.3333, lat: 39.0281},
                {lng: -9.3393, lat: 39.0292},
                {lng: -9.3395, lat: 39.0312},
                {lng: -9.3442, lat: 39.0325},
                {lng: -9.3453, lat: 39.0343},
                {lng: -9.3499, lat: 39.0324},
                {lng: -9.352, lat: 39.0333},
                {lng: -9.3516, lat: 39.036},
                {lng: -9.3555, lat: 39.041},
                {lng: -9.3489, lat: 39.0434},
                {lng: -9.3493, lat: 39.0452},
                {lng: -9.3518, lat: 39.0457},
                {lng: -9.3534, lat: 39.048},
                {lng: -9.351, lat: 39.0506},
                {lng: -9.3511, lat: 39.053},
                {lng: -9.3619, lat: 39.0531},
                {lng: -9.3624, lat: 39.0565},
                {lng: -9.3697, lat: 39.0553},
                {lng: -9.3697, lat: 39.0568},
                {lng: -9.3756, lat: 39.0539},
                {lng: -9.3849, lat: 39.0598},
                {lng: -9.3894, lat: 39.0647},
                {lng: -9.3969, lat: 39.0627},
                {lng: -9.3989, lat: 39.0606},
                {lng: -9.4057, lat: 39.0608},
                {lng: -9.4069, lat: 39.0555},
                {lng: -9.4097, lat: 39.0556},
                {lng: -9.4132, lat: 39.0526},
                {lng: -9.4165, lat: 39.0547},
                {lng: -9.4153, lat: 39.0571},
                {lng: -9.4163, lat: 39.0638},
                {lng: -9.422, lat: 39.0747},
                {lng: -9.4146, lat: 39.0863},
                {lng: -9.4149, lat: 39.0885},
                {lng: -9.406, lat: 39.0972},
                {lng: -9.3943, lat: 39.1124},
                {lng: -9.3929, lat: 39.1168},
                {lng: -9.3943, lat: 39.1213},
                {lng: -9.3734, lat: 39.1481},
                {lng: -9.3668, lat: 39.1615},
                {lng: -9.3589, lat: 39.1724},
                {lng: -9.358, lat: 39.1761},
                {lng: -9.3592, lat: 39.1773},
                {lng: -9.3569, lat: 39.1773},
                {lng: -9.3563, lat: 39.1795},
                {lng: -9.3584, lat: 39.1817},
                {lng: -9.3559, lat: 39.1835},
                {lng: -9.3515, lat: 39.1917},
                {lng: -9.3318, lat: 39.1954},
                {lng: -9.324, lat: 39.1897},
                {lng: -9.3226, lat: 39.1856},
                {lng: -9.3244, lat: 39.1828},
                {lng: -9.3217, lat: 39.1792},
                {lng: -9.3223, lat: 39.1769},
                {lng: -9.3142, lat: 39.1748},
                {lng: -9.3021, lat: 39.1796},
                {lng: -9.2989, lat: 39.1828},
                {lng: -9.2955, lat: 39.1827},
                {lng: -9.2918, lat: 39.1796},
                {lng: -9.2811, lat: 39.1916},
                {lng: -9.2773, lat: 39.1933},
                {lng: -9.2372, lat: 39.1983},
                {lng: -9.2394, lat: 39.2048},
                {lng: -9.2391, lat: 39.213},
                {lng: -9.2414, lat: 39.2156},
                {lng: -9.2298, lat: 39.2162},
                {lng:  -9.2228, lat: 39.2146},
                {lng: -9.2091, lat: 39.2156},
                {lng: -9.2008, lat: 39.2141},
                {lng: -9.1962, lat: 39.2082},
                {lng: -9.191, lat: 39.2082},
                {lng: -9.1745, lat: 39.1937},
                {lng: -9.1561, lat: 39.1882},
                {lng: -9.1544, lat: 39.1839},
                {lng: -9.1561, lat: 39.1794},
                {lng: -9.1434, lat: 39.154},
                {lng: -9.1439, lat: 39.1496},
                {lng: -9.1414, lat: 39.1481},
                {lng: -9.1429, lat: 39.1472},
                {lng: -9.1359, lat: 39.1321},
                {lng: -9.143, lat: 39.1222},
                {lng: -9.1483, lat: 39.1196},
                {lng: -9.1532, lat: 39.1133},
                {lng: -9.1639, lat: 39.1063},
                {lng: -9.1522, lat: 39.0919},
                {lng: -9.1356, lat: 39.0838},
                {lng: -9.1274, lat: 39.0753},
                {lng: -9.1315, lat: 39.0693},
                {lng: -9.1297, lat: 39.0653},
                {lng: -9.1329, lat: 39.0618},
                {lng: -9.1274, lat: 39.0515},
                {lng: -9.1289, lat: 39.045},
                {lng: -9.1258, lat: 39.0369},
                {lng: -9.1334, lat: 39.0323},
                {lng: -9.1358, lat: 39.0349},
                {lng: -9.1473, lat: 39.0315},
                {lng: -9.154, lat: 39.0328},
                {lng: -9.1563, lat: 39.0313},
                {lng: -9.1567, lat: 39.0275},
                {lng: -9.1596, lat: 39.0273},
                {lng: -9.1597, lat: 39.026},
                {lng: -9.1611, lat: 39.0265},
                {lng: -9.1674, lat: 39.0222},
                {lng: -9.1625, lat: 39.0168},
                {lng: -9.1628, lat: 39.015},
                {lng: -9.1678, lat: 39.0148},
                {lng: -9.1671, lat: 39.0124},
                {lng: -9.1699, lat: 39.0122},
                {lng: -9.1689, lat: 39.0104},
                {lng: -9.174, lat: 39.0101},
                {lng: -9.1753, lat: 39.011},
                {lng: -9.1746, lat: 39.0122},
                {lng: -9.177, lat: 39.0115},
                {lng: -9.1806, lat: 39.0131},
                {lng: -9.1817, lat: 39.0088},
                {lng: -9.1839, lat: 39.0084},
                {lng: -9.1835, lat: 39.0103},
                {lng: -9.1879, lat: 39.0093},
                {lng: -9.1899, lat: 39.0116},
                {lng: -9.1933, lat: 39.0119},
                {lng: -9.1933, lat: 39.0094},
                {lng: -9.1948, lat: 39.0093},
                {lng: -9.1931, lat: 39.0089},
                {lng: -9.1971, lat: 39.0082},
                {lng: -9.1942, lat: 39.0086},
                {lng: -9.1946, lat: 39.007},
                {lng: -9.1925, lat: 39.0061},
                {lng: -9.1938, lat: 39.0041},
                {lng: -9.195, lat: 39.0042},
                {lng: -9.1944, lat: 39.0065},
                {lng: -9.1963, lat: 39.0043},
                {lng: -9.1986, lat: 39.0058},
                {lng: -9.1991, lat: 39.0042},
                {lng: -9.2025, lat: 39.0074},
                {lng: -9.2032, lat: 39.0148},
                {lng: -9.2051, lat: 39.0149},
                {lng: -9.2076, lat: 39.0114},
                {lng: -9.2124, lat: 39.0104},
                {lng: -9.2148, lat: 39.0157},
                {lng: -9.2143, lat: 39.0182},
                {lng: -9.223, lat: 39.0198},
                {lng: -9.2339, lat: 39.0075},
                {lng: -9.2378, lat: 39.005},
                {lng: -9.2403, lat: 39.0069},
                {lng: -9.2441, lat: 39.0057},
            ];
            var everythingElse = [
                new google.maps.LatLng(41.784176, -13.595778),
                new google.maps.LatLng(35.422881, -13.595778),
                new google.maps.LatLng(35.422881, -2.311756),
                new google.maps.LatLng(41.784176, -2.311756),
            ];
            var warrenParishBorder = new google.maps.Polygon({
                paths: [everythingElse, warrenParishCoordinates],
                strokeColor: "#000000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#000000",
                fillOpacity: 0.5
            });

            marker = new google.maps.Marker({
                map: map,
                draggable: false
            });

            var geocoder = new google.maps.Geocoder();

            google.maps.event.addListener(map, 'click', function(event) {

                var cityFound = false;
                var streetFound = false;


                if(page == 1) {
                    geocoder.geocode({'location': event.latLng}, function (results, status){
                        if (status === 'OK') {
                            if (results[0]) {

                                cityFound = testRegion(results);
                                if(cityFound) {
                                    streetFound = testStreet(results);
                                    if(streetFound){

                                        if(map.zoom < 14)
                                            map.setZoom(14);
                                        map.setCenter(event.latLng);
                                        marker.setPosition(event.latLng);

                                        document.getElementById('occurrence-address').value = results[0].address_components[1].long_name;
                                        document.getElementById('occurrence-postal_code').value = results[0].address_components[5].long_name;
                                        document.getElementById('occurrence-region').value = results[0].address_components[2].long_name;
                                        document.getElementById("occurrence-lat").value = results[0].geometry.location.lat();
                                        document.getElementById("occurrence-lng").value = results[0].geometry.location.lng();
                                    }
                                    else
                                        sendNotFound();
                                } else
                                    sendNotFound();
                            } else
                                sendNotFound();
                        } else {
                            window.alert('Geocoder fauked due to: '+status);
                        }
                    })
                }
            })

            warrenParishBorder.setMap(map);
        }

        /*
        function addressTest() {

            var geocoder = new google.maps.Geocoder();
            var request = { address: document.getElementById('occurrence-address').value + ", " +document.getElementById('occurrence-postal_code').value + " " + document.getElementById('occurrence-region').value };
            var cityFound = false;
            var streetFound = false;

            geocoder.geocode(request, function (results, status){
                if (status === 'OK') {
                    cityFound = testRegion(results);
                    if(cityFound){
                        streetFound = testStreet(results);
                        if(streetFound) {
                            setAddress(results);
                        } else {
                            window.alert('Endereço Inválido.');
                        }
                    }
                    else {
                        window.alert('Endereço Inválido.');
                    }

                } else {
                    window.alert('Erro ao tentar pesquisar endereço.');
                    console.log('Geocode was not successful for the following reason: ' + status);
                }
            });

            function setAddress(results) {
                var latLng = {
                    lat: results[0].geometry.location.lat(),
                    lng: results[0].geometry.location.lng()
                };
                marker.setPosition(latLng);
                map.setCenter(latLng);

            }
        }
        */

        function testRegion(results) {
            for (var i = 0; i < results[0].address_components.length; i++) {
                if (results[0].address_components[i].long_name == 'Carmões' || results[0].address_components[i].long_name == 'Dois Portos' || results[0].address_components[i].long_name == 'Carvoeira' || results[0].address_components[i].long_name == 'Runa' || results[0].address_components[i].long_name == 'Turcifal' || results[0].address_components[i].long_name == 'Freiria' || results[0].address_components[i].long_name == 'Ventosa' || results[0].address_components[i].long_name == 'Bonabal' || results[0].address_components[i].long_name == 'São Pedro da Cadeira' || results[0].address_components[i].long_name == 'Silveira' || results[0].address_components[i].long_name == 'Ponte do Rol' || results[0].address_components[i].long_name == 'Torres Vedras' || results[0].address_components[i].long_name == 'Matacães' || results[0].address_components[i].long_name == 'Monte Redondo'  || results[0].address_components[i].long_name == 'Maxial'  || results[0].address_components[i].long_name == 'Ramalhal'  || results[0].address_components[i].long_name == 'Outeiro da Cabeça' || results[0].address_components[i].long_name == 'Campelos' || results[0].address_components[i].long_name == 'A dos Cunhados'  || results[0].address_components[i].long_name == 'Casal da Barreirinha' || results[0].address_components[i].long_name == 'Maceira' || results[0].address_components[i].long_name == 'Casal dos Feros') {
                    return cityFound = true;
                }
            }
        }

        function testStreet(results) {
            for (var i = 0; i < results[0].address_components.length; i++) {
                if (results[0].address_components[i].types[0] == 'route') {
                    return streetFound = true;
                }
            }
        }

        function sendNotFound() {
            cleanForm();
            window.alert('Nenhum resultado encontrado');
        }

        function cleanForm() {
            document.getElementById('occurrence-address').value = "";
            document.getElementById('occurrence-postal_code').value = "";
            document.getElementById('occurrence-region').value = "";
        }

    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEjyX3XVWLoxPaC44hX9Owt9SFeduZ_XU&callback=initMap"></script>



</div>

