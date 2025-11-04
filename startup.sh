#!/bin/bash
# Script de inicio para Azure App Service con Laravel (Nginx)
# Configura Nginx para servir la carpeta public/

# Elimina el directorio html predeterminado (si existe)
rm -rf /home/site/wwwroot/html

# Crea un enlace simbólico para que Nginx apunte a public/
ln -s /home/site/wwwroot/public /home/site/wwwroot/html

# Inicia Nginx en primer plano
nginx -g "daemon off;"
