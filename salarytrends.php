<!DOCTYPE HTML>
<html>
<head>
<title>Spartan Job Finder</title>

<!-- AmChart JS -->
<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
<script src="https://www.amcharts.com/lib/3/maps/js/usaLow.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/chalk.js"></script>

<!--Amcharts Trend Jobs-->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Seeking Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<link href="css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/style.css" rel='stylesheet' type='text/css' />
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
                    <a href="companies.html">Companies</b></a>
                </li>
				<li>
                    <a href="salary.html">Salaries</b></a>
                </li>
                
                <li>
                    <a href="reviews.php">Reviews</b></a>
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
<div class="banner_1">
    <div class="container">
    <div id="search_wrapper1">
    </div>
   </div> 
</div>  
<div id="chartdivTrendJobs" style="height: 500px; width: 1000px;" ></div>

<?php
class salaraydetail{
	private $company_name,$AverageSalary;

	public function getName()   
	{ 
	return $this->company_name; 
	}
	public function getSalary()   
	{ 
	return $this->AverageSalary; 
	}
}

	$con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	$query = "SELECT company_name,AverageSalary from companies join salaryfacttable on salaryfacttable.company_ID=companies.company_ID";
	$ps = $con->prepare($query);
	$ps->execute();
	$ps->setFetchMode(PDO::FETCH_CLASS, "salaraydetail");
	
	while($result=$ps->fetch()){
		$name=$result->getName();
		$salaray=$result->getSalary();
		$rows[]=array(
		'name'=>$name,
		'salaray'=>$salaray,
		);
	}

	?>
<script>
	var plot = [];
	plot = <?php echo json_encode($rows); ?>;
    var chart = AmCharts.makeChart("chartdivTrendJobs", {
        "theme": "light",
        "type": "serial",
        "startDuration": 10,
        "dataProvider": [
		
                {
                    "domain": plot[0].name,
                    "visits": plot[0].salaray,
                },
				{
                    "domain": plot[1].name,
                    "visits": plot[1].salaray,
                },
				{
                    "domain": plot[2].name,
                    "visits": plot[2].salaray,
                },
				{
                    "domain": plot[3].name,
                    "visits": plot[3].salaray,
                },
				{
                    "domain": plot[4].name,
                    "visits": plot[4].salaray,
                },
				{
                    "domain": plot[5].name,
                    "visits": plot[5].salaray,
                },
			
        ],
        "valueAxes": [{
            "position": "left",
            "axisAlpha":0,
            "gridAlpha":0,
            "title":"Salary Range in 2017"
        }],
        "graphs": [{
            //"balloonText": "[[category]]: <b>[[value]]</b>",
            "colorField": "color",
            "fillAlphas": 0.85,
            "lineAlpha": 0.1,
            "type": "column",
            "topRadius":0.54,
            "valueField": "visits"
        }],
        "depth3D": 40,
        "angle": 47,
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "domain",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha":0,
            "gridAlpha":0,
            "title":"Companies"

        },
        

    }, );

</script>



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
