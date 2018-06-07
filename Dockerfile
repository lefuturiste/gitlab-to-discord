FROM debian
LABEL maintainer="spamfree@matthieubessat.fr"
ADD . /app
WORKDIR /app
RUN apt-get update && apt-get -y upgrade
RUN apt-get install -y apt-transport-https lsb-release ca-certificates wget
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN apt-get update && apt-get -y upgrade
RUN apt-get -y install curl
RUN apt-get -y install php7.2 php7.2-common php7.2-cli php7.2-fpm
RUN apt-get -y install php7.2-common php7.2-json php7.2-curl
RUN apt-get -y install composer
RUN apt-get -y install nginx
RUN apt-get -y install unzip zip
RUN rm /etc/nginx/sites-enabled/default
RUN cp /app/nginx.conf /etc/nginx/sites-enabled/default
RUN composer install
RUN touch /app/.env
RUN chmod -R 777 /app
RUN chown -R www-data:www-data /app
RUN service php7.2-fpm restart
RUN service nginx restart
ENV APP_NAME gitlab_to_discord
ENV LOG_DISCORD 0
ENV LOG_PATH ../log
ENV LOG_LEVEL INFO
ENV LOG_DISCORD_WH http://example.com
EXPOSE 80
CMD service php7.2-fpm start && nginx -g "daemon off;"
