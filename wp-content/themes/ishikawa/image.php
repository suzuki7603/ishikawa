<?php
/**
 * The template for displaying image attachments
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

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>

					<header class="entry-header">

						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header><!-- .entry-header -->

					<div class="entry-content">

						<div class="attachment">

							<?php
							/**
 							 * Filter the image attachment size to use.
							 *
						 	 * @param array $size {
							 *     @type int The attachment height in pixels.
						 	 *     @type int The attachment width in pixels.
							 * }
						 	*/
							$attachment_size = apply_filters( 'fsvgallery_attachment_size', array( 1200, 1200 ) );
							echo wp_get_attachment_image( $post->ID, $attachment_size );
							?>

						</div><!-- .attachment -->

						<div class="archive-meta">

							<strong><?php
								$metadata = wp_get_attachment_metadata();

								printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'fsvgallery' ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									esc_url( wp_get_attachment_url() ),
									$metadata['width'],
									$metadata['height'],
									esc_url( get_permalink( $post->post_parent ) ),
									esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
									get_the_title( $post->post_parent )
								); 
							?></strong>

							<?php edit_post_link( __( 'Edit', 'fsvgallery' ), ' | ', '' ); ?>

						</div><!-- .archive-meta -->

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>

							<?php the_excerpt(); ?>

						<?php endif; ?>

						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

					</div><!-- .entry-content -->

				</article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->

		</div><!-- #primary -->

	</div><!-- #main .wrapper -->

<?php comments_template(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
