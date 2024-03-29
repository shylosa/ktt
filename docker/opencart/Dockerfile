#
# Dockerfile for opencart
#

FROM php:7-apache
MAINTAINER aaron <info@aamservices.uk>

RUN a2enmod rewrite headers

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip libzip-dev

RUN set -xe \
    && apt-get update \
    && apt-get install -y libpng-dev libjpeg-dev libmcrypt-dev unzip \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && docker-php-ext-install gd mbstring mysqli pdo_mysql zip \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-enable mcrypt

WORKDIR /var/www/html

ENV OPENCART_VER 3.0.3.2
ENV OPENCART_MD5 e276fc527755e2cc10bbbd698d8cd0eb
ENV OPENCART_URL https://github.com/opencart/opencart/releases/download/${OPENCART_VER}/opencart-${OPENCART_VER}.zip
ENV OPENCART_FILE opencart.zip

RUN set -xe \
    && curl -sSL ${OPENCART_URL} -o ${OPENCART_FILE} \
    && echo "${OPENCART_MD5}  ${OPENCART_FILE}" | md5sum -c \
    && unzip ${OPENCART_FILE} 'upload/*' -d /var/www/html/ \
    && mv /var/www/html/upload/* /var/www/html/ \
    && rm -r /var/www/html/upload/ \
    && mv config-dist.php config.php \
    && mv admin/config-dist.php admin/config.php \
    && rm ${OPENCART_FILE} \
	&& sed -i 's/MYSQL40//g' install/model/install/install.php \
    && chown -R www-data:www-data /var/www \
    && usermod -u 1000 www-data && groupmod -g 1000 www-data