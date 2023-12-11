#!/bin/bash

# OSX Utility script - Runs a Docker CLI service
# Usage: ./bin/pull.sh <service> ...
# Example: ./bin/pull.sh wordmove pull -e staging -d
# Example: ./bin/pull.sh wordmove pull -e staging -u
# Example: ./bin/pull.sh wordmove pull -e staging -du

docker compose -f cli.yml run --rm $@
