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
           <a class="navbar-brand" href="home.php">Spartan Job Finder</a>
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
        <div id="search_form" class="clearfix">
            <h1>Start your job search</h1>
            <p>
            <form action="companyReviews.php" method="post">
             <input type="text" class="text" placeholder="Enter Company" name="company">
             <input type="text" class="text" placeholder="Location" name="location">
             <label class="btn2 btn-2 btn2-1b"><input type="submit" value="Search"></label>
             </form>
            </p>
        </div>
    </div>
   </div> 
</div>  
<div class="container"> 
    <div class="single">
    <div class="comments"> 
    <h6>Reviews</h6>  
       <?php
        require('./reviewServer.php');
        ?>         
    </div>
    <form action="submitReview.php", method="post">
    <h6>Write Review</h6>
            <div class="to">
                <input type="text" class="text" placeholder="Company" name="company">
                <input type="text" class="text" placeholder="location" name="location" style="margin-left:3%">
                <input type="text" class="text" placeholder="Rating" name="rating">
            </div>
            <div class="text">
               <textarea value="Message" placeholder="write review" name="review"></textarea>
            </div>
            <div class="form-submit1">
               <input name="submit" type="submit" id="submit" value="Submit"><br>
            </div>
            <div class="clearfix"></div>
          </form>
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