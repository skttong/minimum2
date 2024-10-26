<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
<style>
	
	div {
	  box-sizing: border-box;
	  border: 1px solid black;
	  padding: 2px;
	}
	.wrapper {
	  width: 100%;
	  height: 100%;
	  padding: 15px;
	}
	.half {
	  float: left;
	  width: 30%;
	  height: 100%;
	}
	.inner {
	  margin: 2px 5px;
	  height: 30px;
	}
	.clear {
	  clear: both;
	  border: none;
	}	
</style>	
	
</head>

<body>

	

	


<div class="wrapper">
  Div
  <br/>
	<div class="half">
	  <canvas id="myChart"></canvas>
	</div>	
	<div class="half">
	  <canvas id="myChart2"></canvas>
	</div>
	<div class="half">
	  <canvas id="myChart3"></canvas>
	</div>		
  <div class="clear"></div>
</div>
	
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [<?php echo "12, 19, 3, 5, 2, 3" ;?>],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>


	
<script>
  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [<?php echo "2, 19, 3, 5, 12, 3" ;?>],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
	

	
<script>
  const ctx3 = document.getElementById('myChart3');

  new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [(12,3), (19,4), (3,9), (5,10), (2,5), (3,19)],
		backgroundColor: [
		  'rgba(255, 99, 132, 0.2)',
		  'rgba(255, 159, 64, 0.2)',
		  'rgba(255, 205, 86, 0.2)',
		  'rgba(75, 192, 192, 0.2)',
		  'rgba(54, 162, 235, 0.2)',
		  'rgba(153, 102, 255, 0.2)',
		  'rgba(201, 203, 207, 0.2)'
		],
		borderColor: [
		  'rgb(255, 99, 132)',
		  'rgb(255, 159, 64)',
		  'rgb(255, 205, 86)',
		  'rgb(75, 192, 192)',
		  'rgb(54, 162, 235)',
		  'rgb(153, 102, 255)',
		  'rgb(201, 203, 207)'
		],  
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
	
<!--<div class="wrapper">
  Div
  <br/>
  <div class="half">
    Div 1
  </div>
  <div class="half">
    Div 2
    <div class="inner">
      div 1
    </div>
    <div class="inner">
      div 2
    </div>
  </div>
  <div class="clear"></div>
</div>	-->



 
</body>
</html>
