FROM php:7.4-apache

# 필수 시스템 패키지 및 PHP 확장모듈 설치 (gd, mysqli, zip 등 그누보드/영카트 호환용)
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli zip

# 아파치 mod_rewrite 활성화 (짧은 주소 사용시 필요)
RUN a2enmod rewrite

# php.ini 설정 구성을 개발환경에 맞게 수정 (업로드 용량 확대 및 short_open_tag 활성화)
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
    sed -i 's/short_open_tag = Off/short_open_tag = On/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/post_max_size = 8M/post_max_size = 50M/' "$PHP_INI_DIR/php.ini"

# 도큐먼트 루트를 안전하게 설정
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
