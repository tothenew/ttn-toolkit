FROM ubuntu:22.04
ENV DRUSH_VERSION 11.4.0
ENV TZ="Asia/Kolkata" \
    DEBIAN_FRONTEND=noninteractive
RUN apt-get update -y && \
    apt-get install -y vim curl unzip net-tools mysql-client dialog apt-utils wget git nginx rsyslog cron software-properties-common

RUN set -eux \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update -y \
    && apt install -y php8.1 \
      php8.1-fpm \
      php8.1-cli \
      php8.1-mysql \
      php8.1-gd \
      php8.1-imagick \
      php8.1-tidy \
      php8.1-xmlrpc \
      php8.1-xml \
      php8.1-curl \
      php8.1-imap \
      php8.1-mbstring \
      php8.1-opcache \
      php8.1-soap \
      php8.1-zip \
      php8.1-intl \
      php8.1-dev \
      php8.1-cgi \
      php8.1-redis \
      php8.1-apcu \
      libapache2-mod-php8.1 \
    && apt-get install -y --no-install-recommends \
      libfreetype6-dev \
      libjpeg-dev \
      libpng-dev \
      libpq-dev \
      libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


RUN phpenmod apcu \
    && echo "local0.* /var/log/drupal.log" >> /etc/rsyslog.conf \
    && /usr/sbin/rsyslogd

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    mv composer.phar /usr/local/bin/composer  \
    && composer global require drush/drush:${DRUSH_VERSION} \
    && ln -s ~/.composer/vendor/drush/drush/drush /bin/drush \
    && php -r "unlink('composer-setup.php');" \
    && export PATH="$HOME/.composer/vendor/bin:$PATH"

RUN systemctl enable nginx
ARG artifact_version
LABEL artifact_version=$artifact_version

WORKDIR /var/www/html

ADD ./code /var/www/html
RUN export SSL=1
RUN rm -v /etc/nginx/nginx.conf
RUN rm -v /etc/nginx/sites-enabled/default
RUN rm -v /etc/nginx/sites-available/default

COPY settings.php* /var/www/html/sites/default/
COPY services.yml /var/www/html/sites/default/
RUN true
COPY nginx.conf /etc/nginx/nginx.conf
RUN true
COPY server.conf /etc/nginx/conf.d/server.conf

COPY init.sh /init.sh

RUN chown -R www-data:www-data /var/www/html/ \
  && chmod -R 755 /var/www/html/ \
  && mkdir -p /var/log/php \
  && chown -R www-data:www-data /var/log/php

RUN chmod 500 /init.sh

RUN echo "daemon off;" >> /etc/nginx/nginx.conf
EXPOSE 80
CMD /init.sh
