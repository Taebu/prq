2017-01-04 (수) 15:00:23 
```sql
mysql> show create table codes\G;
*************************** 1. row ***************************
       Table: codes
Create Table: CREATE TABLE `codes` (
  `code` int(6) NOT NULL,
  `pcode` int(6) NOT NULL,
  `code_name` varchar(100) DEFAULT NULL,
  `code_value` varchar(100) DEFAULT NULL,
  `seq` int(3) DEFAULT NULL,
  `use_bit` char(1) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
1 row in set (0.00 sec)
```

```sql
mysql> show create table store_icon\G;
*************************** 1. row ***************************
       Table: store_icon
Create Table: CREATE TABLE `store_icon` (
  `st_seq` int(10) unsigned NOT NULL,
  `si_code` int(10) unsigned NOT NULL,
  `si_value` varchar(50) NOT NULL DEFAULT '',
  `si_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8
1 row in set (0.00 sec)

ERROR:
No query specified
```

두개의 테이블 분석하여 만들것 
cashq.codes -> prq.prq_codes 
cashq.store_icon -> prq.prq_values 

```sql
mysql> show create table codes\G;
CREATE TABLE `prq_codes` (
  `code` int(6) NOT NULL comment '키값이 되는 코드',
  `pcode` int(6) NOT NULL  comment '코드의 부모 코드',
  `code_name` varchar(100) DEFAULT NULL comment  '코드의 이름',
  `code_value` varchar(100) DEFAULT NULL comment  '코드의 설명',
  `seq` int(3) DEFAULT NULL,
  `use_bit` char(1) NOT NULL DEFAULT '1' comment  '코드의 사용여부',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```

```sql
CREATE TABLE `prq_values` (
  `pv_code` int(10) unsigned NOT NULL comment 'codes의 code값',
  `pv_no` int(10) unsigned NOT NULL comment '기관 인덱스',
  `pv_value` varchar(50) NOT NULL DEFAULT '' comment 'codes의 code값',
  `pv_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```