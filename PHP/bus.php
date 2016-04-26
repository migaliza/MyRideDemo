<?php

/**
* author: Beatrice Migaliza Lung'ahu
* date: 9th February,2016
* description: class containing database queries on the bus tablea
*/

include("adb.php");

class bus extends adb{
    
    function current_Location(){
        
    }
    
    
    function number_people()
    {
        
    }
    
    function search_bus(){
        
    }
    
    function capacity_of_bus(){
        
    }
    
    /**
     * function to add a new bus to the database
     * @param type $busId
     * @param type $busName
     * @param type $gpsDeviceId
     * @param type $busDriver
     * @param type $BusRouteCode
     * @param type $BusAgency
     * @return boolean
     */
    function add_new_bus($busId,$busName,$gpsDeviceId,$busDriver,$BusRouteCode,$BusAgency,$numberofSeats){
        $str_query = "INSERT INTO bus (busBus_id,Bus_Name,GPSDevice_ID,Bus_DriverId,Bus_RouteCode,Bus_Agency,Number_of_seats) VALUES('$busId','$busName','$gpsDeviceId','$busDriver','$BusRouteCode','$BusAgency','$numberofSeats')";
        if($this->query($str_query)){
            echo $numberofSeats;
            return true;
        }
        else{
            return false;
        }
        
    }
    
    /**
     * function to update bus information
     * @param type $busId
     * @param type $busName
     * @param type $gpsDeviceId
     * @param type $busDriver
     * @param type $BusRouteCode
     * @param type $numberofSeats
     * @return boolean
     */
    function update_a_bus($busId,$busName,$gpsDeviceId,$busDriver,$BusRouteCode,$numberofSeats){
        $str_query = "UPDATE bus SET Bus_Name='$busName' GPSDevice_ID='$gpsDeviceId' Bus_DriverId='$busDriver' Bus_RouteCode='$BusRouteCode' Number_of_seats='$numberofSeats' WHERE Bus_id='$busId'";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    /**
     * function to display the buses availabe from one agency
     * @param type $agency_name
     * @return boolean
     */
    function display_buses_available_byNames(){
        $str_query="SELECT Bus_Id,Bus_Name FROM bus ";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
  
}  
?>
