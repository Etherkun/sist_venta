-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2022 a las 19:25:15
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_venta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cedula_rif` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `cedula_rif`, `telefono`, `direccion`, `estado`) VALUES
(2, 'José Alvarez', '20919612', '04249321145', 'Maturín, Estado Monagas', 1),
(3, 'Jose Guedez', '24339331', '04125659357', 'Santa Rosa, Estado Lara', 1),
(5, 'andreina perez', '9629717', '04164585427', 'cabudare', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_11_154619_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rodomax6@gmail.com', '$2y$10$9YfnISO/49rSUn4dpvaSrO4.SL//Kq2lDNP.rwXKfuP6RHG3e2noS', '2022-06-12 21:28:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `codigo` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(4000) COLLATE utf8_unicode_ci NOT NULL,
  `precio` float DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `img_producto` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `codigo`, `descripcion`, `precio`, `existencia`, `img_producto`, `id_sucursal`) VALUES
(12, '7087939', 'Cuerpo acelerador Fiat Palio Racing', 120, 7, '/storage/imagenes/16FZdbEN1RdU3HERmBarllgri3kn777OcQ4Zfohn.jpg', 1),
(16, '7084805', 'Regulador de Alternador Bosch 120 Amperios', 25, 7, '/storage/imagenes/Yo7xusPJBunIyNEDL3zaNlAnACe9jt7uCHZoYzDn.jpg', 3),
(17, '55190344', 'Juego gomas de válvulas motor 1.4cc Palio / Siena precio', 22, 18, '/storage/imagenes/uGIWr74ZmDUr76LZCVVsu7oxeDoZ4lijb2mRKkaE.jpg', 1),
(18, '00002', 'caucho', 1000, 11, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `rif_proveedor` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `rif_proveedor`, `direccion`, `descripcion`) VALUES
(1, 'REPUESTOS DUCATO CA', 'J-40017841-0', 'CALLE 51 ENTRE CARRERAS 27 Y 29, Barquisimeto 3001, Lara', 'Repuestos Fiat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `team_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'administrador', 'web', '2022-07-11 21:52:54', '2022-07-11 21:52:54'),
(2, NULL, 'vendedor', 'web', '2022-07-11 21:52:54', '2022-07-11 21:52:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `nombre`, `telefono`, `email`, `direccion`) VALUES
(1, 'A&A Multiservicios', '04267090250', 'agathabpace@hotmail.com', 'Barquisimeto'),
(3, 'P&P Multiservicios', '04245341720', 'rodomax6@gmail.com', 'Barquisimeto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Rodolfo Pace', 'rodomax6@gmail.com', NULL, '$2y$10$62OFIf0Su137uTsQX69a.ui1XZRnjWFL0Tb9pENWWGCszf1ZMOaf2', 'h5kvcfCQ3NuHgyCbJy1TTcdN9hq98adkIm5d5o3PQOePGKZYyMrxs43aCigP', '2022-05-18 03:55:14', '2022-05-18 03:55:14'),
(10, 'Dina Pace', 'rodolfoapace@gmail.com', NULL, '$2y$10$DN0Xpw8pUJdspJ0vN7LZgukTrNRh2iM9Llcfxynn1XuyrcM9tZVWi', NULL, '2022-07-11 21:59:12', '2022-07-11 21:59:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_bitacora`
--

CREATE TABLE `usuario_bitacora` (
  `id_bitacora` int(11) NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bitacora` varchar(4000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_bitacora` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_bitacora`
--

INSERT INTO `usuario_bitacora` (`id_bitacora`, `nombre_usuario`, `email_usuario`, `bitacora`, `fecha_bitacora`, `id_usuario`) VALUES
(2, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del usuario Alejandro Email: ygothehiddencity@gmail.com, en fecha: 2022-05-17 23:57:42', '2022-05-17 23:57:42', 0),
(3, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del cliente Jose Alvarez, Cédula / Rif: 20919612 en fecha: 2022-05-17 23:59:07', '2022-05-17 23:59:07', 0),
(4, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del cliente Jose Alvarez, Cédula / Rif: dkjdjked en fecha: 2022-05-18 00:03:39', '2022-05-18 00:03:39', 0),
(5, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del cliente Jose Alvarez, Cédula / Rif: 20919612 en fecha: 2022-05-18 00:04:55', '2022-05-18 00:04:55', 0),
(6, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro del cliente Jose Alvarez, Cédula / Rif: 20919612 en fecha: 2022-05-18 00:05:02', '2022-05-18 00:05:02', 0),
(7, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro de la sucursal A&A Multiservicios, en fecha: 2022-05-18 00:07:01', '2022-05-18 00:07:01', 0),
(8, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del producto 7084805 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:09:34', '2022-05-18 00:09:34', 0),
(9, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del producto 7084805 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:10:44', '2022-05-18 00:10:44', 0),
(10, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del producto 7084805 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:12:19', '2022-05-18 00:12:19', 0),
(11, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del producto 7084805 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:13:13', '2022-05-18 00:13:13', 0),
(12, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del producto 7084805 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:13:33', '2022-05-18 00:13:33', 0),
(13, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del producto 7084805 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:13:48', '2022-05-18 00:13:48', 0),
(14, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro del producto 7084805 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:13:51', '2022-05-18 00:13:51', 0),
(15, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del producto 3216765 - Acelerador, en fecha: 2022-05-18 00:14:18', '2022-05-18 00:14:18', 0),
(16, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del producto 3216765 - Acelerador, en fecha: 2022-05-18 00:14:59', '2022-05-18 00:14:59', 0),
(17, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro del producto 3216765 - Acelerador, en fecha: 2022-05-18 00:15:04', '2022-05-18 00:15:04', 0),
(18, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 213543 - Acelerador, en fecha: 2022-05-18 00:17:37', '2022-05-18 00:17:37', 0),
(19, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro del producto 213543 - Acelerador, en fecha: 2022-05-18 00:22:44', '2022-05-18 00:22:44', 0),
(20, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del producto 2344565 - Acelerador, en fecha: 2022-05-18 00:23:04', '2022-05-18 00:23:04', 0),
(21, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del producto 2344565 - Acelerador, en fecha: 2022-05-18 00:23:18', '2022-05-18 00:23:18', 0),
(22, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro del producto 2344565 - Acelerador, en fecha: 2022-05-18 00:24:40', '2022-05-18 00:24:40', 0),
(23, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del proveedor REPUESTOS DUCATO CA, Rif: 400178410, en fecha: 2022-05-18 00:27:28', '2022-05-18 00:27:28', 0),
(24, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del proveedor REPUESTOS DUCATO CA, Rif: 40017841-0, en fecha: 2022-05-18 00:27:44', '2022-05-18 00:27:44', 0),
(25, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del proveedor REPUESTOS DUCATO CA, Rif: j-40017841-0, en fecha: 2022-05-18 00:27:56', '2022-05-18 00:27:56', 0),
(26, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro modificó el registro del proveedor REPUESTOS DUCATO CA, Rif: J-40017841-0, en fecha: 2022-05-18 00:28:04', '2022-05-18 00:28:04', 0),
(27, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro del usuario José Hernández Email: gkawasoe@gmail.com, en fecha: 2022-05-18 00:28:49', '2022-05-18 00:28:49', 0),
(28, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del cliente José Alvarez, Cédula / Rif: V-20.919.612 en fecha: 2022-05-18 00:29:58', '2022-05-18 00:29:58', 0),
(29, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-18 00:30:38', '2022-05-18 00:30:38', 0),
(30, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro del producto 7082720 - Bendix de arranque Bosch Fiat Palio, en fecha: 2022-05-18 00:31:22', '2022-05-18 00:31:22', 0),
(31, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro creó un nuevo registro venta con el ID: 1, en fecha: 2022-05-18 00:32:33', '2022-05-18 00:32:33', 0),
(32, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro venta con el ID: 1, en fecha: 2022-05-18 00:33:48', '2022-05-18 00:33:48', 0),
(33, 'Alejandro', 'ygothehiddencity@gmail.com', '* Alejandro eliminó el registro del usuario Alejandro Email: ygothehiddencity@gmail.com, en fecha: 2022-05-18 00:34:07', '2022-05-18 00:34:07', 0),
(34, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-21 21:11:45', '2022-05-21 21:11:45', 0),
(35, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7082720 - Bendix de arranque Bosch Fiat Palio, en fecha: 2022-05-21 21:12:09', '2022-05-21 21:12:09', 0),
(36, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-22 16:29:18', '2022-05-22 16:29:18', 0),
(37, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-22 16:33:19', '2022-05-22 16:33:19', 0),
(38, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-22 16:33:37', '2022-05-22 16:33:37', 0),
(39, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-22 16:34:08', '2022-05-22 16:34:08', 0),
(40, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-22 16:35:33', '2022-05-22 16:35:33', 0),
(41, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 9084563 - Motor Fiat, en fecha: 2022-05-22 16:37:53', '2022-05-22 16:37:53', 0),
(42, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 1233244 - Motor, en fecha: 2022-05-22 16:41:28', '2022-05-22 16:41:28', 0),
(43, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del producto 1233244 - Motor, en fecha: 2022-05-22 16:42:19', '2022-05-22 16:42:19', 0),
(44, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 234234 - Motor Fiat, en fecha: 2022-05-22 16:44:07', '2022-05-22 16:44:07', 0),
(45, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del producto 234234 - Motor Fiat, en fecha: 2022-05-22 22:27:22', '2022-05-22 22:27:22', 0),
(46, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 1232442 - Motor, en fecha: 2022-05-22 22:27:37', '2022-05-22 22:27:37', 0),
(47, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 1232442 - Motor, en fecha: 2022-05-22 22:29:53', '2022-05-22 22:29:53', 0),
(48, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 1232442 - Motor, en fecha: 2022-05-22 22:31:35', '2022-05-22 22:31:35', 0),
(49, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 1232442 - Motor, en fecha: 2022-05-22 22:33:15', '2022-05-22 22:33:15', 0),
(50, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 1232442 - Motor, en fecha: 2022-05-23 17:14:38', '2022-05-23 17:14:38', 0),
(51, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del producto 1232442 - Motor, en fecha: 2022-05-23 17:19:06', '2022-05-23 17:19:06', 0),
(52, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 7087939 - Fiat Palio Racing, en fecha: 2022-05-24 18:13:18', '2022-05-24 18:13:18', 0),
(53, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Fiat Palio Racing, en fecha: 2022-05-24 18:15:00', '2022-05-24 18:15:00', 0),
(54, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-24 18:36:14', '2022-05-24 18:36:14', 0),
(55, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 7084805 - Regulador de Alternador Bosch 120 Amperios, en fecha: 2022-05-24 18:45:28', '2022-05-24 18:45:28', 0),
(56, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7084805 - Regulador de Alternador Bosch 120 Amperios, en fecha: 2022-05-24 18:49:24', '2022-05-24 18:49:24', 2),
(57, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7084805 - Regulador de Alternador Bosch 120 Amperios, en fecha: 2022-05-24 18:49:34', '2022-05-24 18:49:34', 2),
(58, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro de la sucursal eqweqw, en fecha: 2022-05-24 18:58:25', '2022-05-24 18:58:25', 2),
(59, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro de la sucursal eqweqw, en fecha: 2022-05-24 18:58:31', '2022-05-24 18:58:31', 2),
(60, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del usuario Rodes Email: dina@gmail.com, en fecha: 2022-05-24 19:02:11', '2022-05-24 19:02:11', 2),
(61, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del usuario Rodes Email: dina@gmail.com, en fecha: 2022-05-24 19:02:27', '2022-05-24 19:02:27', 2),
(62, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro venta con el ID: 2, en fecha: 2022-05-24 19:04:49', '2022-05-24 19:04:49', 2),
(63, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro de la sucursal P&P Multiservicios, en fecha: 2022-05-24 19:05:38', '2022-05-24 19:05:38', 2),
(64, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7084805 - Regulador de Alternador Bosch 120 Amperios, en fecha: 2022-05-24 19:06:05', '2022-05-24 19:06:05', 2),
(65, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7084805 - Regulador de Alternador Bosch 120 Amperios, en fecha: 2022-05-24 19:06:11', '2022-05-24 19:06:11', 2),
(66, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-24 19:07:14', '2022-05-24 19:07:14', 2),
(67, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro venta con el ID: 3, en fecha: 2022-05-24 19:07:55', '2022-05-24 19:07:55', 2),
(68, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-05-24 19:22:35', '2022-05-24 19:22:35', 2),
(69, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7084805 - Regulador de Alternador Bosch 120 Amperios, en fecha: 2022-05-24 19:22:44', '2022-05-24 19:22:44', 2),
(70, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del usuario Dina Pace Email: rodolfoapace@hotmail.com, en fecha: 2022-06-12 18:49:46', '2022-06-12 18:49:46', 2),
(71, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 55190344 - Juego gomas de válvulas motor 1.4cc Palio / Siena precio, en fecha: 2022-06-12 19:37:36', '2022-06-12 19:37:36', 2),
(72, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del cliente Jose Guedez, Cédula / Rif: 24339331 en fecha: 2022-06-12 19:58:47', '2022-06-12 19:58:47', 2),
(73, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro venta con el ID: 4, en fecha: 2022-06-12 20:01:26', '2022-06-12 20:01:26', 2),
(74, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro venta con el ID: 5, en fecha: 2022-06-27 13:45:16', '2022-06-27 13:45:16', 2),
(75, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del usuario Dina Pace Email: rodolfoapace@hotmail.com, en fecha: 2022-06-30 10:27:35', '2022-06-30 10:27:35', 2),
(76, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-06-30 10:29:05', '2022-06-30 10:29:05', 2),
(77, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del usuario ANDREINA PEREZ Email: andreina@gmail.com, en fecha: 2022-06-30 11:08:08', '2022-06-30 11:08:08', 2),
(78, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del usuario ANDREINA PEREZ Email: andreinaperez@gmail.com, en fecha: 2022-06-30 11:10:03', '2022-06-30 11:10:03', 2),
(79, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del cliente andreina perez, Cédula / Rif: 9629717 en fecha: 2022-06-30 11:11:08', '2022-06-30 11:11:08', 2),
(80, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del cliente andreina perez, Cédula / Rif: 9629717 en fecha: 2022-06-30 11:11:35', '2022-06-30 11:11:35', 2),
(81, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del producto 00002 - caucho, en fecha: 2022-06-30 11:18:40', '2022-06-30 11:18:40', 2),
(82, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro venta con el ID: 6, en fecha: 2022-06-30 11:20:22', '2022-06-30 11:20:22', 2),
(83, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro venta con el ID: 7, en fecha: 2022-06-30 11:24:30', '2022-06-30 11:24:30', 2),
(84, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del cliente José Alvarez, Cédula / Rif: V-20.919.612 en fecha: 2022-06-30 15:32:56', '2022-06-30 15:32:56', 2),
(85, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del cliente andreina perez, Cédula / Rif: 9629717 en fecha: 2022-06-30 15:33:02', '2022-06-30 15:33:02', 2),
(86, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del cliente José Alvarez, Cédula / Rif: 20919612 en fecha: 2022-06-30 15:33:17', '2022-06-30 15:33:17', 2),
(87, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del cliente andreina perez, Cédula / Rif: 9629717 en fecha: 2022-06-30 15:33:36', '2022-06-30 15:33:36', 2),
(88, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-06-30 20:26:12', '2022-06-30 20:26:12', 2),
(89, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 55190344 - Juego gomas de válvulas motor 1.4cc Palio / Siena precio, en fecha: 2022-06-30 20:29:26', '2022-06-30 20:29:26', 2),
(90, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del usuario ANDREINA PEREZ Email: andreinaperez@gmail.com, en fecha: 2022-06-30 20:37:33', '2022-06-30 20:37:33', 2),
(91, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del usuario ANDREINA PEREZ Email: andreina@gmail.com, en fecha: 2022-06-30 20:37:36', '2022-06-30 20:37:36', 2),
(92, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-06-30 20:43:50', '2022-06-30 20:43:50', 2),
(93, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-06-30 20:52:43', '2022-06-30 20:52:43', 2),
(94, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-06-30 20:54:23', '2022-06-30 20:54:23', 2),
(95, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 7087939 - Cuerpo acelerador Fiat Palio Racing, en fecha: 2022-06-30 20:55:55', '2022-06-30 20:55:55', 2),
(96, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del producto 55190344 - Juego gomas de válvulas motor 1.4cc Palio / Siena precio, en fecha: 2022-06-30 21:01:07', '2022-06-30 21:01:07', 2),
(97, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del usuario Rodolfo Pace Email: rodomax6e@gmail.com, en fecha: 2022-07-01 13:54:40', '2022-07-01 13:54:40', 2),
(98, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace eliminó el registro del usuario Rodolfo Pace Email: rodomax6e@gmail.com, en fecha: 2022-07-01 13:54:46', '2022-07-01 13:54:46', 2),
(99, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del cliente José Alvarez, Cédula / Rif: 20919612 en fecha: 2022-07-11 17:58:20', '2022-07-11 17:58:20', 2),
(100, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace modificó el registro del proveedor REPUESTOS DUCATO CA, Rif: J-40017841-0, en fecha: 2022-07-11 17:58:49', '2022-07-11 17:58:49', 2),
(101, 'Rodolfo Pace', 'rodomax6@gmail.com', '* Rodolfo Pace creó un nuevo registro del usuario Dina Pace Email: rodolfoapace@gmail.com, en fecha: 2022-07-11 17:59:12', '2022-07-11 17:59:12', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `total` float NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `total`, `fecha`, `id_usuario`, `id_cliente`, `id_sucursal`, `id_proveedor`) VALUES
(2, 300, '2022-05-24 19:04:49', 2, 2, 1, 1),
(3, 1500, '2022-05-24 19:07:55', 2, 2, 1, 1),
(4, 194, '2022-06-12 20:01:26', 2, 3, 1, 1),
(5, 344, '2022-06-27 13:45:16', 2, 2, 1, 1),
(6, 5000, '2022-06-30 11:20:22', 2, 4, 3, 1),
(7, 4125, '2022-06-30 11:24:30', 2, 4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_venta_producto` int(11) NOT NULL,
  `nombre_producto` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_producto` float NOT NULL,
  `subtotal_producto` float NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id_venta_producto`, `nombre_producto`, `cantidad_producto`, `precio_producto`, `subtotal_producto`, `id_venta`, `id_producto`) VALUES
(3, 'Regulador de Alternador Bosch 120 Amperios', 12, 25, 300, 2, 16),
(4, 'Cuerpo acelerador Fiat Palio Racing', 10, 150, 1500, 3, 12),
(5, 'Cuerpo acelerador Fiat Palio Racing', 1, 150, 150, 4, 12),
(6, 'Juego gomas de válvulas motor 1.4cc Palio / Siena precio', 2, 22, 44, 4, 17),
(7, 'Juego gomas de válvulas motor 1.4cc Palio / Siena precio', 2, 22, 44, 5, 17),
(8, 'Cuerpo acelerador Fiat Palio Racing', 1, 150, 150, 5, 12),
(9, 'Cuerpo acelerador Fiat Palio Racing', 1, 150, 150, 5, 12),
(10, 'caucho', 5, 1000, 5000, 6, 18),
(11, 'Regulador de Alternador Bosch 120 Amperios', 2, 25, 50, 7, 16),
(12, 'Regulador de Alternador Bosch 120 Amperios', 3, 25, 75, 7, 16),
(13, 'caucho', 4, 1000, 4000, 7, 18);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`,`cedula_rif`) USING BTREE;

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`team_id`,`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  ADD KEY `model_has_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `model_has_permissions_team_foreign_key_index` (`team_id`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`team_id`,`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  ADD KEY `model_has_roles_role_id_foreign` (`role_id`),
  ADD KEY `model_has_roles_team_foreign_key_index` (`team_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`,`codigo`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`,`rif_proveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_team_id_name_guard_name_unique` (`team_id`,`name`,`guard_name`),
  ADD KEY `roles_team_foreign_key_index` (`team_id`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuario_bitacora`
--
ALTER TABLE `usuario_bitacora`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `nombre_usuario` (`nombre_usuario`,`email_usuario`,`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`,`id_cliente`,`id_sucursal`,`id_proveedor`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id_venta_producto`),
  ADD KEY `id_venta` (`id_venta`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario_bitacora`
--
ALTER TABLE `usuario_bitacora`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
