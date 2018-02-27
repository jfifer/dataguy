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

END
