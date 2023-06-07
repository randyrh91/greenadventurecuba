<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery('#pslider').bxSlider({
            mode: 'fade',
            controls: false,
            pager: true
        });
    });

</script>

<div class="row header">
    <div class="col-md-12">
        <h2 class="section-title">rentals in this zone</h2>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
    </div>
</div>

<div class="row margin-top35">
    <div class="col-sm-6">
        <div class="blog-post blog-large">
            <article>
                <header class="entry-header">
                    <div class="entry-thumbnail">
                        <div id="pcover">
                            <?php $slide_count = get_option('aven_slide_count'); ?>
                            <?php $slide_cat = 'featured'; ?>
                            <?php $slide_type = 'listings'; ?>

                            <div id="pbox">
                                <div id="pslider">
                                    <?php
                                    $my_query = new WP_Query('post_type=' . $slide_type . '&type=' . $slide_cat . '&showposts=' . $slide_count . '');
                                    while ($my_query->have_posts()) : $my_query->the_post();
                                        ?>
                                        <div class="spanel">

                                            <div class="inpanel">

                                                <div class="spropmeta">
                                                    <h3><?php the_title(); ?></h3>

                                                    <div class="sproplist"><span>Location</span> <span
                                                            class="propval"> <?php echo get_the_term_list($post->ID, 'location', '', ' ', ''); ?></span>
                                                    </div>
                                                    <div class="sproplist"><span>Property type</span> <span
                                                            class="propval"><?php echo get_the_term_list($post->ID, 'property', '', ' ', ''); ?></span>
                                                    </div>
                                                    <div class="sproplist"><span>Area</span> <span
                                                            class="propval"> <?php echo get_the_term_list($post->ID, 'area', '', ' ', ''); ?></span>
                                                    </div>
                                                    <div class="sproplist"><span>Bedrooms</span> <span
                                                            class="propval"> <?php echo get_the_term_list($post->ID, 'bedrooms', '', ' ', ''); ?></span>
                                                    </div>
                                                    <div class="sproplist"><span>Bath</span> <span
                                                            class="propval"> <?php $bath = get_post_meta($post->ID, 'wtf_bath', true);
                                                            echo $bath; ?></span></div>
                                                    <div class="sproplist"><span>Garage</span> <span
                                                            class="propval"> <?php $garage = get_post_meta($post->ID, 'wtf_garage', true);
                                                            echo $garage; ?></span></div>

                                                </div>

                                                <div class="inpabox">
                            <span class="sprice"> <span class="money-simbol">$</span><?php $price = get_post_meta($post->ID, 'wtf_price', true);
                                echo $price; ?></span>
                                                    <span class="sint"><a class="btn btn-primary btn-xs" href="<?php the_permalink() ?>">View</a></span>
                                                </div>

                                            </div>
                                            <a href="<?php the_permalink() ?>"><img class="slideimg img-responsive"
                                                                                    src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo get_image_url() ?>&amp;h=300&amp;w=660&amp;zc=1"
                                                                                    title=""/></a>
                                        </div>
                                    <?php endwhile; ?>

                                </div>
                                <!-- Slider -->

                            </div>
                            <!-- pbox -->

                        </div> <!-- pcover -->
                    </div>

                    <?php
                    $my_query = new WP_Query('category_name=Rental Page');
                    $my_query->the_post();
                    ?>

                    <div class="entry-date">25 November 2014a</div>
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo $post->post_title ?></a></h2>
                </header>

                <div class="entry-content">
                    <p><?php wpe_excerpt('wpe_excerptlength_index', ''); ?></p>
                    <a class="btn btn-primary btn-sm" href="<?php the_permalink(); ?>">Read More</a>
                </div>

<!--                <footer class="entry-meta">-->
<!--                    <span class="entry-author"><i class="fa fa-pencil"></i> <a href="#">Victor</a></span>-->
<!--                    <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="#">Tutorial</a></span>-->
<!--                    <span class="entry-comments"><i class="fa fa-comments-o"></i> <a href="#">15</a></span>-->
<!--                </footer>-->
            </article>
        </div>
    </div><!--/.col-sm-6-->
    <div class="col-sm-6">

        <?php
        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query();
        $wp_query->query('post_type=listings'.'&paged='.$paged);
        ?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

            <div class="blog-post blog-media">
                <article class="media clearfix">
                    <div class="entry-thumbnail pull-left">
                        <img class="img-responsive blog-img-small" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=180&amp;w=310&amp;zc=1" alt="">
                        <span class="post-format post-format-gallery">$<?php $price=get_post_meta($post->ID, 'wtf_price', true); echo $price; ?></span>
                    </div>
                    <div class="media-body">
                        <header class="entry-header">
                            <div class="entry-date">01 December 2014</div>
                            <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        </header>

                        <div class="entry-content">
                            <div>
                                <p><?php
                                    if(strlen($post->post_content) > 72 ){
                                        echo substr($post->post_content, 0, 72) . "...";
                                    }else{
                                        echo $post->post_content;
                                    }  ?>
                                </p>
                            </div>
                            <a class="btn btn-primary btn-sm" href="<?php the_permalink() ?>">Read More</a>
                        </div>
                    </div>
                </article>
                <footer class="entry-meta">
                    <?php $termspro = get_the_terms( $post->ID, 'property' );
                    if($termspro != false) : ?>
                        <span class="entry-author"><i class="fa fa-home"></i> <?php echo get_the_term_list( $post->ID, 'property', '', ' ', '' ); ?></span>
                    <?php endif; ?>

                    <?php $termsloc = get_the_terms( $post->ID, 'location' );
                    if($termsloc != false) : ?>
                        <span class="entry-category"><i class="fa fa-location-arrow"></i> <?php echo get_the_term_list( $post->ID, 'location', '', ' ', '' ); ?></span>
                    <?php endif; ?>



                </footer>
            </div>

        <?php endwhile; ?>


    </div>
</div>


