<?php
require 'jobSearch.php';
require 'connect.php';
$con = connect_to_db();

$jobid = filter_input(INPUT_POST, "jobid");
$vars = array(':jobid' => $jobid);

$query = " SELECT * FROM jobs
           WHERE jobs.JobID='$jobid'";

$ps = $con->prepare($query);
$ps->execute($GLOBALS['vars']);
$ps->setFetchMode(PDO::FETCH_CLASS, "job_info");
print '<form action="apply.php" method="post">';
print '<table width ="800px" valign="top">';
while ($job_info = $ps->fetch()) {
  // echo $job_info->Role;
  print "<tr valign='top'>";
  print '<td width="50px">';
  print '</td>';
  print '<td valign="top">';
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Job Description</b>";
    echo "</br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $job_info->JobDescription;
    echo "</br>";
    echo "</br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Job Type</b>";
    echo "</br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $job_info->Type;
    echo "</br>";
    echo "</br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Job Requirement</b>";
    echo "</br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $job_info->JobRequirement;
    echo "</br>";
    echo "</br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Role</b>";
    echo "</br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $job_info->Role;
    echo "</br>";
    echo "</br>";



  print '</td>';
  print '</tr>';
  print '<tr>';
  print '<td>';
  print '</td>';
  print '<td>';
  print '<input type="submit" value="Apply Now">';
  print '</td>';
  print '</tr>';
  print '</table>';
  $jobid = $job_info->JobID;
  // echo $jobid;
  print "<input type='hidden' name='jobid' value='$jobid'/>";
  print '</form>';
}
// echo $query;
?>
