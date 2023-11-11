#!/bin/bash
set -e

php artisan optimize
php artisan cache:clear

exec "$@"
