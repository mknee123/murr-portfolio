# GH Advertising WP Base Theme 2.0

The official GH Advertising WordPress Base Theme 2.0. It is powered by npm/yarn and webpack. The GH WordPress Base Theme 2.0 is a cookie-cutter theme with pre-developed blocks, partials, and templates commonly used in GH websites. The theme uses a theme.json file to easily apply custom colors, fonts, and layouts that align with the client’s branding. Compatible with the GH WP Docker Stack.

## Table of Contents

-   [Requirements](#requirements)
-   [Setup](#setup)
-   [Usage](#usage)
-   [Theme](#theme)
-   [Features](#features)
-   [Credits](#credits)

## Requirements

| Prerequisite        | How to check          | How to install                                   |
| ------------------- | --------------------- | ------------------------------------------------ |
| PHP >= 8.1.x        | `php -v`              | [php.net](https://php.net/manual/en/install.php) |
| Node.js >= 20.4.0   | `node -v`             | [nodejs.org](https://nodejs.org/)                |
| Composer >= 2.5.2   | `composer --version`  | [getcomposer.org](https://getcomposer.org/)      |
| Webpack 5           | `webpack version`     | `npm install --save-dev webpack`                 |
| Webpack-CLI         | `webpack-cli version` | `npm install --save-dev webpack-cli`             |
| Yarn\*\* >= 1.22.19 | `yarn --version`      | `npm install --global yarn`                      |

\*\* Optional to use yarn in place of npm

## Setup

The first step is to make a copy of the .env.example and rename it .env. Update the variables with the appropriate values. The Pro keys can be found in 1PASS.

To obtain the Composer and Bitbucket keys, run the following command

```bash
cat ~/.composer/auth.json
```

Fire up the terminal, cd into the theme root, then run `npm install`. This may take a few minutes. Once the terminal is calm, install the composer dependencies with `composer install`.

```bash
npm install
```

```bash
composer install
```

## Usage

-   `composer install` — Install theme related plugins
-   `composer update` — Update plugins
-   `npm run watch` — Compile and optimize the files in your assets directory as well as watching for changes
-   `npm run build` — Compile assets for production (no source maps) and without watching

## Theme

The `theme.json` file is essential for the GH Base Theme 2.0. It works closely with the `custom-properties` stylesheet in the `resources/styles/global` directory. To avoid updating values within the `theme.json` file, update the client's branded color palette in the `custom-properties` stylesheet.

## Features

-   `.env` - Contains the theme’s environment variables, pro tokens, and license keys.
-   [acf-json/](https://www.advancedcustomfields.com/resources/local-json/) JSON file directory for all ACF field groups and settings.
-   `composer.json` - Contains PHP dependencies such as commonly used plugins.
-   `functions.php` This is where we can add unique features and functionality to the theme. In an attempt to keep this process organized and modular, we break out our features and functions into separate files kept within the `lib/` folder and then call upon those within the functions.php file.
-   `partials/` - This folder includes the source files for Atomic Partials and WordPress page templates.
-   `resources/` - This is where we house all of our source files such as blocks, fonts, images, scripts, and styles.
-   `package.json` - Contains all required node modules and dependencies. The scripts section utilizes npm-scripts to include the theme's Webpack commands.
-   [theme.json](https://developer.wordpress.org/themes/advanced-topics/theme-json/) configuration file theme styles and block settings. See theme section(^) for more details.
-   [webpack.config.js](https://webpack.js.org/) for bundling and use of modules.

### Structure

Here is a breakdown of the theme file/directory structure and a little bit about each.

```shell
gh-wp-base-theme/           # → Root of the theme
├──acf-json/		        # → ACF Field data saved here, separate from the WP Database
│
├──config/
│   └── entrypoints.js
│
├──lib/
│  	├── acf.php             # → ACF Theme Options and users with ACF privileges
│  	├── assets.php          # → Enqueues styles and scripts
│  	├── blocks.php          # → Creates shared category for all custom blocks and more
│  	├── helpers.php         # → Custom helper functions that abstract away more complex calls
│  	├── hooks.php
│  	├── shareLink.php       # → Social Share functionality for posts
│  	└── theme.php           # → WP and Custom hooks to manipulate default WP functionality
│
├──partials/                # → All custom theme templates should live here
│   ├── atoms/              # → Smallest unit of design.
│   ├── molecules/          # → Made up of atoms and include a purpose of function and could be reused.
│   └── organisms/          # → Made up of molecules and create a complex section of the website.
│   │
│   ├── footer.php
│   ├── head.php
│   └── header.php
│
├──public/				    # → Complied and compresses assets
│
├──resources/               # → Directory containing the source of all static assets
│   ├── blocks/             # → Custom block template files.
│   ├── fonts/              # → Theme fonts
│   ├── images/             # → Theme images
│   ├── meta/               # → Favicon, Open Graph Images, etc.
│   ├── scripts/            # → Theme JS
│   └── styles/             # → Theme SASS stylesheets
│
├── .env.example         	# → Example environment variable file
├── composer.json         	# → The composer dependencies, WP Asset Helper.
├── functions.php         	# → Loads all files from `lib/theme/` here
├── gh.png                  # → GH Logo for credits section of README
├── index.php             	# → Never manually edit
├── package.json          	# → Node.js dependencies and scripts
├── screenshot.png        	# → Theme screenshot for WP admin
├── style.css         		# → Theme details
├── theme.json        		# → Theme styles and block settings.
└── webpack.config.php      # → Webpack configuration file. No need to edit.
```

## Credits

[<img width="200" height="auto" src="gh.png" alt="GH Advertising">](https://ghadv.com/)

This theme was created by the developers at GH Advertising.

### Notes

Have any notes? Please suggest to add them here!
