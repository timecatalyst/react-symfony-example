#!/usr/bin/env bash

SCRIPT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd -P )
cd "$SCRIPT_DIR"

openssl req -x509 -days 730 -new -newkey rsa:2048 -keyout localhost.key -nodes -config openssl.config -sha256 -out localhost.crt
