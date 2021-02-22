<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="css/app.css">
    <title>LST VENTURES TRAINING EXAM</title>
</head>
<body>

    <div class="jumbotron">
            <h5>LSTVENTURES PROGRAMMING TRAINING</h5>

        <?php

            // $array = array(
            //     array("name" => "arr1",
            //           "type" => "string",
            //           "text" => "This is my first array"),
            //     array("name" => "arr2",
            //           "type" => "string",
            //           "text" => "This second attempt is uneasy"),
            //     array("name" => "arr3",
            //           "type" => "string",
            //           "text" => "Third one is a good one")
            // );

            // echo "<span>";
            // echo "<span>";

            // for($i = 0; $i < count($array) ; $i++){
            //     echo "<p>";
            //     echo $array[$i]["text"];
            //     echo "</p>";
            // }

        ?>

    </div>
    <div class="container-fluid" style="margin-top:-32px;">

        <div class="row">

            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

            <nav id="sidebarMenu" >
                    <div class="position-sticky pt-3">

                        <a href="index.php" style="text-decoration:none;" class="text-success sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
                        <span><i class="fa fa-home"></i>&emsp;Dashboard</span>
                        </a>

                        <a href="#loopref" style="text-decoration:none;" data-toggle="collapse" class="text-success sidebar-heading d-flex align-items-center px-3 mt-4 mb-1">
                        <span><i class="fa fa-repeat"></i>&emsp;Looping</span>
                        </a>
                        
                        <ul class="collapse list-unstyled" id="loopref">

                            <li class="nav-item">
                                <a class="nav-link" href="looping-reference/forloop.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;For 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="looping-reference/whileloop.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;While
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="looping-reference/foreachloop.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;For Each
                                </a>
                            </li>
                        </ul>

                        <a href="#ifelseswitch" style="text-decoration:none;" data-toggle="collapse" class="sidebar-heading d-flex align-items-center px-3 mt-4 mb-1 text-success">
                        <span><i class="fa fa-legal"></i>&emsp;Conditions</span>
                        </a>

                        <ul class="collapse list-unstyled" id="ifelseswitch">

                            <li class="nav-item">
                                <a class="nav-link" href="condition-reference/if-else.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;If Else 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../condition-reference/switch.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;Switch
                                </a>
                            </li>
                            
                        </ul>

                        <a href="#stringman" style="text-decoration:none;" data-toggle="collapse" class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-success">
                        <span><i class="fa fa-angle-double-right"></i>&emsp;Strings</span>
                        </a>

                        <ul class="collapse list-unstyled" id="stringman">

                            <li class="nav-item">
                                <a class="nav-link" href="string-reference/string-replace.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;String Replace
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="string-reference/string-concat.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;String Concat
                                </a>
                            </li>
                            
                        </ul>

                        <a href="#linqs" style="text-decoration:none;" data-toggle="collapse" class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-success">
                        <span><i class="fa fa-book"></i>&emsp;LINQ</span>
                        </a>

                        <ul class="collapse list-unstyled" id="linqs">

                            <li class="nav-item">
                                <a class="nav-link" href="linq/person-data.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;Person Data
                                </a>
                            </li>
                            
                        </ul>

                        <a href="#fetchers" style="text-decoration:none;" data-toggle="collapse" class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-success">
                        <span><i class="fa fa-link"></i>&emsp;Fetcher</span>
                        </a>

                        <ul class="collapse list-unstyled" id="fetchers">

                            <li class="nav-item">
                                <a class="nav-link" href="fetcher/student.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;Student
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="fetcher/fetcher.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;Fetcher 
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="fetcher/print-fetcher.php">&emsp;
                                <i class="fa fa-child"></i>&emsp;Print Data 
                                </a>
                            </li>
                            
                        </ul>

                    </div> <!-- Sticky -->
                </nav> <!-- Nav -->

            </div>


            <div class="col-md-9">

                <div class="container" style="margin-top:30px;">
                    <h1 class="text-muted">
                        Dashboard
                    </h1>
                    <hr>
                    
                    <div class="container" style="margin-top:20px;">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                            </div>
                            <input id="txtRowLoop" type="number" class="form-control" placeholder="Number of Row">

                        </div>
                        
                    <button class="btn btn-success" id="generateNumberLoop">Click to generate</button>

                    </div>

                    <div class="container" style="margin-top:10px;">
                        <div id="loopoutput">
                        
                        </div>
                    </div>

                </div>
               
            </div>

        </div>
      
    </div>
</body>

 <!-- jQuery CDN - Slim version (=without AJAX) -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


<script src="js/jquery-3-4-1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://use.fontawesome.com/70a44c349b.js"></script>
<script src="js/app.js"></script>

<!-- uac.lazada.com -->
<!-- open.shopee.com -->


</html>