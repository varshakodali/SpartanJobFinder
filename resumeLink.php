<?php

       require('session.php');

       class Resume {

          private $Id;
          private $Name;

          public function getResumeId() {
            return $this->Id;
          }
          public function getName() {
            return $this->Name;
          }
       }

       $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
       $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

       $query = "SELECT userId AS Id, name AS Name FROM resumes WHERE userId = $id";
       $result = $con->query($query);
       $result->setFetchMode(PDO::FETCH_CLASS, "Resume"); //or die('Error, query failed');


        if(sizeof($result) == 0)
        {
          print "<h3>No Resume uploaded!</h3><br>";
        } 
        else
        {
            while($data = $result->fetch()) {

              $rid = $data->getResumeId();
              print "<a href = 'down.php?id=$rid'";
              print ">";
              print $data->getName();
              print "</a><br>";
            }
        }
    ?>