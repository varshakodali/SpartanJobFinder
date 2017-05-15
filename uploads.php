<?php
        include('session.php'); 
       
        try {

                // Connect to db
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $fileName = $_FILES['file']['name'];
                $tmpName  = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileType = $_FILES['file']['type'];

                $fp      = fopen($tmpName, 'r');
                $content = fread($fp, filesize($tmpName));
                $content = addslashes($content);
                fclose($fp);

                //if(!get_magic_quotes_gpc())
                //{
                  //  $fileName = addslashes($fileName);
                //}
                
                $uid = intval($id);

               $sql = "INSERT INTO resumes ( userId, name, size, type, content ) ".
"VALUES ( '$uid', '$fileName', '$fileSize', '$fileType', '$content')";
                
               if($con->query($sql)) {
                    header("location: resume.html");
               }
               else {
                    header("location: resume.html");
               }

            
            } catch(PDOException $ex) {
                //header("location: resume.html");
                print $ex;
            
            }        
        ?>