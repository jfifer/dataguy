DROP PROCEDURE IF EXISTS gen_psa_tables;

CREATE PROCEDURE gen_psa_tables ()
BEGIN

CREATE TABLE jeopardy_accts (
jep_id SERIAL,
resellerName VARCHAR(255),
contract_level VARCHAR(155),
psa VARCHAR(155),
phase_two_begin DATE,
ninety_day_review DATE,
onetwenty_day_review DATE,
gap_cat VARCHAR(155),
rem_cat VARCHAR(155),
notes TEXT,
next_action TEXT,
next_call DATE,
created_by VARCHAR(155),
created_at TIMESTAMP
) ENGINE=Innodb;

-- HISTORY

CREATE TABLE jeopardy_accts_his (
jep_his_id SERIAL,
jep_id BIGINT(20) UNSIGNED,
resellerName VARCHAR(255),
contract_level VARCHAR(155),
psa VARCHAR(155),
phase_two_begin DATE,
ninety_day_review DATE,
onetwenty_day_review DATE,
gap_cat VARCHAR(155),
rem_cat VARCHAR(155),
notes TEXT,
next_action TEXT,
next_call DATE,
created_by VARCHAR(155),
created_at TIMESTAMP,
created_his_at TIMESTAMP
) ENGINE=Innodb;

CREATE TABLE gap_cat (
gap_cat_id SERIAL,
code VARCHAR(155),
description VARCHAR(255)
) ENGINE=Innodb;

CREATE TABLE rem_cat (
rem_cat_id SERIAL,
code VARCHAR(155),
description VARCHAR(255)
) ENGINE=Innodb;

END

-- Cleanup / Move History for jeopardy accounts

CREATE PROCEDURE delete_jeopardy (in_resellerName VARCHAR(155))
BEGIN

INSERT INTO jeopardy_accts_his (jep_id,resellerName,contract_level,
                                psa,phase_two_begin,ninety_day_review,
                                onetwenty_day_review,gap_cat,rem_cat,
                                notes,next_action,next_call,created_by,
                                created_at,created_his_at
                                )
  SELECT jep_id,
         resellerName,
         contract_level,
         psa,
         phase_two_begin,
         ninety_day_review,
         onetwenty_day_review,
         gap_cat,
         rem_cat,
         notes,
         next_action,
         next_call,
         created_by,
         created_at,
         NOW()
    FROM jeopardy_accts
   WHERE resellerName= in_resellerName;

   DELETE FROM jeopardy_accts WHERE resellerName=in_resellerName;

END

-- Add entry

CREATE PROCEDURE add_jeopardy (
  in_resellerName VARCHAR(155),
  in_contract_level VARCHAR(155),
  in_psa VARCHAR(155),
  in_phase_two VARCHAR(155),
  in_ninety_day VARCHAR(155),
  in_onetwenty VARCHAR(155),
  in_gap_cat VARCHAR(155),
  in_rem_cat VARCHAR(155),
  in_notes VARCHAR(255),
  in_next_action VARCHAR(255),
  in_next_call VARCHAR(155)
)
BEGIN

INSERT INTO jeopardy_accts (
                                jep_id,resellerName,contract_level,
                                psa,phase_two_begin,ninety_day_review,
                                onetwenty_day_review,gap_cat,rem_cat,
                                notes,next_action,next_call,created_by,
                                created_at
                                )
VALUES (
  DEFAULT,
  in_resellerName,
  in_contract_level,
  in_psa,
  CAST(in_phase_two AS DATE),
  CAST(in_ninety_day AS DATE),
  CAST(in_onetwenty AS DATE),
  in_gap_cat,
  in_rem_cat,
  CAST(in_notes AS CHAR(200)),
  CAST(in_next_action AS CHAR(200)),
  CAST(in_next_call AS DATE),
  "SYSTEM ADMIN",
  NOW()
);


END



-- Update Entry


DROP PROCEDURE IF EXISTS update_jeopardy;
CREATE PROCEDURE update_jeopardy (
  in_jep_id INT(11),
  in_resellerName VARCHAR(155),
  in_contract_level VARCHAR(155),
  in_psa VARCHAR(155),
  in_phase_two VARCHAR(155),
  in_ninety_day VARCHAR(155),
  in_onetwenty VARCHAR(155),
  in_gap_cat VARCHAR(155),
  in_rem_cat VARCHAR(155),
  in_notes VARCHAR(255),
  in_next_action VARCHAR(255),
  in_next_call VARCHAR(155)
)
BEGIN

DECLARE var_phase_two_begin DATE;
DECLARE var_ninety_day_review DATE;
DECLARE var_onetwenty_day_review DATE;
DECLARE var_notes CHAR(255);
DECLARE var_next_action CHAR(255);
DECLARE var_next_call DATE;

SET var_phase_two_begin = STR_TO_DATE(in_phase_two,'%Y-%m-%d');
SET var_ninety_day_review = CAST(in_ninety_day AS DATE);
SET var_onetwenty_day_review = CAST(in_onetwenty AS DATE);
SET var_notes = CAST(in_notes AS CHAR(200));
SET var_next_action = CAST(in_next_action AS CHAR(200));
SET var_next_call = CAST(in_next_call AS DATE);

UPDATE jeopardy_accts

SET
 contract_level=in_contract_level,
 psa=in_psa,
 phase_two_begin=var_phase_two_begin,
 ninety_day_review=var_ninety_day_review,
 onetwenty_day_review=var_onetwenty_day_review,
 gap_cat=in_gap_cat,
 rem_cat=in_rem_cat,
 notes=var_notes,
 next_action=var_next_action,
 next_call=var_next_call,
 created_by="SYSTEM ADMIN",
WHERE jep_id=in_jep_id;

END




-- Test inserts for jeopardy_accts

INSERT INTO jeopardy_accts
  VALUES (
  	     DEFAULT,
  	     "EscapeWire Solutions",
  	     "Certified",
  	     "Dunbar",
  	     "2015/12/14",
  	     "2016/03/14",
  	     "2016/04/12",
  	     "RD, RLF",
  	     "PRE",
  	     "Just entered 2 sales into portal.",
  	     "Validate partners new sales",
  	     "2016/04/05",
  	     "SYSTEM ADMIN",
  	     NOW()
  	     );

  INSERT INTO jeopardy_accts
  VALUES (
         DEFAULT,
         "West Tech Comm",
         "Certified",
         "Jenkins",
         "2015/11/16",
         "2016/02/15",
         "2016/03/15",
         "RD, RLF",
         "PRE, ROR, SSP",
         "1/4/15-Check In;  2/15/16-Jackie sent 90 Day Snapshot; 2/16/16-Ken sent out Bullet points for Sales Overview",
         "1. Call with Sean Bartley to set up you in house demo- THIS WEEK.
2. Call with Ken and your team to do a mock sales demo.",
         "2016/04/14",
         "SYSTEM ADMIN",
         NOW()
         );

  INSERT INTO jeopardy_accts
  VALUES (
         DEFAULT,
         "BDK, Inc.",
         "Certified",
         "Jenkins",
         "2015/12/14",
         "2016/03/02",
         "2016/04/05",
         "RD, OST",
         "PRDY",
         "1/4/16- Check In and RS call",
         "slow movers, just did FOA porting for their account, pending FOA,4/6 No Show",
         "2016/04/19",
         "SYSTEM ADMIN",
         NOW()
         );

    INSERT INTO jeopardy_accts
  VALUES (
         DEFAULT,
         "Point One Electrical Systems, Inc.",
         "Certified",
         "McDonald",
         "2015/12/16",
         "2016/03/10",
         "2016/04/14",
         "OST,RD,OWF",
         "PRE",
         "Spk to Shane 3/14----reviewed proposals ",
         "next call 3/11/2016--Ken is apart of the call, Partner cancelled that too--rescheduled",
         "2016/04/20",
         "SYSTEM ADMIN",
         NOW()
         );

      INSERT INTO jeopardy_accts
  VALUES (
         DEFAULT,
         "Comprehensive Data Services, Inc.",
         "Certified",
         "McDonald",
         "2015/12/17",
         "2016/03/17",
         "2016/04/15",
         "MLG, MM, RLF, MLK",
         "PRE",
         "Spk to Mike ,Ken 3/18/16--he completed his marketing Slicks, & really is waiting to here back from potential clients that have interest. Delay was related to other focus of the business--they added 500 endpoints right before they signed with Coredial, so maintain both entitys is a challenge.",
         "Mike agreed he'll contact us if things pick-up sooner--he may a 30 seat deal --its really unknown @ the moment -if the customer is still fishing /not ",
         "2016/04/15",
         "SYSTEM ADMIN",
         NOW()
         );

INSERT INTO jeopardy_accts
VALUES (
          DEFAULT,
         "Celtic Communications",
         "Certified",
         "McDonald",
         "2015/12/14",
         "2016/03/14",
         "2016/04/12",
         "SLF,T,WF,SM",
         "PRE",
         "Spk to Deb, Michael, Ken 3/15 reviewed proposals Campbell Rosemurgy ",
         "Celtic is really waiting for customer termed contracts to end before proceeding--they will be green once they get started",
         "2016/04/15",
         "SYSTEM ADMIN",
         NOW()
         );

INSERT INTO jeopardy_accts
VALUES (
          DEFAULT,
         "Packetel Networks",
         "Certified",
         "McDonald",
         NULL,
         NULL,
         NULL,
         "RD",
         NULL,
         "Ken spoke to CLay 3/18/16",
         "Next call scheduled with Ken",
         "2016/04/14",
         "SYSTEM ADMIN",
         NOW()
         );


INSERT INTO jeopardy_accts
VALUES (
          DEFAULT,
         "Dental PC",
         "Certified",
         "McDonald",
         NULL,
         NULL,
         NULL,
         "RD",
         NULL,
         "Ken spoke to CLay 3/18/16",
         "Next call scheduled with Ken",
         "2016/04/15",
         "SYSTEM ADMIN",
         NOW()
         );


  -- Test inserts for categories

INSERT INTO gap_cat
VALUES
(DEFAULT,'MLG', 'Marketing Lead Generation issues'),
(DEFAULT,'MM',  'Marketing Lack of Materials'),
(DEFAULT,'MW',  'Marketing No Website/Not Updated'),
(DEFAULT,'PFK', 'Product Feature Knowledge'),
(DEFAULT,'PIK', 'Product Industry Knowledge'),
(DEFAULT,'PCM', 'Product Competing for Mindshare'),
(DEFAULT,'PQI', 'Product Quality Issues'),
(DEFAULT,'PRI', 'Product Reliability Issues'),
(DEFAULT,'RD',  'Roll-Out Delayed'),
(DEFAULT,'RFS', 'Roll-Out False/Failed Start'),
(DEFAULT,'RLF', 'Roll-Out Lack of Focus'),
(DEFAULT,'RNP', 'Roll-Out No Plan'),
(DEFAULT,'RM',  'Roll-Out Mindshare'),
(DEFAULT,'SC',  'Sales Channel Issues'),
(DEFAULT,'SCB', 'Sales No/Limited Customer Base'),
(DEFAULT,'SK',  'Sales Knowledge'),
(DEFAULT,'SLF', 'Sales Lack of Focus'),
(DEFAULT,'SM',  'Sales Motivation'),
(DEFAULT,'OST', 'Organizational Staff Issues'),
(DEFAULT,'OWF', 'Organizational Work Flow Issues');



INSERT INTO rem_cat
VALUES
(DEFAULT,'AW','Accounting WorkFlow'),
(DEFAULT,'AF','Accounting Functions Review'),
(DEFAULT,'MLK','Marketing Starter Kit of Leads'),
(DEFAULT,'MLP','Marketing Lead Generation Plan'),
(DEFAULT,'MMC','Marketing Materials/Collaterals'),
(DEFAULT,'MWP','Marketing Website Plan'),
(DEFAULT,'PRE','Partner Re-Engage/ Restart'),
(DEFAULT,'PRDY','Partner Ready to Become Positive'),
(DEFAULT,'ROP' ,'Roll-Out Plan'),
(DEFAULT,'ROR' ,'Roll-Out Restart Plan'),
(DEFAULT,'SDP' ,'Sales Demo Plan'),
(DEFAULT,'SPM' ,'Sales Pricing Model'),
(DEFAULT,'SSP' ,'Sales Strategy Plan'),
(DEFAULT,'STP' ,'Sales Tactical Plan'),
(DEFAULT,'STR' ,'Sales Training'),
(DEFAULT,'TTR' ,'Technical Training');













































