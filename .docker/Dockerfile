FROM composer:1.6
FROM php:7.2-fpm-alpine3.8

RUN apk add --no-cache \
		git

ENV APCU_VERSION 5.1.11
ENV XDEBUG_VERSION 2.6.0
ENV YAML_VERSION 2.0.2

RUN set -xe \
	&& apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		postgresql-dev \
		mysql-dev \
		zlib-dev \
		libzip-dev \
		yaml-dev \
	&& docker-php-ext-install \
		intl \
		pdo_pgsql \
		pdo_mysql \
		zip \
	&& pecl install \
		apcu-${APCU_VERSION} \
		xdebug-${XDEBUG_VERSION} \
	    yaml-${YAML-VERSION} \
	&& docker-php-ext-enable --ini-name 20-apcu.ini apcu \
	&& docker-php-ext-enable --ini-name 05-opcache.ini opcache \
	&& docker-php-ext-enable --ini-name xdebug.ini xdebug \
	&& runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)" \
	&& apk add --no-cache --virtual .php-phpexts-rundeps $runDeps \
	&& apk del .build-deps \
    && { \
       echo "xdebug.remote_enable=On"; \
       echo "xdebug.remote_autostart=Off"; \
    }  >> /usr/local/etc/php/conf.d/xdebug.ini

COPY --from=0 /usr/bin/composer /usr/bin/composer
COPY .docker/php/php.ini /usr/local/etc/php/php.ini
COPY .docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint


WORKDIR /srv/symfony
ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

COPY . ./

RUN mkdir -p var/cache var/logs var/sessions \
	&& composer dump-autoload --classmap-authoritative --no-dev \
&& chown -R www-data var
