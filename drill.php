<html>
  <head>
    <script src="js/amcharts.js"></script>
    <script src="js/serial.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $("button").click(function(){
            $.ajax(
              {
                type: 'post',
                url: "drillquery.php",
                data: {jobid:$(this).val()},
                success: function(result){
                  $("#chartdiv").html(result);
                }
            }
          );
        });
    });
    </script>

  </head>


<body>
  <?php
  // include 'header.html';
  // session_start();
  ?>

  </br></br></br>
  <p align="center">
   <button value="standard">Monthly</button>
   <button value="up">Yearly</button>
   <button value="down">Daily</button>
  </p>
  <div id="chartdiv" style="width: 840px; height: 400px;margin-left: 300px;"> </div>
  <?php
  // include 'footer.html';
   ?>
</body>
</html>
