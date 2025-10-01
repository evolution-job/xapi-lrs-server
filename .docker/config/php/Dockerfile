FROM amazonlinux:2023

LABEL maintainer="Mathieu BOLDO <mathieu.boldo@entrili.com>"

# ADD Cloud certificates (Proxy) & mkcert root CA
RUN update-ca-trust force-enable
COPY cloud-certificate.crt /etc/pki/ca-trust/source/anchors/cloud-certificate.crt
COPY rootCA.crt /etc/pki/ca-trust/source/anchors/rootCA.crt
RUN update-ca-trust extract

# Packages
RUN dnf -y upgrade
RUN dnf -y install \
    bash \
    gcc \
    git \
    htop \
    make \
    nano \
    openssh \
    tar \
    wget \
    zip

# User webapp
RUN groupadd -g 1000 webapp && \
    useradd -u 1000 -g webapp -m webapp -G webapp && \
    usermod -p "*" webapp && \
    su - webapp && \
    mkdir .ssh && \
    chmod 700 .ssh && \
    touch .ssh/authorized_keys && \
    chmod 600 .ssh/authorized_keys

# PHP 8.4
RUN dnf -y install php-{bcmath,cli,common,dba,dbg,devel,ffi,fpm,gd,intl,mbstring,mysqlnd,opcache,pdo,pgsql,posix,sodium,tidy,xml,zip}

RUN mkdir -p /run/php-fpm

# Composer
RUN curl -sS https://getcomposer.org/installer | php -d allow_url_fopen=On
RUN mv composer.phar /usr/local/bin/composer
RUN ln -s /usr/local/bin/composer /usr/bin/composer
RUN composer config --global cafile "/etc/pki/tls/certs/ca-bundle.crt"
RUN composer self-update

# Certs for Webapp
USER webapp
RUN composer config --global cafile "/etc/pki/tls/certs/ca-bundle.crt"
USER root

# SYMFONY
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.rpm.sh' | bash
RUN dnf -y install symfony-cli

# Composer
RUN curl \
    --silent \
    --fail \
    --location \
    --retry 3 \
    --output /tmp/installer.php \
    --url https://getcomposer.org/installer \
  | bash

RUN php -d allow_url_fopen=on \
    /tmp/installer.php \
    --no-ansi \
    --install-dir=/usr/bin \
    --filename=composer \
  ; \
  composer diagnose ; \
  rm -f /tmp/installer.php ;

WORKDIR /var/www/lrs
ENV SYMFONY_DEBUG="1"

# User webapp
RUN chown -R webapp:webapp /var/www

# Strip extensions to lower size
RUN set -eux \
    && find "$(php-config --extension-dir)" -name '*.so' -type f -exec strip --strip-all {} \;

# Avoid deprecation message from php.ini config
RUN sed -i 's/session.sid_length/;session.sid_length/g' /etc/php.ini
RUN sed -i 's/session.sid_bits_per_character/;session.sid_bits_per_character/g' /etc/php.ini

# Clear memory
RUN dnf -y erase gcc make php-devel
RUN dnf clean all
RUN rm -rf /var/cache/dnf

# Startup script
ADD init.sh /var/init.sh
CMD ["sh", "/var/init.sh"]

EXPOSE 9004