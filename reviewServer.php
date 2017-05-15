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
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    $query = "SELECT company_name AS Name, Reviewer, Review, Rating FROM companyreview 
                                JOIN companies ON companies.company_ID = companyreview.OrgID 
                                GROUP BY ReviewerID, companies.company_ID ORDER BY Rating DESC";

                    $ps = $con->prepare($query);
                    $ps->execute();
                    $ps->setFetchMode(PDO::FETCH_CLASS, "Review");
                              
                    while ($review = $ps->fetch()) {
                        
                        print "<div class='media'>";
                        print "<div class='media-left'><a href='#'> </a></div>";
                        print "<div class='media-body'> <h4 class='media-heading'><a class='author' href='#'>";
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
                print "<h1>Server refused connection! Try again</h1>";
            
            }        
        ?>