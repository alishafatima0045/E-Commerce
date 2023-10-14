<?php 
session_start();
if(!isset($_SESSION['admin_name'])){
    header('location:../login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Admin - Dashboard HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="mb-5" id="home">
        <?php include('Navbar.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b> <?php 
                        if(isset($_SESSION['admin_name'])){
                            echo $_SESSION['admin_name'];
                        }
                        ?> </b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row mb-5">
                
                <div class="col-12 tm-block-col mb-5">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll mb-5">
                        <h2 class="tm-block-title">Orders List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER_ID</th>
                                    <th scope="col">USER_NAME</th>
                                    <th scope="col">PRODUCT_PRICE</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('../connection.php');
                                $FetchCategory = mysqli_query($Con,"SELECT `users`.`User_Name`, `orders`.`product_name`,sum(`orders`.`product_qty`) as 'product_qty' 
                                FROM `users` 
                                    INNER JOIN `orders` ON `orders`.`User_Id` = `users`.`User_Id`
                                    group by product_name 
                                order by sum(product_qty) desc 
                                limit 10");
                                // COnvert Into Arrays
                                // $totalAmount = 0;
                                $Sno=1;
                                while($data = mysqli_fetch_assoc($FetchCategory)){
                                    //  $totalAmount += $data['product_price'];
                                ?>
                                <tr>
                                    <th scope="row"><b><?php echo $Sno++?></b></th>
                                    <td><b><?php echo $data['User_Name'] ?></b></td>
                                    <td><b><?php echo $data['product_qty'] ?></b></td>
                                    
                                    <?php 
                                }
                            ?>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include('Footer.php'); ?>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function () {
                updateLineChart();
                updateBarChart();                
            });
        })
    </script>
</body>

</html>