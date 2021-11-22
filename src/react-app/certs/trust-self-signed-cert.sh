#!/usr/bin/env bash

SCRIPT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd -P )
cd "$SCRIPT_DIR"

sudo security add-trusted-cert -d -r trustRoot -k "/Library/Keychains/System.keychain" localhost.crt
if [ "$?" -eq "0" ]; then
  echo "Certificate Trusted"
else
  echo "Certificate Not Trusted"
  exit 2
fi
