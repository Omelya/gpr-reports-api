APP = gpr-reports-api

.PHONY: install
install:
	composer install

.PHONY: migrate
migrate:
	php artisan migrate

.PHONY: bash
bash:
	docker exec -it $(APP) bash
