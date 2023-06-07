<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */
$model = new SiteViewModel();
?>
<!--===============-->
<!--Excurciones-->
<!--===============-->
<div class="container-fluid no-margin">
    <h1 id="destinosPopulares" style="text-align: center"><em
            class="fa fa-camera"></em> <?= __(CS_L_EXCURSIONES) ?></h1>

    <div class="hidden-xs"><?php the_content(); ?></div>
</div>
<?php
$i = 0;
/** @var ExcursionModel $excursiones */
foreach ($model->getAllDayTours(100) as $excursiones):?>
    <a href="<?= get_page_link($excursiones->Post_ID) ?>#bc"  onclick="showModal(<?=$excursiones->id?>,'<?= get_page_link($excursiones->Post_ID) ?>#form_reserva')">
        <div class="col-xs-12 col-md-12 col-sm-6 excurcion">
            <div class="pricing_princ">
                <div class="pricing-head_princ">
                    <h3 class="visible-md visible-lg"><?= __($excursiones->nombre) ?></h3>
                    <h5 class="label-categoria"><em class="fa fa-camera"></em>  <?= __(CS_L_EXCURSIONES) ?></h5>
                </div>
                <div class="ajustar-img visible-xs visible-sm">
                    <img class="img_exc"
                         src="<?= HTML::getFoto($excursiones->getOneImagenExcursiones()->foto) ?>">
                </div>

                <div class="visible-md visible-lg" style="width: 50%; float: left">
<!--                    <div class="tile-content">-->
                        <?php
                        $foto = $excursiones->getOneImagenExcursiones();?>

                            <img style="width: 100%; border-right: 2px #3192C8 solid;"
                                 src="<?= HTML::getFoto($foto->foto) ?>"
                                 title="<?= __($foto->nombre) ?>">

<!--                    </div>-->
                </div>
                <div class="sombrear">
                    <div class="descripcion-destinos">
                        <h3>
                            <a class="titulo-descripcion visible-xs visible-sm"
                               href="<?= get_page_link($excursiones->Post_ID) ?>#bc">
                                <?= __($excursiones->nombre) ?>
                            </a>

                            <div class="pull-right datos-extra visible-md visible-lg">
                            <span class="label label-info"
                                  style="font-size: 12px"><?= __(CS_L_TIEMPO) ?>
                                : <u><?= $excursiones->tiempo ?></u></span>
                            <span class="label label-info"
                                  style="font-size: 12px"><?= __(CS_L_DISTANCIA) ?>
                                : <u><?= $excursiones->distanciaKM ?></u></span>
                            </div>
                            <div style="clear: both"></div>
                        </h3>
                        <p style="text-align: justify" class="visible-md visible-lg"><?= __($excursiones->textoCorto) ?>
                            <a class="visible-md visible-lg"
                           href="<?= get_page_link($excursiones->Post_ID) ?>#bc"><?= __(CS_L_VERMAS) ?></a></p>
                    </div>
                    <div style="clear: both"></div>
                    <hr class="visible-md visible-lg" style="border: 1px #3192C8 solid; margin: 0">
                    <div class="rating">
                        <div class="panel-left">
                            <b class="star-rating"><?= __(CS_L_VOTE) ?></b>
                      <span class="stars">
                       <span
                           onclick=rating(5,'<?= View::genPathCA("cs_mvc_trip", "Rating", "votar") ?>',<?= $excursiones->id ?>);
                           class="fa fa-star-o"></span>
                       <span
                           onclick=rating(4,'<?= View::genPathCA("cs_mvc_trip", "Rating", "votar") ?>',<?= $excursiones->id ?>);
                           class="fa fa-star-o"></span>
                       <span
                           onclick=rating(3,'<?= View::genPathCA("cs_mvc_trip", "Rating", "votar") ?>',<?= $excursiones->id ?>);
                           class="fa fa-star-o"></span>
                       <span
                           onclick=rating(2,'<?= View::genPathCA("cs_mvc_trip", "Rating", "votar") ?>',<?= $excursiones->id ?>);
                           class="fa fa-star-o"></span>
                       <span
                           onclick=rating(1,'<?= View::genPathCA("cs_mvc_trip", "Rating", "votar") ?>',<?= $excursiones->id ?>);
                           class="fa fa-star-o"></span>
                      </span>

                            <div id="alertar-<?= $excursiones->id ?>" class="alert alert-info fade in">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <?= __(CS_L_GRACIAS) ?>
                            </div>
                        </div>
                        <div class="boton-reserva">
                            <a href="<?= get_page_link($excursiones->Post_ID) ?>#form_reserva"
                               class="btn btn-danger">
                                <b><em class="fa fa-book"><span
                                            class="visible-xs visible-sm"><?= __(CS_L_BOOKNOW_MINI) ?></span><span
                                            class="visible-md visible-lg"><?= __(CS_L_BOOKNOW) ?></span></em></b>
                            </a>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </a>
    <div class="hidden-sm" style="clear: both"></div>
    <?= ($i % 2 != 0) ? '<div class="visible-sm" style="clear: both"></div><hr class="visible-sm no-margin">' : '' ?>
    <p class="visible-md visible-lg">&nbsp;</p>
    <?php $i++; endforeach ?>

<?php include_once 'dialog.php' ?>