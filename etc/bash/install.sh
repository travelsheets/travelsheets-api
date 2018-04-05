#!/usr/bin/env bash

source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/common.lib.sh"

# Install Composer dependencies
print_header "Installing dependencies" "Travelsheets"
run_command "composer install --prefer-dist" || exit $?

# Install Application
run_command "bin/console cache:warmup --env=dev --no-debug -vvv" || exit $?

# Install Lexik JWT Authentication
print_header "Installing JWT" "Travelsheets"
if [ ! -f ./var/jwt/private.pem ]; then
    run_command "mkdir -p var/jwt" || exit $?
    run_command "openssl genrsa -out var/jwt/private.pem -aes256 4096" || exit $?
    run_command "openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem" || exit $?
else
    echo "JWT already installed"
fi

# Initialize Database
print_header "Initialize database" "Travelsheets"
run_command "bin/console doctrine:database:create --if-not-exists --env=dev -vvv" || exit $? # Have to be run with debug = true, to omit generating proxies before setting up the database
run_command "bin/console doctrine:migrations:migrate --env=dev --no-debug -vvv" || exit $?

# Load Fixtures
print_header "Load Fixtures" "Travelsheets"
retry_run_command "bin/console sy:fi:lo --env=dev --no-debug -vvv --no-interaction"