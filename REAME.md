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
## ⚙️ Configura el backend 
-cd backend
- cp .env.example .env
- composer install
- php artisan key:generate

