<?php

/**
* author: Beatrice Migaliza Lung'ahu
* date: 9th February,2016
* description: class containing database queries on the administrator tableau
*/

include("adb.php");

class administrator extends adb{
    
    /**
     * function to sign up an individual
     */    
    function Management_signUP($agence,$companyEmail,$phoneNumber,$location,$randomPass){
        // $str_query="INSERT INTO administartor (AgencyName, email,PhoneNumber, Assigned_pass,Location) VALUES('$agence','$companyEmail','$phoneNumber','".mysql_real_escape_string(md5($randomPass))."','$location')";
        $str_query="INSERT INTO administartor (AgencyName, email,PhoneNumber, Assigned_pass,Location) VALUES('".mysql_escape_string(md5($agence))."','".mysql_escape_string(md5($companyEmail))."','".mysql_escape_string(md5($phoneNumber))."','".mysql_escape_string(md5($randomPass))."','$location')";
        if($this->query($str_query)){
            mail($companyEmail,'Password and Username','Welcome to MyRide Agency register. /n Your password is:  '.$randomPass.'/n  Username is: '.$companyEmail. '/n Follow this link to login: http://166.62.103.147/~ashesics/class2016/beatrice_migaliza/MyRide/public_html/adminLogin.html','From: myride.ghana@gmail.com');
            return true;
        }
        else{
            return false;
        }

    }
    
    function management_login($email,$password){
        //SELECT AgencyName, location FROM administartor WHERE email='easy.coach@gmail.com' AND Assigned_pass='dckMS7aebjD'
        $str_query="SELECT AgencyName, location FROM administartor WHERE email='".mysql_escape_string(md5($email))."' AND Assigned_pass='".mysql_escape_string(md5($password))."'";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
}

?>
