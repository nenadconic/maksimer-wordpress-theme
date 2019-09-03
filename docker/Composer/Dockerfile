FROM frolvlad/alpine-java:jdk8-slim

ENV USER=developer
ENV PHPSTORM_VERSION=2019.2.1

RUN apk add --no-cache \
    libxext \
    libxrender \
    libxtst \
    libxi \
    freetype \
    git \
    curl

RUN  \
mkdir /opt/phpstorm && \
wget -O - https://download.jetbrains.com/webide/PhpStorm-${PHPSTORM_VERSION}.tar.gz | tar xzf - --strip-components=1 -C "/opt/phpstorm"

RUN  \
adduser -D -s /bin/sh ${USER} ${USER} && \
mkdir /home/${USER}/.${PHPSTORM_VERSION} &&  \
touch /home/${USER}/.${PHPSTORM_VERSION}/.keep && \
chown -R ${USER}.${USER} /home/${USER}

RUN apk del --no-cache curl

WORKDIR /opt/phpstorm/bin

USER ${USER}
