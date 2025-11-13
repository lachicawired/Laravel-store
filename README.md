# 🕹️ TEAM6 - Tienda de Coleccionismo Premium

**TEAM6** es una plataforma web desarrollada en **Laravel** que conecta a coleccionistas de México con artículos exclusivos del extranjero.  
El sistema incluye gestión de productos, carrito de compras, autenticación de usuarios, panel de administrador y un sistema de encargos personalizados (*Custom Orders*).

[![image-2025-11-12-195547149.png](https://i.postimg.cc/NG4X3kdp/image-2025-11-12-195547149.png)](https://postimg.cc/c6v6Ywyn)
[![image-2025-11-12-195838494.png](https://i.postimg.cc/2SvSDzCP/image-2025-11-12-195838494.png)](https://postimg.cc/tsqjdGZ5)
[![image-2025-11-12-195945909.png](https://i.postimg.cc/43PZfyqP/image-2025-11-12-195945909.png)](https://postimg.cc/4KYjwfJH)
[![image-2025-11-12-200032996.png](https://i.postimg.cc/hPmBJpND/image-2025-11-12-200032996.png)](https://postimg.cc/QHjPwkXw)
[![image-2025-11-12-200141621.png](https://i.postimg.cc/13P3sk4g/image-2025-11-12-200141621.png)](https://postimg.cc/RNsBTb79)
[![image-2025-11-12-200231421.png](https://i.postimg.cc/rsxqLjkr/image-2025-11-12-200231421.png)](https://postimg.cc/4HfD6znf)
[![image-2025-11-12-200325403.png](https://i.postimg.cc/FHDNm123/image-2025-11-12-200325403.png)](https://postimg.cc/pmhgJVVL)
<img width="3093" height="1608" alt="image" src="https://github.com/user-attachments/assets/a32d4163-ff55-46b9-a7c7-50f2facd5799" />
<img width="3083" height="1595" alt="image" src="https://github.com/user-attachments/assets/507f3d66-22ab-4ed9-8d52-4d053b6b1909" />




---

## 🚀 Características

- 🛍️ **Catálogo de productos** con imágenes, precios y descripciones.
- 🧾 **Carrito de compras y sistema de stock** con persistencia en sesión.
- 🔐 **Autenticación de usuarios** (registro e inicio de sesión con roles).
- 🧑‍💼 **Panel de administración** para gestionar productos, usuarios y pedidos.
- 📦 **Sistema de encargos personalizados** donde los usuarios pueden solicitar artículos específicos.
- 📸 Vista de administrador para ver los encargos con imágenes, precios y país de origen.
- 🧠 Desarrollado con **Laravel 10** y **Bootstrap 5**.

---

## ⚙️ Instalación y Configuración

### 1️⃣ Clona el repositorio
```bash


git clone https://github.com/tuusuario/team6.git
cd team6


3️⃣ Instala dependencias de JavaScript
npm install && npm run build

4️⃣ Crea tu archivo .env

Copia el archivo de ejemplo y configura tus variables:

cp .env.example .env


Abre .env y actualiza:

APP_NAME=TEAM6
APP_URL=http://localhost
DB_DATABASE=team6
DB_USERNAME=root
DB_PASSWORD= (tu contraseña)


Luego genera la clave de aplicación:

php artisan key:generate

5️⃣ Ejecuta las migraciones
php artisan migrate


(Opcional) Población de datos de prueba:

php artisan db:seed

6️⃣ Inicia el servidor local
php artisan serve


Abre en tu navegador:

http://localhost:8000

🧩 Estructura principal
app/
 ├── Http/
 │   ├── Controllers/
 │   │   ├── ProductController.php
 │   │   ├── CartController.php
 │   │   ├── AdminController.php
 │   │   └── CustomOrderController.php
 │   └── Middleware/
 ├── Models/
 │   ├── Product.php
 │   ├── Order.php
 │   ├── User.php
 │   └── CustomOrder.php
resources/
 ├── views/
 │   ├── layouts/app.blade.php
 │   ├── products/index.blade.php
 │   ├── custom-orders/create.blade.php
 │   ├── admin/custom-orders.blade.php
 │   └── about.blade.php
routes/
 └── web.php
[![image-2025-11-12-195547149.png](https://i.postimg.cc/NG4X3kdp/image-2025-11-12-195547149.png)](https://postimg.cc/c6v6Ywyn)
