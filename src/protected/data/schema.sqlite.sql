CREATE TABLE IF NOT EXISTS forum (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  position INTEGER NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL DEFAULT (DATETIME('now'))
);

CREATE TABLE IF NOT EXISTS post (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `user_id` INTEGER NOT NULL,
  `topic_id` INTEGER NOT NULL,
  `forum_id` INTEGER NOT NULL,
  `body` text NOT NULL,
  `body_html` text NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL DEFAULT (DATETIME('now'))
);

CREATE TABLE IF NOT EXISTS `topic` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `forum_id` INTEGER NOT NULL,
  `user_id` INTEGER NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `hits` INTEGER NOT NULL DEFAULT '0',
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL DEFAULT (DATETIME('now'))
);

CREATE TABLE IF NOT EXISTS `user` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(32) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `login_key` varchar(32) NOT NULL,
  `login_key_expires_at` datetime NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `bio` text DEFAULT NULL,
  `bio_html` text DEFAULT NULL,
  `openid_url` varchar(255) DEFAULT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL DEFAULT (DATETIME('now')),
  `last_login_at` DATETIME DEFAULT NULL,
  `last_seen_at` DATETIME DEFAULT NULL
);


INSERT INTO forum(id, name, description, position, created_at, updated_at) VALUES('1', 'General', 'General Discussion goes here', '1', DATETIME('now'), DATETIME('now'));



