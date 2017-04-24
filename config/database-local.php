<?php
/**
 * Config for database
 */
return [
    "dsn"             => "mysql:host=localhost;dbname=oophp",
    "username"        => "admin",
    "password"        => "admin",
    "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    'fetch_mode'      => \PDO::FETCH_OBJ,
];
