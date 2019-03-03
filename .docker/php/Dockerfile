FROM php:7.2-fpm-alpine3.9

LABEL maintainer="Roman Movchan <movchan@gmail.com>"

WORKDIR /app

RUN apk update && apk upgrade \
    &&  apk add --update \
    php7-fpm \
    php7-apcu \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-gd \
    php7-iconv \
    php7-imagick \
    php7-json \
    php7-intl \
    php7-mcrypt \
    php7-fileinfo \
    php7-opcache \
    php7-openssl \
    php7-xml \
    php7-phar \
    php7-tokenizer \
    php7-session \
    php7-simplexml \
    php7-xdebug \
    php7-pear \
    postgresql-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    bzip2 \
    bzip2-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    zip \
    git \
    bash \
    autoconf \
    build-base \
    make \
    curl \
    nodejs \
    yarn

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/* && \
    curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

RUN docker-php-ext-install gd bcmath zip bz2 pdo pdo_pgsql simplexml opcache sockets mbstring pcntl xsl  
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-configure zip --with-libzip


#ADD php.ini /etc/php7/conf.d/
#ADD php.ini /etc/php7/cli/conf.d/
#ADD php-fpm.conf /etc/php7/php-fpm.d/
#ADD xdebug.ini  /etc/php7/conf.d/

# Install and enable xdebug
RUN pecl install xdebug
RUN wget http://xdebug.org/files/xdebug-2.6.1.tgz
RUN tar -xvzf xdebug-2.6.1.tgz
RUN cd xdebug-2.6.1 \
    && phpize \
    && ./configure --enable-xdebug \
    && make \
    && make install \
    && cp modules/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20170718 \
    && echo 'zend_extension = /usr/local/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so' >> /usr/local/etc/php/php.ini \
    && echo 'zend_extension = /usr/local/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so' >> /etc/php7/php.ini \
    && echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_autostart=1' >>/usr/local/etc/php/php.ini \
    && echo 'xdebug.coverage_enable=1' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.idekey=PHPSTORM' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_port=9002' >> /usr/local/etc/php/php.ini  

RUN adduser -D -g 'www' www \
    && chown -R www:www /app

EXPOSE 22