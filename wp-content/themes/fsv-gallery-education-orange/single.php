<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */
?>

<?php get_header(); ?>

	<div id="main" class="wrapper">

		<div id="primary" class="site-content component-inner">

			<nav class="nav-single-2">

				<?php $tmp_dir = get_template_directory_uri(); ?>

				<div class="nav-previous">

				<?php if ( get_adjacent_post( false , '' , true ) ) : ?>

					<?php previous_post_link( '%link' , '<img src="' . $tmp_dir . '/images/arrow-pagenation-02l.png" alt="Previous" />' ); ?>

				<?php else: ?>

					<?php echo '<a name="no-pager-links" class="no-pager-links"><img src="' . $tmp_dir . '/images/arrow-pagenation-02l.png" alt="" /></a>'; ?>

				<?php endif; ?>

				</div>

				<div class="nav-next">

				<?php if ( get_adjacent_post( false , '' , false ) ) : ?>

					<?php next_post_link( '%link' , '<img src="' . $tmp_dir . '/images/arrow-pagenation-02r.png" alt="Next" />' ); ?>

				<?php else: ?>

					<?php echo '<a name="no-pager-links" class="no-pager-links"><img src="' . $tmp_dir . '/images/arrow-pagenation-02r.png" alt="" /></a>'; ?>

				<?php endif; ?>

				</div>

			</nav><!-- .nav-single -->

			<div id="content" role="main">

			<?php fsvgallery_breadcrumb() ; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">

						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header><!-- .entry-header -->

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

							<div class="entry-meta">

								<?php fsvgallery_entry_meta(); ?>

								<?php edit_post_link( __( 'Edit', 'fsvgallery' ), ' | ', '' ); ?>

							</div><!-- .entry-meta -->

						</div><!-- .attachment -->

						<?php else : ?>

						<div class="archive-meta">

							<?php fsvgallery_entry_meta(); ?>

							<?php edit_post_link( __( 'Edit', 'fsvgallery' ), ' | ', '' ); ?>

						</div><!-- .archive-meta -->

						<?php endif; ?>

						<nav class="nav-single-1">

							<div class="nav-previous">

							<?php if ( get_adjacent_post( false , '' , true ) ) : ?>

								<?php previous_post_link( '%link' , '<img src="' . $tmp_dir . '/images/arrow-pagenation-01l.png" alt="Previous" />' ); ?>


							<?php else: ?>

								<?php echo '<a name="no-pager-links" class="no-pager-links"><img src="' . $tmp_dir . '/images/arrow-pagenation-01l.png" alt="" /></a>'; ?>

							<?php endif; ?>

							</div>

							<div class="nav-next">

							<?php if ( get_adjacent_post( false , '' , false ) ) : ?>

								<?php next_post_link( '%link' , '<img src="' . $tmp_dir . '/images/arrow-pagenation-01r.png" alt="Next" />' ); ?>

							<?php else: ?>

								<?php echo '<a name="no-pager-links" class="no-pager-links"><img src="' . $tmp_dir . '/images/arrow-pagenation-01r.png" alt="" /></a>'; ?>

							<?php endif; ?>

							</div>

						</nav><!-- .nav-single -->

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
