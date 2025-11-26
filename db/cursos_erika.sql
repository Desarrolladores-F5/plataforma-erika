-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2025 a las 22:20:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursos_erika`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(24) NOT NULL,
  `pdf_path` varchar(400) DEFAULT NULL,
  `issued_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `course_id`, `code`, `pdf_path`, `issued_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'EH-TEST-0001', NULL, '2025-10-16 11:50:08', '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `subject` varchar(190) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `type` enum('porcentaje','monto') NOT NULL DEFAULT 'porcentaje',
  `value` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `uses` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `active`, `valid_from`, `valid_to`, `max_uses`, `uses`, `created_at`, `updated_at`) VALUES
(1, 'BIENVENIDA10', 'porcentaje', 10, 1, '2025-10-16 11:50:08', '2026-01-16 11:50:08', 100, 0, '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(180) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `short_desc` text DEFAULT NULL,
  `long_desc` longtext DEFAULT NULL,
  `price_clp` int(11) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `cover_url` varchar(500) DEFAULT NULL,
  `access_months` tinyint(3) UNSIGNED NOT NULL DEFAULT 6,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `short_desc`, `long_desc`, `price_clp`, `published`, `cover_url`, `access_months`, `created_at`, `updated_at`) VALUES
(1, 'Aprendizaje y Desarrollo Personal', 'aprendizaje-desarrollo-personal', 'Programa práctico de autoconocimiento y comunicación.', 'Descripción extensa del curso con objetivos, contenidos y resultados esperados.', 79990, 1, 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200&q=80', 6, '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `enrolled_at` datetime NOT NULL DEFAULT current_timestamp(),
  `expires_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `active`, `enrolled_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2025-10-16 11:50:08', '2026-04-16 11:50:08', '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(180) NOT NULL,
  `type` enum('video','texto') NOT NULL DEFAULT 'video',
  `video_url` varchar(500) DEFAULT NULL,
  `html` longtext DEFAULT NULL,
  `resources_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`resources_json`)),
  `duration_min` smallint(5) UNSIGNED DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lessons`
--

INSERT INTO `lessons` (`id`, `module_id`, `title`, `type`, `video_url`, `html`, `resources_json`, `duration_min`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bienvenida y objetivos', 'video', 'https://vimeo.com/000000', '', NULL, 8, 1, '2025-10-16 11:50:08', '2025-10-16 11:50:08'),
(2, 1, 'Mindset de aprendizaje', 'texto', NULL, '<p>Contenido de lectura con ejercicios.</p>', NULL, 12, 2, '2025-10-16 11:50:08', '2025-10-16 11:50:08'),
(3, 2, 'Escucha activa', 'video', 'https://vimeo.com/000001', '', NULL, 10, 1, '2025-10-16 11:50:08', '2025-10-16 11:50:08'),
(4, 2, 'Asertividad', 'video', 'https://vimeo.com/000002', '', NULL, 11, 2, '2025-10-16 11:50:08', '2025-10-16 11:50:08'),
(5, 3, 'Gestión de hábitos', 'texto', NULL, '<p>Estrategias de hábitos y seguimiento.</p>', NULL, 15, 1, '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(180) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `title`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'Introducción al cambio', 1, '2025-10-16 11:50:08', '2025-10-16 11:50:08'),
(2, 1, 'Neurocomunicación aplicada', 2, '2025-10-16 11:50:08', '2025-10-16 11:50:08'),
(3, 1, 'Herramientas y hábitos', 3, '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_clp` int(11) NOT NULL,
  `status` enum('pendiente','pagado','fallido','anulado') NOT NULL DEFAULT 'pendiente',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_clp`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 79990, 'pendiente', '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `price_clp` int(11) NOT NULL,
  `qty` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `course_id`, `price_clp`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 79990, 1, '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progresses`
--

CREATE TABLE `progresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT 0,
  `done_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `progresses`
--

INSERT INTO `progresses` (`id`, `user_id`, `lesson_id`, `done`, `done_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2025-10-16 11:50:08', '2025-10-16 11:50:08', '2025-10-16 11:50:08'),
(2, 2, 2, 0, NULL, '2025-10-16 11:50:08', '2025-10-16 11:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `gender` enum('f','m','nb','otro','pref') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(180) DEFAULT NULL,
  `comuna` varchar(80) DEFAULT NULL,
  `email` varchar(190) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','alumno') NOT NULL DEFAULT 'alumno',
  `phone` varchar(40) DEFAULT NULL,
  `rut` varchar(12) DEFAULT NULL,
  `rut_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `gender`, `birth_date`, `address`, `comuna`, `email`, `password`, `role`, `phone`, `rut`, `rut_verified`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Demo', NULL, NULL, NULL, NULL, NULL, NULL, 'admin@erika.cl', '$2y$12$Vb8I3gWn8l1b8qfQv1wZCOX8m2rO6oOeD9m0pE4q7E8l2oO5h7s0W', 'admin', NULL, NULL, 0, NULL, NULL, '2025-10-16 11:50:07', '2025-10-16 11:50:07'),
(2, 'Alumna Demo', NULL, NULL, NULL, NULL, NULL, NULL, 'alumna@erika.cl', '$2y$12$Vb8I3gWn8l1b8qfQv1wZCOX8m2rO6oOeD9m0pE4q7E8l2oO5h7s0W', 'alumno', NULL, NULL, 0, NULL, NULL, '2025-10-16 11:50:07', '2025-10-16 11:50:07');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_course_progress`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_course_progress` (
`user_id` bigint(20) unsigned
,`course_id` bigint(20) unsigned
,`lessons_done` decimal(22,0)
,`lessons_total` bigint(21)
,`pct` decimal(26,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webpay_transactions`
--

CREATE TABLE `webpay_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(120) DEFAULT NULL,
  `buy_order` varchar(120) DEFAULT NULL,
  `session_id` varchar(120) DEFAULT NULL,
  `status` enum('init','commit_ok','commit_error','timeout','cancel') NOT NULL DEFAULT 'init',
  `amount` int(11) NOT NULL,
  `response_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`response_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_course_progress`
--
DROP TABLE IF EXISTS `v_course_progress`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_course_progress`  AS SELECT `e`.`user_id` AS `user_id`, `e`.`course_id` AS `course_id`, sum(case when `p`.`done` = 1 then 1 else 0 end) AS `lessons_done`, count(`l`.`id`) AS `lessons_total`, round(100 * sum(case when `p`.`done` = 1 then 1 else 0 end) / nullif(count(`l`.`id`),0),0) AS `pct` FROM ((((`enrollments` `e` join `courses` `c` on(`c`.`id` = `e`.`course_id`)) left join `modules` `m` on(`m`.`course_id` = `c`.`id`)) left join `lessons` `l` on(`l`.`module_id` = `m`.`id`)) left join `progresses` `p` on(`p`.`user_id` = `e`.`user_id` and `p`.`lesson_id` = `l`.`id`)) GROUP BY `e`.`user_id`, `e`.`course_id` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_code` (`code`),
  ADD KEY `i_user_course` (`user_id`,`course_id`),
  ADD KEY `fk_cert_course` (`course_id`);

--
-- Indices de la tabla `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_code` (`code`),
  ADD KEY `i_active_dates` (`active`,`valid_from`,`valid_to`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_slug` (`slug`),
  ADD KEY `i_published` (`published`);

--
-- Indices de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_course` (`user_id`,`course_id`),
  ADD KEY `i_expires` (`expires_at`),
  ADD KEY `fk_enroll_course` (`course_id`);

--
-- Indices de la tabla `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_module_position` (`module_id`,`position`),
  ADD KEY `i_lessons_position` (`module_id`,`position`);

--
-- Indices de la tabla `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_course_position` (`course_id`,`position`),
  ADD KEY `i_modules_position` (`course_id`,`position`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_user_status` (`user_id`,`status`);

--
-- Indices de la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_order` (`order_id`),
  ADD KEY `i_course` (`course_id`);

--
-- Indices de la tabla `progresses`
--
ALTER TABLE `progresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_lesson` (`user_id`,`lesson_id`),
  ADD KEY `fk_prog_lesson` (`lesson_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_email` (`email`),
  ADD UNIQUE KEY `u_rut` (`rut`);

--
-- Indices de la tabla `webpay_transactions`
--
ALTER TABLE `webpay_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_token` (`token`),
  ADD KEY `i_order` (`order_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `progresses`
--
ALTER TABLE `progresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `webpay_transactions`
--
ALTER TABLE `webpay_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `fk_cert_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_cert_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `fk_enroll_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_enroll_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `fk_lessons_module` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `fk_modules_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_items_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `progresses`
--
ALTER TABLE `progresses`
  ADD CONSTRAINT `fk_prog_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prog_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `webpay_transactions`
--
ALTER TABLE `webpay_transactions`
  ADD CONSTRAINT `fk_tx_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
