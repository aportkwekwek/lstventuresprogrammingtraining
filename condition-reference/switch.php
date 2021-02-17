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
                        Switch Case
                    </h1>
                <hr>
                    
                    <div class="container" style="margin-top:20px;">
                    
                    <div class="row">

                        <!-- Start Col md -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comboBoxCountry">Select Country</label>
                                <select class="form-control" id="comboBoxCountry">
                               
                                </select>
                            </div>
                        </div>
                        <!--End col md -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comboBoxCity">Select City</label>
                                <select class="form-control" id="comboBoxCity">
                               
                         
                                </select>
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