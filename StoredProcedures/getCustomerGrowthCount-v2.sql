CREATE DEFINER=`root`@`localhost` PROCEDURE `portal`.`getCustomerGrowthCount`(in_resellerId INT)
BEGIN
DECLARE v_jan, v_feb, v_mar, v_apr, v_may, v_jun, v_july, 
        v_janCan, v_febCan, v_marCan, v_aprCan, v_mayCan, v_junCan, v_julyCan,
        v_totalCountJan, v_totalCountFeb, v_totalCountMar, v_totalCountApr, v_totalCountMay, v_totalCountJun, v_totalCountJul INT(11);
DECLARE reseller_name VARCHAR(255);
    
SELECT r.companyName INTO reseller_name FROM reseller r WHERE r.resellerId=in_resellerId;

-- Get Total Customer Count
SELECT COUNT(customerId)
  INTO v_totalCountJan
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate <= '2016-01-31'
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
   AND c.resellerId = in_resellerId;

SELECT COUNT(customerId)
  INTO v_jan
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2015-12-31' AND '2016-01-31'
   AND c.resellerId = in_resellerId;
      
SELECT COUNT(c.customerId)
  INTO v_janCan
  FROM customer c
  JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN '2015-12-31' AND '2016-01-31'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';
   
-- Get Total Customer Count
SELECT COUNT(customerId)
  INTO v_totalCountFeb
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate <= '2016-02-31'
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
   AND c.resellerId = in_resellerId;   

SELECT COUNT(customerId)
  INTO v_feb
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2016-01-31' AND '2016-02-31'
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
   AND c.resellerId = in_resellerId;
         
SELECT COUNT(c.customerId)
  INTO v_febCan
  FROM customer c
  JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN '2016-01-31' AND '2016-02-31'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';   

-- Get Total Customer Count
SELECT COUNT(customerId)
  INTO v_totalCountMar
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate <= '2016-03-31'
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
   AND c.resellerId = in_resellerId;   

SELECT COUNT(customerId)
  INTO v_mar
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2016-02-31' AND '2016-03-31'
   AND c.resellerId =in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';
   

   SELECT COUNT(c.customerId)
   INTO v_marCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN '2016-02-01' AND '2016-03-31'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';

-- Get Total Customer Count
SELECT COUNT(customerId)
  INTO v_totalCountApr
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate <= '2016-04-31'
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';

SELECT COUNT(customerId)
  INTO v_apr
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2016-03-31' AND '2016-04-31'
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
   AND c.resellerId = in_resellerId;
   

   SELECT COUNT(c.customerId)
   INTO v_aprCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN '2016-03-31' AND '2016-04-31'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';

-- Get Total Customer Count
SELECT COUNT(customerId)
  INTO v_totalCountMay
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate <= '2016-05-31'
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'; 
   
SELECT COUNT(customerId)
  INTO v_may
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2016-04-31' AND '2016-05-31'
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';
   

   SELECT COUNT(c.customerId)
   INTO v_mayCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN '2016-04-31' AND '2016-05-31'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';
   
-- Get Total Customer Count
SELECT COUNT(customerId)
  INTO v_totalCountJun
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate <= '2016-06-31'
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';

SELECT COUNT(customerId)
  INTO v_jun
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2016-05-31' AND '2016-06-31'
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';
   

   SELECT COUNT(c.customerId)
   INTO v_junCan
    FROM customer c
    JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate BETWEEN '2016-05-31' AND '2016-06-31'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';
   
-- Get Total Customer Count
SELECT COUNT(customerId)
  INTO v_totalCountJul
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate <= '2016-07-31'
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';     

SELECT COUNT(customerId)
  INTO v_july
  FROM customer c
  LEFT JOIN reseller r USING (resellerId)
 WHERE c.statusId NOT IN (2,3)
   AND originalActivationDate BETWEEN '2016-06-31' AND '2016-07-31'
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';
   
SELECT COUNT(c.customerId)
  INTO v_julyCan
  FROM customer c
  JOIN reseller r ON (c.resellerId = r.resellerId)
 WHERE c.cancellationDate  BETWEEN '2016-06-31' AND '2016-07-31'
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%';

SELECT in_resellerId AS "SPID",
       reseller_name AS "SP",
       
       v_jan AS "Add In Jan", 
       v_janCan AS "Can In Jan", 
       v_totalCountJan AS "Total Count Jan",
       
       v_feb AS "Add In Feb", 
       v_febCan AS "Can In Feb",
       v_totalCountFeb AS "Total Count Feb",
       
       v_mar AS "Add In Mar",
       v_marCan AS "Can In Mar",
       v_totalCountMar AS "Total Count Mar",
       
       v_apr AS "Add In Apr",
       v_aprCan AS "Can In Apr",
       v_totalCountApr AS "Total Count Apr",
       
       v_may AS "Add In May",
       v_mayCan AS "Can In May",
       v_totalCountMay AS "Total Count May",

       v_jun AS "Add In Jun",
       v_junCan AS "Can In Jun",
       v_totalCountJun AS "Total Count Jun",
       
       v_july AS "Add In Jul",
       v_julyCan AS "Can In Jul",
       v_totalCountJul AS "Total Count Jul";
    
END
