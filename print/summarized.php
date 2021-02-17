<?php
    session_start();
    require_once('../connection.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/app.css">
    <title>LST VENTURES TRAINING EXAM</title>
</head>

<body style="height:auto;" onload="window.print()" >

<div class="container" style="margin-top:5vh;">
    <h1>SUMMARIZED FETCHER FILE REPORT</h1>
    <h6>Date Printed: <?php  echo date('F d, Y'); ?></h6>
    <h6></h6>
    <hr>
    <br>

    <?php

        if(isset($_SESSION['fetcherFrom'])){
            $ffrom = $_SESSION['fetcherFrom'];
            $fto = $_SESSION['fetcherTo'];
            $dfrom = $_SESSION['dateFrom'];
            $dto = $_SESSION['dateTo'];
            $activeInactive = $_SESSION['activeInActive'];

            if($activeInactive == 2){
                $isActives = "Active and Inactive";
                $query = "select studentfetcher.fetchercode as fcode, fetcher.fetchername as fname, studentfetcher.dateRegistered as reg, count(studentfetcher.studentcode) as cnt from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where studentfetcher.fetchercode between '$ffrom' and '$fto' and studentfetcher.dateRegistered between '$dfrom' and '$dto' group by studentfetcher.fetchercode";
            }elseif($activeInactive == 1){
                $isActives = "Active";
                $query = "select studentfetcher.fetchercode as fcode, fetcher.fetchername as fname, studentfetcher.dateRegistered as reg, count(studentfetcher.studentcode) as cnt from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where studentfetcher.fetchercode between '$ffrom' and '$fto' and studentfetcher.dateRegistered between '$dfrom' and '$dto' and studentfetcher.isActive=1 group by studentfetcher.fetchercode";

                
            }else{
                $isActives = "Inactive";
                $query = "select studentfetcher.fetchercode as fcode, fetcher.fetchername as fname, studentfetcher.dateRegistered as reg, count(studentfetcher.studentcode) as cnt from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where studentfetcher.fetchercode between '$ffrom' and '$fto' and studentfetcher.dateRegistered between '$dfrom' and '$dto' and studentfetcher.isActive=0 group by studentfetcher.fetchercode";
               }

        }

    ?>

                <div class="container">
                    <h6>List of <?php echo $isActives; ?> </h6>
                </div>

    <table class="table">
        <thead>
            <tr style="border-top:3px solid; border-bottom:3px solid;">
                <th>Fetcher Code</th>
                <th>Fetcher Name</th>
                <th>Registered Date</th>
                <th>No. of Student</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $connect = new Connection;
                $conn = $connect->openConnection();

                $res = $conn->prepare($query);
                $res->execute();
                if($res->rowCount()){
                    while($row = $res->fetch(PDO::FETCH_ASSOC)){

                        ?>
                    <tr>
                        <td><?php echo $row['fcode'];?> </td>
                        <td><?php echo $row['fname'];?> </td>
                        <td><?php echo date("F d, Y" ,strtotime($row['reg'])); ?> </td>
                        <td><?php echo $row['cnt'];?> </td>
                    </tr>
                        <?php
                    }
                }

            ?>
        </tbody>
    </table>

</div>


</body>

</html>