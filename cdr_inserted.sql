use callerid;

show triggers;

DELIMITER $$

drop TRIGGER IF EXISTS cdr_inserted $$

CREATE TRIGGER cdr_inserted AFTER INSERT ON callerid.cdr FOR EACH ROW
BEGIN

IF (NEW.port=0) THEN

INSERT INTO prq.prq_cdr SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid,
cd_calledid=NEW.calledid;

ELSE
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

END IF;/*IF (NEW.port=0) THEN */

END
$$

DELIMITER ;
