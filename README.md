# WhiteSmile — сайт стоматологии

Проект на Laravel 13, PHP 8.3+, SQLite/MySQL и Vite.

## Локальный запуск (MySQL)

Требования: PHP 8.3+ с расширением `pdo_mysql`, Composer, Node.js LTS и npm, а также MySQL 8.0+ или MariaDB 10.6+.

1. Создайте в MySQL базу данных с кодировкой `utf8mb4`:

   ```sql
   CREATE DATABASE whitesmile CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Скопируйте `.env.example` в `.env` и укажите доступы к MySQL (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
3. Установите зависимости и создайте ключ приложения:

   ```bash
   composer install
   php artisan key:generate
   npm install
   npm run build
   ```

4. Выполните миграции и запустите сервер:

   ```bash
   php artisan migrate
   php artisan serve
   ```

Откройте `http://127.0.0.1:8000`.

## Размещение на VPS

- Нужен PHP 8.3+ с расширениями `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `mbstring`, `openssl`, `pdo`, `pdo_mysql`, `session`, `tokenizer`, `xml`, `zip`; Composer и веб-сервер Nginx/Apache.
- Загрузите исходники в каталог приложения вне публичной директории сайта. **Document root веб-сайта должен указывать на каталог `public/` проекта**, а не на корень проекта.
- На сервере создайте собственный `.env` на основе `.env.example`; не копируйте локальный `.env`. Установите `APP_ENV=production`, `APP_DEBUG=false`, задайте корректный `APP_URL`, безопасный `APP_KEY` и параметры базы данных.
- Выполните: `composer install --no-dev --optimize-autoloader`, `php artisan key:generate` (только для нового окружения), `php artisan migrate --force`, `php artisan storage:link`, `php artisan optimize`.
- Каталоги `storage/` и `bootstrap/cache/` должны быть доступны PHP-процессу на запись.
- Создайте отдельную MySQL/MariaDB базу и пользователя с правами на неё; задайте их в `.env`.
- После настройки проверьте HTTPS, формы, почту и резервное копирование базы.

## Важно

Файл `.env` содержит секреты и настройки окружения. Он намеренно не включён в архив проекта. Не публикуйте его и не отправляйте пароли или ключи в переписке.
