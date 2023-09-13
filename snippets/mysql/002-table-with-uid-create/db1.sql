SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` char(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `history` (`id`, `uid`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'eb2b56fdf531884ea6b174f0ad0f8aa7354de109', 'name1', 'value1', '2023-09-13 15:13:40', '2023-09-13 15:14:05');


DROP TRIGGER IF EXISTS `before_user_insert`;
DELIMITER $$
CREATE TRIGGER `before_user_insert` BEFORE INSERT ON `history` FOR EACH ROW BEGIN 
    SET NEW.uid = SHA1(UUID()); 
END
$$
DELIMITER ;
COMMIT;

