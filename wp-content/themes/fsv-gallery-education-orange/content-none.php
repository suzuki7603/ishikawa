<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */
?>

				<article id="post-0" class="post no-results not-found">

					<header class="entry-header">

						<h1 class="entry-title"><?php

						if ( is_404() ) :

							_e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'fsvgallery' );

						else :

							_e( 'Nothing Found', 'fsvgallery' );

						endif; ?></h1>

					</header>

					<div class="entry-content">

						<p><?php

						if ( is_search() ) :

							_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'fsvgallery' ); 

						elseif ( is_404() ) :

							_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fsvgallery' );

						else :

							_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'fsvgallery' );

						endif; ?></p>

						<?php get_search_form(); ?>

					</div><!-- .entry-content -->

				</article><!-- #post-0 -->
