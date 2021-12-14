CREATE DATABASE educalma;
USE educalma;

-- Tabla Usuarios
CREATE TABLE usuarios (
    id_user int(10) auto_increment primary key,
    privilegio int(1) not NULL, -- 1:administrador, 2: prof./mod, 3:user normal, 4:empresa(padre),5:user(hijo),superadmin:6
    padreEmpresa int(10) not NULL, -- solo para empresas
    hijoEmpresa int(10) not NULL, -- solo para empleados
    nombres varchar(250) not null,
	apellido_pat varchar(100) not null,
	apellido_mat varchar(100) not null,
    email varchar(100) not null,
    pass varchar(100) not null,
    telefono varchar(50) not null,
    tipo_doc int(5) not null, -- 1=DNI, 2=Pasaporte, 3=carné extranjería, 4=RUC
	nro_doc char(20) not null,
    sexo int(1) not null, -- 1 = Masculino, 2 = Femenino, 3=No binario, 4=prefiero no decir, 5=empresa
    fecha_nacimiento date not null,
    pais varchar(100) not null,
    cod_tipoDonador int(10),
    estado boolean not null, -- 0 = Inactivo, 1 = Activo
    fecha_registro datetime not null,
    mifoto longblob,
    token_password varchar(100) DEFAULT NULL,
    password_request int(11) NOT NULL DEFAULT '0' 
);

SELECT * FROM usuarios;
-- pass: July123456
INSERT INTO usuarios VALUES (1, 3, 0, 0, 'JULY', 'CASTILLO', 'BARRERA','j@gmail.com', '$2y$10$eC0Uu2bWV/Gqm1rjuB3oL.DnA8FaDkLpjF/.Wi8604GaLu1aN2/xG', '965478456', 1, '89475632', 2, '1992-07-28', 'PERÚ', 1, 1, now(), null, '', 0);

-- pass: Julio123456
INSERT INTO usuarios VALUES (2, 1, 0, 0, 'JULIO', 'CESAR', 'TELLO','tello@gmail.com', '$2y$10$tyWFJ1bWHdciAaxbGAk7uu.HIPoZw3uDKJJ4Rv7914wh6Hai9iroi', '954555784', 1, '55784952', 1, '1989-04-02', 'PERÚ', 1, 1, now(), null, '', 0);

-- pass: Marleni123456
INSERT INTO usuarios VALUES (3, 2, 0, 0, 'MARLENE', 'VASQUEZ', 'VERA','marlene@gmail.com', '$2y$10$apc7Qxi7dW5FRo0Ki9BOue2FRp/yfBWhiCeVnRAQGoNgxkMpvlMhy', '989874852', 1, '05554874', 2, '1980-03-18', 'PERÚ', 3, 1, now(), null, '', 0);

-- pass: Gloria123456
INSERT INTO usuarios VALUES (4, 2, 1, 0, 'GLORIA', 'SAC', 'LECHE','gloria@gloria.com', '$2y$10$4X1m7wnrbbuuOvqYRkd7gu26Xik2WpYZVQ/OVFvRC05gEp13yFQSa', '999874520', 4, '10554878920', 5, '1900-03-18', 'PERÚ', 1, 1, now(), null, '', 0);

-- pass: Estefany123456
INSERT INTO usuarios VALUES (5, 1, 0, 1, 'ESTEFANY', 'MATA', 'MATOS','estefany@gloria.com', '$2y$10$OGIZkqniYZsz1HQfcKdzfuNa0pyjYFGPB1K71uXrigk4ITw5xFJxW', '963259658', 1, '02698974', 2, '1990-01-05', 'PERÚ', 1, 1, now(), null, '', 0);

-- pass: nose XD
INSERT INTO usuarios VALUES (6, 1, 0, 1, 'MATA', 'MATA', 'MATOS','educalma@calma.com', '$2y$10$ZCyPSbUMoUa9C2vA3CNfR.caGn8Q2cc3Z1OFgH4rssGJu3JatBVGG', '963259658', 1, '02698974', 2, '1990-01-05', 'PERÚ', 1, 1, now(), null, '', 0);

-- Tabla Privilegio
CREATE TABLE privilegio (
    id_privilegio int(10) auto_increment primary key,
    nombre_privilegio varchar(100)
);

INSERT INTO privilegio VALUES (1,"ADMINISTRADOR");
INSERT INTO privilegio VALUES  (2, "PROFESOR");
INSERT INTO privilegio VALUES  (3, "USUARIO NORMAL");
INSERT INTO privilegio VALUES  (4, "EMPRESA");
INSERT INTO privilegio VALUES  (5, "USUARIO (EMPRESA)");
INSERT INTO privilegio VALUES  (6, "SUPERADMIN");

-- Tabla Curso inscrito
CREATE TABLE cursoInscrito (
    id_cursoInscrito int(10) auto_increment primary key,
    curso_id int(10) not null,
    usuario_id int(10) not null,
    cod_curso varchar(50) not null,
    curso_obt boolean not null,
    cantidad_respuestas int(11) not null
);

INSERT INTO cursoInscrito VALUES (1, 1, 3,'P 001',0,0);

-- Tabla de empresa
CREATE TABLE padreEmpresa (
    id_padreEmpresa int(10) auto_increment primary key,
    nombreEmpresa varchar(250) not null,
    cantidadHijos int(10) not null,
    nroRuc char(20) not null,
    direccion_fiscal varchar(250) not null
);

INSERT INTO padreEmpresa VALUES (1, 'GLORIA SAC', 150, '10554878920', 'Avenida Arequipa 2205 - La Molina');


-- Tabla Categorías
CREATE TABLE categorias (
    idCategoria int(10) auto_increment primary key,
    nombreCategoria varchar(250) not null
);

INSERT INTO categorias VALUES (1, 'Bullying');

-- Tabla Cursos
CREATE TABLE cursos (
    idCurso int(10) auto_increment primary key,
    nombreCurso varchar(250) not null,
    descripcionCurso char(250),
    categoriaCurso int(10) not null,
    dirigido varchar(250) not null,
    costoCurso varchar(250) not null,
    imagenDestacadaCurso longblob,
    permisoCurso int(1) not null,
    introduccion varchar(500) not null,
    id_userprofesor int(10) not null
);


-- Tabla Modulos 
CREATE TABLE modulo (
    idModulo int(10) auto_increment primary key,
    id_curso int(10) not null,
    nombreModulo varchar(250) not null,
    estado boolean not null
    
);


-- Tabla Temas
CREATE TABLE tema (
    idTema int(10) auto_increment primary key,
    id_modulo int(10) not null,
    nombreTema varchar(250) not null,
    descripcionTema text,
    link_video varchar(250) not null,
    encuestaTema varchar(250)
);


-- Tabla de Progreso de curso
CREATE TABLE progresoCurso (
    idProgresoCurso int(10) auto_increment primary key,
    cursoId_progreso int(10) not null,
    userId_progreso int(10) not null,
    porcentaje_progreso varchar(250),
    encuestaProgreso varchar(250)
);

INSERT INTO progresoCurso VALUES (1, 1, 3, '', '');

-- Tabla archivos descargables
CREATE TABLE descargables (
    idDescargable int(10) auto_increment primary key,
    idCurso_descargable int(10) not null,
    link_descargable varchar(250)
);


-- Tabla de Foro
CREATE TABLE comentarioforo (
    idcomentario int(10) auto_increment primary key,
    comentario varchar(500) not null,
    idcurso int(10) not null,
    nombreUser varchar(150) not null,
    fecha_ingreso datetime not null,
    estado int(1) not null,
    iduser int(10)
);
CREATE TABLE sub_come_foro (
    idsubcomentario int(10) auto_increment primary key,
    subcomentario varchar(500) not null,
    id_curso  int(10) not null,    
    user_men varchar(150) not null,
    idcomentario int(10) not null,
    fecha_ingreso datetime not null,
    estado int(1) not null,
    iduser int(10)
);


-- Tabla de Certificados
CREATE TABLE certificados (
    idCertificado int(10) auto_increment primary key,
    idCurso_certif int(10) not null,
    idUser_certif int(10) not null,
    fechaCurso_terminado date not null,
    codigo varchar(10)
);

-- Tabla Cuestionario curso
CREATE TABLE cuestionario (
    idCuestionario int(10) auto_increment primary key,
    id_modulo int(10) not null,
    puntaje int(10) not null,
    estado boolean not null
);

-- Tabla pregunta 
CREATE TABLE preguntas (
    idPregunta int(10) auto_increment primary key,
    pregunta varchar(250) not null,
    id_cuestionario int(10) not null
);

-- Tabla Respuesta 
CREATE TABLE respuestas (
    idRespuesta int(10) auto_increment primary key,
    respuesta varchar(250) not null,
    id_Pregunta int(10) not null,
    estado int(1) not null
);


-- Tabla Género
CREATE TABLE sexo (
	id_genero int(5) auto_increment primary key,
	nombre_genero varchar(250) not null
);

INSERT INTO sexo VALUES ('1', 'MASCULINO');
INSERT INTO sexo VALUES ('2', 'FEMENINO');
INSERT INTO sexo VALUES ('3', 'NO BINARIO');
INSERT INTO sexo VALUES ('4', 'PREFIERO NO DECIR');

-- Tabla Tipo Documento de Identidad
CREATE TABLE tipoDocumentoIdentidad (
	id_tipoDoc int(5) auto_increment primary key,
	nombre_tipoDoc varchar(250) not null,
	longitud_digitos int(20) not null
);

INSERT INTO tipoDocumentoIdentidad VALUES ('1', 'DNI', 8);
INSERT INTO tipoDocumentoIdentidad VALUES ('2', 'PASAPORTE', 11);
INSERT INTO tipoDocumentoIdentidad VALUES ('3', 'CARNE DE EXTRANJERIA', 8);

delimiter |
create trigger generar_codigo before insert on cursoinscrito for each row
    begin
        declare siguiente_codigo int;
        set siguiente_codigo =(Select ifnull(max(convert(substring(cod_curso, 3), signed integer)),0) from cursoinscrito)+1;
    set new.cod_curso=concat('P ',LPAD(siguiente_codigo,3,'0'));
end |