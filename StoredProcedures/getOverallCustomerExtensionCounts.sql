CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverallCustomerExtensionCounts`(in_customerId INT, in_year INT)
BEGIN


DECLARE v_stdPrev,
        v_std,
        v_cloudPrev,
        v_cloud,
        v_sipPrev,
        v_sip INT;


SELECT COUNT(e.extensionId)
  INTO v_stdPrev
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
   AND c.originalActivationDate < CONCAT(in_year, '-01-01')
   AND c.customerId = in_customerId;
   

SELECT COUNT(e.extensionId)
  INTO v_std
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
  INTO v_cloudPrev
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
   AND c.originalActivationDate < CONCAT(in_year, '-01-01')
AND c.customerId = in_customerId;   

SELECT COUNT(e.extensionId)
  INTO v_cloud
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
  INTO v_sipPrev
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 AND c.companyName NOT LIKE '%test%'
   AND c.companyName NOT LIKE '%demo%'
   AND r.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%demo%'
 AND c.originalActivationDate < CONCAT(in_year, '-01-01')
AND c.customerId = in_customerId;
 
SELECT COUNT(b.branchId)
  INTO v_sip
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

 SELECT 'Previous',v_stdPrev,v_cloudPrev,v_sipPrev
 UNION
 SELECT 'Current',v_std,v_cloud,v_sip;
 
 END
