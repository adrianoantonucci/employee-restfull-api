_env-file:
	[ -f .env ] || cp .env.example .env
start:
	docker-compose up
install: _env-file
	docker-compose up -d
	docker-compose exec app composer install
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate:refresh --seed


stop:
	docker-compose down

docker-install-dependencies:
	docker exec -it employee-api-app composer install

docker-logs:
	docker logs -f employee-api-app

install-dependencies:
	docker exec -it employee-api-app composer install

install-composer:
	docker-compose up -d
	docker-compose exec app composer/composer install

docker-run-migrations:
	docker-compose exec app php artisan migrate