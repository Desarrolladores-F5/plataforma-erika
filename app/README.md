# 🎓 Plataforma Educativa — Erika Herrera
Plataforma web diseñada para la venta y gestión de cursos de Programación Neurolingüística (PNL) creados por la instructora **Erika Herrera**.  
Permite que estudiantes se registren, compren cursos y accedan a sus contenidos, mientras la administradora puede gestionar usuarios, cursos, módulos y materiales.

---

## ✨ Características principales

### 👤 **Autenticación y roles**
- Registro e inicio de sesión con Laravel Breeze.
- Sistema de roles:
  - **Administrador** (Erika): acceso total al panel administrativo.
  - **Alumno**: acceso a los cursos que ha comprado.
- Middleware personalizado para proteger rutas de administrador.

### 📚 **Gestión de cursos (Admin)**
*(En construcción — estructura base ya planificada)*  
El administrador podrá:
- Crear / editar / eliminar cursos.
- Crear módulos para cada curso.
- Agregar lecciones con texto, videos, PDF u otros materiales.
- Definir precios y categorías.
- Controlar el acceso de los alumnos.

### 🛒 **Flujo de compra (próximamente)**
El alumno podrá:
- Ver cursos disponibles.
- Revisar el detalle de cada curso.
- Comprar el curso (integración futura con WebPay/Stripe).
- Acceder a los cursos comprados desde su panel personal.

### 🎨 **Diseño personalizado**
- Paleta de colores corporativa.
- Tipografías oficiales utilizadas por Erika Herrera.
- Layouts limpios y profesionales con TailwindCSS.

---

## 🧱 Tecnologías utilizadas

- **PHP 8+**
- **Laravel 11**
- **Laravel Breeze (auth)**
- **Blade + TailwindCSS**
- **MySQL**
- **Composer**
- **Git / GitHub**

---

## 🔧 Requisitos del proyecto

- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js + NPM
- Extensiones PHP típicas (mbstring, openssl, pdo, etc.)

---

## 🚀 Instalación y ejecución

### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/Desarrolladores-F5/plataforma-erika.git
