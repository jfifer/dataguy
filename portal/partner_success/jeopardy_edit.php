<?php require_once("../php/dbconn.php"); ?>
<?php require('header.php'); ?>
<?php
     $sp = $_SERVER['QUERY_STRING'];
     $clean = urldecode($sp);

?>
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
                 FROM jeopardy_accts
                WHERE resellerName="'.$clean.'"';

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
          }
        }
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="jeopardy.php">Jeopardy Accounts</a>
        </li>
        <li>
            <a href="jeopardy_edit.php">Jeopardy Accounts Edit</a>
        </li>
    </ul>
</div>

<form id="editForm" action="jeopardy_update.php" method="POST">
  <fieldset class="form-group">
    <label for="sp">Service Provider: </label>
    <input name="resellerName" type="text" class="form-control" id="sp" value="<?php echo $resellerName ?>">
    <small class="text-muted">*Service Provider name is req</small>
  </fieldset>
  <fieldset class="form-group">
    <label for="exampleSelect1">Contract Level</label>
    <select name="cert" class="form-control" id="exampleSelect1">
      <option value="certified">Certified</option>
      <option value="notCertified">Not Certified</option>
      <option value="noOption">N/A</option>
    </select>
  </fieldset>

  <fieldset class="form-group">
    <label for="psa">PSA</label>
    <input name="psa" type="text" class="form-control" id="psa" value="<?php echo $psa ?>">
  </fieldset>

  <fieldset class="form-group">
    <label for="phasetwo">Phase II Start</label>
    <input name="phase2" type="text" class="form-control" id="phasetwo" value="<?php echo $phase_two_begin ?>">
    <small class="text-muted">*YYYY/MM/DD</small>
  </fieldset>

  <fieldset class="form-group">
    <label for="ninety">90 Day Review</label>
    <input name="ninetyDay" type="text" class="form-control" id="ninety" value="<?php echo $ninety_day_review ?>">
    <small class="text-muted">*YYYY/MM/DD</small>
  </fieldset>

   <fieldset class="form-group">
    <label for="onetwenty">120 Day Review</label>
    <input name="oneTwenty" type="text" class="form-control" id="onetwenty" value="<?php echo $onetwenty_day_review ?>">
    <small class="text-muted">*YYYY/MM/DD</small>
  </fieldset>

  <fieldset class="form-group">
    <label for="gap">GAP Categories</label>
    <textarea name="gapCat" class="form-control" id="gap" rows="1"><?php echo $gap_cat ?></textarea>
    <small class="text-muted">*See Legend</small>
   </fieldset>

  <fieldset class="form-group">
    <label for="rem">Remedy Categories</label>
    <textarea name="remCat" class="form-control" id="rem" rows="1"><?php echo $rem_cat ?></textarea>
    <small class="text-muted">*See Legend</small>
  </fieldset>

  <fieldset class="form-group">
    <label for="notation">Notes</label>
    <textarea name="notes" class="form-control" id="notation" rows="3"><?php echo $notes ?></textarea>
  </fieldset>

  <fieldset class="form-group">
    <label for="naction">Next Action</label>
    <textarea name="nextAction" class="form-control" id="naction" rows="3"><?php echo $next_action ?></textarea>
  </fieldset>

  <fieldset class="form-group">
    <label for="ncall">Next Scheduled Call</label>
    <input name="nextCall" type="text" class="form-control" id="ncall" value="<?php echo $next_call ?>">
    <small class="text-muted">*YYYY/MM/DD</small>
  </fieldset>

  <button type="submit" class="btn btn-primary">Update</button>
  <button class="btn btn-danger"><a href="jeopardy.php">Cancel</a></button>

</form>

<!-- Category Legends -->

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Category Legends</h2>

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
<!-- END Customer Overview -->

<?php require('footer.php'); ?>
