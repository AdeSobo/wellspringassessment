CREATE SCHEMA IF NOT EXISTS `train_lines_assessment` DEFAULT CHARACTER SET utf8;
USE `train_lines_assessment` ;

CREATE TABLE IF NOT EXISTS `train_lines` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `route` varchar(100),
    `run_number` varchar(20) NOT NULL UNIQUE,
    `operator_id` varchar(100) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;