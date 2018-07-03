#!/bin/bash
echo "" >> /etc/php/7.2/fpm/pool.d/www.conf # new line.
echo "env[APP_NAME] = $APP_NAME;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[APP_ENV_NAME] = $APP_ENV_NAME;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[APP_DEBUG] = $APP_DEBUG;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_DISCORD] = $LOG_DISCORD;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_PATH] = $LOG_PATH;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_LEVEL] = $LOG_LEVEL;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_DISCORD_WH] = $LOG_DISCORD_WH;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[DISCORD_WH_URL] = $MYSQL_HOST;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[WH_TOKEN] = $MYSQL_DATABASE;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[GITLAB_BASE_URL] = $MYSQL_USERNAME;" >>  /etc/php/7.2/fpm/pool.d/www.conf
