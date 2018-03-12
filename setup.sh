#!/usr/bin/env bash

## Setup - required linux packages ##
sudo add-apt-repository ppa:ondrej/php
sudo apt-get -y update
sudo apt-get install -y php7.0 php7.0-common php7.0-gd php7.0-mysql php7.0-mcrypt php7.0-curl php7.0-intl php7.0-xsl php7.0-mbstring php7.0-zip php7.0-bcmath php7.0-iconv
sudo apt-get install -y curl pinta
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

## Install Codeception ##
composer require codeception/codeception --dev
