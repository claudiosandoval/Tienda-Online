CREATE DATABASE proyecto_tienda;
USE proyecto_tienda;

CREATE TABLE usuarios(
id          INT(255) AUTO_INCREMENT NOT NULL,
nombre      VARCHAR(100) NOT NULL,
apellidos   VARCHAR(255),
email       VARCHAR(255) NOT NULL,
password    VARCHAR(255) NOT NULL,
rol         VARCHAR(20) NOT NULL,
imagen      VARCHAR(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO usuarios VALUE (NULL, 'Claudio', 'Sandoval', 'claudio@prueba.cl', '123', 'admin', NULL);

CREATE TABLE categorias(
id          INT(255) AUTO_INCREMENT NOT NULL,
nombre      VARCHAR(255) NOT NULL,
CONSTRAINT pk_categorias PRIMARY KEY(id)  
)ENGINE=InnoDb;

INSERT INTO categorias VALUE(NULL, 'Manga corta');
INSERT INTO categorias VALUE(NULL, 'Manga larga');
INSERT INTO categorias VALUE(NULL, 'Musculosas');
INSERT INTO categorias VALUE(NULL, 'Sudaderas');

CREATE TABLE productos(
id              INT(255) AUTO_INCREMENT NOT NULL,
categoria_id    INT(255) NOT NULL,
nombre          VARCHAR(255) NOT NULL,
descripcion     TEXT,
precio          FLOAT(100,2),
stock           INT(255) NOT NULL,
oferta          VARCHAR(2),
fecha           DATE NOT NULL,
imagen          VARCHAR(255),
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_productos_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;

CREATE TABLE pedidos(
id              INT(255) AUTO_INCREMENT NOT NULL,
usuario_id      INT(255) NOT NULL,
provincia       VARCHAR(100) NOT NULL,
localidad       VARCHAR(100) NOT NULL,
direccion       VARCHAR(255) NOT NULL,
coste           FLOAT(200, 2) NOT NULL,
estado          VARCHAR(20) NOT NULL,
fecha           DATE NOT NULL,
hora            TIME NOT NULL,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedidos_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos(
id              INT(255) AUTO_INCREMENT NOT NULL,
pedido_id       INT(255) NOT NULL,
producto_id     INT(255) NOT NULL,
unidades        INT(255) NOT NULL,
CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_lineas_pedidos_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_lineas_pedidos_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;