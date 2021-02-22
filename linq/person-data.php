<!DOCTYPE html>
<html lang="en">
<?php
    require_once '../includes/head.php';
?>
<body>


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
                        Person Data 
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                    <button class="btn btn-success" id="getInformationFromDB">
                        Fill Table
                    </button>


                    <table class="table" style="margin-top:10px;" id="tblPersonsData">
                        <thead>
                            <tr>
                                <th scope="col">Last Name</th>
                                <th scope="col">Middle Name</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Age</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>

                    </table>

                    <hr>
                        <div class="container">

                            <!-- First Row -->
                            <div class="row">
                                <div class="col-md-5">
                                    
                                    <div class="input-group mb-3" style="padding-top:7px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        </div>
                                        <input id="txtSearchName" type="text" class="form-control" placeholder="Search Name">
                                    </div>

                                </div>

                                <div class="col-md-5">
                                    <h6 class="text-muted">Search Options</h6>
                                    <div class="row text-muted">
                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="searchOpt" value="leftmost" checked>
                                                <label class="form-check-label" for="leftmost">
                                                    Left Most
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="searchOpt" value="anywhere">
                                                <label class="form-check-label" for="anywhere">
                                                    Anywhere
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2" style="padding-top:8px;">
                                    <button class="btn btn-success" id="btnSearchPersonData">Refresh</button>
                                </div>
                                
                            </div>

                            <hr>
                            <!-- End First Row -->
                            <br>
                            <!-- Second Row -->
                            <div class="row">

                                <div class="col-md-9 text-muted" style="padding-bottom:8px; padding-top:4px;margin-right:-10px;">

                                    <h6 class="text-muted">Sort by</h6>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input names" type="radio" name="searchSort" value="firstname" checked>
                                                <label class="form-check-label" for="fname">
                                                    First Name
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input names" type="radio" name="searchSort" value="middlename">
                                                <label class="form-check-label" for="mname">
                                                    Middle Name
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input names" type="radio" name="searchSort" value="lastname">
                                                <label class="form-check-label" for="lname">
                                                    Last Name
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input names" type="radio" name="searchSort" value="age">
                                                <label class="form-check-label" for="age">
                                                    Age
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 text-muted" style="margin-left:10px; margin-top:10px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="searchAscDesc"   value="asc" checked>
                                        <label class="form-check-label" for="leftmost">
                                            Ascending
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="searchAscDesc" value="desc">
                                        <label class="form-check-label" for="leftmost">
                                            Descending
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <!-- End Second Row -->
                               <br>
                            <!-- Third Row Start -->
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="input-group mb-3" style="padding-top:7px;">
                                        <div class="input-group-prepend">
                                            <button class="input-group-text btn btn-success" id="totalAllAges">Total of all Ages</button>
                                        </div>
                                        <input id="txtTotalAge" type="text" class="form-control" placeholder="" disabled style="text-align:right;">
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="padding-top:7px;">
                                        <div class="input-group-prepend">
                                            <button class="input-group-text btn btn-success" id="btnTotalAgesLess40">Total of Ages less than 40</button>
                                        </div>
                                        <input id="txtTotalAgesLess40" type="text" class="form-control" placeholder="" disabled style="text-align:right;">
                                    </div>

                                </div>

                            </div>

                            <!-- End Third Row -->

                            <!-- Start Fourth Row -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="input-group mb-3" style="padding-top:7px;">
                                        <div class="input-group-prepend">
                                            <button class="input-group-text btn btn-success" id="btnTotalPersons">Total Count of all Persons</button>
                                        </div>
                                        <input id="txtTotalPersons" type="text" class="form-control" placeholder="" disabled style="text-align:right;">
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="padding-top:7px;">
                                        <div class="input-group-prepend">
                                            <button class="input-group-text btn btn-success" id="btnTotalAgeGreater40">Total Count of persons age greater than 40</button>
                                        </div>
                                        <input id="txtTotalAgeGreater40" type="text" class="form-control" placeholder="" disabled style="text-align:right;">
                                    </div>
                                </div>

                            </div>
                            <!-- End Fourth Row -->
                            
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

<!-- <script>

    $(document).ready(function(){

        $('#tblPersonsData').DataTable();

    });

</script> -->
</html>