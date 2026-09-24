/**
 * Primary navigation behaviour.
 *
 * Everything here is progressive: the menu is usable with JavaScript off
 * (sub-menus open on hover and on :focus-within), and this file adds the
 * explicit toggles keyboard and touch users need.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

( function () {
	'use strict';

	var strings =
		typeof window.sindoorValourNav === 'object' && window.sindoorValourNav
			? window.sindoorValourNav
			: { expand: 'Open sub-menu', collapse: 'Close sub-menu' };

	/**
	 * Wires the mobile menu button to the navigation element.
	 *
	 * @param {HTMLElement} button     Toggle button.
	 * @param {HTMLElement} navigation Navigation element.
	 */
	function setUpMenuToggle( button, navigation ) {
		button.addEventListener( 'click', function () {
			var isOpen = navigation.classList.toggle( 'sv-is-open' );

			button.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
		} );

		// Escape closes the menu and returns focus to the button that opened it.
		navigation.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' !== event.key || ! navigation.classList.contains( 'sv-is-open' ) ) {
				return;
			}

			navigation.classList.remove( 'sv-is-open' );
			button.setAttribute( 'aria-expanded', 'false' );
			button.focus();
		} );
	}

	/**
	 * Wires one sub-menu toggle button.
	 *
	 * @param {HTMLElement} toggle Toggle button rendered by PHP.
	 */
	function setUpSubmenuToggle( toggle ) {
		var item = toggle.parentNode;

		if ( ! item ) {
			return;
		}

		toggle.addEventListener( 'click', function ( event ) {
			event.preventDefault();

			var isOpen = item.classList.toggle( 'sv-submenu-open' );
			var label = toggle.querySelector( '.screen-reader-text' );

			toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );

			if ( label ) {
				label.textContent = isOpen ? strings.collapse : strings.expand;
			}
		} );
	}

	/**
	 * Closes every open sub-menu when focus or a click leaves the navigation.
	 *
	 * @param {HTMLElement} navigation Navigation element.
	 */
	function closeOnOutsideInteraction( navigation ) {
		function closeAll( event ) {
			if ( navigation.contains( event.target ) ) {
				return;
			}

			var open = navigation.querySelectorAll( '.sv-submenu-open' );

			Array.prototype.forEach.call( open, function ( item ) {
				var toggle = item.querySelector( '.sv-submenu-toggle' );

				item.classList.remove( 'sv-submenu-open' );

				if ( toggle ) {
					toggle.setAttribute( 'aria-expanded', 'false' );
				}
			} );
		}

		document.addEventListener( 'click', closeAll );
		document.addEventListener( 'focusin', closeAll );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		var navigation = document.getElementById( 'site-navigation' );
		var button = document.querySelector( '.sv-menu-toggle' );

		if ( ! navigation ) {
			return;
		}

		if ( button ) {
			setUpMenuToggle( button, navigation );
		}

		var toggles = navigation.querySelectorAll( '.sv-submenu-toggle' );

		Array.prototype.forEach.call( toggles, setUpSubmenuToggle );

		closeOnOutsideInteraction( navigation );
	} );
}() );
