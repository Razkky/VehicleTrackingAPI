#!/bin/bash

# This script sets up the Vehicle Tracking API.
echo "Cloning the repository..."
git clone https://github.com/Razkky/vehicle-tracking-api.git

echo "Changing directory..."
cd vehicle-tracking-api

echo "Installing dependencies..."
composer install

echo "Setting up environment..."
cp .env.example .env

echo "Generating app key..."
php artisan key:generate

echo "Running migrations and seeders..."
php artisan migrate:fresh --seed

echo "Starting the Laravel development server..."
php artisan serve

echo "Installation complete. The server is running on http://localhost:8000"
