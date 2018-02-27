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

END
