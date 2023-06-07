<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */

?>

<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!--<script src="gmaps.js"></script>-->
<!--<script src="http://localhost/cubicate.com/wp-content/plugins/cs_mvc/assetic/gmaps.js"></script>-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="https://raw.github.com/HPNeo/gmaps/master/gmaps.js"></script>-->

<div role="main" class="container">
    <div class="col-sm-10">
        <section id="intro">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img data-holder-rendered="true"
                         src="http://localhost/cubicate.com/wp-content/plugins/cs_mvc/assetic/images/Message-Information.png"
                         style="height: 100px; width: 50%; display: block;" data-src="holder.js/100%x200"
                         alt="100%x200">

                    <div class="caption">
                        <h3>Información para viajeros</h3>

                        <p>Todo lo que debe saber acerca de Cuba:
                            Equipaje necesario para viajeros, principales leyes a conocer, moneda
                            que circula en Cuba, gente y sociedad, y mucho mas... Infórmese antes de
                            viajar! .</p>

                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                                           class="btn btn-default"
                                                                                           role="button">Button</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img data-holder-rendered="true"
                         src="http://localhost/cubicate.com/wp-content/plugins/cs_mvc/assetic/images/Home-Loan.png"
                         style="height: 100px; width: 50%; display: block;" data-src="holder.js/100%x200"
                         alt="100%x200">

                    <div class="caption">
                        <h3>Alojamiento</h3>

                        <p>Verifique la gran variedad de hostales que
                            ofrecemos en toda la isla. Prepare su viaje con nosotros y disfrute de
                            unas merecidas vacaciones caribeñas llenas de historia, cultura, sol, y
                            playas.</p>

                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                                           class="btn btn-default"
                                                                                           role="button">Button</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img data-holder-rendered="true"
                         src="http://localhost/cubicate.com/wp-content/plugins/cs_mvc/assetic/images/Car-Service.png"
                         style="height: 100px; width: 50%; display: block;" data-src="holder.js/100%x200"
                         alt="100%x200">

                    <div class="caption">
                        <h3>Servicios</h3>

                        <p>Solicite nuestro eficiente servicio de Taxi,
                            con los autos mas confortables y precios mas económicos. Verifique la
                            tarifa de los traslados y las excursiones en autos clásicos o modernos.</p>

                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                                           class="btn btn-default"
                                                                                           role="button">Button</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section id="mapa">
        <div class="col-sm-10 col-md-4" id="map" style="width: 400px; height: 400px">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">Varadero</a>

                    <p>bla bla</p>
                    <script>
                        var map = new GMaps({
                            el: '#map',
                            lat: 23.15,
                            lng: -81.2667,
                            zoomControl: true
                        });
                    </script>
                </li>
                <li><a href="#">Matanzas</a></li>
                <li><a href="#">Habana</a></li>
                <li><a href="#">Trinidad</a></li>
            </ul>
        </div>
        <div class="col-sm-10 col-md-4" id="map2" style="width: 400px; height: 400px">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">Matanzas</a>

                    <p>bla bla</p>
                    <script>
                        var map = new GMaps({
                            el: '#map2',
                            lat: 23.04178310582766,
                            lng: -81.57229041913524,
                            zoomControl: true
                        });
                    </script>
                </li>
                <li><a href="#">Matanzas</a></li>
                <li><a href="#">Habana</a></li>
                <li><a href="#">Trinidad</a></li>
            </ul>
        </div>
        <div class="col-sm-10 col-md-4" id="map3" style="width: 400px; height: 400px">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">Santiago de Cuba</a>

                    <p>bla bla</p>
                    <script>
                        var map = new GMaps({
                            el: '#map3',
                            lat: 20.0247,
                            lng: -75.8219,
                            zoomControl: true
                        });
                    </script>
                </li>
                <li><a href="#">Matanzas</a></li>
                <li><a href="#">Habana</a></li>
                <li><a href="#">Trinidad</a></li>
            </ul>
        </div>
        <div class="col-sm-10 col-md-4" id="panorama" style="width: 400px; height: 400px">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">perú</a>

                    <p>bla bla</p>
                    <script>
                        panorama = GMaps.createPanorama({
                            el: '#panorama',
                            lat: 23.15,
                            lng: -81.2667
                        });
                    </script>
                </li>
                <li><a href="#">Matanzas</a></li>
                <li><a href="#">Habana</a></li>
                <li><a href="#">Trinidad</a></li>
            </ul>
        </div>
        <div class="col-sm-10 col-md-4" id="dede" style="width: 400px; height: 400px">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">perú</a>

                    <p>bla bla</p>
                    <script>
                        url = GMaps.staticMapURL({
                            size: [610, 300],
                            lat: -12.043333,
                            lng: -77.028333,
                            markers: [
                                {lat: -12.043333, lng: -77.028333},
                                {
                                    lat: -12.045333, lng: -77.034,
                                    size: 'small'
                                },
                                {
                                    lat: -12.045633, lng: -77.022,
                                    color: 'blue'
                                }
                            ]
                        });

                        $('<img/>').attr('src', url)
                            .appendTo('#dede');
                    </script>
                </li>
                <li><a href="#">Matanzas</a></li>
                <li><a href="#">Habana</a></li>
                <li><a href="#">Trinidad</a></li>
            </ul>
        </div>
    </section>
</div>