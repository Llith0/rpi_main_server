#!/bin/bash

sudo apt upgrade
sudo apt update
sudo apt install apache2 php libapache2-mod-php mariadb-server php-mysql libboost-all-dev libcurl4-openssl-dev libmysqlcppconn-dev wiringpi
sudo pip install requests
sudo pip install beautifulsoup4
sudo pip install mysql-connector-python

cd /home/pi/
mkdir aquatech

git clone https://github.com/Llith0/rpi_main_server.git > /home/pi/aquatech

cd aquatech

chmod +x meteo/test.py
chmod 777 web/evapotranspiration.csv
chmod 777 web/pluviometrie.csv
chmod 777 web/settings.json

crontab -l > mycron
echo "00 20 * * * /home/pi/aquatech/main_rpi/main-server/./thread" > mycron
echo "00 12 * * * python /home/pi/aquatech/main_rpi/meteo/test.py" > mycron
