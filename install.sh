#!/bin/bash

#args=("$@")

#echo $(args[0]);

passwd pi << EOF
raspberry
Aquatech123
Aquatech123
EOF

sudo bash -c "printf 'country=FR\n' >> /etc/wpa_supplicant/wpa_supplicant.conf"

sudo bash -c "wpa_passphrase \"BTS_SN\" \"FafaLoloDidiJaja09123166\" >> /etc/wpa_supplicant/wpa_supplicant.conf"

wpa_cli -i wlan0 reconfigure

sudo bash -c " printf \"fr_FR ISO-8859-1\nfr_FR.UTF-8 UTF-8 \" >> /etc/locale.gen "

service networking restart << EOF
Aquatech123
EOF

sudo printf "interface wlan0\nstatic ip_address=192.168.2.195/24\nstatic routers=192.168.2.1\nstatic domain_name_servers=8.8.8.8 8.8.4.4" >> /etc/dhcpcd.conf

service networking restart << EOF
Aquatech123
EOF

sudo apt-get upgrade
sudo apt-get update

sudo apt-get install apache2 php libapache2-mod-php mariadb-server php-mysql libboost-all-dev libcurl4-openssl-dev libmysqlcppconn-dev rapidjson-dev wiringpi git-core python3-pip

pip3 install requests beautifulsoup4 mysql-connector-python

sudo mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'aquatech'@'localhost' IDENTIFIED BY 'Aquatech123';"


g++ -o /home/pi/aquatech/main-server/thread /home/pi/aquatech/main-server/*.cpp -lboost_system -lboost_thread -lboost_chrono -lpthread -lwiringPi -lmysqlcppconn -lcurl

mysql -u root -pAquatech123 aquatech < /home/pi/aquatech/bdd_dump.sql

sudo rm -r /var/www/html/*

sudo cp -r /home/pi/aquatech/web/* /var/www/html

sudo chmod 777 /home/pi/aquatech/web/evapotranspiration.csv
sudo chmod 777 /home/pi/aquatech/web/pluviometrie.csv
sudo chmod 777 /home/pi/aquatech/web/settings.json

crontab -l > mycron
sudo printf '0 20 * * * sudo bash -c "cd /home/pi/aquatech/main-server/ && ./thread"\n0 12 * * * /usr/bin/env python3 /home/pi/aquatech/meteo/test.py\n' > mycron
crontab mycron
rm -r mycron
