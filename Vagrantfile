# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.network "private_network", ip: "192.168.33.10"
  config.vm.synced_folder "./", "/var/www/html"
  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    apt-get upgrade
    apt-add-repository ppa:ondrej/php
    apt-get update

    echo -e"\n --setup permissions for node-- \n"
    vagrant_user="vagrant"
    bin="/usr/bin"
    node_modules="/usr/lib/node_modules"

    mkdir -p "$bin"
    mkdir -p "$node_modules"
    chown "$vagrant_user" "$bin"
    chown -R "$vagrant_user" "$node_modules"

    echo -e"\n --installing apache2-- \n"

    apt-get install -y apache2
    echo "ServerName localhost" >> /etc/apache2/apache2.conf
    service apache2 restart

    echo -e"\n --installing php7.1-- \n"

    apt-get install -y php7.1

    echo -e"\n --installing mysql-server-- \n"

    debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
    debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
    apt-get install -y mysql-server php7.1-mysql
    

    echo -e"\n --setting up database-- \n"

    mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS webstore;";
    mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root';"
    mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'root';"
    
    service mysql restart
    mysql -uroot -proot webstore < /var/www/html/webstore.sql

    echo -e"\n --installing node & npm & jquery-- \n"
    do-release-upgrade
    apt-get install -y build-essential g++ curl 
    curl -sL https://deb.nodesource.com/setup_12.x | bash -
    apt-get install -y nodejs
    npm i -g npm@latest
    npm install jquery
    node -v && npm -v

  SHELL
end
