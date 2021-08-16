<?php
?>
<script>
function jstophp(){
var javavar=document.getElementById("text").value;  
document.getElementById("rslt").innerHTML="<?php 
  $phpvar='"+javavar+"'; 
  echo $phpvar;
?>";
}

function phptojs(){
var javavar2 = "<?php 
  $phpvar2="I am php variable value";
  echo $phpvar2;
?>";
alert(javavar2);
}
</script> 
<body>
  <div id="rslt">
  </div>
  <input type="text" id="text"/>
  <button onClick="jstophp()">Convert js to php</button>
  <button onClick="phptojs()">Convert php to js</button>

  PHP variable will appear here:
  <div id="rslt2">
  </div>
</body>
<div class="card card-custom shadow p-3 mb-10 bg-white rounded">
    <div style="width:50%; height:50%; padding:10;">
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    ];
    const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
    };
    
    const config = {
    type: 'line',
    data,
    options: {}
    };
    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    </script>
</div>