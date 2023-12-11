const path = require("path");
const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const customScripts = require("./config/entrypoints");
const isProduction = process.env.NODE_ENV === "production";

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
            "@videos": "@src/videos",
            "@scripts": "@src/scripts",
            "@styles": "@src/styles",
            "@meta": "@src/meta",
            ...defaultConfig.resolve.alias,
        },
    },
};

config.plugins.push(
    new CopyWebpackPlugin({
        patterns: [{ from: "resources/images/", to: "images/[name][ext]" }],
    })
);

if (!isProduction) {
    delete config.devServer;
    config.plugins.push(
        new BrowserSyncPlugin({
            host: "0.0.0.0",
            port: process.env.DEV_PORT || 3000,
            proxy: {
                target: process.env.DEV_URL || "http://basetheme.test",
            },
        })
    );
}

module.exports = config;
