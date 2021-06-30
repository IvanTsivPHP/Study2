-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.29 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5944
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица blog.access_level
CREATE TABLE IF NOT EXISTS `access_level` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.access_level: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `access_level` DISABLE KEYS */;
INSERT INTO `access_level` (`id`, `name`) VALUES
	(2, 'User'),
	(4, 'Manager'),
	(6, 'Admin');
/*!40000 ALTER TABLE `access_level` ENABLE KEYS */;

-- Дамп структуры для таблица blog.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'placeholder.png',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.articles: ~29 rows (приблизительно)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `title`, `subtitle`, `text`, `pic`, `date`, `author`) VALUES
	(1, 'First article', 'This is first test article', 'Textooo444', '7.png', '2021-04-07 12:34:14', 2),
	(2, 'Second article', 'Blabla', 'Blablabla', NULL, '2021-04-07 15:53:43', 1),
	(3, 'Third post', 'Weeeee, 3rd post', 'ttretretreteteter', NULL, '2021-04-14 15:49:44', 1),
	(4, 'testo posto', 'gdsafdsgds', 'afadffs', NULL, '2021-04-19 11:59:31', 1),
	(5, 'testo posto', 'gdsafdsgds', 'afadffs3213', NULL, '2021-04-19 12:11:12', 1),
	(7, 'new122', '13131232', '1313', NULL, '2021-04-21 16:35:59', 1),
	(8, '234324324', '231221`', '`2`2`21`221`21`1`2', '8.jpg', '2021-04-22 12:35:57', 1),
	(10, 'another one', 'another one', 'another one', NULL, '2021-05-06 17:55:56', 1),
	(11, 'and another one', 'and another one', 'and another one', NULL, '2021-05-06 17:56:07', 1),
	(12, '131223131312123', '1312223312312323', '1312313313123', NULL, '2021-05-06 18:08:31', 1),
	(13, '12312', '1312312', '1231231', NULL, '2021-05-06 18:12:42', 1),
	(14, '123213', '1312323', '132121231', NULL, '2021-05-06 18:14:34', 1),
	(15, '123213', '1312323', '132121231', NULL, '2021-05-06 18:14:38', 1),
	(16, '1232121312', '12321313232', '12312312323', NULL, '2021-05-06 18:21:07', 1),
	(17, 'some more ', 'some more ', 'some more 233', NULL, '2021-05-06 18:22:49', 1),
	(18, 'some more ', 'some more ', 'some more 23331', NULL, '2021-05-06 18:22:55', 1),
	(19, 'some more ', 'some more ', 'some more 2333112321', NULL, '2021-05-06 18:22:58', 1),
	(20, 'some more ', 'some more ', 'some more 2333112321123', NULL, '2021-05-06 18:22:59', 1),
	(21, 'some more ', 'some more ', 'some more 23331123211231231', NULL, '2021-05-06 18:23:01', 1),
	(22, 'and more', 'mooooar', 'sfdsfdfdsfdf', NULL, '2021-05-06 18:23:23', 1),
	(23, 'and more', 'mooooar', 'sfdsfdfdsfdf1231', NULL, '2021-05-06 18:23:26', 1),
	(24, 'and more', 'mooooar', 'sfdsfdfdsfdf1231qeqe', NULL, '2021-05-06 18:23:27', 1),
	(25, 'and more', 'mooooar', 'sfdsfdfdsfdf1231qeqeqeqweqweeq', NULL, '2021-05-06 18:23:29', 1),
	(26, 'testoo', '131233', '1312313', NULL, '2021-05-08 12:53:42', 1),
	(27, '', '', '', NULL, '2021-05-08 12:55:58', 1),
	(28, '13213', '1321321321', '131231231232', NULL, '2021-05-08 13:10:37', 1),
	(29, '123131231231', '1321321312', '13213131231123', NULL, '2021-05-08 13:11:16', 1),
	(30, '121', '1212', '12121', NULL, '2021-05-08 13:38:26', 1),
	(31, '4323324324', '2433243242343', '24324423', '10.jpg', '2021-05-08 13:39:30', 1),
	(34, '132113', '1321331', '13121333', NULL, '2021-05-12 15:09:02', 1),
	(35, '1313', '123131', '1323313', '35.jpg', '2021-05-12 16:26:37', 1),
	(36, '13123132', '121212', '341241414', '1.jpg', '2021-05-12 16:37:38', 1),
	(37, '13123132', '121212', '34124141411', '37.png', '2021-05-12 16:42:14', 1),
	(38, '423241432132', '12342433241413', '1234242142423432124', 'placeholder.png', '2021-05-12 16:44:53', 1),
	(39, '124242143142134', '14324234214232413', '143243241242421421', '39.png', '2021-05-12 16:45:04', 1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Дамп структуры для таблица blog.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moderated` tinyint(1) DEFAULT '0',
  `author_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_comments_articles` (`article_id`),
  CONSTRAINT `FK_comments_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.comments: ~22 rows (приблизительно)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `moderated`, `author_id`, `date`, `text`, `article_id`) VALUES
	(1, 1, 1, '2021-04-09 13:49:34', 'comment kek', 1),
	(2, 1, 2, '2021-04-09 13:52:38', 'Comment 2', 1),
	(16, 1, 2, '2021-04-12 15:54:06', '232', 2),
	(17, 1, 1, '2021-04-12 16:09:55', '123312', 2),
	(18, 1, 1, '2021-04-15 16:47:35', 'test comment approve me', 1),
	(19, 1, 1, '2021-04-19 11:16:16', 'commento', 3),
	(25, 0, 3, '2021-04-26 11:52:35', 'moderated comment?', 8),
	(31, 1, 1, '2021-05-06 13:27:05', '2', 2),
	(32, 1, 1, '2021-05-06 13:45:17', '2', 2),
	(33, 1, 1, '2021-05-06 17:46:49', '32131221312', 8),
	(34, 1, 1, '2021-05-08 12:45:21', '13', 25),
	(35, 1, 1, '2021-05-11 15:00:12', '1', 31),
	(36, 1, 1, '2021-05-11 15:00:15', '2', 31),
	(37, 1, 1, '2021-05-11 15:01:26', '2', 31),
	(38, 1, 1, '2021-05-11 15:01:43', '3', 31),
	(39, 1, 1, '2021-05-11 15:17:07', '1312', 31),
	(40, 1, 1, '2021-05-11 15:17:14', '1312', 31),
	(41, 1, 1, '2021-05-12 15:58:16', '21312', 34),
	(42, 1, 1, '2021-05-12 15:59:32', '21312', 34),
	(43, 1, 1, '2021-05-12 15:59:38', '21312', 34),
	(44, 1, 1, '2021-05-12 15:59:40', '123213232', 34);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Дамп структуры для таблица blog.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `subscription` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.profiles: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;

-- Дамп структуры для таблица blog.static_pages
CREATE TABLE IF NOT EXISTS `static_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `href` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  UNIQUE KEY `href` (`href`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.static_pages: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
INSERT INTO `static_pages` (`id`, `title`, `href`, `text`) VALUES
	(5, 'Rules', '/tos', '1. Admin is always right132');
/*!40000 ALTER TABLE `static_pages` ENABLE KEYS */;

-- Дамп структуры для таблица blog.subscribes
CREATE TABLE IF NOT EXISTS `subscribes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.subscribes: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `subscribes` DISABLE KEYS */;
INSERT INTO `subscribes` (`id`, `email`) VALUES
	(28, 'admin@mail.com');
/*!40000 ALTER TABLE `subscribes` ENABLE KEYS */;

-- Дамп структуры для таблица blog.test
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.test: ~21 rows (приблизительно)
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` (`id`, `data`) VALUES
	(1, 12),
	(2, 11),
	(3, 33),
	(4, 44),
	(5, 55),
	(6, 65),
	(7, 67),
	(8, 1231),
	(9, 4324),
	(10, 123),
	(11, 2342),
	(12, 23424),
	(13, 2),
	(14, 3),
	(15, 3),
	(16, 44),
	(17, 22),
	(18, 2),
	(19, 2),
	(20, 2),
	(22, 6456),
	(23, 555),
	(24, 666),
	(25, 123456),
	(26, 123123),
	(27, 123123);
/*!40000 ALTER TABLE `test` ENABLE KEYS */;

-- Дамп структуры для таблица blog.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level` tinyint(4) NOT NULL DEFAULT '2',
  `about` text COLLATE utf8mb4_unicode_ci,
  `userpic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'placeholder.png',
  `subscribe` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_access_level` (`access_level`),
  CONSTRAINT `FK_users_access_level` FOREIGN KEY (`access_level`) REFERENCES `access_level` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы blog.users: ~16 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `access_level`, `about`, `userpic`, `subscribe`) VALUES
	(1, 'admin', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'admin@mail.com', 6, 'Praise admin!!1111', '1/10.jpg', 0),
	(2, 'manager', '$2y$10$bEUub0EuHQuF6ufhZjL7gu5g4/X/BxF6Z3228fq.J5felZfJ/mroy', 'manager@mail.com', 4, '', 'placeholder.png', 0),
	(3, 'user1', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'user1@mail.com', 2, NULL, 'placeholder.png', 1),
	(4, 'usertest a', '$2y$10$6XK6y.lhfKI.XeLvwTpfw.7Hi/wReke624pe6MgyETwZ0DV9bMJY6', 'usertesta@mail.com', 2, NULL, 'placeholder.png', 0),
	(8, 'admino', '$2y$10$tAWwNn40LXTib/r1YPyGKejYXRwwzmA1/u0g/Y7jMGbZBgSMDdGC.', 'admino@mail.com', 2, NULL, 'placeholder.png', 0),
	(9, 'user2', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'user2@mail.com', 2, NULL, 'placeholder.png', 0),
	(10, 'user3', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'user3@mail.com', 2, NULL, 'placeholder.png', 0),
	(11, 'user4', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'user4@mail.com', 2, NULL, 'placeholder.png', 0),
	(12, 'user5', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'user5@mail.com', 2, NULL, 'placeholder.png', 0),
	(13, 'user6', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'user6@mail.com', 2, NULL, 'placeholder.png', 0),
	(14, 'user7', '$2y$10$g8KusNYVaq5o/oa9NcXPAOBvdHlqTbAZrd3X60OXRR7ZivSKnm08S', 'user7@mail.com', 2, NULL, 'placeholder.png', 0),
	(16, 'adminboba', '$2y$10$DFMUBrUc1vGVPVOt.FQLjOEmAnoY4lkRnKnQM90rbm4Ed6GN4jFyy', '123@131.ru', 2, NULL, 'placeholder.png', 0),
	(17, 'adadada', '$2y$10$Bqb1TwBCI7.FyLrjfmg5Z.bky45WZJR/v534jYaSYefac49VGhjXG', 'adasdad@mail.com', 2, NULL, 'placeholder.png', 0),
	(19, 'qeqweqweewqeq', '$2y$10$NbXR4wtHZEC4vLNBt8z.yeJ8nXWp0ML5K1xWOWTs7fDRNPOXSabo.', 'adasdad23@mail.com', 2, NULL, 'placeholder.png', 0),
	(21, 'qeqweqweewqeqff', '$2y$10$3HY1GERTmEtGirD64m5rC.VRkDQv3eHXa8GAgSv5nepOBKSjkSnae', 'adasdad2333@mail.com', 2, NULL, 'placeholder.png', 0),
	(23, 'qeqweqweewqeqfff', '$2y$10$83b4i7rsLsoqM4qha8SA0uMw8fgK4RiIKfBVFf4f/XpHTx5YGPPfq', 'adasdad23233@mail.com', 2, NULL, 'placeholder.png', 0),
	(24, 'sfsdgdgfdg', '$2y$10$wBib7t0ql0yiWrk/i3fMj.mCn2KU7L8J0d0X/bT1h0J85FwkbvNpe', 'sfgfgfsg@mail.com', 2, NULL, 'placeholder.png', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
