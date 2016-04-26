<?php

include('adb.php');

class accidentUpdate extends adb{
    
    /**
     * function to add accidental update to the database
     * @param type $update
     * @param type $longitude
     * @param type $latitude
     * @param type $accidentLevel
     * @return boolean
     */
    function addAccident_update($update, $longitude,$latitude,$accidentLevel){
        $str_query = "INSERT INTO accident_tbl(Update_Statement, longitude, Latitude,accidentLevel) VALUES ('$update','$longitude','$latitude','$accidentLevel')";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    function displayAccident_traffic_report(){
        $str_query = "SELECT Update_Statement, longitude, Latitude,accidentLevel FROM accident_tbl ";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
}


?>