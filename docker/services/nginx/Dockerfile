FROM nginx:1.17.8-alpine

# User set up
ARG UID
ARG GID
ARG USER
RUN addgroup -g ${GID} -S ${USER} && adduser -u ${UID} -S -G ${USER} ${USER}

# Dependencies
RUN apk --no-cache add \
        openssl

# Nginx configs
ARG APP_ENV
COPY "sites/${APP_ENV}/*.conf" /etc/nginx/conf.d/
COPY nginx.conf  /etc/nginx/
COPY .htpasswd   /etc/nginx/
RUN rm /etc/nginx/conf.d/default.conf

# Add the "args" from docker-compose.yml to the OS env
ARG APP_NAME

# Certs
RUN openssl req -x509 -nodes -days 365 \
    -subj "/C=CA/ST=QC/O=Company, Inc./CN=${APP_NAME}.local" \
    -addext "subjectAltName=DNS:${APP_NAME}.local" \
    -newkey rsa:2048 \
    -keyout /etc/ssl/private/nginx-selfsigned.key \
    -out /etc/ssl/certs/nginx-selfsigned.crt;

# Replace envs in nginx's configs
RUN for i in $(env); \
    do \
    	ENV_NAME=$(echo $i | cut -d'=' -f1); \
    	ENV_VALUE=$(echo $i | cut -d'=' -f2); \
    	SED_TEMPLATE="s|\${$ENV_NAME}|$ENV_VALUE|g"; \
    	sed -i $SED_TEMPLATE /etc/nginx/conf.d/*; \
    	sed -i $SED_TEMPLATE /etc/nginx/nginx.conf; \
    done

RUN touch /var/run/nginx.pid \
 && chown -Rf ${USER}:${USER} \
    /var/run/nginx.pid \
    /var/cache/nginx \
    /var/log/nginx \
    /etc/ssl/private \
    /etc/ssl/certs

USER ${USER}
