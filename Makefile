APP = gpr-reports-api

.PHONY: migrate
migrate:
	docker-compose exec $(APP) php artisan migrate

.PHONY: install
install:
	docker-compose exec $(APP) composer install

.PHONY: bash
bash:
	docker exec -it $(APP) bash
