<?php
/**
 * The template for displaying all pages
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

			<?php if ( !( is_home() || is_front_page() ) ) { fsvgallery_breadcrumb(); } else { ?><div id="breadcrumb">&nbsp;</div><?php } ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">

						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header>

					<div class="entry-content">

						<?php if ( has_post_thumbnail() ) : ?>

						<div class="attachment">

							<?php

							$thumbnail_id = get_post_thumbnail_id($post->ID);
							$image_ary = wp_get_attachment_image_src( $thumbnail_id, 'full' );

							$img_src = $image_ary[0]; 
							$img_width = $image_ary[1]; 
							$img_height = $image_ary[2]; 

							if ( ( $img_width < intval( fsvgallery_img_resize('img_post_width') ) ) || ( $img_height < intval( fsvgallery_img_resize('img_post_height') ) ) ) :

								the_post_thumbnail();

							else : ?>

							<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), fsvgallery_img_resize('img_post_width'),  fsvgallery_img_resize('img_post_height'),  fsvgallery_img_resize('img_post_crop') ) ?>" alt="<?php echo the_title(); ?>" />

							<?php endif; ?>

						</div><!-- .attachment -->

						<?php endif; ?>

						<div class="entry-meta">

							<?php edit_post_link( __( 'Edit', 'fsvgallery') , '<p>', '</p>' ); ?>

						</div><!-- .entry-meta -->

						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

					</div><!-- .entry-content -->

				</article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->

		</div><!-- #primary -->

	</div><!-- #main .wrapper -->

<?php comments_template( '', true ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
