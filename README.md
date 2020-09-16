# Laravel API mail sender package

# cool-club (16-09-2020)

# RU - русский
### Время, затраченное на каждую часть проекта
- Начальная загрузка, контракты API и абстракции        4 часа.
- Моделирование приложения, базы данных и кодирования   3 часа.
- Тестирование отладки и публикации пакета              3 часа.
- Упаковка и развертывание Git                          2 час.
- Документирование и руководство по установке           5 часов.
- Общее время проекта                                   17 часов.

# Монтаж
Этот пакет использует Composer для управления своими зависимостями. Убедитесь, что на вашем компьютере установлен Composer.
Затем запустите в своем терминале следующие команды:
1) Для этого пакета требуется фреймворк Laravel. Чтобы установить laravel, выполните следующую команду
- composer create-project --prefer-dist laravel / laravel task "6.2. *"
2) Измените каталог на только что созданный проект. В Windows команда:
- cd task
2) После завершения установки laravel выполните следующую команду, чтобы установить этот пакет
- композитору требуется drnkwati / mail-sender
3) измените конфигурацию базы данных для вашего приложения в файле конфигурации .env
- Вы можете использовать любую реляционную базу данных, поддерживаемую фреймворком laravel. Просто установите соединение с базой данных и запустите миграции.
- Для вашего удобства этот пакет поставляется с демонстрационной базой данных sqlite с исходными данными. Вы можете найти его в папке src.
- Чтобы использовать эту демонстрационную базу данных, просто скопируйте ее в папку своей базы данных как database.sqlite
4) Вы можете использовать веб-сервер, такой как Apache или Nginx, для обслуживания своих приложений. Использовать встроенный сервер разработки PHP. В Windows выполните следующую команду:
- php artisan serve --port = 7070
5) Откройте свой веб-браузер по адресу: http://127.0.0.1:7070/mail.

# Возможные конечные точки API включают:
- http://127.0.0.1:7070/mail

- Доступ к API можно получить с помощью такого инструмента, как почтальон. Для простых HTTP-запросов GET вы можете использовать веб-браузер.

# Примеры использования:
## Следующие запросы предполагают, что вы используете демонстрационную базу данных.
* При выполнении PUT, PATCH или DELETE вам нужно будет добавить в форму скрытое поле \ _method
* Вам также может потребоваться отправить скрытое поле токена \_token

## Форма новой почты конечной точки на http://127.0.0.1:7070/mail
### почта (ПОЛУЧИТЬ)
- Чтобы отправить новое письмо, откройте в браузере http://127.0.0.1:7070/mail.

### создать (POST)
- Чтобы создать новое письмо, отправьте POST-запрос по адресу: http://127.0.0.1:7070/mail.
- Обязательные поля включают message_content
- Необязательные поля включают отправителя


# Запуск семян и тестов.
## Пакет поставляется вместе с сидерами и тестами, расположенными в каталогах пакетов src \ Seeders и src \ Tests.
## Вы можете расширить эти классы и запустить тесты.

# EN - english

### Time spent on each part of the project
- Bootstrapping, API contracts and abstractions     4 hrs.
- Modelling the APP, database and coding            3 hrs.
- Testing debug and publishing package              3 hrs.
- Git packaging and deployment                      1 hrs.
- Documenting and Installation guide                5 hrs.
- Total project time                                16 hrs.

# Installation
This package utilizes Composer to manage its dependencies. Make sure you have Composer installed on your machine.
Then run the following commands in your terminal: 
1) The Laravel framework is required by this package. To install laravel, run the following command
- composer create-project --prefer-dist laravel/laravel task "6.2.*"
2) Change your directory to the newly created project. On windows the command is: 
- cd task
2) After laravel installation is complete, run the following command to install this package
- composer require drnkwati/mail-sender
3) change database configuration for your application in .env configuration file
- You may use any relational database supported by laravel framework. Just set the database connection and run migrations.
- For your convenience, this package comes with a demo sqlite database with seed data. You can find it in src folder.
- To use this demo database, just copy it to your database folder as database.sqlite
4) You may use a web server such as Apache or Nginx to serve your applications. To use PHP's built-in development server. On windows run the following command: 
- php artisan serve --port=7070
5) Open your web browser at: http://127.0.0.1:7070/mail

# Possible API endpoints include:
- http://127.0.0.1:7070/mail

- The api can be accessed through a tool such as postman. For simple http GET requests, you can use a web browser.

# Usage Examples: 
## The following queries assume you are using the demo database.
* When making PUT, PATCH or DELETE, you will need to add a hidden \_method field to the form
* You may also need to send a hidden token field \_token

## Endpoint new mail form at http://127.0.0.1:7070/mail
### mail (GET)
- To send a new mail open your browser at http://127.0.0.1:7070/mail

### create (POST)
- To create a new mail, make a POST request to: http://127.0.0.1:7070/mail
- Required fields include message_content
- Optional fields include sender


# Running seeds and tests.
## The package comes bundled with Seeders and Tests located in the package src\Seeders and src\Tests directories. 
## You can extend these classes and run the tests.
