import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from "@wordpress/block-editor";
import { Button, PanelBody, TextControl } from "@wordpress/components";
import { __, _x } from "@wordpress/i18n";
import block from "./block.json";
import icons from "../../scripts/icon.js";

registerBlockType(block, {
    icon: icons.mk,

    edit: ({ attributes, setAttributes }) => {
        const { image, imageUrl, imageAlt, citation, title } = attributes;

        const instructions = {
            notAllowed: <strong>{__("To edit the image, you need permission to upload media.", "ghint")}</strong>,
            previewEmpty: <strong>{__("Use the editor panel to add an image.", "ghint")}</strong>,
            add: __("Optional: Add Image", "ghint"),
            edit: __("Edit Image", "ghint"),
        };

        const onImageSelect = (img) => {
            setAttributes({ image: img.id, imageUrl: img.url, imageAlt: img.alt });
        };

        return (
            <div {...useBlockProps()}>
                <InspectorControls>
                    <PanelBody title={__("Testimonial Citation", "ghint")} initialOpen={true}>
                        <MediaUploadCheck fallback={instructions.notAllowed}>
                            <MediaUpload
                                title={__("Select an image", "ghint")}
                                onSelect={onImageSelect}
                                allowedTypes={["image"]}
                                value={image}
                                multiple={false}
                                render={({ open }) =>
                                    imageUrl ? (
                                        <div className="image">
                                            <figure>
                                                <img src={imageUrl} alt={imageAlt} />
                                            </figure>
                                            <Button className={"button"} onClick={() => setAttributes({ image: "", imageUrl: "", imageAlt: "" })}>
                                                Remove
                                            </Button>
                                        </div>
                                    ) : (
                                        <Button className={"editor-post-featured-image__toggle"} onClick={open}>
                                            {instructions.add}
                                        </Button>
                                    )
                                }
                            />
                        </MediaUploadCheck>
                    </PanelBody>
                    <PanelBody title={__("Citation", "ghint")} initialOpen={true}>
                        <TextControl label={__("Optional: Author.", "ghint")} value={citation} onChange={(citation) => setAttributes({ citation })} />
                        <TextControl label={__("Optional: Title or Position", "ghint")} value={title} onChange={(title) => setAttributes({ title })} />
                    </PanelBody>
                </InspectorControls>
                <figure className={"o-testimonial"}>
                    <blockquote className={"o-testimonial__content"}>
                        <InnerBlocks
                            allowedBlocks={["core/paragraph"]}
                            template={[
                                [
                                    "core/paragraph",
                                    {
                                        placeholder: __("A testimonial or review goes here ames vulputate adipiscing dictum ac gestas non a nunc arcu quis libero consequat tincidunt tortor.", "ghint"),
                                        fontSize: "xx-large",
                                        textColor: "secondary",
                                    },
                                ],
                            ]}
                        />
                    </blockquote>
                    {(imageUrl || citation || title) && (
                        <div className={"o-testimonial__citation"}>
                            {imageUrl && (
                                <div className={"o-testimonial__img"}>
                                    <img src={imageUrl} alt={imageAlt} width={"80"} />
                                </div>
                            )}
                            {citation || title ? (
                                <figcaption className={"o-testimonial__cite"}>
                                    {citation}
                                    {citation && title ? ", " : ""}
                                    {title}
                                </figcaption>
                            ) : (
                                ""
                            )}
                        </div>
                    )}
                </figure>
            </div>
        );
    },
    save: () => <InnerBlocks.Content />,
});
