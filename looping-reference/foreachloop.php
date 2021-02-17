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
                        For Each Loop Palindrome
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-language" aria-hidden="true"></i></span>
                            </div>
                            <input id="txtForeachLoop" type="text" class="form-control" placeholder="Palindrome">
                        </div>

                        <div class="input-group">
                            <button class="btn btn-success" id="btnForeachLoop">Palindrome</button>
                        </div>

                   
                        <div class="container-fluid" style="margin-top:30px;" id="palindromeHolder">
                            <!-- Dito append -->
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