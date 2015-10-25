#!/bin/bash

sudo apt-get update -y
sudo apt-get install -y apache2 git

mv ./itmo-544-444-mp1/images /var/www/html/images
mv ./itmo-544-444-mp1/index.html /var/www/html


echo "hello!" >/tmp/hello.txt
