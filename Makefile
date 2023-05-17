include .env

.DEFAULT_GOAL := help

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

proxy: ## Run proxy for 8989 port, from "www-data"
	docker-compose exec -u www-data php bash -c  "cd /var/www/bitrix/proxy && npm install && npm run start"

devserv:## Run devserv for 3000 port, from "www-data"
	docker-compose exec -u www-data php bash -c  "cd /var/www/bitrix/spa.kant/frontend && yarn install && yarn devserv"

gulp_build: ## Run build for backend, from "www-data"
	docker-compose exec -u www-data php bash -c  "cd /var/www/bitrix/spa.kant/gulp && npm i && npm run gulp"

elastic_index: ## Run indexation for elastic , from "www-data"
	docker-compose exec -u www-data php bash -c  "cd /var/www/bitrix/spa.kant/cron/ && php ./filling_elastic_tables.php"

console-php: ## Run bash (PHP) from "www-data"
	docker-compose exec -u www-data php bash

console-php-root: ## Run bash (PHP) from "root"
	docker-compose exec -u root php bash

console-mysql: ## Log in to the MySQL console from default user
	docker-compose exec db mysql -u $(MYSQL_USER) --password=$(MYSQL_PASSWORD) -A $(MYSQL_DATABASE)

console-mysql-root: ## Log in to the MySQL console from "root"
	docker-compose exec db mysql -u root --password=$(MYSQL_ROOT_PASSWORD) -A $(MYSQL_DATABASE)

up: ## Up Docker-project
	docker-compose up -d

down: ## Down Docker-project
	docker-compose down --remove-orphans

stop: ## Stop Docker-project
	docker-compose stop

build: ## Build Docker-project
	docker-compose build --no-cache

ps: ## Show list containers
	docker-compose ps

bitrix-setup: create-dir ## Download bitrixsetup.php file to the site path
	wget http://www.1c-bitrix.ru/download/scripts/bitrixsetup.php -O ${SITE_PATH}/bitrixsetup.php

bitrix-restore: create-dir ## Download restore.php file to the site path
	wget http://www.1c-bitrix.ru/download/scripts/restore.php -O ${SITE_PATH}/restore.php

bitrix-server-test: create-dir ## Download bitrix_server_test.php file to the site path
	wget https://dev.1c-bitrix.ru/download/scripts/bitrix_server_test.php -O ${SITE_PATH}/bitrix_server_test.php

create-dir: ## Create site path
	mkdir -p ${SITE_PATH}

default: help
