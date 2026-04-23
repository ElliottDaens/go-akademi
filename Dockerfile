FROM php:8.4-cli-bookworm

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    zip \
    unzip \
    ca-certificates \
    gnupg \
    && docker-php-ext-install pdo pdo_sqlite zip \
    && rm -rf /var/lib/apt/lists/*

# Node.js 22 LTS
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Composer 2
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Installer les dépendances PHP (séparé pour profiter du cache Docker)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Copier tout le code
COPY . .

# Finaliser l'autoload et les scripts post-install
RUN composer dump-autoload --optimize --no-dev

# Build des assets front-end
RUN npm ci && npm run build

# Permissions
RUN chmod +x start.sh \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["bash", "start.sh"]
