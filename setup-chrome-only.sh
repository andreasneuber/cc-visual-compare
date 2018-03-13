#!/usr/bin/env bash

sudo apt-get install -y unzip libxi6 libgconf-2-4

# Remove existing downloads and binaries so we can start from scratch.
sudo apt-get remove google-chrome-stable

# Install fresh Chrome.
sudo curl -sS -o - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add
sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'
sudo apt-get -y update
sudo apt-get -y install google-chrome-stable