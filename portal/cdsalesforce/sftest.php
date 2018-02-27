<?php

//define("USERNAME", "cschmidt@coredial.com.test");
//define("PASSWORD", "Grace9785!");
//define("SECURITY_TOKEN", "LCGHokLGNhbD1IzTV7DMMKE7");  //"98U9HLBLiZuJ8iA4epRq0bQk");

define("USERNAME","portalaccess@coredial.com");
define("PASSWORD", "CoreDial0987");
define("SECURITY_TOKEN", "1T0CcHDnfUo8DtmpocPuMju9");

require_once ('Force/soapclient/SforceEnterpriseClient.php');

$mySforceConnection = new SforceEnterpriseClient();
$mySforceConnection->createConnection("sfapi.wsdl.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

$query = "SELECT FirstName, 
                 LastName
            FROM Contact";

$response = $mySforceConnection->query($query);

echo "Results of query '$query'<br/><br/>\n";

foreach ($response->records as $record) {
         
          echo "<ol>". 
                  "<li>".$record->FirstName . " " . $record->LastName ."</li>".
               "</ol>".
               "<br/>\n";
        
}

?>
