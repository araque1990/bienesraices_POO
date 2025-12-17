# Bienes Raíces POO

Proyecto de gestión de bienes raíces desarrollado con **PHP 8**, siguiendo el patrón de diseño **Active Record** y Programación Orientada a Objetos.

## 🚀 Tecnologías utilizadas
- **Backend:** PHP (POO, MVC, Active Record)
- **Base de Datos:** MySQL / MariaDB
- **Frontend:** SASS, Gulp, JavaScript
- **Herramientas:** Docker, Composer (Autoloading PSR-4), NPM

## 🛠️ Instalación

=======
Asegúrate de tener instalados **Docker**, **pnpm** y **Composer**.

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/araque1990/bienesraices_POO.git](https://github.com/araque1990/bienesraices_POO.git)
   cd bienesraices_POO

2. ** Instalar dependencias
    # PHP
    composer install
    # Frontend
    pnpm install

3. ** Despliegue con Docker
    docker-compose up -d

4. Base de Datos: Importa el archivo bienesraices_crud.sql incluido en la raíz para generar las tablas y datos de prueba.

├── admin/              # Panel de administración (CRUD)
├── classes/            # Modelos y Lógica de Negocio (Active Record)
├── includes/           # Configuración, funciones y templates
├── src/                # Archivos fuente (SASS, JS, Imágenes)
├── build/              # Archivos optimizados por Gulp (No se editan)
└── docker-compose.yml  # Configuración del entorno
