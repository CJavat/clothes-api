# Clothes API

## Configuración de proyecto

1. Instalar las dependencias con `composer install`.
2. Configurar las variables de la base de datos en la carpeta `\src\config\database.php`.
3. Arrancar el servidor con

```
php -S localhost:8081 -t src
```

<!-- Notas -->

#### Para cargar en Composer los namespace y constantes globales personalizados
1. En _psr-4_ agregar los namespaces
```
"psr-4": {
  "app\\business\\category\\": "src/business/category/",
  "app\\business\\cloth\\": "src/business/cloth/",
  "app\\database\\": "src/database/",
  "app\\exceptions\\": "src/exceptions/",
  "app\\interfaces\\": "src/interfaces/",
  "app\\validators\\": "src/validators/"
}
```
2. En _files_ agregar los `archivos PHP`
```
"files": [
  "src/config/database.php"
]
```
3. Correr el siguiente comando para actualizar los archivos
```
composer dump-autoload
```

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

CREATE TABLE clothes (
  `id` VARCHAR(50) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `fabric` VARCHAR(45) NULL,
  `category_id` VARCHAR(50) NULL,

  PRIMARY KEY (`id`)
);

CREATE TABLE categories (
  `id` VARCHAR(50) NOT NULL,
  `name` VARCHAR(100) NOT NULL,

  PRIMARY KEY (`id`)
);

ALTER TABLE clothes
ADD CONSTRAINT fk_clothe_category
FOREIGN KEY (category_id)
REFERENCES categories(id)
ON DELETE CASCADE
ON UPDATE CASCADE;

```
