<?php
include_once 'db_config.php';
$db = new dbConfig();
$conn = new PDO("mysql:host=".$db->getHost().";dbname=".$db->getDBName(),
            $db->getUserName(),
            $db->getPass());

if(isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) )
 {
   
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $unique_email = $conn->prepare('select * from users where email="'.$email.'"'); 
    $unique_email->execute();
    $result_email = $unique_email->fetchAll(PDO::FETCH_ASSOC);

    $unique_username = $conn->prepare('select * from users where username="'.$username.'"'); 
    $unique_username->execute();
    $result_username = $unique_username->fetchAll(PDO::FETCH_ASSOC);    
    

    if(!empty($result_email))
        {
            $response['status'] = 'failure';
            $response['message'] = 'email already exists';
            echo json_encode($response);
            exit;
        }

    if(!empty($result_username)){

            $response['status'] = 'failure';
            $response['message'] = 'username already exists';
            echo json_encode($response);
            exit;
        }
}
else{

    $response['status'] = 'failure';
    $response['message'] = 'Fileds are empty';
    echo json_encode($response);
    exit;
}

    $insertUser = "INSERT INTO users (username,email,password,role) 
        VALUES (:username,:email,:password,:role)";  

    $queryInsertUser = $conn->prepare($insertUser); 

    if($queryInsertUser->execute(array(
        ':username' => $username,
        ':email' => $email,
        ':password' => md5($password),
        ':role'=> $_POST['role']
        ))) 
    {
        
        $user_id = $conn->lastInsertId();;
        /*
        $sqlRecentUser = "SELECT * FROM users WHERE id=".$user_id;
        $qu = $conn->prepare($sqlRecentUser);
        $qu->execute();
        $res = $qu->fetchAll(PDO::FETCH_ASSOC);
        */
if($_POST['role'] == 'tour_guide'){
    //updating some some data
$sqlInsert = "insert into  profile_two (user_id,first_name,last_name,email,phone,address_one,address_two,city,state,driver_license,state2,bank_ac,expiry,focal_areas,language,guide_type,hobbies) values(:user_id,:first_name,:last_name,:email,:phone,:address_one,:address_two,:city,:state,:driver_license,:state2,:bank_ac,:expiry,:focal_areas,:language,:guide_type,:hobbies)";
$preparedStatement = $conn->prepare($sqlInsert);
if($preparedStatement->execute(
    array(
        ':first_name' => "",
        ':last_name'=>"",
        ':email'=>"",
        ':phone' => "", 
        ':address_one'=>"",
        ':address_two'=>"",
        ':city'=>"",
        ':state'=>"",
        ':driver_license'=>"",
        ':state2'=>"",
        ':bank_ac'=>"",
        ':expiry'=>"",
        ':focal_areas'=>"",
        ':language'=>"",
        ':guide_type'=>"",
        ':hobbies'=>"",
        ':user_id'=>$user_id
        )))
{
    
    
    echo json_encode(array('status'=>'success','user_id'=>$user_id));
    exit;
}
}else{
       $insertProfile = "INSERT INTO profiles (user_id,credit_card,expiry,interests,language,special_needs) 
        VALUES (:user_id,:credit_card,:expiry,:interests,:language,:special_needs)";  

     $queryInsertProfile = $conn->prepare($insertProfile); 

     $queryInsertProfile->execute(array(
        ':user_id' => $user_id,
        ':credit_card' => "",
        ':expiry' => "",
        ':interests' => "",
        ':language' => "",
        ':special_needs' => "",
        ));

        $response['status'] = 'success';
        $response['user_id'] = $user_id;
        echo json_encode($response);
        exit;
        }
    }
    else{

        $response['status'] = 'failure';
        $response['message'] = 'cannot insert user';
        echo json_encode($response);
        exit;
    }
    //echo json_encode($response);
?>