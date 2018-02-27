<?php require_once("../../php/dbconn.php"); ?>
<?php require_once("../../php/pages_php/index/session.php"); ?>

<link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">
<script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
<script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>

<script>

$(document).ready(function() {
    $('#table1').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );

</script>

<?php

$count="SELECT COUNT(*) FROM reseller";

if ($result=mysqli_query($conn,$count) ) {

  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

<h3 style="color:red;">UNDER CONSTRUCTION</h3>
  
  <h2>Service Providers <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*CoreDial Service Providers</p><small>Row Count: <?php echo $row_cnt; ?></small>           
  
  <div style="overflow: auto;">
  
  <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>SP Id</th>
        <th>SP Name</th>
        <th>Tier</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Extensions</th>
        <th>Customers</th>        
      </tr>
    </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

//$sql='CALL getServiceProviders();';

$sql1='SELECT * FROM tmp_sp;';

if ( $result=mysqli_query($conn,$sql1) ) {

  while ($row=mysqli_fetch_assoc($result)) {
    
    //TODO: Clean / Trim / Set
    $resellerId = $row['v_resellerId'];
    $companyName = $row['v_companyName'];
    $tier = $row['v_tier'];
    $phoneNum = $row['v_phoneNum'];
    $address = $row['v_address'];
    $extCount = $row['v_extCount'];
    $customerCount = $row['v_customerCount'];
     
    echo "<tr>".
           "<td>".$resellerId."</td>".
           "<td>".$companyName."</td>".
           "<td>".$tier."</td>".
           "<td>".$phoneNum."</td>".
           "<td>".$address."</td>".
           "<td>".$extCount."</td>".
           "<td>".$customerCount."</td>"."      
         </tr>
         ";
  }
}

mysqli_close($conn);
    
?>
</tbody>
</table>
</div>
