# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.network "private_network", ip: "192.168.33.10"
  config.vm.synced_folder "./", "/var/www/html"
  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    apt-get upgrade

    echo -e"\n --installing apache2-- \n"

    apt-get install -y apache2
    echo "ServerName localhost" >> /etc/apache2/apache2.conf
    service apache2 restart

    echo -e"\n --installing php7.1-- \n"

    apt-add-repository ppa:ondrej/php
    apt-get update
    apt-get install -y php7.1

    echo -e"\n --installing mysql-server-- \n"

    debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
    debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
    apt-get install -y mysql-server php7.1-mysql
    service mysql restart

  SHELL
end
