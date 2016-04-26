<?php
/**
* author: Beatrice Migaliza Lung'ahu
* date: 9th February,2016
* description: class containing database queries on the busStatus tableau
*/


include("adb.php");

class busStatus extends adb{
    
    /**
     * function to add new status to the status table
     * @param type $status
     * @param type $importance
     * @param type $busName
     * @return boolean
     */
    function add_new_status($status,$importance,$busName){
        $str_query = "INSERT INTO busstatus (Status,Importance,BusName) VALUES('$status','$importance','$busName')";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    function edit_status(){
        
    }
    
    
    function display_status(){
        $str_query = "SELECT Status,BusName, Importance FROM busstatus  ORDER BY date_Time  DESC LIMIT 1";
        
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    function displayAllBusStatus(){
        $str_query="SELECT status,BusName,Importance FROM busstatus";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
   
}
?>