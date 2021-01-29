#!make
 
.DEFAULT_GOAL := help
.PHONY: help
help:
	@echo "\033[33mUsage:\033[0m\n  make [target] [arg=\"val\"...]\n\n\033[33mTargets:\033[0m"
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' Makefile| sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-15s\033[0m %s\n", $$1, $$2}'

.PHONY: bash
bash: ## Get a shell into app container
	docker-compose exec app bash

.PHONY: logs
logs: ## Get a shell into app container
	docker-compose logs -f app

.PHONY: up
up: ## Start containers
	docker-compose up -d

.PHONY: stop
stop: ## Stop containers
	-docker-compose stop

.PHONY: restart
restart: ## Restart containers
	docker-compose restart

.PHONY: assets-watch
assets-watch: ## watching assets
	docker-compose exec app /bin/bash -c  "npm run sass"

.PHONY: svg-sprite
svg-sprite: ## watching assets
	docker-compose exec app /bin/bash -c  "npm run svg-sprite"