CREATE DEFINER=`root`@`%` PROCEDURE `createActiveCustomerView`()
BEGIN

DROP TABLE IF EXISTS activeCustomer_view;
CREATE TABLE activeCustomer_view(
activeCustomer_id SERIAL,
customerId INT(11),
resellerId INT(11),
accountId INT(11),
companyName VARCHAR(255),
email VARCHAR(255),
billingAddressId INT(11),
anniversaryDate INT(11),
statusId INT(11),
originalActivationDate DATETIME,
cancellationDate DATETIME,
hostedFaxEnabled TINYINT(4),
timezone VARCHAR(255),
referring_organization_id BIGINT(20)
) ENGINE=MEMORY;

ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_customerId_idx (customerId);
ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_resellerId_idx (resellerId);
ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_statusId_idx (statusId);
ALTER TABLE activeCustomer_view ADD INDEX activeCustomerView_companyName_idx (companyName);

INSERT INTO activeCustomer_view 
(
customerId,
resellerId,
accountId,
companyName,
email,
billingAddressId,
anniversaryDate,
statusId,
originalActivationDate,
cancellationDate,
hostedFaxEnabled,
timezone,
referring_organization_id
)
SELECT 
customerId,
resellerId,
accountId,
companyName,
email,
billingAddressId,
anniversaryDate,
statusId,
originalActivationDate,
cancellationDate,
hostedFaxEnabled,
timezone,
referring_organization_id
 FROM customer
WHERE statusId NOT IN (2,3)
  AND companyName NOT LIKE '%test%'
  AND companyName NOT LIKE '%demo%'
  AND companyName NOT LIKE '%Test%'
  AND companyName NOT LIKE '%Demo%';

END
