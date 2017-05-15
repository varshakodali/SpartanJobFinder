<?php
    include('session.php');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');

        $company  = filter_input(INPUT_POST, "company");
        $reviewer = filter_input(INPUT_POST, "reviewer");
        $rating = filter_input(INPUT_POST, "rating");
        $review  = filter_input(INPUT_POST, "review");
            
        try {
                
                // Connect to db
                //$jsonobj = new stdClass();
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                // Insert new record into the db
                if(strlen($reviewer) > 0 && strlen($company) > 0 && strlen($review) > 0) {
                    
                    $query = $con->prepare("SELECT company_ID FROM companies WHERE company_name = :name");
                    $vars = array(':name' => $company);
                    $query->execute($vars);
                    $data = $query->fetchAll(PDO::FETCH_ASSOC); 

                    if(sizeof($data) > 0) {

                        foreach($data as $row){
                            foreach ($row as $key => $value) {
                                $OrgID =  $value;
                            }                           
                        }
                        $query = $con->prepare("INSERT INTO companyreview(Reviewer, ReviewerID, Review, Rating, OrgID) VALUES('$reviewer', '$id', '$review','$rating','$OrgID');");
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
                 echo '<script type="text/javascript">';
                 echo 'alert("You can submit review for a company only once!!");';
                 echo '</script>';
                 echo "<script type='text/javascript'> document.location = 'reviews.php'; </script>";
            
            }        
        ?>