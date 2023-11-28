CREATE TABLE `db_api`.`customers` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(191) NOT NULL,
    `email` VARCHAR(191) NOT NULL,
    `phone` VARCHAR(191) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;