<?php

    session_start();

  
    include('../assets/ezpdfclass/class/class.ezpdf.php');
    require_once('../connection.php');
    include('../assets/lstvfunctions/lx.pdodb.php');
    include('../config.db.php');

    if(isset($_POST['loadStudent'])){

        $xresponse = array();
        // $connect = new Connection();
        // $conn = $connect->openConnection();

        $xdateNow =  date('Y');


        $xquery = "Select max(studentcode) as studentcode from studentfile";
        $xres = $link_id->prepare($xquery);
        $xres->execute();

        
        // $row = $res->fetch(PDO::FETCH_ASSOC);

        $xrs = $xres->fetch();
       
        if($xrs['studentcode'] != null){


            $xresPlus1 = substr($xrs['studentcode'],6,4);
            $xcurr = $xresPlus1 + 1;

            $xresponse['studentcode'] = $xcurr;

        }else{
            
            $xresponse['studentcode'] = "1001";
        }

        echo json_encode($xresponse);
        
        // $connect->closeConnection();

    }


    if(isset($_POST['addStudent'])){

        $response = array();

        // $connect = new Connection();
        // $conn = $connect->openConnection();

        $studentCode = $_POST['studentCode'];
        $studentName = $_POST['studentName'];

        $yearNow = date('Y');
        
        $xarr_students = array();

        // check if student name already exists in the database

        $queryCheck = "Select * from studentfile where fullname ='$studentName'";
        $result = $link_id->prepare($queryCheck);
        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);
        if($row['fullname'] == $studentName){

            $response['status'] = 'Error';
            $response['message'] = 'Student already exists in the database';

        }else{


            $defaultStudentCode = "ST$yearNow-1001";
            $defaultStudentCode = str_replace('-','',$defaultStudentCode);
    
            // Check if the user changes the studentCode 
    
            $query = "Select * from studentfile order by studentcode desc limit 1";
            $res = $link_id->prepare($query);
            $res->execute();
    
            $row = $res->fetch(PDO::FETCH_ASSOC);
    
            if($row['studentcode'] == null){

                // Create new studentCode recordid etc
                // this is for first time records

                $xarr_students['studentcode'] = $defaultStudentCode;
                $xarr_students['recid'] = 1;
                $xarr_students['fullname'] = $studentName;
                $xarr_students['isactive'] = 1;
    
                PDO_InsertRecord($linkid,'studentfile',$xarr_students);           
    
                $response['status'] = 'Ok';
                $response['message'] = 'Successfully inserted data';
    
            }else{
    
                $existingRecordid = $row['recid'];
                $newRecordId = $existingRecordid + 1;
    
                // Check if studentCode exists in the database
    
                $query = "Select * from studentfile where studentcode='$studentCode'";
                $res2 = $link_id->prepare($query);
                $res2->execute();
    
                $row2 = $res2->fetch(PDO::FETCH_ASSOC);
    
    
                if($row2['studentcode'] == null ){

                    $xarr_students['studentcode'] = $studentCode;
                    $xarr_students['recid'] = $newRecordId;
                    $xarr_students['fullname'] = $studentName;
                    $xarr_students['isactive'] = 1;

                    PDO_InsertRecord($link_id,'studentfile',$xarr_students);

                    // $query = "Insert into studentfile (studentcode,recid,fullname) values ('$studentCode',$newRecordId,'$studentName')";
                    // $res3 = $link_id->prepare($xquery);
                    // $res3->execute();
    
                    $response['status'] = 'Ok';
                    $response['message'] = 'File inserted!';
    
                }else{
    
                    $response['status'] = 'Error';
                    $response['message'] = 'Duplicate student code!';
    
                }
    
            }

        }


        echo json_encode($response);


        // $connect->closeConnection();

    }

    if(isset($_POST['changeStudent'])){

        $response = array();

        // $connect = new Connection;
        // $conn = $connect->openConnection();

        $studentCode = $_POST['studentCode'];

        $query = "Select fullname from studentfile where studentcode ='$studentCode'";
        $res = $link_id->prepare($query);
        $res->execute();

        $row = $res->fetch(PDO::FETCH_ASSOC);
        $response['fullname'] = $row['fullname'];

        echo json_encode($response);

        // $connect->closeConnection();

    }


    if(isset($_POST['newStudentFetcher'])){

        $response = array();

        // $connect = new Connection;
        // $conn = $connect->openConnection();

        $query = "Select studentcode from studentfile";
        $res = $link_id->prepare($query);
        $res->execute();

        while($row = $res->fetch(PDO::FETCH_ASSOC)){

            $response[][] = $row['studentcode'];

        }

        echo json_encode($response);

        // $connect->closeConnection();


    }

    if(isset($_POST['addFetcher'])){

        $response = array();

        // $connect = new Connection;
        // $conn = $connect->openConnection();

        // Inputs

        $studentCodes = $_POST['studentCodes'];
        $studentRelationships = $_POST['studentRelationships'];
        $txtFetcherCode = $_POST['txtFetcherCode'];
        $txtFetcherName = $_POST['txtFetcherName'];
        $txtFetcherContact = $_POST['txtFetcherContact'];
        $dateFetcher = $_POST['dateFetcher'];
        $fetcherActive = $_POST['fetcherActive'];

        // Check if exists fetchercode

        $query = "Select count(fetchercode) from fetcher where fetchercode ='$txtFetcherCode'";
        $res = $link_id->prepare($query);
        $res->execute();

        $count = $res->fetchColumn();

        if($count == 0){

            // Insert old
            // $ins = "Insert into fetcher(fetchercode,fetchername) values ('$txtFetcherCode','$txtFetcherName')";


            // New insert
            $xarr_fetcher = array();
            $xarr_fetcher['fetchercode'] = $txtFetcherCode;
            $xarr_fetcher['fetchername'] = $txtFetcherName;

            PDO_InsertRecord($link_id,'fetcher',$xarr_fetcher);

            // End new insert
        
            // $res2 = $conn->prepare($ins);
            // $res2->execute();
            // then insert multiple data in student fetcher

            $count = count($studentCodes);

            for($i = 1; $i < $count; $i++){

                $xarr_student_fetcher = array();
                $xarr_student_fetcher['fetchercode'] = $txtFetcherCode;
                $xarr_student_fetcher['studentcode'] = $studentCodes[$i];
                $xarr_student_fetcher['relationship'] = $studentRelationships[$i];
                $xarr_student_fetcher['contactnumber'] = $txtFetcherContact;
                $xarr_student_fetcher['dateRegistered'] = $dateFetcher;
                $xarr_student_fetcher['isActive'] = $fetcherActive;  

                PDO_InsertRecord($link_id,'studentfetcher',$xarr_student_fetcher);

                // Old insert
                // "Insert into studentfetcher(fetchercode,studentcode,relationship,contactnumber,dateRegistered,isActive) values 
                // ('$txtFetcherCode','$studentCodes[$i]','$studentRelationships[$i]','$txtFetcherContact','$dateFetcher','$fetcherActive')"
                // $res3 = $conn->prepare($query);
                // $res3->execute();
            }

            $response['status'] = 'Ok';
            $response['message'] = 'Data inserted!';


        }else{

            $response['status'] = 'Error';
            $response['message'] = 'Cannot enter same fetcher code!';
        }


        echo json_encode($response);

        // $connect->closeConnection();

    }

    if(isset($_POST['btnPrint'])){

        // $connect = new Connection;
        // $conn = $connect->openConnection();

        $comboBoxFetcherCodeFrom = $_POST['comboBoxFetcherCodeFrom'];
        $comboBoxFetcherCodeTo = $_POST['comboBoxFetcherCodeTo'];
        $dateFetcherFrom = $_POST['dateFetcherFrom'];
        $dateFetcherTo = $_POST['dateFetcherTo'];
        $fetcherActive = $_POST['fetcherActive'];
        $fetcherInactive = $_POST['fetcherInactive'];
        $detailedOrsummarized = $_POST['detailedSummarized'];
        
        $fetcherGetInactiveActive;

        if($fetcherActive == 1 && $fetcherInactive == 1){
            $_SESSION['activeInActive'] = 2;
            $fetcherGetInactiveActive = 2;
        
        }elseif($fetcherActive == 0 && $fetcherInactive == 1){
            $_SESSION['activeInActive'] = 0;
            $fetcherGetInactiveActive = 0;
        }elseif($fetcherActive == 1 && $fetcherInactive == 0){
            $_SESSION['activeInActive'] = 1;
            $fetcherGetInactiveActive = 1;
        }else{
            $_SESSION['activeInActive'] = 2;
            $fetcherGetInactiveActive = 2;
        }

        // $_SESSION['fetcherFrom'] = $comboBoxFetcherCodeFrom;
        // $_SESSION['fetcherTo'] = $comboBoxFetcherCodeTo;
        // $_SESSION['dateFrom'] = $dateFetcherFrom;
        // $_SESSION['dateTo'] = $dateFetcherTo;
        // $connect->closeConnection();


        if($detailedOrsummarized == 'detailed'){
            printDetailed($link_id, $comboBoxFetcherCodeFrom, $comboBoxFetcherCodeTo , $dateFetcherFrom, $dateFetcherTo,$fetcherGetInactiveActive);
        }else{
            printSummarized($link_id, $comboBoxFetcherCodeFrom, $comboBoxFetcherCodeTo , $dateFetcherFrom, $dateFetcherTo,$fetcherGetInactiveActive);
        }

    }

    

    // Additional printing rospdf
    if(isset($_POST['printStudents'])){

        // $connect = new Connection;
        // $conn = $connect->openConnection();

        $pdf = new Cezpdf('Letter');
        // $pdf->openObject();
        $pdf->saveState();

        $xfsize = 8;
        $xtop = 750;
        
        $dateToday = date('F d, Y');

        $pdf->ezPlaceData(25,$xtop , "List of all Students",20 ,'left');
        $xtop -=20;
        $pdf->ezPlaceData(25,$xtop,"Printed on: $dateToday" , 9 ,'left');

        $xtop -=30;


        $x1 = 25; // line
        $x2 = 587; // line width
        $pdf->line($x1, $xtop ,$x2 , $xtop);
        $xtop -= 10;

        $xleft = array();
        $xleft[0] = 25;
        $xleft[1] = $xleft[0] + 80;
        $xleft[2] = $xleft[1] + 200;

        $pdf->ezPlaceData($xleft[0], $xtop,"Record ID",$xfsize, 'left');
        $pdf->ezPlaceData($xleft[1], $xtop,"Student Code",$xfsize,'left');
        $pdf->ezPlaceData($xleft[2], $xtop,"Student Full Name",$xfsize,'left');
        
        $xtop -=5;
        $pdf->line($x1,$xtop,$x2,$xtop);
        $xtop -= 10;

        $query = "Select * from studentfile";
        $res = $link_id->prepare($query);
        $res->execute();
        
        while($row = $res->fetch(PDO::FETCH_ASSOC)){

            if($xtop < 150){
                $pdf->ezNewPage();
                $xtop = 750;

                $pdf->line($x1, $xtop ,$x2 , $xtop);
                $xtop -= 10;

                
                $pdf->ezPlaceData($xleft[0], $xtop,"Record ID",$xfsize, 'left');
                $pdf->ezPlaceData($xleft[1], $xtop,"Student Code",$xfsize,'left');
                $pdf->ezPlaceData($xleft[2], $xtop,"Student Full Name",$xfsize,'left');
                
                $xtop -=5;
                $pdf->line($x1,$xtop,$x2,$xtop);
                $xtop -= 10;

            }

            $recid = $row['recid'];
            $studentcode = $row['studentcode'];
            $fullname = $row['fullname'];

            $pdf->ezPlaceData($xleft[0],$xtop,$recid,$xfsize,'left');
            $pdf->ezPlaceData($xleft[1],$xtop,$studentcode,$xfsize,'left');
            $pdf->ezPlaceData($xleft[2],$xtop,$fullname,$xfsize,'left');

            $xtop-= 15;
        }
        
        $pdf->ezStream();
        // $pdf->closeObject();
        // $connect->closeConnection();
    }

   


    function printDetailed($link_id, $ffrom, $fto, $dfrom, $dto, $activeInactive){


        // $connect = new Connection;
        // $conn = $connect->openConnection();
        
        $pdf = new Cezpdf('Letter');
        $pdf->saveState();

        $pdf->selectFont('../assets/fonts/Helvetica.afm');
      
        $xfsize = 8;
        $xtop = 750;
        $xtop -=20;
        
        $dateToday = date('F d, Y');

        $pdf->ezPlaceData(25,$xtop , "Detailed Fetcher File Report",20 ,'left');
        $xtop -=20;
        $pdf->ezPlaceData(25,$xtop,"Printed on: $dateToday" , 9 ,'left');
        $xtop -=15;

        if($activeInactive == 2){
            $isActives = "Active and Inactive Fetchers";
            $query = "select fetcher.fetchercode as fetchercode, fetcher.fetchername as fetchername ,studentfetcher.contactnumber as contactnumber, studentfetcher.dateRegistered as datereg from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where fetcher.fetchercode BETWEEN '$ffrom' and '$fto' AND studentfetcher.dateRegistered BETWEEN '$dfrom' and '$dto' group by fetcher.fetchercode";
        }elseif($activeInactive == 1){
            $isActives = "Active Fetchers";
            $query = "select fetcher.fetchercode as fetchercode, fetcher.fetchername as fetchername ,studentfetcher.contactnumber as contactnumber, studentfetcher.dateRegistered as datereg from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where fetcher.fetchercode BETWEEN '$ffrom' and '$fto' AND studentfetcher.dateRegistered BETWEEN '$dfrom' and '$dto' and isActive=1 group by fetcher.fetchercode";
        }else{
            $isActives = "Inactive Fetchers";
            $query = "select fetcher.fetchercode as fetchercode, fetcher.fetchername as fetchername ,studentfetcher.contactnumber as contactnumber, studentfetcher.dateRegistered as datereg from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where fetcher.fetchercode BETWEEN '$ffrom' and '$fto' AND studentfetcher.dateRegistered BETWEEN '$dfrom' and '$dto' and isActive=0 group by fetcher.fetchercode";
        }

        $pdf->ezPlaceData(24, $xtop, "List of $isActives ", 9 , 'left');


        $x1 = 25; 
        $x2 = 587;
        $pdf->line($x1, $xtop - 10 , $x2, $xtop - 10);
        $xtop -= 20;

        $xleft = array();
        $xleft[0] = 25;
        $xleft[1] = $xleft[0] + 80;
        $xleft[2] = $xleft[1] + 200;
        $xleft[3] = $xleft[2] + 100;
        $xleft[4] = $xleft[3] + 100;


        $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica-Bold.afm');

        $pdf->ezPlaceData($xleft[0], $xtop,"Student Code",$xfsize, 'left');
        $pdf->ezPlaceData($xleft[1], $xtop,"Student Name",$xfsize,'left');
        $pdf->ezPlaceData($xleft[2], $xtop,"Relationship",$xfsize,'left');
        $pdf->ezPlaceData($xleft[3], $xtop,"Contact Number",$xfsize,'left');
        $pdf->ezPlaceData($xleft[4], $xtop,"Date Registered",$xfsize,'left');

        $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica.afm');

        $xtop -=5;
        $pdf->line($x1,$xtop,$x2,$xtop);
        $xtop -= 10;

        $res = $link_id->prepare($query);
        $res->execute();
        
        $totalFetcherCount = 0;
        $totalStudentCount = 0;
                
        $pdf->ezStartPageNumbers(590 , 40, 8, 'left',$pattern = "{PAGENUM} / {TOTALPAGENUM}", $num = 1);
       

        while($row = $res->fetch(PDO::FETCH_ASSOC)){

            if($xtop < 150){
                
                
                $pdf->ezNewPage();

                $xtop = 750;

                $pdf->line($x1, $xtop - 10 , $x2, $xtop - 10);
                $xtop -= 20;

                $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica-Bold.afm');
                
                $pdf->ezPlaceData($xleft[0], $xtop,"Student Code",$xfsize, 'left');
                $pdf->ezPlaceData($xleft[1], $xtop,"Student Name",$xfsize,'left');
                $pdf->ezPlaceData($xleft[2], $xtop,"Relationship",$xfsize,'left');
                $pdf->ezPlaceData($xleft[3], $xtop,"Contact Number",$xfsize,'left');
                $pdf->ezPlaceData($xleft[4], $xtop,"Date Registered",$xfsize,'left');
    
                $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica.afm');

                $xtop -= 5;
                
                $pdf->line($x1,$xtop,$x2,$xtop);
                $xtop -= 10;
                
            }

            $totalFetcherCount = $totalFetcherCount + 1;
            $fetchersCode = $row['fetchercode'];
            $fetcherName = $row['fetchername'];
            $fetcherContact = $row['contactnumber'];
            $fetcherRegDate = $row['datereg'];
            
            $fetcherRegDate = date("F d, Y", strtotime($fetcherRegDate));

            $xtop -= 10;
            
            $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica-Bold.afm');
            $pdf->ezPlaceData($xleft[0],    $xtop,  "$fetchersCode", $xfsize , 'left');
            $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica.afm');
            $pdf->ezPlaceData($xleft[1],    $xtop,  $fetcherName,    $xfsize , 'left');
            $pdf->ezPlaceData($xleft[2],    $xtop,  '',              $xfsize , 'left');
            $pdf->ezPlaceData($xleft[3],    $xtop,  $fetcherContact, $xfsize , 'left');
            $pdf->ezPlaceData($xleft[4],    $xtop,  $fetcherRegDate, $xfsize , 'left');
            
            $xtop -=15;

            $query2 = "Select studentfile.studentcode as studentcode, studentfile.fullname as fullname, studentfetcher.relationship as relationship, studentfetcher.contactnumber as contactnumber,studentfetcher.dateRegistered as datereg from studentfile inner join studentfetcher on studentfile.studentcode = studentfetcher.studentcode where studentfetcher.fetchercode ='$fetchersCode'";
            $res2 = $link_id->prepare($query2);
            $res2->execute();

            $fetcherStudentCount = 0;
            while($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
                $studentC = $row2['studentcode'];
                $studentF = $row2['fullname'];
                $studentR = $row2['relationship'];
                $fetcherStudentCount = $fetcherStudentCount + 1;
                $totalStudentCount = $totalStudentCount + 1;

                $pdf->ezPlaceData($xleft[0],    $xtop, "\r $studentC", $xfsize , 'left');
                $pdf->ezPlaceData($xleft[1],    $xtop, $studentF, $xfsize , 'left');
                $pdf->ezPlaceData($xleft[2],    $xtop, $studentR, $xfsize , 'left');

                $xtop -= 15;
                
            }
            
            $pdf->line($x1, $xtop + 10 , $x2, $xtop + 10);

            $pdf->ezPlaceData($xleft[0], $xtop, "Total Students: $fetcherStudentCount" , $xfsize, 'left');
            
            $xtop -= 20;

        }

        $xtop -= 40;
        
        $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica-Bold.afm');

        $pdf->ezPlaceData($xleft[0], $xtop , "Total Fetcher Count: $totalFetcherCount" ,9 , 'left');
      
        $xtop -= 15;
        $pdf->ezPlaceData($xleft[0], $xtop, "Total Student Count: $totalStudentCount" ,9, 'left');
        $xtop -= 20;
        
        $pdf->ezStream();


    }

    function printSummarized($link_id, $ffrom, $fto, $dfrom, $dto, $activeInactive){
        
        // $connect = new Connection;
        // $conn = $connect->openConnection();
        $pdf = new Cezpdf('Letter');
        

        $pdf->saveState();

        $xfsize = 8;
        $xtop = 730;
        
        $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica.afm');
     

        $dateToday = date('F d, Y');


        $pdf->ezPlaceData(25,$xtop , "Summarized Fetcher File Report",20 ,'left');
        $xtop -=20;
        $pdf->ezPlaceData(25,$xtop,"Printed on: $dateToday" , 9 ,'left');
        $xtop -=15;

        if($activeInactive == 2){
            $isActives = "Active and Inactive Fetchers";
            $query = "select studentfetcher.fetchercode as fcode,studentfetcher.contactnumber as contact, fetcher.fetchername as fname, studentfetcher.dateRegistered as reg, count(studentfetcher.studentcode) as cnt from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where studentfetcher.fetchercode between '$ffrom' and '$fto' and studentfetcher.dateRegistered between '$dfrom' and '$dto' group by studentfetcher.fetchercode";
        }elseif($activeInactive == 1){
            $isActives = "Active Fetchers";
            $query = "select studentfetcher.fetchercode as fcode,studentfetcher.contactnumber as contact, fetcher.fetchername as fname, studentfetcher.dateRegistered as reg, count(studentfetcher.studentcode) as cnt from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where studentfetcher.fetchercode between '$ffrom' and '$fto' and studentfetcher.dateRegistered between '$dfrom' and '$dto' and studentfetcher.isActive=1 group by studentfetcher.fetchercode";
        }else{
            $isActives = "Inactive Fetchers";
            $query = "select studentfetcher.fetchercode as fcode,studentfetcher.contactnumber as contact, fetcher.fetchername as fname, studentfetcher.dateRegistered as reg, count(studentfetcher.studentcode) as cnt from fetcher inner join studentfetcher on fetcher.fetchercode = studentfetcher.fetchercode where studentfetcher.fetchercode between '$ffrom' and '$fto' and studentfetcher.dateRegistered between '$dfrom' and '$dto' and studentfetcher.isActive=0 group by studentfetcher.fetchercode";
        }


        $pdf->ezPlaceData(24, $xtop, "List of $isActives ", 9 , 'left');

        $x1 = 25; 
        $x2 = 587;
        $pdf->line($x1, $xtop - 10 , $x2, $xtop - 10);
        $xtop -= 20;

        $xleft = array();
        $xleft[0] = 25;
        $xleft[1] = $xleft[0] + 80;
        $xleft[2] = $xleft[1] + 200;
        $xleft[3] = $xleft[2] + 100;
        $xleft[4] = $xleft[3] + 100;

        $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica-Bold.afm');

        
        $pdf->ezPlaceData($xleft[0], $xtop,"Fetcher Code",$xfsize, 'left');
        $pdf->ezPlaceData($xleft[1], $xtop,"Fetcher Name",$xfsize,'left');
        $pdf->ezPlaceData($xleft[2], $xtop,"Registered Date",$xfsize,'left');
        $pdf->ezPlaceData($xleft[3], $xtop,"Contact Number",$xfsize,'left');
        $pdf->ezPlaceData($xleft[4], $xtop,"Number of Students",$xfsize,'left');

        
        $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica.afm');
        
        $xtop -=5;
        $pdf->line($x1,$xtop,$x2,$xtop);

        $xtop -= 10;

        $res = $link_id->prepare($query);
        $res->execute();
       
        $pdf->ezStartPageNumbers(590 , 40, 8, 'left',$pattern = "{PAGENUM} / {TOTALPAGENUM}", $num = 1);
       

        if($res->rowCount()){
            while($row = $res->fetch(PDO::FETCH_ASSOC)){

                if($xtop < 180){          

                    $pdf->ezNewPage();

                    $xtop = 750;
                    $pdf->line($x1, $xtop - 10 , $x2, $xtop - 10);
                    $xtop -= 20;

                    $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica-Bold.afm');

                    $pdf->ezPlaceData($xleft[0], $xtop,"Fetcher Code",$xfsize, 'left');
                    $pdf->ezPlaceData($xleft[1], $xtop,"Fetcher Name",$xfsize,'left');
                    $pdf->ezPlaceData($xleft[2], $xtop,"Registered Date",$xfsize,'left');
                    $pdf->ezPlaceData($xleft[3], $xtop,"Contact Number",$xfsize,'left');
                    $pdf->ezPlaceData($xleft[4], $xtop,"Number of Students",$xfsize,'left');

                    $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica.afm');

                    $xtop -= 5;
                    
                    $pdf->line($x1,$xtop,$x2,$xtop);
                    $xtop -= 10;

                }

                $xtop -= 10;

                $fetcherCode = $row['fcode'];
                $fetcherName = $row['fname'];
                $dateRegistered = $row['reg'];
                $fetcherContact = $row['contact'];
                $studentCount = $row['cnt'];

                $dateRegistered = date("F d, Y", strtotime($dateRegistered));

                $pdf->ezPlaceData($xleft[0], $xtop,$fetcherCode,$xfsize, 'left');
                $pdf->ezPlaceData($xleft[1], $xtop,$fetcherName,$xfsize,'left');
                $pdf->ezPlaceData($xleft[2], $xtop,$dateRegistered,$xfsize,'left');
                $pdf->ezPlaceData($xleft[3], $xtop,$fetcherContact,$xfsize,'left');
                $pdf->ezPlaceData($xleft[4], $xtop,$studentCount,$xfsize,'left');

                $xtop -=10;

            }

        }

        $pdf->selectFont('../assets/ezpdfclass/fonts/Helvetica-Bold.afm');

        $pdf->ezStream();

        $connect->closeConnection();

    }


?>