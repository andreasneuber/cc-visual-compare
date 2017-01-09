#!/usr/bin/env bash

## Setup - required linux packages ##
sudo add-apt-repository ppa:ondrej/php
sudo apt-get -y update
sudo apt-get install -y php7.0 php7.0-common php7.0-gd php7.0-mysql php7.0-mcrypt php7.0-curl php7.0-intl php7.0-xsl php7.0-mbstring php7.0-zip php7.0-bcmath php7.0-iconv

sudo curl -LsS http://codeception.com/codecept.phar -o /usr/local/bin/codecept
sudo chmod a+x /usr/local/bin/codecept

sudo apt-get install -y imagemagick gnome-web-photo pinta


## Setup - Codeception tests ##
$ cd ~
$ mkdir difference
$ codecept bootstrap
$ codecept generate:cest acceptance CreateScreenshotsCept
$ codecept generate:cest acceptance CompareCept