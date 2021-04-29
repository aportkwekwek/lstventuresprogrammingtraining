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

        <div class="row">

            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

            <?php
                require_once '../includes/nav.php';
                ?>

            </div>

            <div class="col-md-9">

                <div class="container" style="margin-top:30px;">
                    <h1 class="text-muted">
                        Student 
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                       <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                            </div>
                            <input id="txtStudentCode" type="text" class="form-control" placeholder="" disabled>

                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input id="txtStudentName" type="text" class="form-control" placeholder="Full Name">

                        </div>

                       <div class="row">
                        <div class="col-md-9">

                        </div>
                        <div class="col-md-3" style="text-align:right;">

                            <button class="btn btn-success" id="addStudent">New Student</button>
                        </div>
                       </div> 

                       <br>

                        <table class="table hover table-bordered table-responsive border-success" id="tblStudents"> 
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 12%;">Record ID</th>
                                    <th scope="col" style="width: 23%;">Student Code</th>
                                    <th scope="col" style="width: 52%;">Student Full Name</th>
                                    <th scope="col" style="width: 13%;">Action</th>
                                </tr>
                            </thead>



                            <tbody></tbody>

                            <tfoot>
                                <tr>
                                    <th scope="col">Record ID</th>
                                    <th scope="col">Student Code</th>
                                    <th scope="col">Student Full Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-info btn-sm" id="printStudents"><i class="fa fa-print"></i>&emsp;Print Students</button>
                                </div>
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

<script src="studentDataTable.js"></script>


</html>