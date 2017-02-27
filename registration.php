<?php

//DB connection file
require "dbconnect.php";

if($_SERVER("REQUEST_METHOD") == "POST"){

	$name = mysqli_real_escape_string($con,$_POST["name"]);
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$contactno = mysqli_real_escape_string($con,$_POST["contactno"]);

	//Query to check whether the user exist or not
	$query = "SELECT * FROM registration WHERE email = $email";
	$result = $conn->query($query);

		if (mysqli_num_rows($result) > 0){
			echo "USER EXIST";
		}

		else{
			//Query to insert data into DB
			$qryinsert = "INSERT INTO registration(name,email,contactno)
						  VALUES ('$name','$email','$contactno')";

			$insertResult = mysqli_query($con,$qryinsert);

			//Check whether the registration is successful or not
			if($insertResult){
				echo "Registration Successful";
			}
			else{
				echo "Registration Failed";
			}
		}

	}

else{
	echo "CONNECTION FAILED";
}

?>