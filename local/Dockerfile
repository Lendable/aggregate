FROM public.ecr.aws/docker/library/php:8.4-cli-alpine@sha256:b9014f1cc1983827459faed83b315a40ead9860bdadefc042b31f1540ef8c746 AS base

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN addgroup --gid "${GROUP_ID}" "app" && \
    adduser \
    --disabled-password \
    --gecos "" \
    --home "/app-home" \
    --ingroup "app" \
    --uid "${USER_ID}" \
    -s "/bin/sh" \
    "app"

COPY --from=composer/composer:2.11.1-bin@sha256:56a1b0a72bacd78079e3fa49a49e7bf58326365753415c99385ea2b08bded0a5 /composer /usr/bin/composer

RUN apk add --no-cache git openssh \
    && mkdir -p -m 0600 ~/.ssh && ssh-keyscan github.com >> ~/.ssh/known_hosts

WORKDIR /app

FROM base AS dev

ARG XDEBUG_VERSION="3.5.1"
RUN apk add --no-cache autoconf file g++ gcc libc-dev make pkgconf re2c linux-headers \
  && apk add --no-cache bash git \
  && pecl install "xdebug-${XDEBUG_VERSION}" \
  && apk del autoconf file g++ gcc libc-dev make pkgconf re2c linux-headers

COPY xdebug-entrypoint.sh /usr/local/bin/docker-php-xdebug-entrypoint
