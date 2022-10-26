FROM composer:latest AS symfony-web-application

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apk add --no-cache bash && \
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add symfony-cli acl && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions soap

CMD ["symfony", "server:start", "--no-tls"]
