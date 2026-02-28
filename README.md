# MVP · Test de Dones Espirituales (AVANCE 2020)

Proyecto base en **Laravel** + **Livewire v3** + **MySQL** para ejecutar el MVP del test sin login.

## Requisitos
- PHP 8.2+
- Composer
- Node 18+
- MySQL

## Instalación

1. Instalar dependencias de PHP:
   ```bash
   composer install
   ```
2. Copiar variables de entorno:
   ```bash
   cp .env.example .env
   ```
3. Configurar en `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=avance_dones
   DB_USERNAME=usuario
   DB_PASSWORD=clave
   ```
4. Generar la key de la aplicación:
   ```bash
   php artisan key:generate
   ```
5. Ejecutar migraciones y seed:
   ```bash
   php artisan migrate --seed
   ```
6. Instalar dependencias frontend:
   ```bash
   npm install
   ```
7. Compilar assets de producción del MVP:
   ```bash
   npm run build
   ```
8. Levantar servidor local:
   ```bash
   php artisan serve
   ```

Acceder a:

- http://127.0.0.1:8000/test

## Qué deja listo el seed
- 1 test
- 60 preguntas (placeholder)
- 20 dones
- Mapeo correcto (3 preguntas por don)

## Opcional: Importar preguntas reales
Si deseas reemplazar los textos de las preguntas:

```bash
php artisan avance:import-preguntas storage/app/preguntas.json
```

Formato esperado (JSON):

```json
[
  {"numero":1,"texto":"Texto real pregunta 1"},
  {"numero":2,"texto":"Texto real pregunta 2"}
]
```

## Producción
- Ejecutar `npm run build`
- Configurar `APP_ENV=production`
- Configurar `APP_DEBUG=false`

## Solución de problemas comunes

- **Error de permisos en `storage` o `bootstrap/cache`**
  ```bash
  chmod -R ug+rwx storage bootstrap/cache
  ```

- **Cambios de `.env` no se reflejan**
  ```bash
  php artisan config:clear
  php artisan cache:clear
  php artisan route:clear
  php artisan view:clear
  ```

- **La base de datos no conecta**
  - Verificar que MySQL esté encendido.
  - Confirmar valores `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
  - Reintentar migraciones:
    ```bash
    php artisan migrate --seed
    ```

- **Error de assets/frontend**
  ```bash
  rm -rf node_modules package-lock.json
  npm install
  npm run build
  ```
