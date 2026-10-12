#!/bin/bash

# OSX Utility script - Starts a local installation
# Usage: ./bin/up.sh [--build]

if [ "$1" = "--build" ]; then
  docker compose -f compose.yml up -d --build
else
  docker compose -f compose.yml up -d
fi
