
<?php

require '../config.db.php';
require '../assets/lstvfunctions/lx.pdodb.php';

if(isset($_POST['load'])){

    $xstudent_arr = array();

    require_once('../config.db.php');
    $query = "Select * from studentfile where isactive = 1";
    $res = $link_id->prepare($query);
    $res->execute();

    $ctr = 0;

    while($row = $res->fetch(PDO::FETCH_ASSOC)){
           
            $xstudent_arr[$ctr]['recid'] = $row['recid'];
            $xstudent_arr[$ctr]['studentcode'] = $row['studentcode'];
            $xstudent_arr[$ctr]['fullname'] = $row['fullname'];
            $ctr  = $ctr + 1;
    }

    // echo $xstudent_arr;

    echo json_encode($xstudent_arr);

   
}

if(isset($_POST['updateStudent'])){

    $xresponse = array();



    $xstudent_recordid = $_POST['xrecordid'];
    $xstudent_studentcode = $_POST['xstudentcode'];
    $xstudent_fullname = $_POST['xfullname'];

    // Check if record exists baka pinalitan

    $xquery = "Select * from studentfile where recid=$xstudent_recordid and studentcode='$xstudent_studentcode'";
    $xres = $link_id->prepare($xquery);
    $xres->execute();
    
    $xrow = $xres->fetch(PDO::FETCH_ASSOC);
    $xrecordid = $xrow['recid'];

    if($xrecordid == ''){

        $xresponse['status'] = 'Error';
        $xresponse['message'] = 'You are trying to edit incompatible data';

    }else{

        // Check if name exists in the database

        $xquery = "Select fullname from studentfile where fullname ='$xstudent_fullname'";
        $xres = $link_id->prepare($xquery);
        $xres->execute();
        
        
        if($xres->rowCount()){

            $xresponse['status'] = 'Error';
            $xresponse['message'] = 'Name already exists in the database';
        }else{

            // Update now

            $xarr_updatestudent_param = array();
            $xarr_updatestudent_param['studentcode'] = $xstudent_studentcode;
            $xarr_updatestudent_param['recid'] = $xstudent_recordid;

            $xarr_updatestudentname = array();
            $xarr_updatestudentname['fullname'] = $xstudent_fullname;

            PDO_UpdateRecord($link_id,'studentfile',$xarr_updatestudentname,'studentcode=? and recid=?', $xarr_updatestudent_param);
            
            $xresponse['status'] = 'Ok';
            $xresponse['message'] = 'Success';

        }

    }


    echo json_encode($xresponse);
}


if(isset($_POST['btnDeleteStudent'])){

    $response = array();

    $xrecordid = $_POST['xrecordid'];
    $xstudentcode = $_POST['xstudentcode'];
    $xfullname = $_POST['xfullname'];

    $xarr_student_del_params = array();
    $xarr_student_del_params['recid'] = $xrecordid;
    $xarr_student_del_params['studentcode'] = $xstudentcode;
    $xarr_student_del_params['fullname'] = $xfullname;

    $xarr_student_del_inactive = array();
    $xarr_student_del_inactive['isactive'] = 0;

    PDO_UpdateRecord($link_id,'studentfile',$xarr_student_del_inactive ,'recid=? and studentcode=? and fullname=?',$xarr_student_del_params);

    $response['status'] = 'Ok';
    $response['message'] = 'Successfully deleted student';

    echo json_encode($response);

}

?>