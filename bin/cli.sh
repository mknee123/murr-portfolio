#!/bin/bash

# OSX Utility script - Runs a Docker CLI service
# Usage: ./bin/cli.sh <service> ...
# Example: ./bin/cli.sh node npm run watch
# Example: ./bin/cli.sh node npm run build

if [ "$1" = "node" ] && [ "$2" = "npm" ] && [ "$3" = "run" ] && [ "$4" = "watch" ]; then
  docker compose -f cli.yml run --rm --service-ports "$@"
else
  docker compose -f cli.yml run --rm "$@"
fi
