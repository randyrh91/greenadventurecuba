<?php
/**
 * Created by PhpStorm.
 * User: Randy-PC
 * Date: 3/11/2017
 * Time: 1:40
 */
require_once CS_MVC_PATH_VMODEL . '/CellPortadaViewModel.php';

const ARTICULOS = 'articles';
$model = new CellPortadaViewModel();
$articulo = get_post();
$articulosDestacados = $model->getArticulosDestacados(5);
$articulosTodos = $model->getArticulosDestacados(-1);
if ($articulo->post_name == ARTICULOS) {
    $articulo = $articulosDestacados[0];
}
?>
<!--===============-->
<!--Hostales-->
<!--===============-->
<nav class="breadcrumb">
    <span class="breadcrumb-item"><?= __(CS_L_PORTADA) ?></span>
    <span class="breadcrumb-item"><?= __(CS_L_ARTICULOS) ?></span>
    <span class="breadcrumb-item active"><?= __($articulo->post_title) ?></span>
</nav>
<aside class="col-xs-12 col-sm-12 col-md-4 float-left">
    <div id="articulos-mas-leidos">
        <h2><?= __(CS_L_ARTICULOS_POPULARES) ?></h2>
    </div>
    <div class="articulos-div">
        <?php
        foreach ($articulosDestacados as $art):?>
            <article class="aside-articulos <?= $art->ID == $articulo->ID ? 'activo' : '' ?>">
                <div class="cuerpo-articulos-aside">
                    <img class="col-xs-12 col-sm-12 col-md-2 float-left"
                         src="<?= View::getFoto('3', $art->post_mime_type) ?>" alt="<?= __($art->post_title) ?>">
                    <div class="col-xs-12 col-sm-12 col-md-10 float-left">
                        <a style="color: #212529" href="<?=get_page_link($art->ID)?>"><h3><?= __($art->post_title) ?></h3></a>
                    </div>
                </div>
                <div style="clear: both"></div>
            </article>
        <?php endforeach ?>
    </div>
    <div id="articulos-todos">
        <h2>Todos los articulos</h2>
    </div>
    <div id="todos-articulos">
        <?php
        foreach ($articulosTodos as $art):?>
            <article class="aside-articulos <?= ($art->ID == $articulo->ID) ? 'activo' : '' ?>">
                <div class="cuerpo-articulos-aside">
                    <img class="col-xs-12 col-sm-12 col-md-2 float-left"
                         src="<?= View::getFoto('3', $art->post_mime_type) ?>" alt="<?= __($art->post_title) ?>">
                    <div class="col-xs-12 col-sm-12 col-md-10 float-left">
                        <h3><?= __($art->post_title) ?></h3>
                    </div>
                </div>
                <div style="clear: both"></div>
            </article>

        <?php endforeach ?>
    </div>
    <div style="clear: both"></div>
</aside>
<section id="articulo" class="col-xs-12 col-sm-12 col-md-8 float-left">
    <article id="articulo-articulo">
        <h2 id="nombre-articulo"><?= __($articulo->post_title) ?></h2>
        <hr>
        <?= __($articulo->post_content) ?>
    </article>
</section>
<div style="clear: both"></div>