
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
<br><br><br>
<form class="form-horizontal" method="post" action="worth_calc.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="role">Role</label>
    <div class="col-md-6">
      <input type="text" class="form-control" id="role" name="role" placeholder="Enter role"required/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="salary">Current Annual Salary</label>
    <div class="col-md-6"> 
      <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter salary"required/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="experience">Years of experience</label>
    <div class="col-md-6"> 
      <input type="text" class="form-control" id="experience" name="experience" placeholder="Enter experience"required/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="location">Location</label>
    <div class="col-md-6"> 
      <input type="text" class="form-control" id="location" name="location" placeholder="Enter location"required/>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-md-6">
      <button type="submit" class="btn btn-default" >Submit</button>
    </div>
  </div>
</form>


<!-- 
<script type="text/javascript">
	function calculateWorth(){
	var role = document.getElementById("role").value;
	var curr_salary = document.getElementById("salary").value;
	var experience = document.getElementById("experience").value;
	var location = document.getElementById("location").value;





}
</script> -->


</body>



<!-- <div class="footer">
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
</div> -->
</body>
</html> 