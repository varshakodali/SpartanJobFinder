<?php

	$con = new PDO("mysql:host=localhost;dbname=analytics_spartans","root", "sesame");
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	if($con){
		//echo "db success to new db";
	}

	$olap_query = "SELECT SUM(NumApplicants) AS number, Type, company_name FROM job_type_company JOIN companies ON companies.company_key = job_type_company.CompanyKey JOIN jobs ON job_type_company.JobKey = jobs.JobKey GROUP BY companies.company_name, jobs.Type";

	    

	    $ps = $con->prepare($olap_query);
	    $ps->execute();
	    $result = $ps->rowCount(); 
	    $data = $ps->fetchAll(PDO::FETCH_ASSOC); 

	    $applicants_jobtype_array = array();
	    $my_row = array();
	    
	    foreach($data as $row) {
	    			$count = 0;
                    foreach ($row as $name => $value) {
					
                    //echo $name." ".$value."<br>";
             		//echo "<br>";
             		$my_row[$name] = $value;
             		$count++;
			   }
			   array_push($applicants_jobtype_array, $my_row);
		}
		
	    echo '<table border=\"0\">
		    <tr>
		        <th>Num Applicants</th>
		        <th>Job Type</th>
		        <th>Company Name</th>
		    </tr>';

		foreach ($applicants_jobtype_array as $val) {
		    echo '
		        <tr>
		            <td>'.$val['number'].'</td>
		            <td>'.$val['Type'].'</td>
		            <td>'.$val['company_name'].'</td>
		            
		        </tr>';

		}

		echo '
		</table>';

		
?>