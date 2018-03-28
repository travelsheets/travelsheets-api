#!/usr/bin/env bash

source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/../../../bash/common.lib.sh"

print_header "Installing dependencies" "Travelsheets"
run_command "composer install --no-interaction --prefer-dist" || exit $?

#print_header "Warming up dependencies" "Travelsheets"
#run_command "yarn install" || exit $?
