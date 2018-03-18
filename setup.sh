#!/usr/bin/env bash

## Setup - required linux packages ##
sudo add-apt-repository ppa:ondrej/php
sudo apt-get -y update
sudo apt-get install -y curl pinta unzip libxi6 libgconf-2-4 imagemagick
sudo apt-get install -y php7.0 php7.0-common php7.0-gd php7.0-mysql php7.0-mcrypt php7.0-curl php7.0-intl php7.0-xsl php7.0-mbstring php7.0-zip php7.0-bcmath php7.0-iconv


curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer


# Remove existing downloads and binaries so we can start from scratch.
sudo apt-get remove google-chrome-stable

# Install fresh Chrome.
sudo curl -sS -o - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add
sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'
sudo apt-get -y update
sudo apt-get -y install google-chrome-stable