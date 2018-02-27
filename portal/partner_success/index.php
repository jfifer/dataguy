<?php require('header.php'); ?>
<?php require_once("../php/dbconn.php"); ?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>

        </ul>
    </div>
    <div class="row">
    <div class="box col-md-12 col-lg-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Service Providers</h2>
        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <div class="alert alert-info">Having issues finding data that you need? <a href="../request_data.php" >Contact Admin</a></div>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
       <th>SP Name</th>
       <th>Phone</th>
       <th>Address</th>
       <th>Extensions</th>
       <th>Customers</th>
       <th>Status</th>
       <th>Action</th>
    </tr>
    </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

//$sql='CALL getServiceProviders();';

$sql1='SELECT *
         FROM tmp_sp
        WHERE v_companyName NOT LIKE "%demo%"
          AND v_companyName NOT LIKE "%test%"
          AND v_companyName NOT LIKE "%Test%"
          AND v_companyName NOT LIKE "%demo%"
          AND v_extCount !=0';

if ( $result=mysqli_query($conn,$sql1) ) {

  while ( $row=mysqli_fetch_assoc($result) ) {

    $resellerId = $row['v_resellerId'];
    $companyName = $row['v_companyName'];
    $phoneNum = $row['v_phoneNum'];
    $address = $row['v_address'];
    $extCount = $row['v_extCount'];
    $customerCount = $row['v_customerCount'];

    echo
           "<td class='center'>".$companyName."</td>".
           "<td class='center'>".$phoneNum."</td>".
           "<td class='center'>".$address."</td>".
           "<td class='center'>".$extCount."</td>".
           "<td class='center'>".$customerCount."</td>".
           "<td class='center'><span class='label-success label label-default'>Active</span></td>".
           "<td class='center'>".
            "<a class='btn btn-info' href='#'>".
                "<i class='glyphicon glyphicon-view icon-white'></i>View".
            "</a>".
          "</td>".
         "</tr>";

          }
}
mysqli_close($conn);
?>

    </tbody>
    </table>
    </div>
  </div>
</div>
    <!--/span-->


</div>
<?php require('footer.php'); ?>


<!-- Save

      // "<a class='btn btn-danger' href='#'>".
      //           "<i class='glyphicon glyphicon-trash icon-white'></i>".
      //           Delete.
      //       "</a>".

 -->