(function () {
	"use strict";

	var SCROLL_BUFFER = 16;
	var header;
	var ticking = false;
	var isScrolled = false;
	var enterThreshold = 48;
	var exitThreshold = 8;

	/**
	 * Compacting the sticky header shortens the document and lowers scrollY.
	 * Enter must sit above that height delta so the class cannot flip back.
	 * Transitions are disabled while measuring so heights are final, not mid-animation.
	 */
	function measureThresholds() {
		var previous = header.classList.contains( "is-scrolled" );

		header.classList.add( "is-measuring" );
		header.classList.remove( "is-scrolled" );
		var fullHeight = header.offsetHeight;

		header.classList.add( "is-scrolled" );
		var compactHeight = header.offsetHeight;

		header.classList.toggle( "is-scrolled", previous );
		// Flush layout while transitions are still off.
		void header.offsetHeight;
		header.classList.remove( "is-measuring" );

		var delta = Math.max( 0, fullHeight - compactHeight );

		enterThreshold = delta + SCROLL_BUFFER;
		exitThreshold = Math.max( 0, SCROLL_BUFFER - 8 );
	}

	function setScrolledState() {
		if ( ! header ) {
			return;
		}

		var y = window.scrollY;

		if ( ! isScrolled && y >= enterThreshold ) {
			header.classList.add( "is-scrolled" );
			isScrolled = true;
		} else if ( isScrolled && y <= exitThreshold ) {
			header.classList.remove( "is-scrolled" );
			isScrolled = false;
		}
	}

	/**
	 * Enable size transitions only after the initial scrolled state has painted,
	 * so refresh does not animate the logo from compact to full.
	 */
	function enableReadyMotion() {
		window.requestAnimationFrame( function () {
			window.requestAnimationFrame( function () {
				if ( header ) {
					header.classList.add( "is-ready" );
				}
			} );
		} );
	}

	function onScroll() {
		if ( ticking ) {
			return;
		}

		ticking = true;
		window.requestAnimationFrame( function () {
			setScrolledState();
			ticking = false;
		} );
	}

	function onResize() {
		measureThresholds();
		setScrolledState();
	}

	function init() {
		header = document.querySelector( ".site-header" );

		if ( ! header ) {
			return;
		}

		measureThresholds();
		isScrolled = header.classList.contains( "is-scrolled" );
		setScrolledState();
		enableReadyMotion();

		window.addEventListener( "scroll", onScroll, { passive: true } );
		window.addEventListener( "resize", onResize, { passive: true } );
	}

	if ( document.readyState === "loading" ) {
		document.addEventListener( "DOMContentLoaded", init );
	} else {
		init();
	}
})();
