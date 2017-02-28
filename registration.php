<?php

	//DB connection file
	//require 'dbconnect.php';
	require('functions.php');

	// json response array
	$response = array("error" => FALSE);

	$db= new DB_Functions();

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			//Receiving the parameters
			$name = mysqli_real_escape_string($con,$_POST["name"]);
			$email = mysqli_real_escape_string($con,$_POST["email"]);
			$contactno = mysqli_real_escape_string($con,$_POST["contactno"]);
			$password = md5(mysqli_real_escape_string($con,$_POST["password"]));

			//Checking whether the user exists or not
			if ($db->isUserExisted($email)) {
			        // user already exists
			        $response["error"] = TRUE;
			        $response["error_msg"] = "User already exists with " . $email;
			        echo json_encode($response);
			    }	else {
			        // create a new user
			        $user = $db->storeUser($name, $email, $contactno,$password); 
					        if ($user) {
		            			// user stored successfully
					            $response["error"] = FALSE;
					            $response["user"]["name"] = $user["name"];
					            $response["user"]["email"] = $user["email"];
					            $response["user"]["contactno"] = $user["contactno"];
					            $response["user"]["password"] = $user["password"];
					            echo json_encode($response);
					        } else {
					            // user failed to store
					            $response["error"] = TRUE;
					            $response["error_msg"] = "Failed to Register!";
					            echo json_encode($response);
					        }
					     }  

		} else {
		    $response["error"] = TRUE;
		    $response["error_msg"] = "Required parameters (name, email or contactno) is missing!";
		    echo json_encode($response);
		}
				

				
?>