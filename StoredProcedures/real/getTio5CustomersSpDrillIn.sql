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
  
  

END
