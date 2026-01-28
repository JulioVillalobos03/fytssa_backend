# 📱 FYTSSA – Backend API (Laravel)

Backend API desarrollada en **Laravel 12** para una aplicación móvil (**React Native + Expo**), enfocada en **autenticación multi-empresa**, gestión de usuarios y perfil, utilizando **tokens de acceso** con **Laravel Sanctum**.

Este proyecto fue construido como **prueba técnica**, priorizando buenas prácticas, claridad en el diseño de API y preparación para un entorno móvil real.

---

## 🚀 Stack Tecnológico

- **PHP 8.2**
- **Laravel 12**
- **MySQL**
- **Laravel Sanctum (API Tokens)**
- **REST API**
- **Storage local para imágenes**

---

## 🧠 Decisiones Técnicas Clave

### 🔐 Autenticación con Sanctum
Se implementó autenticación basada en **tokens Bearer**, ideal para aplicaciones móviles.  
No se utilizan sesiones ni cookies.

### 🏢 Multi-empresa
Cada usuario pertenece a una empresa (`company_id`).  
El **login y registro** requieren un `company_code`, permitiendo separar usuarios por organización.

### 👤 Perfil autenticado
El perfil se obtiene desde `/profile/me`, usando el usuario autenticado por token, sin exponer IDs en la URL.

### 🖼️ Subida de avatar
Se permite subir imagen de perfil mediante `multipart/form-data`, almacenada en `storage/app/public` y expuesta vía `php artisan storage:link`.

---

## 📂 Estructura del Proyecto

```
app/
├── Http/
│   └── Controllers/
│       └── Api/
│           ├── AuthController.php
│           ├── CompanyController.php
│           └── ProfileController.php
├── Models/
│   ├── User.php
│   └── Company.php
routes/
└── api.php
database/
├── migrations/
└── seeders/
```

---

## 🔑 Endpoints Principales

### 🏢 Empresas
```http
GET /api/companies
```

---

### 🔐 Registro
```http
POST /api/auth/register
```

**Body (JSON):**
```json
{
  "company_code": "empresa1",
  "name": "Nuevo Usuario",
  "email": "nuevo@empresa1.com",
  "password": "123456",
  "password_confirmation": "123456"
}
```

---

### 🔓 Login
```http
POST /api/auth/login
```

**Body (JSON):**
```json
{
  "company_code": "empresa1",
  "email": "nuevo@empresa1.com",
  "password": "123456"
}
```

---

### 🚪 Logout
```http
POST /api/auth/logout
```

---

### 👤 Perfil del usuario autenticado
```http
GET /api/profile/me
POST /api/profile/me
```

---

## 🗄️ Base de Datos

### Tablas principales
- **companies**
- **users**
- **personal_access_tokens**

---

## ⚙️ Instalación Local

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

---

## 👨‍💻 Autor

Prueba técnica – Backend Laravel para app móvil.
Julio Villalobos 
