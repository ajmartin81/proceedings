include .env

dev:
	docker-compose up -d
install_dev:
	@make build
	@make init
build:
	docker-compose build --no-cache --force-rm
init:
	docker-compose up -d --build
	docker-compose exec php composer install
	docker-compose exec php cp .env.example .env
	docker-compose exec php php artisan key:generate
	docker-compose exec php php artisan storage:link
	docker-compose exec php php artisan migrate:fresh --seed
destroy:
	docker-compose down --rmi all --volumes
destroy_volumes:
	docker-compose down --volumes
remake:
	@make destroy
	@make init
stop:
	docker-compose stop
stop-all:
	docker stop $(docker ps -aq)
down:
	docker-compose down
restart:
	@make down
	@make up
logs-watch:
	docker-compose logs --follow
php:
	docker-compose exec php bash
migrate:
	docker-compose exec php php artisan migrate
fresh:
	docker-compose exec php php artisan migrate:fresh --seed
seed:
	docker-compose exec php php artisan db:seed
tinker:
	docker-compose php php artisan tinker