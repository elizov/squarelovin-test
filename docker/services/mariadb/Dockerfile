FROM mariadb:10.5

# Config
COPY my.cnf /etc/mysql/my.cnf

# Migrations
COPY ./migrations/*.sql /docker-entrypoint-initdb.d/
