
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
<script>
</script>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/style.css" rel='stylesheet' type='text/css' />
<style>

            #chart-container {
                width: 640px;
                height: auto;
            }
</style>
</head>
<body>
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
                    <a href="worth.php">Know your Worth</b></a>
                </li>
                <li><a href="resume.html">Upload Resume</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
                 <ul class="dropdown-menu">
                        <li><a href="location.html">View Profile</a></li>
                        <li><a href="logout.php">Log out</a></li>
                </ul>
                </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
    </div>
</nav>
<br><br><br>

<div id="chart-container">
            <canvas id="mycanvas"></canvas>
</div>

<?php
    
    
	$jsonobj = new stdClass();
    class WorthDetails {

        private $MinSalary;
        private $location;
        
        
        public function getLocation()  { 
            return $this->location; 
        }
        public function getMinSalary()  {
            return $this->MinSalary; 
        }
        

    }

	if(isset($_POST['role'])) {
		$role = $_POST['role'];
		
	}
	if(isset($_POST['salary'])) {
		$salary = $_POST['salary'];
		
	}
	if(isset($_POST['experience'])) {
		$experience = $_POST['experience'];
		
	}
	if(isset($_POST['location'])) {
		$location = $_POST['location'];
		
	}
	
	if(isset($_POST['role']) && isset($_POST['salary']) && isset($_POST['role']) && (isset($_POST['experience']))) {

		$con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
	    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	    
	    $filter_query = "SELECT MinSalary, location FROM companies JOIN jobs ON companies.company_ID = jobs.companyId WHERE location='$location' AND Experience = '$experience' AND Role LIKE '%".$_POST['role']."%'";

	    

	    $ps = $con->prepare($filter_query);
	    $ps->execute();
	    $result = $ps->rowCount(); 

	    

	    $average = 0;
	    $count = 0;
	    $sum = 0;
	    $ps->setFetchMode(PDO::FETCH_CLASS, "WorthDetails");

        $state_salaries = array();
        $state_salaries_count = array();
        $state_salaries_average = array();

	    if($result > 0){

       
         while ($worth_details = $ps->fetch()) {
                        
            //print "<div class='worth_list'>";
            //print "<ul style='list-style: none';>";
            //print "<li><strong>Salary : </strong>". $worth_details->getMinSalary()."</li>";
            //print "<li><strong>Location :</strong>". $worth_details->getLocation(). "</li>";
      		//print "</ul>";
            //print "</div>";
            //print "<hr>";
            $sum = $sum + $worth_details->getMinSalary();
            $count++;

            

         }
         $average = $sum/$count;

         if($average <= $salary) {

            $percent = ($salary-$average)/$average;
            $percent_friendly = number_format( $percent * 100, 2 ) . '%';

            echo "Your salary is ".$percent_friendly. " better than average salary in your location <br>";

         }
         else {
            $percent = ($average-$salary)/$salary;
            $percent_friendly = number_format( $percent * 100, 2 ) . '%';

            echo "Your salary is ".$percent_friendly. " below than average salary in your location <br>";


         }

         $filter_query = "SELECT MinSalary, location FROM companies JOIN jobs ON companies.company_ID = jobs.companyId WHERE Experience = '$experience' AND Role LIKE '%".$_POST['role']."%'";

         $ps = $con->prepare($filter_query);
         $ps->execute();
         $result = $ps->rowCount();
         $ps->setFetchMode(PDO::FETCH_CLASS, "WorthDetails"); 

         while ($worth_details = $ps->fetch()) {
                        
            //print "<div class='worth_list'>";
            //print "<ul style='list-style: none';>";
            //print "<li><strong>Salary : </strong>". $worth_details->getMinSalary()."</li>";
            //print "<li><strong>Location :</strong>". $worth_details->getLocation(). "</li>";
            //print "</ul>";
            //print "</div>";
            //print "<hr>";
            
            $row = array();
            
            $row['location'] = $worth_details->getLocation(); 
            $row['MinSalary'] = $worth_details->getMinSalary();

            if(array_key_exists($row['location'], $state_salaries)) {

                $state_salaries[$row['location']] = $state_salaries[$row['location']] + $worth_details->getMinSalary();
                $state_salaries_count[$row['location']] = $state_salaries_count[$row['location']] + 1;

            }
            else {
                $state_salaries[$row['location']] = $worth_details->getMinSalary();    
                $state_salaries_count[$row['location']] = 1;

            }

         }

         //print_r($state_salaries);
         //print_r($state_salaries_count);

         foreach ($state_salaries as $key => $val) {

            $state_average = $val/($state_salaries_count[$key]);
            //echo "key: ".$key." average: ".$state_average."<br>";
            
            $state_salaries_average[$key] = $state_average;
            
         }

         //print_r($state_salaries_average);

         $data_string = json_encode($state_salaries_average);
         
         //print $data_string;





         
        
        }else{
            echo "<h3>Sorry no results found</h3>";
        }

        


    }


	


	

?>


<script> 

var my_data='<?php echo $data_string; ?>';
var json_obj = JSON.parse(my_data);

    $(document).ready(function(){
    $.ajax({
        
        success: function() {
            console.log(my_data);

            var states = [];
            var average_salaries = [];


            for (var key in json_obj) {
              if (json_obj.hasOwnProperty(key)) {
                //console.log(key + " -> " + json_obj[key]);
                states.push(key);
                average_salaries.push(json_obj[key]);
              }
            }

            var chartdata = {
                labels: states,
                datasets : [
                    {
                        label: 'Average Salary',
                        backgroundColor: 'rgba(0, 128, 255, 0.75)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: average_salaries
                    }
                ]
            };

            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            beginAtZero: true
                        }
                    }]
                }
        }
            });

        }

    });
});
</script>