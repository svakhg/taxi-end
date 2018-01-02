#!/bin/sh
git pull
php artisan migrate
php artisan optimize