<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1476896192.
 * Generated on 2016-10-19 19:56:32 by sergey
 */
class PropelMigration_1476896192
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'engine' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `users`
(
    `id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(64) NOT NULL,
    `password` VARCHAR(72) DEFAULT \'\' NOT NULL,
    `status` enum(\'active\',\'deleted\',\'not_confirmed\') DEFAULT \'not_confirmed\' NOT NULL,
    `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`,`email`),
    UNIQUE INDEX `users_u_63843b` (`id`),
    INDEX `email` (`email`)
) ENGINE=InnoDB CHARACTER SET=\'utf8\';

CREATE TABLE `links`
(
    `id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `original` VARCHAR(255) NOT NULL,
    `shorted` VARCHAR(255) NOT NULL,
    `accessibility` enum(\'private\',\'public\') DEFAULT \'public\' NOT NULL,
    `user_id` INTEGER(32) NOT NULL,
    `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `shorted` (`shorted`(255)),
    INDEX `links_fi_69bd79` (`user_id`),
    CONSTRAINT `links_fk_69bd79`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB CHARACTER SET=\'utf8\';

CREATE TABLE `link_views`
(
    `id` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `link_id` INTEGER(32) NOT NULL,
    `ip` VARCHAR(64) NOT NULL,
    `user_agent` VARCHAR(255) NOT NULL,
    `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `link_views_fi_e917b2` (`link_id`),
    CONSTRAINT `link_views_fk_e917b2`
        FOREIGN KEY (`link_id`)
        REFERENCES `links` (`id`)
) ENGINE=InnoDB CHARACTER SET=\'utf8\';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `status`) VALUES
    ("Test", "Probik", "test@mail.com", "$2y$10$/LtJ2DDT9.Lyc.HxL/lEzeaREmG1i.LnxDhy2P8UEProVcnhVn6Ou", "active");

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'engine' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `users`;

DROP TABLE IF EXISTS `links`;

DROP TABLE IF EXISTS `link_views`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}