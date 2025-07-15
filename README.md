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
npm run serve
```

El frontend estará disponible en:  
`http://localhost:8080`

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

<img width="2854" height="821" alt="image" src="https://github.com/user-attachments/assets/eb6f82bf-943a-43bd-b52c-222118a1e7c4" />
<img width="2882" height="1516" alt="image" src="https://github.com/user-attachments/assets/776a20e5-2289-4662-9c81-3e9e3f419681" />
<img width="2882" height="1516" alt="image" src="https://github.com/user-attachments/assets/b7cefabd-d448-4113-8f01-70f010d54c3d" />
<img width="2882" height="1516" alt="image" src="https://github.com/user-attachments/assets/29a2119c-a540-410e-bd20-84dcfba7296b" />
<img width="2882" height="1516" alt="image" src="https://github.com/user-attachments/assets/7f4fc8f4-aa0d-48e7-b6a7-eda5670b55af" />




---

## 👨‍💻 Autor

**Alexis Condor**  
[GitHub](https://github.com/Alexis06cs)

---

## 📄 Licencia

Este proyecto fue desarrollado como parte de una prueba técnica y puede ser usado libremente con fines académicos y de evaluación.
