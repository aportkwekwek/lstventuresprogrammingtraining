<!DOCTYPE html>
<html lang="en">
<?php
    require_once '../includes/head.php';
?>
<body style="height:100%;">


    <div class="jumbotron">
            <h5>LSTVENTURES PROGRAMMING TRAINING</h5>
    </div>
    <div class="container-fluid" style="margin-top:-32px;">

        <div class="row" style="height:100%;">

            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

            <?php
                require_once '../includes/nav.php';
            ?>

            </div>

            <div class="col-md-9">

                <div class="container" style="margin-top:30px;">
                    <h1 class="text-muted">
                        Print  
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                        <!-- Fetcher From Start -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-book" aria-hidden="true"></i>&emsp; Fetcher Code From&emsp;</span>
                            </div>

                            <select class="form-control comboBoxFetcherCodeFrom" id="comboBoxFetcherCodeFrom">
                            <!-- <option value="0"> -- Select student code -- </option> -->
                            <?php
                                require_once("../config.db.php");

                                // $connect = new Connection;
                                // $conn = $connect->openConnection();

                                    $query = "Select fetchercode from fetcher";
                                    $res = $link_id->prepare($query);
                                    $res->execute();
                                    if($res->rowCount()){
                                        while($row = $res->fetch(PDO::FETCH_ASSOC)){

                                            ?>
                                            <option value="<?php echo $row['fetchercode']; ?>"><?php echo $row['fetchercode']; ?></option>
                                            <?php
                                        }
                                    }

                                // $connect->closeConnection();
                            ?>
                            </select>
                        
                        </div>

                        <!-- Fetcher from end -->


                        <!-- Fetcher To Start -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-book" aria-hidden="true"></i>&emsp; Fetcher Code To  &emsp;&emsp;</span>
                            </div>

                            <select class="form-control comboBoxFetcherCodeTo" id="comboBoxFetcherCodeTo">
                            <!-- <option value="0"> -- Select student code -- </option> -->
                            <?php
                                require_once("../config.db.php");

                                // $connect = new Connection;
                                // $conn = $connect->openConnection();

                                    $query = "Select fetchercode from fetcher";
                                    $res = $link_id->prepare($query);
                                    $res->execute();
                                    if($res->rowCount()){
                                        while($row = $res->fetch(PDO::FETCH_ASSOC)){

                                            ?>
                                            <option value="<?php echo $row['fetchercode']; ?>"><?php echo $row['fetchercode']; ?></option>
                                            <?php
                                        }
                                    }

                                // $connect->closeConnection();
                            ?>
                            </select>
                        
                        </div>

                        <!-- End Fetcher To -->

                        <!-- Registered Date -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i>&emsp; Registered Date From</span>
                            </div>
                            
                            <input id="dateFetcherFrom" type="date" class="form-control" placeholder="">
                            
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i>&emsp; Registered Date To &emsp;</span>
                            </div>
                            
                            <input id="dateFetcherTo" type="date" class="form-control" placeholder="">
                            
                        </div>
                        
                        <!-- End Registered Date -->

                        <div class="row">
                            <div class="col-md-5 text-muted">
                            <br>
                                <div class="form-check">
                                    <input class="form-check-input" name="fetcherActive" type="checkbox" id="fetcherActive">
                                    <label class="form-check-label" for="fetcherActive">
                                        Display Active Fetcher Only
                                    </label>
                                </div>
                                    <br>
                                <div class="form-check">
                                    <input class="form-check-input" name="fetcherInactive" type="checkbox" id="fetcherInactive">
                                    <label class="form-check-label" for="fetcherInactive">
                                        Display Inactive Fetcher Only
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-5 text-muted">

                                <br>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="detailedSummarized" value="detailed" checked>
                                                <label class="form-check-label" for="detailedSummarized">
                                                    Detailed
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="detailedSummarized" value="summarized">
                                                <label class="form-check-label" for="detailedSummarized">
                                                    Summarized
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                
                                
                            </div>

                            <!-- end col md 5 -->

                            <div class="col-md-2" style="text-align:right;">
                            <br>
                                <button class='btn btn-info' id="btnPrint"><i class='fa fa-print'></i>&emsp;Print &emsp;</button>
                            </div>
                        </div>

                    </div>

                   

                </div>
               
            </div>

        </div>
      
    </div>
</body>

<?php
    require_once '../includes/scripts.php';
?>

</html>