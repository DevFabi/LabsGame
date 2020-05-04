FROM phpdockerio/php74-fpm:latest
WORKDIR "/app"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php-pgsql php-xdebug php-amqp \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

#COPY messenger-worker.conf /etc/supervisor/conf.d
#COPY supervisord.conf /etc/supervisor
#
#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]