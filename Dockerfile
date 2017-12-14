FROM ubuntu:16.04

RUN apt-get -y update && apt-get install -y \
apache2 \
php7.0 \
libapache2-mod-php7.0 \
php7.0-gd \
php7.0-json \
php7.0-sqlite \
php7.0-mysql \
php7.0-mcrypt \
php7.0-xml \
php7.0-zip \
mcrypt \
curl \
php-curl \
git-all \
zip \
unzip \
wget

# on veut une machine de dev qui affiche toutes les erreurs PHP
RUN sed -i -e 's/^error_reporting\s*=.*/error_reporting = E_ALL/' /etc/php/7.0/apache2/php.ini
RUN sed -i -e 's/^display_errors\s*=.*/display_errors = On/' /etc/php/7.0/apache2/php.ini

# commandes à exécuter au démarrage de l'instance de l'image
# ici on démarrera Apache
CMD ["/usr/sbin/apache2ctl","-DFOREGROUND"]

RUN wget http://pear.php.net/go-pear.phar \
    php go-pear.phar

RUN curl -sS https://getcomposer.org/installer | \
	php -- --install-dir=/usr/bin/ --filename=composer