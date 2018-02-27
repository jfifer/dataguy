<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
// CALL getOverAllCustomerGrowthREPORT();

$getCounts='SELECT CustomerTotal2017,
                   CustomerTotal,
                   Cancellations2017,
                   Cancellations2018
              FROM customer_growth';

if ( $result=mysqli_query($conn,$getCounts) ) {

  while ($row=mysqli_fetch_array($result)) {

    $v1 = $row[0];
    $v2 = $row[1];
    $v3 = $row[2];
    $v4 = $row[3];

  }
} else {

  echo "Could Not Retrieve Customer Counts, See getOverAllCustomerGrowthREPORT()";
}

echo "
</div>
 <div class='row'>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-primary'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-comments fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v1."</div>
                          <div>2017 Customer Base</div>
                      </div>
                  </div>
              </div>
             <a href='customer_base_overview_2017.php'>".
             "<div class='panel-footer'>".
                      "<span class='pull-left'>View Details</span>".
                      "<span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>".
                      "<div class='clearfix'></div>".
                  "</div>".
              "</a>".

       "</div>
      </div>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-green'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-tasks fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v2."</div>".
                          "<div>2018 Customer Base</div>
                      </div>
                  </div>
              </div>
              <a href='customer_base_overview_2018.php'>".
                  "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-yellow'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-shopping-cart fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v3."</div>
                          <div>2017 Cancellations</div>
                      </div>
                  </div>
              </div>
              <a href='customer_cancellation_overview_2017.php'>".
                  "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-red'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-support fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v4."</div>
                          <div>2018 Cancellations</div>
                      </div>
                  </div>
              </div>
              <a href='customer_cancellation_overview_2018.php'>".
                  "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>
  </div>";

?>
