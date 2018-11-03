# Project WordPress image
FROM wordpress:php7.2-fpm

COPY ./docker/scripts/compose-this.sh /home/compose-this.sh

# Add WP-CLI
WORKDIR /home
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN php wp-cli.phar --info
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp
RUN wp --info

RUN chmod +x compose-this.sh
RUN chown www-data:www-data compose-this.sh
RUN mv compose-this.sh /var/www/
RUN chown www-data:www-data /var/www

# USER www-data
# RUN whoami
# RUN /scripts/compose-this.sh

USER root
WORKDIR /var/www/html
VOLUME /var/www/html
