
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Structure of table `coupons`
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
-- Structure of table `markets`
--

CREATE TABLE `markets` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `exist` tinyint(1) NOT NULL DEFAULT '1',
  `scan` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes of the table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_market` (`id_market`);

--
-- Indexes of the table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT for the table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for the table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Foreign key constraint of the table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `FK_spider_coupons_spider_markets` FOREIGN KEY (`id_market`) REFERENCES `markets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
