#!/bin/bash

# Set the path to your Laravel project
laravel_path="/home/u819948522/public_html/rrwebdevelopment.in"

# Execute the Laravel cron job
/usr/bin/php "$laravel_path/artisan" schedule:run >> /dev/null 2>&1



#!/bin/sh
# /usr/bin/php /home/u819948522/domains/rrwebdevelopment.in/public_html/&& php artisan schedule:run >> /dev/null 2>&1