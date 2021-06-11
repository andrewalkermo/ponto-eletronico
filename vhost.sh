#!/bin/bash
project_directory=`printf '%s\n' "${PWD##*/}"`
project_directory_full_path=`pwd`
project_public_directory_path="$project_directory_full_path"
vhost="local.$project_directory"
vhost_file="$vhost.conf"

echo "<VirtualHost *:80>
    ServerAdmin admin@$project_directory
    ServerName $vhost
    DocumentRoot "$project_public_directory_path"
    <Directory "$project_public_directory_path">
        RewriteEngine on
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        RewriteRule ^index.php/ - [L,R=404]
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>" > $vhost_file


sudo cp -f $vhost_file /etc/apache2/sites-available/;
sudo a2dissite $vhost_file;
sudo a2ensite $vhost_file;
sudo sed -i '/'$vhost'/d' /etc/hosts;
sudo sh -c 'echo "127.0.0.1    '$vhost'" >> /etc/hosts';
sudo service apache2 reload;
rm -f $vhost_file
echo "vhost foi configurado";
echo "acesse: http://$vhost";
