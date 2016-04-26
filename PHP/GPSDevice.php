<?php

/**
 * author: Beatrice Migaliza Lung'ahu
 * date: 9th February,2016
 * description: class containing database queries on the GPSDevice tableau
 */
include ("adb.php");

class GPSDevice extends adb {

    /**
     * function to insert into the gpsdevice table and track the bus table
     * if the bus id already exists it overites what is already there
     * [[The add_GPS_Device]] is a function to add a new GPS device
     * @param [[Sting]] $name
     */
    function add_GPS_Device($Device, $latitude,$longitude) {

        $str_query = "INSERT INTO gpsdevice (Device_Id,lon,lat) VALUES('$Device','$lon','$lat') ON DUPLICATE KEY UPDATE lat='$latitude', lon='$longitude';";
        $str_query.= "INSERT INTO track_the_bus (Device_id,lon,lat) VALUES('$Device','$longitude','$latitude')";
        
        if($this->multiple_query_connection($str_query)){
            return true;
        }
        else{
             echo "Multi query failed: (" . $this->errno . ") " . $this->error;
            return false;
        }
    }
    
    function getGPSID(){
        $str_query="SELECT Device_Id from gpsdevice";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
     * function to fetch the GPS coordinates from the database
     * @return boolean
     */
    
    function fetch_GPS_Coordinates(){
      
        $str_query="SELECT gpsdevice.lat,gpsdevice.lon, bus.Bus_name FROM gpsdevice INNER JOIN bus ON gpsdevice.Device_Id=bus.GPSDevice_ID";
        if($this->query($str_query)){
          
            return true;
        }
        else{
            return false;
        }
    }



    function delete_GPS_Device($id) {
        $str_query = "DELETE FROM GPSDevice WHERE id='$id'";
        if ($this->connect()) {
            $this->query($str_query);
            return true;
        }
        return false;
    }

    function search_GPS_Device($name) {
        $str_query = "SELECT FROM GPSDevice WHERE name='$name'";
        if (!$this->query($str_query)) {
            return false;
        }

        return true;
    }
    
    
    function addGPSDeviceDescription($device,$description){
        $str_query="INSERT INTO gpsdevice (Device_Id,Description) VALUES('$device','$description')";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    function selectCordinatesByDate($date){
        echo $date;
        $str_query="SELECT Device_id, lon, lat FROM track_the_bus WHERE DATE(TimeLogged)= '$date'";
     
        if($this->query($str_query)){
            return true;
        }
        else{
            //echo $date;
            echo $str_query;
            echo mysql_error();
            return false;
        }
    }

}

?>