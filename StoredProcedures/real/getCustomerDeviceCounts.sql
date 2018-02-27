REATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDeviceCounts`(in_customerId INT)
BEGIN
DECLARE panasonicCount,grandstreamCount,astraCount,polyCount,otherCount INT;

SELECT COUNT(d.deviceId)
INTO polyCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%poly%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.customerId = in_customerId
                and c.statusId not in (2,3)
            )
           );

SELECT COUNT(d.deviceId)
INTO astraCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%astra%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.customerId = in_customerId 
                and c.statusId not in (2,3)
            )
           );
    
SELECT COUNT(d.deviceId)
INTO grandstreamCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%grand%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.customerId = in_customerId 
                and c.statusId not in (2,3)
            )
           );  
  
SELECT COUNT(d.deviceId)
INTO panasonicCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name LIKE '%panasonic%'
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.customerId = in_customerId 
                and c.statusId not in (2,3)
            )
           );   

 
SELECT COUNT(d.deviceId)
INTO otherCount
  FROM device d
  LEFT JOIN deviceManufacturer dman USING (deviceManufacturerId)
  WHERE dman.name NOT IN ('%panasonic%','%grand%','%astra%','%polycom%')
    AND d.deviceId 
    IN (
      select deviceId
       from device
      where branchId 
         in (
             select b.branchId 
               from branch b 
               join customer c using (customerId) 
              where c.customerId = in_customerId
                and c.statusId not in (2,3)
            )
           );

SELECT "Polycom" AS "device", polyCount AS "deviceCount"
UNION
SELECT "Panasonic",panasonicCount
UNION
SELECT "Grandstream", grandstreamCount
UNION
SELECT "Astra", astraCount 
UNION
SELECT "Other", otherCount;

END
