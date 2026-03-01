FROM php:8.3-cli

# Встановлюємо git та unzip
RUN apt-get update && apt-get install -y \
    git \
    unzip

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /app

# Копіюємо файли проєкту
COPY . .

# Встановлюємо залежності
RUN composer install

CMD ["php", "-a"]
