<html>
  <head>

    <script src="js/amcharts.js"></script>
    <script src="js/serial.js"></script>
    <script>
      AmCharts.makeChart( "chartdiv2", {
      "type": "serial",
      "dataProvider": <?php getdata(); ?>,
      "categoryField": "name",
      "graphs": [{
    // "balloonText": "[[category]]: <b>[[value]]</b>",
      "colorField": "color",
      "fillAlphas": 0.85,
      "lineAlpha": 0.5,
      "type": "column",
      "topRadius": 0.8,
      "valueField": "jobs"
      }],
      "titles": [
        {
          "text": "Companies with Most Jobs Applied",
          "size": 20
        }
      ],
      "depth3D": 50,
      "angle": 90,
        // } ]
      } );

      AmCharts.makeChart( "chartdiv1", {
      "type": "serial",
      "dataProvider": <?php getRating(); ?>,
      "categoryField": "name",
      "graphs": [{
    // "balloonText": "[[category]]: <b>[[value]]</b>",
      "colorField": "color",
      "fillAlphas": 0.85,
      "lineAlpha": 0.5,
      "type": "column",
      "topRadius": 0.8,
      "valueField": "Rating"
      }],
      "titles": [
        {
          "text": "Best Rated Companies",
          "size": 20
        }
      ],
      "depth3D": 50,
      "angle": 90,
        // } ]
      } );

    </script>
  </head>
<?php

function getRating() {
  $con = connect_to_db_analytics();

  $query = "SELECT AVG(Rating) as Rating, companies.company_name
  FROM CompanyRating
  JOIN companies on companyrating.OrganizationKey = companies.CompanyId
  group by company_name order by Rating DESC limit 5";

  $ps = $con->prepare($query);
  $ps->execute();

  $org = new StdClass;
  $org_arr = new StdClass;
  echo "[";
  $i=0;
  $colors = array("#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331");
  while($job_info = $ps->fetch()){
    $org->name = $job_info['company_name'];
    $org->Rating = $job_info['Rating'];
    $org->color = $colors[$i];
    echo json_encode($org);
    echo ",";
    $i = $i+1;
  }
  echo "]";

}
function getdata()
{
  require 'jobSearch.php';
  require 'connect.php';
  $con = connect_to_db_analytics();

  $query = "SELECT sum(NumofJobsApplied) as jobs, companies.company_name
  FROM JobsApplied
  JOIN companies on JobsApplied.OrganizationKey = companies.company_key
  group by company_name order by jobs DESC limit 5";

  $ps = $con->prepare($query);
  $ps->execute();

  $org = new StdClass;
  $org_arr = new StdClass;
  echo "[";
  $i=0;
  $colors = array("#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331");
  while($job_info = $ps->fetch()){
    $org->name = $job_info['company_name'];
    $org->jobs = $job_info['jobs'];
    $org->color = $colors[$i];
    echo json_encode($org);
    echo ",";
    $i = $i+1;
  }
  echo "]";

  // $job_info = $ps->fetchall();
  // echo json_encode($job_info);
}


?>

<body>
  <?php
  include 'header.html';
   ?>
  <div id="chartdiv1" style="width: 640px; height: 400px;margin-left: 300px;"></div> 
  <div id="chartdiv2" style="width: 640px; height: 400px;margin-left: 300px;"></div>
  
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
		
	    echo '<table align="center" border=\"0\">
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
  <?php
  include 'drill.php';
  ?>
  
  
  <?php
  include 'footer.html';
   ?>
   
   
   
</body>
</html>
