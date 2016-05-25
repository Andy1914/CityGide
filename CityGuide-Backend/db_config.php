<?php


class dbConfig{
    
    function getDBName(){
        $db_name = "eiconixd_cityguide";
        return $db_name;
    }
    function getUserName(){
        $db_user_name = "eiconixd_root";
       // $db_user_name = "root";
        return $db_user_name;
    }
    function getPass(){
        $db_password = "@#eiconix1234";
        //$db_password = "";
        return $db_password;
    }
    function getHost(){
        //$db_host = "developermolvicom.ipagemysql.com";
        $db_host = "localhost";
        return $db_host;
    }
    function getProjectUrl(){
        $projectURL = "http://www.eiconixdev.com/cityguide/";
        return $projectURL;
    }
}

?>
