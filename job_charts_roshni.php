<html>
  <head>

    <script src="js/amcharts.js"></script>
    <script src="js/serial.js"></script>
    <script>
      AmCharts.makeChart( "chartdiv1", {
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
    </script>
  </head>
<?php
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
  <?php
  include 'drill.php';
  include 'footer.html';
   ?>
</body>
</html>
