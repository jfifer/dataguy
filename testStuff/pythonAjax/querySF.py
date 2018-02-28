from simple_salesforce import Salesforce
import json

sf = Salesforce(username='mmarshall@coredial.com', password='10Bra1d3n12!@', security_token='98U9HLBLiZuJ8iA4epRq0bQk')

# sf.Contact.create({'LastName':'LongLegger','FirstName': 'Daddy','Email':'testEmail@test.com'})

row0 = sf.query("SELECT Id, Email FROM Contact WHERE LastName = 'LongLegger'")
print row0
print '\n'

row1 = sf.query_all("SELECT Id, FirstName,LastName, Email FROM Contact WHERE LastName ='LongLegger'")
print row1
print '\n'

row2 = sf.search("FIND {LongLegger}")
print row2


print "Accounts"
row3 = sf.query("SELECT Id, type FROM Account")

cleanup = json.dumps(row3)
print cleanup
