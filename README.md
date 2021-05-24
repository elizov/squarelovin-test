# Getting started at the local

## Deployment at the local

Auto deployment at the local machine

    $ make deploy-local

## Useful commands

To see all possible commands

    $ make help

## Additional

To run the application on a different port, for example - 3000, change in /.env

    APP_PORT=3000

## Hot reload

Enable the hot reload in the server/.env

    HOT_RELOAD=true

Then run the command

    $ make hot

Note, the 8080 port is using for the hot reload
