/**
 * Customizer live preview.
 *
 * Updates the site title, description and header text colour in the preview
 * frame without a full reload.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

( function ( api ) {
	'use strict';

	if ( ! api ) {
		return;
	}

	api( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			document.querySelectorAll( '.site-title a' ).forEach( function ( node ) {
				node.textContent = to;
			} );
		} );
	} );

	api( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			document.querySelectorAll( '.site-description' ).forEach( function ( node ) {
				node.textContent = to;
			} );
		} );
	} );

	api( 'header_textcolor', function ( value ) {
		value.bind( function ( to ) {
			var nodes = document.querySelectorAll( '.site-title a, .site-description' );

			nodes.forEach( function ( node ) {
				node.style.color = 'blank' === to ? '' : to;
			} );
		} );
	} );
}( window.wp && window.wp.customize ) );
