#Инструкция для запуска проекта KANT
## Запуск проекта
- Зайти в папку проекта `www/html/site_name`
- Склонировать из репозитория проект
- Создать файл `.env` из `.env.example`
- Добавить в .env `DB_PASS="pass" (обязательно), DB_HOST, DB_BASE, DB_LOGIN (переопределяется если не установлено) `
- Вернуться в текущую директорию
- Скопировать содержимое папки `configs/site_name`  в `www/html/site_name`
- Создать файл `.env` из `.env.example`
- Собрать докер образы `docker-compose build`
- Запустить сборку `docker-compose up`
- Установить зависимости в (Сначала войдите в конейнер `make console-php`) `/var/www/bitrix/site_name/composer install ` , `/var/www/bitrix/site_name/lib/composer install -ignore-platform-req=ext-phalcon`, `local/modules/kant.sitesettings/composer install`, 
- Собрать фронт сайта `make gulp-build` (станет доступен на 80 порту)
- Проиндексировать поисковик elasticsearch `make elastic-index`

## Постоянные команды
- Запустить билд `make up`
- Запустить прокси `make proxy` (станет доступен на 8989 порту)
- Запустить фронт spa `make devserv` (станет доступен на 3000 порту)
- Остановить при необходимости `make down`
###Альтернатива
- В одной вкладке терминала запустить докер и прокси сервер `make up-proxy`
- Во второй вкладке терминала запустить `make devserv`