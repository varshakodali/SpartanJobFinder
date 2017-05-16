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
                    <a href="salary.html">Salaries</b></a>
                </li>
                <li>
								<a href="job_chart.php">Dashboard</b></a>
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
<div class="banner_1">
    <div class="container">
    <div id="search_wrapper1">
    </div>
   </div> 
</div>  

<h1 align="center">Search Results</h1>
    <p>
	<a href="salarytrends.php">Click here for salary trends</a>
<?php
	$org = filter_input(INPUT_POST, "organization");
	$loc = filter_input(INPUT_POST, "location");	
print ('<div class="container">
		<div id="search_wrapper1">
		   <div align="center" id="search_form" class="clearfix">
		   <form action="salary.php", method="POST">
		    <p>
			<input type=hidden name="organization" value="'.$org.'">
			<input type=hidden name="location" value="'.$loc.'">
			 <input type="text" class="text" placeholder="Job Title " name="role">
			 <input type="text" class="text" placeholder="Min Salary "  name="minsalary" >
			 <label class="btn2 btn-2 btn2-1b"><input type="submit" value="Search"></label>
			</p>
			</form>
           </div>
		</div>
   </div>');
    
require('jobdetails.php');
?>
    </p>	

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
