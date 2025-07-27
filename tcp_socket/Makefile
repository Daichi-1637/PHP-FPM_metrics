DOCKER_COMPOSE=docker compose -f ./compose.yaml --env-file ./.env

.PHONY: compose.up
compose.up:
	$(DOCKER_COMPOSE) up

.PHONY: compose.down
compose.down:
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

.PHONY: restart.php-fpm
restart.php-fpm:
	$(DOCKER_COMPOSE) restart php-fpm

.PHONY: restart.nginx-app
restart.nginx-app:
	$(DOCKER_COMPOSE) restart nginx-app

.PHONY: show.config.php-fpm
show.config.php-fpm:
	docker exec php-fpm php-fpm -tt

.PHONY: show.config.nginx-app
show.config.nginx-app:
	docker exec nginx-app nginx -T

.PHONY: show.config.nginx-metrics
show.config.nginx-metrics:
	docker exec nginx-metrics nginx -T

.PHONY: run.k6
run.k6:
	$(DOCKER_COMPOSE) --profile performance-test run k6
