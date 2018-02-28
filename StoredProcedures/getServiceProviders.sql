CREATE DEFINER=`root`@`%` PROCEDURE `getServiceProviders`()
BEGIN

  DECLARE done INT DEFAULT FALSE;
  DECLARE v_resellerId, v_tier, v_extCount, v_customerCount INT(11);
  DECLARE v_companyName, v_phoneNum, v_address VARCHAR(200);
  DECLARE sp_cur CURSOR
  FOR SELECT r.resellerId,
             r.companyName,
             r.tier Tier,
             r.phone Phone,
             CONCAT(a.street1," ",a.street2," ",a.city," ",a.state," ",a.zipCode," ",a.country) AS "Address"
        FROM reseller r
        LEFT JOIN address a ON (r.addressId=a.addressId)
       WHERE r.companyName NOT LIKE '%test%'
         AND r.companyName NOT LIKE '%demo%';
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  
  DROP TABLE IF EXISTS tmp_sp;
      CREATE TABLE tmp_sp (
      v_resellerId INT(11),
      v_companyName VARCHAR(155),
      v_tier INT(11),
      v_phoneNum VARCHAR(100),
      v_address VARCHAR(155),
      v_extCount INT(7), 
      v_customerCount INT(7)
      );

  OPEN sp_cur;
    for_loop: LOOP
    
      FETCH sp_cur INTO v_resellerId, v_companyName, v_tier, v_phoneNum, v_address;
      
      IF (done) THEN
        LEAVE for_loop;
      END IF;
      
      
      

      SELECT COUNT(extensionId)
        INTO v_extCount
        FROM extension e
        LEFT JOIN branch b ON (e.branchId=b.branchId)
        LEFT JOIN customer c ON (b.customerId=c.customerId)
        LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
       WHERE c.statusId=1
         AND e.extensionTypeId=1
         AND e.isFreeExtension=0
         AND r.resellerId = v_resellerId;


      
      
      SELECT COUNT(customerId)
        INTO v_customerCount
        FROM customer 
       WHERE statusId NOT IN (2,3) 
         AND resellerId = v_resellerId;
        
     
      SELECT v_resellerId,v_companyName,v_tier,v_phoneNum,v_address,v_extCount, v_customerCount;
      INSERT INTO tmp_sp VALUES (v_resellerId,v_companyName,v_tier,v_phoneNum,v_address,v_extCount,v_customerCount);
      
    END LOOP;
    
    
    SELECT * FROM tmp_sp;  
END
