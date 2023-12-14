/*
MariaDB Backup
Database: blog
Backup Time: 2023-12-14 13:44:23
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `blog`.`articles`;
DROP TABLE IF EXISTS `blog`.`users`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `active` tinyint(3) unsigned DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
BEGIN;
LOCK TABLES `blog`.`articles` WRITE;
DELETE FROM `blog`.`articles`;
INSERT INTO `blog`.`articles` (`id`,`title`,`content`,`picture`,`active`) VALUES (1, 'L&#039;hiver est &agrave; nos portes', '&lt;p&gt;L&amp;rsquo;&amp;eacute;t&amp;eacute; nous apporte ses journ&amp;eacute;es ensoleill&amp;eacute;es et ses soir&amp;eacute;es dor&amp;eacute;es ; l&amp;rsquo;automne, le mouvement du vent et la coloration glorieuse du feuillage. Mais l&amp;rsquo;hiver ? Son doux manteau de neige, uniforme et &amp;eacute;pur&amp;eacute;, recouvre les asp&amp;eacute;rit&amp;eacute;s des paysages, leur permettant de prendre une pause pour mieux rena&amp;icirc;tre au printemps.&lt;/p&gt;', NULL, 1),(2, 'Le soleil', 'Le Soleil est l’étoile autour de laquelle tournoient tous les objets qui constituent notre système solaire, à savoir les planètes, les comètes et autres astéroïdes.', NULL, 1),(3, 'L\'intelligence artificielle', 'Souvent classée dans le groupe des mathématiques et des sciences cognitives, elle fait appel à la neurobiologie computationnelle (particulièrement aux réseaux neuronaux) et à la logique mathématique (partie des mathématiques et de la philosophie). ', NULL, 1),(15, 'Article non publi&eacute;', '&lt;p&gt;...&lt;/p&gt;', NULL, 0)
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `blog`.`users` WRITE;
DELETE FROM `blog`.`users`;
INSERT INTO `blog`.`users` (`id`,`email`,`passwd`) VALUES (1, 'john@mail.com', '1234'),(2, 'alain@kelleter.be', 'AZERTY')
;
UNLOCK TABLES;
COMMIT;
