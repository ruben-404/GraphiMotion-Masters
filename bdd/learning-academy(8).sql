-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 22-11-2023 a les 20:16:46
-- Versió del servidor: 10.4.28-MariaDB
-- Versió de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `learning-academy`
--
CREATE DATABASE IF NOT EXISTS `learning-academy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `learning-academy`;

-- --------------------------------------------------------

--
-- Estructura de la taula `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `contrasenya` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `admin`
--

INSERT INTO `admin` (`id`, `Nom`, `contrasenya`) VALUES
(1, 'admin', '52e30e060520bb109b826f4abc0022322756b99481d89f1df7c1ef6dd1ad8913');

-- --------------------------------------------------------

--
-- Estructura de la taula `alumnes`
--

CREATE TABLE `alumnes` (
  `DNI` varchar(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Cognom` varchar(255) DEFAULT NULL,
  `Edad` date DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Contrasenya` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `alumnes`
--

INSERT INTO `alumnes` (`DNI`, `Nom`, `Cognom`, `Edad`, `Foto`, `Contrasenya`, `estado`) VALUES
('223456789', 'Juan', 'Jose', '2004-05-13', 'foto.jpg', 'd9921f63c75d3cd67f5ad908538586ab25d419cfb55ed76d452542f7a9d7baff', 1),
('323456789', 'Swain', 'Op', '2004-05-12', 'foto.jpg', 'd9921f63c75d3cd67f5ad908538586ab25d419cfb55ed76d452542f7a9d7baff', 1),
('54038366G', 'Ruben', 'Jimenez', '2004-06-29', '54038366G.jpg', 'd9921f63c75d3cd67f5ad908538586ab25d419cfb55ed76d452542f7a9d7baff', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `cursos`
--

CREATE TABLE `cursos` (
  `Codigo` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `NumeroHoras` int(11) DEFAULT NULL,
  `DataInici` date DEFAULT NULL,
  `Profe` varchar(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `DataFinal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `cursos`
--

INSERT INTO `cursos` (`Codigo`, `Nom`, `Foto`, `Descripcion`, `NumeroHoras`, `DataInici`, `Profe`, `Estado`, `DataFinal`) VALUES
(111111, 'Curso 1d', '111111.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 20, '2023-11-30', '55394660B', 1, '2024-01-06'),
(111112, 'Curso 2d', '111112.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl vel pretium lectus. Duis ultricies lacus sed turpis tincidunt id aliquet risus. Eget velit aliquet sagittis id consectetur purus ut faucibus pulvinar. Enim lobortis scelerisque fermentum dui faucibus in. Tortor at auctor urna nunc id cursus metus aliquam. Posuere morbi leo urna molestie at. ', 12, '2023-11-30', '55394660B', 1, '2023-12-29'),
(111113, 'curso 3d', '111113.jpg', 'Quis lectus nulla at volutpat diam ut. In iaculis nunc sed augue. Nunc sed id semper risus in hendrerit gravida rutrum quisque. Suspendisse ultrices gravida dictum fusce ut placerat orci nulla pellentesque. Convallis convallis tellus id interdum velit laoreet id donec. Viverra nam libero justo laoreet sit amet. Risus viverra adipiscing at in. Sit amet nisl suscipit adipiscing bibendum est ultricies. A condimentum vitae sapien pellentesque habitant morbi tristique senectus et.', 1, '2023-12-20', '91485948K', 1, '2024-02-15'),
(111114, 'Curso 4d', '111114.jpg', 'Tortor at auctor urna nunc id cursus metus aliquam. Posuere morbi leo urna molestie at. Quis lectus nulla at volutpat diam ut. In iaculis nunc sed augue. Nunc sed id semper risus in hendrerit gravida rutrum quisque. Suspendisse ultrices gravida dictum fusce ut placerat orci nulla pellentesque. Convallis convallis tellus id interdum velit laoreet id donec. Viverra nam libero justo laoreet sit amet. Risus viverra adipiscing at in. ', 4, '2023-12-08', '55394660B', 1, '2024-01-12');

-- --------------------------------------------------------

--
-- Estructura de la taula `curso_alumne`
--

CREATE TABLE `curso_alumne` (
  `curso` int(11) NOT NULL,
  `alumne` varchar(11) NOT NULL,
  `nota` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `curso_alumne`
--

INSERT INTO `curso_alumne` (`curso`, `alumne`, `nota`) VALUES
(111111, '223456789', NULL),
(111111, '323456789', NULL),
(111111, '54038366G', 10.00),
(111112, '223456789', NULL),
(111112, '323456789', NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `profes`
--

CREATE TABLE `profes` (
  `Dni` varchar(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Cognom` varchar(255) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `contrasenya` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `profes`
--

INSERT INTO `profes` (`Dni`, `Nom`, `Cognom`, `titol`, `foto`, `contrasenya`, `estado`) VALUES
('24620138H', 'Edgar', 'Fuentes', 'Titulo de intear', '24620138H.jpg', 'd9921f63c75d3cd67f5ad908538586ab25d419cfb55ed76d452542f7a9d7baff', 1),
('55394660B', 'Ruben', 'JimenezLopez', 'Master en lol', '55394660B.jpg', 'd9921f63c75d3cd67f5ad908538586ab25d419cfb55ed76d452542f7a9d7baff', 1),
('91485948K', 'Hugo', 'Varela', 'Diseño 3d', '91485948K.jpg', 'd9921f63c75d3cd67f5ad908538586ab25d419cfb55ed76d452542f7a9d7baff', 1);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`DNI`);

--
-- Índexs per a la taula `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `Profe` (`Profe`);

--
-- Índexs per a la taula `curso_alumne`
--
ALTER TABLE `curso_alumne`
  ADD PRIMARY KEY (`curso`,`alumne`),
  ADD KEY `alumne` (`alumne`);

--
-- Índexs per a la taula `profes`
--
ALTER TABLE `profes`
  ADD PRIMARY KEY (`Dni`);

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`Profe`) REFERENCES `profes` (`Dni`);

--
-- Restriccions per a la taula `curso_alumne`
--
ALTER TABLE `curso_alumne`
  ADD CONSTRAINT `curso_alumne_ibfk_1` FOREIGN KEY (`curso`) REFERENCES `cursos` (`Codigo`),
  ADD CONSTRAINT `curso_alumne_ibfk_2` FOREIGN KEY (`alumne`) REFERENCES `alumnes` (`DNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
