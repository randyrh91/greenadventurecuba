<main class="main-content">

    <div class="back-fixed">
        <div class="container">
            <h2><?= __(CS_L_EXPERIENCIA) ?></h2>

            <div class="row">
                <div id="soi-box">
                    <form role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><?= __(CS_L_LUGAR_PERFECTO) ?></h3>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- --/container ---->
    </div>
</main>

<div id="happy-visitors" class="container">
    <div class="row header">
        <div class="col-md-12">
            <h2 class="section-title"><?= __(CS_L_VIAJEROS) ?></h2>

            <p><?= __(CS_L_BELLO) ?></p>
        </div>
    </div>
    <div class="breath">

        <?php $comments = get_comments(array('number' => ($is_visitor ? 16 : 4), 'status' => 'approve'));
        foreach ($comments as $comment) : ?>

            <div class="col-md-6 col-md-6">
                <div class="clientblock">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/portfolio/01.jpg" alt=".">

                    <p><strong><?php echo $comment->comment_author; ?></strong> <br>
                        <i><?php $date = strtotime($comment->comment_date);
                            echo date('d-m-y', $date); ?></i>
                    </p>
                </div>
                <div class="testblock"><?php echo $comment->comment_content; ?>
                    <?php
                    if (file_exists(ABSPATH . 'wp-content/comment-image/'. $comment->comment_ID . '-tn.jpg')) {
                        echo '<p><a href="' . content_url() . '/comment-image/' . $comment->comment_ID . '.jpg"><img src="' . content_url() . '/comment-image/' . $comment->comment_ID . '-tn.jpg"></a></p>';
                    }
                    ?>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script type="text/javascript">
    function errorSocial(){
        alert("Esta red social no se encuentra disponible por el momento, le regamos nuestras disculpas")
    }
</script>


<!--<div class="bottomcover ">-->
<!---->
<!--    <div id="bottom" >-->
<!--        <ul>-->
<!--            --><?php //if ( !function_exists('dynamic_sidebar')
//                || !dynamic_sidebar("Footer") ) :
?>
<!---->
<!--                <li class="botwid">-->
<!--                    <h3 class="bothead">--><?php //_e( 'Archives', '' );
?><!--</h3>-->
<!--                    <ul>-->
<!--                        --><?php //wp_get_archives( 'type=monthly' );
?>
<!--                    </ul>-->
<!--                </li>-->
<!---->
<!--                <li class="botwid">-->
<!--                    <h3 class="bothead">--><?php //_e( 'Meta', '' );
?><!--</h3>-->
<!--                    <ul>-->
<!--                        --><?php //wp_register();
?>
<!--                        <li>--><?php //wp_loginout();
?><!--</li>-->
<!--                        <li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>-->
<!--                        <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>-->
<!--                        <li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>-->
<!--                        --><?php //wp_meta();
?>
<!--                    </ul>-->
<!--                </li>-->
<!--            --><?php //endif;
?>
<!--        </ul>-->
<!---->
<!--        <div class="clear"> </div>-->
<!--    </div>-->
<!--</div>-->

