/*
	Name:  				Editor.js
	Description:  Editor script for the theme.
	Version:      1.0.1
	Author:       MK
*/
import domReady from "@wordpress/dom-ready";
import { registerBlockStyle, unregisterBlockStyle } from "@wordpress/blocks";
import "@styles/editor.scss";

window.addEventListener("load", function () {
    // button default styles
    unregisterBlockStyle("core/button", ["fill", "outline"]);
});

domReady(() => {
    // CUSTOMIZE BLOCK STYLES

    // button styles
    registerBlockStyle("core/button", [
        {
            name: "default",
            label: "Default",
            isDefault: true,
        },
        {
            name: "hollow",
            label: "Hollow",
        },
        {
            name: "micro",
            label: "Micro",
        },
        {
            name: "arrow-right",
            label: "Arrow Right",
        },
        {
            name: "arrow-left",
            label: "Arrow Left",
        },
    ]);

    // column styles
    registerBlockStyle("core/columns", [
        {
            name: "default",
            label: "Default",
            isDefault: true,
        },
        {
            name: "borders",
            label: "Borders",
        },
        {
            name: "no-gap",
            label: "No Gap",
        },
        {
            name: "reduced-gap",
            label: "Reduced Gap",
        },
    ]);
    // group styles
    registerBlockStyle("core/group", [
        {
            name: "default",
            label: "Default",
            isDefault: true,
        },
        {
            name: "no-padding",
            label: "No Padding",
        },
        {
            name: "reduce-padding",
            label: "Reduce Padding",
        },
    ]);
    // list styles
    registerBlockStyle("core/list", [
        {
            name: "default",
            label: "Default",
            isDefault: true,
        },
        {
            name: "two-column",
            label: "2-Column",
        },
    ]);

    // paragraph styles
    registerBlockStyle("core/paragraph", [
        {
            name: "default",
            label: "Default",
            isDefault: true,
        },
        {
            name: "condense",
            label: "Condense",
        },
    ]);
});
