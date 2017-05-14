<?php
        session_start();
        
        $email = filter_input(INPUT_POST, "email");
        $password  = filter_input(INPUT_POST, "password");
       
        try {
                // Connect to db
                $jsonobj = new stdClass();
                $error = "";
                $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    $ps = $con->prepare("SELECT *FROM applicant WHERE Email = :email AND Password = :password");

                    $vars = array(':email' => $email);
                    $vars[':password'] = $password;
                    $ps->execute($vars);
                    $data = $ps->fetchAll(PDO::FETCH_ASSOC);  
                              
                    if (sizeof($data) == 0){
                        $jsonobj->operation = "error";
                        //echo json_encode($jsonobj); 
                        $error = "Username or Password is Invalid";
                        echo '<script type="text/javascript">';
                        echo 'alert("Username and password do not match!!");';
                        echo '</script>';
                        echo "<script type='text/javascript'> document.location = 'index.html'; </script>";
                    }
                    else{
                        $jsonobj->operation = "success";
                        $_SESSION['login_user']=$email;
                        header("location: home.php");
                        exit();
                        //echo json_encode($jsonobj);                     
                    }
            
            } catch(PDOException $ex) {
                $jsonobj->operation = "error";
                $error = "Server refused connection! Try again";
            
            }        
        ?>