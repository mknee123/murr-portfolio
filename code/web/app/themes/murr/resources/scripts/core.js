/*
	Name:			Core.js
	Description:    Core script for the theme.
	Version:        1.0.0
	Author:         GH Advertising
*/
import jQuery from "jquery";
import { throttle } from "throttle-debounce";
import "@styles/core.scss";
(($, initMessage) => {
    $(() => {
        console.log(initMessage);

        let width = $(window).width(),
            height = $(window).height(),
            windowsize;

        const $header = $(".o-header"),
            $navContainer = $(".o-header__nav-container"),
            $navControl = $(".o-header__nav-control"),
            headerOpen = "o-header--open",
            navClass = "o-header__nav-container--open",
            navControlClass = "o-header__nav-control--open",
            $html = $("html");

        // Global > size check
        const sizeCheck = () => {
            if ($(window).width() !== width || $(window).height() !== height) {
                $navControl.removeClass(navControlClass);
                $navContainer.removeClass(navClass);
                $header.removeClass(headerOpen);
                $html.removeClass("overflow-hidden");
                $(".o-header__dropdown").removeClass("active");
                $(".o-header__dropdown").parent("div").removeClass("active");
                $(".o-header__dropdown-wrapper > a").removeClass("active");
                $(".sub-menu").removeClass("sub-menu--open");
            }

            windowsize = $(window).width();

            // Ensure this integer matches the breakpoint used in header.scss
            if ($(window).width() < 1261) {
                /**
                 * Make dropdown button expand and collapse sub-menu
                 */
                $(".o-header__dropdown")
                    .off()
                    .on("click touch", function (e) {
                        const self = $(this);
                        const siblings = self.siblings("a");

                        self.toggleClass("active");
                        siblings.toggleClass("active");
                        self.parent("div").siblings(".sub-menu").toggleClass("sub-menu--open");
                    });
            }
        };

        // Header > navigation toggle
        $navControl.on("click touch", () => {
            $navControl.toggleClass(navControlClass);
            $navContainer.toggleClass(navClass);
            $header.toggleClass(headerOpen);
            $html.toggleClass("overflow-hidden");
        });

        $(window).on("resize", throttle(500, sizeCheck));

        sizeCheck();

        /**
         * Open search overlay on click of search icon in the primary nav on desktop
         */
        const $searchForm = $("#search-overlay");
        $("#search-icon").on("click tap", (e) => {
            /** Prevent jump to top of page */
            e.preventDefault();
            e.stopPropagation();
            $searchForm.addClass("o-search-overlay--open");
            /** prevent html from scrolling */
            $html.addClass("overflow-hidden");
        });
        /**
         * Close search overlay on click of close icon
         */
        $(".o-search-overlay__trigger").on("click tap", (e) => {
            /** Prevent jump to top of page */
            e.preventDefault();
            e.stopPropagation();
            $searchForm.removeClass("o-search-overlay--open");
            /** prevent html from scrolling */
            $html.removeClass("overflow-hidden");
        });
        /**
         * Close Items
         */
        $(document).on("click touch keyup keydown", (e) => {
            /**
             * Close mobile nav if open and when user clicks esc key
             */
            if (e.target.matches(`.${navClass}, .${navClass} *`) && e.key === "Escape") {
                $navControl.toggleClass(navControlClass);
                $navContainer.toggleClass(navClass);
            }
            /**
             * Close mobile nav if user tabs outside of nav
             */
            if ($navContainer.hasClass(navClass) && $navControl.hasClass(navControlClass) && !e.target.matches(`.${headerOpen} *`)) {
                $navControl.toggleClass(navControlClass);
                $navContainer.toggleClass(navClass);
            }

            /**
             * Close search overlay form if active and user clicks elsewhere or esc key is hit
             */
            if (e.target.matches(".o-search-overlay--open") || e.key === "Escape") {
                $searchForm.removeClass("o-search-overlay--open").delay(150);
                $html.removeClass("overflow-hidden");
            }
        });
    });
})(jQuery, "Frontend ready");
