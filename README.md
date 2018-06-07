# Gitlab to discord

Simple API server to listen the GitLab system event and transmit to a discord webhook.

## Install it

### Docker

Docker image: [Available here](https://hub.docker.com/r/lefuturiste/gitlab-to-discord/)

#### Usage

Run the container by this command

```
docker run -d -e APP_ENV_NAME='production' \
-e APP_DEBUG='1' \
-e DISCORD_WH_URL='https://discordapp.com/api/webhooks/ID/TOKEN' \
-e WH_TOKEN='YOUR_TOKEN' \
-e GITLAB_BASE_URL='https://gitlab.compagny.com' \
-p 0.0.0.0:4880:80 \
--name gitlab-to-discord lefuturiste/gitlab-to-discord
```

This will run the container and publish the port 80 on the port 4880 on your machine, you can change it! Change also the environments vars. It's highly recommended to use a proxy to access to the http server.

### Manual

### Requirements

- PHP 7.1 or higher
- [Composer](https://getcomposer.org)
- Nginx is highly recommended

### Steps by steps

- Clone this repository
- composer install
- Create a .env file in the root directory and fill it with environment variables fields (you can get the list of the fields in .env.example or by the doc bellow)

For nginx user, there is a example of configuration in `nginx.conf`.

### Add it to your GitLab instance

- Go to the admin panel of the instance
- Go to `System Hooks` section
- In `URL` field put (adapt the URL): `https://gitlabtodiscord.example.com/event`
- In `Secret Token` field put your secret token set or generated when installation
- Check all triggers
- Submit by clicking on `Add system hook` button

## Usage

- `GET /`: Display some information about this API ;)

- `POST /event`: The main route to put on your GitLab's configuration, this route is authenticated with the `X-Gitlab-Token` header (`WH_TOKEN` environment variable)

## Environments variables

Description of each environments variables which can be putted in .env file

- `APP_NAME`: The app's name, displayed in the logs
- `APP_ENV_NAME`: The app's environment displayed in the logs
- `APP_DEBUG`: If true, the app will show the detail of a an eventual error (Be careful, if true, the app will show all of the details of errors and more...)

Monolog environment variables:

- `LOG_DISCORD`: If true, the logs will be send by the `LOG_DISCORD_WH` webhook not the main
- `LOG_PATH`: The path of the monolog log file (for instance: `../log`)
- `LOG_LEVEL`: The level of the stored logs (for instance: `INFO` will say to the app to don't care about logs level lower than `INFO` level), can be: `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT` , `EMERGENCY` (defined in RFC 5424)
- `LOG_DISCORD_WH`: The discord URL to the discord webhook for the logs, not for GitLab event

Most important:

- `DISCORD_WH_URL`: The discord URL to the main discord webhook for the GitLab events
- `WH_TOKEN`: The secret token of the webhook, keep it secret!
- `GITLAB_BASE_URL`: The base URL of your GitLab's instance (Without '/' at the end!)

## Features roadmap

- Quick install with Docker
- Locales support (fr, en, de, es)
- Merge request events support
- Add test with PHPUnit

## License

The project is MIT licensed. To read the full license, view LICENSE.md.

## Contributing

Pull requests and issues are open!

### Local development server

- `php console serve`: to run a local dev server with PHP cli
