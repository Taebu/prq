/* 
prq.co.kr callerid.cdr trigger

작성일 : 2016-02-04 (목)
수정일 : 2016-05-19 (목)
1. [ 2016-05-19 (목) ] prq_first_log 추가 

 */
use callerid;

show triggers;

DELIMITER $$

drop TRIGGER IF EXISTS cdr_inserted $$

CREATE TRIGGER cdr_inserted AFTER INSERT ON callerid.cdr FOR EACH ROW
BEGIN

SET @ishp=IF(substr(NEW.callerid,1,2)="01",true,false);
SET @iskt=IF(NEW.port=0,true,false);

/* 1.KT port 핸드폰 전화인 경우  */
IF (@iskt AND @ishp) THEN

INSERT INTO prq.prq_cdr SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid,
cd_calledid=NEW.calledid;

INSERT INTO prq.prq_first_log SET 
pf_datetime=NEW.date,
pf_id=NEW.UserID,
pf_port=NEW.port,
pf_hp=NEW.callerid,
pf_tel=NEW.calledid,
pf_status='first';

/* 2. CID 핸드폰 전화인 경우  */
ELSEIF (@iskt=false AND @ishp) THEN
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

INSERT INTO prq.prq_first_log SET 
pf_datetime=NEW.date,
pf_id=NEW.UserID,
pf_port=NEW.port,
pf_name=@st_name,
pf_tel=@st_tel,
pf_hp=@st_hp,
pf_status='first';

/* 3. KT 일반전화인 경우 */
ELSEIF (@iskt AND @ishp=false) THEN

INSERT INTO prq.prq_cdr SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid,
cd_calledid=NEW.calledid;


/* 4. CID 일반전화인 경우 */
ELSEIF (@iskt=false AND @ishp=false) THEN
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

END IF;

/* IF (NEW.port=0 AND @ishp) THEN */

END
$$

DELIMITER ;