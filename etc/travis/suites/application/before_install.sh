#!/usr/bin/env bash

source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/../../../bash/common.lib.sh"
source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/../../../bash/application.sh"

print_header "Activating memcached extension" "Travelsheets"
run_command "echo \"extension = memcached.so\" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini" || exit $?

#print_header "Installing chromium" "Travelsheets"
#run_command "sudo apt-get install -y chromium-browser"

#print_header "Installing elasticsearch" "Travelsheets"
#run_command "curl -O https://download.elastic.co/elasticsearch/elasticsearch/elasticsearch-1.7.3.deb && sudo dpkg -i --force-confnew elasticsearch-1.7.3.deb && sudo service elasticsearch restart"
#run_command "sleep 10"

#print_header "Installing Yarn" "Travelsheets"

# Install Node Version Manager to install newer node version
#run_command "rm -rf ~/.nvm && git clone https://github.com/creationix/nvm.git ~/.nvm && (cd ~/.nvm && git checkout \`git describe --abbrev=0 --tags\`) && source ~/.nvm/nvm.sh && nvm install $TRAVIS_NODE_VERSION" || exit $?

# Install Yarn globally
#run_command "sudo apt-key adv --fetch-keys http://dl.yarnpkg.com/debian/pubkey.gpg"
#run_command "echo \"deb http://dl.yarnpkg.com/debian/ stable main\" | sudo tee /etc/apt/sources.list.d/yarn.list"
#run_command "sudo apt-get update -qq"
#run_command "sudo apt-get install -y -qq yarn=0.21.3-1"