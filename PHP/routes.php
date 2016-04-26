<?php
include("adb.php");

class Routes extends adb{
    /**
     * function to add a new route
     * @param type $routeCode
     * @param type $starLong
     * @param type $startLat
     * @param type $endLong
     * @param type $endLat
     */
    function add_new_route($routeCode, $starLong,$startLat,$endLong,$endLat){
        $str_query= "INSERT INTO routes (Route_Code, StartRoute_Latitude, StartRoute_longitude,EndLongitude,EndLatitude) VALUES('$routeCode', '$startLat','$starLong','$endLong','$endLat')";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    function display_All_Routes(){
        $str_query = "SELECT * FROM routes";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
}


?>
