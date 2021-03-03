-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-03-03 12:46:03
-- サーバのバージョン： 10.4.14-MariaDB
-- PHP のバージョン: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `original_instagram`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_member_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `comment`
--

INSERT INTO `comment` (`id`, `message`, `sent_member_id`, `post_id`, `created`) VALUES
(1, 'aaa', 8, 27, '2021-02-25 17:06:32'),
(2, 'test', 8, 27, '2021-02-25 17:07:28'),
(3, 'aaa', 8, 27, '2021-02-25 17:52:54'),
(4, 'eee', 8, 27, '2021-02-25 17:52:59'),
(7, 'seigi', 4, 29, '2021-02-27 12:15:44'),
(11, 'kai', 4, 20, '2021-03-01 14:53:52'),
(13, 'くさ', 4, 32, '2021-03-02 12:12:51'),
(14, 'くっさぁ', 4, 32, '2021-03-03 10:26:04');

-- --------------------------------------------------------

--
-- テーブルの構造 `dm`
--

CREATE TABLE `dm` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `acc_member_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `dm`
--

INSERT INTO `dm` (`id`, `message`, `member_id`, `acc_member_id`, `created`) VALUES
(1, 'test', 4, 10, '2021-02-27 16:54:27'),
(2, 'test', 4, 10, '2021-02-27 16:54:42'),
(3, 'test', 4, 10, '2021-02-27 16:57:19'),
(4, 'aaa', 4, 10, '2021-02-27 16:57:35'),
(5, 'ふぉーどーーー', 4, 10, '2021-02-27 16:58:08'),
(6, 'dekitayo', 4, 10, '2021-02-27 17:15:49'),
(7, 'hey', 10, 4, '2021-02-27 18:04:10'),
(8, 'heyheyhey', 10, 4, '2021-02-27 18:06:10'),
(9, 'hoy', 4, 10, '2021-03-01 12:08:33'),
(10, 'hey', 4, 10, '2021-03-01 12:09:43'),
(11, 'ふぉーどーーー', 4, 10, '2021-03-01 12:19:44'),
(12, 'hahaha', 4, 10, '2021-03-01 12:19:48'),
(13, 'ははは', 4, 5, '2021-03-02 10:52:28'),
(14, 'あああ', 4, 5, '2021-03-02 10:52:30'),
(15, 'ぶちころしたぁら', 4, 5, '2021-03-02 10:52:38'),
(16, 'aaa', 5, 4, '2021-03-02 10:57:48'),
(17, 'bbwfbubw', 4, 5, '2021-03-02 10:58:55'),
(18, 'bcisvbds', 4, 5, '2021-03-02 10:58:57'),
(19, 'eiygfef', 4, 5, '2021-03-02 10:58:59'),
(20, '', 5, 4, '2021-03-02 11:14:33'),
(21, 'だｂｆぼｊくぇｂ', 5, 4, '2021-03-02 11:14:49'),
(22, 'aaa', 4, 5, '2021-03-02 11:20:27'),
(23, 'test', 4, 5, '2021-03-02 11:20:29'),
(24, 'adabaga', 4, 5, '2021-03-02 16:04:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `dm_time`
--

CREATE TABLE `dm_time` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `sent_member_id` int(11) NOT NULL,
  `visited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `dm_time`
--

INSERT INTO `dm_time` (`id`, `member_id`, `sent_member_id`, `visited`) VALUES
(1, 4, 10, '2021-03-01 12:19:48'),
(2, 10, 4, '2021-03-01 12:20:01'),
(3, 4, 3, '2021-03-01 12:03:12'),
(4, 4, 5, '2021-03-02 16:04:54'),
(5, 5, 4, '2021-03-02 11:20:51');

-- --------------------------------------------------------

--
-- テーブルの構造 `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `follow_member_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `follow`
--

INSERT INTO `follow` (`id`, `member_id`, `follow_member_id`, `created`) VALUES
(9, 5, 4, '2021-02-22 11:30:19'),
(15, 1, 4, '2021-02-22 11:30:28'),
(16, 4, 6, '2021-02-22 11:31:37'),
(17, 4, 3, '2021-02-22 12:32:20'),
(19, 4, 5, '2021-02-22 15:38:04'),
(20, 3, 4, '2021-02-22 16:39:16'),
(22, 8, 5, '2021-02-25 15:57:12'),
(23, 8, 4, '2021-02-25 16:21:38'),
(24, 9, 4, '2021-02-25 18:14:29'),
(26, 4, 10, '2021-02-26 10:24:17'),
(27, 11, 5, '2021-02-26 15:47:08'),
(28, 11, 4, '2021-02-26 15:48:27'),
(29, 10, 11, '2021-03-01 12:12:20');

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `icon_path` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `name`, `icon_path`, `mail`, `password`, `user_id`) VALUES
(1, 'test', 'icon.png', 'test@test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test'),
(2, 'テストユーザー', 'icon.png', 'testuser@sample', '21bd12dc183f740ee76f27b78eb39c8ad972a757', 'testuser'),
(3, 'ハヤシミツキ', 'icon.png', 'hm20011027@gmail.com', '8ada2bbad0a487a131cabc32cef0dc97dba97211', 'kh_mitsu'),
(4, 'mitsuki', '2021030112211901.jpg', 'reonroen@gmail.com', '0f7af99787b7eff2640a023d5da89ae94711650e', 'reonroen'),
(5, 'やじ', '20210302110034aho.png', 'yaji@yaji', '94dca68a113033812599de6d463ac6c6c1083de1', 'yaji'),
(6, 'aaa', 'icon.png', 'aaa@aaa', '70c881d4a26984ddce795f6f71817c9cf4480e79', 'aaa'),
(7, 'bbb', 'icon.png', 'bbb@bbb', '8aed1322e5450badb078e1fb60a817a1df25a2ca', 'bbb'),
(8, 'テストテスト', 'icon.png', 'testtest@example.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'testtest'),
(9, 'ヤジジンペイ', 'icon.png', 'mm20011027@gmail.com', 'b3cdee06a546727f04eb07e2fd62fbde92375089', 'mm'),
(10, 'エックス', '20210301122048朗らかな皮膚とて不服.jpg', 'xxx@xxx', '4ad583af22c2e7d40c1c916b2920299155a46464', 'xxx'),
(11, '家治陣平', 'icon.png', 'yajison@icloud.com', 'e119640c4ba2f6ab2b2ec8c21b59853c388d7133', 'yajison'),
(12, 'けー', 'icon.png', 'kkk@kkk', '54adbc768978d9574b682470bd1f568f5a3f43da', 'kkk'),
(13, 'ジェー', 'icon.png', 'jjj@jjj', 'd2a4d1a7e5308eb33481c6595d7b03f376320b73', 'jjj');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `picture_path` text NOT NULL,
  `filter` text NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `discription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `member_id`, `picture_path`, `filter`, `created`, `discription`) VALUES
(1, 5, '20210216141806art-01.jpg', '0', '2021-02-16 14:18:06', '改'),
(2, 5, '20210217101245ookami.jpg', '0', '2021-02-17 10:12:45', '改'),
(3, 4, '20210217103723e-02.jpg', '0', '2021-02-17 10:37:23', '改'),
(4, 4, '20210217113605e-03.jpeg', '0', '2021-02-17 11:36:05', '改'),
(5, 4, '20210217113613e-08.jpg', '0', '2021-02-17 11:36:13', '改'),
(6, 4, '20210217113619e-09.jpg', '0', '2021-02-17 11:36:19', '改'),
(7, 4, '20210217113629e-10.jpg', '0', '2021-02-17 11:36:29', '改'),
(8, 4, '20210218142638e-11.jpg', '0', '2021-02-18 14:26:38', '改'),
(9, 1, '20210218143546a-02.jfif', '0', '2021-02-18 14:35:46', '改'),
(10, 4, '20210218151049ge-04.webp', '0', '2021-02-18 15:10:49', '改'),
(11, 4, '20210218151057ge-02.jpg', '0', '2021-02-18 15:10:57', '改'),
(12, 4, '20210218151105a-03.jfif', '0', '2021-02-18 15:11:05', '改'),
(13, 4, '20210218151119k-03.webp', '0', '2021-02-18 15:11:19', '改'),
(14, 5, '20210218155440k-02.webp', 'blur', '2021-02-18 15:54:40', '改'),
(15, 4, '20210222164907a-03.jfif', '0', '2021-02-22 16:49:07', '改'),
(16, 4, '20210222165058a-02.jfif', '0', '2021-02-22 16:50:58', '改'),
(17, 4, '20210222165137a-02.jfif', '0', '2021-02-22 16:51:37', '改'),
(18, 4, '20210222165506ge-02.jpg', 'contrast', '2021-02-22 16:55:06', '水鳳園'),
(20, 4, '20210222165642ge-02.jpg', 'grayscale', '2021-02-22 16:56:42', '改'),
(21, 4, '20210222165731ge-01.webp', '0', '2021-02-22 16:57:31', '改'),
(22, 4, '20210222165856k-04.webp', 'brightness', '2021-02-22 16:58:56', '改'),
(23, 4, '2021022418060006.jpg', 'grayscale', '2021-02-24 18:06:00', '蹴っ飛ばした毛布'),
(27, 8, '20210225161511al-03B.jpg', 'null', '2021-02-25 16:15:11', ''),
(28, 9, '2021022518342715.jpg', 'invert', '2021-02-25 18:34:27', '勘ぐれい'),
(29, 10, '2021022610144305.jpg', 'invert', '2021-02-26 10:14:43', '正義'),
(30, 11, '20210226154924kusa.jpg', 'invert', '2021-02-26 15:49:24', 'ちいんこ！！');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts_dow`
--

CREATE TABLE `posts_dow` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `posts_dow`
--

INSERT INTO `posts_dow` (`id`, `posts_id`, `member_id`) VALUES
(1, 31, 4),
(2, 30, 10),
(3, 30, 10),
(4, 30, 10),
(5, 30, 10),
(6, 31, 4),
(7, 32, 4);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `dm`
--
ALTER TABLE `dm`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `dm_time`
--
ALTER TABLE `dm_time`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`member_id`);

--
-- テーブルのインデックス `posts_dow`
--
ALTER TABLE `posts_dow`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルのAUTO_INCREMENT `dm`
--
ALTER TABLE `dm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルのAUTO_INCREMENT `dm_time`
--
ALTER TABLE `dm_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- テーブルのAUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルのAUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- テーブルのAUTO_INCREMENT `posts_dow`
--
ALTER TABLE `posts_dow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `test` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
