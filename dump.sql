-- --------------------------------------------------------
-- 호스트:                          localhost
-- 서버 버전:                        5.1.69 - Source distribution
-- 서버 OS:                        redhat-linux-gnu
-- HeidiSQL 버전:                  8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- ci_book 의 데이터베이스 구조 덤핑
DROP DATABASE IF EXISTS `ci_book`;
CREATE DATABASE IF NOT EXISTS `ci_book` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ci_book`;


-- 테이블 ci_book의 구조를 덤프합니다. ci_board
DROP TABLE IF EXISTS `ci_board`;
CREATE TABLE IF NOT EXISTS `ci_board` (
  `board_id` int(10) NOT NULL AUTO_INCREMENT,
  `board_pid` int(10) NOT NULL DEFAULT '0' COMMENT '원글번호',
  `user_id` varchar(20) NOT NULL COMMENT '작성자ID',
  `user_name` varchar(20) NOT NULL COMMENT '작성자이름',
  `subject` varchar(50) NOT NULL COMMENT '게시글제목',
  `contents` text NOT NULL COMMENT '게시글내용',
  `hits` int(10) NOT NULL DEFAULT '0' COMMENT '조회수',
  `reg_date` datetime NOT NULL COMMENT '등록일',
  PRIMARY KEY (`board_id`),
  KEY `board_pid` (`board_pid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='CodeIgniter 게시판';

-- Dumping data for table ci_book.ci_board: 14 rows
DELETE FROM `ci_board`;
/*!40000 ALTER TABLE `ci_board` DISABLE KEYS */;
INSERT INTO `ci_board` (`board_id`, `board_pid`, `user_id`, `user_name`, `subject`, `contents`, `hits`, `reg_date`) VALUES
	(1, 0, 'advisor', '웅파', '안녕하세요', '첫글이네요.', 5, '2012-06-12 22:23:01'),
	(2, 0, 'advisor', '웅파', '두번째 글입니다.', '두번째글이네요.', 0, '2012-06-12 22:24:01'),
	(3, 0, 'advisor', '웅파', '세번째 글입니다.', '세번째글이네요.', 1, '2012-06-12 22:24:01'),
	(4, 0, 'advisor', '웅파', '네번째 글입니다.', '네번째글이네요.', 6, '2012-06-12 22:24:01'),
	(5, 0, 'advisor', '웅파', '다섯번째 글입니다.', '다섯번째글이네요.', 4, '2012-06-12 22:24:01'),
	(8, 0, 'advisor', '웅파', '여덞번째 글입니다.2', '여덞번째글이네요.2', 13, '2012-06-12 22:24:01'),
	(9, 0, 'advisor', '웅파', '아홉번째 글입니다.', '아홉번째글이네요.', 1, '2012-06-12 22:24:01'),
	(10, 0, 'advisor', '웅파', '열번째 글입니다.', '열번째글이네요.', 9, '2012-06-12 22:24:01'),
	(11, 1, 'blumine', '웅파1', '첫번째 글의 첫번째 댓글입니다.', '첫번째 댓글이네요.', 1, '2012-06-12 22:26:01'),
	(12, 1, 'blumine', '웅파1', '첫번째 글의 두번째 댓글입니다.', '두번째 댓글이네요.', 0, '2012-06-12 22:27:01'),
	(13, 2, 'blumine', '웅파1', '두번째 글의 첫번째 댓글입니다.', '두번째 글의 첫번째 댓글이네요.', 9, '2012-06-12 22:29:01'),
	(24, 4, 'advisor', 'advisor', '', '3333', 0, '2012-10-09 17:17:22'),
	(22, 4, 'advisor', 'advisor', '', '1111', 0, '2012-10-09 17:17:19'),
	(25, 4, 'advisor', 'advisor', '', '4444', 0, '2012-11-07 14:09:59');
/*!40000 ALTER TABLE `ci_board` ENABLE KEYS */;


-- 테이블 ci_book의 구조를 덤프합니다. ci_sessions
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ci_book.ci_sessions: ~7 rows (대략적)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('2e4fbe13e074a0f56341681da7e3e025', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0', 1361075504, ''),
	('3908ca25f230df0eb2bbbd214b2a547b', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)', 1360758546, ''),
	('7760fed3036f3a061acb49cfc2544d9d', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)', 1360893336, ''),
	('916d50245572af52fcd6ffa5d5607d3a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0', 1361074372, ''),
	('9942ef31e0ad9b1d08236632e9d4a3da', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:18.0) Gecko/20100101 Firefox/18.0', 1360847243, ''),
	('db1ef50cc7fce8886cae40b0ad574b1e', '192.168.25.74', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36', 1371695890, ''),
	('fe2aaf4f4835f546d68e70974e2bf899', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0', 1361073816, '');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- 테이블 ci_book의 구조를 덤프합니다. sns_files
DROP TABLE IF EXISTS `sns_files`;
CREATE TABLE IF NOT EXISTS `sns_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL DEFAULT '0',
  `user_id` varchar(30) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `contents` varchar(200) NOT NULL COMMENT '내용',
  `file_path` varchar(150) NOT NULL,
  `file_name` varchar(100) NOT NULL COMMENT '서버 저장 경로와 변경된 파일명',
  `original_name` varchar(100) NOT NULL COMMENT '서버 저장 경로와 원래 파일명',
  `detail_info` varchar(500) NOT NULL COMMENT '타입, 크기 등의 정보',
  `hit` int(10) NOT NULL DEFAULT '1',
  `reg_date` datetime NOT NULL COMMENT '등록일',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='SNS 프로젝트';

-- Dumping data for table ci_book.sns_files: ~16 rows (대략적)
DELETE FROM `sns_files`;
/*!40000 ALTER TABLE `sns_files` DISABLE KEYS */;
INSERT INTO `sns_files` (`id`, `pid`, `user_id`, `subject`, `contents`, `file_path`, `file_name`, `original_name`, `detail_info`, `hit`, `reg_date`) VALUES
	(2, 0, 'advisor', '다람쥐', '다람쥐 사진 테스트 업로드', 'F:/xampp/htdocs/sns/uploads/', 'f3f88649f5f729031baada79d973f651.jpg', '다람쥐.jpg', 'a:4:{s:9:"file_size";i:12;s:11:"image_width";i:226;s:12:"image_height";i:150;s:8:"file_ext";s:4:".jpg";}', 4, '2013-02-16 05:48:25'),
	(3, 0, 'advisor', '벌 그림', '사진', 'F:/xampp/htdocs/sns/uploads/', '7b5dd6cfa920af8476db8ae47f9be405.jpg', 'thumb_2988812521.jpg', 'a:4:{s:9:"file_size";i:13;s:11:"image_width";i:226;s:12:"image_height";i:150;s:8:"file_ext";s:4:".jpg";}', 1, '2013-02-17 04:03:44'),
	(4, 0, 'advisor', '벌 그림', '사진', 'F:/xampp/htdocs/sns/uploads/', '6ec103f9fe1ec9bab2cc3d9a9433bc1a.jpg', 'thumb_2988812521.jpg', 'a:4:{s:9:"file_size";i:13;s:11:"image_width";i:226;s:12:"image_height";i:150;s:8:"file_ext";s:4:".jpg";}', 1, '2013-02-17 04:04:10'),
	(5, 0, 'advisor', '양복2', '사진2', 'F:/xampp/htdocs/sns/uploads/', 'c56ea3b24af2490ae3bc8d9e8605d02b.jpg', 'small2013877009.jpg', 'a:4:{s:9:"file_size";i:25;s:11:"image_width";i:140;s:12:"image_height";i:140;s:8:"file_ext";s:4:".jpg";}', 26, '2013-02-17 07:19:40'),
	(8, 5, 'advisor', '', '양복댓글1', '', '', '', '', 1, '2013-02-17 04:43:39'),
	(9, 5, 'advisor', '', '댓글2', '', '', '', '', 1, '2013-02-17 04:43:58'),
	(10, 5, 'advisor', '', '댓글3', '', '', '', '', 1, '2013-02-17 04:44:31'),
	(11, 5, 'advisor', '', '댓글4', '', '', '', '', 1, '2013-02-17 04:47:00'),
	(12, 5, 'advisor', '', '댓글5', '', '', '', '', 1, '2013-02-17 04:47:33'),
	(14, 0, 'advisor', 'codeigniter 로고', '불꽃', 'F:/xampp/htdocs/sns/uploads/', 'c437244b22242e46bc637209ea18aab8.png', 'logo_ci1.png', 'a:4:{s:9:"file_size";i:2;s:11:"image_width";i:48;s:12:"image_height";i:70;s:8:"file_ext";s:4:".png";}', 1, '2013-02-17 05:30:54'),
	(15, 0, 'advisor', '해파리', '모질라 로고\r\n\r\n공룡?!!\r\n\r\nhello', 'F:/xampp/htdocs/sns/uploads/', 'a9841c30413a85d8f65d597749729bf4.jpg', 'Jellyfish.jpg', 'a:4:{s:9:"file_size";i:757;s:11:"image_width";i:1024;s:12:"image_height";i:768;s:8:"file_ext";s:4:".jpg";}', 21, '2013-02-17 11:55:22'),
	(16, 0, 'advisor', '큰 이미지', '폭이 100px 보다 큰  이미지일 경우 썸네일 만듬.', 'F:/xampp/htdocs/sns/uploads/', 'e1f017a0c29a4c49ddce0e437b446bd5.jpg', 'Penguins.jpg', 'a:4:{s:9:"file_size";i:759;s:11:"image_width";i:1024;s:12:"image_height";i:768;s:8:"file_ext";s:4:".jpg";}', 7, '2013-02-17 11:53:00'),
	(17, 0, 'advisor', '사막', '사막', 'F:/xampp/htdocs/sns/uploads/', '6d6438a28c498f114ff8aa579a0e11e6.jpg', 'Desert.jpg', 'a:4:{s:9:"file_size";i:826;s:11:"image_width";i:1024;s:12:"image_height";i:768;s:8:"file_ext";s:4:".jpg";}', 1, '2013-02-17 11:53:53'),
	(18, 0, 'advisor', '국화', '국화', 'F:/xampp/htdocs/sns/uploads/', 'e1f4bfe01c582b09a99327d962eabaca.jpg', 'Chrysanthemum.jpg', 'a:4:{s:9:"file_size";i:858;s:11:"image_width";i:1024;s:12:"image_height";i:768;s:8:"file_ext";s:4:".jpg";}', 1, '2013-02-17 11:54:04'),
	(19, 0, 'advisor', '등대', '등대', 'F:/xampp/htdocs/sns/uploads/', '59c22ce0a390771c4f6a87e4db012c0e.jpg', 'Lighthouse.jpg', 'a:4:{s:9:"file_size";i:548;s:11:"image_width";i:1024;s:12:"image_height";i:768;s:8:"file_ext";s:4:".jpg";}', 3, '2013-02-17 11:54:50'),
	(20, 0, 'advisor', '코알라', '코알라', 'F:/xampp/htdocs/sns/uploads/', 'ad1a87a2d52d40e32fc5658bdff05310.jpg', 'Koala.jpg', 'a:4:{s:9:"file_size";i:762;s:11:"image_width";i:1024;s:12:"image_height";i:768;s:8:"file_ext";s:4:".jpg";}', 9, '2013-02-17 11:55:08');
/*!40000 ALTER TABLE `sns_files` ENABLE KEYS */;


-- 테이블 ci_book의 구조를 덤프합니다. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '아이디',
  `password` varchar(50) NOT NULL COMMENT '비밀번호',
  `name` varchar(50) NOT NULL COMMENT '이름',
  `email` varchar(50) NOT NULL COMMENT '이메일',
  `reg_date` datetime NOT NULL COMMENT '가입일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='회원테이블';

-- Dumping data for table ci_book.users: 1 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `reg_date`) VALUES
	(1, 'advisor', '1234', '웅파', 'advisor@cikorea.net', '2012-07-01 12:54:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- todo 의 데이터베이스 구조 덤핑
DROP DATABASE IF EXISTS `todo`;
CREATE DATABASE IF NOT EXISTS `todo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `todo`;


-- 테이블 todo의 구조를 덤프합니다. items
DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` varchar(200) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `use` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table todo.items: 2 rows
DELETE FROM `items`;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `content`, `created_on`, `due_date`, `use`) VALUES
	(1, '웅파\r\n 미팅', '2012-09-23', '2012-09-24', 1),
	(2, '스터디\r\n', '2012-09-24', '2012-09-25', 1),
	(3, '테스트', '2012-01-01', '2013-01-01', 1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
