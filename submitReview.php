<?php
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');

        $reviewer = filter_input(INPUT_POST, "reviewer");
        $company  = filter_input(INPUT_POST, "company");
        $rating = filter_input(INPUT_POST, "rating");
        $review  = filter_input(INPUT_POST, "review");
            
        try {
                
                // Connect to db
                $jsonobj = new stdClass();
                $con = new PDO("mysql:host=localhost;dbname=varsha","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                // Insert new record into the db
                if(strlen($reviewer) > 0 && strlen($company) > 0 && strlen($review) > 0) {
                    
                    $query = $con->prepare("SELECT OrgID FROM organization WHERE Name = :name");
                    $vars = array(':name' => $company);
                    $query->execute($vars);
                    $data = $query->fetchAll(PDO::FETCH_ASSOC); 

                    if(sizeof($data) > 0) {

                        foreach($data as $row){
                            foreach ($row as $key => $value) {
                                $OrgID =  $value;
                            }                           
                        }
                        $query = $con->prepare("INSERT INTO companyreview(Reviewer, Review, Rating, OrgID) VALUES('$reviewer', '$review','$rating','$OrgID');");
                        if($query->execute()) {
                            header("location: reviews.php");
                            exit();
                        }
                    }
                    else {
                        echo '<script type="text/javascript">';
                        echo 'alert("Review not submitted. Please Try Again!!");';
                        echo '</script>';
                        echo "<script type='text/javascript'> document.location = 'reviews.php'; </script>";
                    }

                }
                else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Please enter the required fields!!");';
                    echo '</script>';
                    echo "<script type='text/javascript'> document.location = 'reviews.php'; </script>";

                }
            
            } catch(PDOException $ex) {
                //$jsonobj->operation = "error";
                //echo json_encode($jsonobj) ;
            
            }        
        ?>