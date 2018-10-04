<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.1
 */
?>

	<div id="main-footer" role="contentinfo">

		<div class="component-inner">

			<p class="footer-copy"><?php

				$options = fsvgallery_get_theme_options();

				if ( !isset( $options[ 'foot_text' ] ) ) { $opFootText = 'Copyright'; }
				else { $opFootText = $options[ 'foot_text' ]; }

				echo nl2br( $opFootText );

			?></p>

		</div><!-- .component-inner -->

	</div><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
