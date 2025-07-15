# 🎬 Prueba Técnica - Sistema de Gestión de Películas y Turnos

Este proyecto es una aplicación web full stack construida con **Laravel 12** como backend y **Vue 3 + TailwindCSS** en el frontend. Permite gestionar un listado de películas y sus turnos de proyección de forma sencilla y moderna.

---

## 🚀 Tecnologías utilizadas

### Backend
- PHP 8.2+
- Laravel 12
- MySQL
- Eloquent ORM
- Controladores RESTful
- Migraciones y Seeders

### Frontend
- Vue 3
- Vite
- TailwindCSS
- Axios
- Componentes reutilizables

---

## 🎯 Funcionalidades principales

- CRUD completo de películas
- CRUD de turnos (asignables a películas)
- Estado de turno (activo/inactivo)
- Notificaciones (toast) y validaciones
- Confirmación antes de eliminar
- Spinner de carga para mejorar la experiencia
- Modal animado y reutilizable

---

## ⚙️ Requisitos previos

- PHP >= 8.2
- Composer
- Node.js >= 16
- MySQL / MariaDB
- Git

---

## 🛠️ Instalación paso a paso

### 🔧 1. Clonar el repositorio

```bash
git clone https://github.com/Alexis06cs/PruebaLaravel-Vue.git
cd PruebaLaravel-Vue
```

---

### 🗂 2. Configurar el Backend (Laravel 12)

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
```

🔒 Configura la conexión a la base de datos en el archivo `.env`:

```env
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=usuario
DB_PASSWORD=clave
```

▶️ Ejecuta migraciones y (opcionalmente) seeders:

```bash
php artisan migrate --seed
php artisan serve
```

La API estará disponible en:  
`http://127.0.0.1:8000/api`

---

### 🌐 3. Configurar el Frontend (Vue 3 + Vite)

```bash
cd ../frontend
cp .env.example .env
```

🔧 En `.env` configura la URL del backend:

```env
VITE_API_URL=http://127.0.0.1:8000/api
```

📦 Instalar dependencias y ejecutar el proyecto:

```bash
npm install
npm run dev
```

El frontend estará disponible en:  
`http://localhost:5173`

---

## 📂 Estructura del proyecto

```
PruebaLaravel-Vue/
├── backend/     # Laravel 12 (API REST)
│   ├── app/
│   ├── routes/api.php
│   └── database/
└── frontend/    # Vue 3 + Tailwind + Vite
    ├── src/
    │   ├── views/
    │   ├── components/
    │   └── services/
```

---

## 📸 Capturas (opcional)

Agrega aquí capturas de las pantallas principales si deseas.

---

## 👨‍💻 Autor

**Alexis Condor**  
[GitHub](https://github.com/Alexis06cs)

---

## 📄 Licencia

Este proyecto fue desarrollado como parte de una prueba técnica y puede ser usado libremente con fines académicos y de evaluación.
