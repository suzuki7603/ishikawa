<?php
/**
 * The template for displaying Search Results pages
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

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">

					<h1 class="archive-title"><?php printf( __( 'Search Results for : %s', 'fsvgallery' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

				</header><!-- .archive-header -->

				<div id="article-group">

				<?php

				$tile_count = 0;

				 while ( have_posts() ) : the_post();

					$tile_count++;
					$surplus = $tile_count % 3;

					if ( $surplus == 0 ) { echo '<div class="third_tile">'; }

					get_template_part( 'content', get_post_format() );

					if ( $surplus == 0 ) { echo '</div>'; }

				endwhile; ?>

				</div><!-- #article-group -->

			<?php else : // have_posts() check ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; // end have_posts() check ?>

			</div><!-- #content -->

		</div><!-- #primary -->

		<?php fsvgallery_pagination(); ?>

	</div><!-- #main .wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
