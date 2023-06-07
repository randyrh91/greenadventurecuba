<?php include (TEMPLATEPATH . '/language.php');
require_once CS_MVC_PATH_VMODEL . '/ImagenPortadaViewModel.php';

$model = $model=new ImagenPortadaViewModel();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
            echo ' :';
        } ?> <?php bloginfo('name'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/myStyle.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/listing.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap-datepicker3.min.css"
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap-datepicker3.standalone.min.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap-datetimepicker.min.css"
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/animate.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/owl.carousel.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/owl.transitions.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/font-awesome.css"
          media="screen"/>
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed"
          href="<?php bloginfo('rss2_url'); ?>"/>
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed"
          href="<?php bloginfo('atom_url'); ?>"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>
    <link rel="icon" type="image/png" href="<?=get_home_url()?>/favicon.ico" />

<!--    <link rel="stylesheet" href="js/openlayer/theme/default/style.css" type="text/css" media="all"/>-->
<!--    <style>-->
<!--        div.olMapViewport, div.olMapViewport>div:first-child {-->
<!--            position: relative !important;-->
<!--        }-->
<!--    </style>-->
<!--    <script type="text/javascript" src="js/openlayer/OpenLayers.js"></script>-->
<!--    <script type="text/javascript" src="js/openlayer/init_openlayer.js"></script>-->

    <?php
    wp_enqueue_script('jquery');
    wp_enqueue_script('bxslider', get_stylesheet_directory_uri() . '/js/jquery.bxSlider.min.js');
    wp_enqueue_script('superfish', get_stylesheet_directory_uri() . '/js/superfish.js');
    wp_enqueue_script('effects', get_stylesheet_directory_uri() . '/js/effects.js');
    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
    wp_enqueue_script('moment', get_stylesheet_directory_uri() . '/js/moment.min.js');
    wp_enqueue_script('bootstrap-datepicker', get_stylesheet_directory_uri() . '/js/bootstrap-datepicker.min.js');
    wp_enqueue_script('bootstrap-datetimepicker-lang', get_stylesheet_directory_uri() . '/js/bootstrap-datepicker.'. $q_config['language'].'min.js');
    wp_enqueue_script('bootstrap-datetimepicker', get_stylesheet_directory_uri() . '/js/bootstrap-datetimepicker.min.js');
    wp_enqueue_script('owl', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js');
    wp_enqueue_script('isotope', get_stylesheet_directory_uri() . '/js/jquery.isotope.js');
    wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js');
    wp_enqueue_script('myScript', get_stylesheet_directory_uri() . '/js/myScript.js');
    ?>

    <?php wp_get_archives('type=monthly&format=link'); ?>
    <?php //comments_popup_script(); // off by default ?>

    <?php
    if (is_singular()) wp_enqueue_script('comment-reply');
    wp_head();
    ?>

</head>
<?php
$navclass = "nav-no-top";
$bodyclass = "padding-top45";
$ishome = false;
if (is_home() == 1) {
    //home
    //ver bien como saber si estoy en el home o no
    $navclass = "nav-top";
    $bodyclass = "";
    $ishome = true;
}

?>
<body class="padding-top45">

<nav class="navbar navbar-default navbar-fixed-top <?php echo $navclass; ?>" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
<!--                <span class="sr-only">Toggle navigation</span>-->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span>
                <a href="<?= View::genPathSite('')?>">
                    <img id="logoPortada" src="<?php echo get_stylesheet_directory_uri() ?>/images/logo1.png" alt="Cuba, por favor">
                </a>
            </span>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php wp_nav_menu(array(
                    'container' => '', 'container_class' => 'collapse navbar-collapse navbar-ex1-collapse', 'walker' => new AvenWalkerNav(),
                    'container_id' => '', 'theme_location' => 'primary', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'fallbackmenu')
            ); ?>
            <?php wp_nav_menu(array(
                    'container' => '', 'container_class' => 'collapse navbar-collapse navbar-ex1-collapse', 'walker' => new AvenWalkerNav(),
                    'container_id' => '', 'theme_location' => 'top_right', 'menu_class' => 'nav navbar-nav navbar-right', 'fallback_cb' => 'fallbackmenu')
            ); ?>
        </div>
        <!--        <div class="collapse navbar-collapse navbar-ex1-collapse">-->
        <!--            <ul class="nav navbar-nav navbar-right">-->
        <!--                --><?php //wp_nav_menu( array( 'container_id' => '', 'theme_location' => 'primary','menu_class'=>'','fallback_cb'=> 'fallbackmenu' ) ); ?>
        <!--            </ul>-->
        <!--        </div>-->
    </div>

</nav>
<section id="main-slider">
    <div class="col-sm-8 col-md-9  column-slider">
        <div class="owl-carousel">
            <!--/.item-->
            <?php
            /** @var ImagenPortadaModel $imagenPortada */
            foreach($model->getImagenPortadas() as $imagenPortada): ?>
                <div class="item"
                     style="background-size: cover; background-image: url(<?= View::getFoto($imagenPortada->foto)?>);">
                    <div class="slider-inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="carousel-content">
                                        <h2> <?=__($imagenPortada->nombre)?></h2>

                                        <p><?=__($imagenPortada->textoCorto)?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <!--/.owl-carousel-->
    </div>
<!--    Formulario  de Busqueda-->
    <div class="col-sm-4 col-md-3 column-slider">
        <div class="item asideTop">
                <h3><em class="fa fa-search"></em>
<!--                    Forma sencilla de Traducir texto-->
                    <?=__(L_ENCUENTRELO)?>
                    </h3>
            <div class="findbox">
                <form id="form_search" role="form" action="<?= View::genPathSite('search')?>">
                    <label class="label label-warning col-xs-12 col-sm-12 col-md-12" style="margin: 0"><?=__(CS_L_BUSCAR)?></label>
                    <input class="form-control" value="<?=View::in('find_q','')?>" name="find_q" placeholder="<?=__(CS_L_PLACEHOLDER)?>">
                    <div class="btn-group">
                        <label class="label label-warning col-xs-4 col-sm-4 col-md-4" style="margin: 0"><?=__(CS_L_TIPO)?></label>
                        <select class="col-xs-8 col-sm-8 col-md-8" style="margin: 0" name="find_tipo">
                            <option value="0"><?=__(CS_L_ALL)?></option>
                            <option value="1"><?=__(CS_L_CIRCUITOS)?></option>
                            <option value="2"><?=__(CS_L_OVERNIGHT)?></option>
                            <option value="3"><?=__(CS_L_EXCURSIONES)?></option>
                        </select>
                    </div>
<!--                    <div class="btn-group">-->
<!--                        <label class="label label-warning col-xs-4 col-sm-4 col-md-4" style="margin: 0;">--><?//=__(CS_L_PRECIO)?><!--</label>-->
<!--                        <select class="col-xs-4 col-sm-4 col-md-4" style="margin: 0;  border-right:1px solid #DD5600;" name="find_element">-->
<!--                            <option>10 CUC</option>-->
<!--                            <option>30 CUC</option>-->
<!--                            <option>60 CUC</option>-->
<!--                            <option>120 CUC</option>-->
<!--                        </select>-->
<!--                        <select class="col-xs-4 col-sm-4 col-md-4" style="margin: 0" name="find_element">-->
<!--                            <option>30 CUC</option>-->
<!--                            <option>60 CUC</option>-->
<!--                            <option>120 CUC</option>-->
<!--                            <option>300 CUC</option>-->
<!--                        </select>-->
<!--                    </div>-->

                </form>
                <a name="bc"></a>
                <div class="btn-group col-md-10 col-xs-12 col-sm-10 col-md-offset-1 col-sm-offset-2 col-xs-offset-0">


                    <button type="submit" onclick="jQuery('#form_search').submit()" class="btn btn-danger col-xs-10 col-sm-12 col-md-12">
                        <em class="fa fa-search"></em> <?=__(CS_L_BUTTONSEARCH)?>
                    </button>

<!--                    <button type="button" class="btn col-md-2 btn-primary" style="border-left: solid #3c3f41 1px; padding: 4px 0">-->
<!--                        <em class="fa fa-2x fa-plus-circle"></em></b>-->
<!--                    </button>-->
                </div>
            </div>

            </div>

        </div>
    </div>
</section>
<!--/#main-slider-->
<div style="clear: both"></div>

<section id="task-bar">
    <?php if (function_exists('bcn_display')) {
        $bc = bcn_display_list(true);
        $m = array();
        preg_match_all('/<li /', $bc, $m);
    }?>

    <nav class="navbar navbar-default <?php echo $navclass; ?>" role="navigation">
        <div class="navbar-header">
<!--            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">-->
<!--                <span class="sr-only">Toggle navigation</span>-->
<!--                <span class="icon-bar"></span>-->
<!--                <span class="icon-bar"></span>-->
<!--                <span class="icon-bar"></span>-->
<!--            </button>-->
            <a class="navbar-brand" href="#"><em href="#" class="fa fa-info-circle"></em> <?=__(CS_L_BREADCRUMB)?></a>
        </div>

        <div  style="margin-top: 5px">
            <ol class="breadcrumb">
            <?php echo $bc ?>
            </ol>
        </div>

    </nav>

</section>

<script type="text/javascript">
    jQuery('nav.navbar-fixed-top').removeClass('nav-no-top');
    jQuery('nav.navbar-fixed-top').addClass('nav-top');
</script>
<script>
    var layoutConfig = {
        asyncPageLoaderEnabled: true,
        selectBoxHoverEnabled: true,
        bootFiltersAnimationEnabled: true,
        hoverspinPreloadingEnabled: true
    };
</script>

