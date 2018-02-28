CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerGrowthREPORT`(in_resellerId INT, in_year INT)
BEGIN

DECLARE v_CustomerTotal,
        v_CustomerTotalPrev,
        v_CancellationsPrev,
        v_Cancellations,
        v_decPrev,
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


SELECT COUNT(customerId) INTO v_CustomerTotalPrev
  FROM activeCustomer_view c 
 WHERE c.originalActivationDate BETWEEN CONCAT((in_year-2), '-12-31') AND CONCAT(in_year, '-01-01')
   AND c.originalActivationDate IS NOT NULL
   AND resellerId = in_resellerid; 

DROP TABLE IF EXISTS tmp_PrevCancellations;                             
CREATE TEMPORARY TABLE tmp_PrevCancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE c.cancellationDate BETWEEN CONCAT((in_year-2), '-12-31') AND CONCAT(in_year, '-01-01')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_CancellationsPrev FROM tmp_PrevCancellations;


DROP TABLE IF EXISTS tmp_Cancellations;
CREATE TEMPORARY TABLE tmp_Cancellations AS
SELECT customerId,
       c.originalActivationDate,
       c.cancellationDate,
       DATEDIFF( c.cancellationDate,c.originalActivationDate ) AS "Days On Board"
  FROM customer c
 WHERE cancellationDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT((in_year+1), '-01-01')
   AND c.originalActivationDate < c.cancellationDate
   AND c.originalActivationDate IS NOT NULL
   AND c.resellerId = in_resellerId
   AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
 GROUP BY 1 HAVING DATEDIFF( c.cancellationDate,c.originalActivationDate ) > 7;
 
SELECT COUNT(*) INTO v_Cancellations FROM tmp_Cancellations;

SELECT COUNT(*)
INTO v_decPrev
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT((in_year-1), '-11-31') AND CONCAT(in_year, '-01-01')
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_jan
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT(in_year, '-02-01')
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_feb
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-01-31') AND CONCAT(in_year, '-03-01')
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_march
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-02-31') AND CONCAT(in_year, '-04-01')
  AND resellerId = in_resellerId;    

SELECT COUNT(*)
INTO v_april
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-03-31') AND CONCAT(in_year, '-05-01')
  AND resellerId = in_resellerId;    

SELECT COUNT(*)
INTO v_may
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-04-31') AND CONCAT(in_year, '-06-01')
  AND resellerId = in_resellerId;   

SELECT COUNT(*)
INTO v_june
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-05-31') AND CONCAT(in_year, '-07-01')
  AND resellerId = in_resellerId;     
  
SELECT COUNT(*)
INTO v_july
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-06-31') AND CONCAT(in_year, '-08-01')
  AND resellerId = in_resellerId;

SELECT COUNT(*)
INTO v_aug
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-07-31') AND CONCAT(in_year, '-09-01')
  AND resellerId = in_resellerId;
     
SELECT COUNT(*)
INTO v_sept
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-09-31') AND CONCAT(in_year, '-10-01')
   AND resellerId = in_resellerId;
   
SELECT COUNT(*)
INTO v_oct
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-10-31') AND CONCAT(in_year, '-11-01')
  AND resellerId = in_resellerId;
  
SELECT COUNT(*)
INTO v_nov
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-11-31') AND CONCAT(in_year, '-12-01')
  AND resellerId = in_resellerId;
       
SELECT COUNT(*)
INTO v_dec
  FROM activeCustomer_view c
 WHERE c.originalActivationDate BETWEEN CONCAT(in_year, '-11-31') AND CONCAT((in_year+1), '-01-01')
  AND resellerId = in_resellerId;

SELECT v_CustomerTotalPrev AS "Growth From Last Year",
       (v_CustomerTotal - v_CustomerTotalPrev) AS "Last Years Customer Base",
       v_CustomerTotal AS "This Years Customer Base To Date",
       ( v_jan + v_feb + v_march + v_april + v_may + v_june + v_july + v_aug + v_sept + v_oct + v_nov + v_dec) AS "This Years Growth",
       v_CancellationsPrev AS "Last Year\'s Cancellations",
       v_Cancellations AS "This Year\'s Cancellations";
       
END
