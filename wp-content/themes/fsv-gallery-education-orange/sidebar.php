<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */
?>

	<div id="sub" class="footer-widget-area" role="complementary">

		<div class="component-inner">

			<div id="footer-widget-area-1" class="widget-area">

				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

				<?php dynamic_sidebar( 'sidebar-1' ); ?>

				<?php else : // is_active_sidebar( 'sidebar-1' ) ?>

				<aside class="widget widget_categories">

					<h3 class="widget-title"><?php _e( 'Category List', 'fsvgallery' ); ?></h3>

					<ul>

						<?php wp_list_categories( 'orderby=name&title_li=' ); ?>

					</ul>

				</aside>

				<?php endif; // is_active_sidebar( 'sidebar-1' ) ?>

			</div><!-- #footer-widget-area-1 -->

			<div id="footer-widget-area-2" class="widget-area">

				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>

				<?php dynamic_sidebar( 'sidebar-2' ); ?>

				<?php else : // is_active_sidebar( 'sidebar-2' ) ?>

				<aside class="widget widget_archive">

					<h3 class="widget-title"><?php _e( 'Monthly Archives', 'fsvgallery' ); ?></h3>

					<ul>

						<?php wp_get_archives( 'type=monthly&limit=10' ); ?>

					</ul>

				</aside>

				<?php endif; // is_active_sidebar( 'sidebar-2' ) ?>

			</div><!-- #footer-widget-area-2 -->

			<div id="footer-widget-area-3" class="widget-area">

				<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>

				<?php dynamic_sidebar( 'sidebar-3' ); ?>

				<?php else : // is_active_sidebar( 'sidebar-3' ) ?>

				<aside class="widget widget_recent_entries">

					<h3 class="widget-title"><?php _e( 'Recent Posts', 'fsvgallery' ); ?></h3>

					<?php

					$args = array(
						'ignore_sticky_posts' => true, 
						'posts_per_page' => 5
					);

					$the_query = new WP_Query( $args );

					if ( $the_query->have_posts() ) : ?>

					<ul>

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<li><span class="post-date"><?php the_time('Y/n/j'); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

						<?php endwhile; ?>

					</ul>

					<?php else: ?>

					<p><?php _e( 'There are currently no posts.', 'fsvgallery' ); ?></p>

					<?php endif;

					wp_reset_postdata(); ?>

				</aside>

				<?php endif; // is_active_sidebar( 'sidebar-3' ) ?>

			</div><!-- #footer-widget-area-3 -->

		</div><!-- .component-inner -->

		<div class="clear"></div>

	</div><!-- #secondary -->
