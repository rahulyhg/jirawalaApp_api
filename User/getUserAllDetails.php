<?php
/**
 * Created by PhpStorm.
 * User: Vijay Purohit
 * Date: 2/25/2017
 * Time: 8:30 PM
 */
require_once '../include/Room_functions.php';
require_once '../include/DB_Functions.php';
$db = new DB_Functions();
$rs = new RoomsSearch();
// json response array
$response = array("error" => FALSE);


if ( isset($_POST['email']) )
{
    $email = $_POST['email'];

    if ($db->isUserExisted($email)) {

        $user = $db->getUserDet($email);
        if ($user != false) {
            // user is found
            $response["error"]              = FALSE;
            $response["uid"]                = $user["unique_id"];
            $response["user"]["name"]       = $user["name"];
            $response["user"]["email"]      = $user["email"];
            $response["user"]["mobile"]     = $user["mobile"];
            $response["user"]["addr"]       = $user["addr"];
            $response["user"]["city"]       = $user["city"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user is not found with the credentials
            $response["error"] = TRUE;
            $response["error_msg"] = "Error Updating Name!";
            echo json_encode($response);
        }
    }
    else
    {
        $response["error"] = TRUE;
        $response["error_msg"] = "Credentials are wrong.";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email missing!";
    echo json_encode($response);
}// main if closed