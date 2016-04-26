<?php
include('adb.php');

class trafficJam extends adb {
    
    /**
     * function to add new traffic jam status to the database
     * @param type $level
     * @param type $jamStatus
     * @param type $latitude
     * @param type $longitude
     * @return boolean
     */
    function insert_new_Jam_Update($level,$jamStatus,$latitude,$longitude){
        $str_query = "INSERT INTO traffic_jam (jam_statement,longitude,latitude,level_of_traffic) VALUES('$jamStatus','$latitude','$longitude','$level')";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    function  display_traffic_status(){
        $str_query = "SELECT jam_statement,longitude,latitude,level_of_traffic FROM traffic_jam";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
   
    
  
    
    
}
?>