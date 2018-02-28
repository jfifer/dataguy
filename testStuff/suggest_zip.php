<?php
require_once("../portal/php/dbconn.php");

    $reseller = $_REQUEST['term'];

    $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
    $resellers = "SELECT companyName
                      FROM reseller
                     WHERE companyName LIKE '%".$reseller."%'";
    $data = array();
    if ($result = mysqli_query($conn, $resellers)) {

        while ($resellerName = mysqli_fetch_array($result)) {

            $data[] = array(
                'label' => $resellerName['companyName'],
                'value' => $resellerName['companyName']
            );

            echo json_encode($data);
            flush();

        }
    }

?>

<?php
//
//if ( !isset($_REQUEST['term']) )
//    exit;
//
//$dblink = mysql_connect('server', 'username', 'password') or die( mysql_error() );
//mysql_select_db('database_name');
//
//$rs = mysql_query('select zip, city, state from zipcode where zip like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by zip asc limit 0,10', $dblink);
//
//$data = array();
//if ( $rs && mysql_num_rows($rs) )
//{
//    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
//    {
//        $data[] = array(
//            'label' => $row['zip'] .', '. $row['city'] .' '. $row['state'] ,
//            'value' => $row['zip']
//        );
//    }
//}
//
//echo json_encode($data);
//flush();
//


?>