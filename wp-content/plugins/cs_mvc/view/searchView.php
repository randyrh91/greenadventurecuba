<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */
$post_id = View::in('id');
$model = new SearchViewModel();
$excursiones = $model->getSearchResult();
/** @var ExcursionModel $excursiones */
?>

<div class="container-fluid no-padding">
    <div class="row-fluid">
        <div class="span9">
            <?php if (isset($_REQUEST['find_q'])): ?>
                <h1 class="resultado-busqueda"><em class="fa fa-book"></em> <?= __(CS_L_RESULTADOSBUSQUEDA) ?>
                    (<?= count($excursiones) ?>)</h1>
                <?php
                /** @var ExcursionModel $excursion */
                foreach ($excursiones as $excursion):?>
                    <div class="row-fluid">
                        <div class="booking-blocks">
                            <div class="col-xs-12 col-sm-12 col-md-12 no-padding search-box">
                                <img class="col-sm-4 col-md-2 no-padding padding-15-sm" width="100%" height="auto"
                                     src="<?= HTML::getFoto($excursion->getOneImagenExcursiones()->foto) ?>"
                                     title="<?= __($excursion->getOneImagenExcursiones()->nombre) ?>">

                                <div class="rating-search visible-xs">
                                    <div class="panel-left-search no-bottom">
                                        <b class="star-rating"><?= __(CS_L_VOTE) ?></b>
                                <span class="stars">
                                   <span
                                       onclick=rating(5,'<?= View::genPathCA("cs_mvc_overnight", "Rating", "votar") ?>',<?= $excursion->id ?>);
                                       class="fa fa-star-o"></span>
                                   <span
                                       onclick=rating(4,'<?= View::genPathCA("cs_mvc_overnight", "Rating", "votar") ?>',<?= $excursion->id ?>);
                                       class="fa fa-star-o"></span>
                                   <span
                                       onclick=rating(3,'<?= View::genPathCA("cs_mvc_overnight", "Rating", "votar") ?>',<?= $excursion->id ?>);
                                       class="fa fa-star-o"></span>
                                   <span
                                       onclick=rating(2,'<?= View::genPathCA("cs_mvc_overnight", "Rating", "votar") ?>',<?= $excursion->id ?>);
                                       class="fa fa-star-o"></span>
                                   <span
                                       onclick=rating(1,'<?= View::genPathCA("cs_mvc_overnight", "Rating", "votar") ?>',<?= $excursion->id ?>);
                                       class="fa fa-star-o"></span>
                                </span>
                                        <div id="alertar-<?= $excursion->id ?>" class="alert alert-info fade">
                                            <?= __(CS_L_GRACIAS) ?>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-xs-12 col-sm-8 col-md-10 descripc-busqueda">
                                <div class="titulo-descripcion">
                                    <h2>
                                        <a href="<?= get_page_link($excursion->Post_ID) ?>#bc"><?= __($excursion->nombre) ?></a>
                                    </h2>
                                </div>
                                <div class="dato-extra hidden-xs">
                                <span class="label label-info"><?= __(CS_L_TIEMPO) ?>
                                    : <u><?= $excursion->tiempo ?></u></span>
                                <span class="label label-info"><?= __(CS_L_DISTANCIA) ?>
                                    : <u><?= $excursion->distanciaKM ?></u></span>
                                </div>
                                <p class="hidden-xs"><?= __($excursion->textoCorto) ?></p>
                                <a class="hidden-xs"
                                   href="<?= get_page_link($excursion->Post_ID) ?>#bc"><?= __(CS_L_VERMAS) ?></a>

                                <div class="boton-reserva busqueda-boton-reserva">
                                    <a href="<?= get_page_link($excursion->Post_ID) ?>#form_reserva"
                                       class="btn btn-danger pull-right">
                                        <b><em class="fa fa-book"><span
                                                    class="visible-xs"><?= __(CS_L_BOOKNOW_MINI) ?></span><span
                                                    class="hidden-xs"><?= __(CS_L_BOOKNOW) ?></span></em></b>
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hidden-xs">
                <?php endforeach ?>
            <?php else: ?>
                <h1 style="text-align: center"><em class="fa fa-book"></em> <?php the_title() ?></h1>
                <?php the_content() ?>
            <?php endif ?>
        </div>
    </div>
</div>


