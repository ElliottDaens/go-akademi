#!/usr/bin/env bash
set -e

# Créer la base SQLite si elle n'existe pas encore
mkdir -p database
touch database/database.sqlite

# Générer la clé si absente (ne devrait pas arriver avec APP_KEY en variable Railway)
php artisan key:generate --no-interaction --force 2>/dev/null || true

# Optimiser pour la production
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

# Appliquer les migrations
php artisan migrate --force --no-interaction

# Seeder les données de base
php artisan db:seed --class=GoAkademiSeeder --force --no-interaction

# Démarrer le serveur
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
