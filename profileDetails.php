<?php

include('session.php'); 

class Applicant {
	private $FirstName;
	private $LastName;
	private $Email;
	private $ID;
	
	public function getFname()  { 
        return $this->FirstName; 
    }
    public function getLname()  { 
        return $this->LastName; 
    }
    public function getEmail()  { 
        return $this->Email; 
    }
    public function getID()  { 
        return $this->ID; 
    }

}
class Job {
    private $Role;
    private $Type;
    private $Month;
    private $YearApplied;
    private $Organization;
    
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
    public function getOrganization() {
        return $this->Organization;
    }

}
       
        try {
                // Connect to db
                $dataString = "";
                $error = "";
                //$username = $_SESSION['login_user'];
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    $ps = $con->prepare("SELECT FirstName, LastName, Email, id AS ID FROM applicant WHERE Email = :email");

                    $vars = array(':email' => $username);
                    $ps->execute($vars);
                    $ps->setFetchMode(PDO::FETCH_CLASS, "Applicant");  

                    $userID = 0;
                              
                    while ($review = $ps->fetch()) {
                        
                        $userID = $review->getID();
                        print "<div class='media'>";
                        print "<div class='media-left'><a href='#'> </a></div>";
                        print "<div class='media-body'> <h3 class='media-heading'><a class='author' href='#'>";
                        print $review->getFname(); 
                        print " ";
                        print $review->getLname();
                        print "</a></h3>";
                        print "<h6>";
                        print $review->getEmail();
                        print "</h6>";
                        print "</div><div class='clearfix'> </div></div>";

                    }

                    $ps1 = $con->prepare("SELECT Type, Role, MONTHNAME(DateApplied) AS Month, YEAR(DateApplied) AS YearApplied, company_name AS Organization FROM job_applicants
                        JOIN jobs ON jobs.JobID = job_applicants.job_id 
                        JOIN companies ON companies.company_ID = jobs.companyId
                        WHERE applicant_id = :userID");
                    
                    $vars1 = array(':userID' => $userID);
                    $ps1->execute($vars1);
                    $ps1->setFetchMode(PDO::FETCH_CLASS, "Job"); 

                    if($ps1->fetch()) $dataString .= "<h5>Jobs Applied</h5>"; 

                    while ($review1 = $ps1->fetch()) {
                        
                        $dataString .= "<div class='tab_grid'>";
                        $dataString .= "<div class='jobs-item with-thumb'>";
                        $dataString .= "<div class='jobs_right'>";
                        $dataString .= "<div class='date'>";
                        $dataString .= $review1->getYear();
                         $dataString .= "<span>";
                         $dataString .= $review1->getMonth();
                         $dataString .= "</span></div>";
                         $dataString .= "<div class='date_desc'><h6 class='title'><a href = '#'>";
                         $dataString .= $review1->getRole();
                         $dataString .= "</a></h6>";
                         $dataString .= "<span class='meta'>";
                         $dataString .= $review1->getOrganization();
                         $dataString .= "</span></div>";
                         $dataString .= "<div class='clearfix'></div>";
                         $dataString .= "<p class='description'>";
                         $dataString .= $review1->getType();
                         $dataString .= "</p>";
                         $dataString .= "</div><div class='clearfix'> </div></div>";

                    }
                    /*if(!($ps1->fetch())) {
                        $dataString .= "<h3>No Jobs Applied!</h3>";
                    }*/
            
            } catch(PDOException $ex) {
                print "<h3>Server refused connection! Try again</h3>";
            
            }        
?>