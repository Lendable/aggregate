DIR := $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))
PROJECT_NAME = lendable_aggregate
CONTAINER = runner
PUID ?= 1000
PGID ?= 1000
EXEC_SHELL = /bin/sh
EXEC_USER = app

DOCKER_COMPOSE = docker-compose \
  -f ${DIR}/local/docker-compose.yaml \
  --project-directory $(DIR)/local \
  -p ${PROJECT_NAME}

init:
	@mkdir -p $(HOME)/.composer && chown $(PUID):$(PGID) $(HOME)/.composer

up: build
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down -v

start:
	$(DOCKER_COMPOSE) start

stop:
	$(DOCKER_COMPOSE) stop

restart:
	$(DOCKER_COMPOSE) restart

ps:
	$(DOCKER_COMPOSE) ps

logs:
	$(DOCKER_COMPOSE) logs -f

shell:
	$(DOCKER_COMPOSE) exec -u $(EXEC_USER) $(CONTAINER) $(EXEC_SHELL)

build: init
	DOCKER_BUILDKIT=1 docker build --ssh default -f "${DIR}/local/Dockerfile.php-cli" -t $(PROJECT_NAME)_$(CONTAINER):latest --target dev .

clean:
	@$(DOCKER_COMPOSE) down -v --rmi local

.PHONY: init up down start stop restart ps logs shell build clean
