-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 11 2020 г., 14:42
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `od`
--
CREATE DATABASE IF NOT EXISTS `od` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `od`;

-- --------------------------------------------------------

--
-- Структура таблицы `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `region` text CHARACTER SET utf8,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `type` text CHARACTER SET utf8,
  `client_type` int(11) DEFAULT NULL,
  `client` text CHARACTER SET utf8,
  `fio` text CHARACTER SET utf8,
  `resource` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `what_to_do` text CHARACTER SET utf8,
  `ingeneer` int(6) NOT NULL,
  `date_success` datetime DEFAULT NULL,
  `service` text CHARACTER SET utf8,
  `trip` text CHARACTER SET utf8,
  `etc_data` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `region` text CHARACTER SET utf8 NOT NULL,
  `org_type` text CHARACTER SET utf8 NOT NULL,
  `client` text CHARACTER SET utf8 NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `status` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `contract`
--

CREATE TABLE `contract` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `client` text NOT NULL,
  `coment` text NOT NULL,
  `type` text NOT NULL,
  `edrpou` int(11) NOT NULL,
  `scan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `contract_type`
--

CREATE TABLE `contract_type` (
  `id` int(11) NOT NULL,
  `alias` text CHARACTER SET utf8 NOT NULL,
  `fullname` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `gauth`
--

CREATE TABLE `gauth` (
  `id` int(10) NOT NULL,
  `client` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `ingeneer` int(10) NOT NULL,
  `date1` datetime NOT NULL,
  `date2` datetime NOT NULL,
  `coment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `client` text CHARACTER SET utf8 NOT NULL,
  `fio` text CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `status` text CHARACTER SET utf8 NOT NULL,
  `email_type` text CHARACTER SET utf8 NOT NULL,
  `erk` text CHARACTER SET utf8 NOT NULL,
  `date1` date NOT NULL,
  `coment1` text CHARACTER SET utf8 NOT NULL,
  `date2` date NOT NULL,
  `coment2` text CHARACTER SET utf8 NOT NULL,
  `orgtype` text CHARACTER SET utf8 NOT NULL,
  `position` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `mail_notes`
--

CREATE TABLE `mail_notes` (
  `nid` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text NOT NULL,
  `mail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(5) NOT NULL,
  `date` date DEFAULT NULL,
  `client_type` int(11) DEFAULT NULL,
  `client` text NOT NULL,
  `type` text,
  `ingeneer` int(11) NOT NULL,
  `place` text NOT NULL,
  `time` double DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `maintenance_contract`
--

CREATE TABLE `maintenance_contract` (
  `id` int(11) NOT NULL,
  `contract` text CHARACTER SET utf8 NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contract_type`
--
ALTER TABLE `contract_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gauth`
--
ALTER TABLE `gauth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mail_notes`
--
ALTER TABLE `mail_notes`
  ADD PRIMARY KEY (`nid`);

--
-- Индексы таблицы `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `maintenance_contract`
--
ALTER TABLE `maintenance_contract`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `contract_type`
--
ALTER TABLE `contract_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `gauth`
--
ALTER TABLE `gauth`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mail_notes`
--
ALTER TABLE `mail_notes`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `maintenance_contract`
--
ALTER TABLE `maintenance_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
