FROM php:8.4-fpm

# ARG untuk UID/GID agar bisa disesuaikan dari docker-compose
ARG UID=1000
ARG GID=1000

# Buat user & group 'admin'
RUN groupadd -g ${GID} admin && \
    useradd -u ${UID} -g admin -m -s /bin/bash admin

# Salin konfigurasi PHP
COPY php.ini /usr/local/etc/php/
COPY docker.conf /usr/local/etc/php-fpm.d/docker.conf
COPY .bashrc /root/

# Install dependency OS + ekstensi PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    zlib1g-dev \
    default-mysql-client \
    curl \
    gnupg \
    procps \
    vim \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    ca-certificates \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd zip pdo_mysql intl \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install ekstensi Redis & PCOV
# RUN pecl install redis pcov \
#  && docker-php-ext-enable redis pcov

# (Opsional) Xdebug - uncomment jika perlu
# RUN pecl install xdebug \
#  && docker-php-ext-enable xdebug \
#  && echo ";zend_extension=xdebug" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Node.js LTS (v20.x) + NPM + Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get update && apt-get install -y nodejs \
 && npm install -g npm@latest yarn \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
 && rm composer-setup.php

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH=$PATH:/composer/vendor/bin

RUN composer config --global process-timeout 3600 \
 && composer global require "laravel/installer"

# (Opsional) Tambahan personalisasi
WORKDIR /root
RUN git clone https://github.com/seebi/dircolors-solarized

# Ubah workdir dan set user ke 'admin'
WORKDIR /var/www
USER admin

EXPOSE 5173
