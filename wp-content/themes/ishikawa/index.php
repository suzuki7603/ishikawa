<?php
/**
 * The main template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */
?>

<?php get_header(); ?>

	<div id="main" class="wrapper">

		<div id="primary" class="site-content component-inner">

			<div id="content" role="main">

			<?php if  ( ! is_home() && ! is_front_page() ) { fsvgallery_breadcrumb(); } ?>

			<?php if ( have_posts() ) : ?>

				<?php if ( ! is_singular() ) : ?>

				<div id="article-group">

				<?php endif; // ! is_singular() ?>

				<?php while ( have_posts() ) : the_post();

					get_template_part( 'content', get_post_format() );

				endwhile; ?>

				<?php if ( ! is_singular() ) : ?>

				</div><!-- #article-group -->

				<?php endif; // ! is_singular() ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; // end have_posts() check ?>

			</div><!-- #content -->

		</div><!-- #primary -->

		<?php fsvgallery_pagination(); ?>

		<?php // This will not be appeared, normally. Place this just in case.

			next_posts_link( '<span class="meta-pager">&larr;</span>' );
			previous_posts_link( '<span class="meta-pager">&rarr;</span>' );

		 ?>

	</div><!-- #main .wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
