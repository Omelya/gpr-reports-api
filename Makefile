APP = gpr-reports-api

.PHONY: migrate
migrate:
	docker exec $(APP) php artisan migrate

.PHONY: install
install:
	docker exec $(APP) composer install

.PHONY: bash
bash:
	docker exec -it $(APP) bash

.PHONY: create-test-database
create-test-database:
	docker exec $(APP) php artisan gpr-reports:create-test-database gpr-reports-test
	docker exec $(APP) php build/switch.php --mode=test
	docker exec $(APP) php artisan migrate
	docker exec $(APP) php build/switch.php --mode=dev

.PHONY: test-run
test-run:
	docker exec $(APP) php artisan test --env=testing
