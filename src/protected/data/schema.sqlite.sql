CREATE TABLE IF NOT EXISTS forum (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  description TEXT NOT NULL,
  position INTEGER NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS post (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `user_id` INTEGER NOT NULL,
  `topic_id` INTEGER NOT NULL,
  `forum_id` INTEGER NOT NULL,
  `body` TEXT NOT NULL,
  `body_html` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS `topic` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `forum_id` INTEGER NOT NULL,
  `user_id` INTEGER NOT NULL,
  `title` TEXT NOT NULL,
  `hits` INTEGER NOT NULL DEFAULT '0',
  `sticky` TINYINT(1) NOT NULL DEFAULT '0',
  `locked` TINYINT(1) NOT NULL DEFAULT '0',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS `user` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `username` TEXT NOT NULL,
  `email` TEXT NOT NULL,
  `password_hash` TEXT NOT NULL,
  `admin` TINYINT(1) NOT NULL,
  `display_name` TEXT,
  `website` TEXT,
  `login_key` TEXT NOT NULL,
  `login_key_expires_at` DATETIME NOT NULL,
  `activated` TINYINT(1) NOT NULL,
  `bio` TEXT,
  `bio_html` TEXT,
  `openid_url` TEXT,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `last_login_at` DATETIME,
  `last_seen_at` DATETIME
);

-- Add one line per forum you want to have here
INSERT INTO forum(id, name, description, position, created_at, updated_at) VALUES(1, 'General', 'General discussion goes here', 1, DATETIME('now'), DATETIME('now'));
INSERT INTO forum(id, name, description, position, created_at, updated_at) VALUES(2, 'Off-topic', 'Off-topic discussion goes here', 1, DATETIME('now'), DATETIME('now'));



