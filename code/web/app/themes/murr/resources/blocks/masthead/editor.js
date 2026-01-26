import classNames from "classnames";
import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from "@wordpress/block-editor";
import { Button, PanelBody, RangeControl, SelectControl, TextareaControl, ToggleControl } from "@wordpress/components";
import { __, _x } from "@wordpress/i18n";
import block from "./block.json";
import icons from "../../scripts/icon.js";

const { name } = block;

const Video = ({ sources, children, style = {} }) => {
    const order = ["video/webm", "video/mp4"];
    const sorted = [...sources].sort(function (a, b) {
        return order.indexOf(a.mime) - order.indexOf(b.mime);
    });
    return (
        <video width="100%" height="100%" preload="metadata" loop autoPlay playsInline muted style={style}>
            {sorted.map((vid) => (
                <source key={vid.id} src={vid.url} type={vid.mime} />
            ))}
            {children}
        </video>
    );
};

const Background = ({ format, sources, size = "cover", position = ["center", "center"] }) => {
    const style = { objectFit: size, objectPosition: position.join(" ") };
    if (format === "video") {
        return (
            <Video sources={sources} style={style}>
                Your browser does not support the video tag.
            </Video>
        );
    }

    return sources.map((img) => <img key={img.id} src={img.sizes.full.url} alt={img.alt} style={style} />);
};

registerBlockType(name, {
    icon: icons.mk,
    edit: ({ attributes, setAttributes }) => {
        const { format, backgrounds = [], includeOverlay = true, overlayOpacity = 40, objectSize = "cover", objectPosition = ["center", "center"], embed = false, embedCode = "" } = attributes;
        const instructions = {
            notAllowed: <strong>{__("To edit the background image, you need permission to upload media.", "ghint")}</strong>,
            previewEmpty: <strong>{__("Use the editor panel to add a background.", "ghint")}</strong>,
            add: __("Add Masthead Background", "ghint"),
            edit: __("Edit Masthead Background", "ghint"),
        };
        const onSelectBackground = (newVal) => {
            const backgrounds = format === "video" ? newVal : [newVal];
            setAttributes({ backgrounds });
        };

        return (
            <div {...useBlockProps()}>
                <InspectorControls>
                    {embed && (
                        <PanelBody title={__("Background Embed", "ghint")} initialOpen={true}>
                            <TextareaControl label={__("Embed Code", "ghint")} help={__("Enter your <iframe> code here", "ghint")} value={embedCode} onChange={(embedCode) => setAttributes({ embedCode })} />
                        </PanelBody>
                    )}
                    {!embed && (
                        <PanelBody title={__("Background Cover", "ghint")} initialOpen={true}>
                            <ToggleControl
                                label={__("Include Overlay?", "ghint")}
                                help={includeOverlay ? __("Show overlay", "ghint") : __("Hide overlay", "ghint")}
                                checked={includeOverlay}
                                onChange={() => setAttributes({ includeOverlay: !includeOverlay })}
                            />
                            {includeOverlay && <RangeControl label={__("Overlay Opacity %")} value={overlayOpacity} onChange={(overlayOpacity) => setAttributes({ overlayOpacity })} min={0} max={100} />}
                            <MediaUploadCheck fallback={instructions.notAllowed}>
                                <MediaUpload
                                    title={__("Select Background", "ghint")}
                                    onSelect={onSelectBackground}
                                    allowedTypes={[format]}
                                    value={backgrounds.map((i) => i.id)}
                                    multiple={format === "video"}
                                    render={({ open }) => (
                                        <Button className={"editor-post-featured-image__toggle"} onClick={open}>
                                            {backgrounds.length ? instructions.edit : instructions.add}
                                        </Button>
                                    )}
                                />
                            </MediaUploadCheck>
                        </PanelBody>
                    )}
                    {!embed && (
                        <PanelBody title={__("Background Styles", "ghint")}>
                            <SelectControl
                                label={__("Background Size", "ghint")}
                                value={objectSize}
                                options={[
                                    { label: _x("Cover", "Masthead Background Size", "ghint"), value: "cover" },
                                    { label: _x("Contain", "Masthead Background Size", "ghint"), value: "contain" },
                                    { label: _x("Fill", "Masthead Background Size", "ghint"), value: "fill" },
                                    {
                                        label: _x("Scale Down", "Masthead Background Size", "ghint"),
                                        value: "scale-down",
                                    },
                                    { label: _x("None", "Masthead Background Size", "ghint"), value: "none" },
                                ]}
                                onChange={(objectSize) => setAttributes({ objectSize })}
                            />
                            <SelectControl
                                label={__("Background Position - Horizontal", "ghint")}
                                value={objectPosition[0]}
                                options={[
                                    {
                                        label: _x("Left", "Masthead Background Position X", "ghint"),
                                        value: "left",
                                    },
                                    {
                                        label: _x("Center", "Masthead Background Position X", "ghint"),
                                        value: "center",
                                    },
                                    {
                                        label: _x("Right", "Masthead Background Position X", "ghint"),
                                        value: "right",
                                    },
                                ]}
                                onChange={(x) => setAttributes({ objectPosition: [x, objectPosition[1]] })}
                            />
                            <SelectControl
                                label={__("Background Position - Vertical", "ghint")}
                                value={objectPosition[1]}
                                options={[
                                    {
                                        label: _x("Top", "Masthead Background Position Y", "ghint"),
                                        value: "top",
                                    },
                                    {
                                        label: _x("Center", "Masthead Background Position Y", "ghint"),
                                        value: "center",
                                    },
                                    {
                                        label: _x("Bottom", "Masthead Background Position Y", "ghint"),
                                        value: "bottom",
                                    },
                                ]}
                                onChange={(y) => setAttributes({ objectPosition: [objectPosition[0], y] })}
                            />
                        </PanelBody>
                    )}
                </InspectorControls>

                <div className={classNames("o-masthead", `o-masthead--${format}`, { "o-masthead--embedded": embed }, { "o-masthead--has-overlay": includeOverlay })}>
                    <div className={"o-masthead__background"}>
                        {includeOverlay && <div className={"o-masthead__overlay"} style={{ opacity: overlayOpacity / 100 }}></div>}
                        {embed && <div dangerouslySetInnerHTML={{ __html: embedCode }}></div>}
                        {!embed && backgrounds.length ? <Background format={format} sources={backgrounds} size={objectSize} position={objectPosition} /> : instructions.previewEmpty}
                    </div>
                    <div className={"o-masthead__content"}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
        );
    },
    save: () => <InnerBlocks.Content />,
});
