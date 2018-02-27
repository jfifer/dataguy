CREATE DEFINER=`root`@`localhost` PROCEDURE `jta`(in_resellerId INT, in_year INT)
BEGIN

DECLARE jan,feb,march,april,may,june,july,aug,sept,oct,nov,december DECIMAL(10,2);

 SELECT SUM(i.total) as "value"
   INTO jan
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT((in_year-1), '-12-31') AND CONCAT(in_year, '-02-01')
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO feb
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-01-31') AND CONCAT(in_year, '-03-01')
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO march
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-02-31') AND CONCAT(in_year, '-04-01')
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO april
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-03-31') AND CONCAT(in_year, '-05-01')
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO may
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-04-31') AND CONCAT(in_year, '-06-01')
    AND resellerId = in_resellerId;
    
 
 SELECT SUM(i.total) as "value"
   INTO june
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-05-31') AND CONCAT(in_year, '-07-01')
    AND resellerId = in_resellerId;   
    
 
 SELECT SUM(i.total) as "value"
   INTO july
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-06-31') AND CONCAT(in_year, '-08-01')
    AND resellerId = in_resellerId;                       

 
 SELECT SUM(i.total) as "value"
   INTO aug
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-07-31') AND CONCAT(in_year, '-09-01')
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO sept
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-08-31') AND CONCAT(in_year, '-10-01')
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO oct
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-09-31') AND CONCAT(in_year, '-11-01')
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO nov
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-10-31') AND CONCAT(in_year, '-12-01')
    AND resellerId = in_resellerId;  

 
 SELECT SUM(i.total) as "value"
   INTO december
   FROM invoice i
  WHERE billingStartDate BETWEEN CONCAT(in_year, '-11-31') AND CONCAT((in_year+1), '-01-01')
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

END
