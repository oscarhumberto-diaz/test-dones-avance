# MVP · Test de Dones Espirituales (AVANCE 2020)

Proyecto base en **Laravel (última versión estable)** + **Livewire v3** + **MySQL**, sin login.

## Funcionalidades incluidas
- Ruta pública del test: `/test`
- Campo obligatorio de nombre completo
- 60 preguntas con escala `0,1,2,3`
- Navegación paginada (10 preguntas por página)
- Persistencia en MySQL de intento y respuestas
- Cálculo de 20 dones (3 preguntas por don)
- Resultado en `/resultado/{id}` con Top 3 y tabla completa
- UI con Tailwind + DaisyUI (responsive)

## Requisitos
- PHP 8.2+
- Composer
- Node.js 20+
- MySQL 8+

## Cómo correr el proyecto
1. Instalar dependencias PHP:
   ```bash
   composer install
   ```
2. Copiar variables de entorno:
   ```bash
   cp .env.example .env
   ```
3. Configurar DB MySQL en `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
4. Generar key:
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
7. Compilar assets:
   ```bash
   npm run dev
   ```
8. Levantar servidor:
   ```bash
   php artisan serve
   ```

## Importar textos de preguntas (opcional)
Se incluye el comando:

```bash
php artisan avance:import-preguntas {path}
```

- Soporta archivos **JSON** o **CSV**.
- Debe incluir campos/columnas: `numero`, `texto`.
- Actualiza `questions.texto` por `numero` para el test **"Test de Dones Espirituales (AVANCE 2020)"**.

### Ejemplo JSON
Archivo de referencia: `examples/preguntas.json`

```json
[
  {"numero": 1, "texto": "Texto actualizado de la pregunta 1"},
  {"numero": 2, "texto": "Texto actualizado de la pregunta 2"}
]
```

### Ejemplo CSV
```csv
numero,texto
1,"Texto actualizado de la pregunta 1"
2,"Texto actualizado de la pregunta 2"
```

## Notas de implementación
- Cada don suma 3 respuestas (rango 0..9) y se transforma a puntaje final multiplicando por `3`.
- El resultado final destaca los 3 dones con mayor puntuación.
- La semilla `SpiritualGiftsSeeder` crea 60 preguntas, 20 dones y su mapeo exacto (3 preguntas por don).
