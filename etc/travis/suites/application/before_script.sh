#!/usr/bin/env bash

source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/../../../bash/common.lib.sh"
source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/../../../bash/application.sh"

print_header "Configuring parameters" "TravelSheets"
run_command "sed -i 's/database_host.*/database_host: 127.0.0.1/' app/config/parameters.yml"
run_command "sed -i 's/database_user.*/database_user: root/' app/config/parameters.yml"
run_command "sed -i 's/database_password.*/database_password: null/' app/config/parameters.yml"

print_header "Setting the application up" "TravelSheets"
run_command "bin/console doctrine:database:create --env=test -vvv" || exit $? # Have to be run with debug = true, to omit generating proxies before setting up the database
run_command "bin/console cache:warmup --env=test --no-debug -vvv" || exit $?
run_command "bin/console doctrine:migrations:migrate --no-interaction --env=test --no-debug -vvv" || exit $?
