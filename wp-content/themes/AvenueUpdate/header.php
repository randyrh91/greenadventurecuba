<?php include(TEMPLATEPATH . '/language.php');
require_once CS_MVC_PATH_VMODEL . '/ImagenPortadaViewModel.php';

$model = $model = new ImagenPortadaViewModel();
$imagenesPortada = $model->getImagenPortadas();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
            echo ' :';
        } ?><?php bloginfo('name'); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/font-awesome.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/magnific-popup.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/creative.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/my-style.css">

    <?php
    wp_enqueue_script('jq', get_stylesheet_directory_uri() . '/js/jquery.min.js');
    wp_enqueue_script('ea', get_stylesheet_directory_uri() . '/js/jquery.easing.min.js');
    wp_enqueue_script('ma', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js');
    wp_enqueue_script('po', get_stylesheet_directory_uri() . '/js/popper.min.js');
    wp_enqueue_script('bo', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
    wp_enqueue_script('cr', get_stylesheet_directory_uri() . '/js/scrollreveal.min.js');
    wp_enqueue_script('cr', get_stylesheet_directory_uri() . '/js/creative.min.js');
    wp_enqueue_script('ms', get_stylesheet_directory_uri() . '/js/my_script.js');
    ?>

    <?php wp_get_archives('type=monthly&format=link'); ?>
    <?php //comments_popup_script(); // off by default ?>

    <?php
    if (is_singular()) wp_enqueue_script('comment-reply');
    wp_head();
    ?>

</head>
<body class="padding-top45">
<!--begin loader -->

<div id="loader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--end loader -->

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand js-scroll-trigger" href="<?=get_home_url()?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo.png"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--         Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <?php wp_nav_menu(array(
                    'container' => '', 'container_class' => 'collapse navbar-collapse', 'walker' => new AvenWalkerNav(),
                    'container_id' => '', 'theme_location' => 'primary', 'menu_class' => 'navbar-nav ml-auto', 'fallback_cb' => 'fallbackmenu')
            ); ?>
            <?php wp_nav_menu(array(
                    'container' => '', 'container_class' => 'collapse navbar-collapse', 'walker' => new AvenWalkerNav(),
                    'container_id' => '', 'theme_location' => 'top_right', 'menu_class' => 'navbar-nav ml-auto navbar-right', 'fallback_cb' => 'fallbackmenu')
            ); ?>
            <div class="social-media-menu">
                <ul class="navbar-nav ml-auto navbar-right">
                    <li>
                        <a href="http://facebook.com"><h4><em class="fa fa-facebook-square"></h4></em></a>
                    </li>
                    <li>
                        <a href="http://twiter.com"><h4><em class="fa fa-twitter-square"></em></h4></a>
                    </li>
                    <li>
                        <a href="http://linkedin.com"><h4><em class="fa fa-linkedin-square"></em></h4></a>
                    </li>
                    <li>
                        <a href="http://pinterest.com"><h4><em class="fa fa-pinterest-square"></em></h4></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</nav>
<!-- Header -->
<header>
<?php if(get_post()->ID==4): ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            /** @var ImagenPortadaModel $imgPort */
            foreach ($imagenesPortada as $imgPort): ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"
                    class="<?= $i === 0 ? 'active' : '' ?>"></li>
                <?php $i++; endforeach; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
            $i = 0;
            /** @var ImagenPortadaModel $imgPort */
            foreach ($imagenesPortada as $imgPort): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <img class="d-block img-fluid" src="<?= View::getFoto(4, $imgPort->foto) ?>"
                         alt="<?= __($imgPort->nombre) ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h3><?= __($imgPort->nombre) ?></h3>
                        <p><?= __($imgPort->textoCorto) ?></p>
                        <?php if($imgPort->Post_ID):?>
                            <a class="btn btn-warning" href="<?=get_page_link($imgPort->Post_ID)?>"><?=__(CS_L_VERMAS)?> ...</a>
                        <?php endif?>
                    </div>
                </div>
                <?php $i++; endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>
<?php endif ?>
<!--Section #1-->