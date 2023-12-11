import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks, useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";
import { __, _x } from "@wordpress/i18n";
import block from "./block.json";
import icons from "../../scripts/icon.js";

registerBlockType(block, {
    icon: icons.gh,
    edit: () => {
        const blockProps = useBlockProps({ className: "o-newsletter" });
        const innerBlocksProps = useInnerBlocksProps(blockProps, {
            allowedBlocks: ["core/heading", "core/paragraph"],
            template: [
                [
                    "core/columns",
                    { className: "o-newsletter__columns" },
                    [
                        [
                            "core/column",
                            { className: "o-newsletter__col", width: "33.33%" },
                            [
                                [
                                    "core/heading",
                                    {
                                        content: __("Stay Informed!", "ghint"),
                                        level: 2,
                                        textColor: "secondary",
                                    },
                                ],
                                [
                                    "core/paragraph",
                                    {
                                        content: __("Sign up for the newsletter to receive the latest news and more.", "ghint"),
                                        fontSize: "big",
                                    },
                                ],
                            ],
                        ],
                        [
                            "core/column",
                            { className: "o-newsletter__col" },
                            [
                                [
                                    "gravityforms/form",
                                    {
                                        formId: "2",
                                        title: false,
                                        description: false,
                                        ajax: true,
                                    },
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        });

        return (
            <div {...useBlockProps()}>
                <div {...innerBlocksProps} />
            </div>
        );
    },
    save: () => <InnerBlocks.Content />,
});
