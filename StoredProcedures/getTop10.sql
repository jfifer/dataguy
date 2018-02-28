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
   
END
