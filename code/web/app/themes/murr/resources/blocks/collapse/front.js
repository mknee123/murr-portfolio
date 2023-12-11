import jQuery from "jquery";
import domReady from "@wordpress/dom-ready";
import "./index.scss";

(($, className) => {
    const selector = `.${className}`;
    domReady(() => {
        const $el = $(selector);
        $el.on("click", `${selector}__heading`, (e) => {
            const $this = $(e.currentTarget);
            const $wrap = $this.parents(selector);
            const $content = $this.siblings(`${selector}__content`);
            const action = $content.is(":visible") ? "close" : "open";

            [`ghint:${action}`, "ghint:toggle"].forEach((trigger) => {
                $this.trigger(trigger, [className, $wrap]);
            });
        }).on("ghint:toggle", (e) => {
            const $this = $(e.currentTarget);
            $this.find(`${selector}__content`).slideToggle();
            $this.toggleClass(`${className}--toggled`);
        });
    });
})(jQuery, "m-collapse");
