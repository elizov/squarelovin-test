FROM node:13.7.0-alpine3.10

# User set up
ARG UID
ARG GID
ARG USER
RUN deluser node && addgroup -g ${GID} -S ${USER} && adduser -u ${UID} -S ${USER} -G ${USER}

USER ${USER}
