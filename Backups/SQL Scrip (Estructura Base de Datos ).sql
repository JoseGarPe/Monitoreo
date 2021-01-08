CREATE DATABASE monitoreo
USE monitoreo


CREATE TABLE estados(
id_estado INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre VARCHAR(100)
)

CREATE TABLE accesos(
id_acceso INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre VARCHAR(250),
id_estado INT,
FOREIGN KEY (id_estado) REFERENCES estados(id_estado)
)

CREATE TABLE usuarios(
id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre VARCHAR(250),
username VARCHAR(100),
contrasena VARCHAR(250),
id_acceso INT,
id_estado INT,
FOREIGN KEY (id_acceso) REFERENCES accesos(id_acceso),
FOREIGN KEY (id_estado) REFERENCES estados(id_estado)
)

CREATE TABLE actividad(
id_actividad INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre VARCHAR(250),
id_estado INT,
FOREIGN KEY (id_estado) REFERENCES estados(id_estado)
)

CREATE TABLE hoja_asistencia(
id_hoja_asistencia INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
fecha DATE,
hora TIME,
id_actividad INT,
id_usuario INT,
FOREIGN KEY (id_actividad) REFERENCES actividad(id_actividad),
FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
)

CREATE TABLE t_departamentos (
id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
departamento varchar(400)
)

CREATE TABLE t_municipios (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
municipio VARCHAR(250),
id_depto INT,
FOREIGN KEY (id_depto) REFERENCES t_departamentos(id)
)

CREATE TABLE t_centros_educativos (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
codigo varchar(20),
nombre VARCHAR(250),
id_municipiio INT,
FOREIGN KEY (id_municipiio) REFERENCES t_municipios(id)
)

CREATE TABLE participantes(
id_participante INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
id_hoja_asistencia INT,
id_centro INT,
nombre VARCHAR(250),
edad INT,
FOREIGN KEY (id_hoja_asistencia) REFERENCES hoja_asistencia(id_hoja_asistencia),
FOREIGN KEY (id_centro) REFERENCES t_centros_educativos(id)
)




