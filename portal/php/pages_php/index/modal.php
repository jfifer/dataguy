<?php
echo '
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Recent Changes</h4>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Refreshed the Bi_new DB with recent data, made some query adjustments.</li>
                    <li>
                        <a href="reports/resellers/all_service_provider.php">(2015-12-2) Customer Drillin: Invoices By Month</a><br>
                        <p>You will need to drill into a Service Provider > Production Services > Choose A Customer</p>
                    </li>
                    <li>
                        <a href="reports/infrastructure/incidents.php">(2015-12-4) Incidents Landing.</a><br>
                        <p>You can get there in Reports > Infrastructure > Incidents <br>Or<br> on the Home Page As seen here:<br>
                           <img src="img/incidentsNav.png" width="100%" height="15%" alt="Oops! No Image.">
                        </p>
                    </li>
                    <li>
                        <p>(2015-12-10) Sanitized Service Providers, removes "test" and "demo" accounts.</p>
                    </li>
                    <li>
                        <a href="reports/customers/all_customer.php">(2015-12-18) Customer Trusted Network Field Added To Customer Overview</a><br>
                    </li>
                    <li>
                        <a href="reports/resellers/all_service_provider.php">(2015-12-18) Service Provider Level / Tier Break Down </a><br>
                          <p>Note: The drillin on each metric is currently unavailable.</p>
                    </li>
                                       <li>System Improvements: <br>Tuned MySQL for higher throughput, you will notice quicker page response times.<br>
                         This is an ongoing task to improve the delivery of these reports and metrics. If you come across a specific page that seems sluggish, please report it.
                    </li>

                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>';
