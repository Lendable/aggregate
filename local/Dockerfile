FROM php:8.2.18-cli-alpine as base

COPY --from=composer/composer:2.8.8-bin /composer /usr/bin/composer

RUN apk add --no-cache git openssh \
    && mkdir -p -m 0600 ~/.ssh && ssh-keyscan github.com >> ~/.ssh/known_hosts

WORKDIR /app

FROM base AS dev

ARG XDEBUG_VERSION="3.2.2"
RUN apk add --no-cache autoconf file g++ gcc libc-dev make pkgconf re2c linux-headers \
  && apk add --no-cache bash git \
  && pecl install "xdebug-${XDEBUG_VERSION}" \
  && apk del autoconf file g++ gcc libc-dev make pkgconf re2c linux-headers

COPY xdebug-entrypoint.sh /usr/local/bin/docker-php-xdebug-entrypoint
