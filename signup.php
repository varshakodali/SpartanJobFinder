<?php
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');

        $first = filter_input(INPUT_POST, "firstName");
        $last  = filter_input(INPUT_POST, "lastName");
        $email = filter_input(INPUT_POST, "email");
        $password  = filter_input(INPUT_POST, "password");
        $gender = filter_input(INPUT_POST, "gender");
        $streetAddress  = filter_input(INPUT_POST, "streetAddress");
        $dob = filter_input(INPUT_POST, "dob"); 
        $city  = filter_input(INPUT_POST, "city");
        $state = filter_input(INPUT_POST, "state");
        $locationPreference = filter_input(INPUT_POST, "locationPreference");
        $contact = filter_input(INPUT_POST, "contact");
            
        try {
                
                // Connect to db
                $jsonobj = new stdClass();
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                // Insert new record into the db
                if(strlen($email) > 0 && strlen($last) > 0) {
                    $query = $con->prepare("INSERT INTO applicant(FirstName, LastName, Email, Password, StreetAddress, City, State, DOB, Gender, LocationPreference, Contact) VALUES('$first', '$last','$email','$password', '$streetAddress','$city','$state','$dob','$gender', '$locationPreference', '$contact');");
                    if($query->execute()) {
                        $jsonobj->operation = "success";
                        echo json_encode($jsonobj);
                    }
                    else {
                        $jsonobj->operation = "invalid";
                        echo json_encode($jsonobj); 
                    }
                }
            
            } catch(PDOException $ex) {
                $jsonobj->operation = "error";
                echo json_encode($jsonobj) ;
            
            }        
        ?>