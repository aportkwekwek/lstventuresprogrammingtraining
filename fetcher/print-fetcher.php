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
                                <span class="input-group-text btn btn-success"><i class="fa fa-book" aria-hidden="true"></i>&emsp; Fetcher Code From&emsp;</span>
                            </div>

                            <select class="form-control comboBoxFetcherCodeFrom" id="comboBoxFetcherCodeFrom">
                        
                                <?php
                                    require_once("../config.db.php");

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

                                ?>
                                
                            </select>
                        
                        </div>

                        <!-- Fetcher from end -->


                        <!-- Fetcher To Start -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn btn-success"><i class="fa fa-book" aria-hidden="true"></i>&emsp; Fetcher Code To  &emsp;&emsp;</span>
                            </div>

                            <select class="form-control comboBoxFetcherCodeTo" id="comboBoxFetcherCodeTo">
                            
                                <?php
                                    require_once("../config.db.php");


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

                                ?>
                            </select>
                        
                        </div>

                        <!-- End Fetcher To -->

                        <!-- Registered Date -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn btn-info"><i class="fa fa-calendar" aria-hidden="true"></i>&emsp; Registered Date From</span>
                            </div>
                            
                            <input id="dateFetcherFrom" type="date" class="form-control" placeholder="">
                            
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn btn-info"><i class="fa fa-calendar" aria-hidden="true"></i>&emsp; Registered Date To &emsp;</span>
                            </div>
                            
                            <input id="dateFetcherTo" type="date" class="form-control" placeholder="">
                            
                        </div>
                        
                        <!-- End Registered Date -->


                        <div class="row">
                            <div class="col-md-5 text-muted" style="border-right:1px groove;">
                            <p style="cursor:help;" toggle='tooltip' title='Unchecking or checking both will display both inactive and active fetchers.'>Active and Inactive Options</p>
                            
                                <div class="form-check">
                                    <label for="" class="checkbox path" style="margin-left:-20px;">
                                        <input class="form-check-input" name="fetcherActive" type="checkbox" id="fetcherActive" checked>
                                        <svg viewBox="0 0 21 21">
                                            <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                                        </svg>
                                    </label>

                                    <label class="form-check-label" for="fetcherActive" style="margin-left:10px; position:absolute;">
                                        Display Active Fetcher Only
                                    </label>
                                </div>


                                    <br>
                                <div class="form-check">
                                    <label for="" class="checkbox path" style="margin-left:-20px;">
                                        <input class="form-check-input" name="fetcherInactive" type="checkbox" id="fetcherInactive">
                                            <svg viewBox="0 0 21 21">
                                                <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                                            </svg>
                                    </label>
                                    <label class="form-check-label" for="fetcherInactive" style="margin-left:10px; position:absolute;">
                                        Display Inactive Fetcher Only
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-5 text-muted">
                            <p style="cursor:help;" toggle='tooltip' title='Reporting options for detailed and summarized fetcher report.'>Report Options</p> 

                                <div class="form-check">
                                    <label for="" class="checkbox path" style="margin-left:-20px;">
                                    <input class="form-check-input" type="radio" name="detailedSummarized" value="detailed" id="chk_detailed" checked>
                                        <svg viewBox="0 0 21 21">
                                            <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                                        </svg>
                                    </label>
                                    <label class="form-check-label" for="chk_detailed" style="margin-left:10px; position:absolute;">
                                        Detailed
                                    </label>
                                </div>

                                <br>

                                <div class="form-check">
                                    <label for="" class="checkbox path" style="margin-left:-20px;">
                                    <input class="form-check-input" type="radio" name="detailedSummarized" value="summarized" id="chk_summarized">
                                    <svg viewBox="0 0 21 21">
                                            <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                                        </svg>
                                    </label>
                                    <label class="form-check-label" for="chk_summarized" style="margin-left:10px; position:absolute;">
                                        Summarized
                                    </label>
                                </div>
                                
                            </div>

                            <!-- end col md 5 -->

                            <div class="col-md-2" style="text-align:right;">
                            <br>
                                <button class='btn btn-info' id="btnPrint"><i class='fa fa-print'></i>&emsp;Print &emsp;</button>
                            </div>
                            
                            <!-- end col md 2  -->

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