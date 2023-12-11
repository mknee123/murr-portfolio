import classNames from "classnames";
import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks, InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, RangeControl, TextControl, ToggleControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import block from "./block.json";
import icons from "../../scripts/icon.js";

const HeadingTag = ({ className, level, children }) => {
    const Tag = `h${level}`;
    return <Tag className={className}>{children}</Tag>;
};

registerBlockType(block, {
    icon: icons.gh,
    edit: ({ attributes, setAttributes }) => {
        const { heading, open, level } = attributes;

        return (
            <div {...useBlockProps()}>
                <div className={classNames("m-collapse", { "m-collapse--open": open })}>
                    <InspectorControls key={"collapse-settings"}>
                        <PanelBody header={__("Collapse Options", "ghint")}>
                            <TextControl label={__("Heading Text", "ghint")} value={heading} onChange={(heading) => setAttributes({ heading })} />
                            <RangeControl label={__("Heading Level", "ghint")} value={level} min={1} max={6} onChange={(level) => setAttributes({ level })} />
                            <ToggleControl
                                label={__("Open?", "ghint")}
                                help={__("Initializes the content body in an open or closed state", "ghint")}
                                checked={open}
                                onChange={(open) => setAttributes({ open })}
                            />
                        </PanelBody>
                    </InspectorControls>

                    <HeadingTag className={classNames("m-collapse__heading", { "text--disabled": !heading })} level={level}>
                        {heading || __("Enter your heading", "ghint")}
                    </HeadingTag>
                    <div className={"m-collapse__content"}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
        );
    },
    save: () => <InnerBlocks.Content />,
});
