#!/bin/bash
export XDEBUG_CONFIG="remote_enable=1"
export XDEBUG_CONFIG="idekey=xdebug"
echo "a"
php "$@"
echo "b"

