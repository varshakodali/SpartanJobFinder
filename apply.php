<?php
include 'header.html';
include 'connect.php';
session_start();
$jobid = $_POST['jobid'];
$con = connect_to_db();
$email = $_SESSION['login_user'];
$query = "select ID from applicant where EMAIL='$email'";// echo $query;
$ps = $con->prepare($query);
$ps->execute();
$ps->setFetchMode(PDO::FETCH_CLASS, "job_info");
$applicant_info = $ps->fetch() ;
$applicant_id = $applicant_info['ID'];

$check_query = "select count(*) from job_applicants where applicant_id=$applicant_id and job_id = $jobid";
$ps = $con->prepare($check_query);
$ps->execute();
// $ps->setFetchMode(PDO::FETCH_CLASS, "job_info");
$number_of_rows = $ps->fetchColumn();
if($number_of_rows == 0){
  $query = "Insert into job_applicants (applicant_id, job_id) values ($applicant_id, $jobid) ";
  // echo $query;
  $ps = $con->prepare($query);
  $ps->execute();
  echo '<table width ="800px">';
  echo '<tr>';
  echo '<td width="50px">';
  echo '</td>';
  echo '<td width="50px" height="200px">';
  echo "Successfully Applied";
  echo '</td>';
  echo '</tr>';
  echo '</table>';
}
else{
  echo "You have already applied for the job";
}
include 'footer.php';
?>
