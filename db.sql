-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2021 a las 18:47:51
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_users_stampy`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUser` (IN `uId` INT)  NO SQL
BEGIN
DELETE FROM users WHERE id = uId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllUsers` ()  BEGIN
SELECT * FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserById` (IN `uId` INT)  NO SQL
BEGIN
	SELECT * FROM users WHERE id=uId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserByMail` (IN `uEmail` VARCHAR(255))  NO SQL
BEGIN
	SELECT * FROM users WHERE email=uEmail;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUser` (IN `uEmail` VARCHAR(255), IN `uPassword` VARCHAR(255))  NO SQL
BEGIN
	INSERT INTO users (email, password) VALUES( uEmail,uPassword);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUser` (IN `uEmail` VARCHAR(255), IN `uPassword` VARCHAR(255), IN `uId` INT)  NO SQL
BEGIN
	UPDATE users SET email=uEmail, password=uPassword WHERE ID=uId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(89) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'default@sample.com', '$2y$10$G6Lh/ksgiSYy2TNye2PLNe0v.hzdbhL7pVKIKAypoXPxVzI2sCx1u');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
