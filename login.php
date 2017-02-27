<?php

	//include('dbconnect.php');
	require('functions.php');

	// json response array
	$response = array("error" => FALSE);

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		// receiving the post params
	    $email = $_POST['email'];
	    $password = $_POST['password'];

	    //Get the user by email and password
	    $user = getUserByEmail($email,$password);

	    if($user){
	    	//User found
	    	$response["error"] = FALSE;
       		$response["user"]["name"] = $user["name"];
        	$response["user"]["email"] = $user["email"];
        	$response["user"]["contactno"] = $user["contactno"];
            echo json_encode($response);
	    	}	else {
			        // user is not found with the credentials
			        $response["error"] = TRUE;
			        $response["error_msg"] = "Login credentials are wrong. Please try again!";
			        echo json_encode($response);
			    }
	} else {
		    // required post params is missing
		    $response["error"] = TRUE;
		    $response["error_msg"] = "Required parameters email or password is missing!";
		    echo json_encode($response);
		}
	

?>