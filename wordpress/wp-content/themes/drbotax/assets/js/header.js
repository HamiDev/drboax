(function () {
	"use strict";

	var SCROLL_THRESHOLD = 24;
	var header;
	var ticking = false;

	function setScrolledState() {
		if (!header) {
			return;
		}

		header.classList.toggle("is-scrolled", window.scrollY > SCROLL_THRESHOLD);
	}

	function onScroll() {
		if (ticking) {
			return;
		}

		ticking = true;
		window.requestAnimationFrame(function () {
			setScrolledState();
			ticking = false;
		});
	}

	function init() {
		header = document.querySelector(".site-header");

		if (!header) {
			return;
		}

		setScrolledState();
		window.addEventListener("scroll", onScroll, { passive: true });
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", init);
	} else {
		init();
	}
})();
