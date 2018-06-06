# Gitlab to discord

Simple API server to listen the GitLab system event and transmit to a discord webhook.

## Install it

### Docker

coming soon...

### Manual

- Clone this repository
- composer install
- Create a .env file in the root directory and fill it with env vars fields (you can get the list of the fields in .env.example or by the doc bellow)

## Usage

- `GET /`: Display some information about this API ;)
- `POST /event`: The main route to put on your GitLab's configuration

## Environments variables

Description of each environments variables which can be putted in .env file

- `APP_NAME`: The app's name, displayed in the logs
- `APP_ENV_NAME`: The app's environment displayed in the logs
- `APP_DEBUG`: If true, the app will show the detail of a an eventual error (Be careful, if true, the app will show all of the details of errors and more...)

Monolog environment vars:

- `LOG_DISCORD`: If true, the logs will be send by the `LOG_DISCORD_WH` webhook not the main
- `LOG_PATH`: The path of the monolog log file (for instance: `../log`)
- `LOG_LEVEL`: The level of the stored logs (for instance: `INFO` will say to the app to don't care about logs level lower than `INFO` level), can be: `DEBUG`, `INFO`, `NOTICE`, `WARNING`, `ERROR`, `CRITICAL`, `ALERT` , `EMERGENCY` (defined in RFC 5424)
- `LOG_DISCORD_WH`: The discord url to the discord webhook for the logs, not for gitlab event

Most important:

- `DISCORD_WH_URL`: The discor durl to the main discord webhook for the gitlab events

## License

The project is MIT licensed. To read the full license, view LICENSE.md.

## Contributing

Pull requests and issues are open!

### Local development server

- `php console serve`: to run a local dev server with php cli
