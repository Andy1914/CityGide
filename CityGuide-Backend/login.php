<?php
if(isset($_POST['username']) && isset($_POST['password']))
{
include_once 'db_config.php';
    $db = new dbConfig();
    $conn = new PDO("mysql:host=".$db->getHost().";dbname=".$db->getDBName(),
            $db->getUserName(),
            $db->getPass());

    $login_query = "SELECT * FROM `users` "
        ."WHERE `username`='".$_POST["username"]."' "
        ."AND `password`='".md5($_POST["password"]) ."'
        LIMIT 1";
  
    $query = $conn->prepare($login_query);
  
    $query->execute();
  
    $result = $query->fetch(PDO::FETCH_OBJ);

    if (isset($result->username) == $_POST["username"])
    {
       
	   $response['status']='success'; 
	   $response['user_id'] = $result->id;
    }
    else
    {
        $unique_username = $conn->prepare('select * from users where username="'.$_POST["username"].'"'); 
        $unique_username->execute();
        $result_username = $unique_username->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($result_username)){

                $response['status']='failure';
                $response['message'] = 'password invalid'; 
        }
        else{
                $response['status']='failure';
                $response['message'] = 'username invalid';

        }
    }
}
else{
	$response['status']='failure';
	}
	
echo json_encode($response);
    
?>