(function () {
	"use strict";

	var wideQuery = window.matchMedia("(min-width: 64rem)");

	function activateParent(root, parentId) {
		var parents = root.querySelectorAll("[data-mega-parent]");
		var panels = root.querySelectorAll("[data-mega-panel]");
		var index;

		for (index = 0; index < parents.length; index += 1) {
			var parent = parents[index];
			var isActive = parent.getAttribute("data-mega-parent") === parentId;
			var button = parent.querySelector(".mega-menu__parent-btn");

			parent.classList.toggle("is-active", isActive);

			if (button) {
				button.setAttribute("aria-selected", isActive ? "true" : "false");
				button.setAttribute("tabindex", isActive ? "0" : "-1");
			}
		}

		for (index = 0; index < panels.length; index += 1) {
			var panel = panels[index];
			var show = panel.getAttribute("data-mega-panel") === parentId;

			panel.classList.toggle("is-active", show);

			if (show) {
				panel.removeAttribute("hidden");
			} else {
				panel.setAttribute("hidden", "");
			}
		}
	}

	function bindMega(root) {
		var parents = root.querySelectorAll("[data-mega-parent]");
		var index;

		for (index = 0; index < parents.length; index += 1) {
			(function (parent) {
				var parentId = parent.getAttribute("data-mega-parent");
				var button = parent.querySelector(".mega-menu__parent-btn");

				if (!parentId || !button) {
					return;
				}

				button.addEventListener("click", function () {
					activateParent(root, parentId);
				});

				parent.addEventListener("mouseenter", function () {
					if (wideQuery.matches) {
						activateParent(root, parentId);
					}
				});
			})(parents[index]);
		}
	}

	function bindTriggers() {
		var items = document.querySelectorAll(".primary-menu > .menu-item.drbotax-mega");
		var index;

		for (index = 0; index < items.length; index += 1) {
			(function (item) {
				var link = item.querySelector(":scope > a");
				var closeTimer = null;

				function openMega() {
					window.clearTimeout(closeTimer);
					item.classList.add("is-mega-open");
				}

				function scheduleClose() {
					window.clearTimeout(closeTimer);
					closeTimer = window.setTimeout(function () {
						item.classList.remove("is-mega-open");
					}, 200);
				}

				if (!link) {
					return;
				}

				item.addEventListener("mouseenter", function () {
					if (wideQuery.matches) {
						openMega();
					}
				});

				item.addEventListener("mouseleave", function () {
					if (wideQuery.matches) {
						scheduleClose();
					}
				});

				link.addEventListener("focus", function () {
					if (wideQuery.matches) {
						openMega();
					}
				});

				item.addEventListener("focusout", function (event) {
					if (!wideQuery.matches) {
						return;
					}

					if (event.relatedTarget && item.contains(event.relatedTarget)) {
						return;
					}

					scheduleClose();
				});

				link.addEventListener("click", function (event) {
					if (wideQuery.matches) {
						return;
					}

					event.preventDefault();
					item.classList.toggle("is-mega-open");
				});
			})(items[index]);
		}
	}

	function init() {
		var menus = document.querySelectorAll("[data-mega-menu]");
		var index;

		for (index = 0; index < menus.length; index += 1) {
			bindMega(menus[index]);
		}

		bindTriggers();
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", init);
	} else {
		init();
	}
})();
