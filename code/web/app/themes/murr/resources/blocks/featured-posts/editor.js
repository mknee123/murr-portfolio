import classNames from "classnames";
import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import block from "./block.json";
import icons from "@scripts/icon.js";

const introductionTemplate = [
    [
        "core/heading",
        {
            content: __("Latest News.", "murr"),
            placeholder: __("Add a heading here.", "murr"),
            level: 2,
        },
    ],
];

registerBlockType(block, {
    icon: icons.mk,
    edit: () => {
        return (
            <div {...useBlockProps()}>
                <div className={classNames("o-featured-posts")}>
                    <InnerBlocks allowedBlocks={["core/heading", "core/paragraph"]} template={introductionTemplate} />
                </div>
                <p className={"o-featured-posts__message has-huge-font-size"}>
                    <em>{__("The 3 most recent posts will display here automatically.", "murr")}</em>
                </p>
            </div>
        );
    },
    save: () => <InnerBlocks.Content />,
});
