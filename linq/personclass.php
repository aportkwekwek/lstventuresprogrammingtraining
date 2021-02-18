<?php


    require_once('../connection.php');


    if(isset($_POST['getInformationFromDB'])){

        $connect = new Connection();

        $conn = $connect->openConnection();

        $response = array();

        $query = "Select * from persondata";
        $res = $conn->prepare($query);
        $res->execute();

        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            // $response['lastname'][] = $row['lastname'];
            $response[] = array(
                'lastname' => $row['lastname'],
                'firstname' => $row['firstname'],
                'middlename' => $row['middlename'],
                'age' => $row['age']
            );
        }

        $array2 = array();
        for($i = 0 ; $i < count($response) ; $i ++){
            $array2[$i] = $response[$i];
        }

        echo json_encode($array2);

        $connect->closeConnection();

    }


    if(isset($_POST['totalAllAges'])){
        $response = array();

        $connect = new Connection();
        $conn = $connect->openConnection();
        
        $query = "Select sum(age) as age from persondata";
        $res = $conn->prepare($query);
        $res->execute();
        
        if($res->rowCount()){
            $row = $res->fetch(PDO::FETCH_ASSOC);

            $response['status'] = 'Ok';
            $response['info'] = $row['age'];
        }else{

            $response['status'] = 'Error';
            $response['info'] = 'No data in the server';

        }

        echo json_encode($response);

        $connect->closeConnection();

    }


    if(isset($_POST['btnTotalAgesLess40'])){

        $response = array();

        $connect = new Connection();
        $conn = $connect->openConnection();

        $query = "Select sum(age) as age from persondata where age < 40";
        $res = $conn->prepare($query);
        $res->execute();

        if($res->rowCount()){
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $response['status'] = 'Ok';
            $response['info'] = $row['age'];
        }
        else{
            $response['status'] = 'Error';
            $response['info'] = "Error Collecting Data";
        }

        echo json_encode($response);

        $connect->closeConnection();

    }




    if(isset($_POST['btnTotalPersons'])){

        $connect = new Connection();
        $conn = $connect->openConnection();

        $query = "Select count(lastname) as totalPersons from persondata";
        $res = $conn->prepare($query);
        $res->execute();

        if($res->rowCount()){
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $response['status'] = 'Ok';
            $response['info'] = $row['totalPersons'];
    
        }
        else{
            $response['status'] = 'Error';
            $response['info'] = "Error Collecting Data";
        }

        echo json_encode($response);


        $connect->closeConnection();
    }

    if(isset($_POST['btnTotalAgeGreater40'])){

        $response = array();

        $connect = new Connection();
        $conn = $connect->openConnection();

        $query = "Select count(lastname) as age from persondata where age > 40";
        $res = $conn->prepare($query);
        $res->execute();

        if($res->rowCount()){
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $response['status'] = 'Ok';
            $response['info'] = $row['age'];
    
        }
        else{
            $response['status'] = 'Error';
            $response['info'] = "Error Collecting Data";
        }

        echo json_encode($response);


        $connect->closeConnection();

    }

    // Sort by name
    if(isset($_POST['names'])){


        $response = array();
            
        $connect = new Connection();
        $conn = $connect->openConnection();
        
        $ascDesc = $_POST['ascDesc'];
        $sortName = $_POST['sortName'];

        $query = "Select * from persondata order by $sortName $ascDesc";
        $res = $conn->prepare($query);
        $res->execute();

        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $response[] = array(
                'lastname' => $row['lastname'],
                'firstname' => $row['firstname'],
                'middlename' => $row['middlename'],
                'age' => $row['age']
            );
        }

        $array2 = array();
        for($i = 0 ; $i < count($response) ; $i ++){
            $array2[$i] = $response[$i];
        }

        echo json_encode($array2);

        $connect->closeConnection();

    }

    // Search name

    if(isset($_POST['btnSearchPersonData'])){

        $response = array();

        $connect = new Connection();
        $conn = $connect->openConnection();

        $txtSearchName = $_POST['txtSearchName'];

        $query = "Select * from persondata where firstname like '%$txtSearchName%' or lastname like '%$txtSearchName%' or middlename like '%$txtSearchName%'";
        $res = $conn->prepare($query);
        $res->execute();

        if($res->rowCount()){

            while($row = $res->fetch(PDO::FETCH_ASSOC)){
                $response[] = array(
                    'lastname' => $row['lastname'],
                    'firstname' => $row['firstname'],
                    'middlename' => $row['middlename'],
                    'age' => $row['age']
                );
            }
    
            $array2 = array();
            for($i = 0 ; $i < count($response) ; $i ++){
                $array2[$i] = $response[$i];
            }
    
            echo json_encode($array2);

        }else{
            $response['status'] = 'Error';
            $response['message'] = 'No Records found!';

            echo json_encode($response);

        }
        
        $connect->closeConnection();

    }

?>