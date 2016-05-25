<?php
include_once 'db_config.php';
$db = new dbConfig();
$conn = new PDO("mysql:host=".$db->getHost().";dbname=".$db->getDBName(),
            $db->getUserName(),
            $db->getPass());
            

$user_id = $_POST['user_id'];
$credit_card = $_POST['credit_card'];
$expiry = $_POST['expiry'];
$interests = $_POST['interests'];
$language = $_POST['language'];
$special_needs=$_POST['special_needs']; 

$insertProfile = "INSERT INTO profiles (user_id,credit_card,expiry,interests,language,special_needs) 
        VALUES (:user_id,:credit_card,:expiry,:interests,:language,:special_needs)";  

    $queryInsertProfile = $conn->prepare($insertProfile); 

    if($queryInsertProfile->execute(array(
        ':user_id' => $user_id,
        ':credit_card' => $credit_card,
        ':expiry' => $expiry,
        ':interests' => $interests,
        ':language' => $language,
        ':special_needs' => $special_needs,
        ))) 
    {
 
        
        $response['status'] = 'success';
        $response['message'] = 'profile added successfully';
        echo json_encode($response);
        exit;
    }
   
    else{

        $response['status'] = 'failure';
        $response['message'] = 'profile cannot add';
        echo json_encode($response);
        exit;

    }



?> 























