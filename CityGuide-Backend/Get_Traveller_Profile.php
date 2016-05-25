<?php
include_once 'db_config.php';
$db = new dbConfig();
$conn = new PDO("mysql:host=".$db->getHost().";dbname=".$db->getDBName(),
            $db->getUserName(),
            $db->getPass());
            
   
$user_id = $_POST['user_id'];
$role = $_POST['role'];
if($role == "traveller"){
$get_profile = "select * from profiles where user_id=$user_id";

$profile = $conn->prepare($get_profile); 

$profile->execute();
$results = $profile->fetchAll(PDO::FETCH_ASSOC);
if(!empty($results)){


                $return[]=array(
                'id' =>$results[0]['id'],
                'user_id'=>$results[0]['user_id'],
                'credit_card'=>$results[0]['credit_card'],
                'expiry' => $results[0]['expiry'],
                 'interests'=> $results[0]['interests'],
                 'language'=>$results[0]['language'],
                 'special_needs'=>$results[0]['special_needs']
            );

      echo json_encode(array('status'=>'success','data'=>$return));
      exit();
      
    }
    else{
        echo json_encode(array('status'=>'failure','message'=>'cannot get profile'));
        exit();
    }
}
else{

$get_profile = "select * from profile_two where user_id=$user_id";

$profile = $conn->prepare($get_profile); 

$profile->execute();
$results = $profile->fetchAll(PDO::FETCH_ASSOC);
if(!empty($results)){


                $return[]=array(
                'id' =>$results[0]['id'],
                'user_id'=>$results[0]['user_id'],
                'first_name'=>$results[0]['first_name'],
                'last_name'=>$results[0]['last_name'],
                'email' =>$results[0]['email'],
                'phone'=>$results[0]['phone'],
                'address_one' =>$results[0]['address_one'],
                'address_two' =>$results[0]['address_two'],
                'city'=>$results[0]['city'],
                'state'=>$results[0]['state'],
                'driver_license'=>$results[0]['driver_license'],
                'state2' =>$results[0]['state2'],
                'bank_ac' =>$results[0]['bank_ac'],
                'expiry' =>$results[0]['expiry'],
                'focal_areas' => $results[0]['focal_areas'],
                'language' => $results[0]['language'],
                'guide_type' =>$results[0]['guide_type'],
                'hobbies' =>$results[0]['hobbies']
            );

      echo json_encode(array('status'=>'success','data'=>$return));
      exit();
      
    }
    else{
        echo json_encode(array('status'=>'failure','message'=>'cannot get profile'));
        exit();
    }

}

?>