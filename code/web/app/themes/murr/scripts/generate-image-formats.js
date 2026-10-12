#!/usr/bin/env node

/**
 * Generate WebP and AVIF copies for every JPG/PNG image in resources/images.
 * These files are created alongside the originals so they can be referenced
 * directly via @images/... inside the theme.
 */

const fs = require("fs/promises");
const path = require("path");
const sharp = require("sharp");

const ROOT = path.join(__dirname, "..", "resources", "images");
const SOURCE_EXTENSIONS = new Set([".jpg", ".jpeg", ".png"]);
const TARGET_EXTENSIONS = [
    { ext: ".webp", transform: (image) => image.webp({ quality: 75 }) },
    { ext: ".avif", transform: (image) => image.avif({ quality: 50 }) },
];

async function pathExists(filePath) {
    try {
        await fs.access(filePath);
        return true;
    } catch {
        return false;
    }
}

async function ensureFormats(filePath) {
    const ext = path.extname(filePath).toLowerCase();
    if (!SOURCE_EXTENSIONS.has(ext)) {
        return;
    }

    for (const { ext: targetExt, transform } of TARGET_EXTENSIONS) {
        const targetPath = path.format({
            dir: path.dirname(filePath),
            name: path.parse(filePath).name,
            ext: targetExt,
        });

        if (await pathExists(targetPath)) {
            continue;
        }

        const image = sharp(filePath);
        await transform(image).toFile(targetPath);
    }
}

async function traverse(directory) {
    const entries = await fs.readdir(directory, { withFileTypes: true });

    await Promise.all(
        entries.map(async (entry) => {
            const entryPath = path.join(directory, entry.name);
            if (entry.isDirectory()) {
                await traverse(entryPath);
                return;
            }
            await ensureFormats(entryPath);
        })
    );
}

async function main() {
    try {
        await traverse(ROOT);
        // eslint-disable-next-line no-console
        console.log("Generated WebP/AVIF variants in resources/images");
    } catch (error) {
        console.error("Failed to generate image formats:", error);
        process.exitCode = 1;
    }
}

void main();
