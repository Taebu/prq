-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: ci_book
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `ci_book`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ci_book` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ci_book`;

--
-- Table structure for table `ci_board`
--

DROP TABLE IF EXISTS `ci_board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_board` (
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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='CodeIgniter 게시판';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_board`
--

LOCK TABLES `ci_board` WRITE;
/*!40000 ALTER TABLE `ci_board` DISABLE KEYS */;
INSERT INTO `ci_board` VALUES (1,0,'advisor','웅파','안녕하세요','첫글이네요.',7,'2012-06-12 22:23:01'),(2,0,'advisor','웅파','두번째 글입니다.','두번째글이네요.',0,'2012-06-12 22:24:01'),(3,0,'advisor','웅파','세번째 글입니다.','세번째글이네요.',2,'2012-06-12 22:24:01'),(4,0,'advisor','웅파','네번째 글입니다.','네번째글이네요.',9,'2012-06-12 22:24:01'),(5,0,'advisor','웅파','다섯번째 글입니다.','다섯번째글이네요.',5,'2012-06-12 22:24:01'),(8,0,'advisor','웅파','여덞번째 글입니다.2','여덞번째글이네요.2',14,'2012-06-12 22:24:01'),(9,0,'advisor','웅파','아홉번째 글입니다.','아홉번째글이네요.',6,'2012-06-12 22:24:01'),(10,0,'advisor','웅파','열번째 글입니다.','열번째글이네요.',13,'2012-06-12 22:24:01'),(11,1,'blumine','웅파1','첫번째 글의 첫번째 댓글입니다.','첫번째 댓글이네요.',1,'2012-06-12 22:26:01'),(12,1,'blumine','웅파1','첫번째 글의 두번째 댓글입니다.','두번째 댓글이네요.',0,'2012-06-12 22:27:01'),(13,2,'blumine','웅파1','두번째 글의 첫번째 댓글입니다.','두번째 글의 첫번째 댓글이네요.',9,'2012-06-12 22:29:01'),(24,4,'advisor','advisor','','3333',0,'2012-10-09 17:17:22'),(22,4,'advisor','advisor','','1111',0,'2012-10-09 17:17:19'),(25,4,'advisor','advisor','','4444',0,'2012-11-07 14:09:59'),(28,0,'erm00','문실장','쓰기 테스트 입니다.','잘 될까요?\n\n수정 테스트 입니다.\n\nㅎㅎㅎㅎㅎㅎㅎ',6,'2015-11-29 17:12:52'),(29,0,'erm00','문실장','564654','564564564',1,'2015-11-29 21:46:50'),(30,0,'erm00','문실장','제목 수정 테스트중','내용 테스트 줄 바꾹',13,'2015-11-29 21:47:02'),(31,30,'erm00','erm00','','7897897',8,'2015-11-29 21:47:10'),(32,30,'erm00','erm00','','897897',0,'2015-11-29 21:47:13'),(34,0,'erm00','문실장','rur 수정','ejribkk 수정',18,'2015-12-02 23:09:12');
/*!40000 ALTER TABLE `ci_board` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('54415613396739384a5a9bcdcfb70a4f','192.168.0.8','Mozilla/5.0 (Linux; U; en-us; KFAPWI Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.13 Safari/535.19 Silk-Ac',1449089429,''),('e6dc7125362ea7c8da541382c4a74076','192.168.0.8','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36',1449102334,''),('f093b72b890bcfdcb3dd315fa83a3084','192.168.0.8','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36',1449089380,'a:4:{s:8:\"username\";s:5:\"erm00\";s:4:\"name\";s:9:\"문실장\";s:5:\"email\";s:15:\"erm00@naver.com\";s:9:\"logged_in\";b:1;}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_files`
--

DROP TABLE IF EXISTS `sns_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_files` (
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='SNS 프로젝트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_files`
--

LOCK TABLES `sns_files` WRITE;
/*!40000 ALTER TABLE `sns_files` DISABLE KEYS */;
INSERT INTO `sns_files` VALUES (2,0,'advisor','다람쥐','다람쥐 사진 테스트 업로드','/var/www/codeigniter/sns/uploads','f3f88649f5f729031baada79d973f651.jpg','다람쥐.jpg','a:4:{s:9:\"file_size\";i:12;s:11:\"image_width\";i:226;s:12:\"image_height\";i:150;s:8:\"file_ext\";s:4:\".jpg\";}',4,'2013-02-16 05:48:25'),(3,0,'advisor','벌 그림','사진','/var/www/codeigniter/sns/uploads','7b5dd6cfa920af8476db8ae47f9be405.jpg','thumb_2988812521.jpg','a:4:{s:9:\"file_size\";i:13;s:11:\"image_width\";i:226;s:12:\"image_height\";i:150;s:8:\"file_ext\";s:4:\".jpg\";}',1,'2013-02-17 04:03:44'),(4,0,'advisor','벌 그림','사진','/var/www/codeigniter/sns/uploads','6ec103f9fe1ec9bab2cc3d9a9433bc1a.jpg','thumb_2988812521.jpg','a:4:{s:9:\"file_size\";i:13;s:11:\"image_width\";i:226;s:12:\"image_height\";i:150;s:8:\"file_ext\";s:4:\".jpg\";}',1,'2013-02-17 04:04:10'),(5,0,'advisor','양복2','사진2','/var/www/codeigniter/sns/uploads','c56ea3b24af2490ae3bc8d9e8605d02b.jpg','small2013877009.jpg','a:4:{s:9:\"file_size\";i:25;s:11:\"image_width\";i:140;s:12:\"image_height\";i:140;s:8:\"file_ext\";s:4:\".jpg\";}',26,'2013-02-17 07:19:40'),(8,5,'advisor','','양복댓글1','','','','',1,'2013-02-17 04:43:39'),(9,5,'advisor','','댓글2','','','','',1,'2013-02-17 04:43:58'),(10,5,'advisor','','댓글3','','','','',1,'2013-02-17 04:44:31'),(11,5,'advisor','','댓글4','','','','',1,'2013-02-17 04:47:00'),(12,5,'advisor','','댓글5','','','','',1,'2013-02-17 04:47:33'),(14,0,'advisor','codeigniter 로고','불꽃','/var/www/codeigniter/sns/uploads','c437244b22242e46bc637209ea18aab8.png','logo_ci1.png','a:4:{s:9:\"file_size\";i:2;s:11:\"image_width\";i:48;s:12:\"image_height\";i:70;s:8:\"file_ext\";s:4:\".png\";}',1,'2013-02-17 05:30:54'),(15,0,'advisor','해파리','모질라 로고\\r\\n\\r\\n공룡?!!\\r\\n\\r\\nhello','/var/www/codeigniter/sns/uploads','a9841c30413a85d8f65d597749729bf4.jpg','Jellyfish.jpg','a:4:{s:9:\"file_size\";i:757;s:11:\"image_width\";i:1024;s:12:\"image_height\";i:768;s:8:\"file_ext\";s:4:\".jpg\";}',21,'2013-02-17 11:55:22'),(16,0,'advisor','큰 이미지','폭이 100px 보다 큰  이미지일 경우 썸네일 만듬.','/var/www/codeigniter/sns/uploads','e1f017a0c29a4c49ddce0e437b446bd5.jpg','Penguins.jpg','a:4:{s:9:\"file_size\";i:759;s:11:\"image_width\";i:1024;s:12:\"image_height\";i:768;s:8:\"file_ext\";s:4:\".jpg\";}',7,'2013-02-17 11:53:00'),(17,0,'advisor','사막','사막','/var/www/codeigniter/sns/uploads','6d6438a28c498f114ff8aa579a0e11e6.jpg','Desert.jpg','a:4:{s:9:\"file_size\";i:826;s:11:\"image_width\";i:1024;s:12:\"image_height\";i:768;s:8:\"file_ext\";s:4:\".jpg\";}',1,'2013-02-17 11:53:53'),(18,0,'advisor','국화','국화','/var/www/codeigniter/sns/uploads','e1f4bfe01c582b09a99327d962eabaca.jpg','Chrysanthemum.jpg','a:4:{s:9:\"file_size\";i:858;s:11:\"image_width\";i:1024;s:12:\"image_height\";i:768;s:8:\"file_ext\";s:4:\".jpg\";}',1,'2013-02-17 11:54:04'),(19,0,'advisor','등대','등대','/var/www/codeigniter/sns/uploads','59c22ce0a390771c4f6a87e4db012c0e.jpg','Lighthouse.jpg','a:4:{s:9:\"file_size\";i:548;s:11:\"image_width\";i:1024;s:12:\"image_height\";i:768;s:8:\"file_ext\";s:4:\".jpg\";}',4,'2013-02-17 11:54:50'),(20,0,'advisor','코알라','코알라','/var/www/codeigniter/sns/uploads','ad1a87a2d52d40e32fc5658bdff05310.jpg','Koala.jpg','a:4:{s:9:\"file_size\";i:762;s:11:\"image_width\";i:1024;s:12:\"image_height\";i:768;s:8:\"file_ext\";s:4:\".jpg\";}',11,'2013-02-17 11:55:08'),(21,0,'erm00','1미터 피자','피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자\n\n줄바꿈\n피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자피자','/var/www/codeigniter/sns/uploads/','94212e824b72b180f60af9395ffc6f65.png','1미터피자_.png','a:4:{s:9:\"file_size\";i:27;s:11:\"image_width\";i:130;s:12:\"image_height\";i:180;s:8:\"file_ext\";s:4:\".png\";}',13,'2015-11-29 23:14:30'),(22,0,'erm00','49쌀피자','49쌀피자','/var/www/codeigniter/sns/uploads/','6264f4b427aefd6f753714077a44407c.png','49쌀피자.png','a:4:{s:9:\"file_size\";i:39;s:11:\"image_width\";i:130;s:12:\"image_height\";i:180;s:8:\"file_ext\";s:4:\".png\";}',5,'2015-11-29 23:15:16'),(23,0,'erm00','갈비탕','갈비탕','/var/www/codeigniter/sns/uploads/','d2e310ce220c34d0e4f7aec3038b28f4.jpg','갈비탕.jpg','a:4:{s:9:\"file_size\";i:603;s:11:\"image_width\";i:1248;s:12:\"image_height\";i:832;s:8:\"file_ext\";s:4:\".jpg\";}',14,'2015-11-29 23:45:42');
/*!40000 ALTER TABLE `sns_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '아이디',
  `password` varchar(50) NOT NULL COMMENT '비밀번호',
  `name` varchar(50) NOT NULL COMMENT '이름',
  `email` varchar(50) NOT NULL COMMENT '이메일',
  `reg_date` datetime NOT NULL COMMENT '가입일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='회원테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'advisor','1234','웅파','advisor@cikorea.net','2012-07-01 12:54:23'),(2,'erm00','ifsmvfkf12','문실장','erm00@naver.com','2015-11-29 17:08:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-03  9:41:59
