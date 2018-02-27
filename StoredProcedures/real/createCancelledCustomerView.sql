CREATE DEFINER=``@`` PROCEDURE `createCancelledCustomerView`()
BEGIN

DROP TABLE IF EXISTS cancelledCustomer_view;
CREATE TABLE cancelledCustomer_view(
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

ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_customerId_idx (customerId);
ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_resellerId_idx (resellerId);
ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_statusId_idx (statusId);
ALTER TABLE cancelledCustomer_view ADD INDEX cancelledCustomerView_companyName_idx (companyName);

INSERT INTO cancelledCustomer_view 
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
WHERE companyName NOT LIKE '%test%'
  AND companyName NOT LIKE '%demo%'
  AND companyName NOT LIKE '%Test%'
  AND companyName NOT LIKE '%Demo%'
GROUP BY 1 HAVING DATEDIFF( cancellationDate,originalActivationDate ) > 7;

END
