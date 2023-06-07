<?php
/**
 * Created by PhpStorm.
 * User: Randy-PC
 * Date: 18/08/2015
 * Time: 12:13
 * Modify by PR0X
 */
?>
<div id="contenido" class="container-fluid">
    <section id="infovisual" class="col-md-12 isotope-item">
        <div class="col-xs-12 col-sm-4 col-md-4">
            <header>
                <h2>Playa Varadero</h2>
            </header>
            <div  id="imagen_lugar">
                <img class="img_prueba"
                                  src="<?php echo get_stylesheet_directory_uri() ?>/images/lugares/varadero/varadero.jpg"
                                  alt="Foto del lugar seleccionado">
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8">
            <div id="geo_localizacion" class="isotope-item">
                <div class="portlet solid blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-globe"></i>Mapa</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                            <a href="#portlet-config" data-toggle="modal" class="config"></a>
                            <a href="javascript:;" class="reload"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="gmap_basic" class="gmaps"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <header class="col-md-3">
        <h3 id="moreInfo"><em class="fa fa-plus-circle"></em> Informaci&oacute;n</h3>
    </header>
    <section id="informacion" class="col-md-12">
        <div class="col-md-12" id="desc_lugar">
            <p>
                Varadero es una ciudad de Cuba perteneciente el municipio Cárdenas, situada en la península
                de Hicacos, provincia Matanzas a 130 kilómetros al este de La Habana. Al noreste Punta
                Hicacos es el lugar más al norte de Cuba. Es un territorio especial de la República de Cuba.
                Constituye el punto más cercano a los Estados Unidos, tiene 30 km de extensión de los cuales
                22 km son de playas. Limita al norte con el estrecho de La Florida, al sur con la bahía de
                Cárdenas, al este con Cárdenas, al oeste con la cayería Sabana Camagüey, su población es de
                26 680 habitantes, es una población itinerante, su principal renglón económico es el
                desarrollo del turismo y la mayor fuerza laboral está en función del mismo.
            </p>
        </div>
        <div id="mas_img_lugar" class="blog-images">
            <div id="mas_img1" class="clase_mas_img_lugar">
                <a href="#"><img alt="imagen del lugar 1" class="mas_imagenes" src="<?php echo get_stylesheet_directory_uri() ?>/images/lugares/varadero/1.jpg"></a>
            </div>
            <div id="mas_img2" class="clase_mas_img_lugar">
                <a href="#"><img alt="imagen del lugar 2" class="mas_imagenes" src="<?php echo get_stylesheet_directory_uri() ?>/images/lugares/varadero/2.jpg"></a>
            </div>
            <div id="mas_img3" class="clase_mas_img_lugar">
                <a href="#"><img  alt="imagendel lugar 3" class="mas_imagenes" src="<?php echo get_stylesheet_directory_uri() ?>/images/lugares/varadero/3.jpg"></a>
            </div>
            <div id="mas_img4" class="clase_mas_img_lugar">
                <a href="#"><img  alt="imagen del lugar 4" class="mas_imagenes" src="<?php echo get_stylesheet_directory_uri() ?>/images/lugares/varadero/4.jpg"></a>
            </div>
            <div id="mas_img5" class="clase_mas_img_lugar">
                <a href="#"><img alt="imagen del lugar 5" class="mas_imagenes" src="<?php echo get_stylesheet_directory_uri() ?>/images/lugares/varadero/5.jpg"></a>
            </div>
            <div id="mas_img5" class="clase_mas_img_lugar">
                <a href="#"><img alt="imagen del lugar 5" class="mas_imagenes" src="<?php echo get_stylesheet_directory_uri() ?>/images/lugares/varadero/6.jpg"></a>
            </div>
        </div>
        <div style="clear: both"></div>
    </section>
    <div id="paginator" class="col-sm-12 col-md-9">
    <?php echo HTML::pagination(34,'')?>
    </div>

    <div id="principales_hostales"class="isotope" style="width: 100%">
        <div class="container-fluid">
        <?php for ($i = 0; $i < 12; $i++): ?>
            <div id="separador_casas<?=$i?>" class="search-images col-xs-12 col-md-4 col-sm-4" >
                <div class="isotope-item " id="cada_host_princ">
                    <a id="enlaza_casa" class="thumbnail" data-rel="thumbnail" title="casas de alojamiento"
                       href="<?=get_stylesheet_directory_uri()?>'/images/alojamiento/<?=$i?>img.jpg">
                        <div class="pricing_princ hover-effect">
                            <div class="pricing-head_princ">
                                <h3>Hostal de Pepe<?=$i+1?></h3>
                                <h4><i>$</i>133<i>.99</i>
                                    <p>por habitación</p></h4>
                            </div>
                            <div class="pricing-contenido_princ">
                                <img class="img_prueba" src="<?=get_stylesheet_directory_uri()?>/images/alojamiento/<?=$i?>img.jpg" alt="Casas de renta más populares">
                            <span><p>La vivienda es una edificación cuya principal función
                                    es ofrecer refugio y habitación a las personas, protegiéndolas
                                    de las inclemencias climáticas y de otras amenazas.</p></span>
                                <ul class="pricing-footer_princ">
                                    <li><i class="fa fa-user"></i></li>
                                    <li><i class="fa fa-map-marker"></i></li>
                                    <li><i class="fa fa-ban"></i></li>
                                    <li><i class="fa fa-archive"></i></li>
                                    <li><i class="fa fa-eye"></i></li>
                                </ul>
                            </div>

                        </div>
                    </a>
                </div>
            </div>
        <?php endfor;?>
        </div>
    </div>
    <!--</div>-->
    <div style="clear: both"> </div>
</div>
<hr>
<!--    <div class="header-separator">-->
<!--        <div class="col-md-12">-->
<!--            <h2 class="section-title">Principales Alojamientos</h2>-->
<!--        </div>-->
<!--    </div>-->

<script>
    window.onload = function () {
        var $ = jQuery, div_inf = $('#informacion'), div_minfo = $('#moreInfo'),
            div_pag = $('#paginator');
        div_minfo.toggle(
            function () {
                div_inf.slideDown('fast');
                $("em",div_minfo).removeClass("fa-plus-circle").addClass("fa-minus-circle");
                console.log(div_minfo.parent('header'));
                div_minfo.parent('header').removeClass("col-md-3").addClass("col-md-12");
                div_pag.removeClass("col-md-9").addClass("col-md-12");

            },
            function () {
                $('#informacion').slideUp('fast');
                $("em",div_minfo).removeClass("fa-minus-circle").addClass("fa-plus-circle");
                div_minfo.parent('header').removeClass("col-md-12").addClass("col-md-3");
                div_pag.removeClass("col-md-12").addClass("col-md-9");
            }
        )
    }
</script>
