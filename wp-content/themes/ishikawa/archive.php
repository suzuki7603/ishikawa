<?php
/**
 * The template for displaying Category, Tag, Date, Author Archive pages
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

			<?php fsvgallery_breadcrumb() ; ?>

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">

					<h1 class="archive-title"><?php

					if ( is_day() ) : // Title Output Daily Archive

						printf( __( 'Daily Archives : %s', 'fsvgallery' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) : // Title Output Month Archive

						printf( __( 'Monthly Archives : %s', 'fsvgallery' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'fsvgallery' ) ) . '</span>' );

					elseif ( is_year() ) : // Title Output Yeary Archive

						printf( __( 'Yearly Archives : %s', 'fsvgallery' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'fsvgallery' ) ) . '</span>' );

					elseif ( is_author() ) : // Title Output Author Archive

						printf( __( 'Author Archives : %s', 'fsvgallery' ), '<span>' . get_the_author() . '</span>' );

					elseif ( is_category() ) : // Title Output Category Archive

						printf( __( 'Category Archives : %s', 'fsvgallery' ), '<span>' . single_cat_title( '', false ) . '</span>' );

					elseif ( is_search() ): // Title Output Search Page

						printf( __( 'Search Results for : %s', 'fsvgallery' ), '<span>' . get_search_query() . '</span>' );

					elseif ( is_tag() ): // Title Output Tag Archive

						printf( __( 'Tag Archives : %s', 'fsvgallery' ), '<span>' . single_tag_title( '', false ) . '</span>' ); 

					else : // Title Output Other Pages

						_e( 'Archives', 'fsvgallery' );

					endif; // Title Output

					?></h1>

					<?php if ( ( is_category() ) && ( category_description() ) ) : // Show an optional category description ?>

					<div class="archive-meta"><?php echo category_description(); ?></div>

					<?php endif; ?>

					<?php if ( ( is_tag() ) && ( tag_description() ) ) : // Show an optional tag description ?>

					<div class="archive-meta"><?php echo tag_description(); ?></div>

					<?php endif; ?>

				</header><!-- .archive-header -->

				<div id="article-group">

				<?php while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

				endwhile; ?>

				</div><!-- #article-group -->

			<?php

			else : // have_posts() check

				get_template_part( 'content', 'none' );

			endif; // end have_posts() check ?>

			</div><!-- #content -->

		</div><!-- #primary -->

		<?php fsvgallery_pagination(); ?>

	</div><!-- #main .wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
