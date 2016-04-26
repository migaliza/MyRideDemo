<?php
include("adb.php");

class rider extends adb{
    function add_New_Student($id,$first,$last){
        //INSERT INTO trial (id,Name,LastName) VALUES('jen','Mendi','Dolan') ON DUPLICATE KEY UPDATE Name='Mendi', LastName='Dolan';  INSERT INTO trial2 (id,Name,LastName) VALUES ('jen','Mendi','Dolan')
        $str_query = "INSERT INTO trial (id,Name,LastName) VALUES('$id','$first','$last') ON DUPLICATE KEY UPDATE Name='$first', LastName='$last';";
         $str_query.=" INSERT INTO trial2 (id,Name,LastName) VALUES ('$id','$first','$last')";
        if($this->multiple_query_connection($str_query)){
            return true;
        }
        else{
             echo "Multi query failed: (" . $this->errno . ") " . $this->error;
            return false;
        }
    }
    
    
    function insertStudent($id, $name,$last){
        $str_query = "INSERT INTO trial2 (id,Name,LastName) VALUES ('$id','$name','$last')";
        if($this->query($str_query)){
           
            return true;
        }
        else{
            
            return false;
        }
    }
}


?>
