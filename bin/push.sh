#!/bin/bash

# OSX Utility script - Runs a Docker CLI service
# Usage: ./bin/push.sh <service> ...
# Example: ./bin/push.sh wordmove push -e staging -d
# Example: ./bin/push.sh wordmove push -e staging -u
# Example: ./bin/push.sh wordmove push -e staging -du

docker compose -f cli.yml run --rm $@
