<?php

	include("dbconnect.php");


	class DB_functions	{

	/**
	*Store new user
	*/

	public function storeUser($name,$email,$contact,$password){

		$stmt = $con->prepare("INSERT INTO registration(name, email,contactno,password) VALUES(?, ?, ?,?)");
		$stmt->bind_param("ssis",$name, $email, $contactno,$password);
		$result = $stmt->execute();
		$stmt->close();

		//Check whether the user is succesfully stored or not
		if($result){

			$stmt = $con->prepare("SELECT * FROM registration WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();
 
            return $user;
        	} else {
            return false;
        		}
    }

    /**
    *Check whether the user already exists or not
    */

    public function isUserExisted($email){

    	$stmt = $con->prepare("SELECT email from registration WHERE email = ?");
    	$stmt->bind_param("s",$email);
    	$stmt->execute();
    	$stmt->store_result();

    	if($stmt->num_rows > 0){
    		//user exists
    		$stmt->close();
    		return true;
    	} else{
    		$stmt->close();
    		return false;
    	}
    }

    /**
    * Get user by email and password for login purpose
    */

    public function getUserByEmail($email,$password){

    	$stmt = $con->prepare("SELECT * FROM registration WHERE email = ?");
    	$stmt->bind_param("s",$email);

    	if($stmt->execute()){
    		$user = $stmt->get_result()->fetch_assoc();
    		$stmt->close();

    		//verify user password
    		$encPassword = md5($password);
    		if($encPassword == $user["password"]){
    			return $user;
    		}	else{
    			return NULL;
    		}
    	}
    }

		
?>