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
    
END
