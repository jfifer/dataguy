<?php require_once("php/dbconn.php"); ?>


<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getTop10Sp()';

if ( $result=mysqli_query($conn,$sql) ) {

    $arrayData = array();

    while ( $row=mysqli_fetch_array($result) ) {

     $arrayData[] = array(
                  "sp" => $row["r_companyName"],
                  "customers" => $row["customerCount"],
                  "overall" => $row["percentage"]
                );
    }

    $jsonEncodedData = json_encode($arrayData);

}

mysqli_close($conn);
    
?> 
       

        <script>
             

             var cleanData = <?php echo $jsonEncodedData; ?>;


             AmCharts.makeChart("top10", {
                type: "serial",
                dataProvider: cleanData ,
                categoryField: "sp",
                startDuration: 1,
                rotate: true,

                categoryAxis: {
                    gridPosition: "start"
                },
                valueAxes: [{
                    logarithmic: true,
                    position: "top",
                    //title: "",
                    minorGridEnabled: false
                }],
                graphs: [{
                    type: "column",
                    title: "Customers",
                    valueField: "customers",
                    lineColor: "blue",
                    fillAlphas:1,
                    balloonText: "<span style='font-size:13px;'>[[title]] in  [[category]]:<b>[[value]]</b></span>"
                }, {
                    type: "line",
                    title: "Overall %",
                    valueField: "overall",
                    lineThickness: 2,
                    bullet: "round",
                    balloonText: "<span style='font-size:13px;'>[[title]]    [[category]]:<b>[[value]]</b></span>"
                }],
                legend: {
                    useGraphSettings: true
                },

                creditsPosition:"top-right"
                
                

            });


        </script>

        <div id="top10" style="width: 500px; height: 600px;"></div>



