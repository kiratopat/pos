<?php
include "./db/condb.php";
$sql = "SELECT SUM(total) as y, CONCAT(`customer`.`fname`, ' ', `customer`.`lname`) AS name
FROM Receipt
INNER JOIN `customer` ON `receipt`.`customer_id`=`customer`.`customer_id`
GROUP BY `receipt`.`customer_id`;
";
$result = $condb->query($sql);
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
mysqli_close($condb);
?>

<!DOCTYPE html>
<html lang="en">

<?php include "./component/head_with_auth.php" ?>

<body>
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <?php include "./component/navbar.php" ?>
    <?php include "./component/sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div id="container" style="width:100%; height:400px;"></div>


        <script>
            let receipt_data = JSON.parse(`<?= json_encode($rows) ?>`);
            // for each data turn y to float data type
            receipt_data.forEach((data) => {
                data.y = parseFloat(data.y);
            });

            console.log(receipt_data);

            // for each data turn to this format
            // {
            //     name: 'Chrome',
            //     y: 70.67,
            //     sliced: true,
            //     selected: true
            // }

            document.addEventListener('DOMContentLoaded', function() {
                const chart = Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Browser income shares from Receipt',
                        align: 'left'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                        }
                    },
                    series: [{
                        name: 'Customer income share',
                        colorByPoint: true,
                        data: receipt_data
                    }]
                    // [{
                    //     name: 'Customer income share',
                    //     colorByPoint: true,
                    //     data: [{
                    //         name: 'Chrome',
                    //         y: 70.67,
                    //         sliced: true,
                    //         selected: true
                    //     }, {
                    //         name: 'Edge',
                    //         y: 14.77
                    //     }, {
                    //         name: 'Firefox',
                    //         y: 4.86
                    //     }, {
                    //         name: 'Safari',
                    //         y: 2.63
                    //     }, {
                    //         name: 'Internet Explorer',
                    //         y: 1.53
                    //     }, {
                    //         name: 'Opera',
                    //         y: 1.40
                    //     }, {
                    //         name: 'Sogou Explorer',
                    //         y: 0.84
                    //     }, {
                    //         name: 'QQ',
                    //         y: 0.51
                    //     }, {
                    //         name: 'Other',
                    //         y: 2.6
                    //     }]
                    // }]
                });
            });
        </script>

        <?php include "./component/footer.php" ?>

</body>

</html>