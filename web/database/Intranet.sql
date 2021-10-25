CREATE DATABASE intranet;
USE intranet;



CREATE TABLE area (
  id_area int(10) auto_increment primary key,
  desc_area varchar(250) NOT NULL
);


CREATE TABLE privilegios (
  id_privilegio int(10) auto_increment primary key,
  desc_priv varchar(250) NOT NULL

);

CREATE TABLE usuarios (
  id_user int(10) auto_increment primary key,
  idPrivilegio int(11) NOT NULL,
  idArea int(11) NOT NULL,
  nombres varchar(250) NOT NULL,
  apellido_pat varchar(100) NOT NULL,
  apellido_mat varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  pass varchar(100) NOT NULL,
  telefono varchar(50) NOT NULL,
  tipo_doc int(5) NOT NULL,
  nro_doc char(20) NOT NULL,
  sexo int(1) NOT NULL,
  fecha_nacimiento date NOT NULL,
  pais varchar(100) NOT NULL,
  cod_tipoDonador int(10) DEFAULT NULL,
  estado tinyint(1) NOT NULL,
  fecha_registro datetime NOT NULL
); 



