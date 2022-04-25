#!/bin/bash

echo "------------------ Permissions folder ---------------------"
bash -c 'chmod -R 777 /var/www/html/files'

bash -c 'chmod -R 777 /var/www/html/files_zip'

echo "------------------ Starting apache server ------------------"
exec "apache2-foreground"