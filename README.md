# Описание проекта

Проект Twutter был сделан на основе курсов по Laravel для закрепления
полученных знаний.
<br>
В проекте реализованы такие функционалы как:
- Авторизация/Регистрация пользователя
- CRUD постов
- Изменение данных пользователя (Имя, Email, Фотография)
- Подписка на пользователей и показ их постов
- Чат на вебсокете между пользователями
- Общий чат на подобии реддита с возможностью ответить пользователю/комментарию

# Установка

Запустите все эти команды по очереди:

    composer install

    php artisan key:generate

    php artisan migrate --seed

    php artisan storage:link

    php artisan serve


- Далее создайте .env файл и подключитесь к своей базе данных (.env.example как тут)

- префикс "--seed" создаст 1 юзера и 3 поста для наглядности

- Открой второй консоль и пропишите команды:


        npm i
  
        npm run dev
