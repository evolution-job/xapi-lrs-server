FROM amazonlinux:2

LABEL maintainer="Mathieu BOLDO <mathieu.boldo@entrili.com>"

# ADD Cloud certificates (Proxy) & mkcert root CA
RUN update-ca-trust force-enable
COPY cloud-certificate.crt /etc/pki/ca-trust/source/anchors/cloud-certificate.crt
COPY rootCA.crt /etc/pki/ca-trust/source/anchors/rootCA.crt
RUN update-ca-trust extract

# Packages
RUN yum -y upgrade
RUN yum -y install \
    bash \
    curl \
    gcc \
    git \
    htop \
    make \
    nano \
    openssh \
    tar \
    yum-cron \
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

# PHP 8.1
RUN amazon-linux-extras install epel
RUN amazon-linux-extras enable php8.1
RUN yum -y install \
    php-cli \
    php-devel \
    php-fpm \
    php-gd \
    php-intl \
    php-mbstring \
    php-mysqlnd \
    php-opcache \
    php-pdo \
    php-posix \
    php-xml

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
RUN yum -y install symfony-cli

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

# Clear memory
RUN yum -y erase gcc make php-devel
RUN yum clean all
RUN rm -rf /var/cache/yum

# Startup script
ADD init.sh /var/init.sh
CMD ["sh", "/var/init.sh"]

EXPOSE 9004