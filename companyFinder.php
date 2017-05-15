<?php

$company_name = filter_input(INPUT_POST, "company");
$location_name  = filter_input(INPUT_POST, "location");

	try {
                // Connect to db
                $jsonobj = new stdClass();
                class Company {

                    private $company_name;
                    private $location;
                    private $company_function;
                    private $short_description;
    
                    public function getCompanyName()  { 
                        return $this->company_name; 
                    }
                    public function getLocation()  { 
                        return $this->location; 
                    }
                    public function getCompany_function()  {
                        return $this->company_function; 
                    }
                    public function getDescription() {
                        return $this->short_description; 
                    }

                }

                $error = "";
                $dataString = "";
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                   echo "comes here before query ";
                    $query = "SELECT company_name, location, company_function, short_description FROM test WHERE company_name='$company_name'";



                    echo "comes here after query ";
                    $ps = $con->prepare($query);
                    $ps->execute();
                    $result = $ps->rowCount();
                    echo "num_rows: ".$result;
                    $ps->setFetchMode(PDO::FETCH_CLASS, "Company");
                              
                    while ($company = $ps->fetch()) {
                        
                        echo $company->getCompanyName();
                        echo $company->getLocation();
                        print $company->getCompany_function();
                        print $company->getDescription();

                    }
                                
            
            } catch(PDOException $ex) {
                //$jsonobj->operation = "error";
                //$error = "Server refused connection! Try again";
                 echo 'ERROR: '.$ex->getMessage();

            
            }        
?>