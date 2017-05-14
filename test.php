<body>
<?php
session_start();

getdata();
function getdata()
{
  require 'jobSearch.php';
  require 'connect.php';
  $con = connect_to_db();

  $email = $_SESSION['login_user'];
  $query = "select ID from applicant where EMAIL='$email'";// echo $query;
  $ps = $con->prepare($query);
  $ps->execute();
  $ps->setFetchMode(PDO::FETCH_CLASS, "job_info");
  $applicant_info = $ps->fetch() ;
  $applicant_id = $applicant_info->ID;


  $query = "SELECT sum(ja.`NumofJobsApplied`) as jobs, concat(c.year,'-',c.month) as monyear from JobsApplied ja
            join calendar c
            on ja.CalendarKey = c.CalendarKey
            join applicant a
            on ja.ApplicantKey = a.ID
            where ja.ApplicantKey = $applicant_id
            group by c.year, c.Month
            order by jobs desc
            ";

  if(isset($_POST['jobid'])){
    if($_POST['jobid']=='up'){
      $query = "SELECT sum(ja.`NumofJobsApplied`) as jobs, c.year as monyear from JobsApplied ja
                join calendar c
                on ja.CalendarKey = c.CalendarKey
                join applicant a
                on ja.ApplicantKey = a.ID
                group by c.year
                order by jobs desc
                ";
    }
    if($_POST['jobid']=='down'){
      $query = "SELECT sum(ja.`NumofJobsApplied`) as jobs, concat(c.year,'-',c.month,'-',c.DayOfMonth) as monyear from JobsApplied ja
                join calendar c
                on ja.CalendarKey = c.CalendarKey
                join applicant a
                on ja.ApplicantKey = a.ID
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
