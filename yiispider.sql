-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 22 2019 г., 18:10
-- Версия сервера: 5.7.25-log
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yiispider`
--

-- --------------------------------------------------------

--
-- Структура таблицы `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `id_market` int(11) NOT NULL DEFAULT '0',
  `summary` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `expiry` varchar(50) DEFAULT NULL,
  `picture` varchar(2000) DEFAULT NULL,
  `exist` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `markets`
--

CREATE TABLE `markets` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `exist` tinyint(1) NOT NULL DEFAULT '1',
  `scan` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `markets`
--

INSERT INTO `markets` (`id`, `title`, `url`, `exist`, `scan`) VALUES
(1, 'ACME', 'https://www.coupons.com/store-loyalty-card-coupons/acme-coupons/', 1, 0),
(2, 'BI-LO', 'https://www.coupons.com/store-loyalty-card-coupons/bi-lo-coupons/', 1, 0),
(3, 'BJs', 'https://www.coupons.com/store-loyalty-card-coupons/bjs-coupons/', 1, 0),
(4, 'Baker\'s', 'https://www.coupons.com/store-loyalty-card-coupons/bakers-coupons/', 1, 0),
(5, 'Beer, Wine and Spirits', 'https://www.coupons.com/store-loyalty-card-coupons/beer-wine-and-spirits-coupons/', 1, 0),
(6, 'Carrs', 'https://www.coupons.com/store-loyalty-card-coupons/carrs-coupons/', 1, 0),
(7, 'Cash Back Offers', 'https://www.coupons.com/store-loyalty-card-coupons/cash-back-offers-coupons/', 1, 0),
(8, 'City Market', 'https://www.coupons.com/store-loyalty-card-coupons/city-market-coupons/', 1, 0),
(9, 'Costco', 'https://www.coupons.com/store-loyalty-card-coupons/costco-coupons/', 1, 0),
(10, 'Dillons Food Stores', 'https://www.coupons.com/store-loyalty-card-coupons/dillons-food-stores-coupons/', 1, 0),
(11, 'Dollar General', 'https://www.coupons.com/store-loyalty-card-coupons/dollar-general-coupons/', 1, 0),
(12, 'Food 4 Less', 'https://www.coupons.com/store-loyalty-card-coupons/food-4-less-coupons/', 1, 0),
(13, 'Food Lion', 'https://www.coupons.com/store-loyalty-card-coupons/food-lion-coupons/', 1, 0),
(14, 'Fred Meyer', 'https://www.coupons.com/store-loyalty-card-coupons/fred-meyer-coupons/', 1, 0),
(15, 'Fry\'s', 'https://www.coupons.com/store-loyalty-card-coupons/frys-coupons/', 1, 0),
(16, 'Gerbes Super Markets', 'https://www.coupons.com/store-loyalty-card-coupons/gerbes-super-markets-coupons/', 1, 0),
(17, 'Giant Eagle', 'https://www.coupons.com/store-loyalty-card-coupons/giant-eagle-coupons/', 1, 0),
(18, 'Giant Food', 'https://www.coupons.com/store-loyalty-card-coupons/giant-food-coupons/', 1, 0),
(19, 'Giant Food Stores', 'https://www.coupons.com/store-loyalty-card-coupons/giant-food-stores-coupons/', 1, 0),
(20, 'Hannaford', 'https://www.coupons.com/store-loyalty-card-coupons/hannaford-coupons/', 1, 0),
(21, 'Harveys', 'https://www.coupons.com/store-loyalty-card-coupons/harveys-coupons/', 1, 0),
(22, 'JayC Food Stores', 'https://www.coupons.com/store-loyalty-card-coupons/jayc-food-stores-coupons/', 1, 0),
(23, 'Jewel-Osco', 'https://www.coupons.com/store-loyalty-card-coupons/jewel-osco-coupons/', 1, 0),
(24, 'King Soopers', 'https://www.coupons.com/store-loyalty-card-coupons/king-soopers-coupons/', 1, 0),
(25, 'Kroger', 'https://www.coupons.com/store-loyalty-card-coupons/kroger-coupons/', 1, 0),
(26, 'Lucky', 'https://www.coupons.com/store-loyalty-card-coupons/lucky-coupons/', 1, 0),
(27, 'Market District', 'https://www.coupons.com/store-loyalty-card-coupons/market-district-coupons/', 1, 0),
(28, 'Martins', 'https://www.coupons.com/store-loyalty-card-coupons/martins-coupons/', 1, 0),
(29, 'Meijer', 'https://www.coupons.com/store-loyalty-card-coupons/meijer-coupons/', 1, 0),
(30, 'Owen\'s', 'https://www.coupons.com/store-loyalty-card-coupons/owens-coupons/', 1, 0),
(31, 'Pavilions', 'https://www.coupons.com/store-loyalty-card-coupons/pavilions-coupons/', 1, 0),
(32, 'Pay Less Super Markets', 'https://www.coupons.com/store-loyalty-card-coupons/pay-less-super-markets-coupons/', 1, 0),
(33, 'Publix', 'https://www.coupons.com/store-loyalty-card-coupons/publix-coupons/', 1, 0),
(34, 'QFC', 'https://www.coupons.com/store-loyalty-card-coupons/qfc-coupons/', 1, 0),
(35, 'Ralphs', 'https://www.coupons.com/store-loyalty-card-coupons/ralphs-coupons/', 1, 0),
(36, 'Randalls', 'https://www.coupons.com/store-loyalty-card-coupons/randalls-coupons/', 1, 0),
(37, 'Safeway', 'https://www.coupons.com/store-loyalty-card-coupons/safeway-coupons/', 1, 0),
(38, 'Sam\'s Club', 'https://www.coupons.com/store-loyalty-card-coupons/sams-club-coupons/', 1, 0),
(39, 'Shaw\'s', 'https://www.coupons.com/store-loyalty-card-coupons/shaws-coupons/', 1, 0),
(40, 'ShopRite', 'https://www.coupons.com/store-loyalty-card-coupons/shoprite-coupons/', 1, 0),
(41, 'Smith\'s', 'https://www.coupons.com/store-loyalty-card-coupons/smiths-coupons/', 1, 0),
(42, 'Star Market', 'https://www.coupons.com/store-loyalty-card-coupons/star-market-coupons/', 1, 0),
(43, 'Stop & Shop', 'https://www.coupons.com/store-loyalty-card-coupons/stop-shop-coupons/', 1, 0),
(44, 'Target', 'https://www.coupons.com/store-loyalty-card-coupons/target-coupons/', 1, 0),
(45, 'Tom Thumb', 'https://www.coupons.com/store-loyalty-card-coupons/tom-thumb-coupons/', 1, 0),
(46, 'Vons', 'https://www.coupons.com/store-loyalty-card-coupons/vons-coupons/', 1, 0),
(47, 'Walgreens', 'https://www.coupons.com/store-loyalty-card-coupons/walgreens-coupons/', 1, 0),
(48, 'Walmart', 'https://www.coupons.com/store-loyalty-card-coupons/walmart-coupons/', 1, 0),
(49, 'WinCo', 'https://www.coupons.com/store-loyalty-card-coupons/winco-coupons/', 1, 0),
(50, 'Winn-Dixie', 'https://www.coupons.com/store-loyalty-card-coupons/winn-dixie-coupons/', 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_market` (`id_market`);

--
-- Индексы таблицы `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `markets`
--
ALTER TABLE `markets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `FK_spider_coupons_spider_markets` FOREIGN KEY (`id_market`) REFERENCES `markets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
