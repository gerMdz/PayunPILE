#!/bin/bash

DOCKER_BE = payunpile-be
OS = $(shell uname)
UID = $(shell id -u)

NAMESERVER_IP = $(shell ip address | grep docker0)

ifeq ($(OS),Darwin)
	NAMESERVER_IP = host.docker.internal
else ifeq ($(NAMESERVER_IP),)
	NAMESERVER_IP = $(shell grep nameserver /etc/resolv.conf  | cut -d ' ' -f2)
else
	NAMESERVER_IP = 172.17.0.10
endif

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

run: ## Start the containers
	docker network create payunpile-network || true
	cp -n .env .env.local || true
	cp -n docker-compose.yml.dist docker-compose.yml || true
	U_ID=${UID} HOST=${NAMESERVER_IP} docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker-compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

build: ## Rebuilds all the containers
	U_ID=${UID} HOST=${NAMESERVER_IP} docker-compose build

prepare: ## Runs backend commands
	$(MAKE) composer-install
	$(MAKE) migrations
	$(MAKE) assets

# Backend commands
composer-install: ## Installs composer dependencies
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} composer install --no-scripts --no-interaction --optimize-autoloader

migrations: ## Runs the migrations
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} bin/console doctrine:migrations:migrate -n

assets: ## Install API Platform assets
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} bin/console assets:install

be-logs: ## Tails the Symfony dev log
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} tail -f var/log/dev.log
# End backend commands

ssh-be: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bash

code-style: ## Runs php-cs to fix code styling following Symfony rules
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} php-cs-fixer fix src --rules=@Symfony
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} php-cs-fixer fix tests --rules=@Symfony

generate-ssh-keys: ## Generates SSH keys for the JWT library
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} mkdir -p config/jwt
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} openssl genrsa -passout pass:767b453a97ac019714eb7ccbce781d16 -out config/jwt/private.pem -aes256 4096
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} openssl rsa -pubout -passin pass:767b453a97ac019714eb7ccbce781d16 -in config/jwt/private.pem -out config/jwt/public.pem

tests: ## Run all tests in the application
	$(MAKE) generate-ssh-keys
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} bin/console --env=test doctrine:database:create --if-not-exists -n
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} bin/console --env=test doctrine:migrations:migrate -n
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} bin/phpunit

.PHONY: migrations tests
