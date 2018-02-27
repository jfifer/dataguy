CREATE DEFINER=`root`@`localhost` PROCEDURE `get_api_tokens`()
BEGIN

  DECLARE _done_ BOOLEAN DEFAULT FALSE;
  DECLARE customer_id INT;

  DECLARE customers CURSOR FOR
             SELECT DISTINCT(aac.customerId)
               FROM apiApplicationCustomer aac
               LEFT JOIN customer c ON (aac.customerId=c.customerId)
               LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
              WHERE aac.status=1
                AND c.statusId=1
                AND aac.apiApplicationId NOT IN (1, 5, 11);
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET _done_ = TRUE;

  DROP TABLE IF EXISTS api_tokens_tmp;
  CREATE TABLE IF NOT EXISTS api_tokens_tmp (
         resellerId VARCHAR(255),
	 r_companyName VARCHAR(255),
	 c_companyName VARCHAR(255),
	 description VARCHAR(255),
	 extensionId VARCHAR(255),
	 extensionNumber VARCHAR(255),
	 callerId VARCHAR(255)
	 );

  OPEN customers;

  for_loop: LOOP
    FETCH customers INTO customer_id;

  IF _done_ THEN
    LEAVE for_loop;
  ELSE
    INSERT IGNORE INTO api_tokens_tmp 
    (
     resellerId,
     r_companyName,
     c_companyName,
     description,
     extensionId,
     extensionNumber,
     callerId
    )	
    
    SELECT r.resellerId Reseller_ID,
           r.companyName Reseller_Name,
           c.companyName Customer_Name,
           b.description PBX_Context,
           e.extensionId Extension_ID,
           e.extensionNumber Extension_Number,
           e.callerId Extension_Name
      FROM branch b
      LEFT JOIN customer c ON (b.customerId=c.customerId)
      LEFT JOIN extension e ON (b.branchId=e.branchId)
      LEFT JOIN reseller r ON (b.resellerId=r.resellerId)
     WHERE b.customerId=customer_id
       AND e.extensionTypeId=1;
  END IF;
  END LOOP;

  CLOSE customers;

  SELECT 'Reseller_ID',
         'Reseller_Name',
	 'Customer_Name',
	 'PBX_Context',
	 'Extension_ID',
	 'Extension_Number',
	 'Extension_Name'
  UNION ALL
  SELECT 
        resellerId Reseller_ID,
        r_companyName Reseller_Name,
        c_companyName Customer_Name,
        description PBX_Context,
        extensionId Extension_ID,
        extensionNumber Extension_Number,
        callerId Extension_Name
   FROM api_tokens_tmp

    INTO OUTFILE '/tmp/rsbilling_ApiTokens_January2018.csv'
    FIELDS  TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n';

END
