# Proyecto Symfony - Gestión de Productos y Pedidos

## Requisitos Principales

- **PHP**: >=7.2.5
- **Symfony**: 5.4.99

## Instalación

1. **Clonar el repositorio**
    ```bash
    git clone <https://github.com/barrtrav/tienda_online>
    cd <tienda_online>
    ```

2. **Instalar dependencias**
    ```bash
    composer install
    ```

3. **Configurar las variables de entorno**
    Copia el archivo `.env` y renómbralo como `.env.local`. Luego, ajusta los valores según tu configuración local.

    ```bash
    cp .env .env.local
    ```

## Base de Datos

1. **Crear la base de datos**
    ```bash
    php bin/console doctrine:database:create
    ```

2. **Ejecutar migraciones**
    ```bash
    php bin/console doctrine:migrations:migrate
    ```

3. **Generar datos falsos**
    ```bash
    php bin/console doctrine:fixtures:load
    ```

## Servidor de Desarrollo

Para iniciar el servidor de desarrollo, ejecuta el siguiente comando:
```bash
php -S 127.0.0.1:8000 -t public
```

## CRUDs y Rutas

**Productos**

* Crear Producto: /products/new

* Listar Productos: /products

* Mostrar Producto: /products/{id}

* Editar Producto: /products/{id}/edit

* Eliminar Producto: Formulario en /products/{id}

**Pedidos**

* Crear Pedido: /order/new

* Listar Pedidos: /order

* Mostrar Pedido: /order/{id}

* Editar Pedido: /order/{id}/edit

* Eliminar Pedido: Formulario en /order/{id}

**Almacenes**

* Crear Almacén: /warehouse/new

* Listar Almacenes: /warehouse

* Mostrar Almacén: /warehouse/{id}

* Editar Almacén: /warehouse/{id}/edit

* Eliminar Almacén: Formulario en /warehouse/{id}

**CD**

* Crear CD: /distribution/center/new

* Listar CD: /distribution/center

* Mostrar CD: /distribution/center/{id}

* Editar CD: /distribution/center/{id}/edit

* Eliminar CD: Formulario en /distribution/center/{id}

**Bolsas**

* Crear Bolsas: /bag/new

* Listar Bolsas: /bag

* Mostrar Bolsas: /bag/{id}

* Editar Bolsas: /bag/{id}/edit

* Eliminar Bolsas: Formulario en /bag/{id}

**Recepcion de Bolsas**

* Crear Recepcion de Bolsas: /bag/reception/new

* Listar Recepcion de Bolsas: /bag/reception

* Mostrar Recepcion de Bolsas: /bag/reception/{id}

* Editar Recepcion de Bolsas: /bag/reception/{id}/edit

* Eliminar Recepcion de Bolsas: Formulario en /bag/reception/{id}