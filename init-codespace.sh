#!/usr/bin/env bash

if [[ ! -f ".env" ]]; then
    cp .env.example .env
fi

composer install

grep -q "base64:.*=" ./.env; i=$(($?));
if [[ $i != "0" ]]; then
    php artisan key:generate
fi

php artisan migrate:fresh --seed

npm install
npm run dev
