<head>
<script src="js/amcharts.js"></script>
<script src="js/serial.js"></script>
<script>
  AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "dataProvider": <?php getdata(); ?>,
  "categoryField": "timeline",
  "graphs": [{
// "balloonText": "[[category]]: <b>[[value]]</b>",
  "colorField": "color",
  "fillAlphas": 0.85,
  "lineAlpha": 0.5,
  "type": "column",
  "topRadius": 0.1,
  "valueField": "jobs"
  }],
  "titles": [
    {
      "text": "Jobs Applied By You",
      "size": 20
    }
  ],
  "depth3D": 50,
  "angle": 40,
    // } ]
  } );
</script>
</head>
<body>
<?php

function getdata()
{
  session_start();
  require 'jobSearch.php';
  require 'connect.php';
  $con = connect_to_db_analytics();
  $email = $_SESSION['login_user'];
  $query = "SELECT sum(ja.`NumofJobsApplied`) as jobs, concat(c.year,'-',c.month) as monyear from jobsapplied ja
            join calendar c
            on ja.CalendarKey = c.CalendarKey
            join applicant a
            on ja.ApplicantKey = a.ApplicantKey
            where ja.ApplicantKey= (SELECT ApplicantKey from applicant where Email='$email')
            group by c.year, c.Month
            order by jobs desc
            ";

  if(isset($_POST['jobid'])){
    if($_POST['jobid']=='up'){
      $query = "SELECT sum(ja.`NumofJobsApplied`) as jobs, c.year as monyear from jobsapplied ja
                join calendar c
                on ja.CalendarKey = c.CalendarKey
                join applicant a
                on ja.ApplicantKey = a.ApplicantKey
                where ja.ApplicantKey=(SELECT ApplicantKey from applicant where Email='$email')
                group by c.year
                order by jobs desc
                ";
    }
    if($_POST['jobid']=='down'){
      $query = "SELECT sum(ja.`NumofJobsApplied`) as jobs, concat(c.year,'-',c.month,'-',c.DayOfMonth) as monyear from JobsApplied ja
                join calendar c
                on ja.CalendarKey = c.CalendarKey
                join applicant a
                on ja.ApplicantKey = a.ApplicantKey
                where ja.ApplicantKey=(SELECT ApplicantKey from applicant where Email='$email')
                group by c.year, c.Month, c.DayOfMonth
                order by jobs desc
                ";
    }
  }

  $ps = $con->prepare($query);
  $ps->execute();

  $org = new StdClass;
  $org_arr = new StdClass;
  echo "[";
  $i=0;
  $colors = array("#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331", "#FF0000", "#3361FF", "#5CBC65", "#CE0EA0", "#F5E331");

  while($job_info = $ps->fetch()){
    $org->timeline = $job_info['monyear'];
    $org->jobs = $job_info['jobs'];
    $org->color = $colors[$i];
    echo json_encode($org);
    echo ",";
    $i = $i+1;
  }
  echo "]";
}
?>
<div id="chartdiv" style="width: 640px; height: 400px;"></div>
</body>
