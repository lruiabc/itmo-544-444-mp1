#!/bin/bash

sudo apt-get update -y
sudo apt-get install -y apache2 git php5 mysql-client

git clone https://github.com/lruiabc/itmo-544-444-mp1.git

mv ./../itmo-544-444-mp1/images /var/www/html/images
mv ./../itmo-544-444-mp1/index.html /var/www/html
mv ./../itmo-544-444-mp1/*.php /var/www/html

curl -s5 http://getcomposer.org/installer | php

php composer.phar require aws/aws-sdk-php

mv vendor /var/www/html


echo "hello!" >/tmp/hello.txt

