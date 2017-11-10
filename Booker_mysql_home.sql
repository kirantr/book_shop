-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 10 2017 г., 15:57
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `user7`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kz_events`
--

CREATE TABLE IF NOT EXISTS `kz_events` (
  `id` char(16) NOT NULL,
  `user_id` char(16) NOT NULL,
  `room_id` char(16) NOT NULL,
  `Description` text NOT NULL,
  `Time start` time NOT NULL,
  `Time end` time NOT NULL,
  `Repeat Flag` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kz_roles`
--

CREATE TABLE IF NOT EXISTS `kz_roles` (
  `id` int(16) NOT NULL,
  `role` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `kz_roles`
--

INSERT INTO `kz_roles` (`id`, `role`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `kz_rooms`
--

CREATE TABLE IF NOT EXISTS `kz_rooms` (
  `id` int(16) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `kz_rooms`
--

INSERT INTO `kz_rooms` (`id`, `name`) VALUES
(1, 'Boardroom 1');

-- --------------------------------------------------------

--
-- Структура таблицы `kz_users`
--

CREATE TABLE IF NOT EXISTS `kz_users` (
  `id` int(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `role_id` int(11) NOT NULL,
  `pass` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `kz_users`
--

INSERT INTO `kz_users` (`id`, `name`, `email`, `role_id`, `pass`) VALUES
(1, 'admin', 'admin@em.ail', 1, 'admin'),
(2, 'name', 'email@e.mail', 2, 'pass');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `kz_events`
--
ALTER TABLE `kz_events`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `kz_roles`
--
ALTER TABLE `kz_roles`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `kz_rooms`
--
ALTER TABLE `kz_rooms`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `kz_users`
--
ALTER TABLE `kz_users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
