<?php
    include('session.php');
           
        try {
                // Connect to db
                $jsonobj = new stdClass();
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
                $con = new PDO("mysql:host=localhost;dbname=varsha","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    $query = "SELECT Name, Reviewer, Review, Rating FROM companyreview 
                                JOIN organization ON organization.OrgID = companyreview.OrgID 
                                GROUP BY ReviewerID, organization.OrgID ORDER BY Rating DESC";

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
                                
/*<div class="media">
 <div class="media-left"><a href="#"> </a></div>
<div class="media-body"> <h4 class="media-heading"><a class="author" href="#">Company</a></h4>
<h6>varsha: </h6>
Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
<p>Rating: 4.0/5.0</p>
</div>
<div class="clearfix"> </div>
</div>
REVIEWS;*/

                            //}
                        //}                 
                   // }
            
            } catch(PDOException $ex) {
                $jsonobj->operation = "error";
                $error = "Server refused connection! Try again";
            
            }        
        ?>