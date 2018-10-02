/**
 * This script is used for making the entire site responsive.
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */

( function( $ ) {

	var v_position = 786;
	var m_position = 1218;

	$(function(){

		var w_normal = window.innerWidth;

		if ( w_normal < v_position ) {

			$( 'nav#site-navigation' ).mmenu();
			window.name = 'window_mnu';

		}

		if ( $( '#page' ).children().hasClass( 'header-image' ) ) {

			// .img-description CSS Settings
			var box_css_w = document.getElementById( 'img-description' );

			var box_height_w = $( '#header-image-area' ).height();
			box_css_w.style.height = box_height_w + 'px' ;

			var box_width_w = $( '#header-image-area' ).width();

			if ( w_normal >= m_position ) {

				box_width_w = ( box_width_w - m_position ) / 2

				box_css_w.style.marginLeft = box_width_w + 'px' ;
				box_css_w.style.marginRight = box_width_w + 'px' ;

			} else {

				box_css_w.style.marginLeft = 'auto' ;
				box_css_w.style.marginRight = 'auto' ;

			}

		}

	});

	var r_timer = false;

	$(window).resize(function() {

		if ( r_timer !== false ) {

			clearTimeout( r_timer );

    	}

		r_timer = setTimeout(function() {

			var w_resize = window.innerWidth;

			$(function(){

				if ( w_resize < v_position ) {

					$( 'nav#site-navigation' ).mmenu();
					window.name = 'window_mnu';

				} else {

					if ( window.name != 'window_res' ) {

						window.name = 'window_res';

						// Refresh Window
						if( window == parent ){

							location.reload();

						}

					}

				}

				if ( $( '#page' ).children().hasClass( 'header-image' ) ) {

					// .img-description CSS Settings
					var box_css_r = document.getElementById( 'img-description' );

					var box_height_r = $( '#header-image-area' ).height(); 
					box_css_r.style.height = box_height_r + 'px' ;

					var box_width_r = $( '#header-image-area' ).width();

					if ( w_resize >= m_position ) {

						box_width_r = ( box_width_r - m_position ) / 2

						box_css_r.style.marginLeft = box_width_r + 'px' ;
						box_css_r.style.marginRight = box_width_r + 'px' ;

					} else {

						box_css_r.style.marginLeft = 'auto' ;
						box_css_r.style.marginRight = 'auto' ;

					}

				}

			});

		}, 50);

	});

} )( jQuery );

