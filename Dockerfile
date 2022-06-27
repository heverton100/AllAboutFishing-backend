FROM php:8.0.5

RUN apt-get update -y && apt-get install -y openssl zip unzip git 

RUN apt-get update && apt-get dist-upgrade -y && apt-get install -y gnupg

RUN curl -k https://packages.microsoft.com/keys/microsoft.asc | apt-key add -

RUN curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list

RUN apt-get update
RUN ACCEPT_EULA=Y apt-get install -y msodbcsql18
RUN ACCEPT_EULA=Y apt-get install -y mssql-tools18

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo

RUN apt-get -y install unixodbc-dev
RUN pecl install sqlsrv pdo_sqlsrv

RUN docker-php-ext-enable sqlsrv pdo_sqlsrv pdo

WORKDIR /app

COPY composer.json .
RUN composer install --no-scripts
COPY . .

CMD php artisan serve --host=0.0.0.0 --port=80