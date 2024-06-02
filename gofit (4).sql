-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 02 2024 г., 10:33
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gofit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Adidas'),
(2, 'Nike'),
(3, 'Puma'),
(4, 'Reebok'),
(5, 'Kappa');

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE `color` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`id`, `name`, `color_value`) VALUES
(1, 'Бежевый', '#fbf4d1'),
(2, 'Белый', '#fff'),
(3, 'Желтый', '#fff96b'),
(4, 'Зеленый', '#77d086'),
(5, 'Красный', '#d71111'),
(6, 'Оранжевый', '#ebaa7a'),
(7, 'Розовый', '#d077cd'),
(8, 'Синий', '#004adb'),
(9, 'Фиолетовый', '#7b6fff'),
(10, 'Черный', '#000');

-- --------------------------------------------------------

--
-- Структура таблицы `compareProducts`
--

CREATE TABLE `compareProducts` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `compareProducts`
--

INSERT INTO `compareProducts` (`id`, `product_id`, `user_id`) VALUES
(4, 2, 1),
(5, 43, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `favoriteProducts`
--

CREATE TABLE `favoriteProducts` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `favoriteProducts`
--

INSERT INTO `favoriteProducts` (`id`, `product_id`, `user_id`) VALUES
(13, 1, 2),
(16, 42, 1),
(18, 41, 1),
(19, 1, 1),
(21, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `gender`
--

CREATE TABLE `gender` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'Мужской'),
(2, 'Женский'),
(3, 'Унисекс');

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id`, `name`) VALUES
(1, 'Натуральный'),
(2, 'Синтетика');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(11,0) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `color_id` int NOT NULL,
  `material_id` int NOT NULL,
  `type_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `gender_id`, `brand_id`, `color_id`, `material_id`, `type_id`, `image`) VALUES
(1, 'Спортивный топ бра adidas', 3759, 'Дополни спортивную экипировку топом-бра от adidas, чтобы задавать тренировкам свой ритм.', 2, 1, 9, 2, 1, 'media/catalog/products/664cdc33bb7ef.png'),
(2, 'Футболка мужская PUMA Better Essentials', 2799, 'Базовая футболка Better Essentials незаменима, если ты ведешь активный образ жизни и хочешь выглядеть стильно.', 1, 3, 2, 1, 3, 'media/catalog/products/664cde774e9d2.png'),
(39, 'Худи мужская Reebok Ri Brand Proud Hoodie', 3499, 'Худи Reebok — твой билет на экспресс в мир комфортных и уютных образов. Деликатный принт спереди делает дизайн интереснее, но не перетягивает внимание на себя.', 3, 4, 1, 1, 4, 'media/catalog/products/664cdfac36417.png'),
(40, 'Легинсы женские Nike Pro 365', 10999, 'Укороченные легинсы Nike Pro 365 из мягкой ткани — идеальный выбор для фитнеса. Выпады, приседания или бег — ты будешь чувствовать себя комфортно и уверенно во время выполнения любых упражнений.', 2, 2, 10, 2, 2, 'media/catalog/products/664cdfd2d3d04.png'),
(41, 'Велосипедки Puma женские', 5199, 'Наслаждайся каждым моментом, когда ты отдыхаешь или бежишь по делам. Удобные шорты PUMA помогут чувствовать себя максимально комфортно на протяжении всего дня.', 2, 3, 7, 1, 5, 'media/catalog/products/664ce035a89bb.png'),
(42, 'Спортивный топ бра Reebok Lux', 2999, 'Спортивный топ-бра от Reebok станет прекрасным дополнением твоей экипировки для занятий фитнесом.', 2, 4, 4, 2, 1, 'media/catalog/products/664ce0c676511.png'),
(43, 'Футболка мужская Nike Pro', 6374, 'Брать новые высоты теперь стало еще проще. Футболка с фирменным принтом Nike, сшитая из тонкого технологичного трикотажа, сделает твои тренировки максимально комфортными, эффективными и стильными.', 1, 2, 5, 2, 3, 'media/catalog/products/664ce133c82f1.png'),
(44, 'Спортивный топ бра adidas Aeroreact Training', 4399, 'Комфортный и практичный женский топ-бра adidas для эффективных тренировок.', 2, 1, 10, 2, 1, 'media/catalog/products/664ce1a5af737.png');

-- --------------------------------------------------------

--
-- Структура таблицы `product_size`
--

CREATE TABLE `product_size` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`) VALUES
(42, 1, 1),
(43, 1, 2),
(44, 1, 3),
(45, 1, 4),
(46, 1, 5),
(47, 2, 2),
(48, 2, 3),
(49, 2, 4),
(50, 2, 5),
(51, 2, 6),
(52, 39, 1),
(53, 39, 2),
(54, 39, 3),
(55, 39, 4),
(56, 39, 5),
(57, 39, 6),
(58, 40, 1),
(59, 40, 2),
(60, 40, 3),
(61, 40, 4),
(66, 42, 1),
(67, 42, 2),
(68, 42, 3),
(69, 42, 4),
(70, 42, 5),
(71, 43, 1),
(72, 43, 2),
(73, 43, 3),
(74, 43, 4),
(79, 44, 1),
(84, 41, 1),
(85, 41, 2),
(86, 41, 3),
(87, 41, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Пользователь'),
(2, 'Администратор'),
(3, 'Забаненный пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `size`
--

CREATE TABLE `size` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `size`
--

INSERT INTO `size` (`id`, `name`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL');

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE `type` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Спортивные топы'),
(2, 'Леггинсы'),
(3, 'Футболки'),
(4, 'Толстовки'),
(5, 'Шорты');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `birthday`, `password`, `avatar`, `role_id`) VALUES
(1, 'Виолетта', 'Чернышева', 'violettacernyseva61@gmail.com', '2005-12-27', '$2y$10$6x3waO8d/cNeM8v6YwoIVeNLiCan4VundSdQxqilMBFy3EB1iYfC2', 'media/avatars/664a0b2235468.jpeg', 1),
(2, 'Виолетта', 'Чернышева', 'admin@gmail.com', '2005-12-27', '$2y$10$ZwazfDmqCJgTE9r97yV.XuVxxxGpjm2ZVQAvye9/Qhj4xEesV2COS', 'media/avatars/664a0bc33e831.jpeg', 2),
(3, 'test', 'test', 'test@mail.ru', '2002-02-10', '$2y$10$Iwsd8k/QIe/pA0ApOaEFM.4vQiTebT3xUaELNMjMbz2CJIuE6BU3y', NULL, 1),
(4, 'test', 'trst', 'test@mail.com', '2002-12-12', '$2y$10$Uy83ajIuFES.d/kDnQtHu.tF6iud4e2qC1/2L6s0sxNGTo1.I/NlC', NULL, 3),
(5, 'вилка', 'вилкова', 'test1@mail.com', '2007-02-21', '$2y$10$Kb5pDAcA4dp.il6Zjnt1t.kptnd55kQ0G/7pxNq7TxxJgaTKdSQBm', 'media/avatars/665c493956a90.JPG', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `compareProducts`
--
ALTER TABLE `compareProducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `favoriteProducts`
--
ALTER TABLE `favoriteProducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Индексы таблицы `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `compareProducts`
--
ALTER TABLE `compareProducts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `favoriteProducts`
--
ALTER TABLE `favoriteProducts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `size`
--
ALTER TABLE `size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `type`
--
ALTER TABLE `type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `compareProducts`
--
ALTER TABLE `compareProducts`
  ADD CONSTRAINT `compareproducts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compareproducts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `favoriteProducts`
--
ALTER TABLE `favoriteProducts`
  ADD CONSTRAINT `favoriteproducts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoriteproducts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_5` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_6` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
