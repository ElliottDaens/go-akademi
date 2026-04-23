#!/usr/bin/env bash
set -e

# Créer .env depuis les variables Railway si absent
if [ ! -f .env ]; then
    echo "Création du .env depuis les variables d'environnement..."
    cat > .env << ENVEOF
APP_NAME="${APP_NAME:-Go Akadémi}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY:-}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL:-http://localhost}"
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
LOG_CHANNEL=stderr
LOG_LEVEL=error
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=file
FILESYSTEM_DISK=local
ADMIN_PASSWORD="${ADMIN_PASSWORD:-changeme}"
ENVEOF
fi

# Créer la base SQLite
mkdir -p database
touch database/database.sqlite

# Migrations
php artisan migrate --force --no-interaction

# Seeder si la table est vide
ROW_COUNT=$(php -r "
try {
    \$db = new PDO('sqlite:/var/www/html/database/database.sqlite');
    echo \$db->query('SELECT COUNT(*) FROM site_settings')->fetchColumn();
} catch (Exception \$e) { echo 0; }
")
if [ "$ROW_COUNT" = "0" ]; then
    echo "Seeding initial data..."
    php artisan db:seed --class=GoAkademiSeeder --force --no-interaction
fi

# Démarrer le serveur
echo "Démarrage sur le port ${PORT:-8000}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
