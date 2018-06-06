# Gitlab to discord

Simple API server to listen the GitLab system event and transmit to a discord webhook.

## Install it

### Docker

coming soon...

### Manual

- Clone this repository
- composer install
- Create a .env file in the root directory and fill it with environment variables fields (you can get the list of the fields in .env.example or by the doc bellow)

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

## License

The project is MIT licensed. To read the full license, view LICENSE.md.

## Contributing

Pull requests and issues are open!

### Local development server

- `php console serve`: to run a local dev server with PHP cli
