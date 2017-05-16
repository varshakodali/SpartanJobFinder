<?php


class jobdetails{
	private $company_name, $Role, $Type, $Experience, $MinSalary, $MaxSalary;

	public function getName()   
	{ 
	return $this->company_name; 
	}
	public function getRole()   
	{ 
	return $this->Role; 
	}
	public function getMinSalary()   
	{ 
	return $this->MinSalary; 
	}
	public function getMaxSalary()   
	{ 
	return $this->MaxSalary; 
	}
}
	$org = filter_input(INPUT_POST, "organization");
	$role = filter_input(INPUT_POST, "role");
	$loc = filter_input(INPUT_POST, "location");
	$minsal = filter_input(INPUT_POST, "minsalary");
	$con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);		  

			if ($org == NULL) 
			{
				$org='';
			}
			if ($role==NULL)
			{
				$role='';
			}
			if ($loc==NULL)
			{
				$loc='';
			}
			if ($minsal==NULL){
				$minsal='';
			}
	
		echo "<script>console.log('$org' )</script>";
		//echo "<script>console.log('$role' )</script>";
		//echo "<script>console.log('$loc' )</script>";
	$query = "SELECT company_name,Role,MinSalary,MaxSalary from companies join jobs on companies.company_id=jobs.companyId where companies.company_name LIKE CONCAT('%', '$org' , '%') and role like  CONCAT('%', '$role' , '%') and location like CONCAT('%','$loc','%') and MinSalary >= '".$minsal."'";
	
$vars = array(':org' => $org);
$vars[':role'] = $role;
$vars[':loc'] = $loc;
$ps = $con->prepare($query);
$ps->execute($vars);
$ps->setFetchMode(PDO::FETCH_CLASS, "jobdetails");
	$color = "#FF6347";
if ($org!=null){
			   print "<h1>$org Salaries</h1>";
		   }
print "<table class='table table-bordered'>";
print "<tr>";
print "<th><font color='$color'>Name</font></th>";
print "<th><font color='$color'>Role</font></th>";
print "<th><font color='$color'>Avg Salary</font></th>";
print "<th><font color='$color'>Min Salary</font></th>";
print "<th><font color='$color'>Max Salary</font></th>";
print "</tr>";
while ($result = $ps->fetch()) {
	
		$color = "#87CEFA";
	    $fontsize = "2";
		$name = $result->getName();
		$role = $result->getRole();
		$minsalary = $result->getMinSalary();
		$maxsalary = $result->getMaxSalary();
		$AvgSalary = ($minsalary+$maxsalary)/2;
	
		print "<tbody>";
		print "<tr>";
		print "<td  width='150px' ><font size='$fontsize'>$name</font></td>";
		print "<td  width='150px' ><font size='$fontsize'> $role</font></td>";
		print "<td  width='150px' ><font size='$fontsize'> $AvgSalary</font></td>";
		print "<td  width='150px' ><font size='$fontsize'> $minsalary</font></td>";
		print "<td  width='150px' ><font size='$fontsize'> $maxsalary</font></td>";
		print "</tr>";
		print "</tbody>";
}
print "</table>";
?>
