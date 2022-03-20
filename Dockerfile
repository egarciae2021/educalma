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
    
RUN apt-get update
RUN apt-get upgrade -qqy
RUN php -v
RUN apt-get install -qy libpng-dev
RUN docker-php-ext-install gd

RUN find /etc/apache2/sites-available -type d -exec chmod 0777 {} \;
RUN find /etc/apache2/sites-enabled -type d -exec chmod 0777 {} \;
RUN a2enmod rewrite
RUN a2enmod headers
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./web /var/www/html
