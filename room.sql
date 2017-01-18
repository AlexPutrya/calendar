-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 18 2017 г., 17:25
-- Версия сервера: 5.5.50
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `room`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id_booking` int(20) NOT NULL,
  `id_room` int(10) NOT NULL,
  `enter_date` int(30) NOT NULL,
  `enter_time` varchar(10) NOT NULL,
  `exit_date` int(30) NOT NULL,
  `exit_time` varchar(10) NOT NULL,
  `count_berth` int(5) NOT NULL,
  `extra_berth` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  `id_client` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `id_building` int(10) NOT NULL,
  `building_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buildings`
--

INSERT INTO `buildings` (`id_building`, `building_name`) VALUES
(1, 'Отель 5 звезд'),
(2, 'Хостел'),
(3, 'Котедж 1 этаж'),
(4, 'Котедж 2 этажа'),
(5, 'Домики 1 комнатные'),
(17, 'Отель Океания'),
(18, 'Отель Лось'),
(19, 'Отель Полтава'),
(20, 'Отель Харьков'),
(21, 'Отель Гранд');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(10) NOT NULL,
  `client_name` varchar(20) NOT NULL,
  `client_surname` varchar(20) NOT NULL,
  `client_patronymic` varchar(20) DEFAULT NULL,
  `client_email` varchar(50) DEFAULT NULL,
  `phone` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id_room` int(10) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `id_building` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id_room`, `room_name`, `id_building`) VALUES
(1, 'Комната 101', 1),
(2, 'Комната 102', 1),
(3, 'Комната 103', 1),
(4, 'Комната 104', 1),
(5, 'Комната 105', 1),
(6, 'Комната 106', 1),
(7, 'Комната 106', 1),
(8, 'Койка 101', 2),
(9, 'Койка 102', 2),
(10, 'Койка 103', 2),
(11, 'Койка 201', 2),
(12, 'Койка 202', 2),
(13, 'Койка 203', 2),
(14, 'Койка 204', 2),
(15, 'Комната 101', 3),
(16, 'Комната 102', 3),
(17, 'Комната 103', 3),
(18, 'Комната 101', 4),
(19, 'Комната 102', 4),
(20, 'Комната 103', 4),
(21, 'Комната 101', 5),
(22, 'Комната 102', 5),
(23, 'Комната 103', 5),
(24, 'Комната 104', 5),
(25, 'Комната 201', 5),
(26, 'Комната 202', 5),
(27, 'Комната 202', 5),
(28, 'Комната 202', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_pass` varchar(30) NOT NULL,
  `user_privilege` enum('superuser','admin','user') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `user_login`, `user_pass`, `user_privilege`) VALUES
(1, 'alex.putrya', 'starwars', 'superuser');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_client` (`id_client`);

--
-- Индексы таблицы `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id_building`),
  ADD UNIQUE KEY `id_building` (`id_building`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `id_building` (`id_building`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id_building` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
