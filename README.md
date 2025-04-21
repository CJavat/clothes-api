# Clothes API

## Configuración de proyecto

1. Instalar las dependencias con `composer install`.
2. Configurar las variables de la base de datos en la carpeta `\src\config\database.php`.
3. Arrancar el servidor con

```
php -S localhost:8081 -t src
```

<!-- Notas -->

#### Forma de usar UUID

```
use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();
echo $uuid->toString();
```

#### Creación de la base de datos

```
CREATE DATABASE IF NOT EXISTS clothes_api;

USE clothes_api;

CREATE TABLE clothe (
  `id` VARCHAR(50) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `fabric` VARCHAR(45) NULL,
  `category_id` VARCHAR(50) NULL,

  PRIMARY KEY (`id`)
);

CREATE TABLE category (
  `id` VARCHAR(50) NOT NULL,
  `name` VARCHAR(100) NOT NULL,

  PRIMARY KEY (`id`)
);

ALTER TABLE clothe
ADD CONSTRAINT fk_clothe_category
FOREIGN KEY (category_id)
REFERENCES category(id)
ON DELETE CASCADE
ON UPDATE CASCADE;

```
