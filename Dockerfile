FROM thecodingmachine/php:8.0.1-v4-apache-node14

ENV PANTHER_NO_SANDBOX 1

RUN sudo apt-get update && sudo apt-get install -y libzip-dev zlib1g-dev unzip wget

RUN sudo wget "https://dl.google.com/linux/chrome/deb/pool/main/g/google-chrome-stable/google-chrome-stable_85.0.4183.121-1_amd64.deb" -O /tmp/chrome.deb

RUN sudo apt-get install -y --allow-downgrades /tmp/chrome.deb
