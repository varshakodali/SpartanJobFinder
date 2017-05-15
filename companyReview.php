<?php
    include('session.php');
           
        try {
                // Connect to db
                //$jsonobj = new stdClass();
                class Review {

                    private $Name;
                    private $Reviewer;
                    private $Review;
                    private $Rating;
    
                    public function getCompany()  { 
                        return $this->Name; 
                    }
                    public function getReviewer()  { 
                        return $this->Reviewer; 
                    }
                    public function getReview()  {
                        return $this->Review; 
                    }
                    public function getRating() {
                        return $this->Rating; 
                    }

                }

                $error = "";
                $dataString = "";
                $location = filter_input(INPUT_POST, "location");
                $company  = filter_input(INPUT_POST, "company");
                
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $query = "SELECT company_name AS Name, Reviewer, Review, Rating, location FROM companyreview 
                            JOIN companies ON companies.company_ID = companyreview.OrgID";
                
                $vars = array();
                            
                if(strlen($company) > 0 || strlen($location) > 0) {

                    $query .= " WHERE ";
                    if(strlen($company) > 0 && strlen($location) > 0){
                        $vars[':company'] = $company;
                        $vars[':location'] = $location;
                        $query .= "companies.company_name = :company AND companies.location = :location";
                    }
                    else if(strlen($company) > 0) {
                        $vars[':company'] = $company;
                        $query .= "companies.company_name = :company";
                    }
                    else if(strlen($location) > 0){
                        $vars[':location'] = $location;
                        $query .= "companies.location = :location";
                    }
                }

                $query .= " GROUP BY ReviewerID, companies.company_ID ORDER BY Rating DESC";

                $ps = $con->prepare($query);
                $ps->execute($vars);
                $ps->setFetchMode(PDO::FETCH_CLASS, "Review");
        
                while ($review = $ps->fetch()) {

                    print "<div class='media'>";
                    print "<div class='media-left'><a href='#'> </a></div>";
                    print "<div class='media-body'><h4 class='media-heading'><a class='author' href='#'>";
                    print $review->getCompany();
                    print "</a></h4>";
                    print "<h6>";
                    print $review->getReviewer();
                    print "</h6>";
                    print $review->getReview();
                    print "<p>Rating: ";
                    print $review->getRating();
                    print "/5</p>";
                    print "</div><div class='clearfix'> </div></div>";

                }

            } catch(PDOException $ex) {
                //$jsonobj->operation = "error";
                //print $ex;
                print "<h1>Server refused connection! Try again</h1>";
            
            }        
        ?>