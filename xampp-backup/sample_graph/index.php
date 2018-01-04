<?php
include 'library/config.php';
include 'classes/class.graph.php';

$graph = new Graph();

?>
<html>
<head>
  <title>SAMPLE GRAPH</title>
  <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="js/jquery.js"></script> 
    <script type="text/javascript" src="js/Chart.min.js"></script> 
</head>
<body>
<div id="container">
<b>SAMPLE DATA</b><br/><br/>

<?php
$list = $graph->get_clients();
if($list){
  foreach($list as $values){
    echo $values['client_name']."<br/>";
  }
}
?>
</div>

<div id="graph-container">
<b>SAMPLE GRAPH</b><br/><br/>
<div id="chart-container">
  <canvas id="mycanvas"></canvas>
</div>
</div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
  $.ajax({
    url: "process.php",
    method: "POST",
    dataType: "json",
    data:{
       "get_client_data": 1
    },
    success: function(data){
      var client_num = [];
      var area = [];

      for(var i in data){
        client_num.push(data[i].total_client);
        area.push(data[i].area_name);
      }

      var chartdata = {

        labels: area,
        datasets:[
        {
          label: 'No. of Clients',
          backgroundColor: 'green',
          borderColor: '#cacaca',
          hoverBackgroundColor: 'rgba(200,200,200,1)',
          hoverBorderColor: 'rgba(200,200,200,1)',
          data: client_num
        }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'horizontalBar',
        data: chartdata,
        options: {
          title: 
          {
          display: true,
          text: 'Number of Clients per Area of Sungem Pharma'
          }
        },
      });
    },
    error: function(data){
      alert("SALA KA");
    }
  });
});
</script>