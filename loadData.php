<?php

	$jsonobj = new stdClass();
    class Company {

        private $company_name;
        private $location;
        private $company_function;
        private $short_description;
        private $size;

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
        public function getSize() {
            return $this->size; 
        }

    }

    $type = $_POST['type_val'];
	$size = $_POST['size_val'];
	$location = $_POST['location'];

	// echo "type:".$type;
	// echo "size:".$size;

	if( ($type != "") && ($size != "" )){

	
		
		
        
        $filter_query = "SELECT company_name, location, company_function, short_description, size FROM companies WHERE 
        category='$type' AND size<='$size' AND location = '$location'";

	}elseif ($type !="") {
		
		$filter_query = "SELECT company_name, location, company_function, short_description, size FROM companies WHERE 
        category= '$type' AND location = '$location'";
	}elseif($size != ""){
		
		$filter_query = "SELECT company_name, location, company_function, short_description, size FROM companies WHERE 
         size<='$size' AND location = '$location'";
	}
	else {

		echo "Please make a selection on the filters";
	}
	$con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //$filter_query = "SELECT company_name, location, company_function, short_description FROM companies WHERE category='Education'";
    //echo "filter_query:".$filter_query."<br>";

	$ps = $con->prepare($filter_query);
    $ps->execute();
    $result = $ps->rowCount();
    $ps->setFetchMode(PDO::FETCH_CLASS, "Company");

	//echo "result ".$result;
    if($result > 0){
        echo "<h4>Total records: ".$result."</h4>";
         while ($company = $ps->fetch()) {
                       
            print "<div class='company_list'>";
            print "<ul style='list-style: none';>";
            print "<li><strong>Company Name : </strong>" .$company->getCompanyName()."</li>";
            print "<li><strong>Location :</strong>". $company->getLocation(). "</li>";
            print "<li><li><strong>Type :</strong>". $company->getCompany_function()."</li>";
            print "<li><strong>Description :</strong>". $company->getDescription()."</li>";
            print "<li><strong>Size :</strong>". $company->getSize()."</li>";
            print "</ul>";
            print "</div>";
            print "<hr>";
         }
        }else{
            echo "<h3>Sorry no results found</h3>";
        }

?>