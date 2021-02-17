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
                        String Concatination 
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                    <h6 class="text-muted">Join the column according to Last Name , First Name , Middle Initial.</h6>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input id="txtLastName" type="text" class="form-control" placeholder="Last Name" autocomplete="lastname">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input id="txtFirstName" type="text" class="form-control" placeholder="First Name" autocomplete="firstname">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input id="txtMiddleName" type="text" class="form-control" placeholder="Middle Name" autocomplete="middlename">
                    </div>


                    <button class="btn btn-success" id="btnFullname">Get Full Name</button>

                    </div>

                    <br>

                    <div class="container">
                        <table class="table" id="tblFullName">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name with Middle Initial</th>
                                    <th scope="col">Full Name with Middle Name</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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