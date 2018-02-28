CREATE DEFINER=`root`@`%` PROCEDURE `getCustomerList`()
BEGIN

DROP TABLE IF EXISTS customerList_view;
CREATE TABLE customerList_view AS
SELECT DISTINCT c.customerId,
             c.companyName,
             a.state,
             CAST(c.originalActivationDate AS DATE) originalActivationDate,
             co.contractLength,
             
             r.companyName "reseller",
             CASE n.enabled
               WHEN 1 THEN "ENABLED"
               WHEN 0 THEN "NOT ENABLED"
             ELSE
              "NOT CONFIGURED"
             END AS "trust",
             s.hostname
        FROM reseller r
        JOIN customer c USING (resellerId)
        JOIN branch b ON (c.customerId = b.customerId)
        LEFT JOIN server s ON (b.featureServerId=s.serverId)
        JOIN contract co ON (c.customerId = co.customerId)
        LEFT JOIN network n USING (branchId)
        JOIN address a ON (a.addressId = c.billingAddressId)
       WHERE c.statusId NOT IN (2,3)
         AND c.companyName NOT LIKE "%demo%"
         AND c.companyName NOT LIKE "%test%"
         AND r.companyName NOT LIKE "%demo%"
         AND r.companyName NOT LIKE "%test%"
         AND co.retiredDate IS NOT NULL;


ALTER TABLE customerList_view ADD INDEX customerList_customerId_idx (customerId);
ALTER TABLE customerList_view ADD INDEX customerList_origActDate_idx (originalActivationDate);
ALTER TABLE customerList_view ADD INDEX customerList_contractLength_idx (contractLength);
ALTER TABLE customerList_view ADD INDEX customerList_hostname_idx (hostname);

END
