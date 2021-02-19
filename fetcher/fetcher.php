<!DOCTYPE html>
<html lang="en">
<?php
    require_once '../includes/head.php';
?>
<body id="studentload">


    <div class="jumbotron">
            <h5>LSTVENTURES PROGRAMMING TRAINING</h5>
    </div>
    <div class="container-fluid" style="margin-top:-32px;">

        <div class="row">

            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

            <?php
                require_once '../includes/nav.php';
            ?>

            </div>

            <div class="col-md-9">

                <div class="container" style="margin-top:30px;">
                    <h1 class="text-muted">
                        Create New Fetcher 
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn btn-success"><i class="fa fa-hashtag" aria-hidden="true"></i>&emsp;Fetcher Code &emsp;</span>
                            </div>
                            <?php

                            require_once('../config.db.php');

                                // require_once('../connection.php');
                                // $connect = new Connection();

                                // $conn = $connect->openConnection();
                                
                                $query = "Select max(fetchercode) as fetchercode from fetcher";
                                $res = $link_id->prepare($query);
                                $res->execute();

                                $year = date('Y');

                                $row = $res->fetch(PDO::FETCH_ASSOC);
                                if($row['fetchercode'] == null || $row['fetchercode'] == ''){
                                    
                                    
                                    $newFetcherCode = "FE$year.1001";
                                    $newFetcherCode = str_replace('.','',$newFetcherCode);
                                    
                                }else{
                                    $lastFetcherCode = $row['fetchercode'];
                                    $lastFetcherCode = substr($lastFetcherCode,6,4);
                                    $lastFetcherCode = $lastFetcherCode + 1 ;
                                    $newFetcherCode = "FE$year.$lastFetcherCode";
                                    $newFetcherCode = str_replace('.','',$newFetcherCode);


                                }

                            ?>
                            <input id="txtFetcherCode" type="text" class="form-control" placeholder="" value =<?php echo $newFetcherCode ?> disabled>
                            <?php                      
                                // $connect->closeConnection();
                            ?>
                            </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn btn-success"><i class="fa fa-book" aria-hidden="true"></i>&emsp;Fetcher Name&emsp;</span>
                            </div>
                            <input id="txtFetcherName" type="text" class="form-control" >
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn btn-success"><i class="fa fa-phone" aria-hidden="true"></i>&emsp;Contact Number</span>
                            </div>
                            <input id="txtFetcherContact" type="number" class="form-control" placeholder="">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i>&emsp; Registered Date </span>
                            </div>
                            
                            <input id="dateFetcher" type="date" class="form-control" placeholder="">
                            
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" name="fetcherActive" type="checkbox" id="fetcherActive">
                            <label class="form-check-label" for="fetcherActive">
                                Is Active
                            </label>
                        </div>

                        <br>

                        <div class="container-fluid">

                            <div class="row">

                                <div class="col-md-5">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn btn-success"><i class="fa fa-id-badge" aria-hidden="true"></i>&emsp; Student Code</span>
                                        </div>

                                        <select class="form-control comboBoxStudentCode" id="comboBoxStudentCode">
                                        <option></option>
                                        <?php
                                            // require_once("../connection.php");

                                            // $connect = new Connection;
                                            // $conn = $connect->openConnection();

                                                $query = "Select studentcode from studentfile";
                                                $res = $link_id->prepare($query);
                                                $res->execute();
                                                if($res->rowCount()){
                                                    while($row = $res->fetch(PDO::FETCH_ASSOC)){

                                                        ?>
                                                        <option value="<?php echo $row['studentcode']; ?>"><?php echo $row['studentcode']; ?></option>
                                                        <?php
                                                    }
                                                }

                                            // $connect->closeConnection();
                                        ?>
                                    </select>
                                    
                                    </div>
                                

                                </div>

                                <div class="col-md-5">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn btn-danger"><i class="fa fa-heart" aria-hidden="true"></i>&emsp;Relationship</span>
                                        </div>
                                        <input id="txtRelationship" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button id="addinfototable" class="btn  btn btn-info btn-sm" style="margin-top:3px;"><i class="fa fa-plus" aria-hidden="true"></i>&emsp;Add&emsp;</button>
                                    </div>
                                </div>

                            </div>

                            
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn btn-success"><i class="fa fa-address-card" aria-hidden="true"></i>&emsp;Student Name</span>
                                        </div>
                                        <input id="txtSelectedName" type="text" class="form-control" disabled>
                                    </div>
                                </div>     
                            </div>

                        </div>

                        <hr>

                        <table class="table" id="tblFetcherData">

                            <thead>
                                <tr>
                                    <th scope="col">Student Code</th>
                                    <th>Student Name</th>
                                    <th>Relationship</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                           
                            </tbody>
                        </table>

                       <div class="row">
                        <div class="col-md-9">

                        </div>
                        <div class="col-md-3" style="text-align:right;">

                            <button class="btn btn-success" id="addFetcher">Save</button>
                        </div>
                       </div> 


                    </div>


                </div>
               
            </div>

        </div>
      
    </div>
</body>

<?php

    require_once "../includes/scripts.php";

?>

</html>