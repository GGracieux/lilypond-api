# Source image
FROM 1and1internet/ubuntu-16-apache-php-7.0

# Lilypond installation
RUN apt-get update && apt-get install -y lilypond

# Maintainer info
MAINTAINER ggracieux@gmail.com

# Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN chmod 777 /etc/apache2/sites-available/000-default.conf

# Adds API source files
COPY lib /var/www/lib
COPY public /var/www/public
COPY vendor /var/www/vendor
RUN chown -R www-data /var/www
RUN chmod -R 777 /var/www

# Env variables for the ubuntu-16-apache-php-7.0 image
ENV DOCUMENT_ROOT public
ENV UID 33

# API's PHP env variables
RUN echo "<?php define('LILYPOND_VERSION',\"$(lilypond -v | sed -n 1p)\"); ?>" >> /var/www/lib/const.php
RUN chmod 777 /var/www/lib/const.php