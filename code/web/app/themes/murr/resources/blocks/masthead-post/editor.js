import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps } from "@wordpress/block-editor";
import ServerSideRender from "@wordpress/server-side-render";
import block from "./block.json";
import icons from "@src/scripts/icon.js";

registerBlockType(block, {
    icon: icons.mk,
    edit: () => (
        <div {...useBlockProps()}>
            <ServerSideRender block={block.name} />
        </div>
    ),
});
