<?php require_once("../php/dbconn.php"); ?>
<?php require('header.php'); ?>
<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$count='select count(*) FROM reseller';

if ($result=mysqli_query($conn,$count) ) {

while ($row=mysqli_fetch_row($result)) {
   $arrayData[] = $row;
}
$cleanData = json_encode($arrayData,JSON_NUMERIC_CHECK);
}
mysqli_close($conn);
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="jeopardy.php">Jeopardy Accounts Overview</a>
        </li>
    </ul>
</div>

<!-- <div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="6 new members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Members</div>
            <div><?php //echo $cleanData; ?></div>
            <span class="notification">6</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="4 new pro members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Pro Members</div>
            <div>[]</div>
            <span class="notification green">4</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="Metric" class="well top-block" href="#">
            <i class="glyphicon glyphicon-shopping-cart yellow"></i>

            <div>Metric</div>
            <div>[]</div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
            <i class="glyphicon glyphicon-envelope red"></i>

            <div>Messages</div>
            <div>[]</div>
        </a>
    </div>
</div> -->

<!-- Collapse One -->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Overview</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-12 col-md-12">
                   <div class="alert alert-info">Having issues finding data that you need? <a href="../request_data.php" >Contact Admin</a>


                   </div>
                   <a class='btn btn-info' href='jeopardy_add.php'><i class='glyphicon glyphicon-edit icon-white'></i> Add Entry</a><br><br>
            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
            <tr>
               <th>SP Name</th>
               <th>Contract Level</th>
               <th>PSA</th>
               <th>Phase II Start</th>
               <th>90 Day Review</th>
               <th>120 Day Review</th>
               <th>Gap Categories</th>
               <th>Remedy Categories</th>
               <th>Notes</th>
               <th>Next Action</th>
               <th>Next Scheduled Call</th>
               <th>Action</th>
            </tr>
            </thead>
            <tbody>

        <?php
        $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

        $sql1='SELECT resellerName,
                      contract_level,
                      psa,
                      phase_two_begin,
                      ninety_day_review,
                      onetwenty_day_review,
                      gap_cat,
                      rem_cat,
                      notes,
                      next_action,
                      next_call
                 FROM jeopardy_accts';

        if ( $result=mysqli_query($conn,$sql1) ) {

          while ( $row=mysqli_fetch_assoc($result) ) {

            $resellerName = $row['resellerName'];
            $contract_level = $row['contract_level'];
            $psa = $row['psa'];
            $phase_two_begin = $row['phase_two_begin'];
            $ninety_day_review = $row['ninety_day_review'];
            $onetwenty_day_review = $row['onetwenty_day_review'];
            $gap_cat = $row['gap_cat'];
            $rem_cat = $row['rem_cat'];
            $notes = $row['notes'];
            $next_action = $row['next_action'];
            $next_call = $row['next_call'];

            echo
                   "<td class='center'>".$resellerName."</td>".
                   "<td class='center'>".$contract_level."</td>".
                   "<td class='center'>".$psa."</td>".
                   "<td class='center'>".$phase_two_begin."</td>".
                   "<td class='center'>".$ninety_day_review."</td>".
                   "<td class='center'>".$onetwenty_day_review."</td>".
                   "<td class='center'>".$gap_cat."</td>".
                   "<td class='center'>".$rem_cat."</td>".
                   "<td class='center'>".$notes."</td>".
                   "<td class='center'>".$next_action."</td>".
                   "<td class='center'>".$next_call."</td>".
                   "<td class='center'>".
                    "<a class='btn btn-info' href='jeopardy_edit.php?".$resellerName."'>".
                        "<i class='glyphicon glyphicon-edit icon-white'></i> Edit".
                    "</a><br><br>".
                    "<a class='btn btn-danger' href='jeopardy_delete.php?".$resellerName."'>".
                        "<i class='glyphicon glyphicon-view icon-white'></i>Delete".
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
   <div class="box-content row">
        <div class="col-lg-6 col-md-6">
         <label>Gap Category Legend:</label>
            <table class="table table-striped table-bordered">
            <thead>
            <tr>
               <th>Code</th>
               <th>Description</th>
            </tr>
            </thead>
            <tbody>

        <?php
        $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

        $sql1='SELECT code,
                      description
                 FROM gap_cat';

        if ( $result=mysqli_query($conn,$sql1) ) {

          while ( $row=mysqli_fetch_assoc($result) ) {

            $gap_code = $row['code'];
            $gap_desc = $row['description'];
           echo
                   "<td class='center'>".$gap_code."</td>".
                   "<td class='center'>".$gap_desc."</td>".
                   "</td>".
                   "</tr>";

                  }
        }
        mysqli_close($conn);
        ?>

        </tbody>
        </table>
        </div>
          <div class="col-lg-6 col-md-6">
            <label>Remedy Category Legend:</label>
            <table class="table table-striped table-bordered">
            <thead>
            <tr>
               <th>Code</th>
               <th>Description</th>
            </tr>
            </thead>
            <tbody>

        <?php
        $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

        $sql1='SELECT code,
                      description
                 FROM rem_cat';

        if ( $result=mysqli_query($conn,$sql1) ) {

          while ( $row=mysqli_fetch_assoc($result) ) {

            $code1 = $row['code'];
            $desc1 = $row['description'];
           echo
                   "<td class='center'>".$code1."</td>".
                   "<td class='center'>".$desc1."</td>".
                   "</td>".
                   "</tr>";

                  }
        }
        mysqli_close($conn);
        ?>

        </tbody>
        </table>
          </div>
        </div>    <!-- BOX CONTENT END 2 -->
      </div>
    </div>
  </div>
</div> <!-- END Customer Overview -->

<!--
<div class="row">
    <div class="box col-md-4">
        <div class="box-inner homepage-box">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th"></i> 1</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#info">Info</a></li>
                    <li><a href="#custom">Custom</a></li>
                    <li><a href="#messages">Messages</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="info">
                        <h3>Text
                            <small> feature here</small>
                        </h3>
                        <p>text</p>


                    </div>
                    <div class="tab-pane" id="custom">
                        <h3>Custom
                            <small>small text</small>
                        </h3>


                        <p>text</p>
                    </div>
                    <div class="tab-pane" id="messages">
                        <h3>Messages
                            <small>small text</small>
                        </h3>


                        <p>text.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Member Activity</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">

                </div>
            </div>
        </div>
    </div>

    <div class="box col-md-4">
        <div class="box-inner homepage-box">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> 2</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">

            </div>
        </div>
    </div>

</div>
  <div class="row">
  </div> -->
</div>
<?php require('footer.php'); ?>
