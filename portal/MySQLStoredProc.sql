-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bi_new
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

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
-- Dumping routines for database 'bi_new'
--
/*!50003 DROP PROCEDURE IF EXISTS `createActiveCustomerView` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `createActiveCustomerView`()
BEGIN

DROP TABLE IF EXISTS activeCustomer_view;
CREATE TABLE activeCustomer_view(
activeCustomer_id SERIAL,
customerId INT(11),
resellerId INT(11),
accountId INT(11),
companyName VARCHAR(255),
email VARCHAR(255),
billingAddressId INT(11),
anniversaryDate INT(11),
statusId INT(11),
originalActivationDate DATETIME,
cancellationDate DATETIME,
hostedFaxEnabled TINYINT(4),
timezone VARCHAR(255),
referring_organization_id BIGINT(20)
) ENGINE=MEMORY;

ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_customerId_idx (customerId);
ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_resellerId_idx (resellerId);
ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_statusId_idx (statusId);
ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_companyName_idx (companyName);

INSERT INTO activeCustomer_view 
(
customerId,
resellerId,
accountId,
companyName,
email,
billingAddressId,
anniversaryDate,
statusId,
originalActivationDate,
cancellationDate,
hostedFaxEnabled,
timezone,
referring_organization_id
)
SELECT 
customerId,
resellerId,
accountId,
companyName,
email,
billingAddressId,
anniversaryDate,
statusId,
originalActivationDate,
cancellationDate,
hostedFaxEnabled,
timezone,
referring_organization_id
 FROM customer
WHERE statusId NOT IN (2,3)
  AND companyName NOT LIKE '%test%'
  AND companyName NOT LIKE '%demo%'
  AND companyName NOT LIKE '%Test%'
  AND companyName NOT LIKE '%Demo%';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createCancelledCustomerView` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=``@`` PROCEDURE `createCancelledCustomerView`()
BEGIN

DROP TABLE IF EXISTS cancelledCustomer_view;
CREATE TABLE cancelledCustomer_view(
activeCustomer_id SERIAL,
customerId INT(11),
resellerId INT(11),
accountId INT(11),
companyName VARCHAR(255),
email VARCHAR(255),
billingAddressId INT(11),
anniversaryDate INT(11),
statusId INT(11),
originalActivationDate DATETIME,
cancellationDate DATETIME,
hostedFaxEnabled TINYINT(4),
timezone VARCHAR(255),
referring_organization_id BIGINT(20)
) ENGINE=MEMORY;

ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_customerId_idx (customerId);
ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_resellerId_idx (resellerId);
ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_statusId_idx (statusId);
ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_companyName_idx (companyName);

INSERT INTO cancelledCustomer_view 
(
customerId,
resellerId,
accountId,
companyName,
email,
billingAddressId,
anniversaryDate,
statusId,
originalActivationDate,
cancellationDate,
hostedFaxEnabled,
timezone,
referring_organization_id
)
SELECT 
customerId,
resellerId,
accountId,
companyName,
email,
billingAddressId,
anniversaryDate,
statusId,
originalActivationDate,
cancellationDate,
hostedFaxEnabled,
timezone,
referring_organization_id
 FROM customer
WHERE companyName NOT LIKE '%test%'
  AND companyName NOT LIKE '%demo%'
  AND companyName NOT LIKE '%Test%'
  AND companyName NOT LIKE '%Demo%'
GROUP BY 1 HAVING DATEDIFF( cancellationDate,originalActivationDate ) > 7;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getAnuallRev` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAnuallRev`()
BEGIN

DECLARE jan,feb,march,april,may,june,july,aug,sept,oct,nov,december DECIMAL(10,2);

DECLARE jan2017,feb2017,march2017,april2017,may2017,june2017,july2017,aug2017,sept2017,oct2017,nov2017,december2017 DECIMAL(10,2);
DECLARE nov2016,december2016 DECIMAL(10,2);

  

  SELECT SUM(i.total) as "value"
   INTO nov2016
   FROM invoice i
  WHERE billingStartDate BETWEEN '2016-10-31' AND '2016-12-01';


  SELECT SUM(i.total) as "value"
   INTO december2016
   FROM invoice i
  WHERE billingStartDate BETWEEN '2016-11-31' AND '2017-01-01';
 

 
  SELECT SUM(i.total) as "value"
   INTO jan2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-12-31' AND '2017-02-01';    
 
 SELECT SUM(i.total) as "value"
   INTO feb2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-01-31' AND '2017-03-01';
    
 
 SELECT SUM(i.total) as "value"
   INTO march2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-02-31' AND '2017-04-01';
        
 
 SELECT SUM(i.total) as "value"
   INTO april2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-03-31' AND '2017-05-01';
    
 
 SELECT SUM(i.total) as "value"
   INTO may2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-04-31' AND '2017-06-01';
    
 
 SELECT SUM(i.total) as "value"
   INTO june2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-05-31' AND '2017-07-01';
    
 
 SELECT SUM(i.total) as "value"
   INTO july2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-06-31' AND '2017-08-01';

 
 SELECT SUM(i.total) as "value"
   INTO aug2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-07-31' AND '2017-09-01';

 
 SELECT SUM(i.total) as "value"
   INTO sept2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-08-31' AND '2017-10-01';

 
 SELECT SUM(i.total) as "value"
   INTO oct2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-09-31' AND '2017-11-01';

 
 SELECT SUM(i.total) as "value"
   INTO nov2017
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-10-31' AND '2017-12-01';

 
 SELECT SUM(i.total) as "value"
   INTO december2016
   FROM endUserBilling_view i
  WHERE billingStartDate BETWEEN '2017-11-31' AND '2018-01-01';

SELECT "Nov 2016" AS "date",
        nov2016 AS "value"
UNION       
SELECT "Dec 2016" AS "date",
        december2016 AS "value"
UNION        
SELECT "Jan" AS "date",jan2017 AS "value"
UNION
SELECT "Feb" AS "date",feb2017 AS "value"
UNION
SELECT "Mar" AS "date",march2017 AS "value"
UNION       
SELECT "Apr" AS "date",april2017 AS "value"
UNION       
SELECT "May" AS "date",may2017 AS "value"
UNION       
SELECT "June" AS "date",june2017 AS "value"
UNION       
SELECT "July" AS "date",july2017 AS "value"
UNION       
SELECT "Aug" AS "date", aug2017 AS "value"
UNION       
SELECT "Sept" AS "date",sept2017 AS "value"
UNION       
SELECT "Oct" AS "date",oct2017 AS "value"
UNION       
SELECT "Nov" AS "date",nov2017 AS "value"
UNION       
SELECT "Dec" AS "date",december2017 AS "value";

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getAnuallRevByMonth` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAnuallRevByMonth`(in_resellerId INT)
BEGIN

DECLARE jan,feb,march,april,may,june,july,aug,sept,oct,nov,december DECIMAL(10,2);
 
 SELECT SUM(i.total) as "value"
   INTO jan
   FROM invoice i
  WHERE billingStartDate BETWEEN '2016-12-31' AND '2017-02-01'
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO feb
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-01-31' AND '2017-03-01'
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO march
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-02-31' AND '2017-04-01'
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO april
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-03-31' AND '2017-05-01'
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO may
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-04-31' AND '2017-06-01'
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO june
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-05-31' AND '2017-07-01'
    AND resellerId = in_resellerId;   
    
 
 SELECT SUM(i.total) as "value"
   INTO july
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-06-31' AND '2017-08-01'
    AND resellerId = in_resellerId;                       

 
 SELECT SUM(i.total) as "value"
   INTO aug
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-07-31' AND '2017-09-01'
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO sept
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-08-31' AND '2017-10-01'
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO oct
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-09-31' AND '2017-11-01'
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO nov
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-10-31' AND '2017-12-01'
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO december
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-11-31' AND '2018-01-01'
    AND resellerId = in_resellerId;  

SELECT "Jan" AS "date",jan AS "value"
UNION
SELECT "Feb" AS "date",feb AS "value"
UNION
SELECT "Mar" AS "date",march AS "value"
UNION       
SELECT "Apr" AS "date",april AS "value"
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
/*!50003 DROP PROCEDURE IF EXISTS `getCustomerDeviceCounts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDeviceCounts`(in_customerId INT)
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
              where c.customerId = in_customerId
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
              where c.customerId = in_customerId 
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
              where c.customerId = in_customerId 
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
              where c.customerId = in_customerId 
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
              where c.customerId = in_customerId
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
/*!50003 DROP PROCEDURE IF EXISTS `getCustomerEndUserBilling` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerEndUserBilling`(in_customerId INT)
BEGIN

DECLARE jan,feb,march,april,may,june,july,aug,sept,oct,nov,december, december2016 DECIMAL(10,2);


SELECT SUM(i.total) as "value"
   INTO december2016
   FROM invoice i
  WHERE billingStartDate BETWEEN '2016-11-31' AND '2017-01-01'
    AND customerId = in_customerId; 

SELECT SUM(i.total) as "value"
   INTO jan
   FROM invoice i
  WHERE billingStartDate BETWEEN '2016-12-31' AND '2017-02-01'
    AND customerId = in_customerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO feb
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-01-31' AND '2017-03-01'
    AND customerId = in_customerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO march
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-02-31' AND '2017-04-01'
    AND customerId = in_customerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO april
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-03-31' AND '2017-05-01'
    AND customerId = in_customerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO may
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-04-31' AND '2017-06-01'
    AND customerId = in_customerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO june
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-05-31' AND '2017-07-01'
    AND customerId = in_customerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO july
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-06-31' AND '2017-08-01'
    AND customerId = in_customerId  ;  

 
 SELECT SUM(i.total) as "value"
   INTO aug
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-07-31' AND '2017-09-01'
    AND customerId = in_customerId;

 
 SELECT SUM(i.total) as "value"
   INTO sept
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-08-31' AND '2017-10-01'
    AND customerId = in_customerId;

 
 SELECT SUM(i.total) as "value"
   INTO oct
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-09-31' AND '2017-11-01'
    AND customerId = in_customerId;

 
 SELECT SUM(i.total) as "value"
   INTO nov
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-10-31' AND '2017-12-01'
    AND customerId = in_customerId;
 
 SELECT SUM(i.total) as "value"
   INTO december
   FROM invoice i
  WHERE billingStartDate BETWEEN '2017-11-31' AND '2018-01-01'
    AND customerId = in_customerId; 

SELECT "Dec 2016" AS "date", december2016 AS "value"
UNION
SELECT "Jan" AS "date",jan AS "value"
UNION
SELECT "Feb" AS "date",feb AS "value"
UNION
SELECT "Mar" AS "date",march AS "value"
UNION       
SELECT "Apr" AS "date",april AS "value"
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
/*!50003 DROP PROCEDURE IF EXISTS `getCustomerGrowthCount` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerGrowthCount`(in_resellerId INT, in_year INT)
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
    v_dec ,
    v_janCan ,
    v_febCan,
    v_marCan,
    v_aprCan, 
    v_mayCan,
    v_junCan,
    v_julyCan,
    v_augCan,
    v_septCan,
    v_octCan,
    v_novCan,
    v_decCan INT(11);

SELECT COUNT(customerId)
  INTO v_jan
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT(in_year ,'-01-31')
   AND r.resellerId = in_resellerId;
   
   
   SELECT COUNT(c.customerId)
   INTO v_janCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT(in_year ,'-01-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_feb
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-01-31') AND CONCAT(in_year, '-02-31')
   AND r.resellerId = in_resellerId;
   
      
   SELECT COUNT(c.customerId)
   INTO v_febCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-01-31') AND CONCAT(in_year, '-02-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_mar
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-02-01') AND CONCAT(in_year, '-03-31')
   AND r.resellerId = in_resellerId;
   

   SELECT COUNT(c.customerId)
   INTO v_marCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-02-01') AND CONCAT(in_year, '-03-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_apr
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-03-31') AND CONCAT(in_year, '-04-31')
   AND r.resellerId = in_resellerId;
   

   SELECT COUNT(c.customerId)
   INTO v_aprCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-03-31') AND CONCAT(in_year, '-04-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;   

SELECT COUNT(customerId)
  INTO v_may
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-04-31') AND CONCAT(in_year, '-05-31')
   AND r.resellerId = in_resellerId;
   

   SELECT COUNT(c.customerId)
   INTO v_mayCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-04-31') AND CONCAT(in_year, '-05-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;     

SELECT COUNT(customerId)
  INTO v_jun
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-05-31') AND CONCAT(in_year, '-06-31')
   AND r.resellerId = in_resellerId;
   

   SELECT COUNT(c.customerId)
   INTO v_junCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-05-31') AND CONCAT(in_year, '-06-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;     

SELECT COUNT(customerId)
  INTO v_july
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-06-31') AND CONCAT(in_year, '-07-31')
   AND r.resellerId = in_resellerId;
   

   SELECT COUNT(c.customerId)
   INTO v_julyCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate  BETWEEN CONCAT(in_year, '-06-31') AND CONCAT(in_year, '-07-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;   

SELECT COUNT(customerId)
  INTO v_aug
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-07-31') AND CONCAT(in_year, '-08-31')
   AND r.resellerId = in_resellerId;
   
   
   SELECT COUNT(c.customerId)
   INTO v_augCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-07-31') AND CONCAT(in_year, '-08-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_sept
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-08-31') AND CONCAT(in_year, '-09-31')
   AND r.resellerId = in_resellerId;
   
      
   SELECT COUNT(c.customerId)
   INTO v_septCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-08-31') AND CONCAT(in_year, '-09-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_oct
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-09-31') AND CONCAT(in_year, '-10-31')
   AND r.resellerId = in_resellerId;
   
         
   SELECT COUNT(c.customerId)
   INTO v_octCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-09-31') AND CONCAT(in_year, '-10-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_nov
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-10-31') AND CONCAT(in_year, '-11-31')
   AND r.resellerId = in_resellerId;
   
            
   SELECT COUNT(c.customerId)
   INTO v_novCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-10-31') AND CONCAT(in_year, '-11-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.resellerId = in_resellerId;


SELECT COUNT(customerId)
  INTO v_dec
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN CONCAT(in_year, '-11-31') AND CONCAT(in_year, '-12-31')
   AND r.resellerId = in_resellerId;
   
            
   SELECT COUNT(c.customerId)
   INTO v_decCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN CONCAT(in_year, '-11-31') AND CONCAT(in_year, '-12-31')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
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
    v_dec ,
    v_janCan ,
    v_febCan,
    v_marCan,
    v_aprCan, 
    v_mayCan,
    v_junCan,
    v_julyCan,
    v_augCan,
    v_septCan,
    v_octCan,
    v_novCan,
    v_decCan;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getCustomerGrowthREPORT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerGrowthREPORT`(in_resellerId INT)
BEGIN

DECLARE v_CustomerTotal,
        v_CustomerTotal2016,
        v_Cancellations2016,
        v_Cancellations2017,
        v_dec2016,
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


SELECT COUNT(customerId) INTO v_CustomerTotal2016
  FROM activeCustomer_view c 
 WHERE c.originalActivationDate BETWEEN '2015-12-31' AND '2017-01-01'
   AND c.originalActivationDate IS NOT NULL
   AND resellerId = in_resellerid; 

DROP TABLE IF EXISTS tmp_2016Cancellations;                             
CREATE TEMPORARY TABLE tmp_2016Cancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE c.cancellationDate BETWEEN '2015-12-31' AND '2017-01-01'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations2016 FROM tmp_2016Cancellations;


DROP TABLE IF EXISTS tmp_2017Cancellations;
CREATE TEMPORARY TABLE tmp_2017Cancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE cancellationDate BETWEEN '2016-12-31' AND '2018-01-01'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations2017 FROM tmp_2017Cancellations;

SELECT COUNT(*)
INTO v_dec2016
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2016-11-31' AND '2017-01-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_jan
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2016-12-31' AND '2017-02-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_feb
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-01-31' AND '2017-03-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_march
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-02-31' AND '2017-04-01'
  AND resellerId = in_resellerId;    

SELECT COUNT(*)
INTO v_april
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-03-31' AND '2017-05-01'
  AND resellerId = in_resellerId;    

SELECT COUNT(*)
INTO v_may
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-04-31' AND '2017-06-01'
  AND resellerId = in_resellerId;   

SELECT COUNT(*)
INTO v_june
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-05-31' AND '2017-07-01'
  AND resellerId = in_resellerId;     
  
SELECT COUNT(*)
INTO v_july
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-06-31' AND '2017-08-01'
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_aug
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-07-31' AND '2017-09-01'
  AND resellerId = in_resellerId;
     
SELECT COUNT(*)
INTO v_sept
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-09-31' AND '2017-10-01'
   AND resellerId = in_resellerId;
   
SELECT COUNT(*)
INTO v_oct
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-10-31' AND '2017-11-01'
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_nov
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-11-31' AND '2017-12-01'
  AND resellerId = in_resellerId;
       
SELECT COUNT(*)
INTO v_dec
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN '2017-11-31' AND '2017-01-01'
  AND resellerId = in_resellerId;

SELECT v_CustomerTotal2016 AS "Growth From Last Year",
       (v_CustomerTotal - v_CustomerTotal2016) AS "Last Years Customer Base",
       v_CustomerTotal AS "This Years Customer Base To Date",
       ( v_jan + v_feb + v_march + v_april + v_may + v_june + v_july + v_aug + v_sept + v_oct + v_nov + v_dec) AS "This Years Growth",
       v_Cancellations2016 AS "2016 Cancellations",
       v_Cancellations2017 AS "2017 Cancellations";
       
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getCustomerList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getCustomerList`()
BEGIN

DROP TABLE IF EXISTS customerList_view;
CREATE TABLE customerList_view AS
SELECT DISTINCT c.customerId,
             c.companyName,
             a.state,
             CAST(c.originalActivationDate AS DATE) originalActivationDate,
             co.contractLength,
             
             r.companyName "reseller",
             CASE n.enabled
               WHEN 1 THEN "ENABLED"
               WHEN 0 THEN "NOT ENABLED"
             ELSE
              "NOT CONFIGURED"
             END AS "trust",
             s.hostname
        FROM reseller r
        JOIN customer c USING (resellerId)
        JOIN branch b ON (c.customerId = b.customerId)
        LEFT JOIN server s ON (b.featureServerId=s.serverId)
        JOIN contract co ON (c.customerId = co.customerId)
        LEFT JOIN network n USING (branchId)
        JOIN address a ON (a.addressId = c.billingAddressId)
       WHERE c.statusId NOT IN (2,3)
         AND c.companyName NOT LIKE "%demo%"
         AND c.companyName NOT LIKE "%test%"
         AND r.companyName NOT LIKE "%demo%"
         AND r.companyName NOT LIKE "%test%"
         AND co.retiredDate IS NOT NULL;


ALTER TABLE customerList_view ADD INDEX customerList_customerId_idx (customerId);
ALTER TABLE customerList_view ADD INDEX customerList_origActDate_idx (originalActivationDate);
ALTER TABLE customerList_view ADD INDEX customerList_contractLength_idx (contractLength);
ALTER TABLE customerList_view ADD INDEX customerList_hostname_idx (hostname);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getCustomerProductionServices` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerProductionServices`(in_customerId INT)
BEGIN

  DECLARE 
          v_didCount, 
          v_extCount, 
          v_mailCount, 
          v_aaCount, 
          v_timeFrameCount, 
          v_groupCount, 
          v_confCount INT(11);
  


SELECT COUNT(didId)
INTO v_didCount    
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND did.isActive
   AND c.customerId = in_customerId;


 
 SELECT COUNT(extensionId)
 INTO v_extCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN extension e ON (b.branchId = e.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND e.extensionTypeId=1
   AND b.isProvisioned
   AND e.isFreeExtension=0
AND c.customerId = in_customerId;

 
SELECT COUNT(mailBoxId)
INTO v_mailCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN mailbox m ON (b.branchId = m.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND c.customerId = in_customerId;
   

 
SELECT COUNT(aaId)
INTO v_aaCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN aa ON (b.branchId = aa.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND c.customerId = in_customerId;
      

 
 SELECT COUNT(ahId)
 INTO v_timeFrameCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN ah ON (b.branchId = ah.branchId)
  WHERE c.statusId NOT IN (2,3)
AND c.customerId = in_customerId;

 
  SELECT COUNT(groupId)
    INTO v_groupCount
    FROM customer c
    JOIN branch b ON (b.customerId = c.customerId)
    JOIN groups g ON (b.branchId = g.branchId)
   WHERE c.statusId NOT IN (2,3)
     AND b.isProvisioned
     AND c.customerId = in_customerId;
     

 
SELECT COUNT(conferenceBridgeId)
INTO v_confCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN conference conf ON (b.branchId = conf.branchId)
  WHERE c.statusId NOT IN (2,3)
  AND b.isProvisioned
AND c.customerId = in_customerId;
 

SELECT v_didCount,v_extCount,v_mailCount,v_aaCount,v_timeFrameCount,v_groupCount,v_confCount;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getDeviceCounts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
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
/*!50003 DROP PROCEDURE IF EXISTS `getOverallCustomerExtensionCounts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverallCustomerExtensionCounts`(in_customerId INT)
BEGIN


DECLARE v_std2017,
        v_std2018,
        v_cloud2017,
        v_cloud2018,
        v_sip2017,
        v_sip2018 INT;


SELECT COUNT(e.extensionId)
  INTO v_std2017
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
   AND c.originalActivationDate < '2018-01-01'
   AND c.customerId = in_customerId;
   

SELECT COUNT(e.extensionId)
  INTO v_std2018
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
AND c.customerId = in_customerId;      


SELECT COUNT(e.extensionId)
  INTO v_cloud2017
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
   AND c.originalActivationDate < '2018-01-01'
AND c.customerId = in_customerId;   

SELECT COUNT(e.extensionId)
  INTO v_cloud2018
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
AND c.customerId = in_customerId;

SELECT COUNT(b.branchId)
  INTO v_sip2017
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
 AND c.originalActivationDate < '2018-01-01'
AND c.customerId = in_customerId;
 
SELECT COUNT(b.branchId)
  INTO v_sip2018
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
AND c.customerId = in_customerId; 

 SELECT '2017',v_std2017,v_cloud2017,v_sip2017
 UNION
 SELECT '2018',v_std2018,v_cloud2018,v_sip2018;
 
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getOverAllCustomerGrowthREPORT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverAllCustomerGrowthREPORT`(in_year INT)
BEGIN

DECLARE v_CustomerTotal,
        v_CustomerTotalPrev,
        v_CancellationsPrev,
        v_Cancellations INT;

SELECT DISTINCT COUNT(customerId)
  INTO v_CustomerTotal 
  FROM activeCustomer_view;

DROP TABLE IF EXISTS tmp_PrevCancellations;
CREATE TEMPORARY TABLE tmp_PrevCancellations AS
SELECT c.customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM cancelledCustomer_view c
 WHERE c.cancellationDate BETWEEN CONCAT((in_year-2), '-12-31') AND CONCAT(in_year, '-01-01')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.companyName NOT LIKE '%demo%'
   AND c.companyName NOT LIKE '%test%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_CancellationsPrev FROM tmp_PrevCancellations;
 
DROP TABLE IF EXISTS tmp_Cancellations;
CREATE TEMPORARY TABLE tmp_Cancellations AS
SELECT c.customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM cancelledCustomer_view c
 WHERE c.cancellationDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT((in_year+1), '-01-01')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
    AND c.companyName NOT LIKE '%demo%'
   AND c.companyName NOT LIKE '%test%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations FROM tmp_Cancellations;

SELECT COUNT(customerId) INTO v_CustomerTotalPrev 
  FROM activeCustomer_view c 
 WHERE c.originalActivationDate < CONCAT(in_year, '-01-01');

DROP TABLE IF EXISTS customer_growth;
CREATE TABLE customer_growth (
        CustomerTotal INT(11),
        CustomerTotalPrev INT(11),
        CancellationsPrev INT(11),
        Cancellations INT(11),
        updated DATETIME
);

INSERT INTO customer_growth VALUES (v_CustomerTotal, v_CustomerTotalPrev, v_CancellationsPrev, v_Cancellations, NOW());

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getOverallExtensionCounts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverallExtensionCounts`()
BEGIN


DECLARE v_std2017,
        v_std2018,
        v_cloud2017,
        v_cloud2018,
        v_sip2017,
        v_sip2018 INT;


SELECT COUNT(e.extensionId)
  INTO v_std2017
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND c.originalActivationDate < '2018-01-01';
   

SELECT COUNT(e.extensionId)
  INTO v_std2018
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0;
      
SELECT COUNT(e.extensionId)
  INTO v_cloud2017
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND c.originalActivationDate < '2018-01-01';
   
SELECT COUNT(e.extensionId)
  INTO v_cloud2018
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0;

SELECT COUNT(b.branchId)
  INTO v_sip2017
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND c.originalActivationDate < '2018-01-01';

 
 SELECT COUNT(b.branchId)
  INTO v_sip2018
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1;
 
 SELECT '2017',v_std2017,v_cloud2017,v_sip2017
 UNION
 SELECT '2018',v_std2018,v_cloud2018,v_sip2018;
 
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getOverallResellerExtensionCounts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverallResellerExtensionCounts`(in_resellerId INT)
BEGIN


DECLARE v_std2017,
        v_std2018,
        v_cloud2017,
        v_cloud2018,
        v_sip2017,
        v_sip2018 INT;


SELECT COUNT(e.extensionId)
  INTO v_std2017
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.originalActivationDate < '2018-01-01'
   AND r.resellerId = in_resellerId;
   

SELECT COUNT(e.extensionId)
  INTO v_std2018
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND r.resellerId = in_resellerId;
      


SELECT COUNT(e.extensionId)
  INTO v_cloud2017
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND c.originalActivationDate < '2018-01-01'
   AND r.resellerId = in_resellerId;
   
   


SELECT COUNT(e.extensionId)
  INTO v_cloud2018
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1
   AND e.extensionTypeId=2
   AND e.isFreeExtension=0
   AND r.resellerId = in_resellerId;




SELECT COUNT(b.branchId)
  INTO v_sip2017
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND c.originalActivationDate < '2018-01-01'
 AND r.resellerId = in_resellerId;

 
SELECT COUNT(b.branchId)
  INTO v_sip2018
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND r.resellerId = in_resellerId;
 
 SELECT '2017',v_std2017,v_cloud2017,v_sip2017
 UNION
 SELECT '2018',v_std2018,v_cloud2018,v_sip2018;
 
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getProductionServices` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
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
  


SELECT COUNT(didId)
INTO v_didCount    
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN did ON (b.branchId = did.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND did.isActive
   AND c.resellerId = in_resellerId;


 
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

 
SELECT COUNT(mailBoxId)
INTO v_mailCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN mailbox m ON (b.branchId = m.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND c.resellerId = in_resellerId;
   

 
SELECT COUNT(aaId)
INTO v_aaCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN aa ON (b.branchId = aa.branchId)
 WHERE c.statusId NOT IN (2,3)
   AND b.isProvisioned
   AND c.resellerId = in_resellerId;
      

 
 SELECT COUNT(ahId)
 INTO v_timeFrameCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN ah ON (b.branchId = ah.branchId)
  WHERE c.statusId NOT IN (2,3)
AND c.resellerId = in_resellerId;

 
  SELECT COUNT(groupId)
    INTO v_groupCount
    FROM customer c
    JOIN branch b ON (b.customerId = c.customerId)
    JOIN groups g ON (b.branchId = g.branchId)
   WHERE c.statusId NOT IN (2,3)
     AND b.isProvisioned
     AND c.resellerId = in_resellerId;
     

 
SELECT COUNT(conferenceBridgeId)
INTO v_confCount
  FROM customer c
  JOIN branch b ON (b.customerId = c.customerId)
  JOIN conference conf ON (b.branchId = conf.branchId)
  WHERE c.statusId NOT IN (2,3)
  AND b.isProvisioned
AND c.resellerId = in_resellerId;
 

SELECT v_didCount,v_extCount,v_mailCount,v_aaCount,v_timeFrameCount,v_groupCount,v_confCount;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getServiceProviders` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getServiceProviders`()
BEGIN

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
        LEFT JOIN address a ON (r.addressId=a.addressId)
       WHERE r.companyName NOT LIKE '%test%'
         AND r.companyName NOT LIKE '%demo%';
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


      
      
      SELECT COUNT(customerId)
        INTO v_customerCount
        FROM customer 
       WHERE statusId NOT IN (2,3) 
         AND resellerId = v_resellerId;
        
     
      SELECT v_resellerId,v_companyName,v_tier,v_phoneNum,v_address,v_extCount, v_customerCount;
      INSERT INTO tmp_sp VALUES (v_resellerId,v_companyName,v_tier,v_phoneNum,v_address,v_extCount,v_customerCount);
      
    END LOOP;
    
    
    SELECT * FROM tmp_sp;  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getTop10` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
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
/*!50003 DROP PROCEDURE IF EXISTS `getTop10Sp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
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
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND c.companyName NOT LIKE '%Test%'
   AND c.companyName NOT LIKE '%Demo%'
 GROUP BY 1 HAVING COUNT(customerId) > 230
 ORDER BY 2 DESC
 LIMIT 10;
 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;


SELECT MIN(custCount)
  INTO minCount
  FROM (
        SELECT resellerId, COUNT(customerId) custCount
          FROM customer c
         WHERE c.statusId NOT IN (2,3)
           AND c.companyName NOT LIKE '%test%'
           AND c.companyName NOT LIKE '%demo%'
           AND c.companyName NOT LIKE '%Test%'
           AND c.companyName NOT LIKE '%Demo%'
         GROUP BY 1
        ) t;

SELECT MAX(custCount)
  INTO maxCount
  FROM (
        SELECT resellerId, COUNT(customerId) custCount
          FROM customer c
         WHERE c.statusId NOT IN (2,3)
           AND c.companyName NOT LIKE '%test%'
           AND c.companyName NOT LIKE '%demo%'
           AND c.companyName NOT LIKE '%Test%'
           AND c.companyName NOT LIKE '%Demo%'
         GROUP BY 1
        ) t;

SELECT COUNT(customerId)
  INTO totalCustomerBase
  FROM customer c
 WHERE c.statusId NOT IN (2,3)
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND c.companyName NOT LIKE '%Test%'
   AND c.companyName NOT LIKE '%Demo%';

 TRUNCATE top10_REPORT;

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




   CALL getTop10();


 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getTop5CustomersSpDrillIn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
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
       

   END IF;
      
  END LOOP; 
  
  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_api_tokens` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_api_tokens`()
BEGIN

  DECLARE _done_ BOOLEAN DEFAULT FALSE;
  DECLARE customer_id INT;

  DECLARE customers CURSOR FOR
             SELECT DISTINCT(aac.customerId)
               FROM apiApplicationCustomer aac
               LEFT JOIN customer c ON (aac.customerId=c.customerId)
               LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
              WHERE aac.status=1
                AND c.statusId=1
                AND aac.apiApplicationId NOT IN (1, 5, 11);
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET _done_ = TRUE;

  DROP TABLE IF EXISTS api_tokens_tmp;
  CREATE TABLE IF NOT EXISTS api_tokens_tmp (
         resellerId VARCHAR(255),
	 r_companyName VARCHAR(255),
	 c_companyName VARCHAR(255),
	 description VARCHAR(255),
	 extensionId VARCHAR(255),
	 extensionNumber VARCHAR(255),
	 callerId VARCHAR(255)
	 );

  OPEN customers;

  for_loop: LOOP
    FETCH customers INTO customer_id;

  IF _done_ THEN
    LEAVE for_loop;
  ELSE
    INSERT IGNORE INTO api_tokens_tmp 
    (
     resellerId,
     r_companyName,
     c_companyName,
     description,
     extensionId,
     extensionNumber,
     callerId
    )	
    
    SELECT r.resellerId Reseller_ID,
           r.companyName Reseller_Name,
           c.companyName Customer_Name,
           b.description PBX_Context,
           e.extensionId Extension_ID,
           e.extensionNumber Extension_Number,
           e.callerId Extension_Name
      FROM branch b
      LEFT JOIN customer c ON (b.customerId=c.customerId)
      LEFT JOIN extension e ON (b.branchId=e.branchId)
      LEFT JOIN reseller r ON (b.resellerId=r.resellerId)
     WHERE b.customerId=customer_id
       AND e.extensionTypeId=1;
  END IF;
  END LOOP;

  CLOSE customers;

  SELECT 'Reseller_ID',
         'Reseller_Name',
	 'Customer_Name',
	 'PBX_Context',
	 'Extension_ID',
	 'Extension_Number',
	 'Extension_Name'
  UNION ALL
  SELECT 
        resellerId Reseller_ID,
        r_companyName Reseller_Name,
        c_companyName Customer_Name,
        description PBX_Context,
        extensionId Extension_ID,
        extensionNumber Extension_Number,
        callerId Extension_Name
   FROM api_tokens_tmp

    INTO OUTFILE '/tmp/rsbilling_ApiTokens_January2018.csv'
    FIELDS  TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `jta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `jta`(in_year INT)
BEGIN

DECLARE v_CustomerTotal,
        v_CustomerTotalPrev,
        v_CancellationsPrev,
        v_Cancellations INT;

SELECT DISTINCT COUNT(customerId)
  INTO v_CustomerTotal 
  FROM activeCustomer_view;

DROP TABLE IF EXISTS tmp_PrevCancellations;
CREATE TEMPORARY TABLE tmp_PrevCancellations AS
SELECT c.customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM cancelledCustomer_view c
 WHERE c.cancellationDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT(in_year, '-01-01')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.companyName NOT LIKE '%demo%'
   AND c.companyName NOT LIKE '%test%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_CancellationsPrev FROM tmp_PrevCancellations;
 
DROP TABLE IF EXISTS tmp_Cancellations;
CREATE TEMPORARY TABLE tmp_Cancellations AS
SELECT c.customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM cancelledCustomer_view c
 WHERE c.cancellationDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT((in_year+1), '-01-01')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
    AND c.companyName NOT LIKE '%demo%'
   AND c.companyName NOT LIKE '%test%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations FROM tmp_Cancellations;

SELECT COUNT(customerId) INTO v_CustomerTotalPrev 
  FROM activeCustomer_view c 
 WHERE c.originalActivationDate < CONCAT(in_year, '-01-01');

DROP TABLE IF EXISTS customer_growth;
CREATE TABLE customer_growth (
        CustomerTotal INT(11),
        CustomerTotalPrev INT(11),
        CancellationsPrev INT(11),
        Cancellations INT(11),
        updated DATETIME
);

INSERT INTO customer_growth VALUES (v_CustomerTotal, v_CustomerTotalPrev, v_CancellationsPrev, v_Cancellations, NOW());

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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-27 14:34:52
