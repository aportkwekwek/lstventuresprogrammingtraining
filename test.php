<?php
    // $input = "<script></script>";
    

    // if (!preg_match("/^[a-zA-Z0-9- ]*$/", $input)){
    //     echo "Invalid";
    // }else{
    //     echo "Valid";
    // }

    $response = array();
    $response['test'] = "Hello";

    if(isset($_POST['test'])){
        echo json_encode($response);
    }


?>