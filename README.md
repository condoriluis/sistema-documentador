# sistema-documentador

Este sistema está desarrollado con **Laravel 12** y está diseñado para documentar códigos y guías relacionadas con **Linux**, **instalación de Laravel desde cero**, y otras tecnologías. Permite crear, almacenar y visualizar documentos con configuraciones o guías, facilitando la documentación y el acceso rápido a información técnica.

## Características

-   **Interfaz intuitiva** para gestionar documentos.
-   **Cargar y visualizar documentos** con texto, código, y notas.
-   **Generación automática de archivos JSON** para cada documento creado.
-   **Sistema de autenticación** para acceder y administrar los documentos de manera segura.
-   **Soporte para varios tipos de contenido** como guías, códigos de configuración, y tutoriales.

## Uso

-   **1. Crear un documento:** Ingresa a la sección de "Nuevo Documento", proporciona el nombre, título, descripción y código, nota, y guarda el documento.
-   **2. Visualizar documentos:** Puedes acceder a la lista de documentos creados en la sección "Documentos" y visualizar sus detalles, descargar, editar o eliminar.
-   **3. Autenticación:** El sistema requiere autenticación para acceder a las funcionalidades de administración de documentos.

## Tecnologías Utilizadas

-   **Backend:** Laravel 12 (PHP)
-   **Base de Datos:** SQLite
-   **Frontend:** Blade, Bootstrap 5
-   **Autenticación:** Laravel Breeze
-   **Almacenamiento:** Archivos JSON para los documentos
-   **Editor de Código:** Prism.js para mostrar el código con resaltado de sintaxis

## Requisitos

Para correr este proyecto, necesitas tener instalados los siguientes requisitos:

-   **PHP** 8.1 o superior
-   **Composer**
-   **SQLite** para la base de datos
-   **Node.js** y **npm** para los assets frontend
-   **Laravel 12** como framework principal

## Instalación

Sigue estos pasos para instalar y ejecutar el proyecto:

### 1. Clonar el repositorio

```bash
git clone https://github.com/condoriluis/sistema-documentador.git
```

## 2. Instalar dependencias

```bash
cd sistema-documentador
composer install
npm install
```

## 3. Copia el archivo .env.example y renómbralo a .env

```bash
cp .env.example .env
```

## 4. Generar clave de aplicación

```bash
php artisan key:generate
```

## 5. Migrar la base de datos SQLite

```bash
php artisan migrate
```

## 6. Correr el servidor

```bash
composer run dev
```

o

```bash
php artisan serve
```

## Acceso al Sistema

Para acceder al sistema, tiene que registrase:

-   **Correo Electrónico:** Ingrese un correo electrónico.
-   **Contraseña:** Ingresa una contraseña de (8 caracteres como mínimo).
