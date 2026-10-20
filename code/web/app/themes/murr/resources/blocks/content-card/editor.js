import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from "@wordpress/block-editor";
import { Button, PanelBody } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import block from "./block.json";
import icons from "@scripts/icon.js";

registerBlockType(block, {
    icon: icons.mk,
    edit: ({ attributes, setAttributes }) => {
        const { image, imageUrl } = attributes;

        const instructions = {
            notAllowed: <strong>{__("To edit the image, you need permission to upload media.", "murr")}</strong>,
            previewEmpty: <strong>{__("Use the editor panel to add an image.", "murr")}</strong>,
            add: __("Add Image", "murr"),
            edit: __("Edit Image", "murr"),
        };

        const onImageSelect = (img) => {
            setAttributes({ image: img.id, imageUrl: img.url });
        };

        return (
            <div {...useBlockProps()}>
                <InspectorControls>
                    <PanelBody title={__("Image", "murr")} initialOpen={true}>
                        <MediaUploadCheck fallback={instructions.notAllowed}>
                            <MediaUpload
                                title={__("Select an image", "murr")}
                                onSelect={onImageSelect}
                                allowedTypes={["image"]}
                                value={image}
                                multiple={false}
                                render={({ open }) => (
                                    <Button className={"editor-post-featured-image__toggle"} onClick={open}>
                                        {image ? instructions.edit : instructions.add}
                                    </Button>
                                )}
                            />
                        </MediaUploadCheck>
                    </PanelBody>
                </InspectorControls>
                <article className={"o-content-card"}>
                    <div className={"o-content-card__image"}>
                        <img src={imageUrl} />
                    </div>
                    <div className={"o-content-card__content"}>
                        <InnerBlocks
                            allowedBlocks={["core/button", "core/heading", "core/paragraph", "core/list"]}
                            template={[
                                [
                                    "core/paragraph",
                                    {
                                        content: __("Brand or client name", "murr"),
                                        placeholder: __("Add headline here.", "murr"),
                                        fontSize: "mini",
                                        textColor: "secondary",
                                    },
                                ],
                                [
                                    "core/heading",
                                    {
                                        content: __("Brand or client name", "murr"),
                                        placeholder: __("Add headline here.", "murr"),
                                        fontSize: "xx-large",
                                        level: 2,
                                    },
                                ],
                                [
                                    "core/paragraph",
                                    {
                                        content: __("Punchy work or project intro right here.", "murr"),
                                        placeholder: __("Add descriptive content here.", "murr"),
                                        fontSize: "big",
                                    },
                                ],
                                [
                                    "core/buttons",
                                    {},
                                    [
                                        [
                                            "core/button",
                                            {
                                                text: __("See the project", "murr"),
                                                placeholder: __("See the project", "murr"),
                                            },
                                        ],
                                    ],
                                ],
                            ]}
                        />
                    </div>
                </article>
            </div>
        );
    },
    save: () => <InnerBlocks.Content />,
});
