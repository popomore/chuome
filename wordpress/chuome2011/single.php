<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


<div class="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-date"><?php the_time('Y.m.d') ?></div>
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<div class="entry-content">
				<?php the_content(); ?>

				<h2 class="related_post_title">分享</h2>			
				<div class="addthis_toolbox addthis_32x32_style addthis_default_style">
				    <a class="addthis_button_delicious"></a>
				    <a class="addthis_button_twitter"></a>
				    <a class="addthis_button_email"></a>
				    <a class="addthis_button_google"></a>
				    <a class="addthis_button_compact"></a>
				</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=popomore"></script>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- #post-## -->


		<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

</div><!-- #content -->
	

<?php get_sidebar(); ?>
<?php get_footer(); ?>
