#!/bin/sh
set -eu

# O PHP-FPM roda como www-data, enquanto o bind mount pertence ao usuário do
# host. Garante que apenas os diretórios de upload possam ser escritos pelo PHP.
upload_root=/var/www/public/barista/assets

mkdir -p \
    "$upload_root/banner" \
    "$upload_root/cliente" \
    "$upload_root/galeria" \
    "$upload_root/produto" \
    "$upload_root/usuarios"

chmod 0777 \
    "$upload_root/banner" \
    "$upload_root/cliente" \
    "$upload_root/galeria" \
    "$upload_root/produto" \
    "$upload_root/usuarios"

exec docker-php-entrypoint "$@"
