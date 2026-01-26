const path = require("path");
const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const RtlCssPlugin = require("@wordpress/scripts/plugins/rtlcss-webpack-plugin");
const ImageMinimizerPlugin = require("image-minimizer-webpack-plugin");
const sharp = require("sharp");
const customScripts = require("./config/entrypoints");

const convertEntry = (type, name, value, converter) => {
    if (typeof value === "string") {
        return converter(value, name);
    } else if (type in value) {
        return value[type];
    }
    return value;
};
const mapEntries = (type, stringConvert) => {
    return Object.keys(customScripts).reduce((o, name) => {
        o[name] = convertEntry(type, name, customScripts[name], stringConvert);
        return o;
    }, {});
};

const extraEntry = mapEntries("script", (value) => ({
    import: value,
    filename: "scripts/[name].js",
}));
const extraStyle = mapEntries("style", () => "styles/[name].css");

// Override styles
defaultConfig.plugins.forEach((plugin, i, plugins) => {
    if (plugin instanceof MiniCSSExtractPlugin) {
        plugins[i] = new MiniCSSExtractPlugin({
            filename: (pathData) => {
                return pathData.chunk.name in extraStyle ? extraStyle[pathData.chunk.name] : "[name].css";
            },
        });
    }
    if (plugin instanceof RtlCssPlugin) {
        delete plugins[i];
    }
});

const entry = defaultConfig.entry();
const config = {
    ...defaultConfig,
    entry: {
        ...entry,
        ...extraEntry,
    },
    resolve: {
        ...defaultConfig.resolve,
        alias: {
            "@src": path.resolve(__dirname, "resources"),
            "@dist": path.resolve(__dirname, "public"),
            "@blocks": "@src/blocks",
            "@fonts": "@src/fonts",
            "@images": "@src/images",
            "@icons": "@src/icons",
            "@videos": "@src/videos",
            "@scripts": "@src/scripts",
            "@styles": "@src/styles",
            "@meta": "@src/meta",
            ...defaultConfig.resolve.alias,
        },
    },
    // Add the optimization block
    optimization: {
        ...defaultConfig.optimization,
        minimizer: [
            ...defaultConfig.optimization.minimizer,
            // Only optimize originals; do not generate alternates here
            new ImageMinimizerPlugin({
                test: /\.(jpe?g|png)$/i,
                exclude: /[\\/]resources[\\/]icons[\\/]/,
                minimizer: {
                    implementation: ImageMinimizerPlugin.sharpMinify,
                    options: {
                        encodeOptions: {
                            jpeg: { quality: 75 },
                            png: { quality: 75 },
                        },
                    },
                },
            }),
        ],
    },
    // Add the module block
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules,
            {
                test: /\.(woff2?|ttf|otf|eot)$/i,
                type: "asset/resource",
                generator: {
                    filename: "fonts/[name][ext]",
                },
            },
            {
                test: /\.(jpe?g|png|gif|svg|avif|webp)$/i,
                type: "asset/resource",
                generator: {
                    filename: "images/[name][ext]",
                },
            },
        ],
    },
};

// Silence Sass deprecation warnings coming from third-party dependencies (e.g., Font Awesome)
const sassRule = config.module.rules.find((rule) => Array.isArray(rule.use) && rule.use.some((loader) => loader.loader && loader.loader.includes("sass-loader")));
if (sassRule) {
    const sassLoader = sassRule.use.find((loader) => loader.loader && loader.loader.includes("sass-loader"));
    sassLoader.options = {
        ...(sassLoader.options || {}),
        sassOptions: {
            ...(sassLoader.options?.sassOptions || {}),
            quietDeps: true,
        },
    };
}

config.plugins.push(
    new CopyWebpackPlugin({
        patterns: [
            // Copy originals (all files) from resources/images
            {
                from: path.resolve(__dirname, "resources/images"),
                to: "images/[path][name][ext]",
                context: path.resolve(__dirname, "resources/images"),
                noErrorOnMissing: true,
            },
            // Copy icons (favicons/app icons) from resources/icons to images root as originals only
            {
                from: path.resolve(__dirname, "resources/icons"),
                to: "images/[name][ext]",
                context: path.resolve(__dirname, "resources/icons"),
                noErrorOnMissing: true,
            },
        ],
    })
);

module.exports = config;
