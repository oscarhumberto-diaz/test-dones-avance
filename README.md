# MVP · Test de Dones Espirituales (AVANCE 2020)

Proyecto en **Laravel 12 + Livewire 3 + MySQL + Tailwind + DaisyUI + Vite**.

## Alcance MVP
- Sin login.
- Wizard en `/test` (10 preguntas por página, 6 páginas).
- Campo obligatorio `nombre_persona`.
- Resultado en `/resultado/{attempt}` con Top 3 y tabla completa.
- Seed inicial con 1 test, 60 preguntas placeholder y 20 dones (3 preguntas por don).

## Requisitos
- PHP 8.2+
- Composer
- Node 18+
- MySQL 8+

## Instalación
```bash
composer install
cp .env.example .env
# Configura DB_* para MySQL en .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Abrir: `http://127.0.0.1:8000/test`

## Importar preguntas reales (opcional)
```bash
php artisan avance:import-preguntas storage/app/preguntas.json
```

Formato esperado JSON:
```json
[
  {"numero": 1, "texto": "Texto real 1"},
  {"numero": 2, "texto": "Texto real 2"}
]
```

Se incluye ejemplo en: `storage/app/preguntas.example.json`.

## Pruebas
```bash
php artisan test
```
