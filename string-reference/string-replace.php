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
                        String Replace 
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                    <h6 class="text-muted">Replace special character with spaces</h6>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input id="txtGivenString" type="text" class="form-control" value="January-February\March,April May;June:July]August/September.October|November#December" disabled>

                        </div>

                    <div class="container" style="margin-top:10px;">
                        <div id="stringReplace">
                        </div>
                        <br>
                    </div>

                    
                    <h6 class="text-muted">Sort Month</h6>

                    <table class="table" id="tblMonth">
                        <thead>
                            <tr>
                                <th scope="col">Sort</th>
                                <th scope="col">Month</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                        
                    </table>

                        
                    <button class="btn btn-success" id="btnStringReplace">Go</button>

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