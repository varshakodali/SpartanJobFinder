<?php
session_start();
require 'jobSearch.php';
require 'connect.php';
require 'header.html';
$con = connect_to_db();

// Data from Form
$org = filter_input(INPUT_POST, "keyword");
$location = filter_input(INPUT_POST, "location");

// echo "Post is: ";
// print_r($_SESSION);

if((isset($_POST["type"])) || (isset($_POST["experience"])) || (isset($_POST["role"])))
{
	// echo "SETTING";
	$_SESSION["filter"] = "YES";
}

else{
	// echo "UNSETTING";

	$_SESSION["keyword"] = $org;
	$_SESSION["location"] = $location;
	$_SESSION["filter"] = "NO";
}
	// print_r($_SESSION);

// Calling class and setting values
$myJobQuery  = new jobSearch();
$vars = array(':keyword' => $org);
$myJobQuery->keyword = $vars[':keyword'];
$vars = array(':location' => $location);
$myJobQuery->location = $vars[':location'];

// Calling method
getJobInfo($myJobQuery, $con);


function getJobInfo(jobSearch $myJob, $con){
	#Filter Present
	if($_SESSION["filter"]=="YES"){
		$keyword = $_SESSION['keyword'];
		$location = $_SESSION['location'];
		if($keyword !='Company/Job Title'){
			$query = "SELECT * FROM jobs j join companies c
			on j.companyId = c.company_ID where j.Role
			LIKE CONCAT('%', '$keyword', '%')
			or c.company_name
			LIKE CONCAT('%', '$keyword', '%')
			AND c.location = '$location' ";
		}
		else{
			$query = "SELECT * FROM jobs j join companies c
			on j.companyId = c.company_ID where c.location = '$location' ";
		}

		if(isset($_POST["type"])){
			$var = $_POST['type'];
			$query .= "and j.Type LIKE CONCAT('%','$var','%')";
		}

		if(isset($_POST["experience"])){
			$var = $_POST['experience'];
			$query .= "and j.Experience LIKE CONCAT('%','$var','%')";
		}

		if(isset($_POST["role"])){
			$var = $_POST['role'];
			$query .= "and j.Role LIKE CONCAT('%','$var','%')";
		}

	}
	#FIlter Not Present
	else{
		if($myJob->keyword !='Company/Job Title'){
		$query = "SELECT * FROM jobs j join companies c
		on j.companyId = c.company_ID
		WHERE j.Role
		LIKE CONCAT('%', '$myJob->keyword', '%')
		or c.company_name
		LIKE CONCAT('%', '$myJob->keyword', '%')
		AND c.location = '$myJob->location'
		";
		}
		else{
			$query = "SELECT * FROM jobs j join companies c
			on j.companyId = c.company_ID
			WHERE c.location = '$myJob->location'
			";
		}
	}
	// echo $query;
	$ps = $con->prepare($query);
	$ps->execute($GLOBALS['vars']);
	$ps->setFetchMode(PDO::FETCH_CLASS, "job_info");

	print "<html>";
	print "<head>";
	print "<script src='https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js'>";
	print "</script>";
	print '<script type="text/javascript">';
	print "$(document).ready(function() {";
	print "$('#job_table').DataTable();";
	print "} );";
	print '</script>';
	print '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
	# AJAX Call BEGIN
	print '<script>';
	print '$(document).ready(function(){';
  print '$("button").click(function(){';
  print '$.ajax({type: "post", url: "fetch.php", data: {jobid:$(this).val()}, success: function(result){';
  print '$("#right").html(result);';
  print '}});';
  print '});';
	print '});';
	print '</script>';
	# AJAX Call END
	print "</head>";
	// Printing Results
	print "<body>";
	include 'filter.html';
	print "<table height='400px'>";
	print "<tr>";
	print '<td width="50px">';
  print '</td>';
	print "<td>";
	print "<div id='left'>";
		include 'job_result.php';
	print "</td>";
	print "<td>";

	// require('example.php');
	print '<table width ="800px">';
	print "<div id='right' style='float: left;'>";
	print '</table>';
	print "</div>";
	print "</td>";
	print "</tr>";
	print "</table>";

}


function print_job_info(job_info $myInfo) {
	$color = "#FFFFFF";
	$fontsize = "2";
	$jobid = $myInfo->getjobID();
	$jobrole= $myInfo->getRole();
	$companyname= $myInfo->getCompanyName();
	// $jobtype = $myInfo->getType();
	// $description = $myInfo->getDescription();
	// $minsalary = $myInfo->getMinSalary();
	// $maxsalary = $myInfo->getMaxSalary();
	print "<tbody>";
	print "<tr>";
	// print "<td bgcolor='$color' width='400px' ><font size='$fontsize'> $jobid</font></td>";
	print "<td bgcolor='$color' width='400px' ><font size='$fontsize'> $jobrole</font></td>";
	print "<td bgcolor='$color' width='400px' ><font size='$fontsize'> $companyname</font></td>";
	print "<td bgcolor='$color' width='400px' ><font size='$fontsize'> <button value='$jobid'>Job Details</button></font></td>";
	// echo '<button>Get External Content</button>';
	// print "<td bgcolor='$color' width='150px' ><font size='$fontsize'> $jobtype</font></td>";
	// print "<td bgcolor='$color' width='400px' ><font size='$fontsize'> $description</font></td>";
	// print "<td bgcolor='$color' width='400px' ><font size='$fontsize'> $minsalary</font></td>";
	// print "<td bgcolor='$color' width='400px' ><font size='$fontsize'> $maxsalary</font></td>";
	print "</tr>";
	print "</tbody>";
}
require 'footer.html';
print "</body>";
print "</html>";
?>
