# CRUD API for Guests

## Описание проекта
** Проект включает в себя API для управления информацией о гостях. Все ендпоинты для взаимодействия с API прописаны в Swagger yaml, который находится по пути  ```./openapi.yaml```.**
## Требования к проекту
- docker
- docker-compose
## Установка и запуск проекта
-1. Создать в директории проекта файл окружения .env:
```shell
    cp .env.example .env
```
-2. Прописать в файле .env переменные окружения для подключения к БД: <br>
```DB_CONNECTION=mysql```<br>
```DB_HOST=guest-mysql```<br>
```DB_PORT=3306```<br>
```DB_DATABASE=guests```<br>
```DB_USERNAME=root```<br>
```DB_PASSWORD='Your Password'```<br>

-3. Развернуть приложение, используя docker-compose. В корне проекта набрать команду:
```shell
    docker-compose up
```
-4. В контейнере php-fpm или с использованием локального интерпретатора php установить зависимости composer. Запустить миграции laravel:
```shell
    docker exec -it php bash
```
```shell
    composer install
```
```shell
    php artisan migrate
```

-5. Обращение к веб-серверу nginx, который развернут на хосту localhost по порту ```8072```:
