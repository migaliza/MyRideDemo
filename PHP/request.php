<?php

session_start();
$cmd = $_REQUEST['cmd'];
switch ($cmd) {

    case 1:


        $latitude = $_GET['lat'];
        $longitude = $_GET['lon'];
        $Device = $_GET['Device_id'];


        include_once('GPSDevice.php');
        $GPSdevice = new GPSDevice();

//echo ($GPSdevice->add_GPS_Device($Device,$latitude,$longitude));
        if ($GPSdevice->add_GPS_Device($Device, $latitude, $longitude)) {
            echo '{"result":1,"message": "SUCCESFULLY ADDED"}';
        } else {

            echo '{"result":0,"message": "unsuccessful"}';
        }

        break;

//this displays the content added to the database
    case 2:
        include_once('GPSDevice.php');
        $device = new GPSDevice();
        if ($device->fetch_GPS_Coordinates()) {
            $row = $device->fetch();
            echo '{"result":1,"coordinates":['; //start of json object
            while ($row) {
                echo json_encode($row);   //convert the result array to json object
                $row = $device->fetch();
                if ($row) {
                    echo ",";     //if there are more rows, add comma 
                }
            }
            echo "]}";
        }






        break;

    case 3:
        include_once ('bus.php');
        $bus = new bus();

        $busId = $_REQUEST['Bus_id'];
        $busName = $_REQUEST['Bus_Name'];
        $gpsDeviceId = $_REQUEST['GPSDevice_ID'];
        $driverId = $_REQUEST['Bus_DriverId'];
        $routeCode = $_REQUEST['Bus_RouteCode'];
        $Agency = $_REQUEST['Bus_Agency'];
        $numberofseats = $_REQUEST['Number_of_seats'];
        $ValSeats = $numberofseats;
        if ($bus->add_new_bus($busId, $busName, $gpsDeviceId, $driverId, $routeCode, $Agency, $ValSeats)) {
            echo '{"result":1,"message": "YOU HAVE ADDED A NEW BUS"}';
        } else {
            echo '{"result":0,"message": "NOT SUCCESSFUL"}';
        }

        break;


    case 4:
        include_once('driver.php');
        $driver = new driver();

        $driverId = $_REQUEST['DriverId'];
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $AssignedBus_ID = $_REQUEST['AssignedBus_ID'];

        if ($driver->add_driver($driverId, $firstName, $lastName, $AssignedBus_ID)) {
            echo $driverId . " " . $firstName . " " . $lastName . " " . $AssignedBus_ID;
            echo '{"result":1 "message": "SUCCESSFULLY ADDED"}';
        } else {
            echo '{"result":0 "message": "UNSUCCESSFULLY"}';
        }





        break;

    case 5:
        include_once('busStops.php');
        $busStop = new busStops();


        if ($busStop->fetch_Bus_Stops()) {
            $row = $busStop->fetch();
            echo '{"result":1,"busStops":[';
            while ($row) {
                echo json_encode($row);
                $row = $busStop->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        } else {
            echo '{"result":0 "message": "UNSUCCESFULL"}';
        }

        break;

    case 6:
        include_once ('GPSDevice.php');
        $GPSdevice = new GPSDevice();

        $device = $_REQUEST['Device_Id'];
        $description = $_REQUEST['Description'];

        if ($GPSdevice->addGPSDeviceDescription($device, $description)) {
            echo '{"result":1 "message": "SUCCESSFULLY ADDED A NEW DEVICE DESCRIPTION"}';
        } else {
            echo '{"result":0 "message": "UNSUCCESSFULL"}';
        }

        break;


    case 7:
        include_once ('GPSDevice.php');
        $GPSdevice = new GPSDevice();

        if ($GPSdevice->getGPSID()) {
            $row = $GPSdevice->fetch();
            echo '{"result":1,"GPSID":[';
            while ($row) {
                echo json_encode($row);
                $row = $GPSdevice->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        }
        break;

    case 8:
        include_once('routes.php');
        $routes = new routes();

        $routeCode = $_REQUEST['Route_Code'];
        $starLong = $_REQUEST['StartRoute_longitude'];
        $startLat = $_REQUEST['StartRoute_Latitude'];
        $endLong = $_REQUEST['EndLongitude'];
        $endLat = $_REQUEST['EndLatitude'];

        if ($routes->add_new_route($routeCode, $starLong, $startLat, $endLong, $endLat)) {
            echo '{"result":1,"message":"SUCCESSFULLY ADDED A ROUTE"}';
        } else {
            echo '{"result":0,"message": "UNSUCCESSFUL"}';
        }

        break;

    case 9:

        include_once("routes.php");
        $routes = new routes();

        if ($routes->display_All_Routes()) {
            $row = $routes->fetch();
            echo '{"result":1, "routes":[';
            while ($row) {
                echo json_encode($row);
                $row = $routes->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        } else {
            echo '{"result":0,"message": "Nothing to display"}';
        }

        break;
    case 10:
        include_once ('administrator.php');
        $admnistrator = new administrator();
        if(empty($_REQUEST['email'])&&  empty($_REQUEST['AgencyName']) && empty($_REQUEST['PhoneNumber'])&& empty($_REQUEST['location'])){
            echo '{"result":0, "message":"NOT SUCCESSFUL"}';
            return;
   
        }

        $agence = $_REQUEST['AgencyName'];
        $companyEmail = $_REQUEST['email'];
        $phoneNumber = $_REQUEST['PhoneNumber'];
        $location = $_REQUEST['location'];

        $randomPass = str_shuffle("abcd7MSDjke");

        if ($admnistrator->Management_signUP($agence, $companyEmail, $phoneNumber, $location, $randomPass)) {
            echo '{"result":1,"message":"SUCCESSFULLY SIGNED UP"}';
        } else {
            echo '{"result":0, "message":"NOT SUCCESSFUL"}';
        }
        
        break;


    case 11:
        include_once('administrator.php');
        $administrator = new administrator();
        

        if (!empty($_REQUEST['email']) && !empty($_REQUEST['Assigned_Pass'])) {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['Assigned_Pass'];

            if ($administrator->management_login($email, $password)) {
                $row = $administrator->fetch();
                if ($row) {
                    echo '{"result":1,"message": "Logged In"}';
                    $agencyName = $_SESSION['AgencyName'];
                }
            } else {
                echo '{"result":0, "message": "UNSUCCESSFULL"}';
            }
        } else {
            echo '{"result":0, "message": "UNSUCCESSFULL"}';
        }

        break;

    case 12:
        include_once ('busStops.php');
        $busStops = new busStops();

        $stop_Id = $_REQUEST['Bus_Stop_Name'];
//echo $stop_Id;
        if ($busStops->search_Bus_Stop($stop_Id)) {
            $row = $busStops->fetch();
            echo '{"result":1,"stops":[';
            while ($row) {
                echo json_encode($row);
                $row = $busStops->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        } else {
            echo '{"result":0 "message": "UNSUCCESFULL"}';
        }

        break;
    case 13:
        include_once('bus.php');
        $bus = new bus();

        if ($bus->display_buses_available_byNames()) {
            $row = $bus->fetch();
            echo '{"result":1,"busNames":[';
            while ($row) {
                echo json_encode($row);
                $row = $bus->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        }

        break;
    case 14:
        include_once('busStatus.php');
        $status = new busStatus();

        $newStatus = $_REQUEST['Status'];
        $importance = $_REQUEST['Importance'];
        $busname = $_REQUEST['BusName'];

        if ($status->add_new_status($newStatus, $importance, $busname)) {
            echo '{"result":1,"message":"SUCCESSFULLY ADDED"}';
        } else {
            echo '{"result":0, "message":"UNSUCCESSFULL"}';
        }
        break;

    case 15:
        include_once('busStatus.php');
        $status = new busStatus();

        if ($status->display_status()) {
            $row = $status->fetch();
            echo '{"result":1,"status":[';
            while ($row) {
                echo json_encode($row);
                $row = $status->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        } else {
            echo '{"result":0,"message":"Nothing to diplay"}';
        }

        break;
    case 16:
        include_once('trafficJam.php');
        $jam = new trafficJam();

        $level = $_REQUEST['level_of_traffic'];
        $jamStatus = $_REQUEST['jam_statement'];
        $latitude = $_REQUEST['latitude'];
        $longitude = $_REQUEST['longitude'];

        if ($jam->insert_new_Jam_Update($level, $jamStatus, $latitude, $longitude)) {
            echo '{"result":1,"message":"THANK YOU FOR ADDING YOUR UPDATE"}';
        } else {
            echo '{"result":0,"message":"NOT SUCCESSFULL TRY AGAIN"}';
        }

        break;

    case 17:
        include_once('accidentUpdate.php');
        $accident = new accidentUpdate();

        $update = $_REQUEST['Update_Statement'];
        $longitude = $_REQUEST['longitude'];
        $latitude = $_REQUEST['Latitude'];
        $accidentLevel = $_REQUEST['accidentLevel'];

        if ($accident->addAccident_update($update, $longitude, $latitude, $accidentLevel)) {
            echo '{"result":1,"message":"THANK YOU FOR THE UPDATE"}';
        } else {
            echo '{"result":0,"message":"NOT SUCCESSFUL"}';
        }

        break;


    case 18:
        include_once('trafficJam.php');
        $jam = new trafficJam();

        if ($jam->display_traffic_status()) {
            $row = $jam->fetch();

            echo '{"result":1,"jam":[';
            while ($row) {
                echo json_encode($row);
                $row = $jam->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        } else {
            echo '{"result":0,"message":"NOTHING TO DISPLAY"}';
        }

        break;
    case 19:
        include_once('accidentUpdate.php');
        $accident = new accidentUpdate();

        if ($accident->displayAccident_traffic_report()) {
            $row = $accident->fetch();
            echo '{"result":1,"accident":[';
            while ($row) {
                echo json_encode($row);
                $row = $accident->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        } else {
            echo '{"result":0,"message":"NOT SUCCESSFULL"}';
        }
        break;

    case 20:
        include_once('rider.php');
        $rider = new rider();

        $id = $_GET['id'];
        $first = $_GET['Name'];
        $last = $_GET['LastName'];

        if ($rider->add_New_Student($id, $first, $last)) {
            echo '{"result":1,"message:"Successfully added"}';
        } else {
            echo '{"result":0,"message":"Unsuccesfull"}';
        }

        break;

    case 21:
        include_once('busStatus.php');
        $busStatus = new busStatus();

        if ($busStatus->displayAllBusStatus()) {
            $row = $busStatus->fetch();
            echo '{"result":1,"statusBus":[';
            while ($row) {
                echo json_encode($row);
                $row = $busStatus->fetch();
                if ($row) {
                    echo ",";
                }
            }
            echo "]}";
        } else {
            echo '{"result":0,"message":"Nothing to diplay"}';
        }
        
        break;
        
    case 22:
        include_once('GPSDevice.php');
        $gps = new GPSDevice();
        
        $date = $_REQUEST['date'];
        $time = strtotime($date);
        $newDate = date('Y-m-d',$time);
        if($gps->selectCordinatesByDate($newDate)){
            $row = $gps->fetch();
            echo '{"result":1,"values":[';
            while($row){
                echo json_encode($row);
                $row=$gps->fetch();
                if($row){
                    echo ",";
                }
            }
            
            echo "]}";
        }
        else{
            echo '{"result":0,"message":"Nothing to diplay"}';
        }
        
}
?>