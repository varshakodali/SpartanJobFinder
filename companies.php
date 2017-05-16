<?php
    $company_name = filter_input(INPUT_POST, "company");
    $location_name  = filter_input(INPUT_POST, "location");
    $type = filter_input(INPUT_POST, "type");
    $size = filter_input(INPUT_POST, "size");
    $result = 0;
    try {
                // Connect to db
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

                $error = "";
                $dataString = "";
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    
                    if($company_name == ""){

                        $query = "SELECT company_name, location, company_function, short_description, size FROM companies WHERE location='$location_name'";
                    }

                    else if($location_name == ""){
                         $query = "SELECT company_name, location, company_function, short_description, size FROM companies WHERE company_name='$company_name'";
                    }
                    else {
                        $query = "SELECT company_name, location, company_function, short_description, size FROM companies WHERE company_name='$company_name' AND location='$location_name'";
                    }


                    $ps = $con->prepare($query);
                    $ps->execute();
                    $result = $ps->rowCount();
                    $ps->setFetchMode(PDO::FETCH_CLASS, "Company");
                              
                   
                                
            
            } catch(PDOException $ex) {
                //$jsonobj->operation = "error";
                //$error = "Server refused connection! Try again";
                 echo 'ERROR: '.$ex->getMessage();

            
            }    

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Spartan Job Finder</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seeking Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<link href="css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
</script>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/style.css" rel='stylesheet' type='text/css' />
<style>

</style>
</head>
<body>
<script type="text/javascript">
   var location_var = "<?php echo $location_name; ?>";
</script>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
           <a class="navbar-brand" href="index.html">Spartan Job Finder</a>
        </div>
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
        <ul class="nav navbar-nav">
                <li>
                    <a href="jobs.html">Jobs</b></a>
                </li>
                <li>
                    <a href="companies.php">Companies</b></a>
                </li>
                <li>
                    <a href="reviews.php">Reviews</b></a>
                </li>
				<li>
                    <a href="salary.html">Salaries</b></a>
                </li>
                <li>
                    <a href="worth.php">Know your Worth</b></a>
                </li>
                <li><a href="resume.html">Upload Resume</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
                 <ul class="dropdown-menu">
                        <li><a href="profile.php">View Profile</a></li>
						<li><a href="download.php">View Resume</a></li>
                        <li><a href="logout.php">Log out</a></li>
                </ul>
                </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
    </div>
</nav>
<div class="None">
    <div class="container">
    <div id="search_wrapper1">
        <div id="search_form" class="clearfix">
            <h1>Start your job search</h1>
            <p>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                 <input type="text" id="company" name="company" placeholder="Enter Company" name="company">
                 <input type="text" id="location" name="location" placeholder="Location" value="CA" name="location">
                 <label class="btn2 btn-2 btn2-1b"><input type="submit" value="Search"></label>
             </form>
            </p>

        </div>
    </div>
   </div> 
</div>  



<div class="container"> 
    
    <div class="col-md-2" class="advanced_filter">
        <h3>Filter</h3>
        <form method="post">
        Type :<select name="type" id="type">
            <option value="">----</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Education">Education</option>
            <option value="Insurance">Insurance</option>
        </select>
        <br><br>
        Size :<select name="size" id="size">
            <option value="">----</option>
            <option value="10"> less than 10</option>
            <option value="50"> less than 50</option>
            <option value="100">less than 100</option>
            <option value="500">less than 500</option>
             <option value="1000">less than 1000</option>
        </select>
        <br><br>
        <input type="button" value="Apply" onclick="loadData();">
        </form>
    </div>

<script type="text/javascript">
    function loadData(){
        var type = document.getElementById("type");
        var typeVal = type.options[type.selectedIndex].value;
        var size = document.getElementById("size");
        var sizeVal = size.options[size.selectedIndex].value;
        //var location = document.getElementById("location").value;
        //alert(location_var);

        if(typeVal || sizeVal){
            $.ajax({
                type : 'post',
                url : 'loadData.php',
                data : {
                    type_val : typeVal,
                    size_val : sizeVal,
                    location : location_var,
                },
                success : function(response){
                    $('#display_info').html(response);
                }
            });
        }
        else{
            $('#display_info').html("Apply some filters");
        }

        
    }        
</script>
    <div class="col-md-10" id="display_info">
    <h3>Companies</h3>  
      <?php

        if($result > 0){
        echo "<h4>Total records: ".$result."</h4>";
         while ($company = $ps->fetch()) {
                        
            print "<div class='company_list'>";
            print "<ul style='list-style: none';>";
            print "<li><strong>Company Name : </strong>". $company->getCompanyName()."</li>";
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
    </div>
   
</div>


<div class="footer">
    <div class="container">
        <div class="col-md-6 grid_3">
            <h4>Contact Us</h4>
                <p>Spartan Job Finder</p>
                <p>San Jose State University<p>
            <div class="clearfix"> </div>
        </div>
        <div class="col-md-6 grid_3">
            <h4>Sign up for free!</h4>
            <p>Build your resume and start applying for jobs.</p>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
</body>
</html> 
