FROM php:7.4-cli
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_sqlite
WORKDIR /app
COPY . /app
CMD ["php", "-S", "0.0.0.0:8000"]
