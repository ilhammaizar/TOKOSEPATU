-- Import this file with phpMyAdmin or the MySQL command line to set up the app database.
CREATE DATABASE IF NOT EXISTS db_koneksi
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE db_koneksi;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(32) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY users_username_unique (username)
) ENGINE=InnoDB
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

ALTER TABLE users MODIFY password VARCHAR(255) NOT NULL;

-- Add the username constraint to older installations that created users before this schema.
SET @username_index_exists = (
  SELECT COUNT(*)
  FROM information_schema.statistics
  WHERE table_schema = DATABASE()
    AND table_name = 'users'
    AND index_name = 'users_username_unique'
);
SET @username_index_sql = IF(
  @username_index_exists = 0,
  'ALTER TABLE users ADD UNIQUE KEY users_username_unique (username)',
  'SELECT 1'
);
PREPARE username_index_statement FROM @username_index_sql;
EXECUTE username_index_statement;
DEALLOCATE PREPARE username_index_statement;
