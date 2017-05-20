-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-05-2017 a las 18:49:30
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: BibliotecaPrestamos
--


--
-- Estructura de tabla para la tabla 'Libros'
--

CREATE TABLE IF NOT EXISTS Libros (
  IdLibro int(11) NOT NULL,
  Referencia varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  Titulo varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  Autor varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  Categoria varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  Estado int(11) NOT NULL COMMENT '0: Disponible, 1:Prestado, 2:Con Deuda'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'Libros'
--

INSERT INTO Libros (IdLibro, Referencia, Titulo, Autor, Categoria, Estado) VALUES
(1, 'GKF-0340', 'El Caballero de la Armadura Oxidada', 'Cesc', 'Fantasia', 0),
(2, 'BR-54', 'El perfume', 'Paulo Cohelo', 'Comedia', 0),
(3, 'JK-49', 'Una noche en la selva', 'Davincci', 'Terror', 0),
(4, 'TT-554', 'Teoria del big ban', 'Esce', 'Ciencia Ficcion', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'Prestamos'
--

CREATE TABLE IF NOT EXISTS Prestamos (
  IdPrestamo int(11) NOT NULL,
  IdLibro int(11) NOT NULL,
  IdUsuario int(11) NOT NULL,
  FechaPrestamo date NOT NULL,
  FechaDevolucion date NOT NULL,
  Estado int(11) NOT NULL COMMENT '0: Estado Normal, 1: Sobrepaso fechas, 2: Cerrado'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'Prestamos'
--

INSERT INTO Prestamos (IdPrestamo, IdLibro, IdUsuario, FechaPrestamo, FechaDevolucion, Estado) VALUES
(1, 1, 1, '2017-08-31', '2017-09-09', 2),
(2, 2, 2, '2017-08-31', '2017-10-15', 2),
(3, 1, 4, '2017-08-31', '2017-09-10', 2),
(4, 4, 3, '2016-08-29', '2016-08-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'Usuarios'
--

CREATE TABLE IF NOT EXISTS Usuarios (
  idUsuario int(11) NOT NULL,
  Identificacion varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  Nombre varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  Apellidos varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  Email varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  Telefono varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  Estado int(11) NOT NULL COMMENT '0: Disponible, 1: Ocupado, 2: Deudor'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'Usuarios'
--

INSERT INTO Usuarios (idUsuario, Identificacion, Nombre, Apellidos, Email, Telefono, Estado) VALUES
(1, '1000443942', 'Cesar Augusto', 'Castro Rojas', 'cesar.casrojas@gmail.com', '3014536455', 0),
(2, '21667673', 'Milton', 'Castillo', 'Castillo@hotmail.com', '2921766', 0),
(3, '3451911', 'Sofia', 'Gonzales', 'sofiagonji.com', '4554365', 0),
(4, '8128372', 'Juan David', 'Monsalve', 'Juanda@gmail.com', '3554354', 0),
(5, '657689', 'Maria', 'Cano', 'Maria@macano.com', '545454', 0),
(6, '5460669', 'Jose', 'Restrepo', 'Jose@joseRestrepo.com', '5993059', 0),
(7, '545454', 'Camilo', 'Londoba', 'camilo@camilo.com', '4456454', 0),
(8, '39304954', 'Andres', 'Restrepo', 'andres@gmail.com', '45949300', 0),
(9, '6598785', 'Camila', 'Suarez', 'cami@hotmail.com', '565776', 0),
(10, '9982983', 'Yessi', 'Moreno', 'Yessi@gmail.com', '89393848', 0),
(11, '56783599', 'Luis', 'Zapata', 'luzapata@hotmail.com', '3442040', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla 'Libros'
--
ALTER TABLE Libros
  ADD PRIMARY KEY (IdLibro);

--
-- Indices de la tabla 'Prestamos'
--
ALTER TABLE Prestamos
  ADD PRIMARY KEY (IdPrestamo);

--
-- Indices de la tabla Usuarios
--
ALTER TABLE Usuarios
  ADD PRIMARY KEY (idUsuario);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla Libros
--
ALTER TABLE Libros
  MODIFY IdLibro int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla Prestamos
--
ALTER TABLE Prestamos
  MODIFY IdPrestamo int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla Usuarios
--
ALTER TABLE Usuarios
  MODIFY idUsuario int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
