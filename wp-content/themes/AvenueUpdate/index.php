<?php get_header(); ?>
    <div id="content" class="col-md-9">

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="post page-php" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                        <!--                        --><?php //the_content('Read the rest of this entry &raquo;'); ?>
                        <!--                        <div class="clear"></div>-->
                        <?php do_action('render_main'); ?>
                    </div>

                </div>

            <?php endwhile; else: ?>

            <h1 class="title">Not Found</h1>
            <p>I'm Sorry,  you are looking for something that is not here. Try a different search.</p>

        <?php endif; ?>

    </div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>