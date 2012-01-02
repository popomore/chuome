<?php
/**
 * Template Name: archive
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div class="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><?php the_title(); ?></h2>


			<div class="entry-content">
				<?php wp_get_archives(); ?>

			</div><!-- .entry-content -->
	</div><!-- #post-## -->

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

</div><!-- #content -->


<?php get_footer(); ?>
