# Vehicle Tracking API

This project is a Vehicle Tracking API developed using Laravel. It provides capabilities for user authentication and tracking vehicles in a fleet management system.

## Features

- User authentication using API-based tokens.
- API endpoints to handle vehicle tracking and status updates.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them:

- PHP >= 7.3
- Composer
- cron
- MySQL or any other compatible database system
- Laravel >= 8.x

### Installing

A step-by-step series of examples that tell you how to get a development environment running:

```bash
git clone https://github.com/Razkky/vehicle-tracking-api.git
cd vehicle-tracking-api
./install.sh
```

### Setting up Task Scheduling with Cron

To utilize Laravel's task scheduling capabilities, you must add a cron job that executes Laravel's scheduler every minute. This ensures your scheduled tasks are run at their specified intervals.

#### Steps to set up the Cron job:

1. **Install Crontab:** Ensure that Crontab is installed on your machine. If it's not already installed, you can usually install it via your package manager.

2. **Open Crontab Editor:**
   Open a terminal and run the following command to edit the crontab for your user:
   ```bash
   crontab -e
   ```
Add the following line to file 
- * * * * * cd /path/to/your/project && php artisan schedule:run >> /path/to/your/project/storage/logs/cron.log 2>&1
Replace /path/to/your/project with the actual path to your Laravel project on your server. This command will execute the Laravel scheduler every minute and log the output to cron.log in your project's storage/logs directory.


### Running application

``` bash
php artisan serve
```


For detailed information about API endpoints and usage, please refer to our [API Documentation](https://documenter.getpostman.com/view/34067711/2sA3kRJPK2).
