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


 END
