
--
-- Database: `CXI`
--

CREATE DATABASE IF NOT EXISTS `CXI` DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
USE `CXI`;

-- --------------------------------------------------------
--
-- Table structure for table `denom_inventory`
--

DROP TABLE IF EXISTS `denom_inventory`;
CREATE TABLE IF NOT EXISTS `denom_inventory` (
  `location_id` int(11) NOT NULL,
  `currency_code` char(3) CHARACTER SET latin1 NOT NULL,
  `denom_value` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`location_id`,`currency_code`,`denom_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `denom_inventory`
--

INSERT INTO `denom_inventory` (`location_id`, `currency_code`, `denom_value`, `amount`) VALUES
  (1, 'CAD', 5, 100),
  (1, 'CAD', 10, 100),
  (1, 'CAD', 20, 100),
  (1, 'CAD', 100, 100),
  (1, 'CAD', 500, 9),
  (1, 'USD', 1, 100),
  (1, 'USD', 5, 100),
  (1, 'USD', 10, 100),
  (1, 'USD', 20, 100),
  (1, 'USD', 50, 100),
  (1, 'USD', 100, 100);

