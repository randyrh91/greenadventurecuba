<?php
/**
 * Template Name: Template for Page
 */
?>
<?php get_header(); ?>

<div id="content"  class="col-md-12">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="container-fluid post page-php" id="post-<?php the_ID(); ?>">
<h1 id="bienvenido"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
<div class="entry">
<?php the_content('Read the rest of this entry &raquo;',true); ?>
<div class="clear"></div>

</div>

</div>

<?php endwhile; else: ?>

		<h1 class="title">Not Found</h1>
		<p>I'm Sorry,  you are looking for something that is not here. Try a different search.</p>

<?php endif; ?>

</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>