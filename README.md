# Hexagonal Library

<p align="center">
<a href="https://packagist.org/packages/alexisirala/hexagonal-library"><img src="https://img.shields.io/packagist/dt/alexisirala/hexagonal-library" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/alexisirala/hexagonal-library"><img src="https://img.shields.io/packagist/v/alexisirala/hexagonal-library" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/alexisirala/hexagonal-library"><img src="https://img.shields.io/packagist/l/alexisirala/hexagonal-library" alt="License"></a>
</p>

## Descripción

Hexagonal Library es una API diseñada con la arquitectura hexagonal, proporcionando una estructura limpia y mantenible. Esta API permite gestionar una biblioteca de libros, autores, y categorías de manera eficiente.

## Funcionalidades

- **Gestión de Libros**: Crear, leer, actualizar y eliminar información de los libros.
- **Gestión de Autores**: Crear, leer, actualizar y eliminar información de los autores.
- **Gestión de Categorías**: Crear, leer, actualizar y eliminar información de las categorías.
- **Búsqueda Avanzada**: Permite realizar búsquedas avanzadas mediante filtros y paginación.
- **Autenticación y Autorización**: Soporte para autenticación de usuarios y control de acceso basado en roles.

## Requisitos Previos

- PHP >= 7.4
- Composer
- MySQL o cualquier otro sistema de base de datos compatible

## Instalación

1. Clona el repositorio:

    ```bash
    git clone https://github.com/alexisirala/Hexagonal-library.git
    cd Hexagonal-library
    ```

2. Instala las dependencias:

    ```bash
    composer install
    ```

3. Configura el archivo `.env` con tus credenciales de base de datos. Utiliza el archivo de ejemplo `.env.example` para guiarte:

    ```bash
    cp .env.example .env
    ```

4. Genera la clave de la aplicación:

    ```bash
    php artisan key:generate
    ```

5. Ejecuta las migraciones para crear las tablas en la base de datos:

    ```bash
    php artisan migrate
    ```

6. Opcionalmente, puedes poblar la base de datos con datos de prueba:

    ```bash
    php artisan db:seed
    ```

## Uso

Para iniciar el servidor de desarrollo, ejecuta:

    ```bash
    php artisan serve
    ```

Accede a la API en `http://localhost:8000`.

## Endpoints Principales

### Libros

- `GET /api/books`: Listar todos los libros.
- `GET /api/books/{id}`: Obtener un libro por ID.
- `POST /api/books`: Crear un nuevo libro.
- `PUT /api/books/{id}`: Actualizar un libro existente.
- `DELETE /api/books/{id}`: Eliminar un libro.

### Autores

- `GET /api/authors`: Listar todos los autores.
- `GET /api/authors/{id}`: Obtener un autor por ID.
- `POST /api/authors`: Crear un nuevo autor.
- `PUT /api/authors/{id}`: Actualizar un autor existente.
- `DELETE /api/authors/{id}`: Eliminar un autor.

### Categorías

- `GET /api/categories`: Listar todas las categorías.
- `GET /api/categories/{id}`: Obtener una categoría por ID.
- `POST /api/categories`: Crear una nueva categoría.
- `PUT /api/categories/{id}`: Actualizar una categoría existente.
- `DELETE /api/categories/{id}`: Eliminar una categoría.

## Contribuir

Si deseas contribuir a este proyecto, por favor sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commits (`git commit -am 'Añadir nueva funcionalidad'`).
4. Sube tus cambios (`git push origin feature/nueva-funcionalidad`).
5. Crea un nuevo Pull Request.

## Licencia

Hexagonal Library está licenciado bajo la [MIT License](https://opensource.org/licenses/MIT). 
