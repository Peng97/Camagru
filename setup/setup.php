#!/usr/bin/php
<?php
include 'database.php';

/**
**      Creat users & photo gallery tables.
**/

try {
        echo "Start database init.\n";
        $dbh = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);        
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Database created\n";

        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "CREATE TABLE `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) NOT NULL,
            `mail` VARCHAR(100) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `token` VARCHAR(50) NOT NULL,
            `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
            )";
        $dbh->exec($sql);
        echo "Tables Users created\n";

        $sql = "CREATE TABLE `gallery` (
              `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `userid` INT(11) NOT NULL,
              `img` VARCHAR(100) NOT NULL,
              FOREIGN KEY (userid) REFERENCES users(id)
            )";
        $dbh->exec($sql);
        echo "Tables gallery created\n";

        $sql = "CREATE TABLE `like` (
              `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `userid` INT(11) NOT NULL,
              `galleryid` INT(11) NOT NULL,
              `type` VARCHAR(1) NOT NULL,
              FOREIGN KEY (userid) REFERENCES users(id),
              FOREIGN KEY (galleryid) REFERENCES gallery(id)
            )";
        $dbh->exec($sql);
        echo "Table like created\n";

        $sql = "CREATE TABLE `comment` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `galleryid` INT(11) NOT NULL,
          `comment` VARCHAR(255) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id),
          FOREIGN KEY (galleryid) REFERENCES gallery(id)
        )";
        $dbh->exec($sql);
        echo "Table comment created\n";

    } catch (PDOException $e) {
        echo "Datbase init error: ".$e->getMessage()."\n";
    }

?>
