작성 : 2015-12-01 (화)
수정 : 2015-12-16 (수)
2차 수정 : 2015-12-18 (금)
게시판 관리 o
show create table prq_board \G;

게시판 파일 o
show create table prq_board_file \G;

새게시판 o
show create table prq_board_new \G;

설정 o
show create table prq_config \G;

홈페이지 가입시 정보 (개인정보처리방침, 회원가입약관) o
show create table prq_content \G;

홈페이지 질문 o
show create table prq_faq \G;

홈페이지 자주 묻는 질문 o
show create table prq_faq_master \G;

홈페이지 그룹 o
show create table prq_group \G;

홈페이지 그룹 멤버 o
show create table prq_group_member \G;

로그인 게시판 o
show create table prq_login \G;

멤버 정보 (주소,  구조변경 필요) 필수
show create table prq_member \G;

메모 o
show create table prq_memo \G;

포인트
show create table prq_point \G;

유입 검색어 o
show create table prq_popular \G;

질문하기 환경설정 o
show create table prq_qa_config \G;

질문하기 o
show create table prq_qa_content \G;

방문자 유입 o
show create table prq_visit \G;

방문자 통계 o
show create table prq_visit_sum \G;



CREATE TABLE `prq_board` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `bo_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `bo_admin` varchar(255) NOT NULL DEFAULT '',
  `bo_list_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_write_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_reply_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_comment_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_upload_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_download_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_html_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_link_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_delete` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_modify` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_point` int(11) NOT NULL DEFAULT '0',
  `bo_write_point` int(11) NOT NULL DEFAULT '0',
  `bo_comment_point` int(11) NOT NULL DEFAULT '0',
  `bo_download_point` int(11) NOT NULL DEFAULT '0',
  `bo_use_category` tinyint(4) NOT NULL DEFAULT '0',
  `bo_category_list` text NOT NULL,
  `bo_disable_tags` text NOT NULL,
  `bo_use_sideview` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_file_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_secret` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_dhtml_editor` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_rss_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_good` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_nogood` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_name` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_ip_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_file` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_table_width` int(11) NOT NULL DEFAULT '0',
  `bo_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_new` int(11) NOT NULL DEFAULT '0',
  `bo_hot` int(11) NOT NULL DEFAULT '0',
  `bo_image_width` int(11) NOT NULL DEFAULT '0',
  `bo_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_image_head` varchar(255) NOT NULL DEFAULT '',
  `bo_image_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_include_head` varchar(255) NOT NULL DEFAULT '',
  `bo_include_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_content_head` text NOT NULL,
  `bo_mobile_content_head` text NOT NULL,
  `bo_content_tail` text NOT NULL,
  `bo_mobile_content_tail` text NOT NULL,
  `bo_insert_content` text NOT NULL,
  `bo_gallery_cols` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_upload_size` int(11) NOT NULL DEFAULT '0',
  `bo_reply_order` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_search` tinyint(4) NOT NULL DEFAULT '0',
  `bo_show_menu` tinyint(4) NOT NULL DEFAULT '0',
  `bo_order` int(11) NOT NULL DEFAULT '0',
  `bo_count_write` int(11) NOT NULL DEFAULT '0',
  `bo_count_comment` int(11) NOT NULL DEFAULT '0',
  `bo_write_min` int(11) NOT NULL DEFAULT '0',
  `bo_write_max` int(11) NOT NULL DEFAULT '0',
  `bo_comment_min` int(11) NOT NULL DEFAULT '0',
  `bo_comment_max` int(11) NOT NULL DEFAULT '0',
  `bo_notice` text NOT NULL,
  `bo_upload_count` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_cert` enum('','cert','adult','hp-cert','hp-adult') NOT NULL DEFAULT '',
  `bo_use_sns` tinyint(4) NOT NULL DEFAULT '0',
  `bo_sort_field` varchar(255) NOT NULL DEFAULT '',
  `bo_1_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_2_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_3_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_4_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_5_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_6_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_7_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_8_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_9_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_10_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_1` varchar(255) NOT NULL DEFAULT '',
  `bo_2` varchar(255) NOT NULL DEFAULT '',
  `bo_3` varchar(255) NOT NULL DEFAULT '',
  `bo_4` varchar(255) NOT NULL DEFAULT '',
  `bo_5` varchar(255) NOT NULL DEFAULT '',
  `bo_6` varchar(255) NOT NULL DEFAULT '',
  `bo_7` varchar(255) NOT NULL DEFAULT '',
  `bo_8` varchar(255) NOT NULL DEFAULT '',
  `bo_9` varchar(255) NOT NULL DEFAULT '',
  `bo_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`bo_table`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_board_file` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `bf_no` int(11) NOT NULL DEFAULT '0',
  `bf_source` varchar(255) NOT NULL DEFAULT '',
  `bf_file` varchar(255) NOT NULL DEFAULT '',
  `bf_download` int(11) NOT NULL,
  `bf_content` text NOT NULL,
  `bf_filesize` int(11) NOT NULL DEFAULT '0',
  `bf_width` int(11) NOT NULL DEFAULT '0',
  `bf_height` smallint(6) NOT NULL DEFAULT '0',
  `bf_type` tinyint(4) NOT NULL DEFAULT '0',
  `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bo_table`,`wr_id`,`bf_no`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_board_new` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `bn_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`bn_id`),
  KEY `mb_id` (`mb_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_config` (
  `cf_title` varchar(255) NOT NULL DEFAULT '',
  `cf_admin` varchar(255) NOT NULL DEFAULT '',
  `cf_admin_email` varchar(255) NOT NULL DEFAULT '',
  `cf_include_index` varchar(255) NOT NULL DEFAULT '',
  `cf_include_head` varchar(255) NOT NULL DEFAULT '',
  `cf_include_tail` varchar(255) NOT NULL DEFAULT '',
  `cf_add_script` text NOT NULL,
  `cf_use_point` tinyint(4) NOT NULL DEFAULT '0',
  `cf_point_term` int(11) NOT NULL DEFAULT '0',
  `cf_use_norobot` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_copy_log` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_email_certify` tinyint(4) NOT NULL DEFAULT '0',
  `cf_login_point` int(11) NOT NULL DEFAULT '0',
  `cf_cut_name` tinyint(4) NOT NULL DEFAULT '0',
  `cf_nick_modify` int(11) NOT NULL DEFAULT '0',
  `cf_new_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_login_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_new_rows` int(11) NOT NULL DEFAULT '0',
  `cf_search_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_connect_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_read_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_point` int(11) NOT NULL DEFAULT '0',
  `cf_comment_point` int(11) NOT NULL DEFAULT '0',
  `cf_download_point` int(11) NOT NULL DEFAULT '0',
  `cf_search_bgcolor` varchar(255) NOT NULL DEFAULT '',
  `cf_search_color` varchar(255) NOT NULL DEFAULT '',
  `cf_write_pages` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_pages` int(11) NOT NULL DEFAULT '0',
  `cf_link_target` varchar(255) NOT NULL DEFAULT '',
  `cf_delay_sec` int(11) NOT NULL DEFAULT '0',
  `cf_filter` text NOT NULL,
  `cf_possible_ip` text NOT NULL,
  `cf_intercept_ip` text NOT NULL,
  `cf_analytics` text NOT NULL,
  `cf_add_meta` text NOT NULL,
  `cf_register_skin` varchar(255) NOT NULL DEFAULT 'basic',
  `cf_member_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_use_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_point` int(11) NOT NULL DEFAULT '0',
  `cf_icon_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_recommend` tinyint(4) NOT NULL DEFAULT '0',
  `cf_recommend_point` int(11) NOT NULL DEFAULT '0',
  `cf_leave_day` int(11) NOT NULL DEFAULT '0',
  `cf_search_part` int(11) NOT NULL DEFAULT '0',
  `cf_email_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_group_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_board_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_write` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_comment_all` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_po_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_po_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_mb_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_mb_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_wr_comment_all` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_wr_write` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_wr_board_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_wr_group_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_gcm_wr_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_prohibit_id` text NOT NULL,
  `cf_prohibit_email` text NOT NULL,
  `cf_new_del` int(11) NOT NULL DEFAULT '0',
  `cf_memo_del` int(11) NOT NULL DEFAULT '0',
  `cf_visit_del` int(11) NOT NULL DEFAULT '0',
  `cf_popular_del` int(11) NOT NULL DEFAULT '0',
  `cf_use_jumin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_member_icon` tinyint(4) NOT NULL DEFAULT '0',
  `cf_member_icon_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_height` int(11) NOT NULL DEFAULT '0',
  `cf_login_minutes` int(11) NOT NULL DEFAULT '0',
  `cf_image_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_flash_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_movie_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_formmail_is_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_visit` varchar(255) NOT NULL DEFAULT '',
  `cf_max_po_id` int(11) NOT NULL DEFAULT '0',
  `cf_stipulation` text NOT NULL,
  `cf_privacy` text NOT NULL,
  `cf_open_modify` int(11) NOT NULL DEFAULT '0',
  `cf_memo_send_point` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_new_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_mobile_search_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_mobile_connect_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_mobile_member_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_captcha_mp3` varchar(255) NOT NULL DEFAULT '',
  `cf_editor` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_cert_ipin` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_hp` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcb_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcp_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_limit` int(11) NOT NULL DEFAULT '0',
  `cf_sms_use` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_id` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_pw` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_server_ip` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_server_port` varchar(255) NOT NULL DEFAULT '',
  `cf_googl_shorturl_apikey` varchar(255) NOT NULL DEFAULT '',
  `cf_gcm_apikey` varchar(255) NOT NULL,
  `cf_facebook_appid` varchar(255) NOT NULL,
  `cf_facebook_secret` varchar(255) NOT NULL,
  `cf_twitter_key` varchar(255) NOT NULL,
  `cf_twitter_secret` varchar(255) NOT NULL,
  `cf_1_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_2_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_3_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_4_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_5_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_6_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_7_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_8_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_9_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_10_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_1` varchar(255) NOT NULL DEFAULT '',
  `cf_2` varchar(255) NOT NULL DEFAULT '',
  `cf_3` varchar(255) NOT NULL DEFAULT '',
  `cf_4` varchar(255) NOT NULL DEFAULT '',
  `cf_5` varchar(255) NOT NULL DEFAULT '',
  `cf_6` varchar(255) NOT NULL DEFAULT '',
  `cf_7` varchar(255) NOT NULL DEFAULT '',
  `cf_8` varchar(255) NOT NULL DEFAULT '',
  `cf_9` varchar(255) NOT NULL DEFAULT '',
  `cf_10` varchar(255) NOT NULL DEFAULT ''
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_content` (
  `co_id` varchar(20) NOT NULL DEFAULT '',
  `co_html` tinyint(4) NOT NULL DEFAULT '0',
  `co_subject` varchar(255) NOT NULL DEFAULT '',
  `co_content` longtext NOT NULL,
  `co_hit` int(11) NOT NULL DEFAULT '0',
  `co_include_head` varchar(255) NOT NULL,
  `co_include_tail` varchar(255) NOT NULL,
  PRIMARY KEY (`co_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_faq` (
  `fa_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_id` int(11) NOT NULL DEFAULT '0',
  `fa_subject` text NOT NULL,
  `fa_content` text NOT NULL,
  `fa_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fa_id`),
  KEY `fm_id` (`fm_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_faq_master` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_subject` varchar(255) NOT NULL DEFAULT '',
  `fm_head_html` text NOT NULL,
  `fm_tail_html` text NOT NULL,
  `fm_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fm_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_group` (
  `gr_id` varchar(10) NOT NULL DEFAULT '',
  `gr_subject` varchar(255) NOT NULL DEFAULT '',
  `gr_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `gr_admin` varchar(255) NOT NULL DEFAULT '',
  `gr_use_access` tinyint(4) NOT NULL DEFAULT '0',
  `gr_show_menu` tinyint(4) NOT NULL DEFAULT '0',
  `gr_order` int(11) NOT NULL DEFAULT '0',
  `gr_1_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_2_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_3_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_4_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_5_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_6_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_7_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_8_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_9_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_10_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_1` varchar(255) NOT NULL DEFAULT '',
  `gr_2` varchar(255) NOT NULL DEFAULT '',
  `gr_3` varchar(255) NOT NULL DEFAULT '',
  `gr_4` varchar(255) NOT NULL DEFAULT '',
  `gr_5` varchar(255) NOT NULL DEFAULT '',
  `gr_6` varchar(255) NOT NULL DEFAULT '',
  `gr_7` varchar(255) NOT NULL DEFAULT '',
  `gr_8` varchar(255) NOT NULL DEFAULT '',
  `gr_9` varchar(255) NOT NULL DEFAULT '',
  `gr_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`gr_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_group_member` (
  `gm_id` int(11) NOT NULL AUTO_INCREMENT,
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `gm_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`gm_id`),
  KEY `gr_id` (`gr_id`),
  KEY `mb_id` (`mb_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_login` (
  `lo_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `lo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lo_location` text NOT NULL,
  `lo_url` text NOT NULL,
  PRIMARY KEY (`lo_ip`)
) DEFAULT CHARSET=utf8;

drop  TABLE `prq_member`;

Create Table: CREATE TABLE `prq_member` (
  `mb_no` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prq_fcode` char(18) NOT NULL DEFAULT '',
  `mb_gcode` char(3) NOT NULL DEFAULT 'G8',
  `mb_gtype` char(2) NOT NULL DEFAULT 'AD',
  `mb_pcode` char(6) NOT NULL DEFAULT 'AD0001',
  `mb_code` char(6) NOT NULL DEFAULT 'TS0000',
  `mb_gname_eng` varchar(255) NOT NULL DEFAULT '',
  `mb_gname_kor` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `mb_password` varchar(255) NOT NULL DEFAULT '',
  `mb_name` varchar(255) NOT NULL DEFAULT '',
  `mb_nick` varchar(255) NOT NULL DEFAULT '',
  `mb_nick_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_email` varchar(255) NOT NULL DEFAULT '',
  `mb_homepage` varchar(255) NOT NULL DEFAULT '',
  `mb_password_q` varchar(255) NOT NULL DEFAULT '',
  `mb_password_a` varchar(255) NOT NULL DEFAULT '',
  `mb_business_name` varchar(255) NOT NULL DEFAULT '',
  `mb_business_paper` varchar(255) NOT NULL DEFAULT '',
  `mb_distributors_paper` varchar(255) NOT NULL DEFAULT '',
  `mb_bank_paper` varchar(255) NOT NULL DEFAULT '',
  `mb_business_num` varchar(255) NOT NULL DEFAULT '',
  `mb_exactcaculation_ratio` varchar(255) NOT NULL DEFAULT '',
  `mb_bankname` varchar(255) NOT NULL DEFAULT '',
  `mb_banknum` varchar(255) NOT NULL DEFAULT '',
  `mb_bankholder` varchar(255) NOT NULL DEFAULT '',
  `mb_bigo` varchar(255) NOT NULL DEFAULT '',
  `mb_level` tinyint(4) NOT NULL DEFAULT '0',
  `mb_jumin` varchar(255) NOT NULL DEFAULT '',
  `mb_sex` char(1) NOT NULL DEFAULT '',
  `mb_birth` varchar(255) NOT NULL DEFAULT '',
  `mb_tel` varchar(255) NOT NULL DEFAULT '',
  `mb_hp` varchar(255) NOT NULL DEFAULT '',
  `mb_certify` varchar(20) NOT NULL DEFAULT '',
  `mb_adult` tinyint(4) NOT NULL DEFAULT '0',
  `mb_zip1` char(3) NOT NULL DEFAULT '',
  `mb_zip2` char(3) NOT NULL DEFAULT '',
  `mb_addr1` varchar(255) NOT NULL DEFAULT '',
  `mb_addr2` varchar(255) NOT NULL DEFAULT '',
  `mb_addr3` varchar(255) NOT NULL DEFAULT '',
  `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `mb_signature` text NOT NULL,
  `mb_recommend` varchar(255) NOT NULL DEFAULT '',
  `mb_point` int(11) NOT NULL DEFAULT '0',
  `mb_today_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_login_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_leave_date` varchar(8) NOT NULL DEFAULT '',
  `mb_intercept_date` varchar(8) NOT NULL DEFAULT '',
  `mb_email_certify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_memo` text NOT NULL,
  `mb_lost_certify` varchar(255) NOT NULL,
  `mb_mailling` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sms` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_profile` text NOT NULL,
  `mb_memo_call` varchar(255) NOT NULL DEFAULT '',
  `mb_1` varchar(255) NOT NULL DEFAULT '',
  `mb_2` varchar(255) NOT NULL DEFAULT '',
  `mb_3` varchar(255) NOT NULL DEFAULT '',
  `mb_4` varchar(255) NOT NULL DEFAULT '',
  `mb_5` varchar(255) NOT NULL DEFAULT '',
  `mb_6` varchar(255) NOT NULL DEFAULT '',
  `mb_7` varchar(255) NOT NULL DEFAULT '',
  `mb_8` varchar(255) NOT NULL DEFAULT '',
  `mb_9` varchar(255) NOT NULL DEFAULT '',
  `mb_10` varchar(255) NOT NULL DEFAULT '',
  `mb_ceoname` varchar(255) DEFAULT '',
  `mb_imgprefix` char(6) DEFAULT '201501',
  `mb_business_paper_size` int(10) unsigned DEFAULT '0',
  `mb_distributors_paper_size` int(10) unsigned DEFAULT '0',
  `mb_bank_paper_size` int(10) unsigned DEFAULT '0',
  `mb_status` enum('wa','pr','ac','ad','ec','ca') NOT NULL DEFAULT 'wa',
  PRIMARY KEY (`mb_no`),
  UNIQUE KEY `mb_id` (`mb_id`),
  KEY `mb_today_login` (`mb_today_login`),
  KEY `mb_datetime` (`mb_datetime`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_memo` (
  `me_id` int(11) NOT NULL DEFAULT '0',
  `me_recv_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_read_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_memo` text NOT NULL,
  PRIMARY KEY (`me_id`),
  KEY `me_recv_mb_id` (`me_recv_mb_id`)
) DEFAULT CHARSET=utf8;


CREATE TABLE `prq_point` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `po_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL DEFAULT '',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_use_point` int(11) NOT NULL DEFAULT '0',
  `po_expired` tinyint(4) NOT NULL DEFAULT '0',
  `po_expire_date` date NOT NULL DEFAULT '0000-00-00',
  `po_mb_point` int(11) NOT NULL DEFAULT '0',
  `po_rel_table` varchar(20) NOT NULL DEFAULT '',
  `po_rel_id` varchar(20) NOT NULL DEFAULT '',
  `po_rel_action` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`po_id`),
  KEY `index1` (`mb_id`,`po_rel_table`,`po_rel_id`,`po_rel_action`),
  KEY `index2` (`po_expire_date`)
) DEFAULT CHARSET=utf8
1 row in set (0.00 sec)

CREATE TABLE `prq_popular` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_word` varchar(50) NOT NULL DEFAULT '',
  `pp_date` date NOT NULL DEFAULT '0000-00-00',
  `pp_ip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`pp_id`),
  UNIQUE KEY `index1` (`pp_date`,`pp_word`,`pp_ip`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_qa_config` (
  `qa_title` varchar(255) NOT NULL DEFAULT '',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_sms` tinyint(4) NOT NULL DEFAULT '0',
  `qa_send_number` varchar(255) NOT NULL DEFAULT '0',
  `qa_admin_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_admin_email` varchar(255) NOT NULL DEFAULT '',
  `qa_use_editor` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_image_width` int(11) NOT NULL DEFAULT '0',
  `qa_upload_size` int(11) NOT NULL DEFAULT '0',
  `qa_insert_content` text NOT NULL,
  `qa_1_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_2_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_3_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_4_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_5_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT ''
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_qa_content` (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT,
  `qa_num` int(11) NOT NULL DEFAULT '0',
  `qa_parent` int(11) NOT NULL DEFAULT '0',
  `qa_related` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `qa_name` varchar(255) NOT NULL DEFAULT '',
  `qa_email` varchar(255) NOT NULL DEFAULT '',
  `qa_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_type` tinyint(4) NOT NULL DEFAULT '0',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_email_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_sms_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_html` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject` varchar(255) NOT NULL DEFAULT '',
  `qa_content` text NOT NULL,
  `qa_status` tinyint(4) NOT NULL DEFAULT '0',
  `qa_file1` varchar(255) NOT NULL DEFAULT '',
  `qa_source1` varchar(255) NOT NULL DEFAULT '',
  `qa_file2` varchar(255) NOT NULL DEFAULT '',
  `qa_source2` varchar(255) NOT NULL DEFAULT '',
  `qa_ip` varchar(255) NOT NULL DEFAULT '',
  `qa_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`qa_id`),
  KEY `qa_num_parent` (`qa_num`,`qa_parent`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_visit` (
  `vi_id` int(11) NOT NULL DEFAULT '0',
  `vi_ip` varchar(255) NOT NULL DEFAULT '',
  `vi_date` date NOT NULL DEFAULT '0000-00-00',
  `vi_time` time NOT NULL DEFAULT '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`vi_id`),
  UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  KEY `index2` (`vi_date`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `prq_visit_sum` (
  `vs_date` date NOT NULL DEFAULT '0000-00-00',
  `vs_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vs_date`),
  KEY `index1` (`vs_count`)
) DEFAULT CHARSET=utf8;



alter table prq_member add mb_ceoname varchar(255) default '';
alter table prq_member add mb_business_paper_size int unsigned default 0;
alter table prq_member add mb_distributors_paper_size int unsigned default 0;
alter table prq_member add mb_bank_paper_size int unsigned default 0;


-- 2015-12-28 (월)
alter table prq_member add mb_status enum('wa','pr','ac','ad','ec','ca') not NULL default 'wa';
update prq_member set mb_status='ca' where mb_no='14';


-- 2015-12-29 (화)
alter table prq_member add `mb_pcode` char(6) not NULL default 'AD0001' after `mb_gcode`;


CREATE TABLE `prq_log` (
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `lo_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_no` int(11) NOT NULL DEFAULT '0',
  `prq_table` varchar(255) NOT NULL DEFAULT '',
  `lo_status` varchar(255) NOT NULL DEFAULT '',
  `lo_how` varchar(255) NOT NULL DEFAULT '',
  `lo_reason`  varchar(255) NOT NULL DEFAULT '',
  `mb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`mb_id`,`prq_table`,`mb_datetime`)
) DEFAULT CHARSET=utf8;


ALTER TABLE `prq_log` DROP PRIMARY KEY;

-- 2015-12-30 (수) mb_gtype char(2) 추가
alter table prq_member add `mb_gtype` char(2) not NULL default 'AD' after `mb_gcode`;

alter table prq_member_code add `mb_gtype` char(2) not NULL default 'AD' after `mb_pcode`;



mysql> update  prq_member_code set mb_gtype=mb_pcode;
Query OK, 11 rows affected (0.00 sec)
Rows matched: 12  Changed: 11  Warnings: 0


-- 컬럼 위치 변경 mb_pcode -> mb_gtype 

alter table prq_member_code change mb_pcode mb_pcode char(6) default '';
alter table prq_member_code change mb_pcode mb_pcode char(6) after `mb_no`;
alter table prq_member_code change mb_gtype mb_gtype char(2) after `mb_no`;



-- 2015-12-31 (목)


/* 대분류 총판 */
CREATE TABLE prq_dscode (
  ds_code char(6) NOT NULL default '',
  ds_name varchar(50) default NULL,
  PRIMARY KEY  (ds_code)
);

/* 중분류 대리점 : pt_code에 ds_code를 포함한다. */
CREATE TABLE prq_ptcode (
  pt_code varchar(12) NOT NULL default '',
  pt_name varchar(50) default NULL,
  PRIMARY KEY  (pt_code)
);

/* 소분류 가맹점 fr_code에 ds_code를 포함한다. */
CREATE TABLE prq_frcode (
  fr_code varchar(18) NOT NULL default '',
  fr_name varchar(50) default NULL,
  view_index int(11) default NULL,
  PRIMARY KEY  (fr_code)
);


-- 이와 같이 추가 하고 실제 code 만들어 질 때 내부적으로 이렇게 관리 되도록 변경 할 것


ALTER TABLE `prq_member` add `prq_fcode` char(18) NOT NULL default '' after `mb_no`;

-- 2016-01-04 (월)
alter table prq_log add prq_fcode char(18) default '' after mb_no;

-- 2016-01-07 (목)
insert into `prq_frcode` set fr_code='DS0001PT0001FR0001',fr_name="가맹점1";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0002',fr_name="가맹점2";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0003',fr_name="가맹점3";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0004',fr_name="가맹점4";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0005',fr_name="가맹점5";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0006',fr_name="가맹점6";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0007',fr_name="가맹점7";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0008',fr_name="가맹점8";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0009',fr_name="가맹점9";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0010',fr_name="가맹점10";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0011',fr_name="가맹점11";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0012',fr_name="가맹점12";
insert into `prq_frcode` set fr_code='DS0001PT0001FR0013',fr_name="가맹점13";

-- 2016-01-09 (토)
-- prq_member 참고...

DROP TABLE `prq_store`;

CREATE TABLE `prq_store` (
  `st_no` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prq_fcode` char(18) NOT NULL DEFAULT '',
  `st_category` varchar(255) NOT NULL DEFAULT '',
  `st_name` varchar(255) NOT NULL DEFAULT '',
  `st_tel` varchar(255) NOT NULL DEFAULT '',
  `st_open` char(5) NOT NULL DEFAULT '09:00',
  `st_closed` char(5) NOT NULL DEFAULT '19:00',
  `st_alltime` enum('off','on') NOT NULL DEFAULT 'off',
  `st_closingdate` varchar(255) NOT NULL DEFAULT '',
  `st_destination` varchar(255) NOT NULL DEFAULT '',
  `st_intro` varchar(255) NOT NULL DEFAULT '',
  `st_password` varchar(255) NOT NULL DEFAULT '',
  `st_nick` varchar(255) NOT NULL DEFAULT '',
  `st_nick_date` date NOT NULL DEFAULT '0000-00-00',
  `st_email` varchar(255) NOT NULL DEFAULT '',
  `st_homepage` varchar(255) NOT NULL DEFAULT '',
  `st_business_name` varchar(255) NOT NULL DEFAULT '',
  `st_business_paper` varchar(255) NOT NULL DEFAULT '',
  `st_business_paper_size` int(10) unsigned DEFAULT '0',
  `st_thumb_paper` varchar(255) NOT NULL DEFAULT '',
  `st_thumb_paper_size` int(10) unsigned DEFAULT '0',
  `st_menu_paper` varchar(255) NOT NULL DEFAULT '',
  `st_menu_paper_size` int(10) unsigned DEFAULT '0',
  `st_main_paper` varchar(255) NOT NULL DEFAULT '',
  `st_main_paper_size` int(10) unsigned DEFAULT '0',
  `st_modoo_url` varchar(255) NOT NULL DEFAULT '',
  `st_top_msg` varchar(255) NOT NULL DEFAULT '',
  `st_middle_msg` varchar(2000) NOT NULL DEFAULT '',
  `st_bottom_msg` varchar(255) NOT NULL DEFAULT '',
  `st_business_num` varchar(255) NOT NULL DEFAULT '',
  `st_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `st_status` enum('wa','pr','ac','ad','ec','ca') NOT NULL DEFAULT 'wa',
  PRIMARY KEY (`st_no`),
  KEY `st_datetime` (`st_datetime`)
) DEFAULT CHARSET=utf8;


-- 2016-01-27 (수)
-- token_id 추가 
CREATE TABLE `prq_token_id` (
  `pt_idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `token_id` varchar(255) NOT NULL,
  `regdate` datetime NOT NULL,
  PRIMARY KEY (`pt_idx`,`phone`,`token_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 2016-01-29 (금)

user prq;
CREATE TABLE `prq_cdr` (
  `cd_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cd_id` varchar(30) NOT NULL,
  `cd_port` varchar(10) NOT NULL DEFAULT '',
  `cd_callerid` varchar(30) NOT NULL DEFAULT '',
  `cd_calledid` varchar(30) DEFAULT '',
  `cd_state` tinyint(1) DEFAULT '0'
);


use callerid;

show triggers;

DELIMITER $$

drop TRIGGER IF EXISTS cdr_inserted $$

CREATE TRIGGER cdr_inserted AFTER INSERT ON callerid.cdr FOR EACH ROW
BEGIN
insert into prq.prq_cdr set 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid;
END
$$

DELIMITER ;



ALTER TABLE `prq_store` add st_cidtype enum('ktcid','callcid')  NOT NULL default 'ktcid';
ALTER TABLE `prq_store` add st_tel_1 varchar(30) NOT NULL default '';
ALTER TABLE `prq_store` add st_tel_2 varchar(30) NOT NULL default '';
ALTER TABLE `prq_store` add st_tel_3 varchar(30) NOT NULL default '';
ALTER TABLE `prq_store` add st_tel_4 varchar(30) NOT NULL default '';
ALTER TABLE `prq_store` add st_hp_1 varchar(30) NOT NULL default '';
ALTER TABLE `prq_store` add st_hp_2 varchar(30) NOT NULL default '';
ALTER TABLE `prq_store` add st_hp_3 varchar(30) NOT NULL default '';
ALTER TABLE `prq_store` add st_hp_4 varchar(30) NOT NULL default '';

ALTER TABLE `prq_member` add `prq_fcode` char(18) NOT NULL default '' after `mb_no`;

ALTER TABLE `prq_log` DROP PRIMARY KEY;

ALTER TABLE `prq_store` DROP st_tel_2;
ALTER TABLE `prq_store` DROP st_tel_3;
ALTER TABLE `prq_store` DROP st_tel_4;

ALTER TABLE `prq_store` DROP st_hp_2;
ALTER TABLE `prq_store` DROP st_hp_3;
ALTER TABLE `prq_store` DROP st_hp_4;

-- 2016-02-02 (화)
ALTER TABLE `prq_store` add st_port tinyint NOT NULL default 1;

ALTER TABLE `prq_store` add `mb_id` varchar(20) NOT NULL DEFAULT '' after `prq_fcode`;

-- 2016-02-03 (수)



CREATE TABLE `callerid`.`black_hp` (
  `bl_hp` varchar(30) NOT NULL DEFAULT '',
  `bl_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bl_hp`)
) DEFAULT CHARSET=utf8;


insert into `callerid`.`black_hp` set bl_hp='01012345678' bl_datetime=now();
select * from `callerid`.`black_hp`;


cd_name=@st_name,
cd_tel_1=@st_tel_1,
cd_hp_1=@st_hp_1;



ALTER TABLE `prq_cdr` add cd_name varchar(255) NOT NULL default '';
ALTER TABLE `prq_cdr` add cd_tel varchar(30) NOT NULL default '';
ALTER TABLE `prq_cdr` add cd_hp varchar(30) NOT NULL default '';

ALTER TABLE `callerid`.`black_hp` add bl_gubun char(1) NOT NULL default '1';
ALTER TABLE `callerid`.`black_hp` add bl_dnis varchar(30) NOT NULL default '';
ALTER TABLE `callerid`.`black_hp` add bl_duration int NOT NULL default 0;

-- 2016-02-05 (금)
ALTER TABLE `prq_store` add st_mno enum('SK','LG','KT') NULL default 'SK';


INSERT INTO `cdr` VALUES ('2016-02-04 20:23:55','01099358800','01099358800','05085125336','from-trunk','SIP/mug_2-000b3664','SIP/mug_1-000b3666','Dial','SIP/mug_1/0316130092,60,m(c002gl_1)A(c002gl_2)L(7200000)',38,31,'ANSWERED',3,'0316130092','1454585035.734974','audio:OUT-20160204-202355-1454585035.734974.wav');

INSERT INTO `cdr` VALUES ('2016-02-04 21:54:00','01031887230','01031887230','05085125880','from-trunk','SIP/mug_2-000b3b75','SIP/mug_1-000b3b76','Dial','SIP/mug_1/0314076665,60,m(gl_1)A(gl_2)L(7200000)','76','67','ANSWERED','3','0314076665','1454590440.736271','audio:OUT-20160204-215400-1454590440.736271.wav');
INSERT INTO `cdr` VALUES ('2016-02-04 20:02:14','01024591106','01024591106','05085154350','from-trunk','SIP/mug_2-000b352f','SIP/mug_1-000b3530','Dial','SIP/mug_1/0553835235,60,m(a041ca_1)A(a041ca_2)L(7200000)','96','90','ANSWERED','3','0553835235','1454583734.734665','audio:OUT-20160204-200214-1454583734.734665.wav');

-- 2016-02-11 (목)

drop  TABLE `prq_mno`;
CREATE TABLE `prq_mno` (
  `mn_no` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mn_id` varchar(255) NOT NULL,
  `mn_email` varchar(255) NOT NULL,
  `mn_hp` char(18) NOT NULL,
  `mn_type` enum('MMS','SMS','LMS') NOT NULL DEFAULT 'MMS',
  `mn_operator` enum('MMS','SMS','LMS') NOT NULL DEFAULT 'MMS',
  `mn_model` varchar(255) NOT NULL,
  `mn_version` varchar(255) NOT NULL,
  `mn_mms_limit` tinyint(4) NOT NULL,
  `mn_dup_limit` tinyint(4) NOT NULL,
  `mn_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`mn_no`),
  UNIQUE KEY `mn_id` (`mn_id`)
) DEFAULT CHARSET=utf8;

ALTER TABLE `prq_mno` add mn_operator enum('SK','LG','KT') NULL default 'SK';

-- 2016-02-12 (금)

CREATE TABLE `prq_gcm_log` (
  `gc_no` int(11) NOT NULL AUTO_INCREMENT,
  `gc_subject`  varchar(255) DEFAULT NULL COMMENT '발송 제목',
  `gc_content`  text COMMENT '발송 내용',
  `gc_ismms` enum('false','true') NOT NULL DEFAULT 'false'  COMMENT 'GCM만 혹은 MMS 같이 전송여부',
  `gc_receiver`  varchar(16) DEFAULT NULL DEFAULT '0' COMMENT '수신번호',
  `gc_sender`  varchar(16) DEFAULT NULL DEFAULT '0' COMMENT '발신번호',
  `gc_imgurl`  varchar(255) DEFAULT NULL DEFAULT '' COMMENT '이미지 전송 URL',
  `gc_result` varchar(255) NOT NULL COMMENT '전송결과',
  `gc_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gc_status` char(1) NOT NULL  DEFAULT 'I',
  `gc_ipaddr` varchar (15) NOT NULL DEFAULT '',
  PRIMARY KEY (`gc_no`)
) DEFAULT CHARSET=utf8  COMMENT='GCM LOG';

CREATE TABLE `prq_mms_log` (
  `mm_no` int(11) NOT NULL AUTO_INCREMENT,
  `mm_subject`  varchar(255) DEFAULT NULL COMMENT '발송 제목',
  `mm_content`  text COMMENT '발송 내용',
  `mm_type` enum('mms','sms','lms') NOT NULL DEFAULT 'mms' COMMENT '발송 타입 기본값 mms',
  `mm_receiver`  varchar(16) DEFAULT NULL DEFAULT '0' COMMENT '수신번호',
  `mm_sender`  varchar(16) DEFAULT NULL DEFAULT '0' COMMENT '발신번호',
  `mm_imgurl`  varchar(255) DEFAULT NULL DEFAULT '' COMMENT '이미지 전송 URL',
  `mm_result` varchar(255) NOT NULL COMMENT '전송결과',
  `mm_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mm_status` char(1) DEFAULT 'I',
  `mm_ipaddr` varchar (15) NOT NULL DEFAULT '',
  PRIMARY KEY (`mm_no`)
) DEFAULT CHARSET=utf8  COMMENT='MMS LOG';

ALTER TABLE `prq_mno` change mn_operator  mn_operator enum('SK','LG','KT','UNKNOWN') NULL default 'SK';

-- 2016-02-15 (월)
ALTER TABLE `prq_gcm_log` add gc_stno int NOT NULL default 0;
ALTER TABLE `prq_mms_log` add mm_stno int NOT NULL default 0;

-- 2016-02-22 (월)
ALTER TABLE `prq_store` add st_vtel varchar(30) NOT NULL default '';

ALTER TABLE `prq_store` add st_teltype  enum('prq','cashq') NULL default 'prq';

-- 2016-02-23 (화)
alter table prq_store change mb_id mb_id varchar(255) NOT NULL default '';
alter table prq_member change mb_id mb_id varchar(255) NOT NULL default '';

show create table prq_store \G;

alter table prq_cdr change cd_id cd_id varchar(255) NOT NULL default '';

alter table cdr change UserID UserID varchar(255) NOT NULL default '';

-- 2016-02-24 (수)
alter table prq_member change mb_pcode mb_pcode char(12) NOT NULL default '';

-- 2016-02-25 (목)
CREATE TABLE `prq_visit` (
  `vi_id` int(11) NOT NULL DEFAULT '0',
  `vi_ip` varchar(255) NOT NULL DEFAULT '',
  `vi_date` date NOT NULL DEFAULT '0000-00-00',
  `vi_time` time NOT NULL DEFAULT '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`vi_id`),
  UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  KEY `index2` (`vi_date`)
);
insert into `prq_visit` set
  `vi_ip`='123.52',
  `vi_date`='2016-02-25',
  `vi_time`='15:28:00',
  `vi_referer`='url',
  `vi_agent`='kk';
insert into `prq_visit` set
  `vi_ip`='123.52',
  `vi_date`='2016-02-25',
  `vi_time`='15:28:00',
  `vi_referer`='url',
  `vi_agent`='kk';

-- 2016-03-02 (수)
-- 통계 페이지
CREATE TABLE `prq_stat` (
  `st_date` date  NOT NULL DEFAULT '0000-00-00',
  `st_sender`  varchar(20) DEFAULT NULL COMMENT '발신인',
  `st_cnt`  int NOT NULL default 0
) DEFAULT CHARSET=utf8  COMMENT='STAT LOG';

INSERT INTO prq_stat select '2016-02-29',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-29')=date(gc_datetime) group by gc_sender;

INSERT INTO prq_stat select '2016-02-12',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-12')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-13',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-13')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-14',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-14')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-15',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-15')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-16',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-16')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-17',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-17')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-18',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-18')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-19',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-19')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-20',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-20')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-21',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-21')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-22',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-22')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-23',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-23')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-24',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-24')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-25',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-25')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-26',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-26')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-27',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-27')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-28',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-28')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-29',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-29')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-03-01',gc_sender,count(*) cnt from prq_gcm_log where date('2016-03-01')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-03-02',gc_sender,count(*) cnt from prq_gcm_log where date('2016-03-02')=date(gc_datetime) group by gc_sender;


INSERT INTO prq_stat select '2016-02-03',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-03')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-04',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-04')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-05',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-05')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-06',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-06')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-07',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-07')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-08',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-08')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-09',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-09')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-10',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-10')=date(gc_datetime) group by gc_sender;
INSERT INTO prq_stat select '2016-02-11',gc_sender,count(*) cnt from prq_gcm_log where date('2016-02-11')=date(gc_datetime) group by gc_sender;

-- 2016-03-08 (화)
-- prq_mno 변경 코드 추가

ALTER TABLE `prq_mno` add mn_appvcode varchar(255) NULL default '';
ALTER TABLE `prq_mno` add mn_appvname varchar(255) NULL default '';


-- prq_mms_log 변경 코드 추가
ALTER TABLE `prq_mms_log` add `mm_monthly_cnt` varchar(255) NULL default '';
ALTER TABLE `prq_mms_log` add `mm_daily_cnt`  varchar(255) NULL default '';


-- 2016-03-09 (수)

use callerid;

show triggers;

DELIMITER $$

drop TRIGGER IF EXISTS cdr_inserted $$

CREATE TRIGGER cdr_inserted AFTER INSERT ON callerid.cdr FOR EACH ROW
BEGIN
insert into prq.prq_cdr set 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid;
END
$$

DELIMITER ;

drop TABLE `prq_mms_limit`;
CREATE TABLE `prq_mms_limit` (
  `ml_no` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ml_email` varchar(255) NOT NULL ,
  `ml_monthly_limit` int(11) unsigned NOT NULL DEFAULT 3000,
  `ml_daily_limit` int(11) unsigned NOT NULL DEFAULT 150,
  `ml_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ml_no`)
) DEFAULT CHARSET=utf8;


use callerid;

show triggers;

DELIMITER $$

drop TRIGGER IF EXISTS cdr_inserted $$

CREATE TRIGGER cdr_inserted AFTER INSERT ON callerid.cdr FOR EACH ROW
BEGIN
insert into prq.prq_cdr set 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid;
END
$$

DELIMITER ;
use callerid;

show triggers;

DELIMITER $$

drop TRIGGER IF EXISTS cdr_inserted $$

CREATE TRIGGER cdr_inserted AFTER INSERT ON callerid.cdr FOR EACH ROW
BEGIN
SELECT
	st_name,st_tel_1,st_hp_1
INTO
	@st_name,@st_tel,@st_hp
FROM 
	prq.prq_store 
WHERE 
	st_port=NEW.port and mb_id=NEW.UserID;

INSERT INTO prq.prq_cdr SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid,
cd_name=@st_name,
cd_tel=@st_tel,
cd_hp=@st_hp;

END
$$

DELIMITER ;

-- 2016-03-10 (목)
unique key create
create unique index "유니크키명" ON "테이블명"("컬럼명", "컬럼명");
-- | st_date    | st_sender     | st_cnt |

create unique index `lms_key` ON `prq_stat`(`st_date`,`st_sender`);
unique key drop
--drop index "유니크명" ON "테이블명";


ALTER TABLE  prq_cdr  add cd_day_cnt int(11) NOT NULL DEFAULT 0;
ALTER TABLE  prq_cdr  add cd_day_limit int(11) NOT NULL DEFAULT 150;

-- 2016-03-11 (금)

select cd_day_cnt from prq_cdr where date(cd_date)=date(now()) and cd_state=1 and cd_id='leesukkee@naver.com';
SET @cnt=0;
update prq_cdr set cd_day_cnt=@cnt:=@cnt+1 where date(cd_date)=date(now()) and cd_state=1 and cd_id='leesukkee@naver.com';


select cd_day_cnt from prq_cdr where date(cd_date)=date(now()) and cd_state=1 and cd_id='siheung0003@naver.com';
SET @cnt=0;
update prq_cdr set cd_day_cnt=@cnt:=@cnt+1 where date(cd_date)=date(now()) and cd_state=1 and cd_id='siheung0003@naver.com';


select cd_day_cnt from prq_cdr where date(cd_date)=date(now()) and cd_state=1 and cd_id='prq001@naver.com';
SET @cnt=0;
update prq_cdr set cd_day_cnt=@cnt:=@cnt+1 where date(cd_date)=date(now()) and cd_state=1 and cd_id='prq001@naver.com';

select cd_day_cnt from prq_cdr where date(cd_date)=date(DATE_SUB(now(), INTERVAL 1 DAY)) and cd_state=1 and cd_id='leesukkee@naver.com';
SET @cnt=0;
update prq_cdr set cd_day_cnt=@cnt:=@cnt+1 where date(cd_date)=date(DATE_SUB(now(), INTERVAL 1 DAY)) and cd_state=1 and cd_id='leesukkee@naver.com';


select cd_day_cnt from prq_cdr where date(cd_date)=date(DATE_SUB(now(), INTERVAL 1 DAY)) and cd_state=1 and cd_id='siheung0003@naver.com';
SET @cnt=0;
update prq_cdr set cd_day_cnt=@cnt:=@cnt+1 where date(cd_date)=date(DATE_SUB(now(), INTERVAL 1 DAY)) and cd_state=1 and cd_id='siheung0003@naver.com';


select * from prq_cdr where date(cd_date)=date(now()) and cd_state=1 and cd_hp='01028365246';

ALTER TABLE  prq_cdr  add cd_device_day_cnt int(11) NOT NULL DEFAULT 0;