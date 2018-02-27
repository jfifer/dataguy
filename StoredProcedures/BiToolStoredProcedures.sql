-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: portal
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu0.14.04.1
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`portal`@`localhost`*/ /*!50003 TRIGGER `branch_device_id`
BEFORE INSERT ON `device`
FOR EACH ROW
BEGIN
    DECLARE nseq INT;

    SELECT COALESCE(MAX(`branchDeviceId`), 0) + 1
    INTO nseq
    FROM `device`
    WHERE `branchId` = NEW.`branchId`;

    SET NEW.`branchDeviceId` = nseq;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`portal`@`localhost`*/ /*!50003 TRIGGER `profile_is_sys_check_insert`
    BEFORE INSERT ON `profile`
    FOR EACH ROW BEGIN
        IF NEW.is_system = 0 THEN
            SET NEW.level = NULL;
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`portal`@`localhost`*/ /*!50003 TRIGGER `profile_is_sys_check_update`
    BEFORE UPDATE ON `profile`
    FOR EACH ROW BEGIN
        IF NEW.is_system = 0 THEN
            SET NEW.level = NULL;
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`portal`@`localhost`*/ /*!50003 TRIGGER `branch_sla_line_id`
BEFORE INSERT ON `slaLine`
FOR EACH ROW
BEGIN
    DECLARE nseq INT;
    DECLARE nbranch INT;
    SELECT `branchId`
    INTO nbranch
    FROM `slaGroup`
    WHERE `slaGroup`.`slaGroupId` = NEW.`slaGroupId`;

    SELECT COALESCE(MAX(`branchSlaLineId`), 0) + 1
    INTO nseq
    FROM `slaLine`
    WHERE NEW.`slaGroupId` IN (SELECT `slaGroupId` FROM `slaGroup` WHERE `branchId` = nbranch);

    SET NEW.`branchSlaLineId` = nseq;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping routines for database 'portal'
--
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `archive_voicemail_activity_sp`()
BEGIN

  DECLARE minStamp, maxStamp TIMESTAMP;

  SELECT MIN(timestamp) 
    INTO minStamp
    FROM voicemail_activity;
  
  SELECT MAX(created_at) 
    INTO maxStamp
    FROM voicemail_activity_history;
    
  IF (minStamp > maxStamp) OR (maxStamp IS NULL) THEN
      
    INSERT INTO voicemail_activity_history 
    (
     voicemail_activity_id,
     timestamp,
     userId,
     organization_id,
     mailboxId,
     mailboxNumber,
     activity
    )
    SELECT voicemail_activity_id,
           timestamp,
           userId,
           organization_id,
           mailboxId,
           mailboxNumber,
           activity           
      FROM voicemail_activity;
    
    TRUNCATE voicemail_activity;    
     
  END IF;     

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cleanUpSipProxyUsers`()
BEGIN

DECLARE done INT DEFAULT FALSE;
DECLARE sipBranchId INT(11);
DECLARE sipTrunkBranchId INT(11);
DECLARE SIPUsername VARCHAR(100);
DECLARE DIDNumber VARCHAR(100);
DECLARE branchVar, sipBranchVar,customerIdVar INT(11);
DECLARE sipCurs CURSOR 
FOR
  SELECT st.branchId,
         stn.branchId,
         st.sipUsername,
         d.didNumber
    FROM sipTrunk st
    JOIN sipTrunkNumber stn ON (st.branchId = stn.branchId)
    JOIN did d ON (stn.branchId = d.branchId)
   WHERE (st.sipUsername = d.didNumber);
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

OPEN sipCurs;
  cur_loop: LOOP

    FETCH sipCurs 
     INTO sipBranchId, 
          sipTrunkBranchId,
          SIPUsername, 
          DIDNumber;

    IF (done) THEN
      LEAVE cur_loop;
    END IF;

    SELECT b.branchId, sipBranchId
      INTO branchVar, sipBranchVar
      FROM branch b
      JOIN did d ON (b.branchId = d.branchId)
     WHERE (d.didNumber = DIDNumber)
     LIMIT 1;

     IF (branchVar != sipBranchVar) THEN
   
       SELECT c.customerId 
         INTO customerIdVar 
         FROM did d 
         JOIN branch b USING (branchId) 
         JOIN customer c ON (b.customerId = c.customerId) 
        WHERE c.statusId = 1 
          AND (d.didNumber = DIDNumber)
        LIMIT 1;
       
     IF (
         SELECT c.statusId
           FROM sipTrunk st
           JOIN customer c ON (st.customerId = c.customerId)
          WHERE (st.branchId = sipBranchVar)
            AND c.statusId != 1
         ) THEN

         SELECT c.statusId, c.customerId, b.branchId branchId, st.branchId sipBranch, st.sipUsername
           FROM customer c
           JOIN branch b ON (c.customerId = b.customerId)
           JOIN sipTrunk st ON (c.customerId = st.customerId)
          WHERE (st.branchId = sipBranchVar);

       END IF;
     END IF;

  END LOOP;

CLOSE sipCurs;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `clean_up`()
BEGIN
 
 DECLARE done INT DEFAULT FALSE;
 DECLARE v_resellerId, v_customerId, v_activationDate VARCHAR(150);
 DECLARE v_counter INT DEFAULT 0;
 DECLARE get_customers CURSOR 
 FOR select reseller_id, customer_id , activation_date from tmp_table;
 /**
 SELECT c.resellerId,
            c.customerId,            
            MIN(oi.activationDate) AS "activation_date"
  FROM customer c
  LEFT JOIN invoice USING (customerId)
  LEFT JOIN orders o ON (c.customerId= o.customerId)
  LEFT JOIN orderItem oi ON (o.orderId = oi.orderId)
 WHERE c.anniversaryDate IS NULL
   AND c.statusId NOT IN (2,3)
   AND oi.activationDate IS NOT NULL
 GROUP BY c.customerId
 ORDER BY c.companyName;
 **/
 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

 OPEN get_customers;
  cust_loop: LOOP
   
   FETCH get_customers
    INTO v_resellerId, v_customerId, v_activationDate;

   IF (done) THEN
     LEAVE cust_loop;
   END IF;
   
   SET v_counter = v_counter + 1;
   IF (v_customerId IS NOT NULL) THEN
   
   SELECT v_resellerId, v_customerId, v_activationDate;
   SELECT CONCAT("Completed: ",v_counter) AS "INFO:";
    /** 
     UPDATE customer 
        SET anniversaryDate = v_activationDate
      WHERE customerId = v_customerId
        AND resellerId = v_resellerId
        AND anniversaryDate IS NULL;
     **/   
        END IF;
  END LOOP;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_cdr`(IN cdrName VARCHAR(25))
BEGIN

SET @newCdr = cdrName;
SET @createDB = CONCAT('CREATE DATABASE ', @newCdr);
SET @createTable = CONCAT('CREATE TABLE IF NOT EXISTS ',@newCdr,'.cdr','(
 calldate datetime NOT NULL DEFAULT ''0000-00-00 00:00:00'',
 clid varchar(80) NOT NULL DEFAULT '''',
 src varchar(80) NOT NULL DEFAULT '''',
 dst varchar(80) NOT NULL DEFAULT '''',
 dcontext varchar(80) NOT NULL DEFAULT '''',
 channel varchar(80) NOT NULL DEFAULT '''',
 dstchannel varchar(80) NOT NULL DEFAULT '''',
 lastapp varchar(80) NOT NULL DEFAULT '''',
 lastdata varchar(80) NOT NULL DEFAULT '''',
 duration int(11) NOT NULL DEFAULT 0,
 billsec int(11) NOT NULL DEFAULT 0,
 disposition varchar(45) NOT NULL DEFAULT '''',
 amaflags int(11) NOT NULL DEFAULT 0,
 accountcode varchar(20) NOT NULL DEFAULT '''',
 uniqueid varchar(32) NOT NULL DEFAULT '''',
 userfield varchar(255) NOT NULL DEFAULT '''',
 cd_accountcode varchar(255) DEFAULT NULL,
 cd_branchId int(11) unsigned DEFAULT NULL,
 cd_pathcount int(11) unsigned DEFAULT NULL,
 id int(11) NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (id),
 KEY calldate (calldate),
 KEY userfield (userfield),
 KEY lastapp (lastapp),
 KEY channel (channel),
 KEY dstchannel (dstchannel),
 KEY cd_branchId (cd_branchId),
 KEY cd_pathcount (cd_pathcount)
) ENGINE=MyISAM');
SET @createPBXuser = CONCAT("GRANT ALL PRIVILEGES ON ",@newCdr,".*"," TO pbx@'%' IDENTIFIED BY 'JC9mEKP9G6d6cVQ'");

PREPARE dbCreate FROM @createDB;
PREPARE tableCreate FROM @createTable;
PREPARE PBXuser FROM @createPBXuser;


SELECT CONCAT('Creating: ',cdrName) AS 'Info';

IF NOT EXISTS (
               SELECT SCHEMA_NAME 
                 FROM INFORMATION_SCHEMA.SCHEMATA 
                WHERE SCHEMA_NAME = cdrName
              )  THEN
                 EXECUTE dbCreate;
                 DEALLOCATE PREPARE dbCreate;
                 EXECUTE tableCreate;
                 DEALLOCATE PREPARE tableCreate;
END IF;

IF NOT EXISTS (
               SELECT user
                 FROM mysql.user
                WHERE user = 'pbx'
              )  THEN
                 EXECUTE PBXuser;
                 DEALLOCATE PREPARE PBXuser;
END IF;

IF NOT EXISTS (
               SELECT user
                 FROM mysql.user
                WHERE user = 'portal'
              )  THEN
                  SELECT 1;
                 
                 
END IF;
                 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `customerServicesDrillIn`(in_customer_id INT(11))
BEGIN

DECLARE origActivation, currentDate, thisYear, nextYear DATE;
DECLARE didCount, extCount, mailCount, aaCount, getInterval, yearCounter INT(11);

SELECT CURDATE() INTO currentDate;

SELECT DATE(originalActivationDate)
  INTO origActivation
  FROM customer
 WHERE customerId = in_customer_id;

SELECT (YEAR(currentDate) - YEAR(origActivation)) INTO getInterval;

IF (getInterval > 1) THEN

  SET nextYear = (SELECT date_add(origActivation, INTERVAL 11 MONTH));
  SET yearCounter = (getInterval + 1);
  SET thisYear = origActivation;
  
    WHILE yearCounter > 0 DO

      SELECT COUNT(DISTINCT(d.didId))
        INTO didCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN did d ON (b.branchId = d.branchId)
       WHERE c.statusId NOT IN (2,3)
         AND c.customerId = in_customer_id
         AND d.isActive
         AND b.isProvisioned
         AND d.cnamChanged BETWEEN origActivation AND nextYear;
                  
      SELECT COUNT(DISTINCT(extensionId))
        INTO extCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN did d ON (b.branchId = d.branchId)
        JOIN extension e ON (b.branchId = e.branchId)
       WHERE c.statusId NOT IN (2,3)
         AND e.extensionTypeId=1
         AND e.isFreeExtension=0
         AND c.customerId = in_customer_id
         AND d.isActive
         AND b.isProvisioned
         AND d.cnamChanged BETWEEN origActivation AND nextYear;
                         
      SELECT COUNT(DISTINCT(mailBoxId))
        INTO mailCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN mailbox m ON (b.branchId = m.branchId)
        JOIN did d ON (b.branchId = d.branchId)
       WHERE c.statusId NOT IN (2,3)
         AND c.customerId = in_customer_id
         AND d.isActive
         AND b.isProvisioned
         AND d.cnamChanged BETWEEN origActivation AND nextYear;
         
      SELECT COUNT(DISTINCT(aaId))
        INTO aaCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN aa ON (b.branchId = aa.branchId)
        JOIN did d ON (b.branchId = d.branchId)
       WHERE c.statusId NOT IN (2,3)
        AND c.customerId = in_customer_id
        AND d.isActive
        AND b.isProvisioned
        AND d.cnamChanged BETWEEN origActivation AND nextYear;

      INSERT INTO customerServicesDrillIn VALUES (DEFAULT,origActivation,nextYear, getInterval,yearCounter,didCount, extCount, mailCount,aaCount);
      
      SET yearCounter = yearCounter - 1;
      SET thisYear = (SELECT date_add(thisYear, INTERVAL 1 YEAR));
      SET nextYear = (SELECT date_add(thisYear, INTERVAL 11 MONTH));
   END WHILE;         
   
END IF;

  SELECT v_nextYear,v_didCount,v_extCount, v_mailCount,aaCount FROM  customerServicesDrillIn;
  TRUNCATE customerServicesDrillIn;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `didDrillin`(in_resellerId INT)
BEGIN

DECLARE done BOOLEAN DEFAULT FALSE;
DECLARE didCount, userCount, extCount, v_mailCount,v_aaCount, v_customerId, v_confCount INT;
DECLARE v_companyName VARCHAR(155);

DECLARE getDidCounts CURSOR
   FOR SELECT c.customerId,
              c.companyName,
              COUNT(didId) didCount
         FROM did
         LEFT JOIN branch b USING (branchId)
         LEFT JOIN customer c USING (customerId)
        WHERE c.resellerId = in_resellerId
          AND did.isActive
          AND b.isProvisioned
          AND c.statusId NOT IN (2,3)
          AND c.companyName NOT LIKE "%test%"
          AND c.companyName NOT LIKE "%demo%"
        GROUP BY 1;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;   


TRUNCATE tmp_didCount;
-- DROP TABLE IF EXISTS tmp_didCount;
-- CREATE TABLE tmp_didCount  (v_companyName VARCHAR(255), v_customerId INT(11), didCount INT(11), userCount INT(11), extCount INT(11), v_mailCount INT(11), v_aaCount INT(11), v_confCount INT(11) );  

OPEN getDidCounts;
  for_loop: LOOP
  
    FETCH getDidCounts INTO v_customerId, v_companyName, didCount;
    
    IF (done) THEN
      LEAVE for_loop;
    END IF;
    
    IF (v_companyName IS NOT NULL) THEN
      
      SELECT COUNT(userId) INTO userCount FROM user WHERE enabled AND customerId = v_customerId;
   
      SELECT COUNT(extensionId) INTO extCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN extension e ON (b.branchId = e.branchId)
       WHERE c.statusId NOT IN (2,3)
         AND e.extensionTypeId=1
         AND b.isProvisioned
         AND e.isFreeExtension=0
         AND c.customerId = v_customerId;
         
      SELECT COUNT(mailBoxId) INTO v_mailCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN mailbox m ON (b.branchId = m.branchId)
       WHERE c.statusId NOT IN (2,3)
         AND b.isProvisioned
         AND c.customerId = v_customerId;
         
       SELECT COUNT(aaId) INTO v_aaCount
         FROM customer c
         JOIN branch b ON (b.customerId = c.customerId)
         JOIN aa ON (b.branchId = aa.branchId)
        WHERE c.statusId NOT IN (2,3)
          AND c.customerId = v_customerId
          AND b.isProvisioned;

       SELECT COUNT(conferenceBridgeId) INTO v_confCount
         FROM customer c
         JOIN branch b ON (b.customerId = c.customerId)
         JOIN conference conf ON (b.branchId = conf.branchId)
        WHERE c.statusId NOT IN (2,3)
          AND b.isProvisioned
          AND c.customerId = v_customerId;
         

      INSERT INTO tmp_didCount VALUES (v_companyName, v_customerId, didCount, userCount, extCount, v_mailCount, v_aaCount, v_confCount);

    END IF;
      
      
  END LOOP; 
  
  -- CALL getDidReport;
  -- SELECT v_companyName, didCount, userCount FROM tmp_didCount;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fix_callRecording`()
BEGIN

  DECLARE done INT DEFAULT FALSE;
  DECLARE v_current_email, v_resellerId, v_branchId, v_description VARCHAR(150);
  DECLARE techEmail CURSOR
  FOR
    SELECT c.techEmail,
           b.resellerId,
	       cR.branchId,
           b.description
      FROM branch b 
	  JOIN reseller r ON (b.resellerId = r.resellerId)
      JOIN callRecording cR ON (cR.branchId = b.branchId AND cR.enabled = 1 AND cR.email = '')
      JOIN customer c ON (b.customerId = c.customerId AND c.statusId in (1,2));
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  
  OPEN techEmail;
  
  read_loop: LOOP
    FETCH techEmail INTO v_current_email, v_resellerId, v_branchId, v_description;
    
    IF (done) THEN
	  LEAVE read_loop;
    END IF;
    
    IF (v_current_email IS NOT NULL AND v_description IS NOT NULL) THEN
    
      SELECT v_current_email, v_resellerId, v_branchId, v_description;
	  UPDATE callRecording
	    JOIN branch b ON (callRecording.branchId = b.branchId)
		 SET email = v_current_email
	   WHERE b.branchId = v_branchId
		 AND b.resellerId = v_resellerId
		 AND b.description = v_description;
    
    END IF;
  END LOOP;
  
  CLOSE techEmail;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fix_sips`()
BEGIN

DECLARE done INT DEFAULT FALSE;
DECLARE sipBranchId INT(11);
DECLARE sipTrunkBranchId INT(11);
DECLARE sipUsername VARCHAR(100);
DECLARE sipDID VARCHAR(100);
DECLARE didNumber VARCHAR(100);
DECLARE sipCurs CURSOR 
  FOR
  /**
    SELECT st.branchId,
           stn.branchId,
           stn.didId,
           st.sipUsername
      FROM sipTrunk st
      JOIN sipTrunkNumber stn USING (sipTrunkId);
  **/

  select st.branchId,
           stn.branchId,
           stn.didId,
           st.sipUsername,
           d.didNumber
  from sipTrunk st
  join sipTrunkNumber stn on st.branchId = stn.branchId
  join did d on stn.branchId = d.branchId
  where st.sipUsername = d.didNumber;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

OPEN sipCurs;

read_loop: LOOP

  FETCH sipCurs INTO sipBranchId, sipTrunkBranchId, sipDID, sipUsername, didNumber;

  IF (done) THEN
    LEAVE read_loop;
  END IF;

  SELECT sipBranchId, sipTrunkBranchId, sipDID, sipUsername;
  SELECT b.branchId, sipBranchId,
         d.didNumber, sipDID, sipUsername
    FROM branch b
    JOIN did d ON (d.branchId = b.branchId)
    JOIN customer c ON (c.customerId = b.customerId)
   WHERE b.branchId != sipTrunkBranchId
     AND c.statusId =1
     LIMIT 10;

END LOOP;

CLOSE sipCurs;
    

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fix_usernames`()
BEGIN

UPDATE user
   SET username = 'dosp@4aps.org__old'
 WHERE username = 'dosp@4aps.org'
   AND branchId = 14758;
   
UPDATE user
   SET username = 'dosp@4aps.org'
 WHERE username = 'dosp@4aps.org__new'
   AND branchId = 20303;
   
UPDATE user
   SET username = 'webadmin@4aps.org__old'
 WHERE username = 'webadmin@4aps.org'
   AND branchId = 14758;
   
UPDATE user
   SET username = 'dosp@4aps.org'
 WHERE username = 'dosp@4aps.org__new'
   AND branchId IS NULL;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAnuallRev`()
BEGIN

DECLARE jan,feb,march,april,may,june,july,aug,sept,oct,nov,december DECIMAL(10,2);

-- Initial Query, TODO: break down into month buckets;
/**
select DATE(i.billingStartDate) as "date",
       SUM(i.total) as "value"
  from invoice i
 where billingStartDate BETWEEN '2014-12-31' AND '2016-01-01'
   and resellerId = in_resellerId
 group by 1;
 **/
 
 -- JAN
 SELECT SUM(i.total) as "value"
   INTO jan
   FROM invoice i
  WHERE billingStartDate BETWEEN '2014-12-31' AND '2015-02-01';    
 
 -- FEB
 SELECT SUM(i.total) as "value"
   INTO feb
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-01-31' AND '2015-03-01';
    
 -- MARCH
 SELECT SUM(i.total) as "value"
   INTO march
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-02-31' AND '2015-04-01';
        
 -- APRIL
 SELECT SUM(i.total) as "value"
   INTO april
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-03-31' AND '2015-05-01';
    
 -- MAY
 SELECT SUM(i.total) as "value"
   INTO may
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-04-31' AND '2015-06-01';
    
 -- JUNE
 SELECT SUM(i.total) as "value"
   INTO june
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-05-31' AND '2015-07-01';
    
 -- JULY
 SELECT SUM(i.total) as "value"
   INTO july
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-06-31' AND '2015-08-01';

 -- AUGUST
 SELECT SUM(i.total) as "value"
   INTO aug
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-07-31' AND '2015-09-01';

 -- SEPTEMBER
 SELECT SUM(i.total) as "value"
   INTO sept
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-08-31' AND '2015-10-01';

 -- OCTOBER
 SELECT SUM(i.total) as "value"
   INTO oct
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-09-31' AND '2015-11-01';

 -- NOVEMBER
 SELECT SUM(i.total) as "value"
   INTO nov
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-10-31' AND '2015-12-01';

 -- DECEMBER
 SELECT SUM(i.total) as "value"
   INTO december
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-11-31' AND '2016-01-01';

SELECT "Jan" AS "date",jan AS "value"
UNION
SELECT "Feb" AS "date",feb AS "value"
UNION
SELECT "March" AS "date",march AS "value"
UNION       
SELECT "April" AS "date",april AS "value"
UNION       
SELECT "May" AS "date",may AS "value"
UNION       
SELECT "June" AS "date",june AS "value"
UNION       
SELECT "July" AS "date",july AS "value"
UNION       
SELECT "Aug" AS "date", aug AS "value"
UNION       
SELECT "Sept" AS "date",sept AS "value"
UNION       
SELECT "Oct" AS "date",oct AS "value"
UNION       
SELECT "Nov" AS "date",nov AS "value"
UNION       
SELECT "Dec" AS "date",december AS "value";

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAnuallRevByCustomer`(in_customerId INT(11))
BEGIN

DECLARE jan,feb,march,april,may,june,july,aug,sept,oct,nov,december DECIMAL(10,2);


 SELECT SUM(i.total) as "value"
   INTO jan
   FROM invoice i
  WHERE invoiceDate BETWEEN '2014-12-31' AND '2015-02-01'
    AND i.customerId = in_customerId;   
 
 -- FEB
 SELECT SUM(i.total) as "value"
   INTO feb
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-01-31' AND '2015-03-01'
  AND i.customerId = in_customerId;
    
 -- MARCH
 SELECT SUM(i.total) as "value"
   INTO march
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-02-31' AND '2015-04-01'
    AND i.customerId = in_customerId;   
  
 -- APRIL
 SELECT SUM(i.total) as "value"
   INTO april
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-03-31' AND '2015-05-01'
    AND i.customerId = in_customerId;   

 -- MAY
 SELECT SUM(i.total) as "value"
   INTO may
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-04-31' AND '2015-06-01'
    AND i.customerId = in_customerId;   
    
 -- JUNE
 SELECT SUM(i.total) as "value"
   INTO june
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-05-31' AND '2015-07-01'
    AND i.customerId = in_customerId;   
    
 -- JULY
 SELECT SUM(i.total) as "value"
   INTO july
   FROM invoice i
 WHERE invoiceDate BETWEEN '2015-06-31' AND '2015-08-01'
    AND i.customerId = in_customerId;   
 
 -- AUGUST
 SELECT SUM(i.total) as "value"
   INTO aug
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-07-31' AND '2015-09-01'
    AND i.customerId = in_customerId;   

 -- SEPTEMBER
 SELECT SUM(i.total) as "value"
   INTO sept
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-08-31' AND '2015-10-01'
    AND i.customerId = in_customerId;   

 -- OCTOBER
 SELECT SUM(i.total) as "value"
   INTO oct
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-09-31' AND '2015-11-01'
   AND i.customerId = in_customerId;   

-- NOVEMBER
 SELECT SUM(i.total) as "value"
   INTO nov
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-10-31' AND '2015-12-01'
    AND i.customerId = in_customerId;   
  
 -- DECEMBER
 SELECT SUM(i.total) as "value"
   INTO december
   FROM invoice i
  WHERE invoiceDate BETWEEN '2015-11-31' AND '2016-01-01'
    AND i.customerId = in_customerId;   


SELECT "Jan" AS "date",jan AS "value"
UNION
SELECT "Feb" AS "date",feb AS "value"
UNION
SELECT "March" AS "date",march AS "value"
UNION       
SELECT "April" AS "date",april AS "value"
UNION       
SELECT "May" AS "date",may AS "value"
UNION       
SELECT "June" AS "date",june AS "value"
UNION       
SELECT "July" AS "date",july AS "value"
UNION       
SELECT "Aug" AS "date", aug AS "value"
UNION       
SELECT "Sept" AS "date",sept AS "value"
UNION       
SELECT "Oct" AS "date",oct AS "value"
UNION       
SELECT "Nov" AS "date",nov AS "value"
UNION       
SELECT "Dec" AS "date",december AS "value";

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAnuallRevByMonth`(in_resellerId INT)
BEGIN

DECLARE jan,feb,march,april,may,june,july,aug,sept,oct,nov,december DECIMAL(10,2);

-- Initial Query, TODO: break down into month buckets;
/**
select DATE(i.billingStartDate) as "date",
       SUM(i.total) as "value"
  from invoice i
 where billingStartDate BETWEEN '2014-12-31' AND '2016-01-01'
   and resellerId = in_resellerId
 group by 1;
 **/
 
 -- JAN
 SELECT SUM(i.total) as "value"
   INTO jan
   FROM invoice i
  WHERE billingStartDate BETWEEN '2014-12-31' AND '2015-02-01'
    AND resellerId = in_resellerId;
    
 -- FEB
 SELECT SUM(i.total) as "value"
   INTO feb
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-01-31' AND '2015-03-01'
    AND resellerId = in_resellerId;
    
 -- MARCH
 SELECT SUM(i.total) as "value"
   INTO march
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-02-31' AND '2015-04-01'
    AND resellerId = in_resellerId;
    
 -- APRIL
 SELECT SUM(i.total) as "value"
   INTO april
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-03-31' AND '2015-05-01'
    AND resellerId = in_resellerId;
    
 -- MAY
 SELECT SUM(i.total) as "value"
   INTO may
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-04-31' AND '2015-06-01'
    AND resellerId = in_resellerId;
    
 -- JUNE
 SELECT SUM(i.total) as "value"
   INTO june
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-05-31' AND '2015-07-01'
    AND resellerId = in_resellerId;   
    
 -- JULY
 SELECT SUM(i.total) as "value"
   INTO july
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-06-31' AND '2015-08-01'
    AND resellerId = in_resellerId;                       

 -- AUGUST
 SELECT SUM(i.total) as "value"
   INTO aug
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-07-31' AND '2015-09-01'
    AND resellerId = in_resellerId;  

 -- SEPTEMBER
 SELECT SUM(i.total) as "value"
   INTO sept
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-08-31' AND '2015-10-01'
    AND resellerId = in_resellerId;  

 -- OCTOBER
 SELECT SUM(i.total) as "value"
   INTO oct
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-09-31' AND '2015-11-01'
    AND resellerId = in_resellerId;  

 -- NOVEMBER
 SELECT SUM(i.total) as "value"
   INTO nov
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-10-31' AND '2015-12-01'
    AND resellerId = in_resellerId;  

 -- DECEMBER
 SELECT SUM(i.total) as "value"
   INTO december
   FROM invoice i
  WHERE billingStartDate BETWEEN '2015-11-31' AND '2016-01-01'
    AND resellerId = in_resellerId;  

SELECT "Jan" AS "date",jan AS "value"
UNION
SELECT "Feb" AS "date",feb AS "value"
UNION
SELECT "March" AS "date",march AS "value"
UNION       
SELECT "April" AS "date",april AS "value"
UNION       
SELECT "May" AS "date",may AS "value"
UNION       
SELECT "June" AS "date",june AS "value"
UNION       
SELECT "July" AS "date",july AS "value"
UNION       
SELECT "Aug" AS "date", aug AS "value"
UNION       
SELECT "Sept" AS "date",sept AS "value"
UNION       
SELECT "Oct" AS "date",oct AS "value"
UNION       
SELECT "Nov" AS "date",nov AS "value"
UNION       
SELECT "Dec" AS "date",december AS "value";

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAprilDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-03-31' AND '2015-05-01'
   AND isActive;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAugDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-07-31' AND '2015-09-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerGrowth`(in_resellerId INT)
BEGIN

DECLARE v_CustomerTotal,
        v_CustomerTotal2014,
        v_Cancellations2014,
        v_Cancellations2015,
        v_dec2014,
        v_jan, 
        v_feb,
        v_march,
        v_april,
        v_may,
        v_june,
        v_july,
        v_aug,
        v_sept,
        v_oct,
        v_nov,
        v_dec INT;

SELECT COUNT(customerId) INTO v_CustomerTotal FROM customer c WHERE c.statusId NOT IN (2,3) AND resellerId = in_resellerId;
SELECT COUNT(customerId) INTO v_Cancellations2015 FROM customer c WHERE cancellationDate BETWEEN '2014-12-31' AND '2016-01-01' AND resellerId = in_resellerId;


SELECT COUNT(customerId) INTO v_CustomerTotal2014 
  FROM customer c 
 WHERE c.statusId NOT IN (2,3) 
   AND c.originalActivationDate BETWEEN '2013-12-31' AND '2015-01-01'
   AND resellerId = in_resellerid; 

SELECT COUNT(customerId) INTO v_Cancellations2014 
  FROM customer c 
 WHERE c.cancellationDate BETWEEN '2013-12-31' AND '2015-01-01'
   AND resellerId = in_resellerid;  

SELECT COUNT(*)
INTO v_dec2014
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2014-11-31' AND '2015-01-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_jan
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_feb
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-01-31' AND '2015-03-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_march
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-02-31' AND '2015-04-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_april
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-03-31' AND '2015-05-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_may
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-04-31' AND '2015-06-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_june
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-05-31' AND '2015-07-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_july
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-06-31' AND '2015-08-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_aug
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-07-31' AND '2015-09-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_sept
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-09-31' AND '2015-10-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_oct
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-10-31' AND '2015-11-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_nov
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-11-31' AND '2015-12-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_dec
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-11-31' AND '2016-01-01'
  AND resellerId = in_resellerId;

SELECT v_CustomerTotal2014 AS "Growth From Last Year",
       (v_CustomerTotal - v_CustomerTotal2014) AS "Last Years Customer Base",
       v_CustomerTotal AS "This Years Customer Base To Date",
       ( v_jan + v_feb + v_march + v_april + v_may + v_june + v_july + v_aug + v_sept + v_oct + v_nov + v_dec) AS "This Years Growth",
       v_Cancellations2014 AS "2014 Cancellations",
       v_Cancellations2015 AS "2015 Cancellations",
       v_dec2014,
       v_jan, 
       v_feb,
       v_march,
       v_april,
       v_may,
       v_june,
       v_july,
       v_aug,
       v_sept,
       v_oct,
       v_nov,
       v_dec;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerGrowthCount`(in_resellerId INT)
BEGIN

DECLARE
    v_jan,
    v_feb,
    v_mar,
    v_apr,
    v_may,
    v_jun,
    v_july,
    v_aug,
    v_sept,
    v_oct,
    v_nov,
    v_dec INT(11);

SELECT COUNT(customerId)
  INTO v_jan
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2014-12-31' AND '2015-01-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_feb
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-01-31' AND '2015-02-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_mar
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-02-01' AND '2015-03-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_apr
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-03-31' AND '2015-04-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_may
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-04-31' AND '2015-05-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_jun
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-05-31' AND '2015-06-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_july
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-06-31' AND '2015-07-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_aug
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-07-31' AND '2015-08-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_sept
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-08-31' AND '2015-09-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_oct
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-09-31' AND '2015-10-31'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_nov
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-10-31' AND '2015-11-31'
   AND r.resellerId = in_resellerId;


SELECT COUNT(customerId)
  INTO v_dec
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-11-31' AND '2015-12-31'
   AND r.resellerId = in_resellerId;

SELECT   
    v_jan,
    v_feb,
    v_mar,
    v_apr,
    v_may,
    v_jun,
    v_july,
    v_aug,
    v_sept,
    v_oct,
    v_nov,
    v_dec;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerGrowthREPORT`(in_resellerId INT)
BEGIN

DECLARE v_CustomerTotal,
        v_CustomerTotal2014,
        v_Cancellations2014,
        v_Cancellations2015,
        v_dec2014,
        v_jan, 
        v_feb,
        v_march,
        v_april,
        v_may,
        v_june,
        v_july,
        v_aug,
        v_sept,
        v_oct,
        v_nov,
        v_dec INT;

SELECT COUNT(customerId) INTO v_CustomerTotal FROM customer c WHERE c.statusId NOT IN (2,3) AND resellerId = in_resellerId;


SELECT COUNT(customerId) INTO v_CustomerTotal2014 
  FROM customer c 
 WHERE c.statusId NOT IN (2,3) 
   AND c.originalActivationDate BETWEEN '2013-12-31' AND '2015-01-01'
   AND c.originalActivationDate IS NOT NULL
   AND resellerId = in_resellerid; 


-- 2014 Cancellations
DROP TABLE IF EXISTS tmp_2014Cancellations;
CREATE TEMPORARY TABLE tmp_2014Cancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE c.cancellationDate BETWEEN '2013-12-31' AND '2015-01-01'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations2014 FROM tmp_2014Cancellations;

-- 2015 Cancellations
DROP TABLE IF EXISTS tmp_2015Cancellations;
CREATE TEMPORARY TABLE tmp_2015Cancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE cancellationDate BETWEEN '2014-12-31' AND '2016-01-01'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations2015 FROM tmp_2015Cancellations;

SELECT COUNT(*)
INTO v_dec2014
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2014-11-31' AND '2015-01-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_jan
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_feb
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-01-31' AND '2015-03-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_march
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-02-31' AND '2015-04-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_april
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-03-31' AND '2015-05-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_may
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-04-31' AND '2015-06-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_june
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-05-31' AND '2015-07-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_july
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-06-31' AND '2015-08-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_aug
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-07-31' AND '2015-09-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_sept
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-09-31' AND '2015-10-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_oct
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-10-31' AND '2015-11-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_nov
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-11-31' AND '2015-12-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_dec
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
  AND  c.originalActivationDate BETWEEN '2015-11-31' AND '2016-01-01'
  AND resellerId = in_resellerId;

SELECT v_CustomerTotal2014 AS "Growth From Last Year",
       (v_CustomerTotal - v_CustomerTotal2014) AS "Last Years Customer Base",
       v_CustomerTotal AS "This Years Customer Base To Date",
       ( v_jan + v_feb + v_march + v_april + v_may + v_june + v_july + v_aug + v_sept + v_oct + v_nov + v_dec) AS "This Years Growth",
       v_Cancellations2014 AS "2014 Cancellations",
       v_Cancellations2015 AS "2015 Cancellations";
       /**
       v_dec2014,
       v_jan, 
       v_feb,
       v_march,
       v_april,
       v_may,
       v_june,
       v_july,
       v_aug,
       v_sept,
       v_oct,
       v_nov,
       v_dec;  
       **/
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerServices`(in_customerId INT(11))
BEGIN

  DECLARE v_customerId,
          v_didCount, 
          v_extCount, 
          v_mailCount, 
          v_aaCount, 
          v_timeFrameCount, 
          v_groupCount, 
          v_confCount INT(11);
  SET v_customerId = in_customerId;
  
  -- setting up dates... 
  -- did = cnamUploaded         
  -- 
  
-- DID

SELECT COUNT(didId)
INTO v_didCount    
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND c.customerId = v_customerId;

-- EXTENSIONS
 
 SELECT COUNT(extensionId)
 INTO v_extCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN extension e ON (b.branchId = e.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.customerId = v_customerId;

-- MAILBOXES
 
SELECT COUNT(mailBoxId)
INTO v_mailCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN mailbox m ON (b.branchId = m.branchId)
 WHERE c.statusId NOT IN (2,3)
 AND c.customerId = v_customerId;

-- AUTOATTENDANT
 
SELECT COUNT(aaId)
INTO v_aaCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN aa ON (b.branchId = aa.branchId)
 WHERE c.statusId NOT IN (2,3)
 AND c.customerId = v_customerId;

-- TIMEFRAMES
 
 SELECT COUNT(ahId)
 INTO v_timeFrameCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN ah ON (b.branchId = ah.branchId)
  WHERE c.statusId NOT IN (2,3)
  AND c.customerId = v_customerId;

-- GROUPS
 
SELECT COUNT(groupId)
    INTO v_groupCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN groups g ON (b.branchId = g.branchId)
  WHERE c.statusId NOT IN (2,3)
  AND c.customerId = v_customerId; 

-- CONFERENCE BRIDGES
 
SELECT COUNT(conferenceBridgeId)
INTO v_confCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN conference conf ON (b.branchId = conf.branchId)
  WHERE c.statusId NOT IN (2,3)
  AND c.customerId = v_customerId;
 
-- OUTPUT

SELECT v_customerId,v_didCount,v_extCount,v_mailCount,v_aaCount,v_timeFrameCount,v_groupCount,v_confCount;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDecDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
  JOIN reseller r ON (c.resellerId = r.resellerId)
  JOIN inventory i ON (c.resellerId = i.resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-11-31' AND '2016-01-01'
   AND b.isProvisioned
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDeviceCounts`(in_resellerId INT)
BEGIN
DECLARE panasonicCount,grandstreamCount,astraCount,polyCount,otherCount INT;

SELECT COUNT(d.deviceId)
INTO polyCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%poly%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.resellerId = in_resellerId 
                and c.statusId not in (2,3)
            )
           );

SELECT COUNT(d.deviceId)
INTO astraCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%astra%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.resellerId = in_resellerId 
                and c.statusId not in (2,3)
            )
           );
    
SELECT COUNT(d.deviceId)
INTO grandstreamCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%grand%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.resellerId = in_resellerId 
                and c.statusId not in (2,3)
            )
           );  
  
SELECT COUNT(d.deviceId)
INTO panasonicCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%panasonic%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.resellerId = in_resellerId 
                and c.statusId not in (2,3)
            )
           );   

 
SELECT COUNT(d.deviceId)
INTO otherCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name NOT IN ('%panasonic%','%grand%','%astra%','%polycom%')
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.resellerId = in_resellerId 
                and c.statusId not in (2,3)
            )
           );

SELECT "Polycom" AS "device", polyCount AS "deviceCount"
UNION
SELECT "Panasonic",panasonicCount
UNION
SELECT "Grandstream", grandstreamCount
UNION
SELECT "Astra", astraCount 
UNION
SELECT "Other", otherCount;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDidReport`()
BEGIN

 SELECT -- CASE WHEN ( char_length(v_companyName) <= 14 ) THEN v_companyName
        --     WHEN ( char_length(v_companyName) >= 14 ) THEN CONCAT(SUBSTRING(v_companyName FROM 1 FOR 14),"...")
        -- END AS v_companyName,
        
        v_companyName,
        v_customerId,
        didCount, 
        userCount, 
        extCount, 
        v_mailCount, 
        v_aaCount, 
        v_confCount 
   FROM tmp_didCount;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getFebDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-01-31' AND '2015-03-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getJanuaryDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND cnamUploaded BETWEEN '2014-12-31' AND '2015-02-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getJulyDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-06-31' AND '2015-08-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getJuneDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-05-31' AND '2015-07-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getMarchDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-02-31' AND '2015-04-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getMayDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-04-31' AND '2015-06-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getNovDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-10-31' AND '2015-12-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOctDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-09-31' AND '2015-11-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverAllCustomerGrowthREPORT`()
BEGIN

DECLARE v_CustomerTotal,
        v_CustomerTotal2014,
        v_Cancellations2014,
        v_Cancellations2015 INT;

SELECT COUNT(customerId)
  INTO v_CustomerTotal 
  FROM customer c 
 WHERE c.statusId NOT IN (2,3);

-- 2014 Cancellations
DROP TABLE IF EXISTS tmp_2014Cancellations;
CREATE TEMPORARY TABLE tmp_2014Cancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE c.cancellationDate BETWEEN '2013-12-31' AND '2015-01-01'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
 SELECT COUNT(*) INTO v_Cancellations2014 FROM tmp_2014Cancellations;
 

-- 2015 Cancellations
DROP TABLE IF EXISTS tmp_2015Cancellations;
CREATE TEMPORARY TABLE tmp_2015Cancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE cancellationDate BETWEEN '2014-12-31' AND '2016-01-01'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations2015 FROM tmp_2015Cancellations;

SELECT COUNT(customerId) INTO v_CustomerTotal2014 
  FROM customer c 
 WHERE c.statusId NOT IN (2,3) 
   AND c.originalActivationDate BETWEEN '2013-12-31' AND '2015-01-01';


DROP TABLE IF EXISTS customer_growth;
CREATE TABLE customer_growth (
        CustomerTotal INT(11),
        CustomerTotal2014 INT(11),
        Cancellations2014 INT(11),
        Cancellations2015 INT(11),
        updated DATETIME
);

INSERT INTO customer_growth VALUES (v_CustomerTotal, v_CustomerTotal2014, v_Cancellations2014, v_Cancellations2015, NOW());


/**
SELECT (v_CustomerTotal - v_CustomerTotal2014) AS "2014",
       v_CustomerTotal AS "2015",
       v_Cancellations2014 AS "2014 Cancellations",
       v_Cancellations2015 AS "2015 Cancellations";
*/    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverallExtensionCounts`()
BEGIN


DECLARE v_std2014,
        v_std2015,
        v_cloud2014,
        v_cloud2015,
        v_sip2014,
        v_sip2015 INT;

-- Standard Extensions 2014
SELECT COUNT(e.extensionId)
  INTO v_std2014
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.originalActivationDate < '2015-01-01';
   
-- Standard Extensions 2015
SELECT COUNT(e.extensionId)
  INTO v_std2015
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0;
      
-- Cloud Extensions 2014

SELECT COUNT(e.extensionId)
  INTO v_cloud2014
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND c.originalActivationDate < '2015-01-01';
   
   
-- Cloud Extensions 2015

SELECT COUNT(e.extensionId)
  INTO v_cloud2015
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0;


-- Sip Trunk 2014

SELECT COUNT(b.branchId)
  INTO v_sip2014
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND c.originalActivationDate < '2015-01-01';

 
 
 -- Sip Trunk 2015

SELECT COUNT(b.branchId)
  INTO v_sip2015
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1;
 
 SELECT '2014',v_std2014,v_cloud2014,v_sip2014
 UNION
 SELECT '2015',v_std2015,v_cloud2015,v_sip2015;
 
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverallResellerExtensionCounts`(in_resellerId INT)
BEGIN


DECLARE v_std2014,
        v_std2015,
        v_cloud2014,
        v_cloud2015,
        v_sip2014,
        v_sip2015 INT;

-- Standard Extensions 2014
SELECT COUNT(e.extensionId)
  INTO v_std2014
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.originalActivationDate < '2015-01-01'
   AND r.resellerId = in_resellerId;
   
-- Standard Extensions 2015
SELECT COUNT(e.extensionId)
  INTO v_std2015
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND r.resellerId = in_resellerId;
      
-- Cloud Extensions 2014

SELECT COUNT(e.extensionId)
  INTO v_cloud2014
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND c.originalActivationDate < '2015-01-01'
   AND r.resellerId = in_resellerId;
   
   
-- Cloud Extensions 2015

SELECT COUNT(e.extensionId)
  INTO v_cloud2015
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND r.resellerId = in_resellerId;


-- Sip Trunk 2014

SELECT COUNT(b.branchId)
  INTO v_sip2014
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND c.originalActivationDate < '2015-01-01'
 AND r.resellerId = in_resellerId;

 
 
 -- Sip Trunk 2015

SELECT COUNT(b.branchId)
  INTO v_sip2015
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND r.resellerId = in_resellerId;
 
 SELECT '2014',v_std2014,v_cloud2014,v_sip2014
 UNION
 SELECT '2015',v_std2015,v_cloud2015,v_sip2015;
 
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getPaidUnpaidInvoicesMonthlyBySp`()
BEGIN

DECLARE done BOOLEAN DEFAULT FALSE;

DECLARE v_resellerId INT;
DECLARE v_companyName VARCHAR(155);

DECLARE v_oct2014, v_nov2014 INT;
DECLARE v_jan, v_feb, 
        v_march, v_april, 
        v_may, v_june, 
        v_july, v_aug, 
        v_sept, v_oct INT;

DECLARE v_oct2014_unpaid, v_nov2014_unpaid INT;
DECLARE v_jan_unpaid, v_feb_unpaid, 
        v_march_unpaid, v_april_unpaid, 
        v_may_unpaid, v_june_unpaid, 
        v_july_unpaid, v_aug_unpaid, 
        v_sept_unpaid, v_oct_unpaid INT;

DECLARE getSp CURSOR FOR
SELECT r.resellerId,
       r.companyName
  FROM reseller r
  JOIN customer c ON (r.resellerId = c.resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND r.tier = 2
GROUP BY 1;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;  

/**
IF NOT EXISTS (select table_name from information_schema.tables where table_schema = schema() and table_name ='monthlyInvoice') THEN

CREATE TABLE invoiceMonthly (
v_resellerId INT(11), 
v_companyName VARCHAR(155), 
v_oct2014 INT(11), 
v_oct2014_unpaid INT(11), 
v_nov2014 INT(11),  
v_nov2014_unpaid INT(11),
v_jan INT(11),
v_jan_unpaid INT(11), 
v_feb INT(11),
v_feb_unpaid INT(11), 
v_march INT(11),
v_march_unpaid INT(11), 
v_april INT(11),
v_april_unpaid INT(11), 
v_may INT(11),
v_may_unpaid INT(11), 
v_june INT(11),
v_june_unpaid INT(11), 
v_july INT(11),
v_july_unpaid INT(11), 
v_aug INT(11),
v_aug_unpaid INT(11), 
v_sept INT(11),
v_sept_unpaid INT(11), 
v_oct INT(11),
v_oct_unpaid INT(11)
); 

ELSE

    TRUNCATE invoiceMonthly;
    
END IF;
**/


OPEN getSp;
   Sp_Loop: LOOP
     FETCH getSp INTO v_resellerId, v_companyName;

IF (done) THEN
  LEAVE Sp_Loop;
ELSE

SELECT COUNT(*)
   INTO v_oct2014
   FROM invoice i
  WHERE i.resellerId = v_resellerId
    AND i.invoiceStatusId = 2
    AND invoiceDate BETWEEN '2014-09-31' AND '2014-11-01';

 SELECT COUNT(*)  
   INTO v_nov2014
   FROM invoice i
  WHERE i.resellerId = v_resellerId
    AND i.invoiceStatusId = 2
    AND invoiceDate BETWEEN '2014-10-31' AND '2014-12-01';

SELECT COUNT(*)
  INTO v_jan
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2014-12-31' AND '2015-02-01';

SELECT COUNT(*)  
  INTO v_feb
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-01-31' AND '2015-03-01' ;

SELECT COUNT(*)  
  INTO v_march
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-02-31' AND '2015-04-01' ;

 SELECT COUNT(*)
   INTO v_april
   FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-03-31' AND '2015-05-01' ;

SELECT COUNT(*)
  INTO v_may
  FROM invoice i
  WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-04-31' AND '2015-06-01';

SELECT COUNT(*)  
  INTO v_june
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-05-31' AND '2015-07-01';

 SELECT COUNT(*)  
   INTO v_july
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-06-31' AND '2015-08-01';

 SELECT COUNT(*)  
   INTO v_aug
   FROM invoice i
  WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-07-31' AND '2015-09-01';

 SELECT COUNT(*)  
   INTO v_sept
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-08-31' AND '2015-010-01';

 SELECT COUNT(*)  
  INTO v_oct
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 2
   AND invoiceDate BETWEEN '2015-09-31' AND '2015-11-01';

-- UNPAID ACCOUNTS

 SELECT COUNT(*)
   INTO v_oct2014_unpaid
   FROM invoice i
  WHERE i.resellerId = v_resellerId
    AND i.invoiceStatusId = 1
    AND invoiceDate BETWEEN '2014-09-31' AND '2014-11-01';

 SELECT COUNT(*)  
   INTO v_nov2014_unpaid
   FROM invoice i
  WHERE i.resellerId = v_resellerId
    AND i.invoiceStatusId = 1
    AND invoiceDate BETWEEN '2014-10-31' AND '2014-12-01';

SELECT COUNT(*)
  INTO v_jan_unpaid
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2014-12-31' AND '2015-02-01';

SELECT COUNT(*)  
  INTO v_feb_unpaid
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-01-31' AND '2015-03-01' ;

SELECT COUNT(*)  
  INTO v_march_unpaid
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-02-31' AND '2015-04-01' ;

 SELECT COUNT(*)
   INTO v_april_unpaid 
   FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-03-31' AND '2015-05-01' ;

SELECT COUNT(*)
  INTO v_may_unpaid 
  FROM invoice i
  WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-04-31' AND '2015-06-01';

SELECT COUNT(*)  
  INTO v_june_unpaid
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-05-31' AND '2015-07-01';

 SELECT COUNT(*)  
   INTO v_july_unpaid
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-06-31' AND '2015-08-01';

 SELECT COUNT(*)  
   INTO v_aug_unpaid
   FROM invoice i
  WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-07-31' AND '2015-09-01';

 SELECT COUNT(*)  
   INTO v_sept_unpaid
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-08-31' AND '2015-010-01';

 SELECT COUNT(*)  
  INTO v_oct_unpaid
  FROM invoice i
 WHERE i.resellerId = v_resellerId
   AND i.invoiceStatusId = 1
   AND invoiceDate BETWEEN '2015-09-31' AND '2015-11-01';
 
   
   /**
   SELECT v_resellerId, v_companyName, 
          v_oct2014 AS "Oct 2014 PAID",          
          v_oct2014_unpaid AS "Oct 2014 UNPAID", 
          v_nov2014 AS "Nov 2014 PAID",          
          v_nov2014_unpaid AS "Nov 2014 UNPAID", 
          v_jan,
          v_jan_unpaid, 
          v_feb,
          v_feb_unpaid, 
          v_march,
          v_march_unpaid, 
          v_april,
          v_april_unpaid, 
          v_may,
          v_may_unpaid, 
          v_june,
          v_june_unpaid, 
          v_july,
          v_july_unpaid, 
          v_aug,
          v_aug_unpaid, 
          v_sept,
          v_sept_unpaid, 
          v_oct,
          v_oct_unpaid;
          **/
          
          
INSERT INTO invoiceMonthly VALUES (
          v_resellerId, 
          v_companyName, 
          v_oct2014,          
          v_oct2014_unpaid, 
          v_nov2014,          
          v_nov2014_unpaid, 
          v_jan,
          v_jan_unpaid, 
          v_feb,
          v_feb_unpaid, 
          v_march,
          v_march_unpaid, 
          v_april,
          v_april_unpaid, 
          v_may,
          v_may_unpaid, 
          v_june,
          v_june_unpaid, 
          v_july,
          v_july_unpaid, 
          v_aug,
          v_aug_unpaid, 
          v_sept,
          v_sept_unpaid, 
          v_oct,
          v_oct_unpaid);          
END IF;
 END LOOP;
   CLOSE getSp;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductionServices`(in_resellerId INT)
BEGIN

  DECLARE 
          v_didCount, 
          v_extCount, 
          v_mailCount, 
          v_aaCount, 
          v_timeFrameCount, 
          v_groupCount, 
          v_confCount INT(11);
  
-- DID

SELECT COUNT(didId)
INTO v_didCount    
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND did.isActive
   AND c.resellerId = in_resellerId;

-- EXTENSIONS
 
 SELECT COUNT(extensionId)
 INTO v_extCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN extension e ON (b.branchId = e.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND e.extensionTypeId=1
   AND b.isProvisioned
   AND e.isFreeExtension=0
AND c.resellerId = in_resellerId;
-- MAILBOXES
 
SELECT COUNT(mailBoxId)
INTO v_mailCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN mailbox m ON (b.branchId = m.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND c.resellerId = in_resellerId;
   
-- AUTOATTENDANT
 
SELECT COUNT(aaId)
INTO v_aaCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN aa ON (b.branchId = aa.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND c.resellerId = in_resellerId;
      
-- TIMEFRAMES
 
 SELECT COUNT(ahId)
 INTO v_timeFrameCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN ah ON (b.branchId = ah.branchId)
  WHERE c.statusId NOT IN (2,3)
AND c.resellerId = in_resellerId;
-- GROUPS
 
  SELECT COUNT(groupId)
    INTO v_groupCount
    FROM customer c
    JOIN branch b ON (b.customerId = c.customerId)
    JOIN groups g ON (b.branchId = g.branchId)
   WHERE c.statusId NOT IN (2,3)
     AND b.isProvisioned
     AND c.resellerId = in_resellerId;
     
-- CONFERENCE BRIDGES
 
SELECT COUNT(conferenceBridgeId)
INTO v_confCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN conference conf ON (b.branchId = conf.branchId)
  WHERE c.statusId NOT IN (2,3)
  AND b.isProvisioned
AND c.resellerId = in_resellerId;
 
-- OUTPUT
SELECT v_didCount,v_extCount,v_mailCount,v_aaCount,v_timeFrameCount,v_groupCount,v_confCount;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductionServicesAnnually`(in_resellerId INT)
BEGIN

DECLARE did_jan,did_feb,did_march,did_april,did_may,did_june,did_july,did_aug,did_sept,did_oct,did_nov,did_dec INT;
DECLARE ext_jan,ext_feb,ext_march,ext_april,ext_may,ext_june,ext_july,ext_aug,ext_sept,ext_oct,ext_nov,ext_dec INT;
DECLARE mail_jan,mail_feb,mail_march,mail_april,mail_may,mail_june,mail_july,mail_aug,mail_sept,mail_oct,mail_nov,mail_dec INT;
DECLARE aa_jan INT;
DECLARE groups_jan INT;
DECLARE conf_jan INT;



-- JANUARY --

-- DID
SELECT COUNT(didId)
INTO did_jan
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
  JOIN reseller r ON (c.resellerId = r.resellerId)
  JOIN inventory i ON (c.resellerId = i.resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
   AND b.isProvisioned
   AND isActive
   AND r.resellerId = in_resellerId;
   
-- Extensions
SELECT COUNT(e.extensionId)
INTO ext_jan
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
AND c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
   AND r.resellerId = in_resellerId;                     

-- Mailboxes
SELECT COUNT(mailboxId)
INTO mail_jan
  FROM mailbox m
  LEFT JOIN branch b ON (m.branchId = b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
      AND r.resellerId = in_resellerId;
  
-- AA
SELECT COUNT(aaId)
INTO aa_jan
  FROM aa a
  LEFT JOIN branch b ON (a.branchId = b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
      AND r.resellerId = in_resellerId;


-- Timeframe ???


-- Groups

SELECT COUNT(groupId)
INTO groups_jan
  FROM groups g
  LEFT JOIN branch b ON (g.branchId = b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
      AND r.resellerId = in_resellerId;


-- Confbridges   

SELECT COUNT(conferenceBridgeId)
INTO conf_jan
  FROM conference conf
  LEFT JOIN branch b ON (conf.branchId = b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND c.originalActivationDate BETWEEN '2014-12-31' AND '2015-02-01'
AND r.resellerId = in_resellerId;   
   
SELECT did_jan, ext_jan, mail_jan, aa_jan, groups_jan, conf_jan;           

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getResellerSales`(in_resellerId INT)
BEGIN

SELECT DATE(invoiceDate) date,
       COUNT(invoiceId) invoiceCount
  FROM invoice 
  WHERE invoiceDate BETWEEN '2014-12-31' AND '2016-01-01'
   AND resellerId = in_resellerId
 GROUP BY 1 ORDER BY 1; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getResellerServices`(in_resellerId INT(11))
BEGIN

  DECLARE v_didCount, 
          v_extCount, 
          v_mailCount, 
          v_aaCount, 
          v_timeFrameCount, 
          v_groupCount, 
          v_confCount INT(11);
  
-- DID

SELECT COUNT(didId)
INTO v_didCount    
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = in_resellerId;

-- EXTENSIONS
 
 SELECT COUNT(extensionId)
 INTO v_extCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN extension e ON (b.branchId = e.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.resellerId = in_resellerId;

-- MAILBOXES
 
SELECT COUNT(mailBoxId)
INTO v_mailCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN mailbox m ON (b.branchId = m.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = in_resellerId;

-- AUTOATTENDANT
 
SELECT COUNT(aaId)
INTO v_aaCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN aa ON (b.branchId = aa.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = in_resellerId;

-- TIMEFRAMES
 
 SELECT COUNT(ahId)
 INTO v_timeFrameCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN ah ON (b.branchId = ah.branchId)
  WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = in_resellerId;

-- GROUPS
 
    SELECT COUNT(groupId)
    INTO v_groupCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN groups g ON (b.branchId = g.branchId)
  WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = in_resellerId;

-- CONFERENCE BRIDGES
 
SELECT COUNT(conferenceBridgeId)
INTO v_confCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN conference conf ON (b.branchId = conf.branchId)
  WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = in_resellerId;
 
-- OUTPUT

SELECT in_resellerId,v_didCount,v_extCount,v_mailCount,v_aaCount,v_timeFrameCount,v_groupCount,v_confCount;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getResllerServices`(in_resellerId INT(11))
BEGIN

  DECLARE v_didCount, 
          v_extCount, 
          v_mailCount, 
          v_aaCount, 
          v_timeFrameCount, 
          v_groupCount, 
          v_confCount INT(11);
  
-- DID

SELECT COUNT(didId)
INTO v_didCount    
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = v_resellerId;

-- EXTENSIONS
 
 SELECT COUNT(extensionId)
 INTO v_extCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN extension e ON (b.branchId = e.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.resellerId = v_resellerId;

-- MAILBOXES
 
SELECT COUNT(mailBoxId)
INTO v_mailCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN mailbox m ON (b.branchId = m.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = v_resellerId;

-- AUTOATTENDANT
 
SELECT COUNT(aaId)
INTO v_aaCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN aa ON (b.branchId = aa.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = v_resellerId;

-- TIMEFRAMES
 
 SELECT COUNT(ahId)
 INTO v_timeFrameCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN ah ON (b.branchId = ah.branchId)
  WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = v_resellerId;

-- GROUPS
 
    SELECT COUNT(groupId)
    INTO v_groupCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN groups g ON (b.branchId = g.branchId)
  WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = v_resellerId;

-- CONFERENCE BRIDGES
 
SELECT COUNT(conferenceBridgeId)
INTO v_confCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN conference conf ON (b.branchId = conf.branchId)
  WHERE c.statusId NOT IN (2,3)
   AND c.resellerId = v_resellerId;
 
-- OUTPUT

SELECT v_resellerId,v_didCount,v_extCount,v_mailCount,v_aaCount,v_timeFrameCount,v_groupCount,v_confCount;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getSeptDID`(in_resellerid INT)
BEGIN

SELECT COUNT(didId) "did"
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND (c.resellerId = in_resellerid)
   AND c.originalActivationDate BETWEEN '2015-08-31' AND '2015-010-01'
   AND isActive;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getServiceProviders`()
BEGIN
/********************************************
* getServiceProviders Stored Procedure
* Created On: 2015 10 07
* Created By: Mike Marshall
* Summary: Will query all resellers, extension
*          count and customer count
********************************************/ 

  -- DEFINE VARIABLES
  DECLARE done INT DEFAULT FALSE;
  DECLARE v_resellerId, v_tier, v_extCount, v_customerCount INT(11);
  DECLARE v_companyName, v_phoneNum, v_address VARCHAR(200);
  DECLARE sp_cur CURSOR
  FOR SELECT r.resellerId,
             r.companyName,
             r.tier Tier,
             r.phone Phone,
             CONCAT(a.street1," ",a.street2," ",a.city," ",a.state," ",a.zipCode," ",a.country) AS "Address"
        FROM reseller r
        LEFT JOIN address a ON (r.addressId=a.addressId);
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  
  DROP TABLE IF EXISTS tmp_sp;
      CREATE TABLE tmp_sp (
      v_resellerId INT(11),
      v_companyName VARCHAR(155),
      v_tier INT(11),
      v_phoneNum VARCHAR(100),
      v_address VARCHAR(155),
      v_extCount INT(7), 
      v_customerCount INT(7)
      );

  OPEN sp_cur;
    for_loop: LOOP
    
      FETCH sp_cur INTO v_resellerId, v_companyName, v_tier, v_phoneNum, v_address;
      
      IF (done) THEN
        LEAVE for_loop;
      END IF;
      
      -- Extension Count
      /**
      SELECT CONCAT('EXT QUERY: ',
      'COUNT(extensionId)
      --  INTO v_extCount
        FROM extension e
        LEFT JOIN branch b ON (e.branchId=b.branchId)
        LEFT JOIN customer c ON (b.customerId=c.customerId)
        LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
       WHERE c.statusId=1
         AND e.extensionTypeId=1
         AND e.isFreeExtension=0
         AND r.resellerId = ', v_resellerId) AS QUERY;
        **/

      SELECT COUNT(extensionId)
        INTO v_extCount
        FROM extension e
        LEFT JOIN branch b ON (e.branchId=b.branchId)
        LEFT JOIN customer c ON (b.customerId=c.customerId)
        LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
       WHERE c.statusId=1
         AND e.extensionTypeId=1
         AND e.isFreeExtension=0
         AND r.resellerId = v_resellerId;


      -- Customer Count
      
      SELECT COUNT(customerId)
        INTO v_customerCount
        FROM customer 
       WHERE statusId NOT IN (2,3) 
         AND resellerId = v_resellerId;
        
     /**
     SELECT CONCAT('CustomerCount Query:  ',
     'COUNT(customerId)
        INTO v_customerCount
        FROM customer 
       WHERE statusId NOT IN (2,3) 
         AND resellerId = ', v_resellerId) AS QUERY;
      **/
      SELECT v_resellerId,v_companyName,v_tier,v_phoneNum,v_address,v_extCount, v_customerCount;
      INSERT INTO tmp_sp VALUES (v_resellerId,v_companyName,v_tier,v_phoneNum,v_address,v_extCount,v_customerCount);
      
    END LOOP;
    
    -- SELECT v_resellerId,v_companyName,v_tier,v_phoneNum,v_address,v_extCount, v_customerCount FROM tmp_sp;
       SELECT * FROM tmp_sp;  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTop10`()
BEGIN

  SELECT r_companyName,
         customerCount,
         SUBSTRING(percentage, 1,4) AS percentage
    FROM top10_REPORT 
   WHERE id = 1
  UNION
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
          (select percentage from top10_REPORT where id = 2)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 2
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
          (select percentage from top10_REPORT where id = 2) + 
          (select percentage from top10_REPORT where id = 3)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 3
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
          (select percentage from top10_REPORT where id = 2) + 
          (select percentage from top10_REPORT where id = 3) +
          (select percentage from top10_REPORT where id = 4)
          ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 4
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 5
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 6 
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 7 
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7) +
         (select percentage from top10_REPORT where id = 8)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 8
     UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7) +
         (select percentage from top10_REPORT where id = 8) +
         (select percentage from top10_REPORT where id = 9) 
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 9   
     UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7) +
         (select percentage from top10_REPORT where id = 8) +
         (select percentage from top10_REPORT where id = 9) +
         (select percentage from top10_REPORT where id = 10) 
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 10
   UNION 
   SELECT r_companyName,
         customerCount,
         percentage
    FROM top10_REPORT
   WHERE id = 11;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTop10Sp`()
BEGIN

DECLARE done BOOLEAN DEFAULT FALSE;
DECLARE r_companyName, overallPerc VARCHAR(155);
DECLARE customerCount INT;
DECLARE totalCustomerBase INT;
DECLARE minCount, maxCount INT;
DECLARE getSp CURSOR FOR
SELECT r.companyName, 
       COUNT(customerId)
  FROM customer c
  JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
 GROUP BY 1 HAVING COUNT(customerId) > 230
 ORDER BY 2 DESC
 LIMIT 10;
 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
 

SELECT MIN(custCount)
  INTO minCount 
  FROM (
        SELECT resellerId, COUNT(customerId) custCount 
          FROM customer 
         WHERE statusId NOT IN (2,3) 
         GROUP BY 1
        ) t;

SELECT MAX(custCount)
  INTO maxCount 
  FROM (
        SELECT resellerId, COUNT(customerId) custCount 
          FROM customer 
         WHERE statusId NOT IN (2,3) 
         GROUP BY 1
        ) t;
        
SELECT COUNT(customerId) 
  INTO totalCustomerBase 
  FROM customer 
 WHERE statusId NOT IN (2,3);
 
 TRUNCATE top10_REPORT;
 -- DROP TABLE IF EXISTS top10_REPORT;
 CREATE TABLE IF NOT EXISTS top10_REPORT (id SERIAL, r_companyName VARCHAR(155), customerCount INT(11), percentage VARCHAR(25));
 
  OPEN getSp;
   Sp_Loop: LOOP
     FETCH getSp INTO r_companyName, customerCount;

   IF (done) THEN
     LEAVE Sp_Loop;
   ELSE
     SELECT ((customerCount / totalCustomerBase ) * 100)  INTO overallPerc;
     INSERT INTO top10_REPORT VALUES (DEFAULT, r_companyName, customerCount, SUBSTRING(overallPerc,1,4));
   END IF;
  END LOOP;
  INSERT INTO top10_REPORT VALUES (DEFAULT, 'ALL', totalCustomerBase, '100');
  
  
  /**
  SELECT r_companyName,
         customerCount,
         percentage
    FROM top10_REPORT 
   WHERE id = 1
  UNION
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
          (select percentage from top10_REPORT where id = 2)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 2
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
          (select percentage from top10_REPORT where id = 2) + 
          (select percentage from top10_REPORT where id = 3)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 3
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
          (select percentage from top10_REPORT where id = 2) + 
          (select percentage from top10_REPORT where id = 3) +
          (select percentage from top10_REPORT where id = 4)
          ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 4
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 5
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 6 
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 7 
  UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7) +
         (select percentage from top10_REPORT where id = 8)
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 8
     UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7) +
         (select percentage from top10_REPORT where id = 8) +
         (select percentage from top10_REPORT where id = 9) 
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 9   
     UNION 
  SELECT r_companyName,
         customerCount,
         ((select percentage from top10_REPORT where id = 1) + 
         (select percentage from top10_REPORT where id = 2) + 
         (select percentage from top10_REPORT where id = 3) +
         (select percentage from top10_REPORT where id = 4) +
         (select percentage from top10_REPORT where id = 5) +
         (select percentage from top10_REPORT where id = 6) +
         (select percentage from top10_REPORT where id = 7) +
         (select percentage from top10_REPORT where id = 8) +
         (select percentage from top10_REPORT where id = 9) +
         (select percentage from top10_REPORT where id = 10) 
         ) AS "percentage"
    FROM top10_REPORT
   WHERE id = 10
   UNION 
   SELECT r_companyName,
         customerCount,
         percentage
    FROM top10_REPORT
   WHERE id = 11;
   **/
   
   CALL getTop10();
   
   
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTop5`()
BEGIN

  SELECT v_companyName, v_customerId, didCount, userCount, extCount, v_mailCount, v_aaCount, v_confCount
    FROM tmp_Top5
   GROUP BY extCount
   ORDER BY extCount DESC
   LIMIT 5;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTop5CustomersSpDrillIn`(in_resellerId INT(11))
BEGIN

DECLARE done BOOLEAN DEFAULT FALSE;
DECLARE didCount, userCount, extCount, v_mailCount,v_aaCount, v_customerId, v_confCount INT;
DECLARE v_companyName VARCHAR(155);

DECLARE getDidCounts CURSOR
   FOR SELECT c.customerId,
              c.companyName,
              COUNT(didId) didCount
         FROM did
         LEFT JOIN branch b USING (branchId)
         LEFT JOIN customer c USING (customerId)
        WHERE c.resellerId = in_resellerId
          AND did.isActive
          AND b.isProvisioned
          AND c.statusId NOT IN (2,3)
          AND c.companyName NOT LIKE "%test%"
          AND c.companyName NOT LIKE "%demo%"
        GROUP BY 1;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE; 

-- CREATE TMP TABLE
/**
CREATE TABLE tmp_Top5  (
v_companyName VARCHAR(255),
v_customerId INT(11), 
didCount INT(11), 
userCount INT(11), 
extCount INT(11), 
v_mailCount INT(11), 
v_aaCount INT(11), 
v_confCount INT(11) 
);    
**/
TRUNCATE tmp_Top5;
OPEN getDidCounts;
  for_loop: LOOP
  
    FETCH getDidCounts INTO v_customerId, v_companyName, didCount;
    
    IF (done) THEN
      LEAVE for_loop;
    END IF;
    
    IF (v_companyName IS NOT NULL) THEN


      SELECT COUNT(userId) INTO userCount FROM user WHERE enabled AND customerId = v_customerId;
   
      SELECT COUNT(extensionId) INTO extCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN extension e ON (b.branchId = e.branchId)
       WHERE c.statusId NOT IN (2,3)
         AND b.isProvisioned
         AND e.extensionTypeId=1
         AND e.isFreeExtension=0
         AND c.customerId = v_customerId;
         
      SELECT COUNT(mailBoxId) INTO v_mailCount
        FROM customer c
        JOIN branch b ON (b.customerId = c.customerId)
        JOIN mailbox m ON (b.branchId = m.branchId)
       WHERE c.statusId NOT IN (2,3)
         AND b.isProvisioned
         AND c.customerId = v_customerId;
         
       SELECT COUNT(aaId) INTO v_aaCount
         FROM customer c
         JOIN branch b ON (b.customerId = c.customerId)
         JOIN aa ON (b.branchId = aa.branchId)
        WHERE c.statusId NOT IN (2,3)
          AND b.isProvisioned
          AND c.customerId = v_customerId;

       SELECT COUNT(conferenceBridgeId) INTO v_confCount
         FROM customer c
         JOIN branch b ON (b.customerId = c.customerId)
         JOIN conference conf ON (b.branchId = conf.branchId)
        WHERE c.statusId NOT IN (2,3)
          AND b.isProvisioned
          AND c.customerId = v_customerId;
        
       INSERT INTO tmp_Top5 VALUES (v_companyName, v_customerId, didCount, userCount, extCount, v_mailCount, v_aaCount, v_confCount);
       -- SELECT v_companyName, v_customerId, didCount, userCount, extCount, v_mailCount, v_aaCount, v_confCount;

   END IF;
      
  END LOOP; 
  
  -- CALL getTop5();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_timeframe`(pbx_id INT,timeframe_id INT)
BEGIN

DECLARE 
 sunday_tf,
 monday_tf, 
 tuesday_tf, 
 wednesday_tf, 
 thursday_tf, 
 friday_tf, 
 saturday_tf, 
 during_macro_tf, 
 after_macro_tf, 
 timezone_tf,
 ahday, 
 start_time, 
 end_time VARCHAR(255);
DECLARE c_time DATETIME;
DECLARE during_id_tf, after_id_tf INT(11);

SELECT sunday, monday, 
       tuesday, wednesday, 
       thursday, friday, 
       saturday, duringMacro, 
       duringId, afterMacro, 
       afterId, timezone
  INTO sunday_tf,monday_tf,
       tuesday_tf,wednesday_tf,
       thursday_tf,friday_tf,
       saturday_tf,during_macro_tf,
       during_id_tf,after_macro_tf,
       after_id_tf, timezone_tf
  FROM timeFrame
 WHERE pbxId = pbx_id 
   AND timeFrameId = timeframe_id;

SELECT LOWER(DAYNAME(CONVERT_TZ(NOW(),"US/Eastern", timezone_tf))) INTO ahday;

CASE ahday
    WHEN 'monday' THEN
      set start_time=SUBSTR(monday_tf,1,5);
      set end_time=SUBSTR(monday_tf,7,5);        
    WHEN 'tuesday' THEN
      set start_time=SUBSTR(tuesday_tf,1,5);
      set end_time=SUBSTR(tuessday_tf,7,5);
	WHEN 'wednesday' THEN
      set start_time=SUBSTR(wednesday_tf,1,5);
      set end_time=SUBSTR(wednesday_tf,7,5);
	WHEN 'thursday' THEN
      set start_time=SUBSTR(thursday_tf,1,5);
      set end_time=SUBSTR(thursday_tf,7,5);
	WHEN 'friday' THEN
      set start_time=SUBSTR(friday_tf,1,5);
      set end_time=SUBSTR(friday_tf,7,5);
    WHEN 'saturday' THEN
      set start_time=SUBSTR(saturday_tf,1,5);
      set end_time=SUBSTR(saturday_tf,7,5);
    WHEN 'sunday' THEN
      set start_time=SUBSTR(sunday_tf,1,5);
      set end_time=SUBSTR(sunday_tf,7,5);
    ELSE BEGIN END;
END CASE;

DROP TEMPORARY TABLE IF EXISTS timeframe_tt;
CREATE TEMPORARY TABLE timeframe_tt (
    macro varchar(255), 
    macro_id int(11)
);

IF (time(start_time) < time(convert_tz(now(),"US/Eastern", timezone_tf))) THEN

  IF (time(end_time) > time(convert_tz(now(),"US/Eastern", timezone_tf))) THEN
    INSERT INTO timeframe_tt SELECT during_macro_tf, during_id_tf;
  ELSE
    INSERT INTO timeframe_tt SELECT after_macro_tf, after_id_tf;
  END IF;      

ELSE
  INSERT INTO timeframe_tt SELECT after_macro_tf, after_id_tf;    

END IF;

SELECT * FROM timeframe_tt;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_top5_revenue`()
BEGIN

 SELECT resellerId,
         SUM(total) AS "total"
    FROM invoice
   WHERE resellerId !=36
   GROUP BY 1 HAVING SUM(total) > 6500000.00
   ORDER BY 2;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `populate_server_list`()
BEGIN

  DECLARE done INT(11) DEFAULT FALSE;
  DECLARE v_hostname, v_ipAddress, v_serverUsername, v_serverPassword, v_conn VARCHAR(155);
  DECLARE servers_curs CURSOR FOR
   SELECT -- serverTypeId,
		  -- name,
		  hostname,
		  ipAddress,
		  serverUsername,
		  serverPassword
		  -- serverStatus 
	 FROM server
	WHERE ipAddress LIKE '64.94.%'
	   OR ipAddress LIKE '198.%'
	   OR ipAddress LIKE '18.%';
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  
  DROP TABLE IF EXISTS server_audit;
  CREATE TABLE server_audit (
    s_audit_id SERIAL,
    hostname VARCHAR(155),
	ip_address VARCHAR(100),
    conn_string TEXT
    );
    
       
  OPEN servers_curs;
  
  read_loop: LOOP
    FETCH servers_curs INTO v_hostname, v_ipAddress, v_serverUsername, v_serverPassword;
    
    IF (done) THEN
      LEAVE read_loop;
      SELECT "DONE";
	END IF;
  
    IF (v_hostname IS NOT NULL) THEN
      -- SELECT v_hostname, v_ipAddress, v_serverUsername, v_serverPassword;
      -- PREPARE SSH CONNECTION STATEMENTS
      SELECT CONCAT("ssh -i va.key voiceaxis@",v_hostname) INTO v_conn;
      
      INSERT INTO server_audit VALUES (DEFAULT, v_hostname, v_ipAddress, v_conn);
    END IF;
  END LOOP;
  
  CLOSE servers_curs;
  
  select * from server_audit;    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `schemaChange`()
BEGIN

/******************************************
*
* `01xxx` = WARNING (Execution Continues)
* `45xxx` = ERROR (Execution Stops)
*
*******************************************/

/******************************************
*
* WAPP-20 - Change user for devices to L1 user
*
*******************************************/

SELECT @l1_user := resellerId FROM organization WHERE type_id = 1 AND parent IS NULL;

UPDATE deviceManufacturer SET resellerId = @l1_user WHERE deviceType < 2 AND deviceManufacturerId > 0;

IF NOT EXISTS (
   SELECT COLUMN_NAME
     FROM `INFORMATION_SCHEMA`.`COLUMNS`
    WHERE `TABLE_SCHEMA` = SCHEMA()
      AND `TABLE_NAME` = 'searchPref'
      AND `COLUMN_NAME` = 'organizationId'
  ) THEN
  -- Purge the searchPref table. When we add organizationId nothing will match anymore anyway
  -- this will also make the alters faster
  TRUNCATE searchPref;

  -- Add a field to track organisation in conjunction with controller
  ALTER TABLE searchPref
  ADD COLUMN `organizationId` INT(11) NOT NULL after controller;
END IF;
ALTER TABLE `searchPref` DROP INDEX `userId_2`;
ALTER TABLE `searchPref` ADD UNIQUE KEY `userId_2` (`userId`,`controller`,`organizationId`);


-- add key on type to templateTag so that it can be fk'd
IF NOT EXISTS (SELECT * FROM `information_schema`.`statistics` WHERE `table_schema` = SCHEMA() AND `table_name` = 'templateTag' AND `index_name` = 'type') THEN
   ALTER TABLE `templateTag` add KEY `type` (`type`);
END IF;

-- create an xref table for template tags to email templates
CREATE TABLE IF NOT EXISTS `emailTemplate_templateTag`
(
    `emailTemplateTypeId` int(11) unsigned NOT NULL,
    `templateTagTypeId` int(11) NOT NULL,
    KEY `emailTemplateTypeId` (`emailTemplateTypeId`),
    KEY `templateTagTypeId` (`templateTagTypeId`),
    CONSTRAINT `emailTemplate_fk` FOREIGN KEY (`emailTemplateTypeId`) REFERENCES `emailTemplate` (`templateType`),
    CONSTRAINT `templateTag_fk` FOREIGN KEY (`templateTagTypeId`) REFERENCES `templateTag` (`type`)
) ENGINE=InnoDB;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `schema_change`()
BEGIN            SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'portal';            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `test`()
BEGIN

select 1;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-02 13:32:32
