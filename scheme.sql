최초 작성 : 2015-12-28 (월)


alter table prq_member add mb_status enum('wa','pr','ac','ad','ec','ca') not NULL default 'wa';

update prq_member set mb_status='ca' where mb_no='14';