
# Configuration
CFG_HOSTNAME="example.com"



# Install dependencies
echo "Installing dependencies:"

echo "| Updating Packages"
apt update -y

echo "| Apache2"
apt install -y apache2

echo "| Git"
apt install -y git



# Clone repositories
echo "Cloning repositories:"
mkdir -p /var/www/moodclap >> /dev/null 2>&1

echo "| TASSIA710/Moodclap"
cd /var/www/moodclap >> /var/www/moodclap/install_log.txt 2>&1
git clone git@github.com:TASSIA710/Moodclap.git >> /var/www/moodclap/install_log.txt 2>&1

echo "| TASSIA710/Moodclap-Auth"
cd /var/www/moodclap >> /var/www/moodclap/install_log.txt 2>&1
git clone git@github.com:TASSIA710/Moodclap-Auth.git >> /var/www/moodclap/install_log.txt 2>&1



# Create Apache2 sites
echo "Creating Apache2 sites:"

echo "| moodclap-auth.conf"
cd /etc/apache2/sites-available/ >> /var/www/moodclap/install_log.txt 2>&1
printf "" > moodclap-auth.conf
printf "<VirtualHost *:80>\n" >> moodclap-auth.conf
printf "\tServerName auth.$CFG_HOSTNAME\n" >> moodclap-auth.conf
printf "\tDocumentRoot /var/www/moodclap/Moodclap-Auth/public\n" >> moodclap-auth.conf
printf "\tErrorLog \${APACHE_LOG_DIR}/error.log\n" >> moodclap-auth.conf
printf "\tCustomLog \${APACHE_LOG_DIR}/access.log combined\n" >> moodclap-auth.conf
printf "</VirtualHost>" >> moodclap-auth.conf



# Finish
echo "Finishing..."

echo "| Enabling Apache2 sites..."
a2ensite moodclap-auth >> /var/www/moodclap/install_log.txt 2>&1

echo "| Restarting Apache2..."
systemctl restart apache2 >> /var/www/moodclap/install_log.txt 2>&1

echo "Finished! Please edit the following configuration files:"
echo "| /var/www/moodclap/Moodclap/Configuration.php"
echo "| /var/www/moodclap/Moodclap-Auth/Configuration.php"
