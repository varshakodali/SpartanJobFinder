<?php

include('profileDetails.php'); 

class Job {
	private $Role;
	private $Type;
	private $Month;
	private $YearApplied;
	
	public function getRole()  { 
        return $this->Role; 
    }
    public function getType()  { 
        return $this->Type; 
    }
    public function getMonth()  { 
        return $this->Month; 
    }
    public function getYear()  { 
        return $this->YearApplied; 
    }

}
       
        try {
                // Connect to db
                print "varsha";
                $jsonobj = new stdClass();
                $error = "";
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    $ps = $con->prepare("SELECT Type, Role, month(DatePosted) AS Month, YEAR(DatePosted) AS YearApplied,  FROM jobapplications
                            JOIN jobs ON jobs.JobID = jobapplications.JobID 
                            WHERE ApplicantID = :userID");

                    $vars = array(':userID' => $userID);
                    $ps->execute($vars);
                    $data = $ps->setFetchMode(PDO::FETCH_CLASS, "Job");  

                    $userID = ($ps->fetch())->getID();
                              
                    while ($review = $ps->fetch()) {
                        
                        print "<div class='tab_grid'>";
                        print "<div class='jobs-item with-thumb'>";
                        print "<div class='jobs_right'>";
                        print "<div class='date'>";
                        print $review->getYear();
                        print "<span>";
                        print $review->getMonth();
                        print "</span></div>";
                        print "<div class='date_desc'><h6 class='title'>";
                        print $review->getRole();
                        print "</h6>";
                        print "<span class='meta'>";
                        print "Earny";
                        print "</span></div>";
                        print "<div class='clearfix'></div>";
                        print "<p class='description'>";
                        print $review->getType();
                        print "</p>";
                        print "</div><div class='clearfix'> </div></div>";

                    }
            
            } catch(PDOException $ex) {
                $jsonobj->operation = "error";
                $error = "Server refused connection! Try again";
            
            }        
?>