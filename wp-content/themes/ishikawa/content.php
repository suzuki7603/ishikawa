<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */
?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'individual' ); ?>>

					<div class="entry-summary">

						<a href="<?php the_permalink(); ?>" rel="bookmark">

						<?php

						if ( ! is_attachment() ) :

							if ( has_post_thumbnail() ) :

								$thumbnail_id = get_post_thumbnail_id($post->ID);
								$image_ary = wp_get_attachment_image_src( $thumbnail_id, 'full' );

								$img_src = $image_ary[0]; 
								$img_width = $image_ary[1]; 
								$img_height = $image_ary[2]; 

								if ( ( $img_width >= intval( fsvgallery_img_resize('img_archive_width') ) ) && ( $img_height >= intval( fsvgallery_img_resize('img_archive_height') ) ) ): ?>

									<img class="main-tile" src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), fsvgallery_img_resize('img_archive_width'),  fsvgallery_img_resize('img_archive_height'),  fsvgallery_img_resize('img_archive_crop') ) ?>" alt="<?php echo the_title(); ?>" />

								<?php else : ?>

									<img class="main-tile" src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), fsvgallery_img_resize('img_archive_width'),  fsvgallery_img_resize('img_archive_height'),  fsvgallery_img_resize('img_archive_crop') , $single = true, $upscale = true ) ?>" alt="<?php echo the_title(); ?>" />

								<?php endif;

							else :

								if ( ! is_singular() ) { echo '<img class="main-tile" src="' . get_template_directory_uri() . '/images/default_noimage.png" alt="No Image" />'; }

							endif; 

						endif; ?>

							<div class="excerpt-contents">

								<h1 class="excerpt-title"><?php the_title(); ?></h1>

								<?php the_excerpt(); ?>

							</div><!-- .excerpt-contents -->

						</a>

					</div><!-- .entry-summary -->

				</article><!-- #post -->
