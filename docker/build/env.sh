#!/usr/bin/env bash

set -e

TEMPLATE_FILE=/app/.env.example
TEMPLATE_OUTPUT_FILE=/app/.env

touch ${TEMPLATE_OUTPUT_FILE}

printf "Generating .env.\n"

cp ${TEMPLATE_FILE} ${TEMPLATE_OUTPUT_FILE}
