sudo chown -R www-data: storage/
sudo chmod -R 755 storage/
sudo chmod -R 777 storage/framework/
find . -name "*.log" -exec chmod 666 {} \;
