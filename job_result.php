<?php
print "<table id='job_table' class='table table-bordered'>";
print "<tr>";
// print "<th>JobID</th>";
print "<th>Role</th>";
print "<th>Company</th>";
// print "<th></th>";
// print "<th>Type</th>";
// print "<th>Job Description</th>";
// print "<th>MinSalary</th>";
// print "<th>MaxSalary</th>";
print "</tr>";
while ($job_info = $ps->fetch()) {
  print_job_info($job_info);
}
print "</table>";
print "</div>";
?>
