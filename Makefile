DIR := $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))
PROJECT_NAME = lendable_library_template
CONTAINER = runner
PUID ?= 1000
PGID ?= 1000
EXEC_SHELL = /bin/sh
EXEC_USER = app

DOCKER_COMPOSE = docker-compose \
  -f ${DIR}/ci/docker-compose-tests.yaml \
  -f ${DIR}/ci/docker-compose-dev.yaml \
  --project-directory $(DIR) \
  -p ${PROJECT_NAME}

init:
	@mkdir -p $(HOME)/.composer && chown $(PUID):$(PGID) $(HOME)/.composer

up: init
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

shell:
	$(DOCKER_COMPOSE) exec -u $(EXEC_USER) $(CONTAINER) $(EXEC_SHELL)

build:
	DOCKER_BUILDKIT=1 docker build --ssh default -f "${DIR}/Dockerfile.php-cli" -t $(PROJECT_NAME)_$(CONTAINER):latest --target base .

clean:
	@$(DOCKER_COMPOSE) down -v --rmi local

.PHONY: init up down start stop restart ps shell build clean
