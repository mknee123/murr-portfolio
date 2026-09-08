# Miranda Portfolio - mirandaknee.com

Personal portfolio and resume site for Miranda Knee, built on WordPress (Bedrock) and Docker.

## Table of Contents

- [Requirements](#requirements)
- [Setup](#setup)
- [Usage](#usage)
- [Theme](#theme)
- [Credits](#credits)

## Requirements

| Prerequisite        | How to check          | How to install                                   |
| ------------------- | --------------------- | ------------------------------------------------ |
| PHP >= 8.1.x        | `php -v`              | [php.net](https://php.net/manual/en/install.php) |
| Node.js >= 18.0.0   | `node -v`             | [nodejs.org](https://nodejs.org/)                |
| Composer >= 2.5.2   | `composer --version`  | [getcomposer.org](https://getcomposer.org/)      |
| Webpack 5           | `webpack version`     | `npm install --save-dev webpack`                 |
| Webpack-CLI         | `webpack-cli version` | `npm install --save-dev webpack-cli`             |
| Yarn\*\* >= 1.22.19 | `yarn --version`      | `npm install --global yarn`                      |

\*\* Optional to use yarn in place of npm

## Setup

- The first step is to make a copy of the .env.example and rename it .env. Update the variables with the appropriate values. Private Composer credentials are required for some dependencies.

- CD into the root directory and run the following command to get started.

```bash
./bin/setup.sh
```

- Once the terminal is calm, navigate to murr.docker.localhost in your browser. If you get a 502 Bad Gateway, you just need to wait for all of the images to spin up. This usually takes just a few minutes.

## Usage

The Docker Watch command should start automatically when the `up.sh` command is run or when your Docker environment spins up on start.

```bash
./bin/up.sh
```

Check to see what images are running:

```bash
docker ps -a
```

You should see:

```bash
murr-website-traefik-1
murr-website-nginx-1
murr-website-php-1
murr-website-mysql-1
```

To see your live/hot refresh front end, visit: [http://murr.docker.localhost:3000/](http://murr.docker.localhost:3000/)

- To stop or spin down the site, run the down script.

```bash
./bin/down.sh
```

### Local HTTPS (mkcert)

This project can run locally over HTTPS without editing `/etc/hosts` by using the `*.docker.localhost` domain and mkcert.

1. Install mkcert and trust the local CA:

```bash
brew install mkcert nss
mkcert -install
```

2. Generate a cert for the local domain:

```bash
mkdir -p docker/traefik/certs
mkcert -key-file docker/traefik/certs/murr.docker.localhost-key.pem \
       -cert-file docker/traefik/certs/murr.docker.localhost.pem \
       murr.docker.localhost localhost 127.0.0.1 ::1
```

3. Ensure your `.env` has:

```bash
NGINX_SERVER_NAME=murr.docker.localhost
```

4. Start the stack:

```bash
docker compose -f compose.yml up -d --build
```

### Available commands

- `./bin/cli.sh composer install` — Install theme related plugins
- `./bin/cli.sh composer update` — Update plugins
- `./bin/cli.sh node npm install` — Install theme dependencies
- `./bin/cli.sh node npm run watch` — Compile and optimize the files in your assets directory as well as start watching for changes
- `./bin/cli.sh node npm run build` — Compile assets for production (no source maps) and without watching
- `./bin/cli.sh wordmove pull -e staging --all` — Pull everything from the staging site via wordmove

## Theme

The `theme.json` file is essential. It works closely with the `custom-properties` stylesheet in the `resources/styles/global` directory. To avoid updating values within the `theme.json` file, update the site's branded color palette in the `custom-properties` stylesheet.

## Credits

This theme was created by Miranda K.
