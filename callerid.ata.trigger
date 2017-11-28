-- 2017-11-27_callerid.cdr.new.trigger
use callerid;

DELIMITER $$

drop TRIGGER IF EXISTS cdr_inserted $$

CREATE TRIGGER cdr_inserted AFTER INSERT ON callerid.cdr FOR EACH ROW
BEGIN
-- 핸드폰 번호인지?
SET @ishp=IF(substr(NEW.callerid,1,2)='01',true,false);
-- kt port 인가?
SET @iskt=IF(NEW.port=0,true,false);

-- 상점 조회 상점이름, 상점번호,매장사장핸드폰 
select
	st_name,st_tel_1,st_hp_1,st_no,st_status,st_ata_YN
INTO
	@st_name,@st_tel,@st_hp,@st_no,@st_status,@st_ata_YN
FROM
	prq.prq_store 
WHERE
	st_port=NEW.port and mb_id=NEW.UserID;
IF(@st_ata_YN='Y')THEN
	/* ATA_PAY_LOG */
	select
	 ap_status,ap_autobill_YN,ap_autobill_date,ap_reserve,ap_limit,ap_limit_cnt,ap_no
	INTO
	 @ap_status,@ap_autobill_YN,@ap_autobill_date,@ap_reserve,@ap_limit,@ap_limit_cnt,@ap_no
	 from prq.prq_ata_pay where st_no=@st_no;

	-- 예약시간
	SELECT DATE_ADD(SYSDATE(), INTERVAL @ap_reserve MINUTE) INTO @date_client_req;
        
	-- 가입상태인가?
	SET @IS_ATA_JOIN=IF(@ap_status='join',true,false);

	-- 정기결재 인가?
	SET @IS_AUTOBILL_YN=IF(@ap_autobill_YN='Y',true,false);

	-- 정기 결제가 아니라 일시결제인경우 지난 여부 측정
	-- 안지났으면 true인 1, 지났으면 false인 0 
	SET @IS_LAST_ATA=(select date_add(@ap_autobill_date,interval 1 month)>=date(sysdate()));

	SET @IS_ATA_SEND=IF(@ap_status="join",true,false);

	/* 가입 상태이고 정기 결제 라면 */
	IF(@IS_ATA_JOIN=true AND @IS_AUTOBILL_YN=true) THEN

	-- 알림톡 발신 대기
	insert into prq.prq_ata_log set 
	 `date_client_req`=@date_client_req,
	 `at_ismms`='false',
	 `at_receiver`=NEW.callerid,
	 `at_sender`=NEW.calledid,
	 `at_date`=date(now()),
     `at_month_cnt`=@ap_limit_cnt,
	 `at_month_limit`=@ap_limit,
	 `st_no`=@st_no,
	 `at_status`='1',
	 `at_result`='',
     `ap_no`=@ap_no,
	 `at_datetime`=now();

	/* 가입 상태이고 일시 결제 라면 기간이 안지났으면 */
	ELSEIF(@IS_ATA_JOIN=true AND @IS_AUTOBILL_YN=false AND @IS_LAST_ATA=true) THEN
    -- 일시 결제
	insert into prq.prq_ata_log set 
	  `date_client_req`=@date_client_req,
	  `at_ismms`='false',
	  `at_receiver`=NEW.callerid,
	  `at_sender`=NEW.calledid,
	  `at_date`=date(now()),
      `at_month_cnt`=@ap_limit_cnt,
	  `at_month_limit`=@ap_limit,
	  `st_no`=@st_no,
	  `at_status`='1',
	  `at_result`='',
      `ap_no`=@ap_no,
	  `at_datetime`=now();

	END IF;

/* 알림톡이 아닌 경우 와 상점 상태에 따른 대기,해지,설치 실패 처리 여부*/
-- wa 31(대기)
ELSEIF (@st_status='wa') THEN
INSERT INTO prq.prq_cdr_tmp SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_state='31',
cd_callerid=NEW.callerid,
cd_port=NEW.port;

-- ca 32(설치실패)
ELSEIF (@st_status='ca') THEN
INSERT INTO prq.prq_cdr_tmp SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_state='32',
cd_callerid=NEW.callerid,
cd_port=NEW.port;

-- tm 33 (해지)
ELSEIF (@st_status='tm') THEN
INSERT INTO prq.prq_cdr_tmp SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_state='33',
cd_callerid=NEW.callerid,
cd_port=NEW.port;

/* 알림톡이 아닌 경우 처리중,  */
/* 1.KT port 핸드폰 전화인 경우  */
ELSEIF (@iskt AND @ishp) THEN

INSERT INTO prq.prq_cdr SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid,
cd_calledid=NEW.calledid;


/* 2. CID 핸드폰 전화인 경우  */
ELSEIF (@iskt=false AND @ishp) THEN


INSERT INTO prq.prq_cdr SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid,
cd_name=@st_name,
cd_tel=@st_tel,
cd_hp=@st_hp;

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

INSERT INTO prq.prq_cdr_tmp SET 
cd_date=NEW.date,
cd_id=NEW.UserID,
cd_port=NEW.port,
cd_callerid=NEW.callerid,
cd_name=@st_name,
cd_state='2',
cd_tel=@st_tel,
cd_hp=@st_hp;

END IF;
/* IF (NEW.port=0 AND @ishp) THEN */

END $$ 
DELIMITER ;

show triggers;