# CryptoTax Repository

## Stuff to install

```shell
sudo apt install php8.0-soap
```

## Update your local installation

On each pull, run the following commands:

```bash
git pull
composer install
php artisan migrate
php artisan optimize:clear
npm install
npm run watch
```

## Queues

Queues are run (on Prod) with supervisor. For this see https://laravel.com/docs/8.x/queues

Config:

```conf
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/cryptotax/artisan queue:work sqs --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=dev
numprocs=8
redirect_stderr=true
stdout_logfile=/var/www/cryptotax/storage/logs/worker.log
stopwaitsecs=10000
```
