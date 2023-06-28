
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Billing


System for adding debts

This project has been incorporated into docker for easy installation.
Run first command:



## Installation

This project has been incorporated into docker for easy installation.

First, add the .env by renaming the .env.example there are variables that are already built in.

Run first command:

```bash
docker-compose build

docker-compose up
```

After installed to enter the terminal enter:

```bash
docker exec -it billing ash
```


When installed, go in and run some "laravel" commands

After installed to enter the terminal enter:

```bash
composer install

php artisan key:generate

php artisan migrate

```

Run test command

```bash
php artisan test

```

## API documentation

#### Take a csv and save all records

This example csv has in the folder "/docs/debts.csv"

```http
  curl --request POST \
  --url http://billing.localhost/api/debts \
  --header 'Accept: application/json' \
  --header 'Content-Type: multipart/form-data' \
  --form debt=@/home/user/projetos/billing/docs/debt.csv
```


#### Activates the webhook that a debt has been paid

```http
  curl --request POST \
  --url http://billing.localhost/api/payOff \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"debtId": "8291",
	"paidAt": "2022-06-09 10:00:00",
	"paidAmount": 100000.00,
	"paidBy": "John Doe"
}'
```