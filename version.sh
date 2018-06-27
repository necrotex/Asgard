#!/bin/bash

ENV=./.env

# get the git hash value
#
CURRENT_GIT_HASH=$(git rev-parse --short HEAD)

# get the new version number from the command line
#
NEW_VERSION=$(git describe)


if [ -n "$NEW_VERSION" ]; then
    sed -ri "s/APP_VERSION=.+/APP_VERSION=$NEW_VERSION/" "$ENV"
    sed -ri "s/APP_HASH=[0-9a-f]+/APP_HASH=$CURRENT_GIT_HASH/" "$ENV"
fi