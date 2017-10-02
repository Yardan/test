/* Replace this file with actual dump of your database */
CREATE TABLE `user` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL
);

INSERT INTO user (id, username, email) VALUES (1, 'user', 'user@mail.ru');