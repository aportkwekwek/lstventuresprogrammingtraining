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

    <style>
    *{
    padding: 0px;
    margin: 0px;
    }
    </style>
</head>

<body style="height:auto;" onload="window.print()">
<div class="container" style="margin-top:10vh;">
    <h1>DETAILED FETCHER FILE REPORT</h1>
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

        }

    ?>
    
    <table class="table">
        <thead style="border-top:3px solid; border-bottom:3px solid;">
            <th>Student Code</th>
            <th>Student Name</th>
            <th>Relationship</th>
            <th>Contact Number</th>
            <th>Date Registered</th>
        </thead>
        <tbody>
            <?php

            

                $connect = new Connection;
                $conn = $connect->openConnection();

                if($activeInactive == 2){
                    $isActives = "Active and Inactive";
                    $query = "select fetcher.fetchercode as fetchercode, fetcher.fetchername as fetchername ,studentfetcher.contactnumber as contactnumber, studentfetcher.dateRegistered as datereg from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where fetcher.fetchercode BETWEEN '$ffrom' and '$fto' AND studentfetcher.dateRegistered BETWEEN '$dfrom' and '$dto' group by fetcher.fetchercode";
                }elseif($activeInactive == 1){
                    $isActives = "Active";
                    $query = "select fetcher.fetchercode as fetchercode, fetcher.fetchername as fetchername ,studentfetcher.contactnumber as contactnumber, studentfetcher.dateRegistered as datereg from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where fetcher.fetchercode BETWEEN '$ffrom' and '$fto' AND studentfetcher.dateRegistered BETWEEN '$dfrom' and '$dto' and isActive=1 group by fetcher.fetchercode";
                }else{
                    $isActives = "Inactive";
                    $query = "select fetcher.fetchercode as fetchercode, fetcher.fetchername as fetchername ,studentfetcher.contactnumber as contactnumber, studentfetcher.dateRegistered as datereg from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where fetcher.fetchercode BETWEEN '$ffrom' and '$fto' AND studentfetcher.dateRegistered BETWEEN '$dfrom' and '$dto' and isActive=0 group by fetcher.fetchercode";
                }

                ?>

                <div class="container">
                    <h6>List of <?php echo $isActives; ?> </h6>
                </div>

                <?php
                
                $res = $conn->prepare($query);
                $res->execute();

                $totalFetcher = 0;
                $totalStudent = 0;


                if($res->rowCount()){
                    while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                   $totalFetcher = $totalFetcher + 1;
            ?>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $row['fetchercode']; ?></td>
                        <td style="font-weight:500;"><?php echo $row['fetchername']; ?></td>
                        <td></td>
                        <td><?php  echo $row['contactnumber'];?></td>
                        <td><?php echo date("F d, Y",strtotime($row['datereg'])); ?></td>
                    </tr>
                    
                        <?php
                            $fetcherStudent = 0;
                            
                            $currFetcherCode = $row['fetchercode'];
                            $query2 = "Select studentfile.studentcode as studentcode, studentfile.fullname as fullname, studentfetcher.relationship as relationship, studentfetcher.contactnumber as contactnumber,studentfetcher.dateRegistered as datereg from studentfile inner join studentfetcher on studentfile.studentcode = studentfetcher.studentcode where studentfetcher.fetchercode ='$currFetcherCode'";
                            $res2 = $conn->prepare($query2);
                            $res2->execute();
                            if($res2->rowCount()){
                                while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
                                    $fetcherStudent = $fetcherStudent + 1;
                                    $totalStudent = $totalStudent + 1;

                                    ?>
                                <tr>
                                    <td><?php echo $row2['studentcode']; ?></td>
                                    <td><?php echo $row2['fullname']; ?></td>
                                    <td><?php echo $row2['relationship']; ?></td>
                                    <td></td>
                                    <td></td>
                                    <?php

                                }
                                ?>

                                </tr>

                                <tr style="border-top:2px solid;">
                                    <td>Total Student</td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td><?php echo $fetcherStudent; ?> </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <?php
                                
                            }

                        ?>

                        <?php
                    }
                }

            ?>

        </tbody>
    </table>

    <h6>Total Count of Student: <?php echo $totalStudent; ?></h6>
    <h6>Total Count of Fetcher: <?php echo $totalFetcher; ?> </h6>
                       
             

</div>

</body>

</html>