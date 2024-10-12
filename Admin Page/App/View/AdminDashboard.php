<?php
$title = "Dashboard | SEDP HRMS";
$page = "admindashboard";
include('../../Core/Includes/header.php');
include('../../../Database/db.php');
?>
<div class="wrapper">
    <?php
    include_once('../../Core/Includes/sidebar.php');
    ?>

    <div class="main overflow-y-scroll">
        <!--headers-->
        <?php
        include('../../Core/Includes/navBar.php');
        ?>
        <!--Cards-->
        <div class="section" id="dashboard-content">
            <div class="container-fluid">

                <div class="row mb-3">
                    <!--Employee Card-->
                    <?php
                    include('../Dashboard/EmployeeCard.php');
                    ?>

                    <!--Scholar Card-->
                    <?php
                    include('../Dashboard/ScholarCard.php');
                    ?>

                    <!--Job Applicant Card-->
                    <?php
                    include('../Dashboard/JobApplicantCard.php');
                    ?>

                    <!--Scholar Applicant Card-->
                    <?php
                    include('../Dashboard/ScholarApplicantCard.php');
                    ?>

                </div>
            </div>

            <!--Donut-->
            <div class="section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3 overflow-hidden shadow-lg " style="border-radius: 5px;">
                            <div id="donutchart" style="width: 680px; height: 360px;"></div>
                        </div>
                        <?php
                        include('../Dashboard/chart.php');
                        ?>
                    </div>
                </div>
            </div>

            <!--Applicant Cards-->
            <section>
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        include '../Dashboard/Anouncement.php';
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3 mt-2">
                            <div class="card border-0 shadow">
                                <div class="card-body">
                                    <h6 class="card-title ms-2" style="font-weight: bold;">Upcoming Interview</h6>
                                    <ul class="list-group list-group-flush">
                                        <!-- First Interview -->
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted ms-4">09/06/24 - 9:30 am</small>
                                            </div>
                                            <div class="d-flex align-items-center flex-grow-1 ms-5">
                                                <img src="../../Public/Assets/Images/profile.jpg" alt="Applicant Photo" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                                <div>
                                                    <strong class="d-block text-truncate" style="max-width: 150px;">Juasssssssn Tamad</strong>
                                                    <small class="text-muted">Job applicant</small>
                                                </div>
                                            </div>
                                            <div>
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </li>
                                        <!-- Second Interview -->
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted ms-4">09/06/24 - 3:30 pm</small>
                                            </div>
                                            <div class="d-flex align-items-center flex-grow-1 ms-5">
                                                <img src="../../Public/Assets/Images/profile.jpg" alt="Applicant Photo" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                                <div>
                                                    <strong class="d-block text-truncate" style="max-width: 150px;">Sarah Cruz</strong>
                                                    <small class="text-muted">Job applicant</small>
                                                </div>
                                            </div>
                                            <div>
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="mt-2 text-end">
                                        <a href="#" class="text-primary">view more.</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!---->


        </div>
    </div>

    <style>
        #dashboard-content {
            max-height: 650px;
            /* Set the maximum height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }
    </style>
    <?php
    include('../../../Database/db.php');

    // Query to fetch the number of job applicants
    $sql_job = "SELECT COUNT(*) AS job_count FROM applicants";
    $result_job = $connection->query($sql_job);
    $job_row = $result_job->fetch_assoc();
    $job_count = $job_row['job_count'];

    // Query to fetch the number of scholar applicants
    $sql_scholar = "SELECT COUNT(*) AS scholar_count FROM scholar_applicant";
    $result_scholar = $connection->query($sql_scholar);
    $scholar_row = $result_scholar->fetch_assoc();
    $scholar_count = $scholar_row['scholar_count'];

    // Close the database connection
    $connection->close();
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Job Applicants', 11],
                ['Scholar Applicant', 9],
                ['Interviews', 2],
                ['Compliance', 2],
            ]);

            var options = {
                title: 'Reports',
                pieHole: 0.5,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../../Public/Assets/Js/AdminPage.js"></script>
    <script src="../../Public/Assets/JssideBarScript.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    </body>

    </html>