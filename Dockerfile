FROM php:7.4.24-apache
RUN docker-php-ext-install mysqli
RUN apt-get update && docker-php-ext-install pdo pdo_mysql
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    software-properties-common \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    libfreetype6-dev \
    libicu-dev \
    libssl-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libedit-dev \
    libedit2 \
    libpq-dev \
    libxslt1-dev \
    libzip-dev \
    apt-utils \
    gnupg \
    git \
    vim \
    wget \
    curl \
    lynx \
    psmisc \
    unzip \
    tar \
    cron \
    nano \
    bash-completion \
    && apt-get clean
    #Install Dependencies
RUN chgrp -R www-data /var/www \
    && chmod -R g+w /var/www \
    && find /var/www -type d -exec chmod 0777 {} \; \
    && find /var/www -type f -exec chmod ug+rw {} \; \
    && usermod -a -G www-data root
RUN 
# Envase
 #ECHO "DEB http://mirrors.163.com/debian/ stretch principal contributs no libre \ ndeb http://mirrors.163.com/debian/ actualiza el control principal de control no libre \ ndeb http: // Espejos.163.es
 APT Actualización # Actualizar fuente fuente
 APT install -y libwebp-dev libjpeg-dev libpng-dev libfreetype6-dev # instale varias bibliotecas
 Extracto de fuente de fuente Docker-PHP # fuente de descompresión
 Carpeta de código fuente de CD / USR / SRC / PHP / EXT / GD #GD
 Docker-PHP-EXT-CONFIGURACIÓN GD --WITH-WEBP-DIR = / USR / INCLUSION / WEBP --WITH-JPEG-DIR = / USR / INCLUSIÓN - DIVERSIÓN-PNG-DIR = / USR / INCLUIDO - con- Freetype-dir = / usr / include / freetype2 # preparar la compilación
 Instalación de la compilación de Docker-PHP-EXT-EXTT INSTRULT GD #
php -m | grep gd
 #  
RUN find /etc/apache2/sites-available -type d -exec chmod 0777 {} \;
RUN find /etc/apache2/sites-enabled -type d -exec chmod 0777 {} \;
RUN a2enmod rewrite
RUN a2enmod headers
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./web /var/www/html
