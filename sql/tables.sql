CREATE TABLE IF NOT EXISTS `accounts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username`  varchar(50) NOT NULL,
  	`password`  varchar(255) NOT NULL,
  	`email`     varchar(100) NOT NULL,
  	`at`        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- reeaal simple
CREATE TABLE IF NOT EXISTS `albums` (
	`id`          int(11) NOT NULL AUTO_INCREMENT,
    `accounts_id` int(11) NOT NULL,
  	`name`        varchar(50) NOT NULL,
  	`cover_id`    int(11) NOT NULL,
  	`price`       decimal(6,2) NOT NULL,
  	`date`        DATE NOT NULL,
  	`artist`      varchar(255) NOT NULL,
  	`at`          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `images` (
	`id`          int(11) NOT NULL AUTO_INCREMENT,
  	`name`        varchar(255) NOT NULL,
    `mime`        varchar(50) NOT NULL,
    `size`        BigInt unsigned NOT NULL DEFAULT 0,
    `data`        longblob NOT NULL,
  	`at`          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


ALTER TABLE images
MODIFY at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE albums
MODIFY at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE images
MODIFY data longblob NOT NULL;
-- INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES (1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com');
