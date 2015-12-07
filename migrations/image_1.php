<?php
    $migration = array();
    $migration['id']  =  "init_1";
    $migration['query'] = "CREATE TABLE `".$DB_NAME."`.`image` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, `userid` int(11) NOT NULL, `path` varchar(255) NOT NULL);";
