# Usa la imagen base
FROM debian

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el código de tu aplicación al contenedor
COPY . .

# Establece los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Exponer puertos 80, 443
EXPOSE 80
EXPOSE 443
