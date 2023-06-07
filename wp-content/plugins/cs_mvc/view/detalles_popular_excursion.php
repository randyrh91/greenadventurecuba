<!-- Our Exceptional Solutions -->
<?php $cat = $excursion->getTipoExcursion()->nombre;?>
<div class="col-xs-12 col-sm-12 col-md-4 margin-b-50">
    <div class="margin-b-20">
        <div class="wow zoomIn animated" data-wow-duration=".3" data-wow-delay=".1s"
             style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
            <img class="img-fluid"
                 src="<?= HTML::getFoto($excursion->getOneImagenExcursiones()->foto)?>"
                 alt="">
        </div>
    </div>
    <h4><a class="title" href="#"> <?=__($excursion->nombre)?></a> <span
            class="text-uppercase margin-l-20"><?=__($cat)?></span></h4>

    <p class="service-body"><?=__($excursion->textoCorto)?></p>
    <a class="link" href="<?= get_page_link($excursion->Post_ID) ?>#bc">Leer mas</a>
</div>
<!-- End Our Exceptional Solutions -->