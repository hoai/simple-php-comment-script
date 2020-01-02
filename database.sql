SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `comments` (
  `id` int(8) NOT NULL,
  `postid` int(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `unixtime` int(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comments` (`id`, `postid`, `name`, `email`, `comment`, `unixtime`) VALUES (1, 1, 'Emre rothzerg', 'hello@emrerothzerg.com', 'Emre rothzerg test comment', 987345);

ALTER TABLE `comments` ADD PRIMARY KEY (`id`), ADD KEY `postid` (`postid`), ADD KEY `unixtime` (`unixtime`);

ALTER TABLE `comments` MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
