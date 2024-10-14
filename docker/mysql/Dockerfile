FROM mysql:latest

ENV MYSQL_ROOT_PASSWORD=root_password
ENV MYSQL_USER=my_user
ENV MYSQL_PASSWORD=my_password

COPY docker/mysql/mysql.cnf /etc/mysql/conf.d/

COPY DOCUMENTOS/AntigoSQLPreenchido/guashop.sql /docker-entrypoint-initdb.d/

EXPOSE 3306
