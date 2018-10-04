<?php
/**
 * The template for displaying 404 pages (Not Found)
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

				<?php fsvgallery_breadcrumb() ; ?>

				<?php get_template_part( 'content', 'none' ); ?>

			</div><!-- #content -->

		</div><!-- #primary -->

	</div><!-- #main .wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
