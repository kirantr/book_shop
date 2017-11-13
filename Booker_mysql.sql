-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 13 2017 г., 14:45
-- Версия сервера: 10.1.25-MariaDB
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- База данных: `user7`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kz_events`
--

CREATE TABLE `kz_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `repeat _flag` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `kz_roles`
--

CREATE TABLE `kz_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `kz_roles`
--

INSERT INTO `kz_roles` (`id`, `role`) VALUES
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `kz_rooms`
--

CREATE TABLE `kz_rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `kz_rooms`
--

INSERT INTO `kz_rooms` (`id`, `name`) VALUES
(1, 'Boardroom 1'),
(2, 'Boardroom 2'),
(3, 'Boardroom 3');

-- --------------------------------------------------------

--
-- Структура таблицы `kz_users`
--

CREATE TABLE `kz_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `pass` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `kz_users`
--

INSERT INTO `kz_users` (`id`, `name`, `email`, `role_id`, `pass`) VALUES
(1, 'admin', 'admin@ma.il', 2, 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `kz_events`
--
ALTER TABLE `kz_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Индексы таблицы `kz_roles`
--
ALTER TABLE `kz_roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `kz_rooms`
--
ALTER TABLE `kz_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `kz_users`
--
ALTER TABLE `kz_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role_id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `kz_events`
--
ALTER TABLE `kz_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `kz_roles`
--
ALTER TABLE `kz_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `kz_rooms`
--
ALTER TABLE `kz_rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `kz_users`
--
ALTER TABLE `kz_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `kz_events`
--
ALTER TABLE `kz_events`
  ADD CONSTRAINT `kz_events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `kz_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kz_events_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `kz_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `kz_roles`
--
ALTER TABLE `kz_roles`
  ADD CONSTRAINT `kz_roles_ibfk_1` FOREIGN KEY (`id`) REFERENCES `kz_users` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
