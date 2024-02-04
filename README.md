# ConvertedIn Assessment  

## ENV Requirement

#### PHP: 8.2

#### Node.js: 16.15.0

#### npm: 8.5.5

#### Composer: 2.6.6

#### MySQL: 8


## MYSQL Credential .env

this requirment set to runing action in `github` 
feel free to change it in `.env`
but keep it in env.example

#### may you need to change in ``env.example`` to run commands below
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=converted_task
DB_USERNAME=root
DB_PASSWORD=root
```

## Installation

### 1- Run composer install .

```
composer install
```
### 2- Run this command to start the application.

```
php artisan start:app
```

### 3- run this command to update statistics .

```
php artisan queue:work
```

### 4- then run tests.

```
php artisan test
```

Then go to 

```
 http://127.0.0.1:8000 
```

Login Credentials
```
email: admin@admin.com
password: password
```


