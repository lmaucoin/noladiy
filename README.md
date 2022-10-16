This version of the NOLADIY.org site is built on the [Yii2 Basic App](https://packagist.org/packages/yiisoft/yii2-app-basic).


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### Install with Docker

The .docker.env file should suffice, but if you want to make any edits to it, go for it.

Update your vendor packages

    docker-compose run --rm noladiy_php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm noladiy_php composer install    
    
Start the container

    docker-compose up -d

Run database migrations

    docker-compose run noladiy_php ./yii migrate/up

Create an administrator user

    docker-compose run noladiy_php ./yii users/create admin admin admin@admin.com true
    
You can then access the application through the following URL:

    http://localhost:8888

The admin panel can be accessed at 

    http://localhost:8888/utility

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Database

Copy the .env.example file to .env and change the values for the database to those on your system.

Run the database migrations to seed the database with required data

  ./yii migrate/up

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.


